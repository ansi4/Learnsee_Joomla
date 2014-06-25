<?php
/**
 * @subpackage        tpl_blog3
 * @copyright        Copyright (C) 2011 Linelab.org. All rights reserved.
 * @license          GNU General Public License version 3
 */
defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);
define( 'YOURBASEPATH', dirname(__FILE__) );
$left_width = $this->params->get("leftWidth", "260");
$right_width = $this->params->get("rightWidth", "260");
$temp_width = $this->params->get("templateWidth", "960"); 
$sitetitle = $this->params->get("sitetitle", "BLOG 3.0 Joomla Template"); 
$col_mode = "s-c-s";
if ($left_width==0 and $right_width>0) $col_mode = "x-c-s";
if ($left_width>0 and $right_width==0) $col_mode = "s-c-x";
if ($left_width==0 and $right_width==0) $col_mode = "x-c-x";
$temp_width = 'margin: 0 auto; width: ' . $temp_width . 'px;'; 
$slide	= $this->params->get('display_slideshow', 0);
$slidecontent		= $this->params->get('slideshow', '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/blog3/css/styles.ie7.css" type="text/css" media="screen,projection" />
<![endif]-->
<?php
require(YOURBASEPATH . DS . "tools.php");
?>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/blog3/css/styles.css" type="text/css" media="screen,projection" />
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->baseurl ?>/templates/blog3/js/mootools-more.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl ?>/templates/blog3/js/Scrollbar.js" type="text/javascript" charset="utf-8"></script>	
 <script type="text/javascript">
window.addEvent('domready', function(){
var myVProducts = new ScrollBar('vScroll', 'vBar', 'vKnob', {
mode: 'vertical',
offset: -1
});
document.id('aBitToTop').addEvent('click', function(e){
e.stop();
myVProducts.set(1);
});
document.id('aBitToBottom').addEvent('click', function(e){
e.stop();
myVProducts.set(100);
});
});
</script>
<script language="javascript" type="text/javascript">	
	var counter = 0;
	var menus = new Array();
	window.addEvent('domready', function(){
		$('hiddenmenu').getElements('div.menu_box_parent').each( function( elem ){
			box = elem.getElement('div.menu_box');
			knob = elem.getElement('div.knob');
			var myFx = new Fx.Slide(box).hide();			
			menus[counter] = myFx;
			counter++;
			knob.addEvents({
				'click' : function(){ 					
//					alert(menus.length);
/*
					for (var i = 0; i < menus.length; i++) {   
						menus[i].cancel();
						menus[i].hide();
					} 
					*/
					$('hiddenmenu').style.width='200px';
					myFx.cancel();
					myFx.toggle().chain(function(){
						$('hiddenmenu').style.width='50px';
						for (var i = 0; i < menus.length; i++) {   
							if (menus[i].open) {
								$('hiddenmenu').style.width='200px';
							};
						} 
					});					
				}
				/*,
				'mouseleave' : function(){ 
					myFx.cancel();
					myFx.slideOut().chain(function(){
						$('hiddenmenu').style.width='70px';
					});
				}
				*/
			});	
		});	
	});	
</script>
</head>
<body> 
<div id="hiddenmenu">
<a id="aBitToTop" href="#"><img src="<?php echo $this->baseurl ?>/templates/blog3/images/arowdn.jpg" alt="TOP" /></a>
	<div class="menu_box_parent">
		<div class="menu_title1"><div class="knob"></div></div>
		<div class="menu_box">
      <jdoc:include type="modules" name="position-7" style="rest"/>
		</div>
	</div>
	<div class="menu_box_parent">
		<div class="menu_title"><div class="knob"></div></div>
		<div class="menu_box">
			<jdoc:include type="modules" name="position-6" style="rest"/>
		</div>
	</div>
	<a id="aBitToBottom" href="#"><img src="<?php echo $this->baseurl ?>/templates/blog3/images/arowup.jpg" alt="bottom" /></a>
</div>    
<div id="vScroll">
 <div class="scroling">
  <div id="main">         
	<div id="wrapper">
	    <div id="header">
    		<jdoc:include type="modules" name="position-0" style="none"/>
        <div class="logo">	
    	    <a href="index.php" title="<?php echo $sitetitle ?>" ><img src="<?php echo $this->baseurl ?>/templates/blog3/images/logo.png" alt="<?php echo $sitetitle ?>" /></a>
	      </div>
  	</div>
		<div id="nav"> 
    <div class="menu">
		    <jdoc:include type="modules" name="position-1" style="none"/></div>
		</div>
		<div id="message">
		    <jdoc:include type="message" />
		</div>
		<?php if ($this->countModules('position-12')) : ?>
		<div id="showcase"> 
      	<?php if ($slide == 1) { ?>
		    	<jdoc:include type="modules" name="position-12" style="none"/>
		    		<?php } else { ?>
		    <img src="<?php echo $this->baseurl ?>/<?php echo $slidecontent; ?>" alt="" /> 
		<?php } ?>
		</div>   
		<?php endif; ?>
        <div id="main-content" class="<?php echo $col_mode; ?>">
            <div id="colmask">
                <div id="colmid">
                    <div id="colright">
                        <div id="col1wrap">
							<div id="col1pad">
                            	<div id="col1">
									<?php if ($this->countModules('position-2')) : ?>
                                    <div class="breadcrumbs-pad">
                                        <jdoc:include type="modules" name="position-2" />
                                    </div>
									<?php endif; ?>
                                    <div class="component">
                                        <jdoc:include type="component" />  
                                    </div>   
									<?php if ($this->countModules('position-9')) : ?>
									<div class="spacer">
										<jdoc:include type="modules" name="position-9" style="xhtml"/>
									</div>
									<?php endif; ?>
	                            </div>
							</div>          
                        </div>
						<?php if ($left_width != 0) : ?>
                        <div id="col2">
                        	<jdoc:include type="modules" name="leftpozice" style="rest"/>
                        </div>
						<?php endif; ?>
						<?php if ($right_width != 0) : ?>
                        <div id="col3">
                        	<jdoc:include type="modules" name="rightpozice" style="rest"/>
                        </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>	
	  </div>
		<?php if ($this->countModules('user1 or user2 or user3')) : ?>
		<div id="main3" class="spacer<?php echo $main3_width; ?>">
		<div class="centerbox" style="<?php echo $temp_width; ?>">
			<jdoc:include type="modules" name="user1" style="xhtml"/>
			<jdoc:include type="modules" name="user2" style="xhtml"/>
			<jdoc:include type="modules" name="user3" style="xhtml"/>
			</div>
			 </div>
			<?php endif; ?>
							<div id="footer">
		<jdoc:include type="modules" name="footerload" style="none" />
		<div class="copy">
		Copyright&nbsp;&copy; <?php echo date( '2010 - Y' ); ?> <?php echo $sitetitle; ?> .<!-- Don't remove this line! Read more http://www.linelab.org/download/subscribe --> Design by <a href="http://www.linelab.org" title="Free Joomla 3 Templates" target="_blank" style="text-decoration: none;">LINELAB</a>.</div>
    </div>
    <div id="debug">
	<jdoc:include type="modules" name="debug" style="none" />
	</div>                                                  
   </div>         
 </div>
</div>
<div class="bars"><div style="display:block; height:100px"></div><div id="vBar"><div id="vKnob"></div></div><div style="display:block; height:100px"></div></div><div clss="clr"></div>    
   </body>
  </html>    