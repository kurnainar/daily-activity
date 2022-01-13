<div class="modal fade" id="user-add">
	<div class="modal-dialog modal-lg" style="width:75%;">
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
						<form id="frmUserAdd">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useradd-username">ID Pengguna:</label>
										<input type="text" class="form-control" id="useradd-username" name="useradd-username" maxlength="7" autofocus>
										<small>*Info: Maksimal 7 Karakter</small>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group">
										<label for="useradd-nama">Nama Lengkap:</label>
										<input type="text" class="form-control" id="useradd-nama" name="useradd-nama" maxlength="50">
										<small>*Info: Maksimal 50 Karakter</small>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useradd-dept">Nama Departemen:</label>
										<select class="form-control" id="useradd-dept" name="useradd-dept">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Department as $data => $rows) : ?>
											<option value = "<?php echo $rows['DepartmentId']; ?>"><?php echo $rows['DepartmentName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useradd-hak">Hak Akses Pengguna:</label>
										<select class="form-control" id="useradd-hak" name="useradd-hak">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Usergroup as $data => $rows) : ?>
											<option value = "<?php echo $rows['UserGroupId']; ?>"><?php echo $rows['UserGroupName']; ?></option>
											<?php endforeach; ?>
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
					<button type="button" class="btn btn-success" id="btn-simpan-user"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-user"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('user/user-js'); ?>