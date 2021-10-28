var selectedId;

$(document).ready(function(){
	$("#tabella tbody").on('click','tr',function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			selectedId = null;
			
			$("#editBtn").attr("disabled","true");
			$("#deleteBtn").attr("disabled","true");
		}else{
			if(selectedId != null){
				$("#" + selectedId).removeClass('selected');
			}
			
            $(this).addClass('selected');
			selectedId = $(this).attr("id");
			
			$("#editBtn").removeAttr("disabled");
			$("#deleteBtn").removeAttr("disabled");
			
		}
	});
	
	
	$("#addBtn").click(function(){
		$("#addUserModal").show();
	});
	
	$("#closeModalBtn").click(function(){
		$("#addUserModal").hide();
	});
	
	$("#editBtn").click(function(){
		var row = $("#" + selectedId);
		
		var username = row.find(".td-username").text();
		var password = row.find("input[type='password']").val();
		var email = row.find(".td-email").text();
		
		$("#new_username").val(username);
		$("#new_password").val(password);
		$("#old_email").val(email);
		$("#new_email").val(email);
		
		$("#editUserModal").show();
	});
	
	$("#closeEditModalBtn").click(function(){
		$("#editUserModal").hide();
	});
	
	$("#deleteBtn").click(function(){
            if(confirm("L'utente selezionato verrà eliminato.")){
                    
			$.ajax({
				url: 'action_removeUser.php',
				type: 'POST',
				data: "id=" + selectedId,
				success: function(response){
					location.reload();
				}
			});
		}
	});
});

function generaPassword(idModale, idCampoPsw){
	var password = randomPassword();
	
	$("#"+idModale + " #" + idCampoPsw).val(password);
	$("#"+idModale + " #" + idCampoPsw).attr("type","text");
}

function randomPassword(){
	var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < 10; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function visualizzaPassword(passwordId){
	if ($("#" + passwordId).attr("type") === "password") {
		$("#" + passwordId).attr("type","text");
		
		$("#" + passwordId + "-img").attr("src", "./img/hide.svg");
	} else {
		$("#" + passwordId).attr("type","password");
		
	    $("#" + passwordId + "-img").attr("src", "./img/view.svg");
	}
}