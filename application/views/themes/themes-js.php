<script>
	
	function modalTambah()
	{
		$("#ModalThemes").load("<?php echo site_url('Themes/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#themes-add').modal({backdrop: 'static', keyboard: false});
				$('#themes-add').modal('show');
				$('#themes-add').on('hidden.bs.modal', function () {
					$('#ModalThemes').html('');
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
		$("#ModalThemes").load("<?php echo site_url('Themes/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#themes-edit').modal({backdrop: 'static', keyboard: false});
				$('#themes-edit').modal('show');
				$('#themes-edit').on('hidden.bs.modal', function () {
					$('#ModalThemes').html('');
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
			url : "<?php echo site_url('Themes/getGroupMenu')?>/" + id,
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
	
	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		
		var table = $('#data-list').DataTable({
			dom: 'Bfrtip',
			// bFilter: false,
			stateSave: true,
			orderCellsTop: true,
			fixedHeader: true,
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
	});

</script>