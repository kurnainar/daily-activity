<?php

	Class Template
	{
		Private $CI;
		Var $template_data = array();
		
		Public Function __Construct() 
		{
			$this -> CI =& get_instance();
		}
		
		Public Function set($content_area, $value)
		{
			$this -> template_data[$content_area] = $value;
		}
		
		Public Function load($template = '', $name ='', $view = '' , $view_data = array(), $return = FALSE)
		{
			$this -> set($name , $this->CI->load->view($view, $view_data, TRUE));		   
			$this -> CI -> load ->view('layout/'.$template, $this->template_data);
		}  
	}

?>