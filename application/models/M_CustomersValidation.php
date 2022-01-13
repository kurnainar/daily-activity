<?php

	Class M_CustomersValidation Extends CI_Model
	{
		var $table = 'm_customers';
		
		Public Function saveCustomers($data)
		{
			$this -> db -> insert($this->table,$data);
			Return $this->db->insert_id();
		}
		
		Public Function getListCustomers($id = null, $grup = null)
		{
			$user = array();
			$sql = "SELECT *, Concat(a.StatusCustomer,' - ',b.CustomerStatusName) CustomerStatus,
					a.ProfilingStatus Profil
					FROM m_customers a
					LEFT JOIN m_customers_status b ON a.StatusCustomer = b.CustomerStatusCode";
			if( $grup == "MD" ) {
				$sql.=" WHERE a.KodeBPMD = '$id' ";
			}
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$user[$rows['CustomerId']] = $rows;
				}
			}
			
			return $user;
		}
		
		Public Function getCustomers($id)
		{
			$this -> db -> from("m_customers");
			$this -> db -> where('CustomerId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function getNama($id)
		{
			$this -> db -> from("m_users");
			$this -> db -> where('KodeCRM',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function getKode($kode)
		{
			$this -> db -> order_by('KodeCRM', 'DESC');
			$this -> db -> like("KodeCRM", $kode, 'both');
			return $this -> db -> get('m_users')->result_array();
			
			// $this -> db -> select('a.KodeCRM, a.Nama');
			// $this -> db -> from("m_users a");
			// $this -> db -> like('a.KodeCRM', $kode , 'both');
			// $this -> db -> where_not_in("a.Groups", "Agent");
			// echo $this -> db -> last_query();
			// $query = $this -> db -> get();

			// return $query->row();
		}
		
		Public Function updateUser($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function saveCustomersCall($data)
		{
			if($this -> db -> insert("t_history_call",$data)) {
				$this -> db -> set('Result', $this -> input -> post('telpadd-result'));
				$this -> db -> where('CustomerId', $this -> input -> post('telpadd-custid'));
				$this -> db -> update($this->table);
			}
			Return $this->db->insert_id();
		}
		
		Public Function saveCustomersJanji($data)
		{
			if($this -> db -> insert("t_appointment_call",$data)) {
				if( $this -> input -> post('telpadd-success') == "Successful" ) {
					$this -> db -> set('StatusCall', "Close");
				} elseif( $this -> input -> post('telpadd-success') == "Unsuccessful" && $this -> input -> post('telpadd-setclose') == "on" ) {
					$this -> db -> set('StatusCall', "Close");
				} else {
					$this -> db -> set('StatusCall', "In Progress");
				}
				$this -> db -> set('SuccessStatus', $this -> input -> post('telpadd-success'));
				$this -> db -> where('CustomerId', $this -> input -> post('telpadd-custid'));
				$this -> db -> update($this->table);
			}
			Return $this->db->insert_id();
		}
		
		Public Function saveCustomersProf($data)
		{
			if($this -> db -> insert("t_profiling",$data)) {
				$this -> db -> set('ProfilingStatus', $this -> input -> post('profadd-result'));
				$this -> db -> where('CustomerId', $this -> input -> post('profadd-custid'));
				$this -> db -> update($this->table);
			}
			// $this -> db -> insert("t_profiling",$data);
			Return $this->db->insert_id();
		}
		
		Public Function Provinsi()
		{
			$result = array();
			$this -> db -> select("ProvinsiId, ProvinsiName");
			$this -> db -> from("m_provinsi");
			$this -> db -> order_by("ProvinsiId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['ProvinsiId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Kota($provinsi)
		{
			$result = array();
			$this -> db -> select("KotaId, KotaName");
			$this -> db -> from("m_kota");
			$this -> db -> where("ProvinsiId", $provinsi);
			$this -> db -> order_by("KotaId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['KotaId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Kecamatan($kota)
		{
			$result = array();
			$this -> db -> select("KecamatanId, KecamatanName");
			$this -> db -> from("m_kecamatan");
			$this -> db -> where("KotaId", $kota);
			$this -> db -> order_by("KecamatanId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['KecamatanId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Kelurahan($kec)
		{
			$result = array();
			$this -> db -> select("KelurahanId, KelurahanName");
			$this -> db -> from("m_kelurahan");
			$this -> db -> where("KecamatanId", $kec);
			$this -> db -> order_by("KelurahanId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['KelurahanId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Kodepos($kel)
		{
			$result = array();
			$this -> db -> select("KodeposId, Kodepos");
			$this -> db -> from("m_kodepos");
			$this -> db -> where("KelurahanId", $kel);
			$this -> db -> order_by("KodeposId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['KodeposId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function HistoryCall($custid)
		{
			$result = array();
			$this -> db -> select("a.HistoryId, a.CallNumber, a.Result,
			IF( a.FailedReason IS NULL, ' - ', a.FailedReason ) FailedReason,
			a.Notes, a.DateCreated");
			$this -> db -> from("t_history_call a");
			$this -> db -> where("a.CustomerId", $custid);
			$this -> db -> order_by("a.HistoryId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['HistoryId']] = $rows;
				}
			}
			
			return $result;
		}
	}

?>