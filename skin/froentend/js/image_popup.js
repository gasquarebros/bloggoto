$(document).ready(function() {
   	/* image popup*/
	$('.popup-gallery').each(function() {
    $(this).magnificPopup({
       delegate: 'a',
		type: 'image',
		tLoading: 'Loading media #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The media #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				//return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
				return '';
			}
		},
      callbacks: {
        elementParse: function(item) {
     // the class name
     if(item.el.context.className == 'video-link') {
       item.type = 'iframe';
     } else {
       item.type = 'image';
     }
        }
      },
    });
});   

		if($('.ajax-popup').length) {	
			$('.ajax-popup').magnificPopup({
				type: 'ajax',
				alignTop: true,
				overflowY: 'scroll'  ,
		    midClick:false,
		   closeOnContentClick:false,
		   closeOnBgClick:false,
		   preloader: true,
		   enableEscapeKey:false
			});
		}
			/* image popup*/
			
});				
