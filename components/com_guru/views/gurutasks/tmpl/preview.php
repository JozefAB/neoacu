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

?>

<script type="text/javascript" language="javascript">
	document.body.className = document.body.className.replace("modal", "");
</script>

    <link rel="stylesheet" type="text/css" href="<?php echo JURI::root()."components/com_guru/css/guru-responsive.css"; ?>">
<?php

$id = JRequest::getVar("id", "0");
$nofull = JRequest::getVar("nofull", "0");

$media = $this->media;
$media = str_replace("%px", "%", $media);

echo $media;

if($this->type == "image" && $nofull == "0"){
?>
	<input type="button" class="uk-button uk-button-success btn-full-screen" onclick="window.open('<?php echo JURI::root(); ?>index.php?option=com_guru&view=gurutasks&task=preview&id=<?php echo intval($id); ?>&tmpl=component&format=raw&nofull=1')" value="<?php echo JText::_("GURU_FULL_SCREEN"); ?>" />
<?php
}
?>