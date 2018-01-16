<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
    .btn-primary {
        display: block;
        width: auto;
        margin-left: auto;
        margin-right: auto;
    }
    .dropdown #autodropdown {
        position: relative;
        margin-bottom: 12px;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 120px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .table-responsive {
        max-height: 300px;
        overflow-y: auto;
    }

</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#firstname").prop('required', true);
        $("#lastname").prop('required', true);
        $("#username").prop('required', true);
        $("#password").prop('readonly', false);
        $("#password").prop('required', true);
        $("#confirmpassword").prop('readonly', false);
        $("#confirmpassword").prop('required', true);

        $("#firstname").infocus(function() {
            $("#firstname").outfocus(function() {
                if($(this).val() == "") {
                    
                }
            });
        });
    });
</script>

<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            eCarPass<small> Parking Slots</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Today is <strong><?php  echo date("Y/m/d") . " " . date("l");   ?></strong> 
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                            $data = $this->Staff_model->getStaffAccountsCount(); 
                                            foreach($data as $row) {
                                                $data = $row->count;
                                            }
                                            echo $data;
                                        ?>  
                                        </div>
                                        <div>Number of staff</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Cashier Forms -->
                	</div>
                </div>	        
                <!-- /.row -->
                <div class = "row">
                    <div class="col-lg-7 col-md-8">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-book fa-fw"> </i> Create Account</h3>
                            </div>
                            <div class="panel-body">            
                               <div class="row" style="padding-bottom: 10px;">
                                    <div class="col-lg-7 col-md-12 col-xs-12">
                                        <form action="staffaccounts/register" method="post" autocomplete="off" role="presentation">
                                            <label for="accountdetails">Staff Personal Details </label>
                                            <div class="form-group" id="accountdetails"> 
                                                <div class="col-xs-12 col-md-6 col-lg-12">
                                                    <label for="firstname">First name</label>
                                                    <input type="text" class="form-control"  id="firstname" name="firstname">
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-12">
                                                    <label for="lastname">Last name</label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                                </div>
                                                
                                            </div>
                                            <label for="Account">Staff Account Details </label>
                                            <div class="form-group" id="account"> 
                                                <div class="col-xs-12 col-md-6 col-lg-12">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control"  id="username" name="username">
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-12">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" readonly onfocus="this.removeAttribute('readonly'); this.prop('required', true);" style="background-color: white;" />
                                                </div> 
                                                <div class="col-xs-12 col-md-6 col-lg-12">
                                                    <label for="password">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirmpassword" readonly onfocus="this.removeAttribute('readonly'); this.prop('required', true);" style="background-color: white;" />
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                 <div class="col-xs-12 col-md-6 col-lg-12" style="padding-top: 10px;">
                                                    <input type="submit" class="form-control btn btn-primary" id="submitaccount" name="submitaccount" >
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class = "row">
                    <div class = "col-lg-3 col-md-6">
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>