
<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    if (isset($_POST['btn1'])) 
    {   
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $result = $this->db->query("SELECT * FROM stafacc WHERE staffname = '$username' AND password = '$password' LIMIT 1");
        $row = $result->row();    

        if(isset($row)) {
            $_SESSION['loginuser'] = $username;

            echo "<script>sessionStorage.setItem('user','$username');</script>"; 

           echo "  <div class='alert alert-success container container-small'>
                        <center><strong>Welcome!</strong> $username </center>
                    </div>
                    ";  
            echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=./\">";
        }
        else 
        {
            echo "  <div class='alert alert-danger container container-small'>
                        <center><strong>Incorrect!</strong> Username or Password.</center>
                    </div>
                    ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>eCarPass - a Parking Area Access</title>

        <!-- Bootstrap Core CSS -->
    <link href="styles/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
    <link href="styles/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
    <link href="styles/css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
    <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- jQuery -->
    <script src="./styles/js/jquery.js"> </script>
    <script src="./styles/js/jquery.capslockstate.js"> </script>
        <!-- Bootstrap Core JavaScript -->
    <script src="./styles/js/bootstrap.min.js"> </script>

        <!-- Morris Charts JavaScript -->
    <script src="./styles/js/plugins/morris/raphael.min.js"> </script>
    <script src="./styles/js/plugins/morris/morris.min.js"> </script>
    <script src="./styles/js/plugins/morris/morris-data.js"> </script>


    <style type="text/css">
        #contentbody {
            margin: 0 auto;
            padding-left: 15%;
        }   
        .text-center {
            padding-right: 18%;
        }
    </style>

    <script>
        $(document).ready(function() {
            sessionStorage.clear();
            /* 
            * Bind to capslockstate events and update display based on state 
            */
            $(window).bind("capsOn", function(event) {
                if ($("#pass:focus").length > 0) {
                    $("#capsWarning").show();
                }
            });
            $(window).bind("capsOff capsUnknown", function(event) {
              $("#capsWarning").hide();
            });
            $("#pass").bind("focusout", function(event) {
                $("#capsWarning").hide();
            });
            $("#pass").bind("focusin", function(event) {
                if ($(window).capslockstate("state") === true) {
                    $("#capsWarning").show();
                }
            });

            /* 
            * Initialize the capslockstate plugin.
            * Monitoring is happening at the window level.
            */
            $(window).capslockstate();

        });
    </script>

</head>
<body>

<div class="container-fluid">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Login.php">eCarPass</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                <a class="navbar-brand">Login</a>
                </li>
                </ul>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="contentbody">
            <div class ="row">
                <div class="col-md-6 col-md-offset-2">
                    <img src="./assets/images/logo.png" class="img-responsive center-block" style="width:720px; height:360px;"/>
                </div>
            </div>
        <!-- login form -->
            <form action="Login" method="post" autocomplete="off" role="presentation">
                <!--text box username-->
                <div class = "row">
                    <div class="col-md-6 col-sm-offset-2">                        
                        <div class = "form-group input-group">
                            <span class="input-group-addon"></span>
                            <input id="uname" type="text" class = "form-control" placeholder="Username" name="uname" />
                        </div>                  
                    </div>                   
                </div>
                 <!--text box password-->
                <div class = "row">
                    <div class="col-md-6 col-sm-offset-2">
                        <form action="Login.php">   
                            <div class = "form-group input-group">
                                <span class="input-group-addon"></span>                            
                                <input id="pass" type="password" class = "form-control" placeholder="Password" name="pass" readonly onfocus="this.removeAttribute('readonly');" style="background-color: white;" />
                            </div>
                            <div id="capsWarning" style="display: none;">Caps Lock is on.</div>
                    </div>     
                </div>
                <!--end of text Boxes-->

                <!--Button-->
                <div class="col-lg-12 text-center">
                     <button type="submit" class="btn btn-lg btn-primary" name="btn1">Login</button>
                </div>
            </form>
        </div>
</div>

</body>
    
</html> 