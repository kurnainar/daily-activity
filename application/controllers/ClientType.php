<?php

	Class ClientType Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_ClientType'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('clienttype/clienttype-list');
		}
		
		Public Function listTable()
		{
			$Data = $this -> M_ClientType -> getListData();
			echo json_encode($Data);
		}
		
		Public Function formEdit()
		{
			$this -> load -> view('clienttype/clienttype-edit');
		}
		
		Public Function getClientType($id)
		{
			$Data = $this -> M_ClientType -> getClientType($id);
			echo json_encode($Data);
		}
		
		Public Function updateClientType()
		{
			$result = array('status' => false);
			
			$id = array('ClientTypeId' => $this -> input -> post('cltpedit-id'));
			
			$Data = array(
						'ClientTypeName'		=> ucwords($this -> input -> post('cltpedit-nama'))
					);
			
			if( array('status' => true) ) {
				$this -> M_ClientType -> updateClientType($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Tipe Klien Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Tipe Klien Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function formAdd()
		{
			$this -> load -> view('clienttype/clienttype-add');
		}
		
		Public Function saveClientType()
		{
			$result = array('status' => false);
			
			$Data = array(
						'ClientTypeName'		=> ucwords($this -> input -> post('cltpadd-nama'))
					);
					
			// if( empty($Urutan) ) {
				if( array('status' => true) ) {
					$this -> M_ClientType -> saveClientType($Data);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Tipe Klien Berhasil Ditambahkan', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Tipe Klien Gagal Ditambahkan', 'type' => 'warning');
				}
			// } else {
				// $result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Urutan Grup Menu Sudah Ada', 'type' => 'warning');
			// }
			
			echo json_encode($result);
		}
		
		Public Function deleteClientType()
		{
			$result = array('status' => false);
			
			$id = array('ClientTypeId' => $this -> input -> post('cltpedit-id'));
			
			if( array('status' => true) ) {
				$this -> M_ClientType -> deleteClientType($id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Tipe Klien Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Tipe Klien Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>