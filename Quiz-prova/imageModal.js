$(document).ready(function(){
	$("#question-image").click(function(){
		var src = $(this).attr("src");
		showModal(src);
	});
	
	$("#image-modal span").click(function(){
		$("#image-modal").hide();
	})
});

function showModal(imgSrc){
	$("#modal-image").attr("src",imgSrc);
	$("#image-modal").show();
}