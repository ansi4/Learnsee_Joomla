<?php



/**



 * @subpackage        tpl_stormlab



 * @copyright        Copyright (C) 2011 Linelab.org. All rights reserved.



 * @license          GNU General Public License version 2 or later.



 */



defined('_JEXEC') or die;



define( 'YOURBASEPATH', dirname(__FILE__) );
define( 'DS', '/' );



$left_width = $this->params->get("leftWidth", "260");



$right_width = $this->params->get("rightWidth", "260");



$temp_width = $this->params->get("templateWidth", "960"); 



$sitetitle = $this->params->get("sitetitle", "StormLab Template"); 



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



<?php



require(YOURBASEPATH . DS . "tools.php");



?>



<jdoc:include type="head" />
<link  href="http://fonts.googleapis.com/css?family=Cuprum:regular" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/scroll.js"></script>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/stormlab/css/styles.css" type="text/css" media="screen,projection" />


<!--[if IE]>


<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/stormlab/css/styles.ie.css" type="text/css" media="screen,projection" />


<![endif]-->


</head>



<body>

  <div class="Left">
  

	<div class="Right">
	

<div class="topground"></div>



<div id="main">



	<div id="wrapper" class="ground">



	    <div id="header"> 

       
          <div id="headertop">
          

    		<jdoc:include type="modules" name="position-0" style="xhtml"/>

        

        <div class="headmenu">	



    	    <jdoc:include type="modules" name="topnavi" style="none"/>



	      </div>

       </div>   
            
  	</div>



		<div id="nav">
    
    <div class="logo">  
            <a href="index.php" id="logo" title="<?php echo $sitetitle ?>" ><img src="<?php echo $this->baseurl ?>/templates/stormlab/images/logo.png" alt="<?php echo $sitetitle ?>" /></a>
         </div>
      

    <div class="menu">
		    <jdoc:include type="modules" name="position-1" style="none"/></div>



		</div>



		<div id="message">



		    <jdoc:include type="message" />



		</div>



		<?php if ($this->countModules('position-12')) : ?>



		<div id="showcase">
                       	<div class="showcaseimg">

		    		<?php if ($slide == 1) { ?>  
			<jdoc:include type="modules" name="position-12" />
		<?php } else { ?>
			<img src="<?php echo $this->baseurl ?>/<?php echo $slidecontent; ?>" alt="" /> 
		<?php } ?>

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



									<?php if ($this->countModules('position-2')) : ?>



                                    <div class="breadcrumbs-pad">



                                        <jdoc:include type="modules" name="position-2" />



                                    </div>



									<?php endif; ?>



                                    <div class="component">



                                        <jdoc:include type="component" />

                                        		<?php if ($this->countModules('position-3 or position-4 or position-5')) : ?>



		<div id="main2" class="spacer2<?php echo $main2_width; ?>">



			<jdoc:include type="modules" name="position-3" style="xhtml"/>



			<jdoc:include type="modules" name="position-4" style="xhtml"/>



			<jdoc:include type="modules" name="position-5" style="xhtml"/>

 

			</div>    	<?php endif; ?>      
			
			
												<?php if ($this->countModules('bannersload')) : ?>

                      <div class="modulebottom">

										<jdoc:include type="modules" name="bannersload" style="xhtml"/>

                    </div>


									<?php endif; ?>

                                    </div>



	                            </div>



							</div>



                        </div>



						<?php if ($left_width != 0) : ?>



                        <div id="col2">



                        	<jdoc:include type="modules" name="position-7" style="rest"/>



                        </div>



						<?php endif; ?>



						<?php if ($right_width != 0) : ?>



                        <div id="col3">



                        	<jdoc:include type="modules" name="position-6" style="rest"/>



                        </div>



						<?php endif; ?>



                    </div>



                </div>



            </div>



        </div>	



	  </div>

	  

	          

		<?php if ($this->countModules('user1 or user2 or user3')) : ?>



		<div id="main3" class="spacer<?php echo $main3_width; ?>">

		 <div class="centerbox">

			<jdoc:include type="modules" name="user1" style="xhtml"/>



			<jdoc:include type="modules" name="user2" style="xhtml"/>



			<jdoc:include type="modules" name="user3" style="xhtml"/>

        </div>

			</div>



			<?php endif; ?>



							<div id="footer">

              	<div class="scroll">
                          <a href="#" onclick="scrollToTop();return false;"><img src="templates/<?php echo $this->template ?>/images/top.png" width="18" height="29" alt="top" /></a></div>
                                

		<jdoc:include type="modules" name="footerload" style="none" />

      

    </div>

    

    <div id="debug">



	<jdoc:include type="modules" name="debug" style="none" />

	

	</div>



</div>

    </div>

  </div>

   </body>

   



  </html>