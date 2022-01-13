function header(controller)
{
	$.ajax({
		url : "<?php echo site_url('AssignMenu/getMenuName')?>/" + controller,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			if(data) {
				document.getElementById("loadHeader").innerHTML = data.SubMenuName;
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.log('Something Wrong!');
		}
	});
}

$(document).ready(function(){
	$("#panel").removeAttr("panel").hide();
	$('a#controller').on('click').on('click',function(){
		var id = $(this).attr('data-id');
		
		if(id) {
			$("#panel").removeAttr("panel").show();
			$('#loadHome').html('');
			header(id);
			$("#loadContent").load(id);
		} else {
			$("#panel").removeAttr("panel").hide();
		}
	});
});