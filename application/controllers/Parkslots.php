<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Parkslots extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('parkslots');
			$this->load->view('footer');
		}
		//ajax
		function checkStatus() {
			$data = $this->Parking_model->getChanges();
			echo json_encode($data);
		}
	}
?>