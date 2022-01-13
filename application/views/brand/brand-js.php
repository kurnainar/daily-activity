<script>

	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('Client/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="clientlist" class="clientlist" data-id="'+data[i].ClientId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].ClientName+'</td>'+
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
		$("#ModalGrup").load("<?php echo site_url('Client/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#client-add').modal({backdrop: 'static', keyboard: false});
				$('#client-add').modal('show');
				$('#client-add').on('hidden.bs.modal', function () {
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
		$("#ModalGrup").load("<?php echo site_url('Client/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#client-edit').modal({backdrop: 'static', keyboard: false});
				$('#client-edit').modal('show');
				$('#client-edit').on('hidden.bs.modal', function () {
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
			url : "<?php echo site_url('Client/getClient')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="cltedit-id"]').val(data.ClientId);
				$('[name="cltedit-tipe"]').val(data.ClientTypeId);
				$('[name="cltedit-nama"]').val(data.ClientName);
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
				NamaKlien		: document.getElementById("cltadd-nama").value,
				NamaTipeKlien	: document.getElementById("cltadd-tipe").value
			}
		
		if(form['NamaKlien'] == "") {
			swal("Maaf!", "Nama Klien tidak boleh kosong!", "warning");
		} else if(form['NamaTipeKlien'] == "") {
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
			url : "<?php echo site_url('Client/saveClient')?>",
			type: "POST",
			data: $('#frmClientAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-clt').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-clt").setAttribute("disabled","disabled");
					$('#btn-simpan-clt').html("<i class='fa fa-save'></i> Simpan");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-clt').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				NamaKlien		: document.getElementById("cltedit-nama").value,
				NamaTipeKlien	: document.getElementById("cltedit-tipe").value
			}
		
		if(form['NamaKlien'] == "") {
			swal("Maaf!", "Nama Grup Menu tidak boleh kosong!", "warning");
		} else if(form['NamaTipeKlien'] == "") {
			swal("Maaf!", "Status Grup Menu tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('Client/updateClient')?>",
			type: "POST",
			data: $('#frmClientEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-clt').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-clt").setAttribute("disabled","disabled");
					$('#btn-ubah-clt').html("<i class='fa fa-save'></i> Ubah");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-clt').html("<i class='fa fa-save'></i> Ubah");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('Client/deleteClient')?>",
			type: "POST",
			data: $('#frmClientEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-clt').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-clt").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-clt").setAttribute("disabled","disabled");
					$('#btn-hapus-clt').html("<i class='fa fa-save'></i> Hapus");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-clt').html("<i class='fa fa-save'></i> Hapus");
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
		
		$('tr.clientlist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-simpan-clt').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-keluar-clt').on('click', function () {
			$("#btn-keluar-clt").attr('data-dismiss', 'modal');
			// location.reload();
			// listTable();
		});
		
		$('button#btn-ubah-clt').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-clt').on('click', function () {
			hapus();
		});
	});

</script>