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

defined( '_JEXEC' ) or die( 'Restricted access' );

$doc = JFactory::getDocument();

$medias = $this->medias;
$medians = $this->medians;
$guruModelguruauthor =  new guruModelguruauthor();

$ins_id = $guruModelguruauthor->id_for_last_question();
$ins_id=$ins_id+1;
	
$question_type = JRequest::getVar("type","");
$find_true = "";
$find_false = "";
$image ="";

$media_attached_to_question = $guruModelguruauthor->getMediaFromQuestion(@$medias->media_ids);

$is_new = JRequest::getVar("new_add","0");
$array_elements = array();

?>

<script type="text/javascript" language="javascript">
	document.body.className = document.body.className.replace("modal", "");
</script>

<style>
	.uk-grid{
		margin: 0px !important;
	}
	
	.component, .contentpane {
		background-color:#FFFFFF;
	}
	
	.modal{
		display:block;
	}
</style>

<script type="text/javascript" language="javascript">
	function validateForm(type){
		if(type == 'true_false'){
			if(document.getElementById("g_question_text").value =='' || document.getElementById("g_question_text").value =='<p><br></p>'){
				alert("<?php echo JText::_("GURU_ALERT_NO_QUESTION_TEXT");?>");
				return false;
			}
			else if(document.adminForm.truefs_ans.value == ''){
				alert("<?php echo JText::_("GURU_SELECT_AN_ANSWER");?>");	
				return false;
			}	
			else{
				document.adminForm.submit();
			}
		
		}
		if(type == 'single' || type == 'multiple'){
			var checked=false;
			var array_ans = document.getElementsByName("correct_ans[]");
			var pass = "ok";	
			var selected = [];
			var number_of_options_with_text = 0;
			
			for(var i=0; i < array_ans.length; i++){
				if(array_ans[i].checked) {
					checked = true;
					selected.push(i);
				}
				
				if(document.getElementById("ans"+i).value != ""){
					number_of_options_with_text ++;
				}
			}
			
			if(number_of_options_with_text < 2){
				pass = "not_ok";
				alert("<?php echo JText::_("GURU_AT_LEAST_TWO_OPTIONS"); ?>");
				return false;
			}
			
			if(document.getElementById("g_question_text").value ==''|| document.getElementById("g_question_text").value =='<p><br></p>'){
				pass = "not_ok";
				alert("<?php echo JText::_("GURU_ALERT_NO_QUESTION_TEXT");?>");
				return false;
			}
			
			if(!checked){
				pass = "not_ok";
				alert("<?php echo JText::_("GURU_SELECT_AN_ANSWER");?>");	
				return false;
			}			
			
			if(document.getElementById("ans0").value == '' && document.getElementById("ans_media_0").innerHTML == ''){
				pass = "not_ok";
				alert("<?php echo JText::_("GURU_AT_LEAST_ONE_ANSWER");?>");
				return false;
			}
			
			for(i=0; i<selected.length; i++){
				text = document.getElementById("ans"+selected[i]).value;
				media = document.getElementById("ans_media_"+selected[i]).innerHTML;
				
				if(text == "" && media.trim() == ""){
					pass = "not_ok";
					alert("<?php echo addslashes(JText::_("GURU_ADD_TEXT_FOR_CORRECT_ANS")); ?>");
					return false;
				}
			}
			
			if(pass == "ok"){
				document.adminForm.submit();
			}
				 
		}
		else if(type == 'essay'){
			if(document.getElementById("g_question_text").value =='' || document.getElementById("g_question_text").value =='<p><br></p>'){
				alert("<?php echo JText::_("GURU_ALERT_NO_QUESTION_TEXT");?>");
				return false;
			}
			else{
				document.adminForm.submit();
			}
		}	
	}
	
	function addquestion(qid, idu){
		var completed = 0;
		var qqqqid=<?php echo intval(JRequest::getVar('cid')); ?>;
		var type = '<?php echo JRequest::getVar('type'); ?>';
		var myrow = parent.document.createElement('TR');
		myrow.id = 'trque'+idu;
		parent.document.getElementById('newquizq').value = parent.document.getElementById('newquizq').value+','+idu;
		parent.document.getElementById('rowquestion').appendChild(myrow);
		var mycell0 = top.document.createElement('TD');
		myrow.appendChild(mycell0);
		var mycell9 = top.document.createElement('TD');
		myrow.appendChild(mycell9);
		var mycellsix = top.document.createElement('TD');
		myrow.appendChild(mycellsix);
		var mycell = top.document.createElement('TD');
		myrow.appendChild(mycell);
		var mycellthree = top.document.createElement('TD');
		myrow.appendChild(mycellthree);
		var mycellfour = top.document.createElement('TD');
		myrow.appendChild(mycellfour);
		var mycellfive = top.document.createElement('TD');
		myrow.appendChild(mycellfive);
		var span ='<span class="sortable-handler active" style="cursor: move;"><i class="icon-menu"></i></span>';
		
		var cb = '<input style="visibility:hidden" type="checkbox" onclick="isChecked(this.checked);" value="'+idu+'" name="cid[]" id="cb'+(i)+'">';
		var value = "cb"+i;
		
		mycell0.innerHTML = span;
		mycellsix.innerHTML = cb;
		mycell.innerHTML=document.adminForm.question_text.value;
		mycell9.innerHTML='<font color="#FF0000"><span onClick="delete_q('+idu+')">Remove</span></font>';
		mycellthree.innerHTML='<font color="#FF0000"><span onClick="delete_q('+idu+')">Remove</span></font>';
		
		mycellfour.innerHTML='<a style="color:#666666 !important;" class="modal" rel="{handler: \'iframe\', size: {x: 770, y: 400}}" href="<?php echo JURI::root(); ?>index.php?option=com_guru&controller=guruAuthor&task=addquestion&tmpl=component&cid='+qqqqid+'&qid='+idu+'&type='+type+'"><?php echo JText::_('GURU_EDIT');?></a>';
		
		mycellfive.innerHTML='Published';
		document.adminForm.submit();
		setTimeout('document.getElementById("newquizq").click()',1000);
		return true;
	}
	
	function deleteQuestionMedia(id){
		var myDiv = document.getElementById("guru_media"+id);
		myDiv.parentNode.removeChild(myDiv);
		
		//change button text
		document.getElementById('media_button_for_question').innerHTML = "<?php echo JText::_("GURU_ATTACH_MEDIA"); ?>";
	}
	
	function deleteAnswerMedia(id, radio_value){
		var myDiv = document.getElementById("ans_media_"+radio_value+"_"+id);
		myDiv.parentNode.removeChild(myDiv);
		
		//change button text
		document.getElementById('button_media_answers_'+radio_value).innerHTML = "<?php echo JText::_("GURU_ATTACH_MEDIA"); ?>";
	}
	
	function addMoreAnswersSingle(){
		current = document.getElementsByName("correct_ans[]").length;
		
		content = '<input type="radio" class="uk-float-left" name="correct_ans[]" id="answ'+current+'" value="'+current+'"><span class="lbl"></span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="uk-float-left uk-margin-left" value="" id="ans'+current+'" name="ans_content['+current+'][]">&nbsp;&nbsp;&nbsp;<button id="button_media_answers_'+current+'" onclick="accessMediaIframe(\'iframe_media_list_ans_'+current+'\'); return false;" class="uk-button uk-button-primary uk-float-left uk-margin-left"><?php echo JText::_("GURU_ATTACH_MEDIA"); ?></button><div class="clearfix"></div><div id="ans_media_'+current+'"></div><br /><div style="display:none;" id="iframe_media_list_ans_'+current+'"><iframe width="100%" height="350px;" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=answers&radio_value='+current+'" id="media_list_for_questions_answ"></iframe></div>';
		
		var myDiv = document.createElement('div');
		myDiv.className = "clearfix";
		myDiv.innerHTML = content;
		document.getElementById("div-options").appendChild(myDiv);
		
		return false;
	}
	
	function addMoreAnswersMultiple(){
		current = document.getElementsByName("correct_ans[]").length;
		
		content = '<input type="checkbox" class="uk-float-left" name="correct_ans[]" id="answ'+current+'" value="'+current+'"><span class="lbl"></span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="uk-float-left uk-margin-left" value="" id="ans'+current+'" name="ans_content['+(current+1)+'][]">&nbsp;&nbsp;&nbsp;<button id="button_media_answers_'+(current+1)+'" onclick="accessMediaIframe(\'iframe_media_list_ans_'+(current+1)+'\'); return false;" class="uk-button uk-button-primary uk-float-left uk-margin-left"><?php echo JText::_("GURU_ATTACH_MEDIA"); ?></button><div class="clearfix"></div><div id="ans_media_'+(current+1)+'"></div><br /><div style="display:none;" id="iframe_media_list_ans_'+(current+1)+'"><iframe width="100%" height="350px;" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=answers&radio_value='+(current+1)+'" id="media_list_for_questions_answ"></iframe></div>';
		
		var myDiv = document.createElement('div');
		myDiv.className = "clearfix";
		myDiv.innerHTML = content;
		document.getElementById("div-options").appendChild(myDiv);
		
		return false;
	}
	
	function accessMediaIframe(element){
		if(document.getElementById(element).style.display == "block"){
			document.getElementById(element).style.display = "none";
		}
		else{
			document.getElementById(element).style.display = "block";
		}
		return false;
	}
