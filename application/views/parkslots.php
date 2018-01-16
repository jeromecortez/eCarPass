<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	include_once(FCPATH . 'libraries/HomeRepository.php');
?>

<style type="text/css">
    .table-responsive {
        max-height: 200px;
        overflow-y: auto;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#platenumbox").prop('required',true);
         $("#slot_reserve").prop('required',true);          

        if(sessionStorage.getItem("nearParker") != "") {
            $("#platenumbox").val(sessionStorage.getItem("nearParker"));
        }

        $("#plate_reserve").val($("#platenumbox").val());
    });
</script>
        <div id="page-wrapper">
<form action="parkslots" method="post" enctype="multipart/form-data"> 
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
                                            $data = $this->Parking_model->getParkingSlotsCount(); 
                                            foreach($data as $row) {
                                                $data = $row->count;
                                            }
                                            echo $data;
                                        ?>  
                                        </div>
                                        <div>Available Slots</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Cashier Forms -->
                        

                            <!-- staff username -->
                            <div class="form-group">
                                <label for="disabledSelect">Cashier</label>
                                <input class="form-control" id="disabledInput" type="text" Value="<?php echo $_SESSION['loginuser'];?>"	  disabled></input>
                            </div>
    
                           <!-- Plate number textbox -->
                            <div class="form-group">
                                    <label>Plate Number</label>
                                    <input class="form-control" placeholder="Enter Plate Number" name="platenumbox" id="platenumbox">
                             </div>
                             <!-- In/Out button -->
                             <div class="form-group" style="padding-bottom: 15px;">
                                   <!-- <input class="form-control btn btn-primary" type="submit" value="Time In / Time Out" name="submit" disabled> -->
                             </div>
                        </form>
                    </div>

                        

                    <div class="col-lg-7 col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-truck"></i> Parking Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Parker</th>
                                                <th>Parking Slot</th>
                                                <th>Parking Area</th>
                                                <th>Time In </th>
                                                <th>Time Out </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                                $data = $this->Parking_model->getCombinedTransactions();
                                                foreach($data as $row)
                                                {
                                                    echo "<tr>"; 
                                                    echo "<td>".$row['platenum']."</td>";
                                                    echo "<td>".$row['slot']."</td>";
                                                    echo "<td>".$row['area']."</td>";
                                                    echo "<td>".$row['timein']."</td>";
                                                    echo "<td>".$row['timeout']."</td>";
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
                <div class = "row">
                    <div class="col-md-12 col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Parking Slot Panel</h3>
                            </div>
                            <div class="panel-body">
                            <!--old
                                <div class="table-responsive">
                                   
                                </div>
                            -->
                            
                                <div class=""> 
                                    <div class="col-xs-6 col-md-3">
                                        <label for="plate_reserve">Plate Number:</label>
                                        <input type="text" class="form-control" id="plate_reserve" name="plate_reserve" placeholder="">
                                    </div>
                                </div>
                                 <div class=""> 
                                    <div class="col-xs-6 col-md-5 "> 
                                        <label for="area_reserve">Parking Area:</label>
                                        <select type="text" class="form-control" id="area_reserve" name="area_reserve" placeholder="">
                                            <option> All areas </option>
                                            <?php 
                                                $data = $this->Parking_model->getDistinctParkingArea();
                                                foreach ($data as $row) {
                                                    echo "<option>" . $row . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                 <div class=""> 
                                    <div class="col-xs-12 col-md-4" style="padding-bottom: 10px;"> 
                                        <label for="slot_reserve">Slot Number:</label>
                                        <select type="text" class="form-control" id="slot_reserve" name="slot_reserve">
                                            <!-- these are test options -->
                                            <option disabled selected value> -- Select a slot -- </option>
                                            <?php 
                                                $data = $this->Parking_model->getParkingSlots();
                                                foreach ($data as $row) {
                                                    echo "<option>" . $row['slot'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;"> 
                                    <div class="col-xs-12 col-md-12">
                                        <div class="table-responsive " id="reservetablediv">
                                            <table class="table" id="table_reserve">
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Parking Area </th>
                                                    <th> Slot </th>
                                                </tr>
                                                <tbody id="tablebody_reserve">
                                                    <?php  
                                                        $data = $this->Parking_model->getParkingSlots();
                                                        foreach($data as $row) {
                                                            echo "<tr>";
                                                            echo "<td class='id'>" . $row['id'] . "</td>";
                                                            echo "<td class='area'>" . $row['area'] . "</td>";
                                                            echo "<td class='slot'>" . $row['slot'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-12" style="padding-top: 10px;">
                                        <div class="col-md-5 col-md-offset-3" >
                                            <input class="form-control btn btn-primary" type="submit" value="Time In / Time Out" name="submit" id="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        <!-- /#page-wrapper -->
