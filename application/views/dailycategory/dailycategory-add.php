<div class="modal fade" id="daily-add">
	<div class="modal-dialog modal-lg" style="width:60%;">
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
						<form id="frmDailyAdd">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label for="dailyadd-jenis">Jenis Kategori Harian:</label>
										<input type="text" class="form-control" id="dailyadd-jenis" name="dailyadd-jenis" autofocus>
									</div>
								</div>
								
								<div class="col-sm-7">
									<div class="form-group">
										<label for="dailyadd-desc">Deskripsi Kategori Harian:</label>
										<textarea class="form-control" id="dailyadd-desc" name="dailyadd-desc" rows="4"></textarea>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="dailyadd-skor">Skor:</label>
										<input type="number" class="form-control" id="dailyadd-skor" name="dailyadd-skor">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-simpan-daily"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-daily"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('dailycategory/dailycategory-js'); ?>