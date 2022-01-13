<?php

	Class Brand Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('brand/brand-list');
		}
	}

?>