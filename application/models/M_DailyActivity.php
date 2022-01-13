<?php

	Class M_DailyActivity Extends CI_Model
	{
		var $table = "t_daily_activity";
		var $column_order = array(null, 'DailyActivityDate','ShiftName','DailyCategoryName','DailyActivityDesc','DailyActivityStatus','DailyCategoryScores','Username','DailyActivityId');
		var $column_search = array('DailyActivityDate','ShiftName','DailyCategoryName','DailyActivityDesc','DailyActivityStatus','DailyCategoryScores','Username','DailyActivityId');
		var $order = array('DailyActivityDate' => 'desc');
		
		private function _get_datatables_query($Username)
		{
			
			$this -> db -> select("a.DailyActivityId, a.DailyActivityDate, b.ShiftName,
									IF(a.DailyActivityStatus = 1, 'Ok', 'Berlanjut') DailyActivityStatus,
									c.DailyCategoryName, a.DailyActivityDesc, c.DailyCategoryScores,
									CONCAT(d.Username,' - ',d.UserFullName) Username");
			$this -> db -> from("t_daily_activity a");
			$this -> db -> join('m_shift b', 'a.ShiftId = b.ShiftId');
			$this -> db -> join('m_daily_category c', 'a.DailyCategoryId = c.DailyCategoryId');
			$this -> db -> join('m_user d', 'a.DailyActivityUserId = d.Username','LEFT');
			
			if($this -> session -> userdata('Group') == 5) {
				$this -> db -> where('a.DailyActivityUserId', $Username);
			}

			$i = 0;
		
			foreach ($this->column_search as $item)
			{
				if($_POST['search']['value'])
				{
					
					if($i===0)
					{
						$this->db->group_start();
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if(count($this->column_search) - 1 == $i)
						$this->db->group_end();
				}
				$i++;
			}
			
			if(isset($_POST['order']))
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_datatables($Username)
		{
			$this->_get_datatables_query($Username);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

		function count_filtered($Username)
		{
			$this->_get_datatables_query($Username);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all($Username)
		{
			$this->db->from($this->table);
			return $this->db->count_all_results();
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