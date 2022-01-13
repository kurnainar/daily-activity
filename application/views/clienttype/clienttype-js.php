<script>

	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('ClientType/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="cltplist" class="cltplist" data-id="'+data[i].ClientTypeId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].ClientTypeName+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalGrup").load("<?php echo site_url('ClientType/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#clienttype-add').modal({backdrop: 'static', keyboard: false});
				$('#clienttype-add').modal('show');
				$('#clienttype-add').on('hidden.bs.modal', function () {
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
		$("#ModalGrup").load("<?php echo site_url('ClientType/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#clienttype-edit').modal({backdrop: 'static', keyboard: false});
				$('#clienttype-edit').modal('show');
				$('#clienttype-edit').on('hidden.bs.modal', function () {
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
			url : "<?php echo site_url('ClientType/getClientType')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="cltpedit-id"]').val(data.ClientTypeId);
				$('[name="cltpedit-nama"]').val(data.ClientTypeName);
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
				NamaTipeKlien	: document.getElementById("cltpadd-nama").value
			}
		
		if(form['NamaTipeKlien'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		var table = $('#data-list').DataTable();	
		var rowCount = $('#data-list tr').length;
		
		$.ajax({
			url : "<?php echo site_url('ClientType/saveClientType')?>",
			type: "POST",
			data: $('#frmClientTypeAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-cltp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-cltp").setAttribute("disabled","disabled");
					$('#btn-simpan-cltp').html("<i class='fa fa-save'></i> Simpan");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-cltp').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				NamaTipeKlien	: document.getElementById("cltpedit-nama").value
			}
		
		if(form['NamaTipeKlien'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('ClientType/updateClientType')?>",
			type: "POST",
			data: $('#frmClientTypeEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-cltp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-cltp").setAttribute("disabled","disabled");
					$('#btn-ubah-cltp').html("<i class='fa fa-save'></i> Ubah");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-cltp').html("<i class='fa fa-save'></i> Ubah");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('ClientType/deleteClientType')?>",
			type: "POST",
			data: $('#frmClientTypeEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-cltp').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-cltp").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-cltp").setAttribute("disabled","disabled");
					$('#btn-hapus-cltp').html("<i class='fa fa-save'></i> Hapus");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-cltp').html("<i class='fa fa-save'></i> Hapus");
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
			info: false,
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
				// "sInfo": "Ditampilkan dalam <strong>{elapsed_time}</strong> detik.",
				"sInfo": "Menampilkan halaman _PAGE_ dari _TOTAL_ total data",
				"sInfoFiltered": "(difilter dari _MAX_ total data)",
				"sZeroRecords": "Tidak ditemukan - maaf",
				"sInfoEmpty": "Tidak ada data tersedia"
			}
		});
		
		$('tr.cltplist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-simpan-cltp').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-keluar-cltp').on('click', function () {
			$("#btn-keluar-grp").attr('data-dismiss', 'modal');
		});
		
		$('button#btn-ubah-cltp').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-cltp').on('click', function () {
			hapus();
		});
	});

</script>