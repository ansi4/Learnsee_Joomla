<?php
defined("_JEXEC") or die("Restricted access");
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links Module
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2014 Steven Palmer All rights reserved.
 *
 * CoalaWeb Social Links is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once dirname(__FILE__) . '/helper.php';
include_once JPATH_ADMINISTRATOR.'/components/com_coalawebsociallinks/version.php';

//Keeping the parameters in the component keeps things clean and tidy.
$comParams = JComponentHelper::getParams('com_coalawebsociallinks');


$lang = JFactory::getLanguage();

//Load the module language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('mod_coalawebsociallinks', JPATH_SITE, 'en-GB');
}
$lang->load('mod_coalawebsociallinks', JPATH_SITE, null, 1);

//Load the component language strings
if ($lang->getTag() != 'en-GB') {
    $lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, 'en-GB');
}
$lang->load('com_coalawebsociallinks', JPATH_ADMINISTRATOR, null, 1);

$doc = JFactory::getDocument();
$moduleClassSfx = htmlspecialchars($params->get('moduleclass_sfx'));

/* Link details */
$linkDefault = $params->get('link_default');
if ($linkDefault) {
    $link = $linkDefault;
} else {
    $link = JURI::getInstance()->toString();
}
$link = rawurlencode($link);

// Let's shorten that URL!
if($comParams->get("short_url_service") && $comParams->get("shorten_social_mod")) {
    $link = CoalawebSocialLinksHelper::getShortUrl($link, $params);
}

/* Title details */
$titleDefault = $params->get('title_default');
if ($titleDefault) {
    $title = $titleDefault;
} else {
    $title = $doc->getTitle();
}
$title= rawurlencode($title);

$linknofollow = ($params->get('link_nofollow') ? ' rel="' . $params->get('link_nofollow'). '"' : '');

/* Icon settings */
$icon_align = $params->get('icon_align');

/* Theme */
$themes_icon = $params->get('themes_icon');
$size = $params->get('icon_size');


/* Module Settings */
$module_unique_id = $params->get('module_unique_id');
$module_width = $params->get('module_width');

/* Sections settings */
$display_bm_sec = $params->get('display_bm_sec');
$display_f_sec = $params->get('display_f_sec');

/* Border settings */
$display_borders = $params->get('display_borders');
$border_width = $params->get('border_width');
$border_color_bm = $params->get('border_color_bm');
$border_color_f = $params->get('border_color_f');

/* Layouts */
$layout = $params->get('layout');

/* Titles */
$title_align = $params->get('title_align');
$title_format = $params->get('title_format');
$title_bm = $params->get('title_bm', JTEXT::_('MOD_COALAWEBSOCIALLINKS_TITLE_BOOKMARK'));
$display_title_bm = $params->get('display_title_bm');
$title_color_bm = $params->get('title_color_bm');
$title_f = $params->get('title_f', JTEXT::_('MOD_COALAWEBSOCIALLINKS_TITLE_FOLLOW'));
$display_title_f = $params->get('display_title_f');
$title_color_f = $params->get('title_color_f');

/* Text */
$display_text_bm = $params->get('display_text_bm');
$text_bm = $params->get('text_bm');
$display_text_f = $params->get('display_text_f');
$text_f = $params->get('text_f');

/* Follow Links */
$linkfacebook = $params->get('link_facebook');
$linkgoogle = $params->get('link_google');
$linklinkedin = $params->get('link_linkedin');
$linktwitter = $params->get('link_twitter');
$linkrss = $params->get('link_rss');
$linkmyspace = $params->get('link_myspace');
$linkvimeo = $params->get('link_vimeo');
$linkyoutube = $params->get('link_youtube');
$linkdribbble = $params->get('link_dribbble');
$linkdeviantart = $params->get('link_deviantart');
$linkcontact = $params->get('link_contact');
$linkebay = $params->get('link_ebay');
$linktuenti = $params->get('link_tuenti');
$linkbehance = $params->get('link_behance');
$linkdesignmoo = $params->get('link_designmoo');
$linkflickr = $params->get('link_flickr');
$linklastfm = $params->get('link_lastfm');
$linkpinterest = $params->get('link_pinterest');
$linktumblr = $params->get('link_tumblr');
$linkinstagram = $params->get('link_instagram');
$linkxing = $params->get('link_xing');
$linkspotify = $params->get('link_spotify');
$linkmail = $params->get('link_mail');
$linkblogger = $params->get('link_blogger');
$linktripadvisor = $params->get('link_tripadvisor');
$linkgithub = $params->get('link_github');

/*Icon Alternatives */

$googleIcon = ($params->get('google_alt') ? 'googleplus-alt' : 'googleplus');

/* Powered by */
$copy = $params->get('copy');
$powered = $params->get('powered', JTEXT::_('MOD_COALAWEBSOCIALLINKS_POWERED'));

/* Load css */
$load_layout_css = $params->get('load_layout_css');
$urlModMedia = JURI::base(true) . '/media/coalawebsocial/modules/sociallinks/';
$urlComMedia = JURI::base(true) . '/media/coalawebsocial/components/sociallinks/';

if ($load_layout_css) {
    $doc->addStyleSheet($urlModMedia . 'css/cw-' . $layout . '.css');
}
$doc->addStyleSheet($urlComMedia . 'themes-icon/' . $themes_icon . '/cwsl_style.css');

/* IE7 Tweak */
$ie7tweak = '<!--[if lte IE 7]>' . "\n";
$ie7tweak .= '<link rel="stylesheet" href="' . $urlModMedia . 'css/ie7only.css" />' . "\n";
$ie7tweak .= '<![endif]-->' . "\n";

if($doc->getType() == 'html'){
    $doc->addCustomTag($ie7tweak);
}
            
/* Follow Custom Links */
if (COM_CWSOCIALLINKS_PRO == 1) {
    $linkcustomone = $params->get('link_customone');
    $textcustomone = $params->get('text_customone');
    $iconcustomone = ($params->get('icon_customone') ? $params->get('icon_customone') : $params->get('icon_ext_customone'));
    
    $linkcustomtwo = $params->get('link_customtwo');
    $textcustomtwo = $params->get('text_customtwo');
    $iconcustomtwo = ($params->get('icon_customtwo') ? $params->get('icon_customtwo') : $params->get('icon_ext_customtwo'));
    
    $linkcustomthree = $params->get('link_customthree');
    $textcustomthree = $params->get('text_customthree');
    $iconcustomthree = ($params->get('icon_customthree') ? $params->get('icon_customthree') : $params->get('icon_ext_customthree'));

    if ($params->get("display_customone_f")) {
        CoalawebSocialLinksHelper::getCustomonestyle($themes_icon ,$iconcustomone, $size);
    }
    if ($params->get("display_customtwo_f")) {
        CoalawebSocialLinksHelper::getCustomtwostyle($themes_icon ,$iconcustomtwo, $size);
    }
    if ($params->get("display_customthree_f")) {
        CoalawebSocialLinksHelper::getCustomthreestyle($themes_icon ,$iconcustomthree, $size);
    }
} else {
    $linkcustomone = $params->get('link_customone');
    $textcustomone = $params->get('text_customone');
    $iconcustomone = ($params->get('icon_customone') ? $params->get('icon_customone') : $params->get('icon_ext_customone'));
    

    if ($params->get("display_customone_f")) {
        CoalawebSocialLinksHelper::getCustomonestyle($themes_icon ,$iconcustomone, $size);
    }
}

require JModuleHelper::getLayoutPath('mod_coalawebsociallinks', $params->get('layout', 'default'));

