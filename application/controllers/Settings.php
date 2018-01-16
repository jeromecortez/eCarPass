<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Settings extends CI_Controller {

		function index() {
			$this->load->view('header');
			$this->load->view('settingsview');
			$this->load->view('footer');
		}
	}
?>