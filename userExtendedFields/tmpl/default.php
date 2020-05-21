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

?>

<?php if($contactDetails || $socialProfiles): ?>
<div class="userExtendedFields">
    <?php if($contactDetails && ($address || $city || $stateOrProvince || $zipCode || $country || $telephone || $mobile)): ?>
    <div class="userExtendedFieldsContactDetails">
        <h3><?php echo JText::_('PLG_K2_UEF_CONTACT_DETAILS'); ?></h3>
        <ul>
            <?php if($address): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_ADDRESS'); ?></div>
                <div class="userElementValue"><?php echo $address; ?></div>
            </li>
            <?php endif; ?>

            <?php if($city): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_CITY'); ?></div>
                <div class="userElementValue"><?php echo $city; ?></div>
            </li>
            <?php endif; ?>

            <?php if($stateOrProvince): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_STATE_OR_PROVINCE'); ?></div>
                <div class="userElementValue"><?php echo $stateOrProvince; ?></div>
            </li>
            <?php endif; ?>

            <?php if($zipCode): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_ZIP_CODE'); ?></div>
                <div class="userElementValue"><?php echo $zipCode; ?></div>
            </li>
            <?php endif; ?>

            <?php if($country): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_COUNTRY'); ?></div>
                <div class="userElementValue"><?php echo $country; ?></div>
            </li>
            <?php endif; ?>

            <?php if($telephone): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_TELEPHONE'); ?></div>
                <div class="userElementValue"><?php echo $telephone; ?></div>
            </li>
            <?php endif; ?>

            <?php if($mobile): ?>
            <li>
                <div class="userElementLabel"><?php echo JText::_('PLG_K2_UEF_MOBILE'); ?></div>
                <div class="userElementValue"><?php echo $mobile; ?></div>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="clr"></div>
    <?php endif; ?>

    <?php if($socialProfiles && isset($socialProfilesArray) && count($socialProfilesArray)): ?>
    <div class="userExtendedFieldsSocialProfiles">
        <h3><?php echo JText::_('PLG_K2_UEF_SOCIAL_PROFILES'); ?></h3>
        <?php foreach ($socialProfilesArray as $social => $data): ?>
        <?php
            $url = $data['url'];
            // B/C
            if (strpos($url, 'http') === false) {
                switch($social) {
                    case 'facebook':
                        $url = 'https://www.facebook.com/'.$url;
                        break;
                    case 'flickr':
                        $url = 'https://www.flickr.com/'.$url;
                        break;
                    case 'linkedin':
                        $url = 'https://www.linkedin.com/'.$url;
                        break;
                    case 'twitter':
                        $url = 'https://twitter.com/'.$url;
                        break;
                    case 'vimeo':
                        $url = 'https://vimeo.com/'.$url;
                        break;
                    case 'youtube':
                        $url = 'https://www.youtube.com/'.$url;
                        break;
                }
            }
        ?>
        <a class="uefSocialLink" href="<?php echo $url; ?>" title="<?php echo JText::_('PLG_K2_UEF_'.strtoupper($social)); ?>" target="_blank" rel="nofollow">
            <img alt="<?php echo JText::_('PLG_K2_UEF_'.strtoupper($social)); ?>" src="<?php echo $data['icon']; ?>" />
        </a>
        <?php endforeach; ?>
        <div class="clr"></div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
