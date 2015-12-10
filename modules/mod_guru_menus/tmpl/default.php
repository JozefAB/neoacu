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
defined('_JEXEC') or die('Restricted access');

$categories_alias = array();

$db = JFactory::getDbo();
$sql = "select `id`, `params` from #__menu where `menutype`='guru-categories'";
$db->setQuery($sql);
$db->query();
$menus_result = $db->loadAssocList();

if(isset($menus_result) && count($menus_result) > 0){
	foreach($menus_result as $key=>$value){
		$menu_params = $value["params"];
		$menu_params = json_decode($menu_params, true);
		$cid = $menu_params["cid"];
		@$categories_alias[$cid] = $value["id"];
	}
}

if(!function_exists("getCoursesByCategory")){
	function getCoursesByCategory($categ_id){
		$db = JFactory::getDbo();
		$sql = "select `id`, `catid`, `name`, `alias` from #__guru_program where `published`='1' and `catid`=".intval($categ_id);
		$db->setQuery($sql);
		$db->query();
		$courses = $db->loadAssocList();
		return $courses;
	}
}

?>

<script src="guru_menus.js"></script>


<div class="guru-content" id="guru-component">
	<?php
    	if(isset($result) && count($result) > 0){
	?>
    		<div class="guru-menus-content">
            	<ul class="guru-menus-list">
    <?php
			foreach($result as $key=>$value){
				if(intval($value["total"]) == 0){
					continue;
				}
				$courses = getCoursesByCategory($value["id"]);
	?>
                    <li onmouseover="javascript:showCourses(this, <?php echo intval($value["id"]); ?>); markElement(this);" onmouseout="javascript:hideCourses(this, <?php echo intval($value["id"]); ?>); unmarkElement(this);">
                        <a href="#" class="menu-categ-a">
							<span class="menu-categ-name"><?php echo $value["name"]; ?></span>
                            <span class="menu-arrow">&gt;</span>
                        </a>
                        <div id="guru-menus-sidebar-<?php echo $value["id"]; ?>" class="guru-menus-sidebar">
                            <?php
                            	if(isset($courses) && count($courses) > 0){
							?>
                            		<ul class="guru-courses-content">
                            <?php
									foreach($courses as $key_c=>$value_c){
							?>
                            			<li onmouseover="markElement(this);" onmouseout="unmarkElement(this);">
                                        	<a href="<?php echo JRoute::_("index.php?option=com_guru&view=guruPrograms&task=view&cid=".$value_c["id"]."-".$value_c["alias"]."&Itemid=".intval($categories_alias[$value["id"]])); ?>" class="menu-course-a">
												<?php echo $value_c["name"]; ?>
											</a>
                                        </li>
                            <?php
									}
							?>
                            		</ul>
                            <?php
								}
							?>
                        </div>
                    </li>
    <?php
			}
	?>
    			</ul>
    		</div>
    <?php
		}
	?>
</div>