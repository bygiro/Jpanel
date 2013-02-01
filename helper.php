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

/*
jimport('joomla.application.component.model');
JModel::addIncludePath(JPATH_SITE.'/components/com_content/models');
*/

class mod_jpanelHelper{
	
	public function return_modules($params){
		
		jimport( 'joomla.application.module.helper' );
		$pos = $params->get('whatMod');
		
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM #__modules WHERE position = '".$pos."' AND published = 1 ORDER BY ordering";
		$db->setQuery($sql);
		$modules = $db->loadObjectList();
		
		if ($params->def('prepare_content', 1))
		{
			JPluginHelper::importPlugin('content');
			foreach($modules as $module){				
				$module->content = JHtml::_('content.prepare', $module->content);
			}
		}
		
		return $modules;
	}
	
	public function return_article($params){
				
		$zearticle = $params->get('whatArt');

		$db = JFactory::getDBO();

		$sql = "SELECT * FROM #__content WHERE id = ".intval($zearticle);
		$db->setQuery($sql);
		$article = $db->loadAssoc();
		
		if ($params->def('prepare_content', 1))
		{
			JPluginHelper::importPlugin('content');
			$article['introtext'] = JHtml::_('content.prepare', $article['introtext']);
			$article['fulltext'] = JHtml::_('content.prepare', $article['fulltext']);

		}
		
		return $article;

	}
	
	public function load_jquery($params){
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();
		
		if($params->get('load_jquery')){	
			JLoader::import( 'joomla.version' );
			$version = new JVersion();
			if (version_compare( $version->RELEASE, '2.5', '<=')) {
				if($app->get('jquery') !== true) {
				$file='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';
				$app->set('jquery',1);
				$doc->addScript($file);
				}
			} else {
				JHtml::_('jquery.framework');
			}
		}			
	}
	
	public function verticaltext($string)
	{
		   $tlen = strlen($string);
		   $vtext = '';
		   for($i=0;$i<$tlen;$i++)
		   { 	
				$letter = substr($string,$i,1);
				if($letter == ' '){ $letter = '&nbsp;';}
				$vtext .= '<p>'. $letter ."</p>";  
		   }
		   return $vtext;
	}	
	
}
