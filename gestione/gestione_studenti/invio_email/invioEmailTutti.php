<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Invio delle mail a tutti gli studenti...</title>
        <META name="viewport" content="width=device-width, initial-scale=1.0" />
	<LINK rel="icon" href="../../../img/logo_black.png">
        
        <!-- inizio importazione bootstrap e jquery -->
	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>
	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>
	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">
	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>
	<!-- fine importazione bootstrap e jquery-->
        
    <LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        
        <style>
            @font-face{
                font-family: Butler;
                src: url("../../../res/Butler.woff");
            }
            body{font-family: Nunito, sans-serif;}
            h1{font-family: Butler, sans-serif;}
            
            .success{color: green;}
            .failed{color: red; font-weight: bold;}
        </style>
    </head>
    <body>
        <div class="container">
            <img src="../../../img/logo_black.png" width="40">
            <h1>Invio mail agli studenti</h1>
            <div>
				<ol id = "inviateElenco">
				
				</ol>
				
				
			</div>
            
            <button class="btn btn-primary" onclick="window.close()">Chiudi finestra</button>
            <br><br><br><br>
        </div>
    </body>
		<script>
			
			getDati();

			
			function ascii_to_hexa(str){
				var arr1 = [];
				for (var n = 0, l = str.length; n < l; n ++) {
					var hex = Number(str.charCodeAt(n)).toString(16);
					arr1.push(hex);
				}
					return arr1.join('');
			}
			
			function getDati(){
				$.ajax({
					url: "./getDati.php",
					success: function(listaEmail){
						//console.log(o);
						var i;
						
						for( i = 0; i < listaEmail.length; i++ ){
							//conversione da ascii a hex
							username = listaEmail[i][0];
							password = listaEmail[i][1];
							email1 = listaEmail[i][2];
							email2 = listaEmail[i][3];

							password = ascii_to_hexa(password);
							username = ascii_to_hexa(username);
							//inviaEmail(username,password,email1,email2);
							setTimeout(inviaEmail, i*5000, username, password, email1, email2);
							console.log(i +")timeout impostato a  " + i*5000);
						}
						
					},
					type: "post",
					data: "robot=1",
					dataType: "JSON",
					error: function(jqXHR, exception){alert("getEmail dice -> "+jqXHR.responseText + "  - " + exception);} 

				});
			}
			
			
			function prova(username, password, email1, email2){
				$( "#inviateElenco" ).append(email1 + " " + email2 + " " + username + " " + password + "<br>");
			}
			
			
			function inviaEmail(username,password,email1,email2){
				$.ajax({
					url: "./invioEmailStudente.php",
					success: function(){
						
						console.log("email inviata correttamente a "+email1+" e "+email2);
						$( "#inviateElenco" ).append( "<li class='success' >Email inviata correttamente a "+email1+" e "+email2+"</li>" );
					},
					type: "post",
					data: "robot=1&username="+username+"&password="+password+"&email1="+email1+"&email2="+email2,
					
					error: function(jqXHR, exception){
						
						console.log("email NON inviata a "+email1+" e "+email2);
						$( "#inviateElenco" ).append( "<li class='failed' >Email NON inviata a "+email1+" e "+email2+"</li>" );
						
					} 

				});
			}
			
			
			
		</script>
		
		
		
</html>
