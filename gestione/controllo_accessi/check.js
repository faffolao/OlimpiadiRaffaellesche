function leggiJson(){
	$.ajax({
		url: "../../accessi.json",
		type: "POST",
		dataType: "json",
		success: function(response){
			console.log(response);
			stampa(response);
		}
	});
}

function stampa(array){	
        
	for(i=0;i<array.length;i++){
		switch(array[i].tipologia){
                        case 0:
				$("#studente-" + array[i].utente + "-loggato img").attr("src","img/no.svg");
                                $("#studente-" + array[i].utente + "-inattesa img").attr("src","img/no.svg");
                                $("#studente-" + array[i].utente + "-svolgimento img").attr("src","img/no.svg");
				break;
			case 1:
				$("#studente-" + array[i].utente + "-loggato img").attr("src","img/yes.svg");
				break;
			case 2:
				$("#studente-" + array[i].utente + "-inattesa img").attr("src","img/yes.svg");
				break;
			case 3:
				$("#studente-" + array[i].utente + "-svolgimento img").attr("src","img/yes.svg");
				break;
			case 4:
				$("#studente-" + array[i].utente + "-terminato img").attr("src","img/yes.svg");
				break;
			
		}
	}
}

leggiJson();
setInterval(leggiJson, 2000);