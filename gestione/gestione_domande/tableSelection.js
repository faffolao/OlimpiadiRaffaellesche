var selectedId;

$(document).ready(function(){
	$("#tabella tbody").on('click','tr',function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			selectedId = null;
			
			$("#editBtn").attr("disabled","true");
		}else{
			if(selectedId != null){
				$("#" + selectedId).removeClass('selected');
			}
			
            $(this).addClass('selected');
			selectedId = $(this).attr("id");
			
			$("#editBtn").removeAttr("disabled");
		}
	});
});