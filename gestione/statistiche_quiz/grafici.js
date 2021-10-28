/***************************** file per la gestione dei grafici in statisticheQuiz.php *****************************/

// definizioni grafici
var ctx1 = document.getElementById('graficoDomande').getContext('2d');	//grafico 1 (domande + giuste)

/******************************************* configurazione grafici *********************************************/

// configurazione grafico 1: domande + giuste

function makeArrayToSplit(num){
	var i = 0;
	var a = "Domanda " + (i + 1);
	
	for(i=1;i<num;i++){
		a += ";Domanda " + (i + 1);
	}
	
	return a;
}

function getLabels(){
	var str;
	
	$.ajax({
		url: "getLabels.php",
		type: "POST",
		data: [],
		success: function(response){
			str = makeArrayToSplit(response);
		}
	});
	alert(str);
	return str;
}

var labels = getLabels();
var arrayLabels = labels.split(";");

var graficoDomande = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Percentuale risposte corrette date ad ogni domanda',
            data: [1,2,3],
            backgroundColor: ['#009423'],
        }]
    },
    options: {
    	aspectRatio: 3,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


