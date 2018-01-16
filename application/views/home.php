<?php 
    $user = $_SESSION['loginuser'];
?>
    
<style type="text/css">
    #alertdiv {
        padding-top: 8px;
        padding-bottom: 8px;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
    #tablediv {
        height: 200px;
        overflow-y: auto;
    }
</style>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            eCarPass<small> Statistics Overview</small>
                        </h1> 
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="alert alert-info alert-dismissable" id="alertdiv">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Today is <strong><?php  echo date("Y/m/d") . " " . date("l");   ?></strong> 
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                    <div class="col-lg-5 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                            $data = $this->Parking_model->getTodayTransactionCount(); 
                                            foreach($data as $row) {
                                                $data = $row->count;
                                            }
                                            echo $data;
                                        ?>  
                                        </div>
                                        <div>Today's Transactions</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaction">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php 
                                                $data = $this->Parking_model->getParkingSlotsCount(); 
                                                foreach($data as $row) {
                                                    $data = $row->count;
                                                }
                                                echo $data;
                                            ?>  
                                        </div>
                                        <div>Available Parking Slots</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    


                    
                    <div class="col-lg-10 col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" id="tablediv">
                                    <table class="table table-bordered table-hover table-striped" id="transactable">
                                        <thead>
                                            <tr>
                                                <th>Reference #</th>
                                                <th>Date</th>
                                                <th>PlateNumber</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Parking Slot</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
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
                                                    echo "<td>₱".$row['price']."</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="transaction" id="transac_shortcut">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
    <!-- /#wrapper -->

    <!-- jQuery -->
  
</form>


<?PHP 
    if(isset($_POST['linkbtb1']))
    {
        session_start();
        session_destroy();
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=Login\">";
    }
?>