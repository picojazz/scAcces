$(document).ready(function() {

    $('select').material_select();

    $('.signup').click(function () {
    	$(".tabs").removeClass("blue").addClass(" brown lighten-1");
    	$("body").css("backgroundColor","#8d6e63");
    });
    $('.signin').click(function () {
    	$(".tabs").removeClass(" brown lighten-1").addClass("blue")
    	$("body").css("backgroundColor","#3498db");
    });
    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });
    
});
