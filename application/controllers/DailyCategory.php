<?php

	Class DailyCategory Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_DailyCategory'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('dailycategory/dailycategory-list');
		}
		
		Public Function listTable()
		{
			$Data = $this -> M_DailyCategory -> getListData();
			echo json_encode($Data);
		}
		
		Public Function formAdd()
		{
			$this -> load -> view('dailycategory/dailycategory-add');
		}
		
		Public Function saveDailyCategory()
		{
			$result = array('status' => false);
			
			$Data = array(
						'DailyCategoryName'		=> ucwords($this -> input -> post('dailyadd-jenis')),
						'DailyCategoryDesc'		=> ucwords($this -> input -> post('dailyadd-desc')),
						'DailyCategoryScores'	=> $this -> input -> post('dailyadd-skor')
					);
					
			if( array('status' => true) ) {
				$this -> M_DailyCategory -> saveDailyCategory($Data);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Kategori Harian Berhasil Ditambahkan', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Kategori Harian Gagal Ditambahkan', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function formEdit()
		{
			$this -> load -> view('dailycategory/dailycategory-edit');
		}
		
		Public Function getDailyCategory($id)
		{
			$Data = $this -> M_DailyCategory -> getDailyCategory($id);
			echo json_encode($Data);
		}
		
		Public Function updateDailyCategory()
		{
			$result = array('status' => false);
			
			$id = array('DailyCategoryId' => $this -> input -> post('dailyedit-id'));
			
			$Data = array(
						'DailyCategoryName'		=> ucwords($this -> input -> post('dailyedit-jenis')),
						'DailyCategoryDesc'		=> ucwords($this -> input -> post('dailyedit-desc')),
						'DailyCategoryScores'	=> $this -> input -> post('dailyedit-skor')
					);
			
			if( array('status' => true) ) {
				$this -> M_DailyCategory -> updateDailyCategory($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Kategori Harian Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Kategori Harian Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function deleteDailyCategory()
		{
			$result = array('status' => false);
			
			$id = array('DailyCategoryId' => $this -> input -> post('dailyedit-id'));
			
			if( array('status' => true) ) {
				$this -> M_DailyCategory -> deleteDailyCategory($id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Kategori Harian Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Kategori Harian Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>