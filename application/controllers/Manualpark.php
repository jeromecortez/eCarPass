<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Manualpark extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('manualpark');
			$this->load->view('footer');
		}
		//ajax 
		function reserveManageTable() {
			$area = $this->input->post('selected');
			if($area === "All areas") {
				$data = $this->Parking_model->getParkingSlots();
			}
			else {
				$data = $this->Parking_model->getSelectedParkingSlots($area);
			}
			
			echo json_encode($data);
		}
		//ajax
		function removeManageTable() {
			$area = $this->input->post('remove');
			if($area === "All areas") {
				$data = $this->Parking_model->getTakenParkingSlots();
			}
			else {
				$data = $this->Parking_model->getSelectedTakenParkingSlots($area);
			}
			
			echo json_encode($data);
		}

		function placeManualParker() {
			$data = $this->input->post();

			if($this->Parking_model->setManualParker($data)) {
				echo "<script> alert('Error'); </script>";
			}
			else {
				echo "<script> alert('Reserved!'); </script>";
			}
			redirect('manualpark');
		}
	}
?>

  