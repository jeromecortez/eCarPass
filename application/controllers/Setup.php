<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Setup extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('footer');
		}
	}
?>