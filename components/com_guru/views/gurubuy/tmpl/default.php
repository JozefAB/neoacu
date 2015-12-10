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
$document = JFactory::getDocument();
$document->addScript(JURI::base()."components/com_guru/js/buy.js");
JHTML::_('behavior.modal');
require_once(JPATH_BASE . "/components/com_guru/helpers/Mobile_Detect.php");
$total = "";
$order_id = isset($_SESSION["order_id"]) ? intval($_SESSION["order_id"]) : "";
$promocode = "";

if(isset($_SESSION["promo_code"])){
	$promocode = $_SESSION["promo_code"];
}
$guruModelguruBuy = new guruModelguruBuy();
$configs = $guruModelguruBuy->getConfigs();
$currency = $configs["0"]["currency"];

$currencypos = $configs["0"]["currencypos"];
$character = "GURU_CURRENCY_".$currency;
$action = JRequest::getVar("action", "");

$all_product = array();
if($action == ""){
	if(isset($_SESSION["courses_from_cart"])){
		$all_product = $_SESSION["courses_from_cart"];
	}
}
else{
	$all_product = $_SESSION["renew_courses_from_cart"];
}

$user = JFactory::getUser();
$user_id = $user->id;
if($user_id != "0" && $action == ""){
	$all_product = $this->refreshCoursesFromCart($all_product);
}

$action2 = JRequest::getVar("action2", "");
if($action != "renew"){
	foreach($all_product as $key=>$value){
		$course_details = $guruModelguruBuy->getCourseDetails($value["course_id"]);
		if(is_array($course_details) && count($course_details) == 0){
			unset($_SESSION["courses_from_cart"][$value["course_id"]]);
		}
	}
	$all_product = @$_SESSION["courses_from_cart"];
}
$document->setTitle(JText::_("GURU_MY_CART"));

