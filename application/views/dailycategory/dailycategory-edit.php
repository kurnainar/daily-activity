<div class="modal fade" id="daily-edit">
	<div class="modal-dialog modal-lg" style="width:95%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="glyphicon glyphicon-plus-sign"></span>
					&nbsp;Ubah
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="frmDailyEdit">
							<input type="hidden" id="dailyedit-id" name="dailyedit-id">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label for="dailyedit-jenis">Jenis Kategori Harian:</label>
										<input type="text" class="form-control" id="dailyedit-jenis" name="dailyedit-jenis" autofocus>
									</div>
								</div>
								
								<div class="col-sm-7">
									<div class="form-group">
										<label for="dailyedit-desc">Deskripsi Kategori Harian:</label>
										<textarea class="form-control" id="dailyedit-desc" name="dailyedit-desc" rows="4"></textarea>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="dailyedit-skor">Skor:</label>
										<input type="number" class="form-control" id="dailyedit-skor" name="dailyedit-skor">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-ubah-daily"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-daily"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-daily" data-dismiss="modal"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('dailycategory/dailycategory-js'); ?>