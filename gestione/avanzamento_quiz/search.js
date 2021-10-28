$(document).ready(function(){
	$(".form-check-inline").change(function(){
		var selected_value = $("input[name='search-radio']:checked").val();
		if(selected_value == "search-id"){
			searchIn = 0;
			$("#search-box").attr("placeholder","Ricerca ID studente...");
		}else if(selected_value == "search-name"){
			searchIn = 1;
			$("#search-box").attr("placeholder","Ricerca nome studente...");
		}else if(selected_value == "search-istituto"){
			searchIn = 2;
			$("#search-box").attr("placeholder","Ricerca istituto...");
		}
	});
});
	
