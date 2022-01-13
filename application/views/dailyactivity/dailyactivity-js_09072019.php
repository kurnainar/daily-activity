<script>

	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('DailyActivity/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				// console.log(data);
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="dailylist" class="dailylist" data-id="'+data[i].DailyActivityId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="tengah">'+data[i].DailyActivityDate+'</td>'+
							'<td class="tengah">'+data[i].ShiftName+'</td>'+
							'<td class="kiri">'+data[i].DailyCategoryName+'</td>'+
							'<td class="kiri">'+data[i].DailyActivityDesc+'</td>'+
							'<td class="tengah">'+data[i].DailyActivityStatus+'</td>'+
							'<td class="tengah">'+data[i].DailyCategoryScores+'</td>'+
							'<td class="kiri">'+data[i].Username+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalGrup").load("<?php echo site_url('DailyActivity/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#activity-add').modal({backdrop: 'static', keyboard: false});
				$('#activity-add').modal('show');
				$('#activity-add').on('hidden.bs.modal', function () {
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
		$("#ModalGrup").load("<?php echo site_url('DailyActivity/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#activity-edit').modal({backdrop: 'static', keyboard: false});
				$('#activity-edit').modal('show');
				$('#activity-edit').on('hidden.bs.modal', function () {
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
			url : "<?php echo site_url('DailyActivity/getDailyActivity')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="actedit-id"]').val(data.DailyActivityId);
				$('[name="actedit-tgl"]').val(data.DailyActivityDate);
				$('[name="actedit-shift"]').val(data.ShiftId);
				$('[name="actedit-jenis"]').val(data.DailyCategoryId);
				$('[name="actedit-desc"]').val(data.DailyActivityDesc);
				$('[name="actedit-status"]').val(data.DailyActivityStatus);
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
				Tanggal		: document.getElementById("actadd-tgl").value,
				Shift		: document.getElementById("actadd-shift").value,
				Jenis		: document.getElementById("actadd-jenis").value,
				Deskripsi	: document.getElementById("actadd-desc").value,
				Status		: document.getElementById("actadd-status").value
			}
		
		if(form['Tanggal'] == "") {
			swal("Maaf!", "Nama Klien tidak boleh kosong!", "warning");
		} else if(form['Shift'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Jenis'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Deskripsi'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Status'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('DailyActivity/saveDailyActivity')?>",
			type: "POST",
			data: $('#frmActivityAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-activity').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-activity").setAttribute("disabled","disabled");
					$('#btn-simpan-activity').html("<i class='fa fa-save'></i> Simpan");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-activity').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				Tanggal		: document.getElementById("actedit-tgl").value,
				Shift		: document.getElementById("actedit-shift").value,
				Jenis		: document.getElementById("actedit-jenis").value,
				Deskripsi	: document.getElementById("actedit-desc").value,
				Status		: document.getElementById("actedit-status").value
			}
		
		if(form['Tanggal'] == "") {
			swal("Maaf!", "Nama Klien tidak boleh kosong!", "warning");
		} else if(form['Shift'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Jenis'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Deskripsi'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else if(form['Status'] == "") {
			swal("Maaf!", "Nama Tipe Klien tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('DailyActivity/updateDailyActivity')?>",
			type: "POST",
			data: $('#frmActivityEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-activity').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-activity").setAttribute("disabled","disabled");
					$('#btn-ubah-activity').html("<i class='fa fa-save'></i> Ubah");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-activity').html("<i class='fa fa-save'></i> Ubah");
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
						}, {
							"text": '<i class="fa fa-fw fa-file-excel-o"></i> Export',
							"extend": 'excel',
							"messageTop": 'Catatan Kegiatan Harian',
							"title": 'Catatan Kegiatan Harian'
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
		
		$('tr.dailylist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-simpan-activity').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-keluar-activity').on('click', function () {
			$("#btn-keluar-activity").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('DailyActivity')?>");
				}, 500
			);
		});
		
		$('button#btn-ubah-activity').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-activity').on('click', function () {
			hapus();
		});
	});

</script>