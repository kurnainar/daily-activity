<?php

	Class Themes Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
		}
		
		Public Function Index()
		{
			$Data = array(
							'List' => ''
						);
			$this -> template -> set('title', 'Daftar Tema');
			$this -> template -> load('default', 'contents' , 'themes/themes-list', $Data);
		}
		
		Public Function formAdd()
		{
			if($this -> session -> userdata('LoginStat')) {
				$this -> load -> view('themes/themes-add');
			}
		}
	}

?>