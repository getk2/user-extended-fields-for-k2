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

// Load the K2 plugin API
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR.'/components/com_k2/lib/k2plugin.php');

class plgK2Userextendedfields extends K2Plugin
{

	// Required global reference parameters
	var $pluginName = 'userExtendedFields';
	var $pluginNameHumanReadable = 'User Extended Fields for K2';
	var $plgCopyrightsStart = "\n\n<!-- JoomlaWorks \"User Extended Fields for K2\" Plugin (v2.1) starts here -->\n";
	var $plgCopyrightsEnd = "\n<!-- JoomlaWorks \"User Extended Fields for K2\" Plugin (v2.1) ends here -->\n\n";


	public function __construct(&$subject, $params)
	{
		// Load the plugin language file the proper way
		JPlugin::loadLanguage('plg_k2_'.$this->pluginName, JPATH_ADMINISTRATOR);
		parent::__construct($subject, $params);
	}

	function onK2UserDisplay(&$user, &$params, $limitstart)
	{

		// API
		$mainframe = JFactory::getApplication();
		$document = JFactory::getDocument();

		// ----------------------------------- Get plugin parameters -----------------------------------

		// Global plugin params
		$contactDetails = $this->params->get('contactDetails', 0);
		$socialProfiles = $this->params->get('socialProfiles', 1);

		// K2 User plugin specific params
		$pluginParams = new K2Parameter($user->plugins, '', $this->pluginName);

		if ($contactDetails)
		{
			$address = $pluginParams->get('address');
			$city = $pluginParams->get('city');
			$stateOrProvince = $pluginParams->get('stateOrProvince');
			$zipCode = $pluginParams->get('zipCode');
			$country = $pluginParams->get('country');
			$telephone = $pluginParams->get('telephone');
			$mobile = $pluginParams->get('mobile');
		}
		if ($socialProfiles)
		{
			$facebook = $pluginParams->get('facebook');
			$twitter = $pluginParams->get('twitter');
			$google = $pluginParams->get('google');
			$linkedin = $pluginParams->get('linkedin');
			$youtube = $pluginParams->get('youtube');
			$vimeo = $pluginParams->get('vimeo');
			$blip = $pluginParams->get('blip');
			$flickr = $pluginParams->get('flickr');
			$picasa = $pluginParams->get('picasa');
		}

		// ----------------------------------- Requirements -----------------------------------
		require_once (dirname(__FILE__).'/'.$this->pluginName.'/includes/helper.php');

		// ----------------------------------- Head tag includes -----------------------------------
		// Append head includes, but not when we're outputing raw content in K2
		if (JRequest::getCmd('format') != 'raw')
		{
			$pluginCSS = userExtendedFieldsHelper::getTemplatePath($this->pluginName, 'css/template.css');
			$pluginCSS = $pluginCSS->http;
			$document->addStyleSheet($pluginCSS);
		}

		// ----------------------------------- Fetch the template -----------------------------------
		ob_start();
		$getTemplatePath = userExtendedFieldsHelper::getTemplatePath($this->pluginName, 'default.php');
		$getTemplatePath = $getTemplatePath->file;
		include ($getTemplatePath);
		$getTemplate = $this->plgCopyrightsStart.ob_get_contents().$this->plgCopyrightsEnd;
		ob_end_clean();

		// ----------------------------------- Output -----------------------------------
		return $getTemplate;

	}

} // End class
