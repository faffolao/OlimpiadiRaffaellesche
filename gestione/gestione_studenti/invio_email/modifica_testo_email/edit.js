$(document).ready(function(){
	$("#edit").click(function(){
		$(this).attr("disabled","true").html('<span class="spinner-border spinner-border-sm"></span>  Attendere');
		
		var new_rules = tinymce.activeEditor.getContent();
		$.ajax({
			url: './action_editTestoEmail.php',
			type: 'POST',
			data: {new_regolamento: new_rules},
			success: function(response){
				window.location = "../";
			}
		});
	});
	
	$("#cancel").click(function(){
		window.location = "../";
	});
});