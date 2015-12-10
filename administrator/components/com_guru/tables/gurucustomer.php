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

class TableguruCustomer extends JTable {
	var $id = null;
	var $user_id = null;
	var $fullname = null;

	function TableguruCustomer (&$db) {
		parent::__construct('#__guru_customer', 'id', $db);
	}

	function load ($id = 0, $reset = true) {
		$db = JFactory::getDBO();
		$sql = "select id from #__guru_customer where id='".$id."'";
		$db->setQuery($sql);
		$realid = $db->loadResult();
		if (isset($_POST['cid'])) $realid = $id;
		parent::load($realid,true);
	}

	function store($updateNulls = false){ 
		$db = JFactory::getDBO(); 
		parent::store(true);
		return true;
	}

};


?>