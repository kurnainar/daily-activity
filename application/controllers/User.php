<?php

	Class User Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_User','M_Combo'));
		}
		
		Public Function Index()
		{
			if($this -> session -> userdata('LoginStat')) {
				$this -> load -> view('user/user-list');
			}
		}
		
		Public Function listTable()
		{
			if($this -> session -> userdata('LoginStat')) {
				$Data = $this -> M_User -> getListData();
				echo json_encode($Data);
			}
		}
		
		Public Function formAdd()
		{
			if($this -> session -> userdata('LoginStat')) {
				$Data = array(
							'Department'	=> $this -> M_Combo -> Department(),
							'Usergroup'		=> $this -> M_Combo -> Usergroup()
						);
				$this -> load -> view('user/user-add', $Data);
			}
		}
		
		Public Function formEdit()
		{
			if($this -> session -> userdata('LoginStat')) {
				$Data = array(
							'Department'	=> $this -> M_Combo -> Department(),
							'Usergroup'		=> $this -> M_Combo -> Usergroup()
						);
				$this -> load -> view('user/user-edit', $Data);
			}
		}
		
		Public Function saveUser()
		{
			if($this -> session -> userdata('LoginStat')) {
				$result = array('status' => false);
				
				$username	= $this -> input -> post('useradd-username');
				
				$cekAvailable = $this -> M_User -> getAvailable($username);
				
				$Data = array(
							'UserFullName'	=> ucwords($this -> input -> post('useradd-nama')),
							'Username'		=> $this -> input -> post('useradd-username'),
							'Password'		=> password_hash("metrotv", PASSWORD_DEFAULT),
							'UserGroupId'	=> $this -> input -> post('useradd-hak'),
							'DepartmentId'	=> $this -> input -> post('useradd-dept')
						);
						
				if( empty($cekAvailable) ) {
					if( array('status' => true) ) {
						$this -> M_User -> saveUser($Data);
						$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pengguna Berhasil Ditambahkan', 'type' => 'success');
					} else {
						$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pengguna Gagal Ditambahkan', 'type' => 'warning');
					}
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'ID Pengguna Sudah Ada', 'type' => 'warning');
				}
				
				echo json_encode($result);
			}
		}
		
		Public Function getUser($id)
		{
			if($this -> session -> userdata('LoginStat')) {
				$Data = $this -> M_User -> getUser($id);
				echo json_encode($Data);
			}
		}
		
		Public Function updateUser()
		{
			if($this -> session -> userdata('LoginStat')) {
				$result = array('status' => false);
				
				$username	= $this -> input -> post('useredit-username');
				
				$cekAvailable = $this -> M_User -> getAvailable($username);
				
				$id = array('UserId' => $this -> input -> post('useredit-id'));
				
				$Data = array(
							'UserFullName'	=> ucwords($this -> input -> post('useredit-nama')),
							'Username'		=> $this -> input -> post('useredit-username'),
							'UserGroupId'	=> $this -> input -> post('useredit-hak'),
							'DepartmentId'	=> $this -> input -> post('useredit-dept')
						);
				
				if( array('status' => true) ) {
					$this -> M_User -> updateUser($Data, $id);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pengguna Berhasil Diubah', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pengguna Gagal Diubah', 'type' => 'warning');
				}
				
				echo json_encode($result);
			}
		}
		
		Public Function deleteUser()
		{
			if($this -> session -> userdata('LoginStat')) {
				$result = array('status' => false);
				
				$id = $this -> input -> post('useredit-id');
				
				if( array('status' => true) ) {
					$this -> M_User -> deleteUser($id);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Pengguna Berhasil Dihapus', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Pengguna Gagal Dihapus', 'type' => 'warning');
				}
				
				echo json_encode($result);
			}
		}
		
		Public Function Login()
		{
			$this -> load -> view('user/user-main');
		}
		
		Public Function Authentication()
		{
			$result = array('status' => 0);
			
			$username	= $this -> input -> post('login-kode');
			$password	= $this -> input -> post('login-pass');
			
			$Data = array(
						'Username'		=> $username,
						'ActivityName'	=> 'LOGIN'
					);
			
			$cekAvailable	= $this -> M_User -> cekAvailable($username);
			$passHash		= $cekAvailable -> Password;
			$Login			= $cekAvailable -> Password;
			
			if( password_verify($password, $passHash) ) {
				$data_session = array(
									'UserId'	=> $cekAvailable -> UserId,
									'Username'	=> $cekAvailable -> Username,
									'Nama'		=> $cekAvailable -> UserFullName,
									'Group'		=> $cekAvailable -> UserGroupId,
									'LoginStat'	=> true
								);
				$this -> session -> set_userdata($data_session);
				
				if( array('status' => true) ) {
					$this -> M_User -> saveActivityLogin($Data);
					$result = array('status' => true);
				} else {
					$result = array('status' => 0);
				}
			} else {
				$result = array('status' => 0);
			}
			
			echo json_encode($result);
		}
		
		Public Function formChangePassword()
		{
			if($this -> session -> userdata('LoginStat')) {
				$this -> load -> view('user/user-ubahpass');
			}
		}
		
		Public Function changePassword()
		{
			if($this -> session -> userdata('LoginStat')) {
				$result = array('status' => false);
				
				$id = array('Username' => $this -> input -> post('chpass-username'));
				
				$Data = array(
							'Password'	=> password_hash($this -> input -> post('chpass-password'), PASSWORD_DEFAULT)
						);
				
				if( array('status' => true) ) {
					$this -> M_User -> changePassword($Data, $id);
					$result = array('status' => true, 'title' => 'Selamat!', 'text' => 'Kata Sandi Berhasil Diubah', 'type' => 'success');
				} else {
					$result = array('status' => false, 'title' => 'Maaf!', 'text' => 'Kata Sandi Gagal Diubah', 'type' => 'warning');
				}
				
				echo json_encode($result);
			}
		}
		
		Public Function Logout()
		{
			if($this -> session -> userdata('LoginStat')) {
				$username = $this -> session -> userdata('Username');
				
				$Data = array(
						'Username'		=> $username,
						'ActivityName'	=> 'LOGOUT'
					);
				
				$this -> session -> sess_destroy();
				$this -> M_User -> saveActivityLogout($Data);
				redirect(base_url('user/login?sess(false)'));
			}
		}
	}

?>