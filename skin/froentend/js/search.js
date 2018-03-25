$(function() {
     $("#topic_title").autocomplete({
		source: SITE_URL+"home/ajax_autocomplete",    
        minLength: 2,
        select: function(event, ui) {
            var url = ui.item.id;
            if(url != '#') {
				window.location.href = SITE_URL+url; 
            }
        },
        html: true,
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });
 
});