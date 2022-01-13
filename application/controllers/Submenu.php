<?php

	Class Submenu Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_Submenu'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('submenu/submenu-list');
		}
		
		Public Function listTable()
		{
			$Data = $this -> M_Submenu -> getListData();
			echo json_encode($Data);
		}
		
		Public Function formAdd()
		{
			$this -> load -> view('submenu/submenu-add');
		}
		
		Public Function formEdit()
		{
			$this -> load -> view('submenu/submenu-edit');
		}
		
		Public Function saveSubMenu()
		{
			$result = array('status' => false);
			
			$cekNavigasi = $this -> M_Submenu -> getController($this -> input -> post('subadd-nav'));
			
			$Data = array(
						'SubMenuName'	=> ucwords($this -> input -> post('subadd-nama')),
						'Controller'	=> $this -> input -> post('subadd-nav'),
						'SubMenuStatus'	=> $this -> input -> post('subadd-status')
					);
					
			if( empty($cekNavigasi) ) {
				if( array('status' => true) ) {
					$this -> M_Submenu -> saveSubMenu($Data);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Sub Menu Berhasil Ditambahkan', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Sub Menu Gagal Ditambahkan', 'type' => 'warning');
				}
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Navigasi Sub Menu Sudah Ada', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function getSubMenu($id)
		{
			$Data = $this -> M_Submenu -> getSubMenu($id);
			echo json_encode($Data);
		}
		
		Public Function updateSubMenu()
		{
			$result = array('status' => false);
			
			$id = array('SubMenuId' => $this -> input -> post('subedit-id'));
			
			$Data = array(
						'SubMenuName'	=> ucwords($this -> input -> post('subedit-nama')),
						'SubMenuStatus'	=> $this -> input -> post('subedit-status'),
						'Controller'	=> $this -> input -> post('subedit-nav')
					);
			
			if( array('status' => true) ) {
				$this -> M_Submenu -> updateSubMenu($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Sub Menu Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Sub Menu Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function deleteSubMenu()
		{
			$result = array('status' => false);
			
			$id = array('SubMenuId' => $this -> input -> post('subedit-id'));
			
			$Data = array(
						'SubMenuDelete'	=> 1
					);
			
			if( array('status' => true) ) {
				$this -> M_Submenu -> deleteSubMenu($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Sub Menu Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Sub Menu Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>