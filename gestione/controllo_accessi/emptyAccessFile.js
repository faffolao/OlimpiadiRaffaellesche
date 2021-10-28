/* script per svuotare il contenuto del file json degli accessi */
function svuotaAccessi(){
    if(confirm("Verrà svuotato il file JSON degli accessi.")){
        $.ajax({
           url: "action_emptyAccessFile.php",
           type: "POST",
           data: "confirm=true",
           success: function(response){
               location.reload();
           }
        });
    }
}