<?php

	Class M_Groupmenu Extends CI_Model
	{
		var $table = "m_groupmenu";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("a.GroupMenuId, a.GroupMenuName,
									IF(a.GroupMenuStatus = 1, 'Aktif', 'Non-Aktif') GroupMenuStatus,
									a.GroupMenuOrder");
			$this -> db -> from("m_groupmenu a");
			$this -> db -> where("a.GroupMenuStatus", 1);
			$this -> db -> where("a.GroupMenuDelete", 0);
			$this -> db -> order_by("a.GroupMenuOrder", "ASC");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
		
		Public Function getUrutan($order)
		{
			$result = array();
			$this -> db -> select("a.GroupMenuId, a.GroupMenuOrder");
			$this -> db -> from("m_groupmenu a");
			$this -> db -> where("a.GroupMenuOrder", $order);
			$this -> db -> order_by("a.GroupMenuOrder", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['GroupMenuId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function saveGroupMenu($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getGroupMenu($id)
		{
			$this -> db -> from("m_groupmenu");
			$this -> db -> where('GroupMenuId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateGroupMenu($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function deleteGroupMenu($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
	}

?>