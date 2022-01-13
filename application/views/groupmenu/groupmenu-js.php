<script>

	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('Groupmenu/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="grpmenulist" class="grpmenulist" data-id="'+data[i].GroupMenuId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].GroupMenuName+'</td>'+
							'<td class="tengah">'+data[i].GroupMenuStatus+'</td>'+
							'<td class="tengah">'+data[i].GroupMenuOrder+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalGrup").load("<?php echo site_url('Groupmenu/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#groupmenu-add').modal({backdrop: 'static', keyboard: false});
				$('#groupmenu-add').modal('show');
				$('#groupmenu-add').on('hidden.bs.modal', function () {
					$('#ModalGrup').html('');
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
		$("#ModalGrup").load("<?php echo site_url('Groupmenu/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#groupmenu-edit').modal({backdrop: 'static', keyboard: false});
				$('#groupmenu-edit').modal('show');
				$('#groupmenu-edit').on('hidden.bs.modal', function () {
					$('#ModalGrup').html('');
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
			url : "<?php echo site_url('Groupmenu/getGroupMenu')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="grpedit-id"]').val(data.GroupMenuId);
				$('[name="grpedit-nama"]').val(data.GroupMenuName);
				$('[name="grpedit-status"]').val(data.GroupMenuStatus);
				$('[name="grpedit-urut"]').val(data.GroupMenuOrder);
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
			url : "<?php echo site_url('Groupmenu/saveGroupMenu')?>",
			type: "POST",
			data: $('#frmGroupMenuAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-grp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-grp").setAttribute("disabled","disabled");
					$('#btn-simpan-grp').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-grp').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				NamaGrup	: document.getElementById("grpedit-nama").value,
				StatusGrup	: document.getElementById("grpedit-status").value,
				UrutanGrup	: document.getElementById("grpedit-urut").value,
			}
		
		if(form['NamaGrup'] == "") {
			swal("Maaf!", "Nama Grup Menu tidak boleh kosong!", "warning");
		} else if(form['StatusGrup'] == "") {
			swal("Maaf!", "Status Grup Menu tidak boleh kosong!", "warning");
		} else if(form['UrutanGrup'] == "") {
			swal("Maaf!", "Urutan Grup Menu tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('Groupmenu/updateGroupMenu')?>",
			type: "POST",
			data: $('#frmGroupMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-grp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-grp").setAttribute("disabled","disabled");
					$('#btn-ubah-grp').html("<i class='fa fa-save'></i> Ubah");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-grp').html("<i class='fa fa-save'></i> Ubah");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('Groupmenu/deleteGroupMenu')?>",
			type: "POST",
			data: $('#frmGroupMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-grp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-grp").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-grp").setAttribute("disabled","disabled");
					$('#btn-hapus-grp').html("<i class='fa fa-save'></i> Hapus");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-grp').html("<i class='fa fa-save'></i> Hapus");
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
		
		$('tr.grpmenulist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-simpan-grp').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-keluar-grp').on('click', function () {
			$("#btn-keluar-grp").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('Groupmenu')?>");
				}, 500
			);
		});
		
		$('button#btn-ubah-grp').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-grp').on('click', function () {
			hapus();
		});
	});

</script>