$(document).ready(function(){
    check();
    setInterval(check, 2000);
})

function check(){
    $.ajax({
        url: "getAvanzamentoQuiz.php",
        type: "POST",
        dataType: "json",
        success: function(response){
            for(i=0;i<response.length;i++){
                document.getElementById("s-" + response[i].id_studente + ".d-" + response[i].id_domanda).childNodes[0].src='../img/yes.svg';
            }
        }
    })
}

