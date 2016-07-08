$(function(){
	setInterval(function(){
		$(".slideshow ul").animate({marginLeft:-600},800,function(){
			$(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
		})
	}, 3500);
    
   
        $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();

})(jQuery);