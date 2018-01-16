<?php 
	defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Staff_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		function getStaffAccounts() {
			$this->db->select('staffname, password');
			$this->db->order_by('id', 'asc');
			$query = $this->db->get('stafacc');

			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array( "staffname"=>$row->staffname, "password"=>$row->password));
			}

			return $data;
		}

		function getStaffAccountsCount() {
			$this->db->select('Count(staffname) as count');
			$query = $this->db->get('stafacc');
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, $row);
			}


			return $data;
		}

		function registerAccount($firstname, $lastname, $username, $password) {
			$query = "INSERT INTO stafacc(staffname, password, firstname, lastname, datecreated) values ('$firstname', '$lastname', '$username', '$password','" . date('Y-m-d') . "')";
			
			if ($this->db->query($query)) {
				//redirect('parkslots');
				if($this->db->affected_rows() < 0) {
					echo "<script> alert('Error'); </script>";			
				}
				else {
					echo "<script> alert('added'); </script>";
				}
				echo "<script> window.location.replace('". base_url('staffaccounts') . "') </script>";
			}
			else {
				die($this->db->error());
			}
		}

	}
?>