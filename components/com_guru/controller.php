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

$doc = JFactory::getDocument();

$siteApp = JFactory::getApplication('site');
$siteTemplate = $siteApp->getTemplate();

if(file_exists(JPATH_SITE.DS."templates".DS.$siteTemplate.DS."html".DS."com_guru".DS."css".DS."guru.css")){
	$doc->addStyleSheet(JURI::root()."templates/".$siteTemplate."/html/com_guru/css/guru.css");
}
else{
	$doc->addStyleSheet(JURI::root()."components/com_guru/css/guru.css");
}

if(file_exists(JPATH_SITE.DS."templates".DS.$siteTemplate.DS."html".DS."com_guru".DS."css".DS."custom.css")){
	$doc->addStyleSheet(JURI::root()."templates/".$siteTemplate."/html/com_guru/css/custom.css");
}
else{
	$doc->addStyleSheet(JURI::root().'components/com_guru/css/custom.css');
}

$task = JRequest::getVar("task", "");

if($task != "checkExistingUserU" && $task != "checkExistingUserE"){
	// Load uikit framework
	//$doc->addStyleSheet(JURI::root().'components/com_guru/css/uikit.almost-flat.min.css');
	//echo '<link rel="stylesheet" href="'.JURI::root().'components/com_guru/css/uikit.almost-flat.min.css" />';
}

// load FontAwesome -------------------------------------------
$doc->addStyleSheet(JURI::root()."components/com_guru/css/font-awesome.min.css");
$db = JFactory::getDBO();

$sql = "SELECT `guru_turnoffjq` FROM `#__guru_config` WHERE `id`=1";
$db->setQuery($sql);
$db->query();
$guru_turnoffjq = $db->loadResult();
$guru_turnoffjq = @$guru_turnoffjq["0"];

if(intval($guru_turnoffjq) != 0){
	$doc->addScript(JURI::root().'components/com_guru/js/jquery_1_11_2.js');
}

$doc->addScript(JURI::root().'components/com_guru/js/jquery.height_equal.js');
//$doc->addScript(JURI::root().'components/com_guru/js/uikit.min.js');
//$doc->addScript(JURI::root().'components/com_guru/js/ukconflict.js');

$export = JRequest::getVar("export", "");

if($task != "checkExistingUserU" && $task != "checkExistingUserE" && $export == "" && $task != "upload_ajax_image" && $task != "export_csv"){
	echo '
		<script type="text/javascript" language="javascript">
			guru_site_host = "'.JURI::root().'";
		</script>
		<script type="text/javascript" language="javascript" src="'.JURI::root().'components/com_guru/js/ukconflict.js"></script>
		<script type="text/javascript" language="javascript" src="'.JURI::root().'components/com_guru/js/uikit.min.js"></script>
	';
}

$doc->addScript(JURI::root().'components/com_guru/js/accordion.js');

class guruController extends JControllerLegacy {
	var $_customer = null;
	function __construct() {
		parent::__construct();
	}

	function display ($cachable = false, $urlparams = Array()){
		parent::display(false, null);	
	}

	function setclick($msg = ''){
	}
};
?>