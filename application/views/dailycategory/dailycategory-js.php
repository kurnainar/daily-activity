<script>

	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('DailyCategory/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="dclist" class="dclist" data-id="'+data[i].DailyCategoryId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].DailyCategoryName+'</td>'+
							'<td class="kiri">'+data[i].DailyCategoryDesc+'</td>'+
							'<td class="tengah">'+data[i].DailyCategoryScores+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalGrup").load("<?php echo site_url('DailyCategory/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#daily-add').modal({backdrop: 'static', keyboard: false});
				$('#daily-add').modal('show');
				$('#daily-add').on('hidden.bs.modal', function () {
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
		$("#ModalGrup").load("<?php echo site_url('DailyCategory/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#daily-edit').modal({backdrop: 'static', keyboard: false});
				$('#daily-edit').modal('show');
				$('#daily-edit').on('hidden.bs.modal', function () {
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
			url : "<?php echo site_url('DailyCategory/getDailyCategory')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="dailyedit-id"]').val(data.DailyCategoryId);
				$('[name="dailyedit-jenis"]').val(data.DailyCategoryName);
				$('[name="dailyedit-desc"]').val(data.DailyCategoryDesc);
				$('[name="dailyedit-skor"]').val(data.DailyCategoryScores);
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
				JenisDaily	: document.getElementById("dailyadd-jenis").value,
				DescDaily	: document.getElementById("dailyadd-desc").value,
				SkorDaily	: document.getElementById("dailyadd-skor").value
			}
		
		if(form['JenisDaily'] == "") {
			swal("Maaf!", "Jenis Kategori Harian tidak boleh kosong!", "warning");
		} else if(form['DescDaily'] == "") {
			swal("Maaf!", "Deskripsi Kategori Harian tidak boleh kosong!", "warning");
		} else if(form['SkorDaily'] == "") {
			swal("Maaf!", "Skor tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('DailyCategory/saveDailyCategory')?>",
			type: "POST",
			data: $('#frmDailyAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-daily').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-daily").setAttribute("disabled","disabled");
					$('#btn-simpan-daily').html("<i class='fa fa-save'></i> Simpan");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-daily').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				JenisDaily	: document.getElementById("dailyedit-jenis").value,
				DescDaily	: document.getElementById("dailyedit-desc").value,
				SkorDaily	: document.getElementById("dailyedit-skor").value
			}
		
		if(form['JenisDaily'] == "") {
			swal("Maaf!", "Jenis Kategori Harian tidak boleh kosong!", "warning");
		} else if(form['DescDaily'] == "") {
			swal("Maaf!", "Deskripsi Kategori Harian tidak boleh kosong!", "warning");
		} else if(form['SkorDaily'] == "") {
			swal("Maaf!", "Skor tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('DailyCategory/updateDailyCategory')?>",
			type: "POST",
			data: $('#frmDailyEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-daily').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-daily").setAttribute("disabled","disabled");
					$('#btn-ubah-daily').html("<i class='fa fa-save'></i> Ubah");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-daily').html("<i class='fa fa-save'></i> Ubah");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('DailyCategory/deleteDailyCategory')?>",
			type: "POST",
			data: $('#frmDailyEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-daily').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-daily").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-daily").setAttribute("disabled","disabled");
					$('#btn-hapus-daily').html("<i class='fa fa-save'></i> Hapus");
					listTable();
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-daily').html("<i class='fa fa-save'></i> Hapus");
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
				"sInfo": "Menampilkan halaman _PAGE_ dari _TOTAL_ total data",
				"sInfoFiltered": "(difilter dari _MAX_ total data)",
				"sZeroRecords": "Tidak ditemukan - maaf",
				"sInfoEmpty": "Tidak ada data tersedia"
			}
		});
		
		$('tr.dclist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-simpan-daily').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-keluar-daily').on('click', function () {
			$("#btn-keluar-daily").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('DailyCategory')?>");
				}, 500
			);
		});
		
		$('button#btn-ubah-daily').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-daily').on('click', function () {
			hapus();
		});
	});

</script>