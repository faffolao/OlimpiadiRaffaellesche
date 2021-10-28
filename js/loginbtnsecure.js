/* questo script serve per risolvere un bug nell'autenticazione a due fattori e a rendere il login
più sicuro */

$(document).ready(function(){
	$('form').one('submit', function() {
		$('form button').attr("disabled","true").html('<span class="spinner-border spinner-border-sm"></span>  Attendere');
	});
});
