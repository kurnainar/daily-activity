<div class="modal fade" id="themes-add">
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
						<form id="frmThemesAdd">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="thmadd-nama">Nama Sistem:</label>
										<input type="text" class="form-control" id="thmadd-nama" name="thmadd-nama" autofocus>
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="grpadd-gambar">Gambar:</label>
										<input class="form-control-file" type="file" id="thmadd-gambar" name="thmadd-gambar">
									</div>
								</div>
								
								<div class="col-sm-2">
									<div class="form-group">
										<label for="grpadd-logo">Logo:</label>
										<input class="form-control-file" type="file" id="thmadd-logo" name="thmadd-logo">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-simpan-thm"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-default" id="btn-keluar-thm"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	function validator()
	{
		var form = {
				NamaGrup	: document.getElementById("grpadd-nama").value,
				StatusGrup	: document.getElementById("grpadd-status").value,
				UrutanGrup	: document.getElementById("grpadd-urut").value,
			}
		
		if(form['NamaGrup'] == "") {
			swal("Maaf!", "Nama Grup Menu tidak boleh kosong!", "warning");
		} else if(form['StatusGrup'] == "") {
			swal("Maaf!", "Status Grup Menu tidak boleh kosong!", "warning");
		} else if(form['UrutanGrup'] == "") {
			swal("Maaf!", "Urutan Grup Menu tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('Themes/saveGroupMenu')?>",
			type: "POST",
			data: $('#frmThemesAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-thm').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-thm").setAttribute("disabled","disabled");
					$('#btn-simpan-thm').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-thm').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		$("form").attr('autocomplete', 'off');
		
		$('button#btn-keluar-thm').on('click', function () {
			location.reload();
		});
		
		$('button#btn-simpan-thm').on('click', function () {
			validator();
		});
	});


</script>