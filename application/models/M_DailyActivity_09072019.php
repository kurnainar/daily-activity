<?php

	Class M_DailyActivity Extends CI_Model
	{
		var $table = "t_daily_activity";
		
		Public Function getListData($Username)
		{
			$result = array();
			$this -> db -> select("a.DailyActivityId, a.DailyActivityDate, b.ShiftName,
									IF(a.DailyActivityStatus = 1, 'Okay', 'Berlanjut') DailyActivityStatus,
									c.DailyCategoryName, a.DailyActivityDesc, c.DailyCategoryScores,
									CONCAT(d.Username,' - ',d.UserFullName) Username");
			$this -> db -> from("t_daily_activity a");
			$this -> db -> join('m_shift b', 'a.ShiftId = b.ShiftId');
			$this -> db -> join('m_daily_category c', 'a.DailyCategoryId = c.DailyCategoryId');
			$this -> db -> join('m_user d', 'a.DailyActivityUserId = d.Username');
			
			if($this -> session -> userdata('Group') == 5) {
				$this -> db -> where('a.DailyActivityUserId', $Username);
			}
			
			$this -> db -> order_by('a.DailyActivityDate', 'DESC');
			
			$query = $this -> db -> get();
			
			// echo "<pre>";
			// echo $this -> db -> last_query();
			// echo "</pre>";
			
			return $query -> result_array();
		}
		
		Public Function saveDailyActivity($data)
		{
			$this -> db -> insert($this->table, $data);
			Return $this -> db -> insert_id();
		}
		
		Public Function getDailyActivity($id)
		{
			$this -> db -> from("t_daily_activity");
			$this -> db -> where('DailyActivityId',$id);
			$query = $this -> db -> get();

			return $query->row();
		}
		
		Public Function updateDailyActivity($data, $where)
		{
			$this -> db -> update($this->table, $data, $where);
			return $this -> db -> affected_rows();
		}
	}

?>