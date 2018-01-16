<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Transaction extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('transaction');
			$this->load->view('footer');
		}
		//ajax
		function transactionManageTableByDate() {
			
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			$data = $this->Parking_model->getTransactionsByDate($fromdate, $todate);

			echo json_encode($data); 
		}
		//ajax
		function transactionManageTableByMonth() {
			
			$month = $this->input->post('month');
			$data = $this->Parking_model->getTransactionsByMonth($month);

			echo json_encode($data); 
		}
		//ajax
		function transactionManageTableByPlate() {

			$platenum = $this->input->post('platenum');
			$data = $this->Parking_model->getTransactionsByPlate($platenum);

			echo json_encode($data);
		}
		//ajax
		function retrievePlates() {

			$platenum = $this->input->post('platenum');
			$data = $this->Parking_model->getPlates($platenum);

			echo json_encode($data);
		}
	}	
?>