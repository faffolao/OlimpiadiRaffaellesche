<?php
    $dir = '../img/';
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                $path = '../img/' . $file;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                echo "<h1>" . $file ."</h1>";
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		echo "<img class='images' draggable='false' src=" . $base64 . "></img> <br>";
                echo $base64;
		echo "<script>
			var elem = document.getElementsByClassName('images');
			var i;
			for(i=0;i<elem.length;i++) {
				elem[i].addEventListener('contextmenu', function(event){
					event.preventDefault();
					alert('Cosa vorresti fare?? BECCATO!!! :-('); 
					return false;
				});
				elem[i].addEventListener('mousedown', function(event) {
					alert('Perché vorresti trascinare questa immagine?? BECCATO!!! :-(');
					return false;
				}); 
			}
			</script>";
            }
        }
        closedir($handle);
    }
    
?>
