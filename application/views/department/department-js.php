<script>
	
	function listTable(){
		$.ajax({
			type  : 'ajax',
			url   : '<?php echo site_url('Department/listTable')?>',
			async : false,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				var no = 1;
				for(i=0; i<data.length; i++){
					html += '<tr id="deptlist" class="deptlist" data-id="'+data[i].DepartmentId+'" style="cursor: pointer;">'+
							'<td class="tengah">'+no+'</td>'+
							'<td class="kiri">'+data[i].DepartmentName+'</td>'+
							'</tr>';
					no++;
				}
				$('#show_data').html(html);
			}
		});
	}
	
	function modalTambah()
	{
		$("#ModalSub").load("<?php echo site_url('Department/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#department-add').modal({backdrop: 'static', keyboard: false});
				$('#department-add').modal('show');
				$('#department-add').on('hidden.bs.modal', function () {
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
		$("#ModalSub").load("<?php echo site_url('Department/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#department-edit').modal({backdrop: 'static', keyboard: false});
				$('#department-edit').modal('show');
				$('#department-edit').on('hidden.bs.modal', function () {
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
			url : "<?php echo site_url('Department/getDepartment')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="deptedit-id"]').val(data.DepartmentId);
				$('[name="deptedit-nama"]').val(data.DepartmentName);
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
				NamaPackage	: document.getElementById("deptadd-nama").value
			}
		
		if(form['NamaPackage'] == "") {
			swal("Maaf!", "Nama Departemen tidak boleh kosong!", "warning");
		} else {
			submit();
		}
	}
	
	function submit()
	{
		$.ajax({
			url : "<?php echo site_url('Department/saveDepartment')?>",
			type: "POST",
			data: $('#frmDepartmentAdd').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-simpan-dept').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-simpan-dept").setAttribute("disabled","disabled");
					$('#btn-simpan-dept').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-simpan-dept').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function validatorUpdate()
	{
		var form = {
				NamaPackage	: document.getElementById("deptedit-nama").value
			}
		
		if(form['NamaPackage'] == "") {
			swal("Maaf!", "Nama Departemen tidak boleh kosong!", "warning");
		} else {
			update();
		}
	}
	
	function update()
	{
		$.ajax({
			url : "<?php echo site_url('Department/updateDepartment')?>",
			type: "POST",
			data: $('#frmDepartmentEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-ubah-dept').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-dept").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-dept").setAttribute("disabled","disabled");
					$('#btn-ubah-dept').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-ubah-dept').html("<i class='fa fa-save'></i> Simpan");
				}
			}
		});
	}
	
	function hapus()
	{
		$.ajax({
			url : "<?php echo site_url('Department/deleteDepartment')?>",
			type: "POST",
			data: $('#frmDepartmentEdit').serialize(),
			dataType: "JSON",
			beforeSend: function(){
				$('#btn-hapus-dept').html("<img src='<?php echo base_url();?>assets/image/core/loader.gif' style='height:20px;' /> Data sedang dikirim...");
			},
			success: function(data)
			{
				if(data.status) {
					swal(data.title, data.text, data.type);
					document.getElementById("btn-ubah-dept").setAttribute("disabled","disabled");
					document.getElementById("btn-hapus-dept").setAttribute("disabled","disabled");
					$('#btn-hapus-dept').html("<i class='fa fa-save'></i> Simpan");
				} else {
					swal(data.title, data.text, data.type);
					$('#btn-hapus-dept').html("<i class='fa fa-save'></i> Simpan");
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
		
		$('tr.deptlist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
		
		$('button#btn-keluar-dept').on('click', function () {
			$("#btn-keluar-dept").attr('data-dismiss', 'modal');
			setTimeout(
				function() {
					$("#content").load("<?php echo site_url('Department')?>");
				}, 500
			);
		});
		
		$('button#btn-simpan-dept').on('click', function () {
			validatorTambah();
		});
		
		$('button#btn-ubah-dept').on('click', function () {
			validatorUpdate();
		});
		
		$('button#btn-hapus-dept').on('click', function () {
			hapus();
		});
	});

</script>