<?php

	Class Beranda Extends CI_Controller
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
			$this -> template -> load('default', 'contents' , 'home/index');
		}
	}

?>