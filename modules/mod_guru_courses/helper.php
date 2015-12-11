<?php

defined('_JEXEC') or die('Restricted access');

	

class ModGuruCourses{

	function getCourses($params){

		$db = JFactory::getDBO();

		$sortby = $params->get("sortby", "0");

		

		$and = "";

		switch($sortby){

			case "0" : { // most popular

				//$sql = "select  p.* from `#__guru_program` p, `#__guru_order` o  where o.courses like p.id=bc.course_id GROUP BY bc.course_id LIMIT 0,".$params->get("howManyC")."";

				$sql = "select * from `#__guru_program`";

				$db->setQuery($sql);

				$db->query();

				$courses = $db->loadAssocList();

				if(isset($courses) && count($courses) > 0){

					$courses_temp = array();

					foreach($courses as $key=>$course){

						$nr = self::getStudentsNumber($course, null);

						if(count($courses_temp) == 0){

							$courses_temp[] = array($course['id']=>$nr);

						}

						else{							

							foreach($courses_temp as $key=>$c_id_nr){

								if(current($c_id_nr) <= $nr){

									array_splice($courses_temp, $key, 0, array(array($course['id']=>$nr)));

									break;

								}

								elseif(!isset($courses_temp[$key + 1])){

									array_splice($courses_temp, $key+1, 0, array(array($course['id']=>$nr)));

									break;

								}

							}

						}

					}

					$courses_temp = array_slice($courses_temp, 0, $params->get("howManyC"));

					$courses = array();

					foreach($courses_temp as $key=>$c_id_nr){

						$sql = "select * from `#__guru_program` where `id`=".intval(key($c_id_nr));

						$db->setQuery($sql);

						$db->query();

						$course_temp = $db->loadAssocList();

						$courses = array_merge($courses, $course_temp);

					}

				}

				return $courses;

				break;

			}

			case "1" : { // most recent

				$and .= " ORDER BY `startpublish` DESC LIMIT 0,".$params->get("howManyC")."";

				break;

			}

			case "2" : { // random

				$and .= " ORDER BY RAND() LIMIT 0,".$params->get("howManyC")."";

				break;

			}

		}

		$sql = "select * from `#__guru_program` where 1=1 and published=1 and status=1".$and;

		$db->setQuery($sql);

		$db->query();

		$courses = $db->loadAssocList();

		return $courses;

	}

	

	function showCourseImage($params){

		if($params->get("showthumb", "1") == 1){

			return true;

		}

		return false;

	}

	

	function createThumb($course, $params){

		return $course["image"];

	}

	

	function getStudentsNumber($course, $params){

		$db = JFactory::getDBO();

		$sql = "SELECT distinct o.userid FROM  #__guru_customer c, #__guru_order o  where courses like '".intval($course["id"])."-%' and c.id=o.userid and o.status='Paid' GROUP BY o.userid";

		$db->setQuery($sql);

		$db->query();

		$result = $db->loadColumn();

		$nr_studv = count($result);

		return $nr_studv;

	}

	

	function getDescription($course, $params){

		$return = "";

		$audio_p_desc_length = $params->get("desclength");

		$audio_p_desc_length_type = $params->get("desclengthtype");

		$description = strip_tags($course["description"]);

		

		if($audio_p_desc_length != '' && trim($description) != ""){

			 $new_description = "";

			 if($audio_p_desc_length_type == 0){

				//words

				$desc_array = explode(" ", $description);

				$desc = array();

				if(count($desc_array) > $audio_p_desc_length){

					foreach($desc_array as $key => $val){									

						if($key < $audio_p_desc_length){

							$desc[] = $val;

						}									

					 }

					$new_description = implode(" ", $desc)."..."; 								

				}

				else{

					$new_description = $description;

				}							 

			 }

			 elseif($audio_p_desc_length_type == 1){

				//characters						 	

				$descr_nr = strlen($description);

				if($descr_nr > $audio_p_desc_length){

					$new_description = substr(trim($description), 0, $audio_p_desc_length)."...";

				}

				else{

					$new_description = $description;

				}

			 }

			 $return = $new_description;

		}

		return $return;

	}

	

	function getAuthor($course, $params){

		$db = JFactory::getDBO();

		$authorname = "SELECT name from #__users where id=".intval($course["author"]);

		$db->setQuery($authorname);

		$db->query();

		$authorname = $db->loadColumn();

		return $authorname["0"];

	}

	function getAuthorID($course, $params){

		$db = JFactory::getDBO();

		$authorname = "SELECT id from #__guru_authors where userid=".intval($course["author"]);

		$db->setQuery($authorname);

		$db->query();

		$authorname = $db->loadColumn();

		return $authorname["0"];

	}

	function create_module_thumbnails($images, $width, $height, $width_old, $height_old){

			$image_path = JURI::root().$images;

			if(strpos($images, "http") !== FALSE){

				$image_path = $images;

			}

			$thumb_src = "modules/mod_guru_courses/createthumbs.php?src=".$image_path."&amp;w=".$width."&amp;h=".$height;//."&zc=1";

			return $thumb_src;

		}

		

	function getAudioDescription($audio, $params){

		$return = "";

		$audio_p_desc_length = $params->get("desclength");

		$audio_p_desc_length_type = $params->get("desclengthtype");

		$description = $audio["description"];

		

		if($audio_p_desc_length != '' && trim($description) != ""){

			 $new_description = "";

			 if($audio_p_desc_length_type == 0){

				//words

				$desc_array = explode(" ", $description);

				$desc = array();

				if(count($desc_array) > $audio_p_desc_length){

					foreach($desc_array as $key => $val){									

						if($key < $audio_p_desc_length){

							$desc[] = $val;

						}									

					 }

					$new_description = implode(" ", $desc)."..."; 								

				}

				else{

					$new_description = $description;

				}							 

			 }

			 elseif($audio_p_desc_length_type == 1){

				//characters						 	

				$descr_nr = strlen($description);

				if($descr_nr > $audio_p_desc_length){

					$new_description = substr($description, 0, $audio_p_desc_length)."...";

				}

				else{

					$new_description = $description;

				}

			 }

			 $return = $new_description;

		}

		return $return;

	}

	function getCourseLevel($course, $params){

		switch($course["level"]){

			case "0" : { 

				$return = JText::_("GURU_BEGINNERS");

				break;

			}

			case "1" : { 

				$return = JText::_("GURU_INTERMEDIATE");

				break;

			}

			case "2" : { 

				$return = JText::_("GURU_ADVANCED");

				break;

			}

		}

		return $return;

	

	}

};

?>

