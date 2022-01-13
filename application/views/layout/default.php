<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Daily Activity System</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/image/core/logo-elang.png" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets//plugins/timepicker/bootstrap-timepicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatable/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/fixedHeader.dataTables.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-black-light.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert/css/sweet-alert.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
		
		<style>
			th {
				text-align: center;
			}
			
			.text {
				text-align: left;
			}
			
			.tengah {
				text-align: center;
			}
			
			.kanan {
				text-align: right;
			}
			
			.kiri {
				text-align: left;
			}
			
			.cls-button {
				text-align: center;
			}
			thead input {
				width: 100%;
			}
			
			table {
				width: 100%;
			}
			
			a {
				cursor: pointer;
			}
		</style>
		
		<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/jquery-ui/jquery-ui.js"></script>
		<script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script>
		<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/datatable/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/dt-export/jszip.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/datatables-btn/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.fixedHeader.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
		<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
		<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweet-alert.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/moment/moment.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
	</head>
	<body class="hold-transition skin-black-light sidebar-mini">
		<div class="wrapper">

			<header class="main-header">
				<a href="#" class="logo">
					<span class="logo-mini">
						<img src="<?php echo base_url();?>assets/image/core/logo-elang.png" height="38">
					</span>
					<span class="logo-lg">
						<img src="<?php echo base_url();?>assets/image/core/logo-metrotv-crop.png" height="40">
					</span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="user user-menu">
								<a href="#">
									<strong>
										<span class="hidden-xs">
											<?php echo $this -> session -> userdata('Nama') ?>
										</span>
									</strong>
								</a>
							</li>
						</ul>
					</div>
					
				</nav>
			</header>
			
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">MENU</li>
						<li><a href="<?php echo site_url('beranda?sess(true)'); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
						
						<?php
							$group = $this -> M_AssignMenu -> loopGroup();

							if(!empty($group)) {
								foreach($group as $data => $gm) {
						?>
									<li class="treeview">
										<a href="#">
											<i class="fa fa-navicon"></i>
											<span><?php echo $gm['GroupMenuName']; ?></span>
											<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
										<?php
											$sub = $this -> M_AssignMenu -> loopSub();
											if(!empty($sub)) {
												foreach($sub[$data] as $val => $sm) {
										?>
													<li><a id="controller" data-id="<?php echo $sm['Controller']; ?>"><i class="fa fa-arrow-circle-right"></i> <?php echo $sm['SubMenuName']; ?> </a></li>
										<?php
												}
											}
										?>
											
										</ul>
									</li>
						<?php
								}
							}
						?>

						<li class="treeview">
							<a>
								<i class="fa fa-navicon"></i>
								<span>Sistem</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a data-id="user/formChangePassword" id="controller" data-id="user/formChangePassword"><i class="fa fa-arrow-circle-right"></i> Ubah Kata Sandi </a></li>
								<li><a href="<?php echo site_url('user/logout'); ?>"><i class="fa fa-arrow-circle-right"></i> Keluar </a></li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>

			<div class="content-wrapper">
				<section class="content-header" id="judul">
					<h1>
						<div id="loadHeader"></div>
					</h1>
				</section>
				
				<section class="content">
					<div id="loadHome">
						<?php $this -> load -> view('home/index'); ?>
					</div>
					<div class="panel panel-default" id="panel">
						<div class="panel-body">
							<div id="loadContent"></div>
						</div>
					</div>
				</section>
			</div>
			
			<footer class="main-footer">
				<strong>Copyright © 2019 <a href="https://www.metrotvnews.com/">Metrotvnews.</a> All Rights Reserved</strong>
			</footer>

		</div>

		<script>
		
			function header(controller)
			{
				$.ajax({
					url : "<?php echo site_url('AssignMenu/getMenuName')?>/" + controller,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						if(data) {
							document.getElementById("loadHeader").innerHTML = data.SubMenuName;
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						console.log('Something Wrong!');
					}
				});
			}
			
			$(document).ready(function(){
				$("#panel").removeAttr("panel").hide();
				
				$('a#controller').on('click').on('click',function(){
					var id = $(this).attr('data-id');
					
					if(id) {
						$("#panel").removeAttr("panel").show();
						$('#loadHome').html('');
						header(id);
						$("#loadContent").load(id);
					} else {
						$("#panel").removeAttr("panel").hide();
					}
				});
			});
		
		</script>
		
	</body>
</html>
