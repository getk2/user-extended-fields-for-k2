<?php
/**
 * @version		3.0
 * @package		User Extended Fields for K2 (K2 plugin)
 * @author    	JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ;

class userExtendedFieldsHelper
{

	// Path overrides
	public static function getTemplatePath($pluginName, $file)
	{
		$mainframe = JFactory::getApplication();
		$p = new stdClass;
		if (file_exists(JPATH_SITE.'/templates/'.DS.$mainframe->getTemplate().'/html/'.$pluginName.'/'.$file))
		{
			$p->file = JPATH_SITE.'/templates/'.$mainframe->getTemplate().'/html/'.$pluginName.'/'.$file;
			$p->http = JURI::root(true).'/templates/'.$mainframe->getTemplate().'/html/'.$pluginName.'/'.$file;
		}
		else
		{
			$p->file = JPATH_SITE.'/plugins/k2/'.$pluginName.'/'.$pluginName.'/tmpl/'.$file;
			$p->http = JURI::root(true).'/plugins/k2/'.$pluginName.'/'.$pluginName.'/tmpl/'.$file;
		}
		return $p;
	}

} // end class
