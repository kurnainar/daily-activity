<div class="modal fade" id="assignmenu-edit">
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
						<form id="frmAssignMenuEdit">
							<input type="hidden" id="assignedit-id" name="assignedit-id">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignedit-grup">Grup Menu:</label>
										<select class="form-control" id="assignedit-grup" name="assignedit-grup">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Groupmenu as $data => $rows) : ?>
											<option value = "<?php echo $rows['GroupMenuId']; ?>"><?php echo $rows['GroupMenuName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignedit-sub">Sub Menu:</label>
										<select class="form-control" id="assignedit-sub" name="assignedit-sub">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Submenu as $data => $rows) : ?>
											<option value = "<?php echo $rows['SubMenuId']; ?>"><?php echo $rows['SubMenuName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignedit-hak">Hak Akses Menu:</label>
										<select class="form-control" id="assignedit-hak" name="assignedit-hak">
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
					<button type="button" class="btn btn-success" id="btn-ubah-assign"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-assign"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-assign"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	function validator()
	{
		var form = {
				Grup	: document.getElementById("assignedit-grup").value,
				Sub		: document.getElementById("assignedit-sub").value,
				Hak		: document.getElementById("assignedit-hak").value,
			}
		
		if(form['Grup'] == "") {
			swal("Maaf!", "Grup Menu tidak boleh kosong!", "warning");
		} else if(form['Sub'] == "") {
			swal("Maaf!", "Sub Menu tidak boleh kosong!", "warning");
		} else if(form['Hak'] == "") {
			swal("Maaf!", "Hak Akses Menu tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('AssignMenu/updateAssignMenu')?>",
			type: "POST",
			data: $('#frmAssignMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-assign').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-assign").setAttribute("disabled","disabled");
					$('#btn-ubah-assign').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-assign').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('AssignMenu/deleteAssignMenu')?>",
			type: "POST",
			data: $('#frmAssignMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-assign').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-assign").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-assign").setAttribute("disabled","disabled");
					$('#btn-hapus-assign').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-assign').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		$("form").attr('autocomplete', 'off');
		
		$('button#btn-keluar-assign').on('click', function () {
			location.reload();
		});
		
		$('button#btn-ubah-assign').on('click', function () {
			validator();
		});
		
		$('button#btn-hapus-assign').on('click', function () {
			hapus();
		});
	});


</script>