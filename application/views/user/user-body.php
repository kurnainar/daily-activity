<div class="login-box">
	<div class="login-logo">
		<img src="<?php echo base_url();?>assets/image/core/logo-metrotv-crop.png" width="200">
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
		<form id="frmLogin">
			<div class="form-group has-feedback">
				<input type="text" name="login-kode" id="login-kode" class="form-control" placeholder="Masukkan ID Pengguna" autocomplete="off">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="login-pass" id="login-pass" class="form-control" placeholder="Masukkan Kata Sandi" autocomplete="off">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<button type="button" id="btn-login" class="btn btn-primary btn-block btn-flat" onclick="Testing()">Masuk</button>
					<p class="footer">Halaman ditampilkan dalam <strong>{elapsed_time}</strong> detik.</p>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweet-alert.min.js"></script>
<script>

	function Testing()
	{
		var field = {
						Kode		: document.getElementById("login-kode").value,
						Password	: document.getElementById("login-pass").value
					};
					
		if(field['Kode'] == "") {
			swal("Maaf!", "Kode Tidak Boleh Kosong!", "warning");
		} else if(field['Password'] == "") {
			swal("Maaf!", "Password Tidak Boleh Kosong!", "warning");
		} else {
			$.ajax({
				url : "<?php echo site_url('User/Authentication')?>",
				type: "POST",
				data: $('#frmLogin').serialize(),
				dataType: "JSON",
				success: function(result)
				{
					if(result.status) {
						window.location.replace("<?php echo site_url('beranda?sess(true)')?>");
					} else {
						swal("Maaf!", "Kode/Password Anda Salah!", "warning");
					}
				}, error: function (jqXHR, textStatus, errorThrown) {
					swal("Oops!", "Ada masalah!", "warning");
				}
			});
		}
	}
	
	$(document).ready(function(){
		var input = document.getElementById("login-pass");
		input.addEventListener("keyup", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				document.getElementById("btn-login").click();
			}
		});
	});
	
</script>