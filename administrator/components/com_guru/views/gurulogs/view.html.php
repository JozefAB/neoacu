<?php
/*------------------------------------------------------------------------
# com_guru
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com/forum/index/
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport ("joomla.application.component.view");

class guruAdminViewguruLogs extends JViewLegacy {

	function emails($tpl = null){
		$emails = $this->get('Items');
		$this->assignRef('emails', $emails);
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);
		
		parent::display($tpl);
	}
	
	function purchases($tpl = null){
		$purchases = $this->get('Items');
		$this->assignRef('purchases', $purchases);
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);
		
		parent::display($tpl);
	}
	
	function getEmailName($email){
		$name = "";
		if($email->emailid == 0){
			switch($email->emailname){
				case 'user-registration' : {
					$name = JText::_("GURU_FOR_TEACHER_APPROVED");
					break;
				}
				case 'email-certificate' : {
					$name = JText::_("GURU_MY_CERTIFICATE");
					break;
				}
				case 'teacher-registration' : {
					$name = JText::_("GURU_FOR_TEACHER_REGISTERED");
					break;
				}
				case 'email-to-ask-approved' : {
					$name = JText::_("GURU_FOR_TEACHER_APPROVED");
					break;
				}
				case 'buy-offline' : {
					$name = JText::_("GURU_OFFLINE_ORDER");
					break;
				}
				case 'my-quiz-marcked' : {
					$name = JText::_("GURU_RADED_AND_CHECKED_RESULT");
					break;
				}
				case 'get-certificate' : {
					$name = JText::_("GURU_GET_CERTIFICATE");
					break;
				}
				case 'teacher-mark-essay' : {
					$name = JText::_("GURU_REVIEW_QUIZ");
					break;
				}
			}
		}
		else{
			$db = JFactory::getDbo();
			$sql = "select `name` from #__guru_subremind where `id`=".intval($email->emailid);
			$db->setQuery($sql);
			$db->query();
			$name = $db->loadColumn();
			$name = @$name["0"];
		}
		return $name;
	}
	
	function edit($tpl = null){
		$email = $this->get("Email");
		$this->assignRef('email', $email);
		parent::display($tpl);
	}
};

?>