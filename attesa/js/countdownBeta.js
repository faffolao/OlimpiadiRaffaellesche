$(document).ready(function(){
	var tmp = false;
	$('#modale-info').on("click", function(){
		if(!(tmp)){
			tmp = true;
			$('#info-modal').hide(); 
			var time = 60;
			var x = setInterval(function(){
				document.getElementById("time").innerHTML = " " + time + " Secondi/o ";
				time = time - 1;
				
				if(time <= 0){
					clearInterval(x);
					window.location.href = "../Quiz/";
				}
			}, 1000);
		}
	});
});	