function verificaInizio(){
	$.ajax({
		url: "./timer.php",
		dataType: "json",
		success: function(risposta){
			if(risposta.time <= 900000){
				if((risposta.time/1000) <= 0){
					window.location.href = "../Quiz-prova/";
				} else {
					document.getElementById("time").style = "visibility:hidden";					
					var remaining_time = msToTime(risposta.time);
					document.getElementById("timer").innerHTML = "Il Quiz sta per iniziare. Tempo Rimanente: <br>" + remaining_time;
					document.getElementById("prova").innerHTML = risposta.currentTime;	
				}
			}
		},
		error: function(jqXHR, exception){/*alert(jqXHR.responseText + "  - " + exception);*/}
	});
}

function msToTime(msDurata) {
    var secondi = parseInt((msDurata/1000)%60)
        , minuti = parseInt((msDurata/(1000*60))%60)
        , ore = parseInt((msDurata/(1000*60*60))%24);
 
    ore = (ore < 10) ? "0" + ore : ore;
    minuti = (minuti < 10) ? "0" + minuti : minuti;
    secondi = (secondi < 10) ? "0" + secondi : secondi;
 
    return ore + ":" + minuti + ":" + secondi;
}

$( document ).ready(function() {
	verificaInizio();
	setInterval(verificaInizio, 500);
});
