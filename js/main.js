jQuery(document).ready(function() 
{
	//Плавный переход к экранам через меню навигации
	$("a.scrollto").click(function () {
    elementClick = jQuery(this).attr("href")
    destination = jQuery(elementClick).offset().top-102;
    jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
    return false;
	});

        var $menu = $("#fixed_menu");   
        $(window).scroll(function(){
            if ( $(this).scrollTop() > 80 && $menu.hasClass("hide") ){

                    $("#fixed_menu").removeClass("hide");
                    $("#fixed_menu").addClass("show");

            } else if($(this).scrollTop() <= 80 && $menu.hasClass("show")) {
                    $("#fixed_menu").removeClass("show");
                    $("#fixed_menu").addClass("hide");
            }
        });//scroll
	
});