<?php

	Class Department Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_Department'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('department/department-list');
		}
		
		Public Function listTable()
		{
			$Data = $this -> M_Department -> getListData();
			echo json_encode($Data);
		}
		
		Public Function formAdd()
		{
			$this -> load -> view('department/department-add');
		}
		
		Public Function saveDepartment()
		{
			$result = array('status' => false);
			
			$Data = array(
						'DepartmentName'	=> strtoupper($this -> input -> post('deptadd-nama'))
					);
					
			if( array('status' => true) ) {
				$this -> M_Department -> saveDepartment($Data);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Departemen Berhasil Ditambahkan', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Departemen Gagal Ditambahkan', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function formEdit()
		{
			$this -> load -> view('department/department-edit');
		}
		
		Public Function getDepartment($id)
		{
			$Data = $this -> M_Department -> getDepartment($id);
			echo json_encode($Data);
		}
		
		Public Function updateDepartment()
		{
			$result = array('status' => false);
			
			$id = array('DepartmentId' => $this -> input -> post('deptedit-id'));
			
			$Data = array(
						'DepartmentName'	=> strtoupper($this -> input -> post('deptedit-nama'))
					);
			
			if( array('status' => true) ) {
				$this -> M_Department -> updateDepartment($Data, $id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Departemen Berhasil Diubah', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Departemen Gagal Diubah', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
		
		Public Function deleteDepartment()
		{
			$result = array('status' => false);
			
			$id = array('DepartmentId' => $this -> input -> post('deptedit-id'));
			
			if( array('status' => true) ) {
				$this -> M_Department -> deleteDepartment($id);
				$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Departemen Berhasil Dihapus', 'type' => 'success');
			} else {
				$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Departemen Gagal Dihapus', 'type' => 'warning');
			}
			
			echo json_encode($result);
		}
	}

?>