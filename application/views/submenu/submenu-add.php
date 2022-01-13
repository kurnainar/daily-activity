<div class="modal fade" id="submenu-add">
	<div class="modal-dialog modal-lg" style="width:95%;">
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
						<form id="frmSubMenuAdd">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="subadd-nama">Nama Sub Menu:</label>
										<input type="text" class="form-control" id="subadd-nama" name="subadd-nama" autofocus>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="subadd-status">Status Grup:</label>
										<select class="form-control" id="subadd-status" name="subadd-status">
											<option value = "">--- Pilih ---</option>
											<option value = "1" selected>Aktif</option>
											<option value = "0">Non-Aktif</option>
										</select>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="subadd-nav">Navigasi:</label>
										<input type="text" class="form-control" id="subadd-nav" name="subadd-nav">
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
					<button type="button" class="btn btn-success" id="btn-simpan-sub"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-sub"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('submenu/submenu-js'); ?>