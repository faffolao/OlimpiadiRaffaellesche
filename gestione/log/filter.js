$(document).ready(function(){
	$('input[type=checkbox]').change(function(){
		var id = $(this).attr("id");
		
	    if (this.checked) {
	        mostra(id);
	    }else{
	    	nascondi(id);
	    }
    });
});

function mostra(id){
	$("." + id).show();
}

function nascondi(id){
	$("." + id).hide();
}