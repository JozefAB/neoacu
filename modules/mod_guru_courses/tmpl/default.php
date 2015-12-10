<?php 
	// no direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );
	defined('DS') or define("DS", DIRECTORY_SEPARATOR);
	require_once(JPATH_SITE.DS."modules".DS."mod_guru_courses".DS."helper.php");	
	
	$class = new ModGuruCourses();
	$courses = $class->getCourses($params);
	$item_id = "";
	$document = JFactory::getDocument();
	$document->addStyleSheet( 'modules/mod_guru_courses/mod_guru_courses.css' );
	?>
    <div id="mod_gurucpanel">
    <?php
    if(($params->get("teachername", "1") == 1) && ($params->get("showamountstud", "1") == 1) && ($params->get("showdescription", "1") == 1)){
    	$style = "style='padding-bottom:10px'";

    }
    else{
    	$style = "style='padding-bottom:0px'";
    }
	if(isset($courses) && count($courses) > 0){
		foreach($courses as $key=>$course){
?>
			<div class="row-fluid mod_guru_courses" <?php echo $style; ?>>
            	<div class="span12">
                	<div>
                    	<div>
							<?php
								echo '<a  class="guru_course_name" href="'.JRoute::_('index.php?option=com_guru&view=guruPrograms&task=view&cid='.$course["id"]."-".$course["alias"]."&Itemid=".intval($item_id)).'"><h5>'.$course["name"].'</h5></a>';
									
								if(($params->get("teachername", "1") == 1) || ($params->get("showamountstud", "1") == 1)){	
									echo '<ul class="ij_mod_details">';
										if($params->get("teachername", "1") == 1){
											$author = $class->getAuthor($course, $params);
											$author_id = $class->getAuthorID($course, $params);
											echo "<li><i class='mod_guru-icon-user'></i>"." ".'<a href="'.JRoute::_('index.php?option=com_guru&view=guruauthor&layout=view&cid='.$author_id."-".JFilterOutput::stringURLSafe($author)."&Itemid=".$item_id).'">'.$author."</a></li>";
										}
										if($params->get("showamountstud", "1") == 1){
											$nr_students = $class->getStudentsNumber($course, $params);
											echo "<li><i class='mod_guru-icon-group'></i>"." ".$nr_students." ".JText::_('GURU_MODULE_AMOUNT_STUDENTS_FRONT')."</li>";
										}										
										
									echo '</ul>';
								}
								if($class->showCourseImage($params)){
										$image_url = $course["image_avatar"];
										$image_url = str_replace("thumbs/", "", $image_url);
										$img_size = array();
										$host = $_SERVER['HTTP_HOST'];
										$myImg = str_replace("http://", "", $image_url);
										$myImg = str_replace($host, "", $myImg);
										if($myImg != $image_url){
											$myImg =str_replace("/", DS."", $myImg);			
											$img_size = @getimagesize(JPATH_SITE.DS.$myImg);					
										}
										else{
											$img_size = @getimagesize(urldecode($image_url));
										}
										
										$width_old = $img_size["0"];
										$height_old = $img_size["1"];
						
										$width_th = "0";
										$height_th = "0";
										
										if($params->get("thumbsizetype", "1") == 0 && isset($img_size)){
											if($width_old > $params->get("thumbsize", "0") && $params->get("thumbsize", "0") > 0){
												//proportional by width
												$raport = $width_old/$height_old;
												$width_th = $params->get("thumbsize", "0");
												$height_th = intval($params->get("thumbsize", "0") / $raport);
												$width_bullet_margin = $params->get("thumbsize", "0");					
											}
											else{
												$width_th = $width_old;
												$height_th = $height_old;					
											}
										}
										else{
											if($height_old > $params->get("thumbsize", "0") && $params->get("thumbsize", "0") > 0){
												//proportional by height			
											$raport = $height_old/$width_old;
											$height_th = $params->get("thumbsize", "0");						
											$width_th  = intval($params->get("thumbsize", "0") / $raport);
											$width_bullet_margin = intval($params->get("thumbsize", "0") / $raport);					
										}
										else{
											$width_th = $width_old;
											$height_th = $height_old;					
										}
									}
						
									if(trim($course["image_avatar"])){
										$src =  $class->create_module_thumbnails($image_url, $width_th, $height_th, $width_old, $height_old);
										echo '<a class="ij_mod_thumb pull-left" href="'.JRoute::_('index.php?option=com_guru&view=guruPrograms&task=view&cid='.$course["id"]."-".$course["alias"]."&Itemid=".intval($item_id)).'"><img src="'.$src.'" alt="" title=""></a>';
									}
									else{
										echo '';
									}
								}
								
								if(($params->get("showdescription", "1") == 1)){
									echo '<div  class="ij_course">';
										if($params->get("showdescription", "1") == 1){
											$description = $class->getDescription($course, $params);
											echo '<p class="ij_couurse_cont">'.$description.'</p>';
										}
										else{
											echo '&nbsp;';
										}
									echo'</div>';
								}
                            ?>
                		</div>
					</div> 
                </div>
            </div>
<?php
		}
	}
?>
</div>