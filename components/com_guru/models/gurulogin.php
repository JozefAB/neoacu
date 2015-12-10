<?php
/*------------------------------------------------------------------------
# com_guru
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com.com/forum/index/
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport ("joomla.aplication.component.model");
class guruModelguruLogin extends JModelLegacy {
	
	function __construct(){
		parent::__construct();
	}
	
	function isNewUser(){
		$username = JRequest::getVar("username", "");
		$email = JRequest::getVar("email", "");
		$firstname = JRequest::getVar("firstname", "");
		$lastname = JRequest::getVar("lastname", "");
    	$company = JRequest::getVar("company", "");
		$id = JRequest::getVar("id", "0");
		$auid = JRequest::getVar("auid", "0");

		$_SESSION["username"] = $username;
		$_SESSION["email"] = $email;
		$_SESSION["firstname"] = $firstname;
		$_SESSION["lastname"] = $lastname;
		$_SESSION["company"] = $company;
		
		$id_value = intval($id);
		
		if(intval($id_value) == 0){
			 $id_value = intval($auid);
		}
		
		if($id_value == 0){
			$db = JFactory::getDBO();
			$sql = "select count(*) from #__users where username='".trim(addslashes($username))."'";
			$db->setQuery($sql);
			$db->query();
			$result = $db->loadResult();
			
			if($result != "0"){
				return false;
			}
			
			$sql = "select count(*) from #__users where email='".trim(addslashes($email))."'";
			$db->setQuery($sql);
			$db->query();
			$result = $db->loadResult();
			if($result != "0"){
				return false;
			}
		}
		return true;
	}
	
	function store(){
		jimport("joomla.database.table.user");
		$db = JFactory::getDBO();
		$my = JFactory::getUser();
		$course_id = JRequest::getVar("course_id","0");

		$sql = "select * from #__guru_config";
		$db->setQuery($sql);
		$db->query();
		$configs = $db->loadAssocList();
		
		$allow_teacher_action = json_decode($configs["0"]["st_authorpage"]);//take all the allowed action from administator settings
		
		$teacher_aprove = @$allow_teacher_action->teacher_aprove; //allow or not aprove teacher
		$params = JComponentHelper::getParams('com_users');
		
		$nowDate = JFactory::getDate();
		$nowDate = $nowDate->toSql();
		$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$authKey = md5(uniqid(rand(), true));
		
		
		if(!$my->id){
			$new_user = 1;
		}
		else{
			$new_user = 0;
		}	
		
		$table = $this->getTable('guruCustomer');
		$data = JRequest::get('post');
		$data['password2'] = $data['password_confirm'];
		if($data['guru_teacher'] == 1){
			$data['name'] = $data['firstname']." ".$data['lastname'];
		}
		
		$data["enabled"] = 1;
		$res = true;
		$reg = JSession::getInstance("none", array());
		$user = new JUser();
		$useractivation = $params->get('useractivation');
		
		if(intval($data["id"]) == 0){
			$data["id"] = intval($my->id);
		}
		
		$user = new JUser($data["id"]);
		
		if($data['guru_teacher'] == 1){
			$session = JFactory::getSession();
			$token = $session->getToken();
			
			if($useractivation == 1 || $useractivation == 2){
				$data["block"] = 1;
				$data["activation"] = $token;
			}
			else{
				$data["block"] = 0;
				$data["activation"] = "";
			}
			
			$user->bind($data);
			if(!$user->save()) {
				$reg->set("tmp_profile", $data);
				$error = $user->getError();
				$res = false;
			}
		}
		
		if($data['guru_teacher'] == 2){
			$session = JFactory::getSession();
			$token = $session->getToken();
				
			if($teacher_aprove == 1){
				$data["enabled"] = 2;
				if($useractivation == 1 || $useractivation == 2){
					$data["block"] = 1;
					$data["activation"] = $token;
				}
				else{
					$data["block"] = 0;
					$data["activation"] = "";
				}
			}
			elseif($teacher_aprove == 0){
				$data["block"] = 0;
				$data["activation"] = "";
			}
			$user->bind($data);
			if(!$user->save()) {
				$reg->set("tmp_profile", $data);
				$error = $user->getError();
				$res = false;
			}
		}
		
		if(intval($data["id"]) == 0){
			$this->addToGroup($user->id);	
		}

		if($data['guru_teacher'] == 1){
			$data['id'] = $user->id;	
			if(!$this->existCustomer($data['id'])){
				$sql = "insert into #__guru_customer(`id`, `company`, `firstname`, `lastname`, `image`) values (".$data['id'].", '".addslashes(trim($data['company']))."', '".addslashes(trim($data['firstname']))."', '".addslashes(trim($data['lastname']))."', '".addslashes(trim($data['image']))."')";
				$db->setQuery($sql);
				if(!$db->query()){
					$res = false;
				}
				
				$params = JComponentHelper::getParams('com_users');
				$useractivation = $params->get('useractivation');
				
				if($useractivation == 2){
					// admin
					$sql = "select `template_emails`, `fromname`, `fromemail`, `admin_email` from #__guru_config";
					$db->setQuery($sql);
					$db->query();
					$confic = $db->loadAssocList();
					$template_emails = $confic["0"]["template_emails"];
					$template_emails = json_decode($template_emails, true);
					$fromname = $confic["0"]["fromname"];
					$fromemail = $confic["0"]["fromemail"];
					
					
					$sql = "select u.`email` from #__users u, #__user_usergroup_map ugm where u.`id`=ugm.`user_id` and ugm.`group_id`='8' and u.`id` IN (".$confic["0"]["admin_email"].")";
					$db->setQuery($sql);
					$db->query();
					$email = $db->loadColumn();
					
					$app = JFactory::getApplication();
					$site_name = $app->getCfg('sitename'); 
					
					$subject = $template_emails["new_student_subject"];
					$body = $template_emails["new_student_body"];
					
					$subject = str_replace("[STUDENT_FIRST_NAME]", $data['firstname'], $subject);
					$subject = str_replace("[STUDENT_LAST_NAME]", $data['lastname'], $subject);
					
					$body = str_replace("[STUDENT_FIRST_NAME]", $data['firstname'], $body);
					$body = str_replace("[STUDENT_LAST_NAME]", $data['lastname'], $body);
			
					for($i=0; $i< count($email); $i++){
						JFactory::getMailer()->sendMail($fromemail, $fromname, $email[$i], $subject, $body, 1);
						
						$sql = "insert into #__guru_logs (`userid`, `emailname`, `emailid`, `to`, `subject`, `body`, `buy_date`, `send_date`, `buy_type`) values ('".intval($data["id"])."', 'teacher-registration', '0', '".trim($email[$i])."', '".addslashes(trim($subject))."', '".addslashes(trim($body))."', '', '".date("Y-m-d H:i:s")."', '')";
						$db->setQuery($sql);
						$db->query();
					}
				}
				
				// add user to mailchimp
				require_once(JPATH_SITE.DS."components".DS."com_guru".DS."helpers".DS."MCAPI.class.php");
				
				$sql = "select `mailchimp_student_api`, `mailchimp_student_list_id`, `mailchimp_student_auto` from #__guru_config";
				$db->setQuery($sql);
				$db->query();
				$mailchimp_details = $db->loadAssocList();
				
				$mailchimp_student_api = $mailchimp_details["0"]["mailchimp_student_api"];
				$mailchimp_student_list_id = $mailchimp_details["0"]["mailchimp_student_list_id"];
				$mailchimp_student_auto = $mailchimp_details["0"]["mailchimp_student_auto"];
				
				if(trim($mailchimp_student_api) != "" && trim($mailchimp_student_list_id) != ""){
					$api = new MCAPI($mailchimp_student_api);
					$mergeVars = array('FNAME'=>$data['firstname'], 'LNAME'=>$data['lastname']);
					$mc_autoregister = false;
					
					if($mailchimp_student_auto == 1){
						$mc_autoregister = true;
					}
					
					$api->listSubscribe($mailchimp_student_list_id, $data["email"], $mergeVars, 'html', $mc_autoregister, true);
				}
			}
		}
		
		if($data['guru_teacher'] == 2){
			$sql = "select `id` from #__guru_commissions where `default_commission`=1";
			$db->setQuery($sql);
			$db->query();
			$id_commission = $db->loadColumn();
			$id_commission = @$id_commission["0"];
		
			$data['id'] = $user->id;	
			$data["full_bio"] = JRequest::getVar("full_bio","","post","string",JREQUEST_ALLOWRAW);
			
			if(!$this->existAuthor($data['id'])){
				$sql = "INSERT INTO `#__guru_authors` (`userid`, `gid`, `full_bio`, `images`, `emaillink`, `website`, `blog`, `facebook`, `twitter`, `show_email`, `show_website`, `show_blog`, `show_facebook`, `show_twitter`, `author_title`, `ordering`, `forum_kunena_generated`,`enabled`, `commission_id`) VALUES('".intval($data['id'])."', 2, '".$data["full_bio"]."','".$data["images"]."', '".$data["emaillink"]."', '".$data["website"]."', '".$data["blog"]."', '".$data["facebook"]."', '".$data["twitter"]."', '".$data["show_email"]."', '".$data["show_website"]."', '".$data["show_blog"]."', '".$data["show_facebook"]."', '".$data["show_twitter"]."',  '".$data["author_title"]."', '".$data["ordering"]."', '', '".$data["enabled"]."', '".$id_commission."' )";
				$db->setQuery($sql);
				if(!$db->query()){
					$res = false;
				}
				
				if($teacher_aprove == 0){ // YES
					$sql = "select `template_emails`, `fromname`, `fromemail`, `admin_email` from #__guru_config";
					$db->setQuery($sql);
					$db->query();
					$confic = $db->loadAssocList();
					$template_emails = $confic["0"]["template_emails"];
					$template_emails = json_decode($template_emails, true);
					$fromname = $confic["0"]["fromname"];
					$fromemail = $confic["0"]["fromemail"];
					
					
					$sql = "select u.`email` from #__users u, #__user_usergroup_map ugm where u.`id`=ugm.`user_id` and ugm.`group_id`='8' and u.`id` IN (".$confic["0"]["admin_email"].")";
					$db->setQuery($sql);
					$db->query();
					$email = $db->loadColumn();
					
					$app = JFactory::getApplication();
					$site_name = $app->getCfg('sitename'); 
					
					$subject = $template_emails["new_teacher_subject"];
					$body = $template_emails["new_teacher_body"];
					
					$subject = str_replace("[AUTHOR_NAME]", $user->name, $subject);
					
					$body = str_replace("[AUTHOR_NAME]", $user->name, $body);
			
					for($i=0; $i< count($email); $i++){
						JFactory::getMailer()->sendMail($fromemail, $fromname, $email[$i], $subject, $body, 1);
						
						$sql = "insert into #__guru_logs (`userid`, `emailname`, `emailid`, `to`, `subject`, `body`, `buy_date`, `send_date`, `buy_type`) values ('".intval($data["id"])."', 'teacher-registration', '0', '".trim($email[$i])."', '".addslashes(trim($subject))."', '".addslashes(trim($body))."', '', '".date("Y-m-d H:i:s")."', '')";
						$db->setQuery($sql);
						$db->query();
					}
				}
				
				// add teacher to mailchimp
				require_once(JPATH_SITE.DS."components".DS."com_guru".DS."helpers".DS."MCAPI.class.php");
				
				$sql = "select `mailchimp_teacher_api`, `mailchimp_teacher_list_id`, `mailchimp_teacher_auto` from #__guru_config";
				$db->setQuery($sql);
				$db->query();
				$mailchimp_details = $db->loadAssocList();
				
				$mailchimp_teacher_api = $mailchimp_details["0"]["mailchimp_teacher_api"];
				$mailchimp_teacher_list_id = $mailchimp_details["0"]["mailchimp_teacher_list_id"];
				$mailchimp_teacher_auto = $mailchimp_details["0"]["mailchimp_teacher_auto"];
				
				if(trim($mailchimp_teacher_api) != "" && trim($mailchimp_teacher_list_id) != ""){
					$name = $data["name"];
					$name_array = explode(" ", $name);
					$FNAME = "";
					$LNAME = "";
					
					if(count($name_array) > 1){
						$LNAME = $name_array[count($name_array) - 1];
						unset($name_array[count($name_array) - 1]);
						$FNAME = implode(" ", $name_array);
					}
					else{
						$FNAME = $data["name"];
					}
					
					$api = new MCAPI($mailchimp_teacher_api);
					$mergeVars = array('FNAME'=>$FNAME, 'LNAME'=>$LNAME);
					$mc_autoregister = false;
					
					if($mailchimp_teacher_auto == 1){
						$mc_autoregister = true;
					}
					
					$api->listSubscribe($mailchimp_teacher_list_id, $data["email"], $mergeVars, 'html', $mc_autoregister, true);
				}
			}
			else{
				$sql = "update `#__guru_authors` set `full_bio`='".addslashes(trim($data["full_bio"]))."', `images`='".addslashes(trim($data["images"]))."', `website`='".addslashes(trim($data["website"]))."', `blog`='".addslashes(trim($data["blog"]))."', `facebook`='".addslashes(trim($data["facebook"]))."', `twitter`='".addslashes(trim($data["twitter"]))."', `show_website`='".addslashes(trim($data["show_website"]))."', `show_blog`='".addslashes(trim($data["show_blog"]))."', `show_facebook`='".addslashes(trim($data["show_facebook"]))."', `show_twitter`='".addslashes(trim($data["show_twitter"]))."', `author_title`='".addslashes(trim($data["author_title"]))."' where `userid`=".intval($user->id);
				$db->setQuery($sql);
				if(!$db->query()){
					$res = false;
				}
			}
		}
		//global $mainframe;
		$app = JFactory::getApplication();
		
		if($return = JRequest::getVar('return', '', 'method', 'base64')) {
			$return = base64_decode($return);
		}

		if($res){
			$reg->clear("tmp_profile");
		}
		
		return array("0"=>$res, "1"=>$user);
	}
	
	function update($id){
		$db = JFactory::getDBO();
		$data = JRequest::get('post');
		$data["full_bio"] = JRequest::getVar("full_bio","","post","string",JREQUEST_ALLOWRAW);
		
		$sql1 = "UPDATE `#__users` set `name`= '".$data["name"]."' WHERE id=".intval($id);
		$db->setQuery($sql1);
		$db->query();
		
		$sql = "UPDATE `#__guru_authors` set `full_bio`= '".addslashes($data["full_bio"])."', `images`= '".$data["images"]."', `emaillink`='".$data["emaillink"]."', `website`='".$data["website"]."', `blog`='".$data["blog"]."', `facebook`='".$data["facebook"]."', `twitter`='".$data["twitter"]."', `show_email`= '".$data["show_email"]."', `show_website`='".$data["show_website"]."' , `show_blog`='".$data["show_blog"]."', `show_facebook`='".$data["show_facebook"]."', `show_twitter`='".$data["show_twitter"]."', `author_title`='".$data["author_title"]."', `ordering`= '".$data["ordering"]."' WHERE userid=".intval($id);
		$db->setQuery($sql);
		if(!$db->query()){
			$res = false;
		}
		else{
			$res = true;
		}
		return $res;
	}
	
	function existCustomer($id){
		$db = JFactory::getDBO();
		$sql = "select count(*) from #__guru_customer where id=".intval($id);
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function existAuthor($id){
		$db = JFactory::getDBO();
		$sql = "select count(*) from #__guru_authors where userid=".intval($id);
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadColumn();
		if($result[0] > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function addToGroup($user_id){
		$db = JFactory::getDBO();
		$group_id = "";
		
		$studentpage = JRequest::getVar("studentpage", "");
		
		if($studentpage == "studentpage"){
			$sql = "select `student_group` from #__guru_config where id=1";
			$db->setQuery($sql);
			$db->query();
			$group_id = $db->loadResult();
		}
		else{
			$sql = "select `st_authorpage` from #__guru_config where id=1";
			$db->setQuery($sql);
			$db->query();
			$st_authorpage = $db->loadColumn();
			$st_authorpage = json_decode($st_authorpage["0"], true);
			$group_id = $st_authorpage["teacher_group"];
		}
		
		$sql = "insert into #__user_usergroup_map(`user_id`, `group_id`) values('".$user_id."', '".$group_id."')";
		$db->setQuery($sql);
		$db->query();
		
	}
	function getConfigs(){
		$db = JFactory::getDBO();
		$sql = "select * from #__guru_config";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadAssocList();
		return $result;
	}
	function wasBuy($course_id, $user_id){
		$db = JFactory::getDBO();
		$sql = "select count(*) from #__guru_buy_courses where userid=".intval($user_id)." and course_id=".intval($course_id);
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		if($result == "0"){
			return false;
		}
		return true;
	}
	
};
?>