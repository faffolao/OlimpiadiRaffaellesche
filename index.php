<?php 
    require "db_con.php";
    $result = $conn->query("SELECT informazioni, informazioniAttive FROM settings");
    $rules = $result->fetch_assoc();
?>
<!--Home page delle olimpiadi raffaellesche / index.php-->
<!doctype html>


<HTML>

<HEAD>
	

	<META CHARSET="utf-8">

	<TITLE>Olimpiadi Raffaellesche</TITLE>

	<META name="viewport" content="width=device-width, initial-scale=1.0" />

	<LINK rel="icon" href="img/logo_black.png">

	<!-- importazione pnotify -->
	<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>	
	<link href="https://unpkg.com/pnotify@4.0.0/dist/PNotifyBrightTheme.css" rel="stylesheet">
	<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyMobile.js"></script>
	<!-- fine importazione pnotify -->
		

	<!-- inizio importazione bootstrap e jquery -->

	<SCRIPT src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></SCRIPT>

	<SCRIPT src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" INTEGRITY="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" CROSSORIGIN="anonymous"></SCRIPT>

	<LINK rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" INTEGRITY="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" CROSSORIGIN="anonymous">

	<SCRIPT src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" INTEGRITY="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" CROSSORIGIN="anonymous"></SCRIPT>

	<!-- fine importazione bootstrap e jquery-->

	

	<!-- inizio importazione stili e script personali -->

	<LINK href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

	<LINK rel="stylesheet" href="res/index.css">

	<LINK rel="stylesheet" href="res/buttons.css">
	<link rel="stylesheet" href="res/modale.css">
	<!-- fine importazione stili e script personali-->
	<script src="res/indexOlimpiadi.js"></script>
	<script>
	function opzioniDiv(){
		<?php unset($_SESSION['msgClass']); ?>
		$("#msg").hide();

	}
	</script>
	<style>

	</style>
</HEAD>



<!--<script type="text/javascript" src="https://nibirumail.com/docs/scripts/nibirumail.cookie.min.js"></script>-->

