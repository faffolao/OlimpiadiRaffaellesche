$(document).ready(function(){
	$("#svuotaImmaginiQuiz").click(function(){
		if(confirm("Desideri svuotare la cartella contenente le immagini associate alle domande? \nÉ consigliato eseguire questa " +
				"operazione solo se sono presenti immagini che non sono associate a nessuna domanda per evitare degli errori. " +
				"\nPuoi controllare le immagini delle domande nella pagina Gestione domande.")){
			$.ajax({
				url: "action_flushImmaginiQuiz.php",
				type: "POST",
				data: {confirm: "yes"},
				success: function(response){
					PNotify.success({
						text: "La cartella delle immagini quiz è stata svuotata.",
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

function updateAI(table_name){
	$.ajax({
		url: "action_editAI.php",
		type: "POST",
		data: {table: table_name, value: $("#AI_" + table_name).val()},
		success: function(response){
			PNotify.success({
				text: "Auto increment della tabella " + table_name + " modificato.",
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