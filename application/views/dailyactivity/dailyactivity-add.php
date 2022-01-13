<div class="modal fade" id="activity-add">
	<div class="modal-dialog modal-lg" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="glyphicon glyphicon-plus-sign"></span>
					&nbsp;Tambah
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="frmActivityAdd">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="actadd-jenis">Tanggal Aktivitas:</label>
										<input type="date" class="form-control" id="actadd-tgl" name="actadd-tgl" autofocus>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="actadd-shift">Shift:</label>
										<select class="form-control" id="actadd-shift" name="actadd-shift">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Shift as $Data => $Rows): ?>
											<option value = "<?php echo $Rows['ShiftId']; ?>"><?php echo $Rows['ShiftName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="actadd-jenis">Jenis Kegiatan:</label>
										<select class="form-control" id="actadd-jenis" name="actadd-jenis">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Kategori as $Data => $Rows): ?>
											<option value = "<?php echo $Rows['DailyCategoryId']; ?>"><?php echo $Rows['DailyCategoryName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label for="actadd-desc">Deskripsi Kategori Harian:</label>
										<textarea class="form-control" id="actadd-desc" name="actadd-desc" rows="4"></textarea>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="actadd-status">Status Kegiatan:</label>
										<select class="form-control" id="actadd-status" name="actadd-status">
											<option value = "">--- Pilih ---</option>
											<option value = "1" selected>Ok</option>
											<option value = "2">Berlanjut</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-simpan-activity"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-activity"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('dailyactivity/dailyactivity-js'); ?>