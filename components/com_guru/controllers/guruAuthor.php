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


jimport ('joomla.application.component.controller');

class guruControllerguruAuthor extends guruController {
	var $_model = null;
	
	function __construct () {
		parent::__construct();
		$this->registerTask ("", "getAuthorList");
		$this->registerTask ("author", "getAuthor");
		$this->registerTask("authorprofile", "authorProfile");
		$this->registerTask("authormycourses", "authorMycourses");
		$this->registerTask("authormymedia", "authorMymedia");
		$this->registerTask("authorcommissions", "authorCommissions");
		$this->registerTask("treeCourse", "authorTreeCourses");
		$this->registerTask("mystudents", "myStudents");
		$this->registerTask("authorregister", "authorRegister");
		$this->registerTask("authorquizzes", "authorquizzes");
		$this->registerTask("removeCourse", "removeCourses");
		$this->registerTask("removeMedia", "removeMedia");
		$this->registerTask("addCourse", "addCourse");
		$this->registerTask("newStudent", "newStudent");
		$this->registerTask("duplicateCourse", "duplicateCourse");
		$this->registerTask("unpublishCourse", "unpublishCourse");
		$this->registerTask("publishCourse", "publishCourse");
		$this->registerTask("unpublishMedia", "unpublishMedia");
		$this->registerTask("publishMedia", "publishMedia");
		$this->registerTask("newmodule", "newModule");
		$this->registerTask("save_new_module", "saveNewModule");
		$this->registerTask("save_module", "saveModule");
		$this->registerTask("edit", "edit");
		$this->registerTask("editsbox", "editsbox");
		$this->registerTask("preview", "preview");
		$this->registerTask("duplicateMedia", "duplicateMedia");
		$this->registerTask("editMedia", "editMedia");
		$this->registerTask("authormymediacategories", "authormymediacategories");
		$this->registerTask("authoraddeditmediacat", "authoraddeditmediacat");
		$this->registerTask("unpublishMediaCat", "unpublishMediaCat");
		$this->registerTask("publishMediaCat", "publishMediaCat");
		$this->registerTask("removeMediaCat", "removeMediaCat");
		$this->registerTask("apply_media", "applyMedia");
		$this->registerTask("save_media", "saveMedia");
		$this->registerTask("savesbox", "savesbox");
		$this->registerTask("applymediacat", "applyMediaCat");
		$this->registerTask("savemediacat", "saveMediaCat");
		$this->registerTask("duplicateMediaCat", "duplicateMediaCat");
		$this->registerTask("saveLesson", "saveLesson");
		$this->registerTask("applyLesson", "applyLesson");
		$this->registerTask("editQuiz", "editQuiz");
		$this->registerTask("save_quiz", "saveQuiz");
		$this->registerTask("addquestion", "addQuestion");
		$this->registerTask("savequestion", "saveQuestion");
		$this->registerTask("editquestion", "editQuestion");
		$this->registerTask("jumpbts_save", "saveJump");
		$this->registerTask("publish_quiz", "publishQuiz");
		$this->registerTask("unpublish_quiz", "unpublishQuiz");
		$this->registerTask("editsboxx", "editsboxx");
		$this->registerTask("removeQuiz", "removeQuiz");
		$this->registerTask("course_stats", "courseStats");
		$this->registerTask("quizz_stats", "quizzStats");
		$this->registerTask("duplicateQuiz", "duplicateQuiz");
		$this->registerTask("editQuizFE", "editQuizFE");
		$this->registerTask("apply_quizFE", "applyQuizFE");
		$this->registerTask("save_quizFE", "saveQuizFE");
		$this->registerTask("addquizzes", "addQuizzes");
		$this->registerTask("save", "save");
		$this->registerTask("addexercise", "addexercise");
		$this->registerTask ("saveOrderQuestions", "saveOrderQuestions");
		$this->registerTask ("saveOrderExercices", "saveOrderExercices");
		$this->registerTask ("studentdetails", "studentdetails");
		$this->registerTask ("studentdetailslesson", "studentdetailslesson");
		$this->registerTask ("studentquizes", "studentquizes");
		$this->registerTask ("quizdetails", "quizdetails");
		$this->registerTask ("student_quizdetails", "student_quizdetails");
		$this->registerTask("terms", "terms");
		$this->registerTask("action", "action");
		$this->registerTask("apply_commissions", "applyCommissions");
		$this->registerTask("paid_commission", "paidCommission");
		$this->registerTask("pending_commission", "pendingCommission");
		$this->registerTask("details_paid", "detailsPaid");
		$this->registerTask("upload_ajax_image", "uploadAjaxImage");
		$this->registerTask("pub_unpub_ajax", "pubUnpubAjax");
		$this->registerTask("publish_quiz_ajax", "publishQuizAjax");
		$this->registerTask("unpublish_quiz_ajax", "unpublishQuizAjax");
		$this->registerTask("delete_quiz_ajax", "deleteQuizAjax");
		$this->registerTask("add_quizz_ajax", "addQuizzAjax");
		$this->registerTask("add_text_ajax", "addTextAjax");
		$this->registerTask("delete_final_quizz_ajax", "deleteFinalQuizzAjax");
		$this->registerTask("delete_group_ajax", "deleteGroupAjax");
		$this->registerTask("delete_screen_ajax", "deleteScreenAjax");
		$this->registerTask("saveOrderG", "saveOrderG");
		$this->registerTask("saveOrderS", "saveOrderS");
		$this->registerTask("add_media_ajax", "addMediaAjax");
		$this->registerTask("applyquizdetails", "applyquizdetails");
		$this->registerTask("savequizdetails", "savequizdetails");
		$this->registerTask("authorregistration", "authorRegistration");
		$this->registerTask("studentregistration", "stundetRegistration");
		$this->registerTask("mark", "mark");
		$this->registerTask("export_csv", "exportCsv");
		$this->registerTask("export_pdf", "exportPdf");
		
		$this->_model = $this->getModel("guruauthor");
	}
	
	function getAuthorList(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setModel($this->_model, true);
		parent::display();
	}
	
	function action(){
		$return = $this->_model->action();
		JRequest::setVar("action", "0");
		$pid = JRequest::getVar("pid", "0");
		$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruauthor&task=treeCourse&pid=".intval($pid)));
	}
	
	function removeCourses(){
		$Itemid = JRequest::getVar("Itemid", "0");
		if(!$this->_model->delete()){
			$msg = JText::_('GURU_COURSE_NOT_REMOVED');
		}
		else{
		 	$msg = JText::_('GURU_COURSE_REMOVED');
		}

		$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses&Itemid=".$Itemid;
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	function removeMedia(){
		$Itemid = JRequest::getVar("Itemid", "0");
		if(!$this->_model->deleteMedia()){
			$msg = JText::_('GURU_MEDIA_NOT_REMOVED');
		}
		else{
		 	$msg = JText::_('GURU_MEDIA_REMOVED');
		}

		$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia&Itemid=".$Itemid;
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	function removeMediaCat(){
		$Itemid = JRequest::getVar("Itemid", "0");
		if(!$this->_model->removeMediaCat()){
			$msg = JText::_('GURU_MEDIACAT_NOT_REMOVED');
		}
		else{
		 	$msg = JText::_('GURU_MEDIACAT_REMOVED');
		}

		$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories&Itemid=".$Itemid;
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	function removeQuiz(){
		$Itemid = JRequest::getVar("Itemid", "0");
		if(!$this->_model->removeQuiz()){
			$msg = JText::_('GURU_QUIZ_NOT_REMOVED');
		}
		else{
		 	$msg = JText::_('GURU_QUIZ_REMOVED');
		}
		$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes&Itemid=".$Itemid;
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	function getAuthor(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("view");
		$view->setModel($this->_model, true);
		$view->view();
	}
	function authorProfile(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile"."&Itemid=".$Itemid, false));
			return true;
		}
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruauthor", "html");
			$view->setLayout("authorprofile");
			$view->setModel($this->_model, true);
			$view->authorprofile();
		}
	}
	function myStudents(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=mystudents"."&Itemid=".$Itemid, false));
			return true;
		}
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruauthor", "html");
			$view->setLayout("mystudents");
			$view->setModel($this->_model, true);
			$view->mystudents();
		}
	}
	
