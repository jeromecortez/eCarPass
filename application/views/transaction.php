
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

<script>
    $(document).ready(function() {
        var $focused = $(':focus');
        var focusable = false;


        $("#plate").focusin(function() {
            focusable = true;
        });

        $("#plate").focusout(function() {
            focusable = false;
        });

        $(document).click(function() {
            if(focusable == false && $("#plate").val() != "") {
                $(".dropdown-content").css('display', 'none');
            }
        });

        $("#plate").prop('required',true);
        $("#monthsearch").prop('required',true);
        $("#todate").prop('required',true);
        $("#fromdate").prop('required',true);

        $("#submit_datesearch").click(function(event) {
            
            if($("#fromdate").val() == "" || $("#todate").val() == "") {
                event.preventDefault();
                alert("Please select all the dates required");
            }
            else {
                var fromdate = $("#fromdate").val();
                var todate = $("#todate").val();

                $.ajax ({
                    type: 'POST',
                    data: { fromdate : fromdate, todate : todate },
                    datatype: 'json',
                    url: '<?php echo site_url('transaction/transactionManageTableByDate'); ?>', 
                    success: function(result) { 
                        var data = JSON.parse(result);

                        if(data.length > 0) {
                            $("#tbody_transac td").parent().remove();
                            $(document).scrollTop(0);
                            for(loop=0; loop < data.length; loop++) {
                                $("#transac_table #tbody_transac").append("<tr><td>" + data[loop]['refnum'] + "</td><td>" + data[loop]['date'] + "</td><td>" + data[loop]['platenum'] + "</td><td>" + data[loop]['timein']  + "</td><td>" + data[loop]['timeout'] +  "</td><td>" + data[loop]['slot'] + "</td> </tr>");
                            }
                            alert("found " + data.length + " result(s)!");
                        }
                        else {
                            alert("No data found");
                        }
                    },
                    error: function(result) {
                        console.log(result.responseText)
                        alert('Error! Please Check the console' );

                    }
                });
            }   

            
        });

        $("#submit_monthsearch").click(function(event) {

            if($("#monthsearch").val() == "") {
                event.preventDefault();
                alert("Please select a month to search");
            }   
            else {
                var month = $("#monthsearch").val();
                $.ajax ({
                    type: 'POST',
                    data: { month : month },
                    datatype: 'json',
                    url: '<?php echo site_url('transaction/transactionManageTableByMonth'); ?>', 
                    success: function(result) { 
                        var data = JSON.parse(result);
                        if(data.length > 0) {
                            $("#tbody_transac td").parent().remove();
                            $(document).scrollTop(0);
                            for(loop=0; loop < data.length; loop++) {
                                $("#transac_table #tbody_transac").append("<tr><td>" + data[loop]['refnum'] + "</td><td>" + data[loop]['date'] + "</td><td>" + data[loop]['platenum'] + "</td><td>" + data[loop]['timein']  + "</td><td>" + data[loop]['timeout'] +  "</td><td>" + data[loop]['slot'] + "</td> </tr>");
                            }
                            alert("found " + data.length + " result(s)!");
                        }
                        else {
                            alert("No data found");
                        }
                    },
                    error: function(result) {
                        console.log(result.responseText)
                        alert('Error! Please Check the console' );

                    }
                });
            }
            
        });

        $("#plate").on('input',function() {
            

            var platenum = $(this).val();
            $.ajax ({
                type: 'POST',
                data: { platenum : platenum },
                datatype: 'json',
                url: '<?php echo site_url('transaction/retrievePlates'); ?>', 
                success: function(result) {                 
                    var data = JSON.parse(result);

                    if(platenum == "" || data.length <= 0) {
                        $(".dropdown-content").css('display', 'none');
                    }
                    else {
                        $(".dropdown-content").css('display', 'block');
                    }
                    $("#suggestiontable td").parent().remove();

                    for(loop=0; loop < data.length; loop++) {
                        $("#suggestiontable #suggestiontbody").append("<tr><td id='platedata'>"  + data[loop]['platenum'] + "</td> </tr>");
                    }

                    $("#suggestiontbody tr").hover(function() {
                        $(this).css('cursor','pointer');
                        $(this).css("background-color","#F1F1F1");
                    }, function() {
                        $(this).css('cursor','auto');
                        $(this).css("background-color","#F9F9F9");
                    });

                    $("#suggestiontbody tr").click(function() {
                        $("#plate").val($("#platedata").text());
                        $(".dropdown-content").css('display', 'none');
                    });

                    //$("#plate").blur(function() {
                    //    $(".dropdown-content").css('display', 'none');
                    //});

                },
                error: function(result) {
                    console.log(result.responseText)
                    alert('Error! Please Check the console' );

                }
            });

        });

        $("#submit_platesearch").click(function(event) {

            if($("#plate").val() == "") {
                event.preventDefault();
                alert("Please select a plate number to search");
            }   
            else {
                var platenum = $("#plate").val();
                $.ajax ({
                    type: 'POST',
                    data: { platenum : platenum },
                    datatype: 'json',
                    url: '<?php echo site_url('transaction/transactionManageTableByPlate'); ?>', 
                    success: function(result) { 
                        var data = JSON.parse(result); 
                        if(data.length > 0) {
                            $("#tbody_transac td").parent().remove();
                            
                            for(loop=0; loop < data.length; loop++) {
                                $("#transac_table #tbody_transac").append("<tr><td>" + data[loop]['refnum'] + "</td><td>" + data[loop]['date'] + "</td><td>" + data[loop]['platenum'] + "</td><td>" + data[loop]['timein']  + "</td><td>" + data[loop]['timeout'] +  "</td><td>" + data[loop]['slot'] + "</td> </tr>");
                            }
                            $(document).scrollTop(0);
                            alert("found " + data.length + " result(s)!");
                        }
                        else {
                            alert("No data found");
                        }
                    },
                    error: function(result) {
                        console.log(result.responseText)
                        alert('Error! Please Check the console' );

                    }
                });
            }
            
        });

        

    });
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 col-md-8">
                        <h1 class="page-header">
                            eCarPass<small> Transactions</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-8">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Today is <strong><?php  echo date("Y/m/d") . " " . date("l");   ?></strong> 
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-10 col-md-12">
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="transac_table">
                                        <thead>
                                            <tr>
                                                <th>Reference #</th>
                                                <th>Date</th>
                                                <th>PlateNumber</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Parking Slot</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_transac">
                                            <?php 
                                                $data = $this->Parking_model->getAllTransactions();
                                                foreach($data as $row)
                                                {
                                                    echo "<tr>"; 
                                                    echo "<td>".$row['refnum']."</td>";
                                                    echo "<td>".$row['date']."</td>";
                                                    echo "<td>".$row['platenum']."</td>";
                                                    echo "<td>".$row['timein']."</td>";
                                                    echo "<td>".$row['timeout']."</td>";
                                                    echo "<td>".$row['slot']."</td>";
                                                    echo "</tr>";
                                                }
                                            ?>   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-10 col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-book fa-fw"> </i> Search Transactions</h3>
                            </div>
                            <div class="panel-body">            
                                <div class="row" style="padding-bottom: 10px;">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label for="byDate_group">By Date </label>
                                        <div class="form-group" id="byDate_group"> 
                                            <div class="col-xs-8 col-md-7 col-lg-5">
                                                <label for="fromdate">From</label>
                                                <input type="date" class="form-control"  id="fromdate">
                                            </div>
                                            <div class="col-xs-8 col-md-7 col-lg-5">
                                                <label for="todate">To</label>
                                                <input type="date" class="form-control" id="todate" >
                                            </div>
                                            <div class="col-xs-8 col-md-7 col-lg-2 " style="padding-left: 10px;">
                                                <label for="submit_datesearch" style="padding-top: 15px;"></label>
                                                <input type="submit" class="form-control btn-primary" id="submit_datesearch" value="Search by date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 10px;">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label for="byMonth_group">By Month </label>
                                        <div class="form-group" id="byMonth_group"> 
                                            <div class="col-xs-8 col-md-7 col-lg-5">
                                                <label for="monthsearch">Month</label>
                                                <input type="month" class="form-control" id="monthsearch" name="monthsearch" placeholder="" >
                                            </div>
                                             <div class="col-xs-8 col-md-7 col-lg-2 " style="padding-left: 10px;">
                                                <label for="submit_monthsearch" style="padding-top: 15px;"></label>
                                                <input type="submit" class="form-control btn-primary" id="submit_monthsearch" value="Search by month">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 10px;">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label for="byPlateNum_group">By Plate Number </label>
                                        <div class="form-group" id="byPlateNum_group"> 
                                            <div class="col-xs-8 col-md-7 col-lg-5">
                                                <label for="platesearch">Plate number</label>
                                                <input type="text" class="form-control" id="plate" name="plate" placeholder="" autocomplete="off">
                                                <div class="dropdown" id="autodropdown">
                                                    <div class="dropdown-content">
                                                        <table id="suggestiontable"> 
                                                            <tbody id="suggestiontbody">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-xs-8 col-md-7 col-lg-2 " style="padding-left: 10px;">
                                                <label for="submit_monthsearch" style="padding-top: 15px;"></label>
                                                <input type="submit" class="form-control btn-primary" id="submit_platesearch" value="Search by plate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>