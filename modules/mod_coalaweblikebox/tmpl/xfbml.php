<?php
defined('_JEXEC') or die('Restricted access');
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Like Box Module
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
<div class="custom<?php echo $moduleClassSfx ?>">
<?php endif ?>
        <?php if ($fbRootDiv) : ?>
            <div id="fb-root"></div>
        <?php endif ?>

        <?php if ($fbJs) : ?>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/<?php echo $fbLocale; ?>/all.js#xfbml=1<?php echo $fbAppId; ?>";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
        <?php endif ?>

        <div class="cwlikebox<?php echo $module_width ?>" id="<?php echo $module_unique_id ?>">
        <div id="likebox-wrapper">
            <?php
            echo CoalawebLikeboxHelper::getLikeboxXfbml(
                    $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall)
            ?>
        </div>

        <?php if ($copy) : ?>
            <span class="cw-likebox-mod_copyrht">
                <?php echo $powered ?> <a target="_blank" title="CoalaWeb" href="http://coalaweb.com">CoalaWeb</a>
            </span>
        <?php endif; ?>
        </div>
<?php if ($moduleClassSfx) : ?>
    </div>
<?php endif ?>