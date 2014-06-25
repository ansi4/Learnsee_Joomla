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

class CoalawebLikeboxHelper {

    public static function getLikeboxXfbml(
            $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall){
            
        return 
	"<fb:like-box ' 
	href='".$fbPageLink."' 
	width='".$fbWidth."'
	height='".$fbHeight."'
	colorscheme='".$fbColor."'
	show_faces='".$fbFaces."'
	show_border='".$fbBorder."'
	stream='".$fbStream."' 
	header='".$fbHeader."'
	force_wall='".$fbForceWall."'>
        </fb:like-box >";
    }
    
    public static function getLikeboxHtml5(
            $fbPageLink, $fbWidth, $fbHeight, $fbColor, $fbFaces, $fbBorder, $fbStream, $fbHeader, $fbForceWall){
            
        return 
	"<div class='fb-like-box' 
	data-href='".$fbPageLink."' 
	data-width='".$fbWidth."'
	data-height='".$fbHeight."'
	data-colorscheme='".$fbColor."'
	data-show_faces='".$fbFaces."'
	data-show_border='".$fbBorder."'
	data-stream='".$fbStream."' 
	data-header='".$fbHeader."'
	data-force_wall='".$fbForceWall."'>
        </div>";
    }
    
}