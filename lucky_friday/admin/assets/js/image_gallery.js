$(document).ready(function(){
$('.sp').first().addClass('active');
$('.sp').hide();    
$('.active').show();

$('.sp1').first().addClass('active1');
$('.sp1').hide();    
$('.active1').show();

$('.sp2').first().addClass('active2');
$('.sp2').hide();    
$('.active2').show();

$('.sp3').first().addClass('active3');
$('.sp3').hide();    
$('.active3').show();

$('#button-next').click(function(){
$('.active').removeClass('active').addClass('oldActive');    
			   if ( $('.oldActive').is(':last-child')) {
	$('.sp').first().addClass('active');
	}
	else{
	$('.oldActive').next().addClass('active');
	}
$('.oldActive').removeClass('oldActive');
$('.sp').fadeOut();
$('.active').fadeIn();	
});

$('#button-next1').click(function(){
$('.active1').removeClass('active1').addClass('oldActive1');    
			   if ( $('.oldActive1').is(':last-child')) {
	$('.sp1').first().addClass('active1');
	}
	else{
	$('.oldActive1').next().addClass('active1');
	}
$('.oldActive1').removeClass('oldActive1');
$('.sp1').fadeOut();
$('.active1').fadeIn();	
});

$('#button-next2').click(function(){
$('.active2').removeClass('active2').addClass('oldActive2');    
			   if ( $('.oldActive2').is(':last-child')) {
	$('.sp2').first().addClass('active2');
	}
	else{
	$('.oldActive2').next().addClass('active2');
	}
$('.oldActive2').removeClass('oldActive2');
$('.sp2').fadeOut();
$('.active2').fadeIn();	
});

$('#button-next3').click(function(){
$('.active3').removeClass('active3').addClass('oldActive3');    
			   if ( $('.oldActive3').is(':last-child')) {
	$('.sp3').first().addClass('active3');
	}
	else{
	$('.oldActive3').next().addClass('active3');
	}
$('.oldActive3').removeClass('oldActive3');
$('.sp3').fadeOut();
$('.active3').fadeIn();	
});



$('#button-previous').click(function(){
$('.active').removeClass('active').addClass('oldActive');    
	   if ( $('.oldActive').is(':first-child')) {
	$('.sp').last().addClass('active');
	}
	   else{
$('.oldActive').prev().addClass('active');
	   }
$('.oldActive').removeClass('oldActive');
$('.sp').fadeOut();
$('.active').fadeIn();
});

$('#button-previous1').click(function(){
$('.active1').removeClass('active1').addClass('oldActive1');    
	   if ( $('.oldActive1').is(':first-child')) {
	$('.sp1').last().addClass('active1');
	}
	   else{
$('.oldActive1').prev().addClass('active1');
	   }
$('.oldActive1').removeClass('oldActive1');
$('.sp1').fadeOut();
$('.active1').fadeIn();
});

$('#button-previous2').click(function(){
$('.active2').removeClass('active2').addClass('oldActive2');    
	   if ( $('.oldActive2').is(':first-child')) {
	$('.sp2').last().addClass('active2');
	}
	   else{
$('.oldActive2').prev().addClass('active2');
	   }
$('.oldActive2').removeClass('oldActive2');
$('.sp2').fadeOut();
$('.active2').fadeIn();
});

$('#button-previous3').click(function(){
$('.active3').removeClass('active3').addClass('oldActive3');    
	   if ( $('.oldActive3').is(':first-child')) {
	$('.sp3').last().addClass('active3');
	}
	   else{
$('.oldActive3').prev().addClass('active3');
	   }
$('.oldActive3').removeClass('oldActive3');
$('.sp3').fadeOut();
$('.active3').fadeIn();
});


});