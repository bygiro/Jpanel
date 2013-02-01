<?php
/**
 * @package		mod_jpanel
 * @copyright	Copyright (C) 2012 Girolamo Tomaselli All rights reserved.
 * @email		girotomaselli@gmail.com
 * @website		http://bygiro.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
	<div id="sidejPanel_<?php echo $module->id .'_'. $side; ?>" class="jPanel">
	<?php if ($side == 'bottom'){?>	
		<div class="jpanelHandle"><?php echo $button; ?></div>
	<?php } ?>

		<div class="jpanelContent">
	<?php 
	
		if($modorart == 0){
	
			jimport( 'joomla.application.module.helper' );
		
			$document = JFactory::getDocument();
			$renderer = $document->loadRenderer('module');
    
			echo '<ul class="modulelist">';
    		foreach($mods as $moddy){
    			//just to get rid of that stupid php warning
    			$moddy->user = '';
    			$parameters = array('style'=>'xhtml');
    			echo '<li class="jpanelMod">'.$renderer->render($moddy, $parameters).'</li>';
    		}
  			echo '</ul>';
  		
		}
		
		if($modorart == 1){
				
			$itemID = $arts[id];
			$url = 'index.php?option=com_content&view=article&id='.$itemID;
			$title = $arts[title];
			$intro = $arts[introtext];
			$full = $arts[fulltext];
			
			?><div><?php 
			echo '<h2>'.$title.'</h2>';
			echo $intro;
			if($full != ''){
				echo "<a href='.$url.'>Read More</a>";
			}
			?></div><?php 
		}
	?>
		</div>
	<?php if ($side != 'bottom'){?>	
		<div class="jpanelHandle"><?php echo $button; ?></div>
	<?php } ?>
	</div>
</div>