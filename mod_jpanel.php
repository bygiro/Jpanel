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

mb_internal_encoding("UTF-8");

//include the class of the syndicate functions only once
require_once(dirname(__FILE__).'/helper.php');

//add stylesheet
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_jpanel/assets/css/style.css', 'text/css' );

$helper = new mod_jpanelHelper();
$helper->load_jquery($params); // add jquery

$side = $params->get('side');
$jpanel_ID = '#sidejPanel_'. $module->id .'_'. $side;
$modorart = $params->get('modOrArt');
$trigger = $params->get('trigger');
$distance = $params->get('distance');

$setHeight = $params->get('setHeight');
$style = $jpanel_ID .",". $jpanel_ID ." .jpanelContent{height: ". $setHeight ."px; }";

$setWidth = $params->get('setWidth');
$style .= $jpanel_ID .",". $jpanel_ID ." .jpanelContent{width: ". $setWidth ."px; }";

$buttonColor = $params->get('buttonColor');
$buttonTextColor = $params->get('buttonTextColor');
$style .= $jpanel_ID ." .jpanelHandle{background-color: ". $buttonColor ."; color: ". $buttonTextColor ."; } ". $jpanel_ID ." .jpanelContent{ border:1px solid ". $buttonColor ."; }";

$bckColor = $params->get('bckColor');
$style .= $jpanel_ID ." .jpanelContent{background-color: ". $bckColor ."; }";

$display = $params->get('display');
if ($display){
	$style .= "ul.modulelist li{display: inline; }";
}

$buttonType = $params->get('buttonType', 'nothing');
$extra = '';
switch ($side){
	case 'top';
		$style .= $jpanel_ID ."{top:". ($setHeight + 1)* -1 ."px; left:". $distance .";}\n";	
		$style .= $jpanel_ID ." .jpanelHandle{border-radius:0 0 5px 5px;}\n";
		$buttonText = '<p>'. $params->get('buttonText') .'</p>';
		$nothing = '<p>&nbsp;&nbsp;&nbsp;</p>';
		if($buttonType == 'text'){
			$extra .= 'jQuery("'. $jpanel_ID .' .jpanelHandle").css("width", jQuery("'. $jpanel_ID .' .jpanelHandle p").textWidth() + "px");';
		}
	break;

	case 'bottom';
		$style .= $jpanel_ID ."{bottom:". ($setHeight + 1)* -1 ."px; left:". $distance .";}\n";	
		$style .= $jpanel_ID ." .jpanelHandle{border-radius:5px 5px 0 0;}\n";
		$buttonText = '<p>'. $params->get('buttonText').'</p>';
		$nothing = '<p>&nbsp;&nbsp;&nbsp;</p>';
		if($buttonType == 'text'){
			$extra .= 'jQuery("'. $jpanel_ID .' .jpanelHandle").css("width", jQuery("'. $jpanel_ID .' .jpanelHandle p").textWidth() + "px");';
		}
	break;
	
	case 'left';
		$style .= $jpanel_ID ."{left:". ($setWidth + 11)* -1 ."px; top:". $distance .";}\n";	
		$style .= $jpanel_ID ." .jpanelHandle p{margin: 0;}\n";	
		$style .= $jpanel_ID ." .jpanelHandle{border-radius:0 5px 5px 0;}\n";	
		$style .= $jpanel_ID ." .jpanelHandle, ". $jpanel_ID ." .jpanelContent{float:left;}\n";
		$buttonText = '<p>'. $helper->verticaltext($params->get('buttonText')) .'</p>';
		$nothing = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
	break;
		
	case 'right';
		$style .= $jpanel_ID ."{right:". ($setWidth + 11)* -1 ."px; top:". $distance .";}\n";	
		$style .= $jpanel_ID ." .jpanelHandle p{margin: 0;}\n";	
		$style .= $jpanel_ID ." .jpanelHandle{border-radius:5px 0 0 5px;}\n";	
		$style .= $jpanel_ID ." .jpanelHandle, ". $jpanel_ID ." .jpanelContent{float:right;}\n";
		$buttonText = '<p>'. $helper->verticaltext($params->get('buttonText')) .'</p>';
		$nothing = '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
	break;	
}


$button = '';
switch ($buttonType){
	case 'img':
		$button = '<img src="'. $params->get('buttonImg'). '" />';
	break;
	
	case 'html':
		$button = $params->get('buttonHtml');
	break;
	
	case 'nothing':
		$button = $nothing;
	break;
	
	case 'txt':
	default:
		$button = $buttonText;
	break;
}
$doc->addStyleDeclaration( $style );

$doc->addScript(JURI::root(true).'/modules/mod_jpanel/assets/js/jpanel.min.js');

$doc->addScriptDeclaration('
	jQuery(window).load(function() {
		'. $extra .'
		'. $trigger .'Jpanel("'. $jpanel_ID .'");
		
		initjPanelHandle("'. $jpanel_ID .'");
	});
');

// type of content
if($params->get('modOrArt') == 0){
	$mods = $helper->return_modules($params);	
} else if($params->get('modOrArt') == 1){
	$arts = $helper->return_article($params);
}

//keeps module class suffix even if templateer tries to stop it
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));




require JModuleHelper::getLayoutPath('mod_jpanel', $params->get('layout', 'default'));
