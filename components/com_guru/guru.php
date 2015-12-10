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

//global $mainframe;
$app = JFactory::getApplication();
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
//check for access
$my =  JFactory::getUser();

$database =  JFactory :: getDBO();
$meniu=0;
$task = JRequest::getVar('task', "");
$control = JRequest::getVar('controller', "");
$view = JRequest::getVar('view', "");
$export = JRequest::getVar('export', "");

require_once (JPATH_COMPONENT.DS.'controller.php');
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );
$controller = JRequest::getVar('controller', "");
$guruHelperclass = new guruHelper();
$guruHelperclass->createBreacrumbs();

$menuParams = new JRegistry;
$app = JFactory::getApplication("site");
$menu = $app->getMenu()->getActive();
@$menuParams->loadString($menu->params);
$show_page_heading = $menuParams->get("show_page_heading");
$page_heading = $menuParams->get("page_heading");

if($show_page_heading == 1){
	if($page_heading == ""){
		$page_heading = $menuParams->get("page_title");
	}
?>
<header class="page-header">
	<h1 class="page-title">
	<?php echo trim($page_heading); ?>
	</h1>
</header>
<?php
}

if($controller == "guruProfile" || $controller == "guruBuy"){
	JRequest::setVar("view", "");
	JRequest::setVar("layout", "");
	JRequest::setVar("cid", "");
}

if($controller){
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if(file_exists($path)){
		require_once($path);
	}
}
else{
	switch($view){
		case "guruauthor":
			$controller = 'guruAuthor';
			break;
		case "guruAuthor":
			$controller = 'guruAuthor';
			break;
		case "guruprograms":
			$controller = 'guruPrograms';
			break;
		case "guruPrograms":
			$controller = 'guruPrograms';
			break;
		case "guruorders":
			$controller = 'guruOrders';
			break;
		case "guruOrders":
			$controller = 'guruOrders';
			break;	
		case "gurutasks":
			$controller = 'guruTasks';
			break;
		case "guruTasks":
			$controller = 'guruTasks';
			break;
		case "gurulogin":
			$controller = 'guruLogin';
			break;
		case "guruLogin":
			$controller = 'guruLogin';
			break;
		case "gurubuy":
			$controller = 'guruBuy';
		case "guruBuy":
			$controller = 'guruBuy';
			break;
		case "guruprofile":
			$controller = 'guruProfile';
		case "guruProfile":
			$controller = 'guruProfile';
			break;
		case "gurucustomers":
			$controller = 'guruCustomers';
		case "guruCustomers":
			$controller = 'guruCustomers';
			break;
		case "gurueditplans":
			$controller = 'guruEditplans';
		case "guruEditplans":
			$controller = 'guruEditplans';
			break;	
		default:
			$controller = 'guruPcategs';
			break;
	}
 	
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

	if(file_exists($path)){
		require_once($path);
	}
}
JHtml::_('behavior.framework',true);

$task = JRequest::getVar("task", "");

