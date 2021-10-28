$(document).ready(function(){
	// pulsante apertura 
	$("#openquizbtn").click(function(){
		if(confirm("Desideri aprire immediatamente il quiz?")){
			$.ajax({
				url: "action_managequiz.php",
				type: "POST",
				data: {type: "open"},
				success: function(response){
					PNotify.success({
						text: "Il quiz è stato aperto.",
						delay: 4000,
						module: {
							Mobile:{
								swipeDismiss:true,
								styling:true
							}
						}
					});
					
					setQuizState("open");
				}
			});
		}
	});
	
	// pulsante avvio
	$("#startquizbtn").click(function(){
		if(confirm("Desideri aprire e avviare immediatamente il quiz?")){
			$.ajax({
				url: "action_managequiz.php",
				type: "POST",
				data: {type: "start"},
				success: function(response){
					PNotify.success({
						text: "Il quiz è stato aperto e avviato.",
						delay: 4000,
						module: {
							Mobile:{
								swipeDismiss:true,
								styling:true
							}
						}
					});
					
					setQuizState("start");
				}
			});
		}
	});
	
	//pulsante chiusura
	$("#endquizbtn").click(function(){
		if(confirm("Desideri chiudere immediatamente il quiz?")){
			$.ajax({
				url: "action_managequiz.php",
				type: "POST",
				data: {type: "end"},
				success: function(response){
					PNotify.success({
						text: "Il quiz è stato chiuso.",
						delay: 4000,
						module: {
							Mobile:{
								swipeDismiss:true,
								styling:true
							}
						}
					});
					
					setQuizState("end");
				}
			});
		}
	});
});

function setQuizState(state){
	if(state == "open"){
		$("#quizStateImg").attr("src", "img/yes.svg");
		$("#quizState").text("APERTO");
	}else if(state == "start"){
		$("#quizStateImg").attr("src", "img/yes.svg");
		$("#quizState").text("AVVIATO");
	}else if(state == "end") {
		$("#quizStateImg").attr("src", "img/no.svg");
		$("#quizState").text("CHIUSO");
	}
}