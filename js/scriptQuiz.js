//varibile globale per la memorizzazione del timer attuale
var valoreTimer = 0;
//variabile per il set interval
var myTimer;

//============================================================================

function writeOnDB(tmp){
	$.ajax({
		url: "./write.php?risp="+tmp+"&tempo="+valoreTimer,
		success: function(){},
		error: function(jqXHR, exception){alert("writeOnDB dice -> " + jqXHR.responseText + "  - " + exception);}
	});
}


//============================================================================

function send(tmp){
	buttonDisable(tmp);
	writeOnDB(tmp);
}

//============================================================================

function buttonDisable(tmp) {
  	document.getElementById("r1").disabled = true;
	document.getElementById("r2").disabled = true;
	document.getElementById("r3").disabled = true;
	document.getElementById("r4").disabled = true;
	var my_element = document.getElementById("r"+tmp);
	my_element.setAttribute("class","btn btn-answer btn-blue-color ");

}

//============================================================================

function buttonEnable() {
  	document.getElementById("r1").disabled = false;
	document.getElementById("r2").disabled = false;
	document.getElementById("r3").disabled = false;
	document.getElementById("r4").disabled = false;
	var my_element = document.getElementById("r1");
	my_element.setAttribute("class","btn btn-answer");
	my_element = document.getElementById("r2");
	my_element.setAttribute("class","btn btn-answer");
	my_element = document.getElementById("r3");
	my_element.setAttribute("class","btn btn-answer");
	my_element = document.getElementById("r4");
	my_element.setAttribute("class","btn btn-answer");
}

//============================================================================
//funzione da richiamare per caricare la nuova domanda
/*function getNextQuestion() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var tmp = convertiStringaToObj(this.responseText);
			showNewQuestion(tmp);
		}
	};
	xmlhttp.open("GET", "getNext.php", true);
	xmlhttp.send();
}
*/
//============================================================================
//da la prossima domanda
function getNextQuestion(){
	//var i =0;
	//for (i = 0; i < 1000 ; i++){
		$.ajax({
			url: "./getNext.php",
			dataType: "json",
			success: function(tmp){
				//alert(tmp);
				//alert(tmp.r1 + " " + tmp.r2 + " " + tmp.r3 + " " +tmp.r4 + " " + tmp.link);
				var obj = jsonToObj(tmp);
				showNewQuestion(obj);
				if(tmp.controllo == false){
					buttonEnable();
				}else{
					buttonDisable(tmp.controllo_n);
				}
				//alert("arriva a get next");
				writeTime();
				//timerQuiz();
  				myTimer = setInterval(timerQuiz, 1000);
			},
			error: function(jqXHR, exception){
				window.location.href = './FineQuiz';
				/*alert(jqXHR.responseText + "  - " + exception);*/
			} 

		});
	//}
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

//============================================================================


function showTimer(tmp){
	if(tmp.time <= 60){
		valoreTimer = tmp.time;
		//alert(tmp.time);
		document.getElementById("timer").innerHTML = 60-tmp.time;
	}else{

		clearInterval(myTimer);
		var val = -1;
		writeOnDB(val);
		scriviSvolgimento();
		getNextQuestion();
	}
}


//============================================================================

function writeTime(){
	$.ajax({
		url: "./writeTime.php",
		success: function(){},
		error: function(jqXHR, exception){alert("writeTime dice -> "+jqXHR.responseText + "  - " + exception);} 
		
	});
}



//============================================================================


function timerQuiz(){
	$.ajax({
		url: "./timerQuiz.php",
		dataType: "json",
		success: function(tmp){
			showTimer(tmp);
		},
		error: function(jqXHR, exception){alert("timerQuiz dice -> "+jqXHR.responseText + "  - " + exception);} 
		
	});	
}
//============================================================================

function scriviSvolgimento(){
	$.ajax({
		url: "./scriviSvolgimento.php",
		success: function(){},
		error: function(jqXHR, exception){alert("scriviSvolgimento dice ->"+ jqXHR.responseText + "  - " + exception);} 
		
	});	
}

//============================================================================
//funzione jquery per test ajax e pagine php
/*$(document).ready(function(){
	
  $("#submit").click(function(){
    $.ajax({url: "getNext.php", success: function(result){
		var tmp = convertiStringaToObj(result);	
    }});
  });
  
  //timerQuiz();
  //setInterval(timerQuiz, 500);
});
*/
//============================================================================
//funzione per convertire la stringa ricevuta in un oggetto di tipo domanda.
function jsonToObj(tmp){
	
	var result = new domanda(tmp.id,tmp.domanda,tmp.r1,tmp.r2,tmp.r3,tmp.r4,tmp.link);
	return result;
}

//============================================================================
//classe domanda
function domanda(id,domanda,r1,r2,r3,r4,linkImg){
	this.id = id;
	this.domanda = domanda;
	this.r1 = r1;
	this.r2 = r2;
	this.r3 = r3;
	this.r4 = r4;
	this.linkImg = "../immagini_quiz/" + linkImg;	
}
	
//============================================================================

function showNewQuestion(d){
	//alert(d.r1);
	document.getElementById("id").innerHTML = d.id;
	document.getElementById("domanda").innerHTML = d.domanda;
	document.getElementById("r1").innerHTML = d.r1;
	document.getElementById("r2").innerHTML = d.r2;
	document.getElementById("r3").innerHTML = d.r3;
	document.getElementById("r4").innerHTML = d.r4;
	document.getElementById("question-image").src = d.linkImg;
	
}

//============================================================================

  

