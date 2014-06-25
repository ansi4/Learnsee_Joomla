<?php

defined('_JEXEC') or die('Restricted access');

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
class CoalawebSocialLinksHelper {
    /* Bookmark functions */

    public static function getDeliciousBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
                <a class="delicious' . $size . '" href="http://del.icio.us/post?v=2&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Delicious") .'" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getDiggBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="digg' . $size . '" href="http://digg.com/submit?phase=2&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Digg") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getFacebookBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="facebook' . $size . '" href="http://www.facebook.com/sharer.php?u=' . $link . '&amp;t=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Facebook") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getGoogleBookmark($title, $link, $size, $linknofollow, $googleIcon) {

        return
                '<li>
            <a class="' . $googleIcon . $size . '" href="https://plus.google.com/share?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Google") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getStumbleuponBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="stumbleupon' . $size . '"  href="http://www.stumbleupon.com/submit?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Stumbleupon") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getTechnoratiBookmark($link, $size, $linknofollow) {

        return
                '<li>
            <a class="technorati' . $size . '"  href="http://technorati.com/faves?add=' . $link . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Technorati") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getTwitterBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="twitter' . $size . '" href="http://twitter.com/intent/tweet?status=' . $title . '%20' . $link . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Twitter") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getLinkedInBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="linkedin' . $size . '" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "LinkedIn") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getNewsvineBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="newsvine' . $size . '" href="http://www.newsvine.com/_tools/seed?popoff=0&amp;u=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Newsvine") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getRedditBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="reddit' . $size . '" href="http://reddit.com/submit?url=' . $link . '&amp;title=' . $title . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Reddit") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getOrkutBookmark($title, $link, $size, $linknofollow) {

        return
                '<li>
            <a class="orkut' . $size . '" href="http://promote.orkut.com/preview?nt=orkut.com&amp;tt=' . $title . '&amp;du=' . $link . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Orkut") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getPinterestBookmark($size, $themes_icon, $linknofollow) {

        return
                '<li>
            <a class="pinterest' . $size . '" href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_BOOKMARK", "Pinterest") . '" ' . $linknofollow . '></a>
        </li>';
    }
    
    public static function getEmailBookmark($title, $link, $size) {

        return
                '<li>
            <a class="gmail' . $size . '" href="mailto:?subject=' . $title . '&amp;body=' . $link . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_BM", "Email") . '" ></a>
        </li>';
    }

    /* Follow Us functions */

    public static function getFacebookFollow($linkfacebook, $size, $linknofollow) {

        return
                '<li>
                <a class="facebook' . $size . '" href="http://' . $linkfacebook . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Facebook") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getGoogleFollow($linkgoogle, $size, $linknofollow, $googleIcon) {

        return
                '<li>
                <a class="' . $googleIcon . $size . '" href="http://' . $linkgoogle . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Google +") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getLinkedinFollow($linklinkedin, $size, $linknofollow) {

        return
                '<li>
                <a class="linkedin' . $size . '" href="http://' . $linklinkedin . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Linkedin") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getTwitterFollow($linktwitter, $size, $linknofollow) {

        return
                '<li>
                <a class="twitter' . $size . '" href="http://' . $linktwitter . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Twitter") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getRssFollow($linkrss, $size, $linknofollow) {

        return
                '<li>
                <a class="rss' . $size . '" href="http://' . $linkrss . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "RSS") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getMyspaceFollow($linkmyspace, $size, $linknofollow) {

        return
                '<li>
                <a class="myspace' . $size . '" href="http://' . $linkmyspace . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Myspace") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getVimeoFollow($linkvimeo, $size, $linknofollow) {

        return
                '<li>
                <a class="vimeo' . $size . '" href="http://' . $linkvimeo . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Vimeo") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getYoutubeFollow($linkyoutube, $size, $linknofollow) {

        return
                '<li>
                <a class="youtube' . $size . '" href="http://' . $linkyoutube . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Youtube") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getDribbleFollow($linkdribbble, $size, $linknofollow) {

        return
                '<li>
                <a class="dribbble' . $size . '" href="http://' . $linkdribbble . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Dribbble") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getDeviantartFollow($linkdeviantart, $size, $linknofollow) {

        return
                '<li>
                <a class="deviantart' . $size . '" href="http://' . $linkdeviantart . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Deviantart") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getContactFollow($linkcontact, $size) {

        return
                '<li>
                <a class="gmail' . $size . '" href="http://' . $linkcontact . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_CONTACT_F", "Email") . '" rel="nofollow" target="_blank" ></a>
        </li>';
    }

    public static function getMailFollow($linkmail, $size) {

        return
                '<li>
                <a class="gmail' . $size . '" href="mailto:' . $linkmail . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_EMAIL_F", "Email") . '" rel="nofollow" target="_blank" ></a>
        </li>';
    }

    public static function getEbayFollow($linkebay, $size, $linknofollow) {

        return
                '<li>
                <a class="ebay' . $size . '" href="http://' . $linkebay . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Ebay") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getTuentiFollow($linktuenti, $size, $linknofollow) {

        return
                '<li>
                <a class="tuenti' . $size . '" href="http://' . $linktuenti . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tuenti") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getBehanceFollow($linkbehance, $size, $linknofollow) {

        return
                '<li>
                <a class="behance' . $size . '" href="http://' . $linkbehance . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Behance") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getDesignmooFollow($linkdesignmoo, $size, $linknofollow) {

        return
                '<li>
                <a class="designmoo' . $size . '" href="http://' . $linkdesignmoo . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Designmoo") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getFlickrFollow($linkflickr, $size, $linknofollow) {

        return
                '<li>
                <a class="flickr' . $size . '" href="http://' . $linkflickr . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Flickr") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getLastfmFollow($linklastfm, $size, $linknofollow) {

        return
                '<li>
                <a class="lastfm' . $size . '" href="http://' . $linklastfm . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Last.fm") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getPinterestFollow($linkpinterest, $size, $linknofollow) {

        return
                '<li>
                <a class="pinterest' . $size . '" href="http://' . $linkpinterest . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Pinterest") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getTumblrFollow($linktumblr, $size, $linknofollow) {

        return
                '<li>
                <a class="tumblr' . $size . '" href="http://' . $linktumblr . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tumblr") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getInstagramFollow($linkinstagram, $size, $linknofollow) {

        return
                '<li>
                <a class="instagram' . $size . '" href="http://' . $linkinstagram . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Instagram") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getXingFollow($linkxing, $size, $linknofollow) {

        return
                '<li>
                <a class="xing' . $size . '" href="http://' . $linkxing . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Xing") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getSpotifyFollow($linkspotify, $size, $linknofollow) {

        return
                '<li>
                <a class="spotify' . $size . '" href="http://' . $linkspotify . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Spotify") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }
    
    public static function getBloggerFollow($linkblogger, $size, $linknofollow) {

        return
                '<li>
                <a class="blogger' . $size . '" href="http://' . $linkblogger . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Blogger") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }
    
    public static function getTripadvisorFollow($linktripadvisor, $size, $linknofollow) {

        return
                '<li>
                <a class="tripadvisor' . $size . '" href="http://' . $linktripadvisor . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Tripadvisor") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }

    public static function getAndroidFollow($linkandroid, $size, $linknofollow) {

        return
                '<li>
                <a class="android' . $size . '" href="http://' . $linkandroid . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Android") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }
    
    public static function getGithubFollow($linkgithub, $size, $linknofollow) {

        return
                '<li>
                <a class="github' . $size . '" href="http://' . $linkgithub . '" title="' . JText::sprintf("MOD_COALAWEBSOCIALLINKS_FOLLOW", "Github") . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }
    
    /* Follow Us Custom functions */

    public static function getCustomoneFollow($linkcustomone, $size, $linknofollow, $textcustomone) {

        return
                '<li>
                <a class="customone' . $size . '" href="http://' . $linkcustomone . '" title="' . $textcustomone . '" ' . $linknofollow . ' target="_blank" ></a>
        </li>';
    }


    //Create Custom style
    public static function getCustomoneStyle($themes_icon, $iconcustomone, $size) {
        $doc = JFactory::getDocument();
        $styles = ".cw-social-mod-icons-".$themes_icon ."  a.customone" . $size . " {background:url(" . JURI::base(true) . '/' .$iconcustomone . ") 0 0 no-repeat;}";
        $styles .= ".cw-social-mod-icons-".$themes_icon ." a.customone" . $size . " {background:url(" . JURI::base(true) . '/' .$iconcustomone . ") 0 0 no-repeat;}";
        $doc->AddStyledeclaration($styles);
    }

}