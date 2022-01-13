<?php

	Class DailyActivity Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_DailyActivity','M_Combo'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('dailyactivity/dailyactivity-list');
		}
		
		Public Function listTable()
		{
			$Username = $this -> session -> userdata('Username');
			$Data = $this -> M_DailyActivity -> getListData($Username);
			echo json_encode($Data);
		}
		
		Public Function ajax_list()
		{
			$Username = $this -> session -> userdata('Username');
			$list = $this->M_DailyActivity->get_datatables($Username);
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $customers) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $customers->DailyActivityDate;
				$row[] = $customers->ShiftName;
				$row[] = $customers->DailyCategoryName;
				$row[] = $customers->DailyActivityDesc;
				$row[] = $customers->DailyActivityStatus;
				$row[] = $customers->DailyCategoryScores;
				$row[] = $customers->Username;
				$row[] = $customers->DailyActivityId;

				$data[] = $row;
			}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->M_DailyActivity->count_all($Username),
							"recordsFiltered" => $this->M_DailyActivity->count_filtered($Username),
							"data" => $data,
						);
			//output to json format
			echo json_encode($output);
		}
		
		Public Function formAdd()
		{
			$Data = array(
						'Shift'		=> $this -> M_Combo -> Shift(),
						'Kategori'	=> $this -> M_Combo -> DailyCategory()
					);
			$this -> load -> view('dailyactivity/dailyactivity-add', $Data);
		}
		
		Public Function saveDailyActivity()
		{
			$result = array('status' => false);
			
			$Data = array(
						'DailyActivityDate'			=> $this -> input -> post('actadd-tgl'),
						'ShiftId'					=> $this -> input -> post('actadd-shift'),
						'DailyCategoryId'			=> $this -> input -> post('actadd-jenis'),
						'DailyActivityDesc'			=> ucwords($this -> input -> post('actadd-desc')),
						'DailyActivityStatus'		=> $this -> input -> post('actadd-status'),
						'DailyActivityUserId'		=> $this -> session -> userdata('Username'),
						'DailyActivityCreateDate'	=> date('Y-m-d H:i:s')
					);
					
			if( array('status' => true) ) {
				$this -> M_DailyActivity -> saveDailyActivity($Data);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Catatan Kegiatan Harian Berhasil Ditambahkan', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Catatan Kegiatan Harian Gagal Ditambahkan', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function formEdit()
		{
			$Data = array(
						'Shift'		=> $this -> M_Combo -> Shift(),
						'Kategori'	=> $this -> M_Combo -> DailyCategory()
					);
			$this -> load -> view('dailyactivity/dailyactivity-edit', $Data);
		}
		
		Public Function getDailyActivity($id)
		{
			$Data = $this -> M_DailyActivity -> getDailyActivity($id);
			echo json_encode($Data);
		}
		
		Public Function updateDailyActivity()
		{
			$result = array('status' => false);
			
			$id = array('DailyActivityId' => $this -> input -> post('actedit-id'));
			
			$Data = array(
						'DailyActivityDate'			=> $this -> input -> post('actedit-tgl'),
						'ShiftId'					=> $this -> input -> post('actedit-shift'),
						'DailyCategoryId'			=> $this -> input -> post('actedit-jenis'),
						'DailyActivityDesc'			=> ucwords($this -> input -> post('actedit-desc')),
						'DailyActivityStatus'		=> $this -> input -> post('actedit-status'),
						'DailyActivityUpdateDate'	=> date('Y-m-d H:i:s')
					);
			
			if( array('status' => true) ) {
				$this -> M_DailyActivity -> updateDailyActivity($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Catatan Kegiatan Harian Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Catatan Kegiatan Harian Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>