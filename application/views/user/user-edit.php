<div class="modal fade" id="user-edit">
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
						<form id="frmUserEdit">
							<input type="hidden" id="useredit-id" name="useredit-id">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useredit-username">ID Pengguna:</label>
										<input type="text" class="form-control" id="useredit-username" name="useredit-username" maxlength="7" readonly>
										<small>*Info: Maksimal 7 Karakter</small>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group">
										<label for="useredit-nama">Nama Lengkap:</label>
										<input type="text" class="form-control" id="useredit-nama" name="useredit-nama" maxlength="50" autofocus>
										<small>*Info: Maksimal 50 Karakter</small>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useredit-dept">Nama Departemen:</label>
										<select class="form-control" id="useredit-dept" name="useredit-dept">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Department as $data => $rows) : ?>
											<option value = "<?php echo $rows['DepartmentId']; ?>"><?php echo $rows['DepartmentName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="useredit-hak">Hak Akses Pengguna:</label>
										<select class="form-control" id="useredit-hak" name="useredit-hak">
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
					<button type="button" class="btn btn-success" id="btn-ubah-user"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-user"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-user"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('user/user-js'); ?>