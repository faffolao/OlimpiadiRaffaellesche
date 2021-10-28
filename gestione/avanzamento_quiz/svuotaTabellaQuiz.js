$(document).ready(function(){
   $("#svuotaTabellaQuiz").click(function(){
      if(confirm("Desideri svuotare il contenuto delle tabelle dei risultati del quiz?")){
        $.ajax({
           url: "../utility/azzeraRisultatiQuiz.php",
           type: "POST",
           data: "cancellazione=true",
           success: function(response){
             PNotify.success({
                     text: "Le tabelle dei risultati del quiz sono state svuotate.",
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
                     text: "Impossibile svuotare le tabelle dei risultati quiz, controlla il log per ulteriori informazioni.",
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
   });
});
