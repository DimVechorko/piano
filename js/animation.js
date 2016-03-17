function volna1(){
    $("#volna_one").addClass("animated zoomIn");
	setTimeout('$("#volna_one").removeClass("animated zoomIn")',2000);
}
function volna2(){
    $("#volna_two").addClass("animated zoomIn");
	setTimeout('$("#volna_two").removeClass("animated zoomIn")',2000);
}
function volna3(){
    $("#volna_three").addClass("animated zoomIn");
	setTimeout('$("#volna_three").removeClass("animated zoomIn")',2000);
}
function view_play(){setInterval('volna1()',2400);}
function view_play2(){setInterval('volna2()',2400);}
function view_play3(){setInterval('volna3()',2400);}

function animation(){
	view_play();
	setTimeout('view_play2()',300);		
	setTimeout('view_play3()',600);		
}

function play_animation(){
	setTimeout('animation()',8000);
}