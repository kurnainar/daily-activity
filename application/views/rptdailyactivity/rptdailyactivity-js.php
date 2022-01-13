<script>

	$(document).ready(function(){
		$.ajaxSetup({ cache: false });
		$("form").attr('autocomplete', 'off');
		
		var dtToday = new Date();

		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();

		if(month < 10)
		month = '0' + month.toString();
		if(day < 10)
		day = '0' + day.toString();

		var maxDate = year + '-' + month + '-' + day;    
		$('#tgl-awal').attr('max', maxDate);
		$('#tgl-akhir').attr('max', maxDate);
		
		function openInNewTab(url) {
			var win = window.open(url, '_blank');
			win.focus();
		}
		
		$('button#btn-export-rda').on('click', function () {
			start	= window.btoa(document.getElementById('tgl-awal').value);
			end		= window.btoa(document.getElementById('tgl-akhir').value);
			
			if(start == "") {
				swal("Maaf!", "Tanggal awal tidak boleh kosong!", "warning");
			} else if(end == "") {
				swal("Maaf!", "Tanggal akhir tidak boleh kosong!", "warning");
			} else {
				openInNewTab("<?php echo site_url('RptDailyActivity/getExport')?>?start="+start+"&end="+end);	
			}
		});
	});

</script>