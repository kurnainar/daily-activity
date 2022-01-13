<form id="frmChangePassword">
	<div class="form-group">
		<label for="chpass-username">ID Pengguna:</label>
		<input type="text" class="form-control" id="chpass-username" name="chpass-username" readonly>
	</div>
	
	<div class="form-group">
		<label for="chpass-nama">Nama Lengkap:</label>
		<input type="text" class="form-control" id="chpass-nama" name="chpass-nama" readonly>
	</div>
	
	<div class="form-group">
		<label for="chpass-password">Kata Sandi Baru:</label>
		<input type="password" class="form-control" id="chpass-password" name="chpass-password" autofocus>
	</div>
	
	<button type="button" id="btn-ubah-pass" class="btn btn-success btn-block" style="cursor:pointer;">
		<i class="fa fa-save"></i> Simpan
	</button>
</form>

<script>
	
	function validator()
	{
		var form = {
				password	: document.getElementById("chpass-password").value,
			}
			
			if(form['password'] == "") {
				swal("Maaf!", "Kata Sandi tidak boleh kosong!", "warning");
			} else {
				update();
			}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('User/changePassword')?>",
			type: "POST",
			data: $('#frmChangePassword').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-pass').html("<img src='<?php echo base_url();?>assets/image/fab/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-pass").setAttribute("disabled","disabled");
					$('#btn-ubah-pass').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-pass').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function getData(id)
	{
		$.ajax({
			url : "<?php echo site_url('User/getUser')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="chpass-username"]').val(data.Username);
				$('[name="chpass-nama"]').val(data.UserFullName);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log('Something Wrong!');
			}
		});
	}
	
	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		$("form").attr('autocomplete', 'off');
		
		var id = "<?php echo $this -> session -> userdata('UserId'); ?>";
		
		getData(id);
		
		$('button#btn-ubah-pass').on('click', function () {
			validator();
		});
	});

</script>