<?php

	Class Groupmenu Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_Groupmenu'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('groupmenu/groupmenu-list');
		}
		
		Public Function listTable()
		{
			$Data = $this -> M_Groupmenu -> getListData();
			echo json_encode($Data);
		}
		
		Public Function formAdd()
		{
			$this -> load -> view('groupmenu/groupmenu-add');
		}
		
		Public Function formEdit()
		{
			$this -> load -> view('groupmenu/groupmenu-edit');
		}
		
		Public Function saveGroupMenu()
		{
			$result = array('status' => false);
			
			$Urutan = $this -> M_Groupmenu -> getUrutan($this -> input -> post('grpadd-urut'));
			
			$Data = array(
						'GroupMenuName'		=> ucwords($this -> input -> post('grpadd-nama')),
						'GroupMenuStatus'	=> $this -> input -> post('grpadd-status'),
						'GroupMenuOrder'	=> $this -> input -> post('grpadd-urut')
					);
					
			if( empty($Urutan) ) {
				if( array('status' => true) ) {
					$this -> M_Groupmenu -> saveGroupMenu($Data);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Grup Menu Berhasil Ditambahkan', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Grup Menu Gagal Ditambahkan', 'type' => 'warning');
				}
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Urutan Grup Menu Sudah Ada', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function getGroupMenu($id)
		{
			$Data = $this -> M_Groupmenu -> getGroupMenu($id);
			echo json_encode($Data);
		}
		
		Public Function updateGroupMenu()
		{
			$result = array('status' => false);
			
			$id = array('GroupMenuId' => $this -> input -> post('grpedit-id'));
			
			$Data = array(
						'GroupMenuName'		=> ucwords($this -> input -> post('grpedit-nama')),
						'GroupMenuStatus'	=> $this -> input -> post('grpedit-status'),
						'GroupMenuOrder'	=> $this -> input -> post('grpedit-urut')
					);
			
			if( array('status' => true) ) {
				$this -> M_Groupmenu -> updateGroupMenu($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Grup Menu Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Grup Menu Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function deleteGroupMenu()
		{
			$result = array('status' => false);
			
			$id = array('GroupMenuId' => $this -> input -> post('grpedit-id'));
			
			$Data = array(
						'GroupMenuDelete'	=> 1
					);
			
			if( array('status' => true) ) {
				$this -> M_Groupmenu -> deleteGroupMenu($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Grup Menu Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Grup Menu Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>