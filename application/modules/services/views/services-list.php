<script>
var module_action="addpost";
</script>
<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/service.js"></script>
<section>
    <div class="container">
        <div class="service-wrapper">
            <Div class="page-service-heading">
                <div class="search-top-section">
                    <div class="left-search-section">
                        <h3>Search Page</h3>
                    </div>
                    <div class="right-search-section">
                        <div class="filter-option"><a class="filter-button">Filter</a></div>
                        <div class="sort-option">Sort</div>
                    </div>
                </div>
                <div class="search-filter-section"></div>
            </div>
            <div class="page-service-content"></div>
        </div>
    </div>
</section>
<?php
echo load_lib_js(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js'));
?> 
<script> 
    $(window).on("load",function(){
        $(".mCustomScrollbar").mCustomScrollbar({
            autoHideScrollbar:true,
        });
        get_content(); 
    });
</script>