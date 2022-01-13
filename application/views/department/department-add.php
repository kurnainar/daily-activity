<div class="modal fade" id="department-add">
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
						<form id="frmDepartmentAdd">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="deptadd-nama">Nama Departemen:</label>
										<input type="text" class="form-control" id="deptadd-nama" name="deptadd-nama" autofocus>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-simpan-dept"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-dept"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('department/department-js'); ?>