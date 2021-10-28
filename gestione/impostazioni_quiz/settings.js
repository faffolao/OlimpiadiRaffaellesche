$(document).ready(function(){
	$("#btn_apri_regolamento").click(function(){
		$("#show_regolamento_modal").show();
	});
	
	$("#btn_modifica_regolamento").click(function(){
		window.location = "modifica_regolamento/";
	});
	
	$("#btn_apri_informazioni").click(function(){
		$("#show_informazioni_modal").show();
	});
	
	$("#btn_modifica_informazioni").click(function(){
		window.location = "modifica_informazioni/";
	});
	/**************cambiamento testi*************/
	
	$("#quiz_name").on("keyup paste", function(){
		$("#edit_nome").removeAttr("disabled");
	});
	
	/**********************/
	
	$("#data_apertura").on("keyup paste change", function(){
		$("#edit_orario").removeAttr("disabled");
	});
	
	$("#orario_inizio").on("keyup paste change", function(){
		$("#edit_orario").removeAttr("disabled");
	});
	
	$("#orario_fine").on("keyup paste change", function(){
		$("#edit_orario").removeAttr("disabled");
	});
	
	/****************/
	
	$("#iscrizioni_aperte").on("change",function(){
		if(this.checked){
			$("#iscrizioni_lbl").text("Info Abilitate");
			apriIscrizioni();
		}else if(!this.checked){
			$("#iscrizioni_lbl").text("Info Disattivate");
			chiudiIscrizioni();
		}
	});
	
	$("#beta_aperta").on("change",function(){
		if(this.checked){
			$("#beta_lbl").text("Beta Sito Attivata");
			apriBeta();
		}else if(!this.checked){
			$("#beta_lbl").text("Beta Sito Disattivata");
			chiudiBeta();
		}
	});
	
	$("#informazioni_attive").on("change",function(){
		if(this.checked){
			$("#informazioni_lbl").text("Informazioni Generali Attivate");
			attivaInfo();
		}else if(!this.checked){
			$("#informazioni_lbl").text("Informazioni Generali Disattivate");
			disattivaInfo();
		}
	});
	
	
	/********** salva cambiamenti **********/
	$("#edit_nome").click(function(){
		disableBtn("edit_nome");
		
		$.ajax({
			url: 'action_editQuizName.php',
			type: 'POST',
			data: {newName: $("#quiz_name").val()},
			success: function(response){
				PNotify.success({
					text: "Nome del quiz modificato in '" + $("#quiz_name").val() + "'",
					delay: 4000,
					module: {
						Mobile:{
							swipeDismiss:true,
							styling:true
						}
					}
				});
				enableBtn("edit_nome");
			}
		});
	});
	
	$("#edit_orario").click(function(){
		if(controlloDate()){
			disableBtn("edit_orario");

			$.ajax({
				url: 'action_editOrari.php',
				type: 'POST',
				data: {
					dataApertura: $("#data_apertura").val(),
					oraInizio: $("#orario_inizio").val(),
					oraFine: $("#orario_fine").val()
				},
				success: function(response){
					aggiorna_orario();
					PNotify.success({
						text: "Le date del quiz sono state modificate correttamente.",
						delay: 4000,
						module: {
							Mobile:{
								swipeDismiss:true,
								styling:true
							}
						}
					});
					enableBtn("edit_orario");
				}
			});
			
			

		}else{
			PNotify.error({
				text: "Le date del quiz inserite non sono valide. Controllare che l'ora di inizio non sia minore dell" + 
						"'ora di fine e viceversa, e che i due orari non coincidono.",
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

	function aggiorna_orario(){
		$.ajax({
			url: 'avanzate/action_aggiorna.php',
			success: function(){
				
			}
		});
	}
        
        $("#svuotaRisultati").click(function(){
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



function closeModal(id){
	$("#" + id).hide();
}

function disableBtn(id){
	$('#' + id).attr("disabled","true").html('<span class="spinner-border spinner-border-sm"></span>  Attendere');
}

function enableBtn(id){
	$('#' + id).removeAttr("disabled").html('Salva');
}

function apriIscrizioni(){
	$.ajax({
		url: 'action_manageIscrizioni.php',
		type: 'POST',
		data: {
			aperte: "true"
		},
		success: function(response){
			PNotify.success({
				text: "Le info sono state attivate.",
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

function chiudiIscrizioni(){
	$.ajax({
		url: 'action_manageIscrizioni.php',
		type: 'POST',
		data: {
			aperte: "false"
		},
		success: function(response){
			PNotify.success({
				text: "Le info sono state disattivate.",
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

function apriBeta(){
	$.ajax({
		url: 'action_manageBeta.php',
		type: 'POST',
		data: {
			aperte: "true"
		},
		success: function(response){
			PNotify.success({
				text: "La beta e' stata attivata.",
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

function chiudiBeta(){
	$.ajax({
		url: 'action_manageBeta.php',
		type: 'POST',
		data: {
			aperte: "false"
		},
		success: function(response){
			PNotify.success({
				text: "La beta e' stata disattivata.",
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

function attivaInfo(){
	$.ajax({
		url: 'action_manageInfo.php',
		type: 'POST',
		data: {
			aperte: "true"
		},
		success: function(response){
			PNotify.success({
				text: "Le informazioni generali sono state attivate.",
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

function disattivaInfo(){
	$.ajax({
		url: 'action_manageInfo.php',
		type: 'POST',
		data: {
			aperte: "false"
		},
		success: function(response){
			PNotify.success({
				text: "Le informazioni generali sono state disattivate.",
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

function controlloDate(){
	var dtInizio = moment($("#orario_inizio").val(), "HH:mm");
	var dtFine = moment($("#orario_fine").val(), "HH:mm");
	var giusto = false;

	if (dtInizio < dtFine){
		giusto = true;
	}
	
	return giusto;
}