<?php

	Class M_ClientType Extends CI_Model
	{
		var $table = "m_client_type";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_client_type a");
			$this -> db -> order_by("a.ClientTypeId", "ASC");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
		
		Public Function getClientType($id)
		{
			$this -> db -> from("m_client_type");
			$this -> db -> where('ClientTypeId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateClientType($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function saveClientType($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function deleteClientType($where)
		{
			$this -> db -> delete($this->table, $where);
			return $this -> db -> affected_rows();
		}
	}

?>