<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Staffaccounts extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('staffview');
			$this->load->view('footer');
		}

		function register() {
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->Staff_model->registerAccount($username, $password, $firstname, $lastname);
		}
	}
?>