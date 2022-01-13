<?php

	Class M_Department Extends CI_Model
	{
		var $table = "m_department";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_department a");
			$this -> db -> order_by("a.DepartmentName", "ASC");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
		
		Public Function saveDepartment($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getDepartment($id)
		{
			$this -> db -> from("m_department");
			$this -> db -> where('DepartmentId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateDepartment($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function deleteDepartment($where)
		{
			$this -> db -> delete($this->table, $where);
			return $this -> db -> affected_rows();
		}
	}

?>