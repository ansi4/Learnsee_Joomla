<?php

/**

 * @subpackage        tpl_orangelab

 * @copyright        Copyright (C) 2011 Linelab.org. All rights reserved.

 * @license                GNU General Public License version 2 or later; see LICENSE.txt

 */

defined('_JEXEC') or die;

define( 'YOURBASEPATH', dirname(__FILE__) );
define( 'DS', dirname('/') );

$left_width = $this->params->get("leftWidth", "200");

$right_width = $this->params->get("rightWidth", "200");

$temp_width = $this->params->get("templateWidth", "960"); 

$sitetitle = $this->params->get("sitetitle", "SilverleLab"); 

$col_mode = "s-c-s";

if ($left_width==0 and $right_width>0) $col_mode = "x-c-s";

if ($left_width>0 and $right_width==0) $col_mode = "s-c-x";

if ($left_width==0 and $right_width==0) $col_mode = "x-c-x";

$temp_width = 'margin: 0 auto; width: ' . $temp_width . 'px;'; 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>

<?php

require(YOURBASEPATH . DS . "tools.php");

?>

<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/orangelab/css/styles.css" type="text/css" media="screen,projection" />

<!--[if lte IE 6]>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/orangelab/css/styles.ie.css" type="text/css" media="screen,projection" />

<![endif]-->

<!--[if lte IE 7]>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/orangelab/css/styles.ie7.css" type="text/css" media="screen,projection" />

<![endif]-->

</head>

<body>

<div class="Left">

	<div class="Right">

<div id="main">

	<div id="wrapper" class="ground">

	    <div id="header">

    		<jdoc:include type="modules" name="search" style="xhtml"/>	

    	    <a href="index.php" id="logo" title="<?php echo $sitetitle ?>" ><img src="<?php echo $this->baseurl ?>/templates/orangelab/images/logo.png" alt="<?php echo $sitetitle ?>" /></a>

		</div>

		<div id="nav"><div class="menu">

		    <jdoc:include type="modules" name="topmenu" style="none"/></div>

		</div>

		<div id="message">

		    <jdoc:include type="message" />

		</div>

		<?php if ($this->countModules('topsl')) : ?>

		<div id="showcase">

			<div class="ground">

		    	<jdoc:include type="modules" name="topsl" style="none"/>

		    </div>

		</div>

		<?php endif; ?>

        <div id="main-content" class="<?php echo $col_mode; ?>">

            <div id="colmask">

                <div id="colmid">

                    <div id="colright">

                        <div id="col1wrap">

							<div id="col1pad">

                            	<div id="col1">

									<?php if ($this->countModules('breadcrumbsload')) : ?>

                                    <div class="breadcrumbs-pad">

                                        <jdoc:include type="modules" name="breadcrumbsload" />

                                    </div>

									<?php endif; ?>

                                    <div class="component">

                                        <jdoc:include type="component" />

                                    </div>

									<?php if ($this->countModules('bannersload')) : ?>

									<div class="spacer">

										<jdoc:include type="modules" name="bannersload" style="xhtml"/>

									</div>

									<?php endif; ?>

	                            </div>

							</div>

                        </div>

						<?php if ($left_width != 0) : ?>

                        <div id="col2">

                        	<jdoc:include type="modules" name="left" style="xhtml"/>

                        </div>

						<?php endif; ?>

						<?php if ($right_width != 0) : ?>

                        <div id="col3">

                        	<jdoc:include type="modules" name="right" style="xhtml"/>

                        </div>

						<?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

		<?php if ($this->countModules('user1 or user2 or user3')) : ?>

		<div id="main3" class="spacer<?php echo $main3_width; ?>">

			<jdoc:include type="modules" name="user1" style="xhtml"/>

			<jdoc:include type="modules" name="user2" style="xhtml"/>

			<jdoc:include type="modules" name="user3" style="xhtml"/>

			</div>

			<?php endif; ?>

							<div id="footer">

		<jdoc:include type="modules" name="footerload" style="none" />

		<div class="copy">

		<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" title="CSS Validity" style="text-decoration: none;">CSS Valid | </a><a href="http://www.linelab.org" title="Joomla Templates" target="_blank" style="text-decoration: none;">LINELAB | </a><a href="http://validator.w3.org/check/referer" target="_blank" title="XHTML Validity" style="text-decoration: none;">XHTML Valid</a>

		  </div>

    </div>	

	</div>

	<jdoc:include type="modules" name="debug" style="none" />

</div>

 </div>

  </div>

   </body>

  </html>