$db = JFactory::getDBO();
$sql = "select courses_ids from #__guru_promos where code="."'".$promocode."'";
$db->setQuery($sql);
$db->query();
$courses_ids_list = $db->loadColumn();
$courses_ids_list2 = implode(",",$courses_ids_list);
$courses_ids_list3 = explode("||",$courses_ids_list2);
$counter = 0;
if(trim($action2) != ""){
	$order_id = JRequest::getVar("order_id", "0");
	$db = JFactory::getDBO();
	$sql = "select form from #__guru_order where id=".intval($order_id);
	$db->setQuery($sql);
	$db->query();
	$form = $db->loadResult();
	echo $form;	
}
elseif(isset($all_product) && count($all_product) > 0){
?>

<script type="text/javascript" src="<?php echo JURI::root(); ?>media/system/js/mootools-core.js"></script>
<script type="text/javascript" src="<?php echo JURI::root(); ?>media/system/js/core.js"></script>
<script type="text/javascript" src="<?php echo JURI::root(); ?>media/system/js/mootools-more.js"></script>

<div id="guru_cart" class="gru-cart">
    <form action="<?php echo JRoute::_("index.php?option=com_guru&view=gurubuy"); ?>" id="adminForm" name="adminForm" method="post">
    	<h2 class="gru-page-title"><?php echo JText::_('GURU_MY_CART');?></h2>
        
        <table id="g_table_cart" class="uk-table">
            <tr class="hidden-phone">
                <th><?php echo JText::_("GURU_COURSE_NAME"); ?></th>
                <th class="hidden-phone"><?php echo JText::_("GURU_MYORDERS_AMOUNT"); ?></th>
                <th><?php echo JText::_("GURU_REMOVE"); ?></th>
                <th class="hidden-phone"><?php echo JText::_("GURU_TOTAL"); ?></th>
            </tr> <!--end table row 1-->
            
			<?php
            	if(isset($all_product) && is_array($all_product) && count($all_product) > 0){
					$j = 1;
					$all_ids = array();
					
					foreach($all_product as $key=>$value){
                        $all_ids[] = $key;
                    }
                    
					$all_ids = implode(",", $all_ids);
                    $price = 0;
                    $total_price = 0;
					
					foreach($all_product as $key=>$value){
						$course_details = $guruModelguruBuy->getCourseDetails($value["course_id"]);
						$course_plans = $guruModelguruBuy->getCoursePlans($value["course_id"], $value["plan"]);

						if(isset($course_details["0"]["name"]) || $course_details["0"]["name"] !=""){
            ?>
                            <tr id="row_<?php echo intval($value["course_id"]); ?>" class="tr2">
                                <td class="g_cell_1">
                                    <ul>
										<?php
                                            if(isset($course_details["0"]["name"])){
                                                echo '<li class="guru_product_name clearfix">'.$course_details["0"]["name"].'</li>';
                                                }
                                            ?>
                                            <li class="guru_details"><strong><?php echo JText::_("GURU_SELECT_PLAN"); ?>:
                                            	<br />
                                        <?php
												echo '<select onchange="update_cart('.$value["course_id"].', this.value, \''.$all_ids.'\', \''.trim(JText::_($character)).'\')" size="1" id="plan_id'.$value["course_id"].'" name="plan_id['.$value["course_id"].']">';	
                                                
                                                if(isset($course_plans) && count($course_plans) > 0){
                                                    $find = FALSE;
                                                    $poz = -1;
                                                    
                                                    foreach($course_plans as $key_plan=>$value_plan){
                                                        $selected = "";												
                                                        
                                                        if($value_plan["default"] == "1" && $value["value"] == "" && $value["plan"] == "buy" && !$find){
                                                            $price = $value_plan["price"];
                                                            $total_price = $price;
                                                            $total += $total_price;
                                                            $selected = ' selected="selected "';
                                                            $find = TRUE;
                                                            $poz = $key_plan;
                                                        }
                                                        elseif($value_plan["default"] == "1" && $value["value"] == "" && $value["plan"] == "renew" && !$find){
                                                            $price = $value_plan["price"];
                                                            $total_price = $price;
                                                            $total += $total_price;
                                                            $selected = ' selected="selected "';
                                                            $find = TRUE;
                                                            $poz = $key_plan;
                                                        }
                                                        elseif($value_plan["price"] == $value["value"] && !$find){
                                                            $price = $value_plan["price"];
                                                            $total_price = $price;
                                                            $total += $total_price;
                                                            $selected = ' selected="selected "';
                                                            $find = TRUE;
                                                            $poz = $key_plan;
                                                        }
                                                        
                                                        if($currencypos == 0){
                                                            echo '<option onclick="document.getElementById(\'plan_selected_'.$value["course_id"].'\').value=\''.md5('guru-poz-'.$key_plan).'\';" value="'.$value_plan["price"].'" '.$selected.' >'.$value_plan["name"].' - '.JText::_($character).' '.$value_plan["price"].'</option>';
                                                        }
                                                        else{
                                                            echo '<option onclick="document.getElementById(\'plan_selected_'.$value["course_id"].'\').value=\''.md5('guru-poz-'.$key_plan).'\';" value="'.$value_plan["price"].'" '.$selected.' >'.$value_plan["name"].' - '.$value_plan["price"].' '.JText::_($character).'</option>';
                                                        }
                                                    }
                                                }
                                                echo '</select>';
                                                echo '<input type="hidden" id="plan_selected_'.$value["course_id"].'" name="plan_selected['.$value["course_id"].']" value="'.md5('guru-poz-'.$poz).'">';
                                        ?>
                                        </strong></li>
                                    </ul>
                                </td>
                            
                                <td class="g_cell_2 hidden-phone">
                                    <span class="guru_cart_amount" id="cart_item_price<?php echo $value["course_id"]; ?>" >
                                    <?php 
                                        if($currencypos == 0){
                                            echo JText::_($character)." ".$price; 
                                        }
                                        else{
                                            echo $price." ".JText::_($character); 
                                        }
                                    ?>
                                    </span>
                                </td>					
                            
                                <td class="g_cell_3">
                                    <?php
                                        $action_for_request = "buy";
                                        if(trim($action) == "renew"){
                                            $action_for_request = "renew";
                                        }
                                    ?>
                                    <a href="javascript:void(0)" name="remove" onclick="javascript:removeCourse(<?php echo intval($value["course_id"]); ?>, '<?php echo $all_ids; ?>', '<?php echo $action_for_request; ?>', '<?php echo addslashes(JText::_("GURU_CART_IS_EMPTY")); ?>', '<?php echo JRoute::_("index.php?option=com_guru&view=gurupcategs"); ?>', '<?php echo addslashes(JText::_("GURU_CLICK_HERE_TO_PURCHASE")); ?>', '<?php echo trim(JText::_($character)); ?>');">
                                        <img src="<?php echo JURI::root()."components/com_guru/images/icons/icon_trash.png"; ?>" />
                                    </a>
                                </td>
                            
                                <td class="g_cell_4 hidden-phone">
                                    <ul>
                                        <li class="guru_cart_amount">
                                            <span id="cart_item_total<?php echo $value["course_id"]; ?>">
                                            <?php 
                                                if($currencypos == 0){
                                                    echo JText::_($character)." ".$total_price;
                                                }
                                                else{
                                                    echo $total_price." ".JText::_($character);
                                                }
                                            ?>
                                            </span>
                                        </li>
                                        <?php
                                        
                                        if(in_array($value["course_id"],$courses_ids_list3 )){
                                            $counter +=1;
                                        ?>
                                            <li class="guru_cart_amount_discount">
                                                <span id="guru_cart_amount_discount<?php echo $value["course_id"]; ?>">
                                                    <?php 
                                                        echo JText::_("GURU_DISCOUNT").": ";
                                                        $promo_discount_percourse = $this->getPromoDiscountCourse($total_price); 
                                                        
														$promo_discount_percourse = number_format((float)$promo_discount_percourse, 2, '.', '');
														
                                                        if($currencypos == 0){
                                                            echo JText::_($character)." ".$promo_discount_percourse;
                                                        }
                                                        else{
                                                            echo $promo_discount_percourse." ".JText::_($character);
                                                        }
                                                    ?>
                                                </span>
                                            </li>
                                            <li class="guru_cart_amount_discount">
                                                <span id="guru_cart_amount_discount<?php echo $value["course_id"]; ?>">
                                                <?php 
                                                    echo JText::_("GURU_TOTAL").": ";
                                                    $total_final = $this->setPromoTest($total_price, $counter);
                                                    
													$total_final = number_format((float)$total_final, 2, '.', '');
													
                                                    if($currencypos == 0){
                                                        echo JText::_($character)." ".$total_final;
                                                    }
                                                    else{
                                                        echo $total_final." ".JText::_($character);
                                                    }
                                                ?>
                                                </span>
                                            </li>
                                        <?php
                                        }
                                        else{
											if(!isset($courses_ids_list3) || count($courses_ids_list3) == 0 || intval($courses_ids_list3["0"])== 0){
												$counter +=1;
												$promo_discount_percourse = $this->getPromoDiscountCourse($total_price); 	
												$total_final = $this->setPromoTest($total_price, $counter);
											}
											else{
												$total_final = $total_price;
												$promo_discount_percourse = 0;
											}
                                        }
                                        ?>  
                                    </ul>	
                                </td>												
                            </tr><!--end table row 2-->					
				<?php
						}
                        
						@$total_finish += $total_final;
						@$totall_discount += $promo_discount_percourse;
						$j = $j == 1 ? 2 : 1;
					}// foreach
				}// all products
				?>

            				<tr class="tr3">
                                <td class="g_cell_1 g_promo_code_box">
                                    <div class="uk-width-1-1">
                                    	<?php echo JText::_("GURU_BUY_PROMO"); ?>:
                                        <input type="text" class="uk-form-width-small" value="<?php echo $promocode; ?>" name="promocode" />
									</div>
                                    <div class="uk-float-left uk-margin-small-top">
                                    	<input type="submit" class="uk-button uk-button-primary" value="<?php echo JText::_("GURU_RECALCULATE"); ?>" name="Submit"  onclick="document.adminForm.task.value='updatecart'" />
                                    </div>              
								</td>
                                
                                <td class="g_cell_2 hidden-phone">
									<span class="guru_alt"></span>
                                </td>
								
                                <td class="g_cell_2 hidden-phone">
                                </td>
                                
                                <td class="g_cell_3" nowrap="nowrap">
                                    <ul>
									<?php
                                        if($counter > 0){
									?>
											<li class="guru_cart_total">
												<?php echo JText::_("GURU_DISCOUNT"); ?>:
                                            	<?php
													$totall_discount = number_format((float)$totall_discount, 2, '.', '');
													
													if($currencypos == 0){
														echo JText::_($character)." ".$totall_discount;
													}
													else{
														echo $totall_discount." ".JText::_($character);
													}
													$_SESSION["discount_value"] = $totall_discount;
												?>
                                            </li>
									<?php
										}
									?>
                                    	<li class="guru_cart_total">
											<?php echo JText::_("GURU_TOTAL"); ?>:
                                            <span id="max_total">
												<?php
                                                    if($counter >0){
                                                        $total_finish = number_format((float)$total_finish, 2, '.', '');
                                                        
                                                        if($currencypos == 0){
                                                            echo JText::_($character)." ".$total_finish;
                                                        }
                                                        else{
                                                            echo $total_finish." ".JText::_($character);
                                                        }
                                                    }
                                                    else{
                                                        if(trim($total) != ""){
                                                            $total = number_format((float)$total, 2, '.', '');
                                                            
                                                            if(!isset($_SESSION["max_total"])){
                                                                if($currencypos == 0){
                                                                    echo JText::_($character)." ".$total;
                                                                }
                                                                else{
                                                                    echo $total." ".JText::_($character);
                                                                }
                                                            }
                                                            elseif($_SESSION["max_total"] != $total){
                                                                $_SESSION["max_total"] = $total;
                                                                
                                                                $total = number_format((float)$total, 2, '.', '');
                                                                
                                                                if($currencypos == 0){
                                                                    echo JText::_($character)." ".$total;
                                                                }
                                                                else{
                                                                    echo $total." ".JText::_($character);
                                                                }
                                                            }
                                                            else{
                                                                $_SESSION["max_total"] = number_format((float)$_SESSION["max_total"], 2, '.', '');
                                                                
                                                                if($currencypos == 0){
                                                                    echo JText::_($character)." ".$_SESSION["max_total"];
                                                                }
                                                                else{
                                                                    echo $_SESSION["max_total"]." ".JText::_($character);
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
											</span>
										</li>
									</ul>
								</td>
            				</tr><!--end table row 3-->

                            <tr class="tr4">
                            	<td class="hidden-phone">
                            		<input type="button" class="uk-button uk-button-primary g_newline2" onclick="window.location='<?php echo JRoute::_("index.php?option=com_guru&view=gurupcategs"); ?>';" value="&lt;&lt; <?php echo JText::_("GURU_CONTINUE_SHOPPING"); ?>" name="continue"/>
                            	</td>
                            
                            	<td class="hidden-phone"></td>
                            
                            	<td class="hidden-phone"></td>
                            
                            	<td id="g_myCart_payment" nowrap="nowrap">
                            		<?php 
                            			echo $this->getPlugins();
									?>
                                    <div class="uk-float-left uk-margin-small-top">
										<input type="button" class="uk-button uk-button-success" value="<?php echo JText::_("GURU_CHECKOUT"); ?> &gt;&gt;" name="checkout" onclick="document.adminForm.submit();"/>
                                    </div>
                            	</td>
							</tr><!--end tr4-->
        				</table>
	
    	<input type="hidden" name="option" value="com_guru" />
		<input type="hidden" name="controller" value="guruBuy" />
		<input type="hidden" name="task" value="checkout" />
		<input type="hidden" name="view" value="test" />
		<input type="hidden" name="order_id" id="order_id" value="<?php echo intval($order_id); ?>"/>
		<input type="hidden" value="<?php echo $action; ?>" id="action" name="action" />
	</form>
</div>
<?php
}
else{
	echo JText::_("GURU_CART_IS_EMPTY").", ".'<a href="'.JRoute::_('index.php?option=com_guru&view=gurupcategs').'">'.JText::_("GURU_CLICK_HERE_TO_PURCHASE").'</a>';

}
?>	