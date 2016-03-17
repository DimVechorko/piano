var $i=0;
var $way=370;


function slide_left(){
	var $cl_sum=document.getElementsByClassName('slide').length;
	if($i>0){$i--;}
	var $target=$i*$way;
	document.getElementById("slider_content").style.left="-"+$target+"px";
}

function slide_right(){
	var $cl_sum=document.getElementsByClassName('slide').length;
	if($i>=0 && $i<$cl_sum-3){$i++;}
	var $target=$i*$way;
	document.getElementById("slider_content").style.left="-"+$target+"px";
}

function card(x){
	$("#cm1").removeClass("selected");$("#cm1").addClass("no_border");
	$("#cm2").removeClass("selected");$("#cm2").addClass("no_border");
	$("#cm3").removeClass("selected");$("#cm3").addClass("no_border");
	$(x).removeClass("no_border");
    $(x).addClass("selected");
	document.getElementById("show_card").innerHTML=x.innerHTML;
}