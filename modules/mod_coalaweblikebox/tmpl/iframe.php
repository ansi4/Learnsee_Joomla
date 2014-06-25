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
<div class="cwlikebox<?php echo $module_width ?>" id="<?php echo $module_unique_id ?>">
    <div id="likebox-wrapper">
        <iframe 
            src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $fbPageLink ?>&amp;locale=<?php echo $fbLocale; ?>&amp;width=<?php echo $fbWidth ?>&amp;colorscheme=<?php echo $params->get("fb_color"); ?>&amp;show_faces=<?php echo $params->get("fb_faces", 1); ?>&amp;show_border=<?php echo (!$params->get("fb_border")) ? "false" : "true"; ?>&amp;stream=<?php echo $params->get("fb_stream", 1); ?>&amp;header=<?php echo $params->get("fb_header", 1); ?>&amp;height=<?php echo $params->get("fb_height"); ?><?php echo $fbAppId; ?><?php echo $fbForceWall; ?>"
            scrolling="no" 
            frameborder="0" 
            style="border:none; overflow:hidden; width:<?php echo $fbWidth ?>px; height:<?php echo $params->get("fb_height"); ?>px;" 
            allowTransparency="true"></iframe>
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