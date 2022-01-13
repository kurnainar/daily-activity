<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('Provinsi'))
	{
		function Provinsi()
		{
			$this -> db -> select("ProvinsiId, ProvinsiName");
			$this -> db -> from("m_provinsi");
			$this -> db -> order_by("ProvinsiId", "ASC");
			$query = $this -> db -> get();

			return $query -> row();
		}
	}

?>