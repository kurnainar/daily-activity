<script>
	
	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('User/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="userlist" class="userlist" data-id="'+data[i].UserId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].Username+'</td>'+
							'<td class="kiri">'+data[i].UserFullName+'</td>'+
							'<td class="kiri">'+data[i].DepartmentName+'</td>'+
							'<td class="kiri">'+data[i].LoginStatus+'</td>'+
							'<td class="kiri">'+data[i].UserStatus+'</td>'+
							'<td class="kiri">'+data[i].UserGroupName+'</td>'+
							'<td class="kiri">'+data[i].LastLogin+'</td>'+
							'<td class="kiri">'+data[i].LastLogout+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalUser").load("<?php echo site_url('User/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#user-add').modal({backdrop: 'static', keyboard: false});
				$('#user-add').modal('show');
				$('#user-add').on('hidden.bs.modal', function () {
					$('#ModalUser').html('');
				});
			}
			
			if(statusTxt == "error"){
				console.log("Error: " + xhr.status + ": " + xhr.statusText);
				return false;
			}
		});
	}
	
	function modalUbah(id)
	{
		$("#ModalUser").load("<?php echo site_url('User/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#user-edit').modal({backdrop: 'static', keyboard: false});
				$('#user-edit').modal('show');
				$('#user-edit').on('hidden.bs.modal', function () {
					$('#ModalUser').html('');
				});
			}
			
			getData(id);
			
			if(statusTxt == "error"){
				console.log("Error: " + xhr.status + ": " + xhr.statusText);
				return false;
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
				$('[name="useredit-id"]').val(data.UserId);
				$('[name="useredit-username"]').val(data.Username);
				$('[name="useredit-nama"]').val(data.UserFullName);
				$('[name="useredit-hak"]').val(data.UserGroupId);
				$('[name="useredit-dept"]').val(data.DepartmentId);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log('Something Wrong!');
			}
		});
	}
	
	function validatorTambah()
	{
		var form = {
				username	: document.getElementById("useradd-username").value,
				nama		: document.getElementById("useradd-nama").value,
				hak			: document.getElementById("useradd-hak").value,
			}
			
			if(form['username'] == "") {
				swal("Maaf!", "ID Pengguna tidak boleh kosong!", "warning");
			} else if(form['nama'] == "") {
				swal("Maaf!", "Nama Lengkap tidak boleh kosong!", "warning");
			} else if(form['hak'] == "") {
				swal("Maaf!", "Hak Akses Pengguna tidak boleh kosong!", "warning");
			} else {
				submit();
			}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('User/saveUser')?>",
			type: "POST",
			data: $('#frmUserAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-user').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-user").setAttribute("disabled","disabled");
					$('#btn-simpan-user').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-user').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				username	: document.getElementById("useredit-username").value,
				nama		: document.getElementById("useredit-nama").value,
				hak			: document.getElementById("useredit-hak").value,
			}
			
			if(form['username'] == "") {
				swal("Maaf!", "ID Pengguna tidak boleh kosong!", "warning");
			} else if(form['nama'] == "") {
				swal("Maaf!", "Nama Lengkap tidak boleh kosong!", "warning");
			} else if(form['hak'] == "") {
				swal("Maaf!", "Hak Akses Pengguna tidak boleh kosong!", "warning");
			} else {
				update();
			}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('User/updateUser')?>",
			type: "POST",
			data: $('#frmUserEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-user').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-user").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-user").setAttribute("disabled","disabled");
					$('#btn-ubah-user').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-user').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('User/deleteUser')?>",
			type: "POST",
			data: $('#frmUserEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-user').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-user").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-user").setAttribute("disabled","disabled");
					$('#btn-hapus-user').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-user').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		$("form").attr('autocomplete', 'off');
		listTable();
		
		var table = $('#data-list').DataTable({
			dom: 'Bfrtip',
			// bFilter: false,
			stateSave: true,
			orderCellsTop: true,
			fixedHeader: true,
			retrieve: true,
			"buttons": [{
							"text": '<i class="fa fa-fw fa-plus-circle"></i> Tambah',
							"action": function ( e, dt, node, config ) {
								modalTambah();
							}
						}, {
							"text": '<i class="fa fa-fw fa-eraser"></i> Reset',
							"action": function ( e, dt, node, config ) {
								$('#data-list').DataTable().search( '' ).columns().search( '' ).draw();
							}
						}],
			"oLanguage": {
				"sSearch": "Cari:",
				"oPaginate": {
					"sFirst": "Halaman Pertama",
					"sPrevious": "Sebelumnya",
					"sNext": "Selanjutnya",
					"sLast": "Halaman Terakhir"
				},
				"sInfo": "Menampilkan halaman _PAGE_ dari _TOTAL_ total data",
				"sInfoFiltered": "(difilter dari _MAX_ total data)",
				"sZeroRecords": "Tidak ditemukan - maaf",
				"sInfoEmpty": "Tidak ada data tersedia"
			}
		});
		
		$('tr.userlist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-keluar-user').on('click', function () {
			$("#btn-keluar-user").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('User')?>");
				}, 500
			);
		});
		
		$('button#btn-simpan-user').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-ubah-user').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-user').on('click', function () {
			hapus();
		});
	});

</script>