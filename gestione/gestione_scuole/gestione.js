$(document).ready(function(){
	$(".form-check-inline").change(function(){
		var selected_value = $("input[name='search-radio']:checked").val();
                if(selected_value == "search-codmeccanografico"){
                        searchIn = 0;
			$("#search-box").attr("placeholder","Ricerca codice meccanografico...");
                }else if(selected_value == "search-schoolname"){
			searchIn = 1;
			$("#search-box").attr("placeholder","Ricerca nome scuola...");
		}else if(selected_value == "search-comune"){
			searchIn = 5;
			$("#search-box").attr("placeholder","Ricerca comune...");
		}else if(selected_value == "search-provincia"){
			searchIn = 6;
			$("#search-box").attr("placeholder","Ricerca provincia...");
		}
	});
	
	
	$("#addSchoolBtn").click(function(){
		$("#addSchoolModal").show();
	});
	
	$("#editBtn").click(function(){
		var row = $("#" + selectedId);
		
                var cod_meccanografico = row.find(".td-cod-meccanografico").text();
		var nomeScuola = row.find(".td-nome-scuola").text();
		var via = row.find(".td-via").text();
		var nCivico = row.find(".td-nCivico").text();
		var cap = row.find(".td-cap").text();
		var nomeComune = row.find(".td-nomeComune").text();
		var provincia = row.find(".td-provincia").text();
		
                $("#old-cod_meccanografico").val(cod_meccanografico);			
                $("#old-nome").val(nomeScuola);
		$("#old-via").val(via);
		$("#old-nCivico").val(nCivico);
		$("#old-cap").val(cap);
		$("#old-nomeComune").val(nomeComune);
		$("#old-provincia").val(provincia);
		$("#edit_cod_meccanografico").val(selectedId);
		
		$("#editSchoolModal").show();
	});
	
	$("#deleteBtn").click(function(){
		if(confirm("ATTENZIONE: cancellando la scuola selezionata verranno automaticamente eliminati anche gli studenti che ne fanno parte.")){
			$.ajax({
				url: "action_removeSchool.php",
				type: "POST",
				data: {cod_meccanografico: selectedId},
				success: function(response){
					location.reload();
				}
			});
		}
	});
        
        $("#importSchool").click(function(){
           $("#importSchoolModal").show();
        });
        
        $("#closeImportModalBtn").click(function(){
            $("#importSchoolModal").hide();
        });
});

function chiudiModale(id){
	$("#" + id).hide();
}