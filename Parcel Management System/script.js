$("#menu-links li a").on('click',function(e){
    $("#menu-links .selected").removeClass('selected');
    $(this).addClass('selected');
    e.preventDefault;
});

$('nav li a').filter(function(){
    return this.href === location.href;
}).addClass('active');

$(document).ready(function(){
    $('.toggle').click(function(){
        $('.sidebar').toggleClass('close')
    });
});

$(document).ready(function(){
    $('.nav-link').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
    });
});

$(document).ready(function(){

	$('#contact_num').bind('paste', function(e){
		return false;
	});

});

$(document).ready(function(){

	$('#zipcode').bind('paste', function(e){
		return false;
	});

});

$(document).ready(function(){

	$('#sender_contact_number').bind('paste', function(e){
		return false;
	});

});

$(document).ready(function(){

	$('#recipient_contact_number').bind('paste', function(e){
		return false;
	});

});

$(document).ready(function(){

	$('#quantity').bind('paste', function(e){
		return false;
	});

});