if($task != "saveInDbQuiz" && $task != "showCertificateFr" && $task != "ajax_add_video" && $task != "savesbox" && $task != "lessonmessage" && $task != "editgurucomment" && $task != "editformgurupost" && $export != "csv" && $task != "upload_ajax_image" && $task != "checkExistingUserU" && $task != "checkExistingUserE" && $task != "pub_unpub_ajax" && $task != "publish_quiz_ajax" && $task != "unpublish_quiz_ajax" && $task != "delete_quiz_ajax" && $task != "add_quizz_ajax" && $task != "add_text_ajax" && $task != "delete_final_quizz_ajax" && $task != "delete_group_ajax" && $task != "delete_screen_ajax" && $task != "saveOrderG" && $task != "saveOrderS" && $task != "delete_image_ajax" && $task != "check_values" && $task != "add_media_ajax" && $task != "export_pdf" && $task != "export_csv"){
?>
<div class="guru-content" id="guru-component">
	<script type="text/javascript" language="javascript">
		var matched, browser;
	
		jQuery.uaMatch = function( ua ) {
			ua = ua.toLowerCase();
		
			var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
				/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
				/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
				/(msie) ([\w.]+)/.exec( ua ) ||
				ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
				[];
		
			return {
				browser: match[ 1 ] || "",
				version: match[ 2 ] || "0"
			};
		};
		
		matched = jQuery.uaMatch( navigator.userAgent );
		browser = {};
		
		if ( matched.browser ) {
			browser[ matched.browser ] = true;
			browser.version = matched.version;
		}
		
		// Chrome is Webkit, but Webkit is also Safari.
		if ( browser.chrome ) {
			browser.webkit = true;
		} else if ( browser.webkit ) {
			browser.safari = true;
		}
		
		jQuery.browser = browser;
	</script>
<?php
}
?>

	<?php
    $db = JFactory::getDBO();
    $sql = "SELECT * FROM #__guru_config WHERE id = '1' ";
    $db->setQuery($sql);
    if(!$db->query()){
        echo $db->stderr();
        return;
    }
    $configs = $db->loadObject();
    $document	= JFactory::getDocument();
	
	$view = JRequest::getVar("view", "");
	$layout = JRequest::getVar("layout", "");
    $cid = JRequest::getVar("cid", "");
    
	if(intval($cid) == 0){
		$menu	= $app->getMenu();
		$item	= $menu->getActive();
		if(isset($item)){
			$cid = $item->params->get("cid");
		}
	}
	
	if($view == "guruauthor" && $layout == "view" && $controller == "guruAuthor" && intval($cid) == "0"){
		$Itemid = JRequest::getVar("Itemid", "0");
		$redirect = JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=authorprofile&Itemid=".$Itemid, false);
		$app = JFactory::getApplication();
		$app->redirect($redirect);
	}
	
    $classname = "guruController".$controller;
    $ajax_req = JRequest::getVar("no_html", 0, "request");
    $controller = new $classname();
    $layout = JRequest::getWord('layout');

    if($layout && $task !="renew"){
		if($classname == "guruControllerguruEditplans"){
			$layout = $task;
		}
		
		if(trim($task) == ""){
			$controller->execute($layout);
		}
		else{
			$controller->execute($task);
		}
    }
    else{
        $task = JRequest::getWord('task');
        $controller->execute($task);
    }
    
    $controller->redirect();
    
    $view = JRequest::getVar("view", "");
    $controller = JRequest::getVar("controller", "");
    
    if(trim($view) == ""){
        $view = $controller; 
    }
    
    if($view == 'gurutasks'){
        // do nothing
    }
    elseif($view == "guruPcategs" || $view == "gurupcategs" || $view == "gurubuy" || $view == "guruPrograms"){
            $db = JFactory::getDBO();
            $sql = "select `show_powerd` from #__guru_config";
            $db->setQuery($sql);
            $db->query();
            $result = $db->loadColumn();
			$result = $result["0"];
            if($result == 1){
				if($task != "savesbox" && $task !="saveLesson"){
            ?>
                <div class=" pagination-centered">
                    <span class="power_by">Powered by: Guru: </span>
                    <a target="_blank" href="http://guru.ijoomla.com/" class="power_link" title="joomla lms">Joomla LMS</a>
                </div>
            <?php
				}
            }
            else{
            
            }
    }

if($task != "saveInDbQuiz" && $task != "savesbox" && $task !="saveLesson" && $task != "lessonmessage" && $task != "editgurucomment" && $task != "editformgurupost" && $export != "csv" && $task != "upload_ajax_image" && $task != "checkExistingUserU" && $task != "checkExistingUserE" && $task != "pub_unpub_ajax" && $task != "publish_quiz_ajax" && $task != "unpublish_quiz_ajax" && $task != "delete_quiz_ajax" && $task != "add_quizz_ajax" && $task != "add_text_ajax" && $task != "delete_final_quizz_ajax" && $task != "delete_group_ajax" && $task != "delete_screen_ajax" && $task != "saveOrderG" && $task != "saveOrderS" && $task != "delete_image_ajax" && $task != "check_values" && $task != "add_media_ajax" && $task != "export_pdf" && $task != "export_csv"){	
    ?>
</div>
<div class="clearfix"></div>
<?php
}
?>