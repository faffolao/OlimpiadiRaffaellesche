function visualizzaOverlay(){

	$("#div-overlay").fadeIn(250);

}

function chiudiOverlay(){

	$("#div-overlay").fadeOut(250);

}

function verificaQuiz(){
	$.ajax({
		url: "./attesa/verificaQuiz.php",
		dataType: "json",
		success: function(risposta){
			if(!risposta.aperto){
				PNotify.error({
					title: "Stato Del Quiz:",
					text: risposta.text,
					delay: 4000,
					module:{
						Mobile:{
							swipeDismiss:true,
							styling:true
						}
					}
				});
			}
		},
		error: function(){window.location.href = "attesa/";}//function(jqXHR, exception){alert(jqXHR.responseText + "  - " + exception);}  
	});
}
	
/*var elem = document.documentElement;
		function openFullscreen() {
			
			if (elem.requestFullscreen) {
				elem.requestFullscreen();
			} else if (elem.mozRequestFullScreen) { /* Firefox */
				/*elem.mozRequestFullScreen();
			} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
				/*elem.webkitRequestFullscreen();
			} else if (elem.msRequestFullscreen) { /* IE/Edge */
				/*elem.msRequestFullscreen();
			} 
		}
*/
function toggleFullScreen() {
  var doc = window.document;
  var docEl = doc.documentElement;

  var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
  var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

  if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
	requestFullScreen.call(docEl);
  }
  else {
	cancelFullScreen.call(doc);
  }
}

		

	/*function closeFullscreen() {
		if (document.exitFullscreen) {
			document.exitFullscreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitExitFullscreen) {
			document.webkitExitFullscreen();
		} else if (document.msExitFullscreen) {
			document.msExitFullscreen();
		}
	}*/

	/*$('html').bind('keypress', function(e)
		{
	   if(e.keyCode == 122)
	   {
		  return false;
	   }
	});*/


