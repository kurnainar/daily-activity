<script>
	
	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('Submenu/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="submenulist" class="submenulist" data-id="'+data[i].SubMenuId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].SubMenuName+'</td>'+
							'<td class="tengah">'+data[i].SubMenuStatus+'</td>'+
							'<td class="kiri">'+data[i].Controller+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalSub").load("<?php echo site_url('Submenu/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#submenu-add').modal({backdrop: 'static', keyboard: false});
				$('#submenu-add').modal('show');
				$('#submenu-add').on('hidden.bs.modal', function () {
					$('#ModalSub').html('');
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
		$("#ModalSub").load("<?php echo site_url('Submenu/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#submenu-edit').modal({backdrop: 'static', keyboard: false});
				$('#submenu-edit').modal('show');
				$('#submenu-edit').on('hidden.bs.modal', function () {
					$('#ModalSub').html('');
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
			url : "<?php echo site_url('Submenu/getSubMenu')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="subedit-id"]').val(data.SubMenuId);
				$('[name="subedit-nama"]').val(data.SubMenuName);
				$('[name="subedit-status"]').val(data.SubMenuStatus);
				$('[name="subedit-nav"]').val(data.Controller);
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
				NamaSub	: document.getElementById("subadd-nama").value,
				StatusSub	: document.getElementById("subadd-status").value,
				Navigasi	: document.getElementById("subadd-nav").value,
			}
		
		if(form['NamaSub'] == "") {
			swal("Maaf!", "Nama Sub Menu tidak boleh kosong!", "warning");
		} else if(form['StatusSub'] == "") {
			swal("Maaf!", "Status Sub Menu tidak boleh kosong!", "warning");
		} else if(form['Navigasi'] == "") {
			swal("Maaf!", "Navigasi Sub Menu tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('Submenu/saveSubMenu')?>",
			type: "POST",
			data: $('#frmSubMenuAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-sub').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-sub").setAttribute("disabled","disabled");
					$('#btn-simpan-sub').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-sub').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				NamaSub	: document.getElementById("subedit-nama").value,
				StatusSub	: document.getElementById("subedit-status").value,
				Navigasi	: document.getElementById("subedit-nav").value,
			}
		
		if(form['NamaSub'] == "") {
			swal("Maaf!", "Nama Sub Menu tidak boleh kosong!", "warning");
		} else if(form['StatusSub'] == "") {
			swal("Maaf!", "Status Sub Menu tidak boleh kosong!", "warning");
		} else if(form['Navigasi'] == "") {
			swal("Maaf!", "Navigasi Sub Menu tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('Submenu/updateSubMenu')?>",
			type: "POST",
			data: $('#frmSubMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-sub').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-sub").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-sub").setAttribute("disabled","disabled");
					$('#btn-ubah-sub').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-sub').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('Submenu/deleteSubMenu')?>",
			type: "POST",
			data: $('#frmSubMenuEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-sub').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-sub").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-sub").setAttribute("disabled","disabled");
					$('#btn-hapus-sub').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-sub').html("<i class='fa fa-save'></i> Simpan");
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
		
		$('tr.submenulist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-keluar-sub').on('click', function () {
			$("#btn-keluar-sub").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('Submenu')?>");
				}, 500
			);
		});
		
		$('button#btn-simpan-sub').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-ubah-sub').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-sub').on('click', function () {
			hapus();
		});
	});

</script>