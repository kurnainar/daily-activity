<?php

	Class M_AssignMenu Extends CI_Model
	{
		var $table = "t_assignmenu";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("a.AssignMenuId,
									b.GroupMenuName, c.SubMenuName, c.Controller,
									d.UserGroupName, e.UserFullName");
			$this -> db -> from("t_assignmenu a");
			$this -> db -> join('m_groupmenu b', 'a.GroupMenuId = b.GroupMenuId');
			$this -> db -> join('m_submenu c', 'a.SubMenuId = c.SubMenuId');
			$this -> db -> join('m_usergroup d', 'a.UserGroupId = d.UserGroupId');
			$this -> db -> join('m_user e', 'a.CreatedBy = e.Username');
			$this -> db -> where_in("b.GroupMenuStatus", 1);
			$this -> db -> where_in("c.SubMenuStatus", 1);
			$this -> db -> where_in("b.GroupMenuDelete", 0);
			$this -> db -> where_in("c.SubMenuDelete", 0);
			$this -> db -> order_by("b.GroupMenuOrder", "ASC");
			$this -> db -> order_by("c.SubMenuName", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['AssignMenuId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function getAvailable($grupid, $subid, $hakid)
		{
			$result = array();
			$this -> db -> select("a.AssignMenuId, a.GroupMenuId,
									a.SubMenuId, a.UserGroupId");
			$this -> db -> from("t_assignmenu a");
			$this -> db -> where("a.GroupMenuId", $grupid);
			$this -> db -> where("a.SubMenuId", $subid);
			$this -> db -> where("a.UserGroupId", $hakid);
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['AssignMenuId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function saveAssignMenu($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getAssignMenu($id)
		{
			$this -> db -> from("t_assignmenu");
			$this -> db -> where('AssignMenuId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function getMenuName($id)
		{
			$this -> db -> from("m_submenu");
			$this -> db -> where('Controller',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateAssignMenu($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function deleteAssignMenu($where)
		{
			$this -> db -> where('AssignMenuId', $where);
			$this -> db -> delete($this->table);
			return $this -> db -> affected_rows();
		}
		
		Public Function loopGroup()
		{
			$result = array();
			
			$hakid = $this -> session -> userdata('Group');
			
			$this -> db -> select("a.GroupMenuId, b.GroupMenuName");
			$this -> db -> from("t_assignmenu a");
			$this -> db -> join('m_groupmenu b', 'a.GroupMenuId = b.GroupMenuId');
			$this -> db -> where("b.GroupMenuStatus", 1);
			$this -> db -> where("b.GroupMenuDelete", 0);
			$this -> db -> where("a.UserGroupId", $hakid);
			$this -> db -> group_by("a.GroupMenuId");
			$this -> db -> order_by("b.GroupMenuOrder", "ASC");
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
		
		Public Function loopSub()
		{
			$result = array();
			
			$hakid = $this -> session -> userdata('Group');
			
			$this -> db -> select("a.GroupMenuId, a.SubMenuId,
									b.SubMenuName, b.Controller");
			$this -> db -> from("t_assignmenu a");
			$this -> db -> join('m_submenu b', 'a.SubMenuId = b.SubMenuId');
			$this -> db -> where("b.SubMenuStatus", 1);
			$this -> db -> where("b.SubMenuDelete", 0);
			$this -> db -> where("a.UserGroupId", $hakid);
			$this -> db -> order_by("b.SubMenuName", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['GroupMenuId']][$rows['SubMenuId']] = $rows;
				}
			}
			
			return $result;
		}
	}

?>