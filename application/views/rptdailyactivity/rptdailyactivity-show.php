<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/image/core/logo-elang.png" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<style>
			th {
				text-align: center;
			}
			
			.tengah {
				text-align: center;
			}
			
			.kanan {
				text-align: right;
			}
			
			.desc {
				width: 5%;
			}
			
			table, th, td {
				border-style: solid;
				border-width: 1px;
			}
			
			td {
				vertical-align: top;
			}
			
			p {
				margin-top: 20px;
				margin-bottom: 20px;
			}
		</style>
		<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<title>Report - Daily Activity</title>
	</head>
	<body>
		<div class="container-fluid">
			<!-- header -->
			<h2 align="center">Report - Daily Activity</h2>
			<p style="font-size: 13px;">
				<b>Tanggal Generate:</b> <?php echo date('Y-m-d'); ?><br/>
				<b>Tanggal Interval: </b> <?php echo base64_decode($_GET['start']); ?> s/d <?php echo base64_decode($_GET['end']); ?>
			</p>
			
			<!-- body -->
			<table class="table table-bordered" style="font-size: 13px;">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>Shift</th>
						<th>Kegiatan</th>
						<th>Nama</th>
						<th>Uraian Kegiatan</th>
						<th>Status</th>
						<th>Skor</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						if(!empty($Data)) :
							foreach($Data as $val => $rows) :
					?>
								<tr>
									<td class="tengah"><?php echo $no; ?></td>
									<td class="tengah"><?php echo $rows['DailyActivityDate']; ?></td>
									<td class="tengah"><?php echo $rows['ShiftName']; ?></td>
									<td><?php echo $rows['DailyCategoryName']; ?></td>
									<td><?php echo $rows['DailyActivityUserId']; ?></td>
									<td><?php echo $rows['DailyActivityDesc']; ?></td>
									<td class="tengah"><?php echo $rows['DailyActivityStatus']; ?></td>
									<td class="tengah"><?php echo $rows['DailyCategoryScores']; ?></td>
								</tr>
					<?php
							$no++;
							endforeach;
						else :
					?>
							<tr>
								<td colspan=8 class="tengah">Data tidak tersedia</td>
							</tr>
					<?php
						endif;
					?>
					
					
				</tbody>
			</table>
		</div>
	</body>
</html>