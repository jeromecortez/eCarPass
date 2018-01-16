<?PHP 
	
	


	$result = $this->db->query("SELECT count(*) as total from transactions");

	foreach ($result->result() as $row) {
		$totalTransactions['total'] = $row->total;
	}


	$resulta = $this->db->query("SELECT capacity from parkingarea");

	foreach ($resulta->result() as $row) {
		$totalparking['capacity']  = $row->capacity;
	}
	//$totalparking = mysqli_fetch_assoc($resulta);
 	
	$minusSlot = $this->db->query("SELECT count(*) as total from transactions");

	foreach ($minusSlot->result() as $row) {
		$value['total'] = $row->total; // count(*) returns a column name of 'total'
	}
	

	if(isset($_REQUEST['submit']) && !empty($_POST['platenumbox'])) {


		$shallInsert = false;
		$query = "SELECT * FROM transactions";
		$result = $this->db->query($query);
		if($result->num_rows() === 0) {
			$ref = 100000000 + mt_rand(0, 9999999);
				$query =  "INSERT INTO transactions (refnum, platenum, parkingid, staffid, timein, date, price, slot) VALUES (" . $ref . ", " . $this->db->escape($_POST['platenumbox']) . ", " . 1 . ", " . 1  . ", " . $this->db->escape(date('h:iA', time())) . ", " . $this->db->escape(date('Y-m-d')). ", " . 10 . ", " . $_POST['slot_reserve'] . ")";

				if ($this->db->query($query)) {
					if($this->db->affected_rows() < 0) {
						echo "<script> alert('Error'); </script>";;

					}
					else {
						$query = "UPDATE parkingslots set uuid = ";
						echo "<script> alert('Parker Recorded'); </script>";
					}
				}
				else {
					die ($this->db->error());
				}

				
		}
		else {
			$platenums = array(); 
			foreach ($result->result() as $row) {
				array_push($platenums, array("platenum"=>$row->platenum));
				if($row->platenum == $_POST['platenumbox'] && is_null($row->timeout)) {

					$query = "UPDATE transactions SET timeout = " . $this->db->escape(date('h:iA', time())) . " WHERE platenum ='". $row->platenum ."';";
					if ($this->db->query($query)) {
						//redirect('parkslots');
						if($this->db->affected_rows() < 0) {
							echo "<script> alert('Error'); </script>";

							break;
						}
						else {
							echo "<script> alert('Parker updated'); </script>";
							
						}
					}
					else {
						die ($this->db->error());
					}
					$shallInsert = false;
					break;

				}

				$shallInsert = true;
			}

			if($shallInsert == true) {
				$ref = 100000000 + mt_rand(0, 9999999);
					$query =  "INSERT INTO transactions (refnum, platenum, parkingid, staffid, timein, date, price, slot) VALUES (" . $ref . ", " . $this->db->escape($_POST['platenumbox']) . ", " . 1 . ", " . 1  . ", " . $this->db->escape(date('h:iA', time())) . ", " . $this->db->escape(date('Y-m-d')). ", " . 10 . ", '" . $_POST['slot_reserve'] . "')";

					if ($this->db->query($query)) {
						if($this->db->affected_rows() < 0) {
							echo "<script> alert('Error'); </script>";;
						}
						else {
							$query = "update parkingslots,transactions set parkingslots.uuid = (SELECT uuid from cars where platenum = '" . $_POST['platenumbox'] . " '') where transactions.slot =" . $_POST['slot_reserve'] . "and parkingslots.slot = '" . $_POST['slot_reserve'] . "'" ;
							if($this->db->query($query)) {
								if($this->db->affected_rows() < 0) {
									die($this->db->error());
								}
								else {

								}
							}
							else {
								die ($this->db->error());
							}
							echo "<script> alert('Parker recorded'); </script>";
						}
					}
					else {
						die ($this->db->error());
					}
			}

		//generate refnum
		}
	
	}

	if(isset($_REQUEST['submit_reserve'])) {


		$query =  "select uuid from cars where platenum='" . $this->input->post('plate_reserve') . "'";
		$uuid = "";
		$result = $this->db->query($query);
		foreach($result->result() as $row) {
			$uuid = $row->uuid;
		}
		
		
		$this->db->set('uuid', $uuid);
		$this->db->where('slot', $this->input->post('slot_reserve'));
		
		if($this->db->update('parkingslots')) {
			if($this->db->affected_rows() < 0) {
				echo "<script> alert('Error'); </script>";
				//redirect('reserve');
			}
			else {

				echo "<script> alert('Reserved!'); </script";
				//redirect("reserve");
			}
		}
		else {
			die ($this->db->error());
		}

		
		
	}

	if(isset($_REQUEST['submit_remove'])) {

		
		$this->db->set('uuid', null);
		$this->db->set('platenum', null);
		$this->db->where('slot', $this->input->post('slot_remove'));
		
		if($this->db->update('parkingslots')) {
			if($this->db->affected_rows() < 0) {
				echo "<script> alert('Error'); </script>";
				//redirect('reserve');
			}
			else {
				echo "<script> alert('Removed!'); </script";
				//redirect("reserve");
			}
		}
		else {
			die ($this->db->error());
		}

		
	}
?>