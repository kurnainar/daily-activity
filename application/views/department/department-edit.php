<div class="modal fade" id="department-edit">
	<div class="modal-dialog modal-lg" style="width:60%;">
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
						<form id="frmDepartmentEdit">
							<input type="hidden" id="deptedit-id" name="deptedit-id">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="deptedit-nama">Jenis Package:</label>
										<input type="text" class="form-control" id="deptedit-nama" name="deptedit-nama" autofocus>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-ubah-dept"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-dept"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-dept"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('department/department-js'); ?>