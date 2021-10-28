var selectedId;

$(document).ready(function(){
	$("#tabella tbody").on('click','tr',function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			selectedId = null;
			
			$("#editBtn").attr("disabled","true");
			$("#deleteBtn").attr("disabled","true");
                        $("#inviaCredenzialiSelezionato").addClass("disabled");
		}else{
			if(selectedId != null){
				$("#" + selectedId).removeClass('selected');
			}
			
            $(this).addClass('selected');
			selectedId = $(this).attr("id");
			
			$("#editBtn").removeAttr("disabled");
			$("#deleteBtn").removeAttr("disabled");
                        $("#inviaCredenzialiSelezionato").removeClass("disabled");
			
		}
	});
});