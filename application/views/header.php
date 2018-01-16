<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    include_once(FCPATH . 'libraries/HomeRepository.php');
    if(isset($_SESSION['loginuser'])) {
        $user = $_SESSION['loginuser'];
    }
    else {
        redirect('login');
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
        <!--link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"-->

        <script src="styles/js/jquery.js"></script>
        <script src="styles/js/jquery-3.2.1.min.js"></script>
        <script src="styles/js/jquery.session.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="styles/js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="styles/js/plugins/morris/raphael.min.js"></script>
        <script src="styles/js/plugins/morris/morris.min.js"></script>
        <script src="styles/js/plugins/morris/morris-data.js"></script>
        
        <script src="styles/js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //jquery for menu management    
                if(!sessionStorage.getItem("openId")) {
                    $("#overviewtab").addClass("active");
                }
                else {
                     $("#" + sessionStorage.getItem("openId")).addClass("active");
                }
                $("#menu").find("li").each(function() {
                    if($(this).hasClass("active")) {
                        sessionStorage.setItem("openId", this.id);
                    }
                    else{
                        if(sessionStorage.getItem("openId") != "overviewtab") {
                        }
                        else {
                            $("#overviewtab").addClass("active");
                        }
                    }
                }); 
                $("ul li").click(function() {
                    sessionStorage.setItem("openId", this.id);
                });

                $("a").click(function() {
                     sessionStorage.setItem("openId", $(this).attr("href") + "tab");
                });
                //jquery for menu management done
                console.log(sessionStorage);

                if(sessionStorage.getItem("user") == "admin") {
                    $("#stafftab").css('display', 'inline');
                }
                else {
                    $("#stafftab").css('display', 'none');
                }
                var ready = true;
                var old = "";
                var oldJson = {};
                var fctr = 0;
                var parker = "";
                var background = setInterval(function()
                { 
                    $.ajax({
                        type: 'POST',
                        data: { ready : ready },
                        datatype: 'json',
                        url: '<?php echo site_url('parkslots/checkStatus'); ?>', 
                        success: function(result) {
                                //all updates here
                                var data = JSON.parse(result);
                                if(fctr === 0) {
                                    old = JSON.stringify(result);
                                    oldJson = result;
                                }
                                else {
                                    // long polling start
                                    if (old != JSON.stringify(result)) {
                                        var olddata = JSON.parse(oldJson);
                                        for(var loop = 0; loop < olddata.length; loop++) {
                                            if(data[loop]['location'] != olddata[loop]['location']) {
                                                if(data[loop]['location'] == "near") {
                                                    parker = data[loop]['platenum'];
                                                    sessionStorage.setItem("nearParker", parker);
                                                    clearInterval(background);
                                                    confirm('A parker is nearby!');
                                                    $(location).attr('href', 'parkslots');
                                                }
                                                sessionStorage.setItem('openId', 'parkingtab');  
                                            }
                                        }
                                    }
                                    // long polling end
                                    old = JSON.stringify(result);
                                    oldJson = result;
                                }
                                fctr++;
                        },
                        error: function(result) {
                            console.log("Error: " + result);
                        }
                    });
                }, 250);//time in milliseconds 
            });
               $(document).ready(function() {

            if($('#table_remove tbody tr').length < 6) {
                $("#removetablediv").css('height', '200px');
                $("#removetablediv").css('overflow-y', 'hidden');
            }
            else {
                $("#removetablediv").css('height', '250px');
                $("#removetablediv").css('overflow-y', 'visible');
            }

            if($('#table_reserve tbody tr').length < 6) {
                $("#reservetablediv").css('height', '200px');
                $("#reservetablediv").css('overflow-y', 'hidden');
            }
            else {
                $("#reservetablediv").css('height', '250px');
                $("#reservetablediv").css('overflow-y', 'visible');
            }

            $("#plate_reserve").prop('required',true);
            $("#slot_reserve").prop('required', true);

            
            $("#tablebody_reserve tr").click(function() {
                $("#tablebody_reserve tr").each(function() {
                    $(this).css("background-color","#FFFFFF");
                });

                $(this).css("background-color","#4CAF50");

                var val = $(this).closest("tr").find("td:eq(2)").text();
                $("#slot_reserve").val(val);
                //alert(val);
            });

            $("#tablebody_reserve tr").hover(function() {
                $(this).css('cursor','pointer');
            }, function() {
                $(this).css('cursor','auto');
            });

            $("#slot_reserve").change(function() {
                var val = $(this).val();
                $("#tablebody_reserve tr").each(function() {
                    $data = $(this).find("td:eq(2)").text();
                   
                    if($data == val) {
                        $(this).click();
                    }
                });
            });    

            $("#area_reserve").change(function() {
                $("#table_reserve td").parent().remove();
                $("#slot_reserve").empty()
                $("#slot_reserve").append("<option disabled selected value> -- Select a slot -- </option>");
                
                var selected = $("#area_reserve").val();
                
                $.ajax({
                    type: 'POST',
                    data: { selected : selected },
                    datatype: 'json',
                    url: '<?php echo site_url('manualpark/reserveManageTable'); ?>', 
                    success: function(result) {
                        //all updates here
                        var data = JSON.parse(result);
                        for(loop=0; loop < data.length; loop++) {
                            $("#table_reserve #tablebody_reserve").append("<tr><td class='id'>" + data[loop]['id'] + "</td><td class='area'>" + data[loop]['area'] + "</td><td class='slot'>" + data[loop]['slot'] + "</td> </tr>");
                            $("#slot_reserve").append("<option>" + data[loop]['slot'] + "</option>");
                        }
                        
                        $("#tablebody_reserve tr").hover(function() {
                            $(this).css('cursor','pointer');
                        }, function() {
                            $(this).css('cursor','auto');
                        });


                        $("#slot_reserve").change(function() {
                            var val = $(this).val();
                            $("#tablebody_reserve tr").each(function() {
                                $data = $(this).find("td:eq(2)").text();
                               
                                if($data == val) {
                                    $(this).click();
                                }
                            });
                        });    

                        $("#tablebody_reserve tr").click(function() {
                            $("#tablebody_reserve tr").each(function() {
                                $(this).css("background-color","#FFFFFF");
                            });

                            $(this).css("background-color","#4CAF50");

                            var val = $(this).closest("tr").find("td:eq(2)").text();
                            $("#slot_reserve").val(val);
                            //alert(val);
                        });
                    },
                    error: function(result) {
                        alert("Error: " + result);
                    }
                });

            });



                $("#plate_remove").prop('required',true);
                $("#slot_remove").prop('required', true);

                $("#tablebody_remove tr").click(function() {
                    $("#tablebody_remove tr").each(function() {
                        $(this).css("background-color","#FFFFFF");
                    });

                    $(this).css("background-color","#4CAF50");

                    var val = $(this).closest("tr").find("td:eq(2)").text();
                    var plate = $(this).closest("tr").find("td:eq(3)").text();
                    $("#plate_remove").val(plate);
                    $("#slot_remove").val(val);
                    //alert(val);
                });

                $("#tablebody_remove tr").hover(function() {
                    $(this).css('cursor','pointer');
                }, function() {
                    $(this).css('cursor','auto');
                });

                $("#slot_remove").change(function() {
                    var val = $(this).val();
                    $("#tablebody_remove tr").each(function() {
                        $data = $(this).find("td:eq(2)").text();
                       
                        if($data == val) {
                            $(this).click();
                        }
                    });
                });    

                $("#area_remove").change(function() {
                    $("#table_remove td").parent().remove();
                    $("#slot_remove").empty()
                    $("#slot_remove").append("<option disabled selected value> -- Select a slot -- </option>");
                    var remove = $("#area_remove").val();
                     $.ajax({
                        type: 'POST',
                        data: { remove : remove },
                        datatype: 'json',
                        url: '<?php echo site_url('manualpark/removeManageTable'); ?>', 
                        success: function(result) {
                            //all updates here
                            var data = JSON.parse(result);
                            for(loop=0; loop < data.length; loop++) {
                                $("#table_remove #tablebody_remove").append("<tr><td class='id'>" + data[loop]['id'] + "</td><td class='area'>" + data[loop]['area'] + "</td><td class='slot'>" + data[loop]['slot'] + "</td> </tr>");
                                $("#slot_remove").append("<option>" + data[loop]['slot'] + "</option>");
                            }
                            
                            $("#tablebody_remove tr").hover(function() {
                                $(this).css('cursor','pointer');
                            }, function() {
                                $(this).css('cursor','auto');
                            });


                            $("#slot_remove").change(function() {
                                var val = $(this).val();
                                $("#tablebody_remove tr").each(function() {
                                    $data = $(this).find("td:eq(2)").text();
                                   
                                    if($data == val) {
                                        $(this).click();
                                    }
                                });
                            });    

                            $("#tablebody_remove tr").click(function() {
                                $("#tablebody_remove tr").each(function() {
                                    $(this).css("background-color","#FFFFFF");
                                });

                                $(this).css("background-color","#4CAF50");

                                var val = $(this).closest("tr").find("td:eq(2)").text();
                                var plate = $(this).closest("tr").find("td:eq(3)").text();

                                $("#plate_remove").val(plate);
                                $("#slot_remove").val(val);
                                //alert(val);
                            });
                        },
                        error: function(result) {
                            alert("Error: " + result);
                        }
                    });
                });
                //document ready
                $("#slot_reserve").change(function() {
                    var val = $(this).val();
                    $("#tablebody_reserve tr").each(function() {
                        $data = $(this).find("td:eq(2)").text();
                       
                        if($data == val) {
                            $(this).click();
                        }
                    });

                });    
            });

        </script>
    </head>
