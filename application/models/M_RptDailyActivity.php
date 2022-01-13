<?php

	Class M_RptDailyActivity Extends CI_Model
	{
		Public Function getExport($start, $end)
		{
			$result = array();
			$this -> db -> select("a.DailyActivityId,
									a.DailyActivityDate, d.ShiftName, b.DailyCategoryName, a.DailyActivityDesc,
									IF(a.DailyActivityStatus = 1, 'Ok', 'Berlanjut') DailyActivityStatus,
									CONCAT(a.DailyActivityUserId,' - ',c.UserFullName) DailyActivityUserId,
									b.DailyCategoryScores");
			$this -> db -> from("t_daily_activity a");
			$this -> db -> join("m_daily_category b","a.DailyCategoryId = b.DailyCategoryId");
			$this -> db -> join("m_user c","a.DailyActivityUserId = c.Username");
			$this -> db -> join("m_shift d","a.ShiftId = d.ShiftId");
			$this -> db -> where("a.DailyActivityDate >=", $start);
			$this -> db -> where("a.DailyActivityDate <=", $end);
			$this -> db -> order_by("a.DailyActivityDate", "DESC");
			$query = $this -> db -> get();
			
			return $query -> result_array();
		}
	}

?>