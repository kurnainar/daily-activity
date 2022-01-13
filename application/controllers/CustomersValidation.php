<?php

	Class CustomersValidation Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_CustomersValidation','M_Order'));
			if($this -> session -> userdata('LoginStat') == false){
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$grup = $this -> session -> userdata('Groups');
			$userid = $this -> session -> userdata('Kode');
			$Data = array(
						'List'	=>	$this -> M_CustomersValidation -> getListCustomers($userid, $grup)
					);
			// $this -> template -> set('title', 'Daftar Customers Validation');
			// $this -> template -> load('default', 'contents' , 'cst-validation/cst-validation-list', $Data);
			$this -> load -> view('cst-validation/cst-validation-list', $Data);
		}
	}

?>