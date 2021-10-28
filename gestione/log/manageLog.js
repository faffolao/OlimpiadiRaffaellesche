function leggiJson(){
	$.ajax({
		url: "../../log.json",
		type: "POST",
		data: [],
		dataType: "json",
		success: function(response){
			stampa(response);
		}
	});
}

function stampa(array){
	var s = "";
	for(i=0;i<array.length;i++){
		if(array[i].tipo == "log-mod-impostazioni-utenti"){
			s += '<div class="alert alert-info log-mod-impostazioni-utenti"><strong>Impostazioni e utenti: </strong>';
		}else if(array[i].tipo == "log-login-logout"){
			s += '<div class="alert alert-dark log-login-logout"><strong>Login/logout: </strong>';
		}else if(array[i].tipo == "log-statoquiz"){
			s += '<div class="alert alert-warning log-statoquiz"><strong>Stato del quiz: </strong>';
		}else{
			s += '<div class="alert alert-danger log-errori"><strong>Errore: </strong>';
		}
		
		s += array[i].testo + '<br><em>' + array[i].dataOra + '</em></div>';
	}
	
	$("#log-container").html(s);
}

function svuotaLog(){
	if(confirm("Desideri svuotare il log?")){
		$.ajax({
			url: "action_svuotaLog.php",
			type: "POST",
			data: {test: "qr"},
			success: function(response){
				$("#log-container").html("");
			}
		});
	}
}

leggiJson();
setInterval(function(){leggiJson();}, 2000);