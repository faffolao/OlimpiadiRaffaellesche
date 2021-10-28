$(document).ready(function(){
	$(".form-check-inline").change(function(){
		var selected_value = $("input[name='search-radio']:checked").val();
		if(selected_value == "search-username"){
			searchIn = 0;
			$("#search-box").attr("placeholder","Ricerca username...");
		}else{
			searchIn = 1;
			$("#search-box").attr("placeholder","Ricerca istituto...");
		}
	});
});