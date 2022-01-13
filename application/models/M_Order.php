<?php

	Class M_Order Extends CI_Model
	{
		var $table = 't_order_cust';
		
		Public Function saveOrderCust($data)
		{
			$this -> db -> insert($this->table,$data);
			Return $this->db->insert_id();
		}
		
		Public Function saveOrderDetail($data)
		{
			$conds = false;
			
			$cou=0;
			foreach($data as $rnd => $rows){
				$this->db->insert('t_order_dtl',array(
					'CustomerId' 	 	=> $rows['ordadd-custid'],
					'TglOrder' 			=> $rows['ordadd-tglorder'],
					'TglMintaDikirim' 	=> $rows['ordadd-tglreq'],
					'Produk' 	 		=> $rows['ordadd-produk'],
					'HargaUnit' 		=> $rows['ordadd-harga'],
					'Qty' 				=> $rows['ordadd-qty'],
					'TotalHarga' 		=> $rows['ordadd-price'],
					'KPI' 				=> $rows['ordadd-kpi'],
				));
				
				if($this->db->affected_rows()>0){
					$cou++;
				}
			}
			
			if($cou>0){
				$conds = true;
			}
			return $conds;
		}
		
		Public Function getCustOrder($custid = null)
		{
			$user = array();
			$sql = "SELECT
						a.OrderDetailId, a.CustomerId,
						a.TglOrder, a.TglMintaDikirim,
						a.Produk, a.HargaUnit, a.Qty, a.TotalHarga,
						a.KPI
					FROM t_order_dtl a
					WHERE a.CustomerId = '".$custid."' ";
			// echo $sql;
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$user[$rows['OrderDetailId']] = $rows;
				}
			}
			
			return $user;
		}
		
		Public Function getOrder()
		{
			$user = array();
			$sql = "SELECT
						b.OrderDetailId,
						a.CustomerId, a.NamaCustomer,
						b.Produk, b.Qty, b.HargaUnit, b.KPI, b.TglSubmit
					FROM m_customers a
					INNER JOIN t_order_dtl b ON a.CustomerId = b.CustomerId ";
			// if( $id ) {
				// $sql.=" WHERE a.KodeBPMD = '$id' ";
			// }
			// echo $sql;
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_array() as $rows)
				{
					$user[$rows['OrderDetailId']] = $rows;
				}
			}
			
			return $user;
		}
	}

?>