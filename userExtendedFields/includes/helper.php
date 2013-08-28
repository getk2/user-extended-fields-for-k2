<?php
/**
 * @version		2.1
 * @package		User Extended Fields for K2 (K2 plugin)
 * @author    JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class userExtendedFieldsHelper {

	// Path overrides
	public static function getTemplatePath($pluginName,$file){
		$mainframe= JFactory::getApplication();
		$p = new JObject;
		if(file_exists(JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$pluginName.DS.str_replace('/',DS,$file))){
			$p->file = JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$pluginName.DS.$file;
			$p->http = JURI::root(true)."/templates/".$mainframe->getTemplate()."/html/{$pluginName}/{$file}";
		} else {
			if(K2_JVERSION == '15') {
				$p->file = JPATH_SITE.DS.'plugins'.DS.'k2'.DS.$pluginName.DS.'tmpl'.DS.$file;
				$p->http = JURI::root(true)."/plugins/k2/{$pluginName}/tmpl/{$file}";
			} else {
				$p->file = JPATH_SITE.DS.'plugins'.DS.'k2'.DS.$pluginName.DS.$pluginName.DS.'tmpl'.DS.$file;
				$p->http = JURI::root(true)."/plugins/k2/{$pluginName}/{$pluginName}/tmpl/{$file}";
			}
		}
		return $p;
	}

} // end class
