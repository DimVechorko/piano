function reset1(){
	$('.left_brend').removeClass("activ");
	$('.right_brend').removeClass("activ");
	$('.galka').removeClass("block");
	$('.left_brend').addClass("no_activ");
	$('.right_brend').addClass("no_activ");
	$('.galka').addClass("none");	
}

function brend1(){reset1();$('#brd1').removeClass("no_activ");$('#brd1').addClass("activ");	$('#g1').removeClass("none");$('#g1').addClass("block");}
function brend2(){reset1();$('#brd2').removeClass("no_activ");$('#brd2').addClass("activ");	$('#g2').removeClass("none");$('#g2').addClass("block");}
function brend3(){reset1();$('#brd3').removeClass("no_activ");$('#brd3').addClass("activ");	$('#g3').removeClass("none");$('#g3').addClass("block");}
function brend4(){reset1();$('#brd4').removeClass("no_activ");$('#brd4').addClass("activ");	$('#g4').removeClass("none");$('#g4').addClass("block");}
function brend5(){reset1();$('#brd5').removeClass("no_activ");$('#brd5').addClass("activ");	$('#g5').removeClass("none");$('#g5').addClass("block");}
function brend6(){reset1();$('#brd6').removeClass("no_activ");$('#brd6').addClass("activ");	$('#g6').removeClass("none");$('#g6').addClass("block");}
function brend7(){reset1();$('#brd7').removeClass("no_activ");$('#brd7').addClass("activ");	$('#g7').removeClass("none");$('#g7').addClass("block");}
function brend8(){reset1();$('#brd8').removeClass("no_activ");$('#brd8').addClass("activ");	$('#g8').removeClass("none");$('#g8').addClass("block");}
function brend9(){reset1();$('#brd9').removeClass("no_activ");$('#brd9').addClass("activ");	$('#g9').removeClass("none");$('#g9').addClass("block");}
function brend10(){reset1();$('#brd10').removeClass("no_activ");$('#brd10').addClass("activ");	$('#g10').removeClass("none");$('#g10').addClass("block");}
function brend11(){reset1();$('#brd11').removeClass("no_activ");$('#brd11').addClass("activ");	$('#g11').removeClass("none");$('#g11').addClass("block");}

function reset2(){
	$('.select_button').removeClass("sb_black");
	$('.select_button').addClass("sb_white");	
}

function sb1(){reset2();$('#sb1').removeClass("sb_white");$('#sb1').addClass("sb_black");}
function sb2(){reset2();$('#sb2').removeClass("sb_white");$('#sb2').addClass("sb_black");}
function sb3(){reset2();$('#sb3').removeClass("sb_white");$('#sb3').addClass("sb_black");}
function sb4(){reset2();$('#sb4').removeClass("sb_white");$('#sb4').addClass("sb_black");}