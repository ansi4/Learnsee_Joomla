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
?>
<?php if ($moduleClassSfx) : ?>
    <div class="<?php echo $moduleClassSfx ?>">
<?php endif ?>
<div class="cwtest<?php echo $module_width ?>" id="<?php echo $module_unique_id ?>">
    <?php if ($display_bm_sec) : ?>
        <div class="cw-social-mod">
            <?php if (($display_borders) && ($load_layout_css)) : ?>
                <div class="cw-social-mod-bookmark" style="border:<?php echo $border_width . 'px solid #' . $border_color_bm; ?>" >
                <?php else : ?>
                    <div class="cw-social-mod-bookmark">
                    <?php endif; ?>

                    <?php if ($display_title_bm) : ?>
                        <h<?php echo $title_format ?> style="color:<?php echo '#' . $title_color_bm ?>" class="<?php echo $title_align ?>">
                            <?php echo $title_bm; ?>
                        </h<?php echo $title_format ?>>
                    <?php endif; ?>
                        
                    <?php if ($display_text_bm) : ?>
                        <?php echo $text_bm; ?>
                    <?php endif; ?>
                        
                    <div class="<?php echo $icon_align ?>">

                        <ul class="cw-social-mod-icons-<?php echo $themes_icon ?>">
                            <?php
                            if ($params->get("display_delicious_bm")) {
                                echo CoalawebSocialLinksHelper::getDeliciousBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_digg_bm")) {
                                echo CoalawebSocialLinksHelper::getDiggBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_facebook_bm")) {
                                echo CoalawebSocialLinksHelper::getFacebookBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_google_bm")) {
                                echo CoalawebSocialLinksHelper::getGoogleBookmark($title, $link, $size, $linknofollow, $googleIcon);
                            }
                            if ($params->get("display_stumbleupon_bm")) {
                                echo CoalawebSocialLinksHelper::getStumbleuponBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_technorati_bm")) {
                                echo CoalawebSocialLinksHelper::getTechnoratiBookmark($link, $size, $linknofollow);
                            }
                            if ($params->get("display_twitter_bm")) {
                                echo CoalawebSocialLinksHelper::getTwitterBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_linkedin_bm")) {
                                echo CoalawebSocialLinksHelper::getLinkedInBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_orkut_bm")) {
                                echo CoalawebSocialLinksHelper::getOrkutBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_reddit_bm")) {
                                echo CoalawebSocialLinksHelper::getRedditBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_newsvine_bm")) {
                                echo CoalawebSocialLinksHelper::getNewsvineBookmark($title, $link, $size, $linknofollow);
                            }
                            if ($params->get("display_pinterest_bm")) {
                                echo CoalawebSocialLinksHelper::getPinterestBookmark($size, $themes_icon, $linknofollow);
                            }
                            if ($params->get("display_email_bm")) {
                                echo CoalawebSocialLinksHelper::getEmailBookmark($title, $link, $size);
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($display_f_sec) : ?>
            <div class="cw-social-mod">
                <?php if (($display_borders) && ($load_layout_css)) : ?>
                    <div class="cw-social-mod-follow" style="border:<?php echo $border_width . 'px solid #' . $border_color_f; ?>" >
                    <?php else : ?>
                        <div class="cw-social-mod-follow">
                        <?php endif; ?>
                            
                        <?php if ($display_title_f): ?>
                            <h<?php echo $title_format ?> style="color:<?php echo '#' . $title_color_f ?>" class="<?php echo $title_align ?>">
                                <?php echo $title_f; ?>
                            </h<?php echo $title_format ?>>
                        <?php endif; ?>
                            
                         <?php if ($display_text_f) : ?>
                            <?php echo $text_f; ?>
                        <?php endif; ?>
                            
                        <div class="<?php echo $icon_align ?>">

                            <ul class="cw-social-mod-icons-<?php echo $themes_icon ?>">
                                <?php
                                if ($params->get("display_facebook_f")) {
                                    echo CoalawebSocialLinksHelper::getFacebookFollow($linkfacebook, $size, $linknofollow);
                                }
                                if ($params->get("display_google_f")) {
                                    echo CoalawebSocialLinksHelper::getGoogleFollow($linkgoogle, $size, $linknofollow, $googleIcon);
                                }
                                if ($params->get("display_linkedin_f")) {
                                    echo CoalawebSocialLinksHelper::getLinkedinFollow($linklinkedin, $size, $linknofollow);
                                }
                                if ($params->get("display_twitter_f")) {
                                    echo CoalawebSocialLinksHelper::getTwitterFollow($linktwitter, $size, $linknofollow);
                                }
                                if ($params->get("display_rss_f")) {
                                    echo CoalawebSocialLinksHelper::getRssFollow($linkrss, $size, $linknofollow);
                                }
                                if ($params->get("display_myspace_f")) {
                                    echo CoalawebSocialLinksHelper::getMyspaceFollow($linkmyspace, $size, $linknofollow);
                                }
                                if ($params->get("display_vimeo_f")) {
                                    echo CoalawebSocialLinksHelper::getVimeoFollow($linkvimeo, $size, $linknofollow);
                                }
                                if ($params->get("display_youtube_f")) {
                                    echo CoalawebSocialLinksHelper::getYoutubeFollow($linkyoutube, $size, $linknofollow);
                                }
                                if ($params->get("display_dribbble_f")) {
                                    echo CoalawebSocialLinksHelper::getDribbleFollow($linkdribbble, $size, $linknofollow);
                                }
                                if ($params->get("display_deviantart_f")) {
                                    echo CoalawebSocialLinksHelper::getDeviantartFollow($linkdeviantart, $size, $linknofollow);
                                }
                                if ($params->get("display_contact_f")) {
                                    echo CoalawebSocialLinksHelper::getContactFollow($linkcontact, $size, $linknofollow);
                                }
                                if ($params->get("display_mail_f")) {
                                    echo CoalawebSocialLinksHelper::getMailFollow($linkmail, $size, $linknofollow);
                                }
                                if ($params->get("display_ebay_f")) {
                                    echo CoalawebSocialLinksHelper::getEbayFollow($linkebay, $size, $linknofollow);
                                }
                                if ($params->get("display_tuenti_f")) {
                                    echo CoalawebSocialLinksHelper::getTuentiFollow($linktuenti, $size, $linknofollow);
                                }
                                if ($params->get("display_behance_f")) {
                                    echo CoalawebSocialLinksHelper::getBehanceFollow($linkbehance, $size, $linknofollow);
                                }
                                if ($params->get("display_designmoo_f")) {
                                    echo CoalawebSocialLinksHelper::getDesignmooFollow($linkdesignmoo, $size, $linknofollow);
                                }
                                if ($params->get("display_flickr_f")) {
                                    echo CoalawebSocialLinksHelper::getFlickrFollow($linkflickr, $size, $linknofollow);
                                }
                                if ($params->get("display_lastfm_f")) {
                                    echo CoalawebSocialLinksHelper::getLastfmFollow($linklastfm, $size, $linknofollow);
                                }
                                if ($params->get("display_pinterest_f")) {
                                    echo CoalawebSocialLinksHelper::getPinterestFollow($linkpinterest, $size, $linknofollow);
                                }
                                if ($params->get("display_tumblr_f")) {
                                    echo CoalawebSocialLinksHelper::getTumblrFollow($linktumblr, $size, $linknofollow);
                                }
                                if ($params->get("display_instagram_f")) {
                                    echo CoalawebSocialLinksHelper::getInstagramFollow($linkinstagram, $size, $linknofollow);
                                }
                                if ($params->get("display_xing_f")) {
                                    echo CoalawebSocialLinksHelper::getXingFollow($linkxing, $size, $linknofollow);
                                }
                                if ($params->get("display_spotify_f")) {
                                    echo CoalawebSocialLinksHelper::getSpotifyFollow($linkspotify, $size, $linknofollow);
                                }
                                if ($params->get("display_tripadvisor_f")) {
                                    echo CoalawebSocialLinksHelper::getTripadvisorFollow($linktripadvisor, $size, $linknofollow);
                                }
                                if ($params->get("display_blogger_f")) {
                                    echo CoalawebSocialLinksHelper::getBloggerFollow($linkblogger, $size, $linknofollow);
                                }
                                if ($params->get("display_android_f")) {
                                    echo CoalawebSocialLinksHelper::getAndroidFollow($linkandroid, $size, $linknofollow);
                                }
                                if ($params->get("display_github_f")) {
                                    echo CoalawebSocialLinksHelper::getGithubFollow($linkgithub, $size, $linknofollow);
                                }
                                if ($params->get("display_customone_f")) {
                                    echo CoalawebSocialLinksHelper::getCustomoneFollow($linkcustomone, $size, $linknofollow, $textcustomone);
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($copy) : ?>
                <span class="cw-social-mod_copyrht">
                    <?php echo $powered ?> <a target="_blank" title="CoalaWeb" href="http://coalaweb.com">CoalaWeb</a>
                </span>
            <?php endif; ?>
        </div>
<?php if ($moduleClassSfx) : ?>
    </div>
<?php endif ?>
