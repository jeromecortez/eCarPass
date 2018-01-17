<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Settings extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('settingsview');
			$this->load->view('footer');
		}

		function changeSettings() {
			$postdata = $this->input->post();

			echo "<script> console.log('" . json_encode($postdata) . "'); </script>";

			redirect($_SERVER['HTTP_REFERER']);
		}
	}
?>