</script>

<form method="post" name="adminForm" id="adminForm" action="index.php" onsubmit="validateForm('<?php echo $question_type;?>'); return false;">
	<div class="uk-grid">
        <div class="uk-width-1-1 uk-text-right">
        	<button class="uk-button uk-button-success" onclick="addquestion(<?php echo $_GET['cid'].','.$ins_id;?>);"><?php echo JText::_("GURU_SV_AND_CL"); ?></button>
        	<button class="uk-button uk-button-success" onclick="document.adminForm.task.value='savequestionandkeep';"><?php echo JText::_("GURU_SAVE"); ?></button>
        </div>
    </div>
    
    <?php
		if($question_type == 'true_false'){ // start true/false choice question type
			echo '<div class="uk-grid"><div class="uk-width-1-1"><h2 class="gru-page-title">'.JText::_("GURU_QUIZ_TRUE_FALSE")." ".JText::_("GURU_QUESTION").'</h2></div></div>';
	?>
    	<div class="uk-grid">
    		<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-2-3">
        		<?php
                	echo '<b>'.JText::_("GURU_THE")." ".JText::_("GURU_QUESTION").'</b>';
				?>
                <div>
                    <textarea id="g_question_text" name="question_text" class="useredactor" style="width:80%; height:200px;"><?php echo html_entity_decode(@$medias->question_content);?></textarea>
                     <link rel="stylesheet" href="<?php echo JURI::root()."administrator/components/com_guru/css/redactor.css"; ?>" />
                    <script src="<?php echo JURI::root()."administrator/components/com_guru/js/redactor.min.js"; ?>"></script>
                </div> 
                
                <div id="g_media_list">
                    <?php
                        $button_label = JText::_("GURU_ATTACH_MEDIA");
                        if(count($media_attached_to_question) > 0){
                            $button_label = JText::_("GURU_CHANGE_MEDIA");
                            
                            foreach($media_attached_to_question as $key=>$value){
                                $srcimg = JURI::base()."/components/com_guru/images/";
                                $image = "doc.gif";
                                switch($value["type"]) {
                                    case "video": $image = "video.gif";	    						
                                        break;
                                    case "audio": $image = "audio.gif";	    						
                                        break;
                                    case "docs": $image = "doc.gif";	    						
                                        break;
                                    case "quiz": $image = "quiz.gif";	    						
                                        break;
                                    case "url": $image = "url.gif";	    						
                                        break;
                                    case "Article": $image = "url.gif";	    						
                                        break;											
                                    case "image": $image = "image.jpg";	    						
                                        break;	
                                    case "file": $image = "file.gif";	    						
                                        break;										
                                }
                                
                                echo '<div id="guru_media'.$value["id"].'"><img src="'.$srcimg.$image.'" />'.$value["name"].'<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteQuestionMedia('.$value["id"].')"><input type="hidden" id="question_media_ids_'.$value["id"].'" name="question_media_ids[]" value="'.$value["id"].'" /></div>';
                                
                            }
                        }
                    ?>
                </div>
                
                <div style="margin-top:20px;">
                    <button class="uk-button uk-button-primary" id="media_button_for_question" onclick="accessMediaIframe('iframe_media_list'); return false;"><?php echo $button_label; ?></button>
                </div>
                
                <div id="iframe_media_list" style="display:none;">
                    <iframe id="media_list_for_questions" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=question" width="100%" height="350px;"></iframe>
                </div>
			</div>
        
        	<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-3">
                <div style="margin-bottom:50px;">
                    <?php echo '<b>'.JText::_("GURU_PICK_CORRECT_ANS").'</b>';?>
                    <br/><br/><br/>
                    <?php
                        $id_question_req = JRequest::getVar("qid", "0");
                        $find_true = 2;
                        $find_false = 2;
                        if(intval($id_question_req) >0){
                            if($medians["0"]->correct_answer == 1){
                                $find_true = 0;
                                $find_false = 1;
                            }
                            else{
                                if($medians["0"]->correct_answer != -1){
                                    $find_true = 1;
                                    $find_false = 0;
                                }
                            }
                        }
                    ?>
                    <div>
                        <div class="pull-left">
                            <input type="radio" name="truefs_ans" value="0" <?php if($find_true == "1"){echo 'checked="checked"';}?> />
                            <span class="lbl"></span>
                        </div>
                        <div class="pull-left">
                            &nbsp;<?php echo JText::_("GURU_QUESTION_OPTION_TRUE"); ?>&nbsp;&nbsp;
                        </div>
                        <div class="pull-left">
                            <input type="radio" name="truefs_ans" value="1" <?php if($find_false == "1"){echo 'checked="checked"';} ?> />
                            &nbsp;
                            <span class="lbl"></span>
                        </div>
                        <div class="pull-left">
                            &nbsp;<?php echo JText::_("GURU_QUESTION_OPTION_FALSE"); ?>&nbsp;&nbsp;
                        </div>
                    </div>   
                </div>
            	<div class="clearfix"></div>
                <div>
                    <?php echo '<b>'.JText::_("GURU_OPTIONS").'</b>';?>
                    <br/><br/><br/>
                    <div>
                        <?php echo JText::_("GURU_QUESTION_WEIGHT")?>
                        <select name="question_weight_tf" id="question_weight_tf">
                            <?php
                            for($i=1; $i<=10; $i++){
                            ?>
                                <option value="<?php echo $i;?>" <?php if(@$medias->points == $i){echo 'selected="selected"';} ?> ><?php echo $i;?></option>
                            <?php    
                            }
                            ?>
                        </select>
                    </div>
    
                </div>
        	</div>
    <?php
		}
		else if($question_type == 'single'){ // start single choice question type
			echo '<div class="uk-grid"><div class="uk-width-1-1"><h2 class="gru-page-title">'.JText::_("GURU_QUIZ_SINGLE_CHOICE")." ".JText::_("GURU_QUESTION").'</h2></div></div>';
		?>
        	<div class="uk-grid">
				<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
					<?php echo '<b>'.JText::_("GURU_THE")." ".JText::_("GURU_QUESTION").'</b>';
                    ?>
                    <div>
                        <textarea id="g_question_text" name="question_text" class="useredactor" style="width:80%; height:200px;"><?php echo html_entity_decode(@$medias->question_content);?></textarea>
                         <link rel="stylesheet" href="<?php echo JURI::root()."administrator/components/com_guru/css/redactor.css"; ?>" />
                        <script src="<?php echo JURI::root()."administrator/components/com_guru/js/redactor.min.js"; ?>"></script>
                    </div> 
                    <div id="g_media_list">
                        <?php
                            $button_label = JText::_("GURU_ATTACH_MEDIA");
                            if(count($media_attached_to_question) > 0){
                                $button_label = JText::_("GURU_CHANGE_MEDIA");
                                
                                foreach($media_attached_to_question as $key=>$value){
                                    $srcimg = JURI::base()."/components/com_guru/images/";
                                    $image = "doc.gif";
                                    switch($value["type"]) {
                                        case "video": $image = "video.gif";	    						
                                            break;
                                        case "audio": $image = "audio.gif";	    						
                                            break;
                                        case "docs": $image = "doc.gif";	    						
                                            break;
                                        case "quiz": $image = "quiz.gif";	    						
                                            break;
                                        case "url": $image = "url.gif";	    						
                                            break;
                                        case "Article": $image = "url.gif";	    						
                                            break;											
                                        case "image": $image = "image.jpg";	    						
                                            break;	
                                        case "file": $image = "file.gif";	    						
                                            break;										
                                    }
                                    
                                    echo '<div id="guru_media'.$value["id"].'"><img src="'.$srcimg.$image.'" />'.$value["name"].'<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteQuestionMedia('.$value["id"].')"><input type="hidden" id="question_media_ids_'.$value["id"].'" name="question_media_ids[]" value="'.$value["id"].'" /></div>';
                                    
                                }
                            }
                        ?>
                    </div>
                    <div style="margin-top:20px;">
                        <button class="uk-button uk-button-primary" id="media_button_for_question" onclick="accessMediaIframe('iframe_media_list'); return false;"><?php echo $button_label; ?></button>
                    </div>
                    <div id="iframe_media_list" style="display:none;">
                        <iframe id="media_list_for_questions" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=question" width="100%" height="350px;"></iframe>
                    </div>
				</div>
				
                <div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                    <div id="div-options">
                        <div class="clearfix">
                            <?php echo '<b>'.JText::_("GURU_PICK_CORRECT_ANS").'</b>';?>
                        </div>
                        
                        <?php
                            if(isset($is_new) && $is_new == 1){
                                $array_elements = array( array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label), array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label),array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label));
                            }
                            else{
                                foreach($medians as $key=>$value){
                                    $media_attached_to_answers = $guruModelguruauthor->getMediaFromAnswer($value->media_ids);
                                    $temp = array();
                                    $button_label = JText::_("GURU_ATTACH_MEDIA");
                                    
                                    foreach($media_attached_to_answers as $key_media=>$value_media){
                                        $button_label = JText::_("GURU_CHANGE_MEDIA");
                                        $srcimg = JURI::base()."/components/com_guru/images/";
                                        $image = "doc.gif";
                                        switch($value_media["type"]) {
                                            case "video": $image = "video.gif";	    						
                                                break;
                                            case "audio": $image = "audio.gif";	    						
                                                break;
                                            case "docs": $image = "doc.gif";	    						
                                                break;
                                            case "quiz": $image = "quiz.gif";	    						
                                                break;
                                            case "url": $image = "url.gif";	    						
                                                break;
                                            case "Article": $image = "url.gif";	    						
                                                break;											
                                            case "image": $image = "image.jpg";	    						
                                                break;	
                                            case "file": $image = "file.gif";	    						
                                                break;										
                                        }
                                        
                                        $temp[] = '<div id="ans_media_'.$value->id."_".$value_media["id"].'">
                                                        <img src="'.$srcimg.$image.'" />'.
                                                        $value_media["name"].
                                                        '<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteAnswerMedia('.$value_media["id"].', '.intval($value->id).')">
                                                        <input type="hidden" id="ans_media_ids_'.$value->id."_".$value_media["id"].'" name="ans_media_ids['.$value->id.'][]" value="'.$value_media["id"].'" />
                                                   </div>';
                                        
                                    }
                                
                                    $array_elements[] = array("id"=>$value->id, "default"=>$value->correct_answer, "answer_content"=>$value->answer_content_text, "media"=>$temp, "label"=>$button_label);
                                }
                            }
                            
                            $content_to_display = "";
                            foreach($array_elements as $key=>$value){
                                $checked = '';
                                if($value["default"] == "1"){
                                    $checked = 'checked="checked"';
                                }
                                
                                $radio_value = $value["id"];
                                if(isset($is_new) && $is_new == 1){
                                    $radio_value = $key;
                                }
                                
                                $content_to_display .= '<div class="clearfix">
                                                            <input type="radio" class="uk-float-left" value="'.$radio_value.'" id="answ'.$key.'" name="correct_ans[]" '.$checked.' /><span class="lbl"></span>&nbsp; &nbsp;
                                                            <input type="text" class="uk-float-left uk-margin-left" name="ans_content['.$radio_value.'][]" id="ans'.$key.'" value="'.$value["answer_content"].'" />&nbsp;&nbsp;
                                                            <button class="uk-button uk-button-primary uk-float-left uk-margin-left" id="button_media_answers_'.$radio_value.'" onclick="accessMediaIframe(\'iframe_media_list_ans_'.$radio_value.'\'); return false;">'. $value["label"].'</button>
                                                            <div class="clearfix"></div>
															<div id="ans_media_'.$radio_value.'">
                                                                '.@implode(" ", $value["media"]).'
                                                            </div>
                                                            <br />
                                                            <div id="iframe_media_list_ans_'.$radio_value.'" style="display:none;">
                                                                <iframe id="media_list_for_questions_answ" frameborder="0" src="'.JURI::root().'index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=answers&radio_value='.$radio_value.'" width="100%" height="350px;"></iframe>
                                                            </div>
                                                        </div>';
                            }
                            echo $content_to_display;
                        ?>
                    </div>
                
					<input type="button" onclick="javascript:addMoreAnswersSingle();" class="uk-button uk-button-primary" value="<?php echo JText::_("GURU_ADD_MORE"); ?>" />
                
                	<div class="clearfix"></div>
                	<br/>
                	<?php echo '<b>'.JText::_("GURU_OPTIONS").'</b>';?>
                	<div class="clearfix"></div>
                    <div>
                        <?php echo JText::_("GURU_QUESTION_WEIGHT")?>
                        <select name="question_weight_tf" id="question_weight_tf">
                            <?php
                            for($i=1; $i<=10; $i++){
                            ?>
                                <option value="<?php echo $i;?>" <?php if(@$medias->points == $i){echo 'selected="selected"';} ?> ><?php echo $i;?></option>
                            <?php    
                            }
                            ?>
                        </select>
                    </div>
				</div>
			</div>
		<?php
		}
		else if($question_type == 'multiple'){ // start mutiple choice question type
			echo '<div class="uk-grid"><div class="uk-width-1-1"><h2 class="gru-page-title">'.JText::_("GURU_QUIZ_MULTIPLE_CHOICE")." ".JText::_("GURU_QUESTION").'</h2></div></div>';
		?>
			<div class="uk-grid">
				<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
					<?php echo '<b>'.JText::_("GURU_THE")." ".JText::_("GURU_QUESTION").'</b>';
                    ?>
                    <div>
                        <textarea id="g_question_text" name="question_text" class="useredactor" style="width:80%; height:200px;"><?php echo html_entity_decode(@$medias->question_content);?></textarea>
                         <link rel="stylesheet" href="<?php echo JURI::root()."administrator/components/com_guru/css/redactor.css"; ?>" />
                        <script src="<?php echo JURI::root()."administrator/components/com_guru/js/redactor.min.js"; ?>"></script>
                    </div> 
                    <div id="g_media_list">
                        <?php
                            $button_label = JText::_("GURU_ATTACH_MEDIA");
                            if(count($media_attached_to_question) > 0){
                                $button_label = JText::_("GURU_CHANGE_MEDIA");
                                
                                foreach($media_attached_to_question as $key=>$value){
                                    $srcimg = JURI::base()."/components/com_guru/images/";
                                    $image = "doc.gif";
                                    switch($value["type"]) {
                                        case "video": $image = "video.gif";	    						
                                            break;
                                        case "audio": $image = "audio.gif";	    						
                                            break;
                                        case "docs": $image = "doc.gif";	    						
                                            break;
                                        case "quiz": $image = "quiz.gif";	    						
                                            break;
                                        case "url": $image = "url.gif";	    						
                                            break;
                                        case "Article": $image = "url.gif";	    						
                                            break;											
                                        case "image": $image = "image.jpg";	    						
                                            break;	
                                        case "file": $image = "file.gif";	    						
                                            break;										
                                    }
                                    
                                    echo '<div id="guru_media'.$value["id"].'"><img src="'.$srcimg.$image.'" />'.$value["name"].'<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteQuestionMedia('.$value["id"].')"><input type="hidden" id="question_media_ids_'.$value["id"].'" name="question_media_ids[]" value="'.$value["id"].'" /></div>';
                                    
                                }
                            }
                        ?>
					</div>
                    <div style="margin-top:20px;">
                        <button class="uk-button uk-button-primary" id="media_button_for_question" onclick="accessMediaIframe('iframe_media_list'); return false;"><?php echo $button_label; ?></button>
                    </div>
                    <div id="iframe_media_list" style="display:none;">
                        <iframe id="media_list_for_questions" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=question" width="100%" height="350px;"></iframe>
                    </div>
				</div>
                
				<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                    <div id="div-options">
                        <div class="clearfix">
                            <?php echo '<b>'.JText::_("GURU_PICK_CORRECT_ANS").'</b>';?>
                        </div>
                        
                        <?php
                            if(isset($is_new) && $is_new == 1){
                                $array_elements = array( array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label), array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label),array("id"=>"0", "default"=>"0", "answer_content"=>"", "media"=>"", "label"=>$button_label));
                            }
                            else{
                                foreach($medians as $key=>$value){
                                    $button_label = JText::_("GURU_ATTACH_MEDIA");
                                    $media_attached_to_answers = $guruModelguruauthor->getMediaFromAnswer($value->media_ids);
                                    $temp = array();
                                    
                                    foreach($media_attached_to_answers as $key_media=>$value_media){
                                        $button_label = JText::_("GURU_CHANGE_MEDIA");
                                        $srcimg = JURI::base()."/components/com_guru/images/";
                                        $image = "doc.gif";
                                        switch($value_media["type"]) {
                                            case "video": $image = "video.gif";	    						
                                                break;
                                            case "audio": $image = "audio.gif";	    						
                                                break;
                                            case "docs": $image = "doc.gif";	    						
                                                break;
                                            case "quiz": $image = "quiz.gif";	    						
                                                break;
                                            case "url": $image = "url.gif";	    						
                                                break;
                                            case "Article": $image = "url.gif";	    						
                                                break;											
                                            case "image": $image = "image.jpg";	    						
                                                break;	
                                            case "file": $image = "file.gif";	    						
                                                break;										
                                        }
                                        
                                        $temp[] = '<div id="ans_media_'.$value->id."_".$value_media["id"].'">
                                                        <img src="'.$srcimg.$image.'" />'.
                                                        $value_media["name"].
                                                        '<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteAnswerMedia('.$value_media["id"].', '.intval($value->id).')">
                                                        <input type="hidden" id="ans_media_ids_'.$value->id."_".$value_media["id"].'" name="ans_media_ids['.$value->id.'][]" value="'.$value_media["id"].'" />
                                                   </div>';
                                        
                                    }
                                
                                    $array_elements[] = array("id"=>$value->id, "default"=>$value->correct_answer, "answer_content"=>$value->answer_content_text, "media"=>$temp, "label"=>$button_label);
                                }
                            }
                            
                            $content_to_display = "";
                            foreach($array_elements as $key=>$value){
                                $checked = '';
                                if($value["default"] == "1"){
                                    $checked = 'checked="checked"';
                                }
                                
                                $radio_value = $value["id"];
                                if(isset($is_new) && $is_new == 1){
                                    $radio_value = $key;
                                }
                                
                                $content_to_display .= '<div class="clearfix">
                                                            <input type="checkbox" class="uk-float-left" value="'.$radio_value.'" id="answ'.$key.'" name="correct_ans[]" '.$checked.' /><span class="lbl"></span>&nbsp; &nbsp;
                                                            <input type="text" class="uk-float-left uk-margin-left" name="ans_content['.$radio_value.'][]" id="ans'.$key.'" value="'.$value["answer_content"].'" />&nbsp;&nbsp;
                                                            <button class="uk-button uk-button-primary uk-float-left uk-margin-left" id="button_media_answers_'.$radio_value.'" onclick="accessMediaIframe(\'iframe_media_list_ans_'.$radio_value.'\'); return false;">'.$value["label"].'</button>
                                                            <div class="clearfix"></div>
															<div id="ans_media_'.$radio_value.'">
                                                                '.@implode(" ", $value["media"]).'
                                                            </div>
                                                            <br />
                                                            <div id="iframe_media_list_ans_'.$radio_value.'" style="display:none;">
                                                                <iframe id="media_list_for_questions_answ" frameborder="0" src="'.JURI::root().'index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=answers&radio_value='.$radio_value.'" width="100%" height="350px;"></iframe>
                                                            </div>
                                                        </div>';
                            }
                            echo $content_to_display;
                        ?>
                    </div>
                
					<input type="button" onclick="javascript:addMoreAnswersMultiple();" class="uk-button uk-button-primary" value="<?php echo JText::_("GURU_ADD_MORE"); ?>" />
                
                    <div class="clearfix"></div>
                    <br/>
                    <?php echo '<b>'.JText::_("GURU_OPTIONS").'</b>';?>
                    <div class="clearfix"></div>
                    <div>
                        <?php echo JText::_("GURU_QUESTION_WEIGHT")?>
                        <select name="question_weight_tf" id="question_weight_tf">
                            <?php
                            for($i=1; $i<=10; $i++){
                            ?>
                                <option value="<?php echo $i;?>" <?php if(@$medias->points == $i){echo 'selected="selected"';} ?> ><?php echo $i;?></option>
                            <?php    
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
		<?php		
		}
		else if($question_type == 'essay'){ // start essay question type
			echo '<div class="uk-grid"><div class="uk-width-1-1"><h2 class="gru-page-title">'.JText::_("GURU_QUIZ_ESSAY")." ".JText::_("GURU_QUESTION").'</h2></div></div>';
	?>
    	<div class="uk-grid">
			<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
				<?php echo '<b>'.JText::_("GURU_THE")." ".JText::_("GURU_QUESTION").'</b>';
                ?>
                <div>
                    <textarea id="g_question_text" name="question_text" class="useredactor" style="width:80%; height:200px;"><?php echo html_entity_decode(@$medias->question_content);?></textarea>
                     <link rel="stylesheet" href="<?php echo JURI::root()."administrator/components/com_guru/css/redactor.css"; ?>" />
                    <script src="<?php echo JURI::root()."administrator/components/com_guru/js/redactor.min.js"; ?>"></script>
                </div> 
                <div id="g_media_list">
                    <?php
                        $button_label = JText::_("GURU_ATTACH_MEDIA");
                        if(count($media_attached_to_question) > 0){
                            $button_label = JText::_("GURU_CHANGE_MEDIA");
                            
                            foreach($media_attached_to_question as $key=>$value){
                                $srcimg = JURI::base()."/components/com_guru/images/";
                                $image = "doc.gif";
                                switch($value["type"]) {
                                    case "video": $image = "video.gif";	    						
                                        break;
                                    case "audio": $image = "audio.gif";	    						
                                        break;
                                    case "docs": $image = "doc.gif";	    						
                                        break;
                                    case "quiz": $image = "quiz.gif";	    						
                                        break;
                                    case "url": $image = "url.gif";	    						
                                        break;
                                    case "Article": $image = "url.gif";	    						
                                        break;											
                                    case "image": $image = "image.jpg";	    						
                                        break;	
                                    case "file": $image = "file.gif";	    						
                                        break;										
                                }
                                
                                echo '<div id="guru_media'.$value["id"].'"><img src="'.$srcimg.$image.'" />'.$value["name"].'<img border="0" src="'.JURI::root().'administrator/components/com_guru/images/delete.gif" onclick="javascript:deleteQuestionMedia('.$value["id"].')"><input type="hidden" id="question_media_ids_'.$value["id"].'" name="question_media_ids[]" value="'.$value["id"].'" /></div>';
                                
                            }
                        }
                    ?>
                </div>
                <div style="margin-top:20px;">
                    <button class="uk-button uk-button-primary" id="media_button_for_question" onclick="accessMediaIframe('iframe_media_list'); return false;"><?php echo $button_label; ?></button>
                </div>
                <div id="iframe_media_list" style="display:none;">
                    <iframe id="media_list_for_questions" frameborder="0" src="<?php echo JURI::root();?>index.php?option=com_guru&view=guruauthor&layout=authormymedia&tmpl=component&page_from=question" width="100%" height="350px;"></iframe>
                </div>
            </div>
        
        	<div class="uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
				<?php echo '<b>'.JText::_("GURU_OPTIONS").'</b>';?>
                <br/><br/><br/>
                <div>
                    <?php echo JText::_("GURU_QUESTION_WEIGHT")?>
                    <select name="question_weight_tf" id="question_weight_tf">
                        <?php
                        for($i=1; $i<=10; $i++){
                        ?>
                            <option value="<?php echo $i;?>" <?php if(@$medias->points == $i){echo 'selected="selected"';} ?> ><?php echo $i;?></option>
                        <?php    
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    <?php
		}
    
$upload_script = 'jQuery(function(){
					jQuery(".useredactor").redactor({
						 buttons: [\'bold\', \'italic\', \'underline\', \'link\', \'alignment\', \'unorderedlist\', \'orderedlist\']
					});
					jQuery(".redactor_useredactor").css("height","200px");
				  });';
$doc->addScriptDeclaration($upload_script);
?>			
	<input type="hidden" value="com_guru" name="option"/>
	<input type="hidden" value="savequestion" name="task"/>
    <input type="hidden" value="<?php echo $question_type;?>" name="type"/>
	<input type="hidden" value="<?php echo intval($_GET['cid']);?>" name="quizid"/>
	<input type="hidden" value="guruAuthor" name="controller"/>
    <input type="hidden" value="<?php echo @$_GET['is_from_modal']; ?>" name="is_from_modal">
    <input type="hidden" value="<?php echo @$_GET['qid']; ?>" name="question_id">
    <input type="hidden" value="<?php echo JRequest::getVar("tmpl", ""); ?>" name="tmpl">
</form>