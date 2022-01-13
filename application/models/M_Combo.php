<?php

	Class M_Combo Extends CI_Model
	{
		Public Function Groupmenu()
		{
			$result = array();
			$this -> db -> select("a.GroupMenuId, a.GroupMenuName");
			$this -> db -> from("m_groupmenu a");
			$this -> db -> where_in("a.GroupMenuStatus", 1);
			$this -> db -> where_in("a.GroupMenuDelete", 0);
			$this -> db -> order_by("a.GroupMenuName", "ASC");
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
		
		Public Function Submenu()
		{
			$result = array();
			$this -> db -> select("a.SubMenuId, a.SubMenuName");
			$this -> db -> from("m_submenu a");
			$this -> db -> where_in("a.SubMenuStatus", 1);
			$this -> db -> where_in("a.SubMenuDelete", 0);
			$this -> db -> order_by("a.SubMenuName", "ASC");
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
		
		Public Function Usergroup()
		{
			$result = array();
			$this -> db -> select("a.UserGroupId, a.UserGroupName");
			$this -> db -> from("m_usergroup a");
			if($this -> session -> userdata('Group') != 1) {
				$this -> db -> where_not_in("a.UserGroupId", array('1','6'));
			}
			$this -> db -> order_by("a.UserGroupId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['UserGroupId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Department()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_department a");
			$this -> db -> order_by("a.DepartmentName", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['DepartmentId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function DailyCategory()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_daily_category a");
			$this -> db -> order_by("a.DailyCategoryName", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['DailyCategoryId']] = $rows;
				}
			}
			
			return $result;
		}
		
		Public Function Shift()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_shift a");
			$this -> db -> order_by("a.ShiftId", "ASC");
			$query = $this -> db -> get();
			
			if($query -> num_rows() > 0)
			{
				foreach($query -> result_array() as $rows)
				{
					$result[$rows['ShiftId']] = $rows;
				}
			}
			
			return $result;
		}
	}

?>