<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    include_once(FCPATH . 'libraries/HomeRepository.php');

    if(isset($_POST['submit'])) {
        
    }
?>

<style type="text/css">
    #removetablediv {
        height: 250px;
        overflow-y: auto;
        margin-top:10px;
    }
    #reservetablediv {
        height: 250px;
        overflow-y: auto;
        margin-top:10px;
    }

</style>

<script type="text/javascript">

</script>

 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <h1 class="page-header">
                            eCarPass<small> Manual   Parking</small>
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
                    
                    
                    
                    <div class="col-lg-4 col-md-6 col-xs-6">
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
                            <a href="">
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
                    <div class="col-md-12 col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Parking Panel</h3>
                            </div>
                            <div class="panel-body">
                            <!--old
                                <div class="table-responsive">
                                   
                                </div>
                            -->
                            <form action="manualpark/placemanualparker" method="post">
                                <div class="form-group"> 
                                    <div class="col-xs-6 col-md-3">
                                        <label for="plate_reserve">Plate Number:</label>
                                        <input type="text" class="form-control" id="plate_reserve" name="plate_reserve" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group"> 
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
                                 <div class="form-group"> 
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
                                            <input type="submit" name="submit_reserve" class="form-control btn-primary" value="Place">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                     <div class="col-md-12 col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Remove Parking Panel</h3>
                            </div>
                            <div class="panel-body">
                            <form action="manualpark" method="post">
                                <div class="form-group"> 
                                    <div class="col-xs-6 col-md-3">
                                        <label for="plate_remove">Plate Number:</label>
                                        <input type="text" class="form-control" id="plate_remove" name="plate_remove" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-xs-6 col-md-5 "> 
                                        <label for="area_remove">Parking Area:</label>
                                        <select type="text" class="form-control" id="area_remove" name="area_remove" placeholder="">
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
                                 <div class="form-group"> 
                                    <div class="col-xs-12 col-md-4" style="padding-bottom: 10px;"> 
                                        <label for="slot_remove">Slot Number:</label>
                                        <select type="text" class="form-control" id="slot_remove" name="slot_remove">
                                            <!-- these are test options -->
                                            <option disabled selected value> -- Select a slot -- </option>
                                            <?php 
                                                $data = $this->Parking_model->getTakenParkingSlots();
                                                foreach ($data as $row) {
                                                    echo "<option>" . $row['slot'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;"> 
                                    <div class="col-xs-12 col-md-12">
                                        <div class="table-responsive" id="removetablediv">
                                            <table class="table" id="table_remove">
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Parking Area </th>
                                                    <th> Slot </th>
                                                    <th> Parker </th>
                                                </tr>
                                                <tbody id="tablebody_remove">
                                                    <?php  
                                                        $data = $this->Parking_model->getTakenParkingSlots();

                                                        foreach($data as $row) {
                                                            echo "<tr>";
                                                            echo "<td class='id'>" . $row['id'] . "</td>";
                                                            echo "<td class='area'>" . $row['area'] . "</td>";
                                                            echo "<td class='slot'>" . $row['slot'] . "</td>";
                                                            echo "<td class='platenum'>" . $row['platenum'] . "</td>";
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
                                            <input type="submit" name="submit_remove" class="form-control btn-primary" value="Remove" id="remove">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
