<?php

	Class AssignMenu Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_AssignMenu','M_Combo'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$Data = array(
						'List' => $this -> M_AssignMenu -> getListData()
					);
			$this -> load -> view('assignmenu/assignmenu-list', $Data);
		}
		
		Public Function formAdd()
		{
			$Data = array(
						'Groupmenu'	=> $this -> M_Combo -> Groupmenu(),
						'Submenu'	=> $this -> M_Combo -> Submenu(),
						'Usergroup'	=> $this -> M_Combo -> Usergroup()
					);
			$this -> load -> view('assignmenu/assignmenu-add', $Data);
		}
		
		Public Function formEdit()
		{
			$Data = array(
						'Groupmenu'	=> $this -> M_Combo -> Groupmenu(),
						'Submenu'		=> $this -> M_Combo -> Submenu(),
						'Usergroup'		=> $this -> M_Combo -> Usergroup()
					);
			$this -> load -> view('assignmenu/assignmenu-edit', $Data);
		}
		
		Public Function saveAssignMenu()
		{
			$result = array('status' => false);
			
			$grup		= $this -> input -> post('assignadd-grup');
			$sub		= $this -> input -> post('assignadd-sub');
			$hakakses	= $this -> input -> post('assignadd-hak');
			
			$cekAvailable = $this -> M_AssignMenu -> getAvailable($grup, $sub, $hakakses);
			
			$Data = array(
						'GroupMenuId'	=> $this -> input -> post('assignadd-grup'),
						'SubMenuId'		=> $this -> input -> post('assignadd-sub'),
						'UserGroupId'	=> $this -> input -> post('assignadd-hak'),
						'CreatedBy'		=> $this -> session -> userdata('Username')
					);
					
			if( empty($cekAvailable) ) {
				if( array('status' => true) ) {
					$this -> M_AssignMenu -> saveAssignMenu($Data);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pembagian Menu Berhasil', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pembagian Menu Gagal', 'type' => 'warning');
				}
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pembagian Menu Sudah Ada', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function getAssignMenu($id)
		{
			$Data = $this -> M_AssignMenu -> getAssignMenu($id);
			echo json_encode($Data);
		}
		
		Public Function getMenuName($id)
		{
			$Data = $this -> M_AssignMenu -> getMenuName($id);
			echo json_encode($Data);
		}
		
		Public Function updateAssignMenu()
		{
			$result = array('status' => false);
			
			$grup		= $this -> input -> post('assignedit-grup');
			$sub		= $this -> input -> post('assignedit-sub');
			$hakakses	= $this -> input -> post('assignedit-hak');
			
			$cekAvailable = $this -> M_AssignMenu -> getAvailable($grup, $sub, $hakakses);
			
			$id = array('AssignMenuId' => $this -> input -> post('assignedit-id'));
			
			$Data = array(
						'GroupMenuId'	=> $this -> input -> post('assignedit-grup'),
						'SubMenuId'		=> $this -> input -> post('assignedit-sub'),
						'UserGroupId'	=> $this -> input -> post('assignedit-hak')
					);
			
			if( empty($cekAvailable) ) {
				if( array('status' => true) ) {
					$this -> M_AssignMenu -> updateAssignMenu($Data, $id);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pembagian Menu Berhasil Diubah', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pembagian Menu Gagal Diubah', 'type' => 'warning');
				}
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pembagian Menu Sudah Ada', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function deleteAssignMenu()
		{
			$result = array('status' => false);
			
			$id = $this -> input -> post('assignedit-id');
			
			if( array('status' => true) ) {
				$this -> M_AssignMenu -> deleteAssignMenu($id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pembagian Menu Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pembagian Menu Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>