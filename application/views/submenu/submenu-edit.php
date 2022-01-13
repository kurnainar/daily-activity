<div class="modal fade" id="submenu-edit">
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
						<form id="frmSubMenuEdit">
							<input type="hidden" id="subedit-id" name="subedit-id">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="subedit-nama">Nama Sub Menu:</label>
										<input type="text" class="form-control" id="subedit-nama" name="subedit-nama" autofocus>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="subedit-status">Status Grup:</label>
										<select class="form-control" id="subedit-status" name="subedit-status">
											<option value = "">--- Pilih ---</option>
											<option value = "1" selected>Aktif</option>
											<option value = "0">Non-Aktif</option>
										</select>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="subedit-nav">Navigasi:</label>
										<input type="text" class="form-control" id="subedit-nav" name="subedit-nav">
										<small>*Info: Tambahkan method apabila diperlukan</small>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-ubah-sub"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-sub"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-sub"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('submenu/submenu-js'); ?>