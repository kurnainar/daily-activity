<div class="modal fade" id="groupmenu-add">
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
						<form id="frmGroupMenuAdd">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="grpadd-nama">Nama Grup Menu:</label>
										<input type="text" class="form-control" id="grpadd-nama" name="grpadd-nama" autofocus>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="grpadd-status">Status Grup Menu:</label>
										<select class="form-control" id="grpadd-status" name="grpadd-status">
											<option value = "">--- Pilih ---</option>
											<option value = "1" selected>Aktif</option>
											<option value = "0">Non-Aktif</option>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="grpadd-urut">Urutan Grup Menu:</label>
										<select class="form-control" id="grpadd-urut" name="grpadd-urut">
											<option value = "">--- Pilih ---</option>
											<?php for($awal=1; $awal<=15; $awal++) : ?>
											<option value = "<?php echo $awal; ?>"><?php echo $awal; ?></option>
											<?php endfor; ?>
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
					<button type="button" class="btn btn-success" id="btn-simpan-grp"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-grp"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('groupmenu/groupmenu-js'); ?>