<BODY>

	

	<video autoplay loop muted>

		<source src="res/index_home.mp4" type="video/mp4">

		<source src="res/index_home.webm" type="video/webm">

	</video>

	<DIV class="container-fluid" id="main-div">

   	

      <DIV  class="float-right">

      		<DIV class="container">

              <UL class="nav">

						<?php 

							session_start();
				  			
							$session_name = "qruser";
				  			if(isset($_SESSION['ND'])) {
								unset($_SESSION['ND']);
							}
				  
							if(!isset($_SESSION[$session_name])) {

								  echo "<a class='button' href='./login'> Nessun utente loggato<br>Clicca qui per accedere </a>";

							} else {

								$user = json_decode($_SESSION[$session_name], true);

								echo "<button class='btn button dropdown-toggle' type='button' data-toggle='dropdown'> Utente connesso: " . $user['username'] . " <span class='caret'></span></button>";

									echo  '<div class="dropdown-menu">

											<A class="dropdown-item" href="./Logout">Logout</A>

											</div>';

							}

					?>



              </UL>

            </DIV>

		</DIV>

		<DIV class="middle">
	    <?php if(isset($_SESSION['msgClass'])): ?>
   		   <div onClick="opzioniDiv()" id="msg" class="text-center alert <?php echo $_SESSION['msgClass']; ?>"><?php echo $_SESSION['text']; ?></div>
     	<?php endif; ?>
			
			<IMG src="res/logo_big.png" class="img-responsive" alt="Logo olimpiadi raffaellesche"><BR><BR>

			

         

         <div class="container">

            <div class="row">

               

               <!-- <div class="col-sm-4">

                  <BUTTON onClick="window.location='./registrati/'" class="bottone"/>Iscriviti</BUTTON>

               </div> -->

               <div class="col-sm-6">
					
				   <?php 

				   			
							$session_name = "qruser";
				   			
							if(!isset($_SESSION[$session_name])) {
								echo "<BUTTON onClick=\"window.location='./login/'\" class=\"bottone\">Accedi</BUTTON>";
							} else {
								//echo "tipo utente = " . $user["tipoutente"];
							    if($user["tipoUtente"] == 0)
							        echo "<button onClick=\"toggleFullScreen();window.location.href = 'attesa/'\" class='bottone' type='button'>Quiz</button>";
								
							    else
							        echo "<button onClick=\"window.location='gestione/'\" class='bottone' type='button'>Gestione</button>";
							}
					?>
                  			<!--<BUTTON onClick="window.location='./login/'" class="bottone"/>Accedi</BUTTON>-->

               </div>

               <div class="col-sm-6">

                  <BUTTON onClick="visualizzaOverlay()" class="bottone"/>About</BUTTON>

               </div>

            </div>

         </div>

         

		</DIV>

		<DIV class="bottomleft">

                    <P><IMG src="img/logo.png" width="22"> • di <a href="https://www.instagram.com/fedyardu/">F. Arduini</a>, <a href="https://www.instagram.com/rei_il_mitico_rocco/">R. Nori</a>, <a href="https://www.instagram.com/martin_bera9/">M. Berardi</a>, <a href="https://www.instagram.com/andrealobuglio/">Andrea L.B.</a>, <a href="https://www.instagram.com/c.chris_01/">C. Chiuselli</a>, <a href="https://www.instagram.com/f3lixd_/">F. Sani</a> e <a href="https://www.instagram.com/lorenzoannibalini/">L. Annibalini</a> • © 2019-20</P>

		</DIV>

		<DIV class="bottomright">

			<P>Powered by <IMG src="img/itislogo.png" width="32"></P>

		</DIV>

		<DIV class="left-bottom">

			<P><IMG src="img/logo.png" width="22"> • Powered by <IMG src="img/itislogo.png" width="32"></P>

		</DIV>

	</DIV>

	<DIV class="containter-fluid" id="div-overlay">

		<DIV class="middle-top">

			<IMG src="img/logo_black.png" width="60">

			<HR width="70%">

			<H1>Informazioni sulle Olimpiadi Raffaellesche</H1><BR>

			<DIV class="text-center">

				<IMG src="img/raffaello.jpg" class="img-responsive"><BR><BR>

				<P>Olimpiadi Raffaellesche<BR>di <a href="https://www.instagram.com/fedyardu/">Federico Arduini</a>, <a href="https://www.instagram.com/rei_il_mitico_rocco/">Rocco Nori</a>, <a href="https://www.instagram.com/martin_bera9/">Martin Berardi</a>, <a href="https://www.instagram.com/andrealobuglio/">Andrea Lo Buglio</a>, <a href="https://www.instagram.com/c.chris_01/">Christian Chiuselli</a>, <a href="https://www.instagram.com/f3lixd_/">Filippo Sani</a> e <a href="https://www.instagram.com/lorenzoannibalini/">Lorenzo Annibalini</a> delle classi 5A-IN, 5B-IN, 4B-IN dell'ITIS Enrico Mattei di Urbino - PU<BR>Versione 2.0<BR>Copyright &copy; 2019-20</P>

				

				<!-- <P>Video in sottofondo <EM>Urbino timelapse</EM> a cura di <A href="https://www.youtube.com/channel/UCeidLkjAQvCerVOb4Wy548w">Towelcity Timelapse</A></P> -->
				<p>Logo disegnato dagli studenti della <a href="https://www.scuolalibrourbino.edu.it/">Scuola del Libro di Urbino</a></p>
			</DIV>

			

			

			<BR><BR><BUTTON onClick="chiudiOverlay()" class="btn btn-outline-dark">Chiudi</BUTTON><BR><BR>

		</DIV>

	</DIV>
    
    <div id="info2-modal" class="modal">
    	<div class="modal-contenuto">
    		<span id="modale-info" onclick="$('#info2-modal').hide();" class="close">&times;</span>
            <h2>Informazioni</h2>
            <?php echo $rules['informazioni']; ?>
    	</div>
    </div>
	

    <!--<SCRIPT type="text/javascript">var nibirumail_advice_text = 'Il sito olimpiadiraffaellesche utilizza i cookie, Leggi la nostra <a href="https://nibirumail.com/cookies/policy/?url=quizzoneraffaellesco.altervista.org" target="_blank">cookie policy</a>.<br> <a href="javascript:;" class="nibirumail_agreement"><b>Ho capito e accetto<b></a>';</SCRIPT>

    <SCRIPT type="text/javascript" src="https://nibirumail.com/docs/scripts/nibirumail.cookie.min.js"></SCRIPT>-->
	<?php if($rules['informazioniAttive'] == 1): ?>
    	<script>
    		$(document).ready(function(){
        		$("#info2-modal").show();		
        	});
    	</script>
    <?php endif; ?>
</BODY>

</HTML>

