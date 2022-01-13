<?php

	Class Testing Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
		}
		
		Public Function Index()
		{
			$this -> load -> view('testing');
		}
	}

?>