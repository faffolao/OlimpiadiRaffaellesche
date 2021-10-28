$(document).ready(function(){
	$(".form-check-inline").change(function(){
		var selected_value = $("input[name='search-radio']:checked").val();
		if(selected_value == "search-id"){
			searchIn = 0;
			$("#search-box").attr("placeholder","Ricerca ID studente...");
		}else if(selected_value == "search-username"){
			searchIn = 1;
			$("#search-box").attr("placeholder","Ricerca username...");
		}else if(selected_value == "search-email"){
			searchIn = 3;
			$("#search-box").attr("placeholder","Ricerca email...");
		}else if(selected_value == "search-codmeccanografico"){
			searchIn = 5;
			$("#search-box").attr("placeholder","Ricerca codice meccanografico...");
		}else if(selected_value == "search-docente"){
                        searchIn = 6;
			$("#search-box").attr("placeholder","Ricerca docente...");
                }
	});
	
	$("#addUserBtn").click(function(){
		$("#addStudentModal").show();
	});
	
	$("#closeAddModalBtn").click(function(){
		$("#addStudentModal").hide();
	});
	
	$("#editBtn").click(function(){
		var row = $("#" + selectedId);
		
		var username = row.find(".td-username").text();
		var password = $("#password" + selectedId).val();
		var email = row.find(".td-email-1").text();
                var email2 = row.find(".td-email-2").text();
		var cod_scuola = row.find(".td-codScuola").text();
                var docente = row.find(".td-docente").text();
                
		$("#old-username").val(username);
		$("#old-password").val(password);
		$("#old-email").val(email);
                $("#old-email2").val(email2);
		$("#old-cod_meccanografico").val(cod_scuola);
		$("#old-docente").val(docente);
		$("#old-id").val(selectedId);
                
		$("#editStudentModal").show();
	});
	
	$("#closeEditModalBtn").click(function(){
		$("#editStudentModal").hide();
	});
	
	$("#deleteBtn").click(function(){
		if(confirm("Lo studente selezionato verrà eliminato.")){
			$.ajax({
				url: 'action_removeStudent.php',
				type: 'POST',
				data: {id: selectedId},
				success: function(response){
					location.reload();
				}
			});
		}
	});
        
        $("#importStudent").click(function(){
           $("#importStudentModal").show();
        });
        
        $("#closeImportModalBtn").click(function(){
           $("#importStudentModal").hide();
        });
});

function generaPassword(){
	//viene generata una password random di 8 caratteri (5 lettere + 3 num)
	var randomstring = Math.random().toString(36).slice(-8);
	$("#addStudentModal #password").val(randomstring);
	$("#addStudentModal #password").attr("type","text");
}

function generaPasswordModificata(){
	//viene generata una password random di 8 caratteri (5 lettere + 3 num)
	var randomstring = Math.random().toString(36).slice(-8);
	$("#editStudentModal #new-password").val(randomstring);
	$("#editStudentModal #new-password").attr("type","text");
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

function inviaEmailATutti(){
    if(confirm("Verranno inviate le mail a tutti gli studenti registrati. A seconda del numero di studenti registrati" + 
                " potrebbe essere necessario molto tempo.")){
        PNotify.notice({
            title: 'Invio mail in corso.',
            text: 'A seconda del numero di utenti registrati ci impiegherà abbastanza tempo. I risultati appariranno nella finestra che si è aperta.',
            icon: 'fas fa-spinner fa-pulse',
            delay: 4000,
            module: {
                Mobile:{
                    swipeDismiss:true,
                    styling:true
                }
            }
        });
        
        window.open('./invio_email/invioEmailTutti.php', '_blank', 'location=yes,height=800,width=600,scrollbars=yes,status=yes');  
    }
}


function ascii_to_hexa(str){
	var arr1 = [];
	for (var n = 0, l = str.length; n < l; n ++) {
		var hex = Number(str.charCodeAt(n)).toString(16);
		arr1.push(hex);
 	}
		return arr1.join('');
}



function inviaEmailAStudente(){
    if(confirm("Verrà inviata una mail allo studente selezionato contenente le sue credenziali per l'accesso.")){
        var email = $("#" + selectedId + " .td-email-1").text();
        var email2 = $("#" + selectedId + " .td-email-2").text();
        var username = $("#" + selectedId + " .td-username").text();
        var password = $("#password" + selectedId).val();
        
        //conversione da ascii a hex
        password = ascii_to_hexa(password);
        username = ascii_to_hexa(username);
		
        // invio notifica
        PNotify.notice({
            title: 'Invio mail in corso.',
            text: email + "\n" + email2,
            icon: 'fas fa-spinner fa-pulse',
            delay: 2000,
            module: {
                Mobile:{
                    swipeDismiss:true,
                    styling:true
                }
            }
        });
        
        // invio email effettiva
        $.ajax({
           url: "invio_email/invioEmailStudente.php",
           type: "POST",
           data: "username=" + username + "&email1=" + email + "&email2=" + email2 + "&password=" + password,
           success: function(response){
                PNotify.success({
                    title: 'Successo',
                    text: 'La mail è stata inviata correttamente.',
                    delay: 4000,
                    module: {
                        Mobile:{
                            swipeDismiss:true,
                            styling:true
                        }
                    }
                });
           },
           error: function(response){
                PNotify.error({
                    title: 'Errore',
                    text: 'Impossibile inviare la mail.',
                    delay: 4000,
                    module: {
                        Mobile:{
                            swipeDismiss:true,
                            styling:true
                        }
                    }
                });
           }
        });
    }
}