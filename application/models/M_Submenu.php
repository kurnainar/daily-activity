<?php

	Class M_Submenu Extends CI_Model
	{
		var $table = "m_submenu";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("a.SubMenuId, a.SubMenuName,
									IF(a.SubMenuStatus = 1, 'Aktif', 'Non-Aktif') SubMenuStatus,
									a.Controller");
			$this -> db -> from("m_submenu a");
			$this -> db -> where("a.SubMenuStatus", 1);
			$this -> db -> where("a.SubMenuDelete", 0);
			$this -> db -> order_by("a.SubMenuName", "ASC");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
		
		Public Function getController($nav)
		{
			$result = array();
			$this -> db -> select("a.SubMenuId, a.Controller");
			$this -> db -> from("m_submenu a");
			$this -> db -> where("a.Controller", $nav);
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['SubMenuId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function saveSubMenu($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getSubMenu($id)
		{
			$this -> db -> from("m_submenu");
			$this -> db -> where('SubMenuId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateSubMenu($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function deleteSubMenu($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
	}

?>