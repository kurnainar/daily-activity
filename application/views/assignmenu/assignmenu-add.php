<div class="modal fade" id="assignmenu-add">
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
						<form id="frmAssignMenuAdd">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignadd-grup">Grup Menu:</label>
										<select class="form-control" id="assignadd-grup" name="assignadd-grup">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Groupmenu as $data => $rows) : ?>
											<option value = "<?php echo $rows['GroupMenuId']; ?>"><?php echo $rows['GroupMenuName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignadd-sub">Sub Menu:</label>
										<select class="form-control" id="assignadd-sub" name="assignadd-sub">
											<option value = "">--- Pilih ---</option>
											<?php foreach($Submenu as $data => $rows) : ?>
											<option value = "<?php echo $rows['SubMenuId']; ?>"><?php echo $rows['SubMenuName']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="assignadd-hak">Hak Akses Menu:</label>
										<select class="form-control" id="assignadd-hak" name="assignadd-hak">
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
					<button type="button" class="btn btn-success" id="btn-simpan-assign"><i class="fa fa-save"></i> Simpan </button>
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
				Grup	: document.getElementById("assignadd-grup").value,
				Sub		: document.getElementById("assignadd-sub").value,
				Hak		: document.getElementById("assignadd-hak").value,
			}
		
		if(form['Grup'] == "") {
			swal("Maaf!", "Grup Menu tidak boleh kosong!", "warning");
		} else if(form['Sub'] == "") {
			swal("Maaf!", "Sub Menu tidak boleh kosong!", "warning");
		} else if(form['Hak'] == "") {
			swal("Maaf!", "Hak Akses Menu tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('AssignMenu/saveAssignMenu')?>",
			type: "POST",
			data: $('#frmAssignMenuAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-assign').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-assign").setAttribute("disabled","disabled");
					$('#btn-simpan-assign').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-assign').html("<i class='fa fa-save'></i> Simpan");
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
		
		$('button#btn-simpan-assign').on('click', function () {
			validator();
		});
	});


</script>