<body>

<div id="wrapper">

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
                <a class="navbar-brand" href="home">eCarPass</a>
            </div>
            <!-- Top Menu Items -->
           
            <ul class="nav navbar-right top-nav">
                
                   
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                           <a href="Login" name = "linkbtn1" ><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" id="menu">
                    <li id="overviewtab" class="menu">
                        <a href="./"><i class="fa fa-fw fa-dashboard "></i> Overview</a>
                    </li>
                    <li id="transactiontab" class="menu">
                        <a href="transaction"><i class="fa fa-money fa-fw "></i> Transactions</a>
                    </li>
                   <li id="parkingtab" class="menu">
                        <a href="parkslots"><i class="fa fa-fw fa-truck "></i> Parking</a>
                   </li>
                    <li id="reservetab" class="menu">
                        <a href="manualpark"><i class="fa fa-fw fa fa-book " aria-hidden="true"></i> Manual Parking</a>
                   </li>
                   <li id="stafftab" class="menu">
                        <a href="staffaccounts"><i class="fa fa-fw fa fa-user " aria-hidden="true"></i> Staff Accounts</a>
                   </li>
                   <li id="settingtab" class="menu">
                        <a href="settings"><i class="fa fa-fw fa fa-gear " aria-hidden="true"></i> Settings</a>
                   </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>