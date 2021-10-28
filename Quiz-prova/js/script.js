setInterval(getQuestion, 500);
function getQuestion(){
	$.ajax({
		url: "./controllo_attivo.php",
		dataType: "json",
		success: function(tmp){
			if(tmp.finito){ window.location.href="FineQuiz/" }
			if(tmp.da_caricare){ showNewQuestion(jsonToObj(tmp)); }
			showTimer(tmp.tempo);
			
			if(tmp.controllo == false){
				buttonEnable();
			}else{
				buttonDisable(tmp.controllo_n);
			}
			

		},
		error: function(jqXHR, exception){
			//alert(jqXHR.responseText + "  - " + exception);
		} 
	});
}

function writeOnDB(tmp){
	$.ajax({
		url: "./WriteOnDB.php?risp="+tmp,
		success: function(){},
		error: function(jqXHR, exception){/*alert("writeOnDB dice -> " + jqXHR.responseText + "  - " + exception);*/}
	});
}

function send(tmp){
	buttonDisable(tmp);
	writeOnDB(tmp);
}

function showNewQuestion(d){
	document.getElementById("id").innerHTML = d.id;
	document.getElementById("domanda").innerHTML = d.domanda;
	document.getElementById("r1").innerHTML = d.r1;
	document.getElementById("r2").innerHTML = d.r2;
	document.getElementById("r3").innerHTML = d.r3;
	document.getElementById("r4").innerHTML = d.r4;
	document.getElementById("question-image").src = d.linkImg;
}

function domanda(id,domanda,r1,r2,r3,r4,linkImg){
	this.id = id;
	this.domanda = domanda;
	this.r1 = r1;
	this.r2 = r2;
	this.r3 = r3;
	this.r4 = r4;
	this.linkImg = "../immagini_quiz/" + linkImg;	
}

function jsonToObj(tmp){	
	var result = new domanda(tmp.id,tmp.domanda,tmp.r1,tmp.r2,tmp.r3,tmp.r4,tmp.link);
	return result;
}

function showTimer(tempo){
	if(tempo <= 60){ document.getElementById("timer").innerHTML = 60-tempo; }
}

function buttonDisable(tmp) {
  	document.getElementById("r1").disabled = true;
	document.getElementById("r2").disabled = true;
	document.getElementById("r3").disabled = true;
	document.getElementById("r4").disabled = true;
	var my_element = document.getElementById("r"+tmp);
	my_element.setAttribute("class","btn btn-answer btn-blue-color ");

}

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