<?php
/**
 * @version     4.0
 * @package     User Extended Fields for K2 (K2 plugin)
 * @author      JoomlaWorks - http://www.joomlaworks.net
 * @copyright   Copyright (c) 2006 - 2020 JoomlaWorks Ltd. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Load the K2 plugin API
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR.'/components/com_k2/lib/k2plugin.php');

class plgK2Userextendedfields extends K2Plugin
{
    // Reference Parameters
    public $pluginName = 'userExtendedFields';
    public $pluginNameHumanReadable = 'User Extended Fields for K2';
    public $plgCopyrightsStart = "\n\n<!-- JoomlaWorks \"User Extended Fields for K2\" Plugin (v4.0) starts here -->\n";
    public $plgCopyrightsEnd = "\n<!-- JoomlaWorks \"User Extended Fields for K2\" Plugin (v4.0) ends here -->\n\n";

    public function __construct(&$subject, $params)
    {
        // Load the plugin language file the proper way
        JPlugin::loadLanguage('plg_k2_'.strtolower($this->pluginName), JPATH_ADMINISTRATOR);
        parent::__construct($subject, $params);
    }

    public function onK2UserDisplay(&$user, &$params, $limitstart)
    {
        // API
        $app = JFactory::getApplication();
        $document = JFactory::getDocument();

        // Global plugin params
        $contactDetails = $this->params->get('contactDetails', 0);
        $socialProfiles = $this->params->get('socialProfiles', 1);

        // K2 User plugin specific params
        $pluginParams = new K2Parameter($user->plugins, '', $this->pluginName);

        if ($contactDetails) {
            $address = $pluginParams->get('address');
            $city = $pluginParams->get('city');
            $stateOrProvince = $pluginParams->get('stateOrProvince');
            $zipCode = $pluginParams->get('zipCode');
            $country = $pluginParams->get('country');
            $telephone = $pluginParams->get('telephone');
            $mobile = $pluginParams->get('mobile');
        }
        if ($socialProfiles) {
            $spu = array(
                'facebook',
                'instagram',
                'linkedin',
                'twitter',
                'youtube',

                '500px',
                'behance',
                'bitbucket',
                'codepen',
                'dailymotion',
                'dribbble',
                'flickr',
                'github',
                'gitlab',
                'mastodon',
                'medium',
                'messenger',
                'mixcloud',
                'pinterest',
                'skype',
                'soundcloud',
                'telegram',
                'tiktok',
                'tumblr',
                'twitch',
                'viber',
                'vimeo',
                'whatsapp',
            );

            $socialProfilesArray = array();

            foreach ($spu as $social) {
                $param = $pluginParams->get($social, '');
                if (!empty($param)) {
                    $socialProfilesArray[$social] = array(
                        'icon' => $this->getTemplatePath($this->pluginName, 'images/'.$social.'.svg')->http,
                        'url' => $pluginParams->get($social, '')
                    );
                }
            }
        }

        // Append head includes (HTML output only)
        if (JRequest::getCmd('format') == '' || JRequest::getCmd('format') == 'html') {
            $pluginCSS = $this->getTemplatePath($this->pluginName, 'css/template.css');
            $pluginCSS = $pluginCSS->http;
            $document->addStyleSheet($pluginCSS.'?v=4.0');
        }

        // Fetch the template
        ob_start();
        $getTemplatePath = $this->getTemplatePath($this->pluginName, 'default.php');
        $getTemplatePath = $getTemplatePath->file;
        include $getTemplatePath;
        $getTemplate = $this->plgCopyrightsStart.ob_get_contents().$this->plgCopyrightsEnd;
        ob_end_clean();

        // Output
        return $getTemplate;
    }

    // Path overrides
    private function getTemplatePath($pluginName, $file)
    {
        $app = JFactory::getApplication();
        $p = new stdClass;
        if (file_exists(JPATH_SITE.'/templates/'.DS.$app->getTemplate().'/html/'.$pluginName.'/'.$file)) {
            $p->file = JPATH_SITE.'/templates/'.$app->getTemplate().'/html/'.$pluginName.'/'.$file;
            $p->http = JURI::root(true).'/templates/'.$app->getTemplate().'/html/'.$pluginName.'/'.$file;
        } else {
            $p->file = JPATH_SITE.'/plugins/k2/'.$pluginName.'/'.$pluginName.'/tmpl/'.$file;
            $p->http = JURI::root(true).'/plugins/k2/'.$pluginName.'/'.$pluginName.'/tmpl/'.$file;
        }
        return $p;
    }
}
