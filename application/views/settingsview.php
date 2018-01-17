<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="page-wrapper">
    <div class="container-fluid">
    		<!-- Title Bar -->
    	    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="page-header">
                        eCarPass<small> Settings </small>
                    </h1>                
                </div>
            </div>
            <!-- Settings  -->
            <form id="settings_form" action="<?php base_url(); ?>settings/changeSettings" method="post">
	            <div class="row">
	            	<div class="col-lg-12 col-md-12 col-sm-12">
	            		<div class="col-lg-6 col-md-6 col-sm-12">
	            			<strong> Setup Simple - left column </strong>
	            		</div>
	            		<div class="col-lg-6 col-md-6 col-sm-12">
	            			<strong> Setup Simple - right column </strong>
	            		</div>
	            	</div>
	            </div>  
	            <input type="submit" name="">
            </form>
    </div>
 </div>
 <!-- /#page-wrapper -->
