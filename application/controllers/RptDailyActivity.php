<?php

	Class RptDailyActivity Extends CI_Controller
	{
		Public Function __Construct()
		{
			Parent::__Construct();
			$this -> load -> model(array('M_RptDailyActivity'));
			if($this -> session -> userdata('LoginStat') != true) {
				redirect(base_url("user/login"));
			}
		}
		
		Public Function Index()
		{
			$this -> load -> view('rptdailyactivity/rptdailyactivity-nav');
		}
		
		Public Function getExport()
		{
			$start	= base64_decode($_REQUEST['start']);
			$end	= base64_decode($_REQUEST['end']);
			
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=daily-activity-".$start."-sd-".$end.".xls");//ganti nama sesuai keperluan
			header("Pragma: no-cache");
			header("Expires: 0");
			
			$Data = array(
						'Data' => $this -> M_RptDailyActivity -> getExport($start, $end)
					);
			$this -> load -> view('rptdailyactivity/rptdailyactivity-show', $Data);
		}
	}

?>