	function authorMymedia(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		        
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authormymedia"."&Itemid=".$Itemid, false));
			return true;
		}
		
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruAuthor", "html");
			$view->setLayout("authormymedia");
			$view->setModel($this->_model, true);
			$view->authormymedia();
		}
	}
	
	function authorCommissions(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		        
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorcommissions"."&Itemid=".$Itemid, false));
			return true;
		}
		
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruAuthor", "html");
			$view->setLayout("authorcommissions");
			$view->setModel($this->_model, true);
			$view->authorcommissions();
		}
	}
	function paidCommission(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("authorcommissions_paid");
		$view->setModel($this->_model, true);
		$view->authorcommissions_paid();
	}
	function pendingCommission(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("authorcommissions_pending");
		$view->setModel($this->_model, true);
		$view->authorcommissions_pending();
	}	
	
	function detailsPaid(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("authorcommissions_details_paid");
		$view->setModel($this->_model, true);
		$view->authorcommissions_details_paid();
	}
	
	function authormymediacategories(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authormymediacategories"."&Itemid=".$Itemid, false));
			return true;
		}
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruAuthor", "html");
			$view->setLayout("authormymediacategories");
			$view->setModel($this->_model, true);
			$view->authormymediacategories();
		}
	}
	
	function authorTreeCourses(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=mystudents"."&Itemid=".$Itemid, false));
			return true;
		}
		else{
			$view = $this->getView("guruauthor", "html");
			$view->setLayout("authortreecourse");
			$view->setModel($this->_model, true);
			$view->authortreecourse();
		}
	}
	
	function newStudent(){
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("newstudent");
		$view->setModel($this->_model, true);
		$view->newstudent();
	}
	
	function authorQuizzes(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorquizzes"."&Itemid=".$Itemid, false));
			return true;
		}
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruauthor", "html");
			$view->setLayout("authorquizzes");
			$view->setModel($this->_model, true);
			$view->authorquizzes();
		}
	}
	function authorMycourses(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		$model = $this->getModel("guruAuthor");
        $res = $model->checkAuthorProfile($user_id);
		$res_enabled = $model->checkAuthorProfileEnabled($user_id);
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authormycourses"."&Itemid=".$Itemid, false));
			return true;
		}
		if($res === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS").'</p>
					  </div>';
			return true;
        }
		elseif($res_enabled === FALSE){
			echo '<div class="alert alert-error">
						<h4 class="alert-heading">Message</h4>
						<p>'.JText::_("GURU_ONLY_AUTHORS_ENABLED").'</p>
					  </div>';
			return true;
		}
		else{
			$view = $this->getView("guruauthor", "html");
			$view->setLayout("authormycourses");
			$view->setModel($this->_model, true);
			$view->authormycourses();
		}
	}
	function authorRegister(){
		$view = $this->getView("guruauthor", "html");
        $view->setLayout("authorprofile");
		$view->setModel($this->_model, true);
        $view->authorprofile();
	}
	function addCourse(){
		$view = $this->getView("guruauthor", "html");
        $view->setLayout("authoraddcourse");
		$view->setModel($this->_model, true);
        $view->authoraddcourse();
	}
	
	function authoraddeditmediacat(){
		$view = $this->getView("guruauthor", "html");
        $view->setLayout("authoraddeditmediacat");
		$view->setModel($this->_model, true);
        $view->authoraddeditmediacat();
	
	}	
	
	function save(){
		$come_from =  JRequest::getVar("g_page");
		$msg = "";
		$link = "";
		
		if($come_from == "courseadd"){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			if($this->_model->store()){
				$msg = JText::_('GURU_COURSE_SAVED_SUCCESSFULLY');
			} 
			else{
				$msg = JText::_('GURU_COURSE_SAVED_UNSUCCESSFULLY');
			}
		}
		elseif($come_from == "courseedit"){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			if($this->_model->store()){
				$msg = JText::_('GURU_COURSE_SAVED_SUCCESSFULLY');
			} 
			else{
				$msg = JText::_('GURU_COURSE_SAVED_UNSUCCESSFULLY');
			}
		}
		else{
			if($this->_model->store()){
				$msg = JText::_('GURU_CUST_SAVED');
			} 
			else{
				$msg = JText::_('GURU_CUST_SAVEFAIL');
			}
			$link = "index.php?option=com_guru&view=guruauthor&task=mystudents&layout=mystudents";
		}
		
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	
	function apply(){
		$come_from =  JRequest::getVar("g_page");
		$result = $this->_model->store();
		$userId = $result["id"];
		$msg = "";
		if($come_from == "courseadd"){
			$link = "index.php?option=com_guru&view=guruauthor&task=addCourse&id=".intval($result["id"]);
			if(intval($result["id"]) !=0){
				$msg = JText::_('GURU_COURSE_SAVED_SUCCESSFULLY');
			} 
			else{
				$msg = JText::_('GURU_COURSE_SAVED_UNSUCCESSFULLY');
			}
		}
		elseif($come_from == "courseedit" ){
			$link = "index.php?option=com_guru&view=guruauthor&task=addCourse&id=".intval($result["id"]);
			if(intval($result["id"]) !=0){
				$msg = JText::_('GURU_COURSE_SAVED_SUCCESSFULLY');
			} 
			else{
				$msg = JText::_('GURU_COURSE_SAVED_UNSUCCESSFULLY');
			}
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=newStudent&layout=newStudent&id=".intval($result["id"]);
			if(isset($result["error"]) && $result["error"] === TRUE){
				$msg = JText::_('GURU_CUST_APPLY');
			} 
			elseif(isset($result["error"]) && $result["error"] === FALSE){
				$msg = JText::_('GURU_CUST_APPLYFAIL');
			}
		}
		
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	
	function duplicateCourse(){
		$result = $this->_model->duplicateCourse();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_DUPLICATE_COURSE_SUCCESSFULLY");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_DUPLICATE_COURSE_UNSUCCESSFULLY");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function unpublishCourse(){
		$result = $this->_model->unpublishCourse();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_UNPUBLISH_COURSE_SUCCESSFULLY");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_UNPUBLISH_COURSE_UNSUCCESSFULLY");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function publishCourse(){
		$result = $this->_model->publishCourse();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_PUBLISH_COURSE_SUCCESSFULLY");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormycourses&layout=authormycourses";
			$msg = JText::_("GURU_PUBLISH_COURSE_UNSUCCESSFULLY");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	function unpublishMedia(){
		$result = $this->_model->unpublishMedia();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
			$msg = JText::_("GURU_MEDIAUNPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
			$msg = JText::_("GURU_MEDIAPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function publishMedia(){
		$result = $this->_model->publishMedia();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
			$msg = JText::_("GURU_MEDIAPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
			$msg = JText::_("GURU_MEDIAUNPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function unpublishMediaCat(){
		$result = $this->_model->unpublishMediaCat();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_MEDIAUNPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_MEDIAPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function publishMediaCat(){
		$result = $this->_model->publishMediaCat();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_MEDIAPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_MEDIAUNPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	function unpublishQuiz(){
		$result = $this->_model->unpublishQuiz();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_QUIZUNPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_QUIZPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function publishQuiz(){
		$result = $this->_model->publishQuiz();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_QUIZPUB");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_QUIZUNPUB");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	function newModule(){
		JRequest::setVar ("hidemainmenu", 1);
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("newModule");
		$view->newModule();
	}
	
	function saveNewModule(){
		$pid = JRequest::getVar("pid", "0");
		if($this->_model->store_new_module()){
			$msg = JText::_('GURU_DAY_SAVE');
			$_SESSION["saved_new"] = 1;
		}
		else{
			$msg = JText::_('GURU_DAY_NOTSAVE');
		}
		echo "	<script> 
					window.parent.location.href=\"".JURI::base()."index.php?option=com_guru&view=guruauthor&task=treeCourse&pid=".$pid."\";
					window.parent.document.getElementById('close').click();
				</script>";
	}
	
	function saveModule(){
		$pid = JRequest::getVar("pid", "0");
		if($this->_model->store_module()){
			$msg = JText::_('GURU_DAY_SAVE');
			$_SESSION["saved_new"] = 1;
		}
		else{
			$msg = JText::_('GURU_DAY_NOTSAVE');
		}
		echo "	<script> 
					window.parent.location.href=\"".JURI::base()."index.php?option=com_guru&view=guruauthor&task=treeCourse&pid=".$pid."\";
					window.parent.document.getElementById('close').click();
				</script>";
	}
	
	function edit(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editForm");
		$view->setModel($this->_model, true);
	
		$model = $this->getModel("guruAuthor");
		$view->setModel($model);
		$view->editForm();
	}
	
	function vimeo() {
   		JRequest::setVar('view', 'guruAuthor');
		JRequest::setVar('layout', 'vimeo');
        $view = $this->getView("guruAuthor", "html");
		$view->setLayout("vimeo");
        $view->vimeo();
        die();
    }
	function preview(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("preview");
		$view->setModel($this->_model, true);
		$view->preview();
	}
	
	function editsbox(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editformsbox");
		$view->setModel($this->_model, true);
		$view->editLessonForm();
	}
	
	function addmedia(){
		JRequest::setVar ("hidemainmenu", 1); 
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addmedia");
		$view->setModel($this->_model, true);
		$view->addmedia();
	}
	
	function addexercise(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addexercise");
		$view->setModel($this->_model, true);
		$view->addexercise();
	}
	
	function addQuiz(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addquiz");
		$view->setModel($this->_model, true);
		$view->addQuiz();
	}
	
	function addtext(){
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addtext");
		$view->setModel($this->_model, true);
		$view->addmedia();
	}
	
	function duplicateMedia(){ 
		$res = $this->_model->duplicateMedia();
		if($res == 1){
			$msg = JText::_('GURU_MEDIA_DUPLICATE_SUCC');
		}
		else{
			$msg = JText::_('GURU_MEDIA_DUPLICATE_ERR');
		}
		
		$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
		$this->setRedirect(JRoute::_($link, false), $msg);
	}
	
	function editMedia(){
		$redirect_to= JRequest::getVar('redirect_to',NULL,"post","string");
		$type		= JRequest::getVar('type',"","post","string");
		
		if(isset($redirect_to)) {
			$_SESSION['temp_type']=$type;
			$msg=NULL;
			$this->setRedirect(JRoute::_($redirect_to, false), $msg);			
		}	
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editmedia");
		$view->setModel($this->_model, true);
		$view->editMediaForm();
	}
	
	function saveMedia(){
		if($id = $this->_model->storeMedia()){
			$msg = JText::_('GURU_MEDIASAVED');
		} 
		else{
			if($_SESSION["isempty"] == 1){
				$msg = JText::_('GURU_MEDIASAVEDFAILED_TEXTEMPTY');
				unset($_SESSION["isempty"]);
			}
			else{
				$msg = JText::_('GURU_MEDIASAVEDFAILED');
				if($_SESSION["nosize"] == 0){
				$msg = $msg.JText::_('GURU_MEDIASAVEDSIZE');
				$n='warning';
				}
				unset($_SESSION["nosize"]);
			}	
		}
		$link = "index.php?option=com_guru&view=guruauthor&task=authormymedia&layout=authormymedia";
		$this->setRedirect(JRoute::_($link, false), $msg, $n);
	}
	
	function applyMedia(){
		$id = JRequest::getVar("id","0","post","int");
		if($this->_model->storeMedia()){
			$msg = JText::_('GURU_MEDIAAPPLY');
		} 
		else{
			if($_SESSION["isempty"] == 1){
				$msg = JText::_('GURU_MEDIASAVEDFAILED_TEXTEMPTY');
				unset($_SESSION["isempty"]);
			}
			else{
				$msg = JText::_('GURU_MEDIAAPPLYFAILED');
				if($_SESSION["nosize"] == 0){
				$msg = $msg.JText::_('GURU_MEDIASAVEDSIZE');
				$n='warning';
				}
				unset($_SESSION["nosize"]);
			}	
		}
		
		if($id != 0){
			$link = "index.php?option=com_guru&view=guruauthor&task=editMedia&cid=".intval($id);
		} 
		else{
			$last_media = $this->_model->last_media();
			$link = "index.php?option=com_guru&view=guruauthor&task=editMedia&cid=".$last_media;
		}
		$this->setRedirect(JRoute::_($link, false), $msg,$n);
	}
	
	function savesbox(){
		JRequest::setVar ("hidemainmenu", 1);
		JRequest::setVar ("tmpl", "component");
		$id				= JRequest::getVar("id","0","post","int");
		$mediatext		= JRequest::getVar('mediatext','','post','string');
		$mediatextvalue	= JRequest::getVar('mediatextvalue','','post','string');
		$screen			= JRequest::getVar('screen', '0');
		
		$action = JRequest::getVar("action", "");
		
		if($action == "addtext" || $action == "addmedia"){
			$screen = "1";
		}
		
		if($id==0){
			if((($mediatext!="") && ($mediatextvalue!="") && ($screen!="")) || ($screen=="0")){				
				if($id=$this->_model->storeMedia()){
					?>
					<script type="text/javascript" src="<?php echo JURI::root().'media/system/js/mootools.js' ?>"></script>
								
					<script type="text/javascript">
					
						function loadjscssfile(filename, filetype){
							if (filetype=="js"){ //if filename is a external JavaScript file
								var fileref=document.createElement('script')
							  	fileref.setAttribute("type","text/javascript")
							  	fileref.setAttribute("src", filename)
							}
							else if (filetype=="css"){ //if filename is an external CSS file
								var fileref=document.createElement("link")
								fileref.setAttribute("rel", "stylesheet")
								fileref.setAttribute("type", "text/css")
								fileref.setAttribute("href", filename)
							}
								if (typeof fileref!="undefined")
								document.getElementsByTagName("head")[0].appendChild(fileref)
						}
								
						function loadprototipe(){
							loadjscssfile("<?php echo JURI::base().'components/com_guru/views/guruauthor/tmpl/prototype-1.6.0.2.js' ?>","js");
						//alert('testing');
						}
								
						function addmedia (idu, name, description) {
						<?php if($screen != "0"){ ?>
							jQuery.ajax({
								<?php
									if($mediatext=='med'){
										echo "url: 'index.php?option=com_guru&controller=guruAuthor&tmpl=component&format=raw&task=add_media_ajax&id='+idu,";
									}
									else{
										echo "url: 'index.php?option=com_guru&controller=guruAuthor&tmpl=component&format=raw&task=add_text_ajax&id='+idu,";
									}
								?>
								cache: false
							})
							.done(function(transport) {
								replace_m = <?php echo $mediatextvalue;?>;
								to_be_replaced = parent.document.getElementById('<?php if($mediatext=='med') { echo "media";} else { echo "text";} ?>_'+replace_m);
								to_be_replaced.innerHTML = '&nbsp;';
								if ((transport.match(/(.*?).pdf(.*?)/))&&(!transport.match(/(.*?).iframe(.*?)/))) {
									to_be_replaced.innerHTML += transport+'<p /><div  style="text-align:center"><i>' + description + '</i></div>'; 
								} 
								else {
									to_be_replaced.innerHTML += transport+'<br /><div style="text-align:center"><i>'+ name +'</i></div><br /><div  style="text-align:center"><i>' + description + '</i></div>';
								}
								
								parent.document.getElementById('before_menu_<?php if($mediatext=='med') { echo "med";} else { echo "txt";} ?>_'+replace_m).style.display = 'none';
								parent.document.getElementById('after_menu_<?php if($mediatext=='med') { echo "med";} else { echo "txt";} ?>_'+replace_m).style.display = '';
								parent.document.getElementById('db_<?php if($mediatext=='med') { echo "media";} else { echo "text";} ?>_'+replace_m).value = idu;
								
								screen_id = <?php echo $screen; ?>;
								
								replace_edit_link = parent.document.getElementById('a_edit_<?php if($mediatext=='med') { echo "media";} else { echo "text";} ?>_'+replace_m);
								replace_edit_link.href = 'index.php?option=com_guru&controller=guruAuthor&tmpl=component&task=editsboxx&cid='+ idu +'&scr=' + screen_id;
								if ((transport.match(/(.*?).pdf(.*?)/))&&(!transport.match(/(.*?).iframe(.*?)/))) {
									var qwe='&nbsp;'+transport+'<p /><div  style="text-align:center"><i>' + description + '</i></div>';
								} 
								else {
									var qwe='&nbsp;'+transport+'<br /><div style="text-align:center"><i>'+ name +'</i></div><div  style="text-align:center"><i>' + description + '</i></div>';
								}
								window.parent.<?php if($mediatext=='med') { echo "";} else { echo "tx";} ?>test(replace_m, idu, qwe);
							});
						<?php } 
							else { 
						// for adding sound ?>
							jQuery.ajax({
								url :'index.php?option=com_guru&controller=guruAuthor&tmpl=component&format=raw&task=add_media_ajax&id='+idu;
								cache: false
							})
							.done(function(transport) {
								replace_m = "99";
								to_be_replaced = parent.document.getElementById('media_'+replace_m);
								to_be_replaced.innerHTML = '&nbsp;';
								
								if(replace_m!=99){
									if ((transport.match(/(.*?).pdf(.*?)/))&&(!transport.match(/(.*?).iframe(.*?)/))) {
										to_be_replaced.innerHTML += transport+'<p /><div  style="text-align:center"><i>' + description + '</i></div>'; 
									} 
									else {
										to_be_replaced.innerHTML += transport+'<br /><div style="text-align:center"><i>'+ name +'</i></div><br /><div  style="text-align:center"><i>' + description + '</i></div>';
									}
								} 
								else {
									to_be_replaced.innerHTML += transport;
									parent.document.getElementById("media_"+99).style.display="";
									parent.document.getElementById("description_med_99").innerHTML=''+name;
								}
								parent.document.getElementById('before_menu_med_'+replace_m).style.display = 'none';
								parent.document.getElementById('after_menu_med_'+replace_m).style.display = '';
								parent.document.getElementById('db_media_'+replace_m).value = idu;
								
								screen_id = document.getElementById('the_screen_id').value;
								replace_edit_link = parent.document.getElementById('a_edit_media_'+replace_m);
								replace_edit_link.href = 'index.php?option=com_guru&controller=guruAuthor&tmpl=component&task=editsboxx&cid='+ idu+"&scr="+replace_m;
								if ((transport.match(/(.*?).pdf(.*?)/))&&(!transport.match(/(.*?).iframe(.*?)/))) {
									var qwe='&nbsp;'+transport+'<p /><div  style="text-align:center"><i>' + description + '</i></div>';
								} 
								else {
									var qwe='&nbsp;'+transport+'<br /><div style="text-align:center"><i>'+ name +'</i></div><div  style="text-align:center"><i>' + description + '</i></div>';
								}
								window.parent.test(replace_m, idu, '<span class="success-add-media"><?php echo JText::_("GURU_SUCCESSFULLY_ADED_MEDIA"); ?></span>');
							});
						<?php }?>
							//window.parent.close_modal();
							setTimeout('window.parent.document.getElementById("close").click()',1000);
							//window.parent.SqueezeBox.close();						
							return true;						
						}				
					</script>
                    					
					<?php
					
					$current_media = $this->_model->getMediaInfo($id);
					
					if($screen=="0"){
						echo '<script type="text/javascript">window.onload=function(){
						loadprototipe();
						var t=setTimeout(\'addmedia('.$id.', "'.addslashes(trim($current_media->name)).'", "-", "");\',1000);						
						}</script>';
					}
					else{
						echo '<script type="text/javascript">window.onload=function(){
						loadprototipe();
						var t=setTimeout(\'addmedia('.$id.', "'.addslashes(trim($current_media->name)).'", "'.$current_media->instructions.'");\',1000);						
						}</script>'; 
					}
					
							
					echo '<div style="padding:15px;"><strong>Media saved. Please wait...</strong></div>';
				}
			}		
		} 
		else{
			if($id = $this->_model->storeMedia()){
				$msg = JText::_('GURU_MEDIASAVED');
			} 
			else{
				$msg = JText::_('GURU_MEDIASAVEDFAILED');
			}

			echo '<script type="text/javascript">window.onload=function(){
				window.parent.page_refresh('.$screen.');
				var t=setTimeout(\'window.parent.SqueezeBox.close();\',0);
			}</script>';
			
			echo '<div style="padding:15px;"><strong>Media saved. Please wait...</strong></div>';
		}
	}
	function saveMediaCat(){
		if($id = $this->_model->storeMediaCat()){
			$msg = JText::_('GURU_MEDIAAPPLY');
		} 
		else{
			if($_SESSION["isempty"] == 1){
				$msg = JText::_('GURU_MEDIASAVEDFAILED_TEXTEMPTY');
				unset($_SESSION["isempty"]);
			}
			else{
				$msg = JText::_('CUSTSAVEFAILED');
				if($_SESSION["nosize"] == 0){
				$n='warning';
				}
				unset($_SESSION["nosize"]);
			}	
		}
		$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
		$this->setRedirect(JRoute::_($link, false), $msg, $n);
	}
	
	function applyMediaCat(){
		$id = JRequest::getVar("id","0");
		$return = $this->_model->storeMediaCat();
		if($return["0"]){
			$msg = JText::_('GURU_MEDIAAPPLY');
		} 
		else{
			if($_SESSION["isempty"] == 1){
				$msg = JText::_('GURU_MEDIASAVEDFAILED_TEXTEMPTY');
				unset($_SESSION["isempty"]);
			}
			else{
				$msg = JText::_('GURU_MEDIAAPPLYFAILED');
				if($_SESSION["nosize"] == 0){
				$msg = $msg.JText::_('GURU_MEDIASAVEDSIZE');
				$n='warning';
				}
				unset($_SESSION["nosize"]);
			}	
		}
		
		if($id != 0){
			$link = "index.php?option=com_guru&view=guruauthor&task=authoraddeditmediacat&id=".intval($id);
		} 
		else{
			$last_media = $return["1"];
			$link = "index.php?option=com_guru&view=guruauthor&task=authoraddeditmediacat&id=".intval($last_media);
		}
		$this->setRedirect(JRoute::_($link, false), $msg,$n);
	}
	
	function duplicateMediaCat(){
		$result = $this->_model->duplicateMediaCat();
		
		$type = "message";
		if($result){
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_DUPLICATE_CATEG_SUCCESSFULLY");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authormymediacategories&layout=authormymediacategories";
			$msg = JText::_("GURU_DUPLICATE_CATEG_UNSUCCESSFULLY");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}

	function applyLesson(){
		$task = JRequest::getVar("task", "");
		$return = $this->_model->storeLesson();
		if($return["return"] === TRUE){
			$msg = JText::_('GURU_TASKS_SAVED');
		} else {
			$msg = JText::_('GURU_TASKS_NOTSAVED');
		}
		$id = JRequest::getVar("id", "");
		$module = JRequest::getVar("module","");
		if($id == ""){
			$id = $return["id"];
		}
		$progrid=JRequest::getVar("day", "");
		$link ="index.php?option=com_guru&view=guruauthor&tmpl=component&task=editsbox&cid=".$id."&progrid=".$progrid."&module=".intval($module);	
		$this->setRedirect(JURI::root().$link);
	}
	
	function saveLesson(){
		JRequest::setVar ("hidemainmenu", 1);
		JRequest::setVar ("tmpl", "component");	
		$return = $this->_model->storeLesson();
		
		if($return["return"] === TRUE){
			$msg = JText::_('GURU_TASKS_SAVED');
		} 
		else{
			$msg = JText::_('GURU_TASKS_NOTSAVED');
		}

		echo '<style>.page-title{display:none;} .guru-content{padding:10px;}</style>';
		echo "Step saved. Please wait...";
		echo '<script type="text/javascript">window.onload=function(){
			window.parent.location.reload(true);
			}</script>';
	}
	
	function editQuiz(){
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile"."&Itemid=".$Itemid, false));
			return true;
		}
		
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editQuiz");
		$view->setModel($this->_model, true);
		$view->editQuiz();
	}
	
	function editQuizFE(){
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile"."&Itemid=".$Itemid, false));
			return true;
		}
		
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editquizfe");
		$view->setModel($this->_model, true);
		$view->editQuizFE();
	}
	
	function mark(){
		$user = JFactory::getUser();
		$user_id = $user->id;
		
		if($user_id == "0"){		
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile"."&Itemid=".$Itemid, false));
			return true;
		}
		
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("mark");
		$view->setModel($this->_model, true);
		$view->mark();
	}
	
	function saveQuiz(){
		JRequest::setVar("hidemainmenu", 1);
		JRequest::setVar("tmpl", "component");
		$id	= JRequest::getVar("id", "0");
		$screen	= 12;
		
		?>
        <script language="javascript" type="text/javascript">	
			function loadjscssfile(filename, filetype){
				if (filetype=="js"){ //if filename is a external JavaScript file
					var fileref=document.createElement('script')
					fileref.setAttribute("type","text/javascript")
					fileref.setAttribute("src", filename)
				}
				else if (filetype=="css"){ //if filename is an external CSS file
					var fileref=document.createElement("link")
					fileref.setAttribute("rel", "stylesheet")
					fileref.setAttribute("type", "text/css")
					fileref.setAttribute("href", filename)
				}
				if (typeof fileref!="undefined"){
					document.getElementsByTagName("head")[0].appendChild(fileref);
				}
			}
		
			function loadprototipe(){
				loadjscssfile("<?php echo JURI::base().'components/com_guru/views/guruauthor/tmpl/prototype-1.6.0.2.js' ?>","js");
			}
		
			function addmedia (idu, name, asoc_file, description) {
				loadprototipe();
				jQuery.ajax({
					url: '<?php echo JURI::root(); ?>index.php?option=com_guru&controller=guruAuthor&tmpl=component&format=raw&task=add_quizz_ajax&id='+idu+'&type=quiz',
					cache: false
				})
				.done(function(transport) {
					to_be_replaced=parent.document.getElementById('media_15');
					replace_m=15;
					to_be_replaced.innerHTML = '&nbsp;';
			
					to_be_replaced.innerHTML += transport;
					parent.document.getElementById("media_"+99).style.display="";
					parent.document.getElementById("description_med_99").innerHTML=''+name;
						
					parent.document.getElementById('before_menu_med_'+replace_m).style.display = 'none';
					parent.document.getElementById('after_menu_med_'+replace_m).style.display = '';
					parent.document.getElementById('db_media_'+replace_m).value = idu;
					
					replace_edit_link = parent.document.getElementById('a_edit_media_'+replace_m);
					replace_edit_link.href = 'index.php?option=com_guru&controller=guruAuthor&tmpl=component&task=editQuiz&cid='+ idu;
					var qwe='&nbsp;'+transport+'<br /><div style="text-align:center"><i>'+ name +'</i></div><div  style="text-align:center"><i>' + description + '</i></div>';
							
					window.parent.test(replace_m, idu,qwe);
				});
				
				setTimeout('window.parent.document.getElementById("close").click()',1000);
				return true;
			}
		</script>
        <?php
		
		if($id==0){
			if($id=$this->_model->storeQuiz()){
				$quiz=$this->_model->getQuizById();
				echo '<script type="text/javascript">window.onload=function(){
					var t=setTimeout(\'addmedia('.$quiz->id.', "'.$quiz->name.'","-", "'.$quiz->description.'");\',1000);						
			}</script>';
			}		
		}
		else{
			if($id=$this->_model->storeQuiz()){
				$msg = JText::_('GURU_MEDIASAVED');
				$quiz=$this->_model->getQuizById();
				echo '<script type="text/javascript">window.onload=function(){
					var t=setTimeout(\'addmedia('.$quiz->id.', "'.$quiz->name.'","-", "'.$quiz->description.'");\',1000);						
			}</script>';
			}
			else {
				$msg = JText::_('GURU_MEDIASAVEDFAILED');
			}
			echo '<script type="text/javascript">window.onload=function(){
				var t=setTimeout(\'window.parent.document.getElementById("sbox-window").close();\',0);
				window.parent.page_refresh('.$screen.');
			}</script>';
		}
		echo '<strong>'.JText::_('GURU_QUIZSAVED_PLSWAIT').'</strong>';
	}
	
	function addQuestion(){
		JRequest::setVar("hidemainmenu", 1); 
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addquestion");
		$view->setModel($this->_model, true);
		$view->addQuestion();
	}
	
	function saveQuestion(){
		$qtext 	= JRequest::getVar('question_text','','post','string',JREQUEST_ALLOWRAW);
		$quizid = JRequest::getVar('quizid','0','post','int');
		$is_from_modal_lesson = JRequest::getVar('is_from_modal');
		$question_type = JRequest::getVar('type', "");
		$media_ids_question = JRequest::getVar('question_media_ids', "");
		$points = JRequest::getVar('question_weight_tf', "");
		$true_false_ch = JRequest::getVar('truefs_ans', "-1");
		$question_id = JRequest::getVar('question_id', "0");
		$from_save_or_not = "saveandclose";
		$ans_content = JRequest::getVar('ans_content','','post','string',JREQUEST_ALLOWRAW);
		

		$qid = $question_id;
		if(intval($qid) == 0){
			$this->_model->addquestion($qtext,$quizid,$question_type,$media_ids_question,$points, $true_false_ch,$question_id,$from_save_or_not, $ans_content);
		}
		else{
			$this->_model->updatequestion($qtext,$quizid,$question_type,$media_ids_question,$points, $true_false_ch,$question_id,$from_save_or_not, $ans_content);
		}
		$_SESSION["added_questions_tab"] = "1";

		if($quizid != 0){
			if($is_from_modal_lesson != 1){
				echo '<style>.page-title{display:none;} .guru-content{padding:10px;}</style>';
				echo "Saving question. Please wait...";
				echo '<script type="text/javascript">';
				
				echo 'if(window.parent.document.adminForm.name.value == ""){
						window.parent.location.reload();	
					  }
					  else{
						window.parent.document.adminForm.task.value = "apply_quizFE";
						window.parent.document.adminForm.submit();
					  }';
				echo '</script>';
			
			}
			else{
				echo '<style>.page-title{display:none;} .guru-content{padding:10px;}</style>';
				echo "Saving question. Please wait...";
				echo '<script type="text/javascript">';
				echo '	window.parent.location.reload();';
				echo '</script>';
			}
			die();
			
		}
		
		if($quizid == 0){
			if($is_from_modal_lesson != 1){
				echo '<style>.page-title{display:none;} .guru-content{padding:10px;}</style>';
				echo "Saving question. Please wait...";
				echo '<script type="text/javascript">';
				
				echo 'if(window.parent.document.adminForm.name.value == ""){
							window.parent.location.reload();	
					  }
					  else{
							window.parent.document.adminForm.task.value = "apply_quizFE";
							window.parent.document.adminForm.submit();
					  }';
				echo '</script>';
			
			}
			else{
				echo '<style>.page-title{display:none;} .guru-content{padding:10px;}</style>';
				echo "Saving question. Please wait...";
				echo '<script type="text/javascript">';
				echo '	window.parent.location.reload();';
				echo '</script>';
			}
			die();
		}
	}
	
	function editQuestion(){
		JRequest::setVar ("hidemainmenu", 1); 
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editquestion");
		$view->setModel($this->_model, true);
		$view->editQuestion();
	}
	
	function jumpbts(){
		JRequest::setVar ("hidemainmenu", 1); 
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("jumpbts");
		$view->setModel($this->_model, true);
		$view->jumpbts();
	}
	
	function saveJump(){
		JRequest::setVar ("hidemainmenu", 1);
		JRequest::setVar ("tmpl", "component");
		$pieces = $this->_model->saveJump();
		echo '<script type="text/javascript">window.onload=function(){
				window.parent.document.getElementById("close").click();
				window.parent.jump('.$pieces["1"].','.$pieces["0"].',"'.$pieces["2"].'");
			}</script>';
		echo '<strong>Jump saved. Please wait...</strong>';
	}
	
	function editsboxx(){
		JRequest::setVar ("hidemainmenu", 1);
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("editformsboxx");
		$view->setModel($this->_model, true);
		$view->editMediaForm();
	}
	
	function duplicateQuiz(){
		$result = $this->_model->duplicateQuiz();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_DUPLICATE_QUIZ_SUCCESSFULLY");
			$type = "message";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
			$msg = JText::_("GURU_DUPLICATE_QUIZ_UNSUCCESSFULLY");
			$type = "error";
		}
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function courseStats(){
		JRequest::setVar ("hidemainmenu", 1);
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("coursestats");
		$view->setModel($this->_model, true);
		$view->courseStats();
	}
	
	function quizzStats(){
		JRequest::setVar ("hidemainmenu", 1);
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("quizzstats");
		$view->setModel($this->_model, true);
		$view->quizzStats();
	}
	
	function saveQuizFE(){
		if($id = $this->_model->storeQuiz()){
			$msg = JText::_('GURU_QUIZSAVED');
		} 
		else{
			$msg = JText::_('GURU_QUIZ_NOT_SAVED');
		}
		$link = "index.php?option=com_guru&view=guruauthor&task=authorquizzes&layout=authorquizzes";
		$this->setRedirect(JRoute::_($link), $msg);
	}

	function applyQuizFE(){
		$id = JRequest::getVar("id", "0");
		if($this->_model->storeQuiz()){
			$msg = JText::_('GURU_QUIZSAVED');
		}
		else{
			$msg = JText::_('GURU_QUIZ_NOT_SAVED');
		}
		
		$valueop = JRequest::get('post');
		if($id == 0){
			$db = JFactory::getDBO();
			$sql = "SELECT max(id) FROM `#__guru_quiz` ";
			$db->setQuery($sql);
			$new_quiz_id = $db->loadColumn();
			$id = $new_quiz_id["0"];
		}
		
		if($valueop['valueop'] == 1){
			$link = "index.php?option=com_guru&view=guruauthor&task=editQuizFE&cid=".intval($id)."&e=1";
		}
		else{
			$link = "index.php?option=com_guru&view=guruauthor&task=editQuizFE&cid=".intval($id);
		}
		$this->setRedirect(JRoute::_($link), $msg);
	}
	
	function saveQuestionandkeep(){
		$qtext 	= JRequest::getVar('question_text','','post','string',JREQUEST_ALLOWRAW);
		$quizid = JRequest::getVar('quizid','0','post','int');
		$is_from_modal_lesson = JRequest::getVar('is_from_modal');
		$question_type = JRequest::getVar('type', "");
		$media_ids_question = JRequest::getVar('question_media_ids', "");
		$points = JRequest::getVar('question_weight_tf', "");
		$true_false_ch = JRequest::getVar('truefs_ans', "-1");
		$question_id = JRequest::getVar('question_id', "0");
		$ans_content = JRequest::getVar('ans_content','','post','string',JREQUEST_ALLOWRAW);
		$from_save_or_not = "savekeep";
		
		$qid = $question_id;
		if(intval($qid) == 0){
			$return = $this->_model->addquestion($qtext,$quizid,$question_type,$media_ids_question,$points, $true_false_ch,$question_id,$from_save_or_not, $ans_content);
		}
		else{
			$return = $this->_model->updatequestion($qtext,$quizid,$question_type,$media_ids_question,$points, $true_false_ch,$question_id,$from_save_or_not, $ans_content);
		}
		$msg = JText::_('GURU_QUIZSAVED');
		$link ="index.php?option=com_guru&controller=guruAuthor&task=addquestion&tmpl=component&cid=".$quizid."&qid=".$return."&type=".$question_type;	
		$this->setRedirect($link, $msg);
	}
	function addquizzes(){
		JRequest::setVar("hidemainmenu", 1); 
		$view = $this->getView("guruAuthor", "html");
		$view->setLayout("addQuizzes");
		$view->setModel($this->_model, true);
		$view->addquizzes();
	}	
	function savequizzes(){
		$quizid = JRequest::getVar('quizid','0');
		$quizzes_ids = JRequest::getVar('quizzes_ids','0');
		
		$db = JFactory::getDBO();
		$sql = "select quizzes_ids from #__guru_quizzes_final where qid=".intval($quizid);
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadColumn();
		
		if(count($result) == 0){
			$sql = "INSERT INTO `#__guru_quizzes_final` (`quizzes_ids`,`qid`)VALUES('".$quizzes_ids."','".$quizid."' )"; 
			$db->setQuery($sql);
			$db->query();
		}
		else{
			$newvalues = @$result["0"].$quizzes_ids;
			$sql = "update #__guru_quizzes_final set quizzes_ids='".$newvalues."' where qid=".$quizid;
			$db->setQuery($sql);
			$db->query();
		}			
		
		$_SESSION["added_quiz"] = "1";
		
		if($quizid != 0){
			echo "Saving quizzes. Please wait...";
			echo '<script type="text/javascript">';
			echo 'if(window.parent.document.adminForm.name.value == ""){
						window.parent.location.reload();	
				  }
				  else{
						window.parent.document.adminForm.task.value = "apply_quizFE";
						window.parent.document.adminForm.submit();
				  }';
			echo '</script>';
			die();
		}
		
		if($quizid==0){
			echo "Saving quizzes. Please wait...";
			echo '<script type="text/javascript">';
			echo 'if(window.parent.document.adminForm.name.value == ""){
						window.parent.location.reload();	
				  }
				  else{
						window.parent.document.adminForm.task.value = "apply_quizFE";
						window.parent.document.adminForm.submit();
				  }';
			echo '</script>';
			die();
		}
	
	}
		
	public function saveOrderQuestions(){
		// Get the arrays from the Request
		$originalOrder = explode(',', $this->input->getString('original_order_values'));

		$model = $this->getModel("guruAuthor");
		// Save the ordering
		$return = $model->saveOrderQuest();
		if ($return){
			echo "1";
		}
		// Close the application
		JFactory::getApplication()->close();
	}

	public function saveOrderExercices(){
		// Get the arrays from the Request
		$originalOrder = explode(',', $this->input->getString('original_order_values'));

		$model = $this->getModel("guruAuthor");
		// Save the ordering
		$return = $model->saveorderFile();
		if ($return){
			echo "1";
		}
		// Close the application
		JFactory::getApplication()->close();
	}
	
	function studentdetails(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("studentdetails");
		$view->setModel($this->_model, true);
		$view->studentdetails();
	}
	
	function studentdetailslesson(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("studentdetailslesson");
		$view->setModel($this->_model, true);
		$view->studentdetailslesson();
	}
	
	function studentquizes(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("studentquizes");
		$view->setModel($this->_model, true);
		$view->studentquizes();
	}
	
	function quizdetails(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("quizdetails");
		$view->setModel($this->_model, true);
		$view->quizdetails();
	}
	
	function student_quizdetails(){
		JRequest::setVar ("view", "guruauthor");
		$view = $this->getView("guruauthor", "html");
		$view->setLayout("student_quizdetails");
		$view->setModel($this->_model, true);
		$view->student_quizdetails();
	}
	
	function terms(){
        $view = $this->getView("guruauthor", "html");
        $view->setLayout("terms");
        $view->terms();
    }
	function applyCommissions(){
		$result = $this->_model->applyCommissions();
		$type = "message";
		if($result === TRUE){
			$link = "index.php?option=com_guru&view=guruauthor&task=authorcommissions&layout=authorcommissions";
			$msg = JText::_("GURU_MODIF_OK");
			$type = "message";
		}		
		$this->setRedirect(JRoute::_($link, false), $msg, $type);
	}
	
	function uploadAjaxImage(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."helpers".DS."fileuploader.php");
		die();
	}
	
	function checkExistingUserU(){
		$database = JFactory::getDBO();
		$username = JRequest::getVar("username", "");
		$email = JRequest::getVar("email", "");
		$id = JRequest::getVar("id", "0");
		if(intval($id) == 0){// new user
			$sql = "select count(*) from #__users where `username`='".addslashes(trim($username))."'";
			$database->setQuery($sql);
			$database->query();
			$result = $database->loadResult();
	
			if($result > 0){
				echo "222";
				return true;
			}
			else{
				echo "333";
				return true;
			}
			die();
		}
		elseif(intval($id) != 0){
			$sql = "select `username`, `email` from #__users where id=".intval($id);
			$database->setQuery($sql);
			$database->query();
			$result = $database->loadAssocList();
			$old_username = $result["0"]["username"];
			$old_email = $result["0"]["email"];
			if($username != $old_username){
				$sql = "select count(*) from #__users where `username`='".addslashes(trim($username))."'";
				$database->setQuery($sql);
				$database->query();
				$result = $database->loadResult();
				if($result > 0){
					echo "222";
					return true;
				}
				die();
			}
		}
	}
	
	function checkExistingUserE(){	
		$database = JFactory::getDBO();
		$username = JRequest::getVar("username", "");
		$email = JRequest::getVar("email", "");
		$id = JRequest::getVar("id", "0");
		if(intval($id) == 0){// new user
			$sql = "select count(*) from #__users where `email`='".addslashes(trim($email))."'";
			$database->setQuery($sql);
			$database->query();
			$result = $database->loadResult();
			if($result > 0){
				echo "111";
				return true;
			}
			else{
				echo "222";
				return true;
			}
			
		}
		elseif(intval($id) != 0){
			$sql = "select `username`, `email` from #__users where id=".intval($id);
			$database->setQuery($sql);
			$database->query();
			$result = $database->loadAssocList();
			$old_username = $result["0"]["username"];
			$old_email = $result["0"]["email"];
			if($email != $old_email){
				$sql = "select count(*) from #__users where `email`='".addslashes(trim($email))."'";
				$database->setQuery($sql);
				$database->query();
				$result = $database->loadResult();
				if($result > 0){
					echo "111";
					return true;
				}
				die();
			}
		}
	}
	
	function pubUnpubAjax(){
		$db = JFactory::getDBO();		
		$id = JRequest::getVar("id");
		
		$sql = "select `published` from #__guru_media where id =".$id;
		$db->setQuery($sql);
		$db->query();
		$published = $db->loadColumn();
		$published = $published["0"];
		$ret = "";
		
		if($published){
			$sql = "update #__guru_media set published='0' where id =".$id;
			$ret = 'unpublish';
		}
		else{
			$ret = 'publish';
			$sql = "update #__guru_media set published='1' where id =".$id;
		}
		$db->setQuery($sql);
		if (!$db->query() ){
			$this->setError($db->getErrorMsg());
			return false;
		}
		echo $ret;
		die();
	}
	
	function publishQuizAjax(){
		$db = JFactory::getDBO();
		$v = JRequest::getVar("v", "0");
		$table = "#__guru_questions_v3";
		if($v == 1){
			$table = "#__guru_quiz";
		}
		
		$id = JRequest::getVar("id", "0");
		$sql = "update ".$table." set `published`='1' where `id`=".intval($_REQUEST['id']);
		$db->setQuery($sql);
		if(!$db->query()){
			return false;
		}
		return true;
		die();
	}
	
	function unpublishQuizAjax(){
		$db = JFactory::getDBO();
		$v = JRequest::getVar("v", "0");
		$table = "#__guru_questions_v3";
		if($v == 1){
			$table = "#__guru_quiz";
		}
		
		$id = JRequest::getVar("id", "0");
		$sql = "update ".$table." set `published`='0' where `id`=".intval($_REQUEST['id']);
		$db->setQuery($sql);
		if(!$db->query()){
			return false;
		}
		return true;
		die();
	}
	
	function deleteQuizAjax(){
		$db = JFactory::getDBO();
		$f = JRequest::getVar('f');
		$deleted = JRequest::getVar('deleted');
		$id = JRequest::getVar("id", "");
		
		if($f == 0){
			if(isset($id) && $id>0){ 
				$query = "DELETE FROM #__guru_questions_v3 WHERE id=".$deleted." and qid=".$id."";
				$db->setQuery($query);
				if($db->query()){
					echo "2";
				}
				else{
					echo $query;
				}
			}	
		}
		elseif($f == 1){
			$query = "select quizzes_ids from #__guru_quizzes_final where qid=".$id;
			$db->setQuery($query);
			$db->query();
			$result=$db->loadResult();
			$newvalues = str_replace(",".$deleted, "",$result );
		
			if(isset($id) && $id>0){ 
				$query = "update #__guru_quizzes_final set quizzes_ids='".$newvalues."' where qid=".$id;
				$db->setQuery($query);
				if($db->query()){
					echo "2";
				}
				else{
					echo $query;
				}
			}	
		}
	}
	
	function addQuizzAjax(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."views".DS."guruauthor".DS."tmpl".DS."ajaxAddMedia.php");
		die();
	}
	
	function addTextAjax(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."views".DS."guruauthor".DS."tmpl".DS."ajaxAddText.php");
		die();
	}
	
	function addMediaAjax(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."views".DS."guruauthor".DS."tmpl".DS."ajaxAddMedia.php");
		die();
	}
	
	function deleteFinalQuizzAjax(){
		$db = JFactory::getDBO();
		$course_id = JRequest::getVar("course_id", "0");
		
		$sql = "update #__guru_program set `id_final_exam`=0 where `id`=".intval($course_id);
		$db->setQuery($sql);
		if($db->query()){
			return true;
		}
		else{
			return false;
		}
		die();
	}
	
	function deleteGroupAjax(){
		$database = JFactory::getDBO();
		
		$sql = "SELECT imagesin FROM #__guru_config WHERE id ='1' ";
		$database->setQuery($sql);
		if (!$database->query()) {
			echo $database->stderr();
			return;
		}
		$imagesin = $database->loadResult();			
		
		$group_id = $_GET['group'];
		$cid = $group_id;
		
		$sql = " SELECT locked, ordering FROM #__guru_days WHERE id = ".$cid;
		$database->setQuery($sql);
		if (!$database->query()) {
			echo $database->stderr();
			return;
		}
		$locked_and_ordering = $database->loadObject();
		
		$locked = $locked_and_ordering->locked;
		$ordering = $locked_and_ordering->ordering;
			
		if ($locked==0) { // if locked=0
			// we delete also the DAY from program status - start
			$sql = " SELECT id, days, tasks FROM #__guru_programstatus WHERE pid = (SELECT pid FROM #__guru_days WHERE id = '".$cid."')";
			$database->setQuery($sql);
			if (!$database->query()) {
				echo $database->stderr();
				return;
			}
			$ids = $database->loadObjectList();
			
			foreach($ids as $one_id){
				$day_array = explode(';', $one_id->days);
				$task_array = explode(';', $one_id->tasks);
				
				$the_key_to_be_removed=0;
				foreach ($day_array as $key=>$day_item)
					{
						$day_item_expld = explode(',',$day_item);
						if($day_item_expld[0]==$cid)
							{
								unset($day_array[$key]);
								$day_array = array_values($day_array);
								unset($task_array[$key]);
								$task_array = array_values($task_array);
							}
					}
				$new_day_array = implode(';', $day_array);
				//$task_array[$ordering-1] = '';
				$new_task_array = implode(';', $task_array);
				$sql = "update #__guru_programstatus set tasks='".$new_task_array."', days='".$new_day_array."' where id =".$one_id->id;
				$database->setQuery($sql);
				$database->query();
			}
			// we delete also the DAY from program status - stop
		
		
			// we delete the relations with the media - start
			$sql = "delete from #__guru_mediarel where type='dmed' and type_id=".$cid;
			$database->setQuery($sql);
			if (!$database->query() ){
				$this->setError($database->getErrorMsg());
				return false;
			}
			// we delete the relations with the media - stop
			
			// we delete the relations with the tasks - start
			$sql = "delete from #__guru_mediarel where type='dtask' and type_id=".$cid;
			$database->setQuery($sql);
			if (!$database->query() ){
				$this->setError($database->getErrorMsg());
				return false;
			}
			// we delete the relations with the tasks - stop		
						
			
			$sql = "SELECT pid FROM #__guru_days WHERE id = ".$cid;
			$database->setQuery($sql);
			$database->query();	
			$prog_id = $database->loadColumn();				
			
			$sql = "update #__guru_days set ordering=(`ordering`-1) where pid = '".$prog_id[0]."' AND ordering > ".$ordering;
			$database->setQuery($sql);
			$database->query();
				
			$sql = "DELETE FROM #__guru_days WHERE id=".$cid;
			$database->setQuery($sql);	
			$database->Query();
		} // end if locked=0
	}
	
	function deleteScreenAjax(){
		$db = JFactory::getDBO();
		$group_id = JRequest::getVar("group");
		$screen_id = JRequest::getVar("screen");
		
		$sql = "SELECT media_id FROM  #__guru_mediarel where type_id=".$screen_id." and type='scr_m'";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadColumn();
		
		if(@$result[0] !=""|| @$result[0] !=NULL){	
			$sql = "UPDATE  #__guru_quiz set hide = 1 where id=".$result[0];
			$db->setQuery($sql);
			$db->query();
		
		
		$sql = "UPDATE  #__guru_program set id_final_exam = 0  WHERE id = ( SELECT pid FROM #__guru_days WHERE id = '".$group_id."' ) ";
		$db->setQuery($sql);
		$db->query();
		
		$sql = "SELECT hasquiz FROM  #__guru_program where id = ( SELECT pid FROM #__guru_days WHERE id = '".$group_id."' ) ";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		
		$new_val = $result -1;
		if($new_val < 0){
			$new_val = 0;
		}
		
		$sql = "UPDATE  #__guru_program set hasquiz =".$new_val."  WHERE id = ( SELECT pid FROM #__guru_days WHERE id = '".$group_id."' ) ";
		$db->setQuery($sql);
		$db->query();
		
		}
		$query = "SELECT `deleted_boards` FROM #__guru_kunena_forum WHERE id =1 ";
		$db->setQuery( $query );
		$db->query();	
		$deleted_boards = $db->loadResult();
		
		$sql = "select count(*) from #__extensions where element='com_kunena'";
		$db->setQuery($sql);
		$db->query();
		$count = $db->loadResult();
		
		if($count > 0){
			if($deleted_boards == 1){
				$sql = "SELECT alias FROM #__guru_task WHERE id =".$screen_id;	
				$db->setQuery( $sql );
				$db->query();	
				$alias = $db->loadResult();		
				$query = "DELETE FROM #__kunena_categories WHERE alias = '".$alias."'";
				$db->setQuery( $query );
				$db->query();	
				
				$query = "DELETE FROM #__kunena_aliases WHERE alias = '".$alias."'";
				$db->setQuery( $query );
				$db->query();
			}
			elseif($deleted_boards == 2){
				$sql = "SELECT alias FROM #__guru_task WHERE id =".$screen_id;	
				$db->setQuery( $sql );
				$db->query();	
				$alias = $db->loadResult();
		
				
				$query = "UPDATE #__kunena_categories set published=0 WHERE alias = '".$alias."'";
				$db->setQuery( $query );
				$db->query();	
			}
		
		}		
		
		// deleting the old day-task relation
		$sql = "DELETE FROM #__guru_mediarel 
				WHERE type='dtask' AND  media_id = ".$screen_id;
		$db->setQuery($sql);	
		$db->query();			
		
		//delete all the relation between this task and medias
		$sql = "DELETE FROM #__guru_mediarel 
				WHERE (type='scr_m' or type='scr_t' or type='scr_l') AND type_id=".$screen_id;
		$db->setQuery($sql);	
		$db->query();	
		
		// deleting the task 
		$sql = "DELETE FROM #__guru_task 
				WHERE id = ".$screen_id;
		$db->setQuery($sql);
			
		$db->query();	

		$sql = "SELECT influence FROM #__guru_config WHERE id = 1";
		$db->setQuery($sql);
		if (!$db->query()) {
			echo $db->stderr();
			return;
			}
		$influence = $db->loadResult(); // we have selected the INFLUENCE 
		
		$sql = "SELECT locked FROM #__guru_days WHERE id = ".$group_id;
		$db->setQuery($sql);
		if (!$db->query()) {
			echo $db->stderr();
			return;
			}
		$locked = $db->loadResult(); // we have selected the LOCKED property for a day 		
		
		//we need to know where in the status array is the "day" that has a future deleting screen
		$sql = "SELECT ordering FROM #__guru_days WHERE id = ".$group_id;
		$db->setQuery($sql);
		if (!$db->query()) {
			echo $db->stderr();
			return;
			}
		$ordering = $db->loadResult();				
		
		$sql = "SELECT id,days,tasks FROM #__guru_programstatus 
				 WHERE pid = ( SELECT pid FROM #__guru_days WHERE id = '".$group_id."' ) ";
		$db->setQuery($sql);
		if (!$db->query()) {
			echo $db->stderr();
			return;
			}
		$days_array = $db->loadObjectList();				
	
		// if the INFLUENCE is active we also add the day in program_status - begin
		if(($influence==1 && $locked==0))
		{
			foreach($days_array as $one_day_array)
			{
				//$one_day_array_days = $days_array->days;
				$one_day_array_tasks = $one_day_array->tasks;
				//$one_day_array_id = $days_array->id;
				
				$new_day_array_tasks = '';
				
				$removing_start_pos = strpos($one_day_array_tasks, $screen_id.'-');
				$new_day_array_tasks = substr($one_day_array_tasks, 0, $removing_start_pos);
				$new_day_array_tasks = $new_day_array_tasks.substr($one_day_array_tasks, $removing_start_pos+strlen($screen_id)+2, strlen($one_day_array_tasks));
				
				$new_day_array_tasks = str_replace(';,', ';', $new_day_array_tasks);
				$new_day_array_tasks = str_replace(',;', ';', $new_day_array_tasks);
				$new_day_array_tasks = str_replace(',,', ',', $new_day_array_tasks);
				
				$sql = "update #__guru_programstatus set tasks='".$new_day_array_tasks."' where id =".$one_day_array->id;
				$db->setQuery($sql);
				$db->query();
			}
		}
		$sql = "SELECT `id`, `lesson_id`, `completed`, `pid` FROM  #__guru_viewed_lesson where pid = ( SELECT pid FROM #__guru_days WHERE id = '".$group_id."' ) ";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadAssocList();
		
		if(isset($result) && count($result) > 0){
			foreach($result as $key=>$value){
				$id = $value["id"];
				$lesson_id = $value["lesson_id"];
				$completed = $value["completed"];
				$pid = $value["pid"];
				
				$temp = str_replace("|".$screen_id."|", "", $lesson_id);
				
				$set = "";
				$date = "";
				if($completed == 0){
					$sql = "SELECT id FROM #__guru_task WHERE id IN (SELECT media_id FROM #__guru_mediarel WHERE type = 'dtask' AND type_id in (SELECT id FROM #__guru_days WHERE pid =".intval($pid)."))";
    				$db->setQuery($sql);
				    $db->query();
					$lessons_id = $db->loadColumn();
					
					$temp1 = $temp;
					$temp1 = substr($temp1, 1, -1);
					$temp1 = explode("|", $temp1);
					
					$diff = array_diff($lessons_id, $temp1);
					
					if(is_array($diff) && count($diff) > 0){
						$set = ", `completed`=".$completed;
					}
					else{
						$completed = "1";
						$set .= ", `completed`=".$completed;
						$set .= ", `date_completed`='".date("Y-m-d H:i:s")."'";
					}
				}
				
				$query = "UPDATE #__guru_viewed_lesson set `lesson_id`='".$temp."'".$set." WHERE `id` = ".intval($id);
				$db->setQuery( $query );
				$db->query();
			}
		}
	}
	
	function saveOrderG(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."views".DS."guruauthor".DS."tmpl".DS."saveOrderG.php");
		die();
	}
	
	function saveOrderS(){
		include_once(JPATH_SITE.DS."components".DS."com_guru".DS."views".DS."guruauthor".DS."tmpl".DS."saveOrderS.php");
		die();
	}
	
	function applyquizdetails(){
		$return = $this->_model->storequizdetails();
		$pid = JRequest::getVar("pid", "0");
		$user_id = JRequest::getVar("user_id", "0");
		$quiz_id = JRequest::getVar("quiz_id", "0");
		$action = JRequest::getVar("action", "");
		
		$url = JURI::root()."index.php?option=com_guru&view=guruauthor&task=quizdetails&layout=quizdetails&pid=".$pid."&userid=".$user_id."&quiz=".$quiz_id."&tmpl=component&action=".$action;
		if($return){
			$msg = JText::_("GURU_MODIF_OK");
			$this->setRedirect($url, $msg, "message");
		}
		else{
			$msg = JText::_("GURU_MEDIAAPPLYFAILED");
			$this->setRedirect($url, $msg, "message");
		}
	}
	
	function savequizdetails(){
		$return = $this->_model->storequizdetails();
		$pid = JRequest::getVar("pid", "0");
		$user_id = JRequest::getVar("user_id", "0");
		$quiz_id = JRequest::getVar("quiz_id", "0");
		$action = JRequest::getVar("action", "");
		
		$url = JURI::root()."index.php?option=com_guru&view=guruauthor&task=studentquizes&layout=studentquizes&pid=".intval($pid)."&userid=".intval($user_id)."&tmpl=component";
		
		if($action == "mark"){
			$url = JRoute::_("index.php?option=com_guru&view=guruauthor&task=mark&id=".intval($pid), true);
			echo '
				<script type="text/javascript" language="javascript">
					window.parent.location.href="'.$url.'";
				</script>';
			return;
		}
		
		if($return){
			$msg = JText::_("GURU_MODIF_OK");
			$this->setRedirect($url, $msg, "message");
		}
		else{
			$msg = JText::_("GURU_MEDIAAPPLYFAILED");
			$this->setRedirect($url, $msg, "message");
		}
	}
	
	function authorRegistration(){
		$user = JFactory::getUser();
		$user_id = $user->id;
		if($user_id == 0){
			$Itemid = JRequest::getVar("Itemid", "0");
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile"."&Itemid=".$Itemid, false));
		}
		else{
			$Itemid = JRequest::getVar("Itemid", "0");
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruauthor&task=authorprofile&layout=authorprofile"."&Itemid=".$Itemid, false));
		}
	}
	
	function studentRegistration(){
		$user = JFactory::getUser();
		$user_id = $user->id;
		if($user_id == 0){
			$Itemid = JRequest::getVar("Itemid", "0");
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin"."&Itemid=".$Itemid, false));
		}
		else{
			$Itemid = JRequest::getVar("Itemid", "0");
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruProfile&task=edit"."&Itemid=".$Itemid, false));
		}
	}
	
	function exportCsv(){
		$db = JFactory::getDBO();
		$pid = JRequest::getVar("course", 0);
		$result = array();
		
		$user = JFactory::getUser();
		$sql = "select `id` from #__guru_program where `author` like '%|".intval($user->id)."|%' OR `author`='".intval($user->id)."'";
		$db->setQuery($sql);
		$db->query();
		$courses_ids = $db->loadColumn();
		
		$sql = "select `id`, `name` from #__guru_program where `author` like '%|".intval($user->id)."|%' OR `author`='".intval($user->id)."'";
		$db->setQuery($sql);
		$db->query();
		$courses_names = $db->loadAssocList("id");
		
		if(!isset($courses_ids) || count($courses_ids) <= 0){
			$courses_ids = array("0"=>"0");
		}
		
		if(intval($pid) != 0){
			$courses_ids = array(intval($pid));
		}
		
		$sql = "select distinct(`userid`) from #__guru_buy_courses where `course_id` in (".implode(",", $courses_ids).")";
		$db->setQuery($sql);
		$db->query();
		$students_ids = $db->loadColumn();
		
		if(isset($students_ids) && count($students_ids) > 0){
			$sql = "select distinct(c.`userid`), A.`courses`, u.* from #__guru_buy_courses c, (select `userid`, GROUP_CONCAT(`course_id` SEPARATOR '-') as courses from #__guru_buy_courses where `course_id` in (".implode(",", $courses_ids).") group by `userid`) as A, #__users u, #__guru_customer cust where `course_id` in (".implode(",", $courses_ids).") and c.`userid`=A.`userid` and u.`id`=c.`userid` and cust.`id`=u.`id`";
			$db->setQuery($sql);
			$db->query();
			$result = $db->loadAssocList();
		}
		
		$content = JText::_("GURU_NAME").",".JText::_("GURU_EMAIL").",".JText::_("GURU_PROGRAM")."\n";
		
		if(isset($result) && count($result) > 0){
			foreach($result as $key=>$value){
				$name = $value["name"];
				$email = $value["email"];
				$courses = $value["courses"];
				$student_courses = array();
				$courses = explode("-", $courses);
				
				if(isset($courses) && count($courses) > 0){
					foreach($courses as $key=>$value){
						$student_courses[] = $courses_names[$value]["name"];
					}
				}
				
				$content .= $name.",".$email.",".implode("; ", $student_courses)."\n";
			}
		}
		
		header("Content-Type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=ExportResult.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
		exit();
	}
	
	function exportPdf(){
		$db = JFactory::getDBO();
		while (ob_get_level())
		ob_end_clean();
		header("Content-Encoding: None", true);

		require(JPATH_COMPONENT.DS.'helpers'.DS.'fpdf.php');
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'font'.DS.'helvetica.php');
		$quiz_id =  intval(JRequest::getVar("id", ""));
		//create a FPDF object
		$pdf=new FPDF();

		//set font for the entire document
		$pdf->SetFont('Arial','B',20);
		$pdf->SetTextColor(50,60,100);
		
		//set up a page
		$pdf->AddPage();
		@$pdf->SetDisplayMode(real,'default');
		
		$pdf->SetXY(10,5);
		$pdf->SetFontSize(8);
		
		$z = 25;
		
		$t = $z + 10;
		$pdf->SetXY(10,$t);
		$pdf->SetFontSize(7);
		$pdf->Cell(25, 10, JText::_("GURU_NAME"), 'LRTB', '', 'L', 0);
		$pdf->Cell(39, 10, JText::_("GURU_EMAIL"), 'LRTB', '', 'L', 0);
		$pdf->Cell(100, 10, JText::_("GURU_PROGRAM"), 'LRTB', '', 'L', 0);
		$pdf->Ln();
		
		$pid = JRequest::getVar("course", 0);
		$result = array();
		
		$user = JFactory::getUser();
		$sql = "select `id` from #__guru_program where `author` like '%|".intval($user->id)."|%' OR `author`='".intval($user->id)."'";
		$db->setQuery($sql);
		$db->query();
		$courses_ids = $db->loadColumn();
		
		$sql = "select `id`, `name` from #__guru_program where `author` like '%|".intval($user->id)."|%' OR `author`='".intval($user->id)."'";
		$db->setQuery($sql);
		$db->query();
		$courses_names = $db->loadAssocList("id");
		
		if(!isset($courses_ids) || count($courses_ids) <= 0){
			$courses_ids = array("0"=>"0");
		}
		
		if(intval($pid) != 0){
			$courses_ids = array(intval($pid));
		}
		
		$sql = "select distinct(`userid`) from #__guru_buy_courses where `course_id` in (".implode(",", $courses_ids).")";
		$db->setQuery($sql);
		$db->query();
		$students_ids = $db->loadColumn();
		
		if(isset($students_ids) && count($students_ids) > 0){
			$sql = "select distinct(c.`userid`), A.`courses`, u.* from #__guru_buy_courses c, (select `userid`, GROUP_CONCAT(`course_id` SEPARATOR '-') as courses from #__guru_buy_courses where `course_id` in (".implode(",", $courses_ids).") group by `userid`) as A, #__users u, #__guru_customer cust where `course_id` in (".implode(",", $courses_ids).") and c.`userid`=A.`userid` and u.`id`=c.`userid` and cust.`id`=u.`id`";
			$db->setQuery($sql);
			$db->query();
			$result = $db->loadAssocList();
		}

		$new_id = 0;
		$nr = 1;
		
		for($i = 0; $i < count($result); $i++){
			$name = $result[$i]["name"];
			$email = $result[$i]["email"];
			$courses = $result[$i]["courses"];
			$student_courses = array();
			$courses = explode("-", $courses);
			
			if(isset($courses) && count($courses) > 0){
				foreach($courses as $key=>$value){
					$student_courses[] = $courses_names[$value]["name"];
				}
			}
			
			$pdf->SetFontSize(7);
			$pdf->Cell(25, 10, $name, 'LRTB', '', 'L', 0);
			$pdf->Cell(39, 10, $email, 'LRTB', '', 'L', 0);
			$pdf->Cell(100, 10, implode(", ", $student_courses), 'LRTB', '', 'L', 0);
			$pdf->Ln();
		}
		//Output the document
		$pdf->Output('ExportResult.pdf', 'I');
	}
};

?>
