<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 

	class Parking_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		function getParkingSlots() {
			$this->db->select('id, area, slot');
			$this->db->order_by('slot', 'asc');
			$query = $this->db->get_where('parkingslots', array('uuid'=>null));

			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("id"=>$row->id, "area"=>$row->area, "slot"=>$row->slot));
			}

			return $data;
		}

		function getCombinedParkingSlots() {
			$result = "				
		
					SELECT * FROM parkingslots
					LEFT JOIN cars ON parkingslots.uuid = cars.uuid

					UNION

					SELECT * FROM parkingslots
					RIGHT JOIN cars ON parkingslots.uuid = cars.uuid

					";
			$query = $this->db->query($result);
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("id"=>$row->id, "area"=>$row->area, "slot"=>$row->slot, "platenum"=>$row->platenum));
			}

			return $data;
		}

		function getSelectedParkingSlots($area) {
			$this->db->select('id, area, slot');
			$this->db->order_by('slot', 'asc');
			$query = $this->db->get_where('parkingslots', array('area'=>$area, 'uuid'=>null));
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("id"=>$row->id, "area"=>$row->area, "slot"=>$row->slot));
			}

			return $data;
		}

		function getDistinctParkingArea() { 
			$this->db->select('distinct(area)');
			$this->db->order_by('slot', 'asc');
			$query = $this->db->get('parkingslots');
			$data = array();
			foreach ($query->result() as $row) {
				array_push($data, $row->area);
			}

			return $data;
		}

		function getParkingSlotsCount() {
			$this->db->select('Count(slot) as count');
			$query = $this->db->get_where('parkingslots', array('uuid'=>null));
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, $row);
			}


			return $data;
		}
		
		//remove panel
		function getTakenParkingSlots() {
			$this->db->select('id, area, slot, platenum');
			//$this->db->join('cars', 'parkslots.uuid = cars.uuid', 'left');
			$this->db->order_by('slot', 'asc');
			$this->db->where('platenum !=', null);
			$this->db->or_where('uuid !=', null);
			$query = $this->db->get('parkingslots');
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("id"=>$row->id, "area"=>$row->area, "slot"=>$row->slot, "platenum"=>$row->platenum));
			}

			return $data;
		}

		function getSelectedTakenParkingSlots($area) {
			$this->db->select('id, area, slot');
			$this->db->order_by('slot', 'asc');
			$query = $this->db->get_where('parkingslots', array('area'=>$area, 'uuid !='=>null));
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("id"=>$row->id, "area"=>$row->area, "slot"=>$row->slot));
			}

			return $data;
		}

		function getTodayTransactionCount() {
			$this->db->select('count(refnum) as count');
			$query = $this->db->get_where('transactions', array('date'=>date("Y-m-d")));
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, $row);
			}

			return $data;
		}

		function getAllTransactions() {
			$this->db->select('refnum, platenum, timein, timeout, date, slot, price');
			$this->db->order_by('date', 'desc');
			$query = $this->db->get('transactions');	
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, array("refnum"=>$row->refnum, "platenum"=>$row->platenum, "timein"=>$row->timein, "timeout"=>$row->timeout, "date"=>$row->date, "slot"=>$row->slot, "price"=>$row->price));
			}

			return $data;
		}

		function getCombinedTransactions() {
			$result = "SELECT * FROM transactions
						LEFT JOIN parkingarea ON transactions.parkingid = parkingarea.parkingid
						WHERE refnum is not NULL
						UNION
						SELECT * FROM transactions
						RIGHT JOIN parkingarea ON transactions.parkingid = parkingarea.parkingid
						WHERE refnum is not NULL
						";

			$query = $this->db->query($result);
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, array("refnum"=>$row->refnum, "platenum"=>$row->platenum, "timein"=>$row->timein, "timeout"=>$row->timeout, "date"=>$row->date, "slot"=>$row->slot, "area"=>$row->parkingareaname));
			}

			return $data;
		}

		//transaction
		function getTransactionsByDate($fromdate, $todate) {
			$this->db->select('refnum, platenum, timein, timeout, date, slot');
			$this->db->order_by('date', 'desc');
			$this->db->where("date BETWEEN '". $fromdate . "' AND' " . $todate . "'");
			$query = $this->db->get('transactions');
			$data = array();

			foreach ($query->result() as $row) {
				array_push($data, array("refnum"=>$row->refnum, "platenum"=>$row->platenum, "timein"=>$row->timein, "timeout"=>$row->timeout, "date"=>$row->date, "slot"=>$row->slot));
			}

			return $data;
		}

		function getTransactionsByMonth($month) {
			$this->db->select('refnum, platenum, timein, timeout, date, slot');
			$this->db->order_by('date', 'desc');
			$this->db->like('date', $month, 'after');
			$query = $this->db->get('transactions');
			$data = array();

			if($month == "") {

			}
			else {
				foreach ($query->result() as $row) {
					array_push($data, array("refnum"=>$row->refnum, "platenum"=>$row->platenum, "timein"=>$row->timein, "timeout"=>$row->timeout, "date"=>$row->date, "slot"=>$row->slot));
				}
			}

			return $data;
		}

		function getTransactionsByPlate($platenum) {
			$this->db->select('refnum, platenum, timein, timeout, date, slot');
			$this->db->order_by('date', 'desc');
			$query = $this->db->get_where('transactions', array('platenum'=>$platenum));
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, array("refnum"=>$row->refnum, "platenum"=>$row->platenum, "timein"=>$row->timein, "timeout"=>$row->timeout, "date"=>$row->date, "slot"=>$row->slot));
			}

			return $data;
		}

		function getPlates($platenum) {
			$this->db->select('distinct(platenum)');
			$this->db->like('platenum', $platenum, 'both');
			$query = $this->db->get('transactions');
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, array("platenum"=>$row->platenum));
			}

			return $data;
		}
		//parkslots
		function getLatestParkers() {
			$this->db->select('platenum');
			
		}

		//ajax
		function getChanges(){
			$this->db->select('*');	
			$query = $this->db->get('cars');
			$data = array();

			foreach($query->result() as $row) {
				array_push($data, array("platenum"=>$row->platenum, "uuid"=>$row->uuid, "isactive"=>$row->isactive, "location"=>$row->location, ));
			}

			return $data;
		}

		function setManualParker($data) {
			$this->db->set('platenum', $data['plate_reserve']);
			$this->db->where('slot', $this->input->post('slot_reserve'));
			
			if($this->db->update('parkingslots')) {
				if($this->db->affected_rows() < 0) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				die ($this->db->error());
			}
		}
	}
?>