<div class="modal fade" id="clienttype-edit">
	<div class="modal-dialog modal-lg" style="width:30%;">
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
						<form id="frmClientTypeEdit">
							<input type="hidden" id="cltpedit-id" name="cltpedit-id">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="cltpedit-nama">Nama Tipe Klien:</label>
										<input type="text" class="form-control" id="cltpedit-nama" name="cltpedit-nama">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div id="progress">
					<button type="button" class="btn btn-success" id="btn-ubah-cltp"><i class="fa fa-save"></i> Ubah </button>
					<button type="button" class="btn btn-danger" id="btn-hapus-cltp"><i class="fa fa-trash"></i> Hapus </button>
					<button type="button" class="btn btn-default" id="btn-keluar-cltp" data-dismiss="modal"><i class="fa fa-close"></i> Keluar </button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this -> load -> view('clienttype/clienttype-js'); ?>

<script>

	// function validatorUpdate()
	// {
		// var form = {
				// NamaGrup	: document.getElementById("grpedit-nama").value,
				// StatusGrup	: document.getElementById("grpedit-status").value,
				// UrutanGrup	: document.getElementById("grpedit-urut").value,
			// }
		
		// if(form['NamaGrup'] == "") {
			// swal("Maaf!", "Nama Grup Menu tidak boleh kosong!", "warning");
		// } else if(form['StatusGrup'] == "") {
			// swal("Maaf!", "Status Grup Menu tidak boleh kosong!", "warning");
		// } else if(form['UrutanGrup'] == "") {
			// swal("Maaf!", "Urutan Grup Menu tidak boleh kosong!", "warning");
		// } else {
			// update();
		// }
	// }
	
	// function update()
	// {
		// $.ajax({
			// url : "<?php echo site_url('Groupmenu/updateGroupMenu')?>",
			// type: "POST",
			// data: $('#frmGroupMenuEdit').serialize(),
			// dataType: "JSON",
			// beforeSend: function(){
				// $('#btn-ubah-grp').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			// },
			// success: function(data)
			// {
				// if(data.status) {
					// swal(data.title, data.text, data.type);
					// document.getElementById("btn-ubah-grp").setAttribute("disabled","disabled");
					// $('#btn-ubah-grp').html("<i class='fa fa-save'></i> Simpan");
				// } else {
					// swal(data.title, data.text, data.type);
					// $('#btn-ubah-grp').html("<i class='fa fa-save'></i> Simpan");
				// }
			// }
		// });
	// }
	
	// function hapus()
	// {
		// $.ajax({
			// url : "<?php echo site_url('Groupmenu/deleteGroupMenu')?>",
			// type: "POST",
			// data: $('#frmGroupMenuEdit').serialize(),
			// dataType: "JSON",
			// beforeSend: function(){
				// $('#btn-hapus-grp').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			// },
			// success: function(data)
			// {
				// if(data.status) {
					// swal(data.title, data.text, data.type);
					// document.getElementById("btn-ubah-grp").setAttribute("disabled","disabled");
					// document.getElementById("btn-hapus-grp").setAttribute("disabled","disabled");
					// $('#btn-hapus-grp').html("<i class='fa fa-save'></i> Simpan");
				// } else {
					// swal(data.title, data.text, data.type);
					// $('#btn-hapus-grp').html("<i class='fa fa-save'></i> Simpan");
				// }
			// }
		// });
	// }
	
	// $(document).ready(function(){
		// $.ajaxSetup({ cache: false });
		// $("form").attr('autocomplete', 'off');
		
		// $('button#btn-keluar-grp').on('click', function () {
			// location.reload();
		// });
		
		// $('button#btn-ubah-grp').on('click', function () {
			// validator();
		// });
		
		// $('button#btn-hapus-grp').on('click', function () {
			// hapus();
		// });
	// });


</script>