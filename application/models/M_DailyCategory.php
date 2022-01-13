<?php

	Class M_DailyCategory Extends CI_Model
	{
		var $table = "m_daily_category";
		
		Public Function getListData()
		{
			$result = array();
			$this -> db -> select("*");
			$this -> db -> from("m_daily_category a");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
		
		Public Function saveDailyCategory($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getDailyCategory($id)
		{
			$this -> db -> from("m_daily_category");
			$this -> db -> where('DailyCategoryId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateDailyCategory($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
		
		Public Function deleteDailyCategory($where)
		{
			$this -> db -> delete($this->table, $where);
			return $this -> db -> affected_rows();
		}
	}

?>