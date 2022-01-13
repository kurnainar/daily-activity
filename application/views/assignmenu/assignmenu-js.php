<script>

	function modalTambah()
	{
		$("#ModalAssign").load("<?php echo site_url('AssignMenu/formAdd')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#assignmenu-add').modal({backdrop: 'static', keyboard: false});
				$('#assignmenu-add').modal('show');
				$('#assignmenu-add').on('hidden.bs.modal', function () {
					$('#ModalAssign').html('');
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
		$("#ModalAssign").load("<?php echo site_url('AssignMenu/formEdit')?>",{
		},function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#assignmenu-edit').modal({backdrop: 'static', keyboard: false});
				$('#assignmenu-edit').modal('show');
				$('#assignmenu-edit').on('hidden.bs.modal', function () {
					$('#ModalAssign').html('');
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
			url : "<?php echo site_url('AssignMenu/getAssignMenu')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="assignedit-id"]').val(data.AssignMenuId);
				$('[name="assignedit-grup"]').val(data.GroupMenuId);
				$('[name="assignedit-sub"]').val(data.SubMenuId);
				$('[name="assignedit-hak"]').val(data.UserGroupId);
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
		
		$('tr.assignmenulist').on('click',function(){
			var id = $(this).attr('data-id');
			modalUbah(id)
		});
	});

</script>