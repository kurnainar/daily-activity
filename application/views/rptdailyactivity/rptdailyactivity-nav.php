<form id="RptDailyActivity">
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label for="tgl-awal">Tanggal Awal:</label>
				<input type="date" class="form-control" id="tgl-awal" name="tgl-awal" placeholder="Masukkan Tanggal Awal" style="cursor:pointer;">
			</div>	
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label for="tgl-akhir">Tanggal Akhir:</label>
				<input type="date" class="form-control" id="tgl-akhir" name="tgl-akhir" placeholder="Masukkan Tanggal Akhir" style="cursor:pointer;">
			</div>	
		</div>
	</div>
	
	<div id="progress">
		<button type="button" class="btn" id="btn-export-rda"><i class="fa fa-print"></i> Export </button>
	</div>
</form>

<?php $this -> load -> view('rptdailyactivity/rptdailyactivity-js'); ?>