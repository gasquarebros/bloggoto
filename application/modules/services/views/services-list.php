<script>
var module_action="addpost";
</script>

<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/multi-select.css">
<script type="text/javascript" src="<?php echo skin_url(); ?>js/service.js"></script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/multiselect.js"></script>
<section>
    <div class="container">
        <div class="service-wrapper">
            <div class="page-service-content">
                <div class=" content-wrapper">
                    <?php echo form_open('',' id="common_search" class="form-inline"');?>
                    <div class="listings-banner">
                        <input type="hidden" name="product_sort" id="product-sort" value="" /> 
                        <p class="slogan">SERVICE FOR THE PEOPLE WHO WANT MORE</p>
                        <div class="search-fields">
                          <input type="text" name="search_field" placeholder="Search with title..." value="" id="search_field" />
                          <div class="select-fields">
                              <div class="sel service_category">
                                  <select name="category" title="Services Category" class="wide" >
                                        <option value="" >Select Category</option> 
                                      <?php foreach($service_category as $key=>$cat){ ?>
                                        <option value="<?php echo $key; ?>" ><?php echo $cat; ?></option> 
                                      <?php } ?>
                                  </select>
                              </div>
                              <div class="sel service_subcategory">
                                  <select title="Subcategory" name="subcategory" class="wide" >
                                      <option value="" >Select Subcategory</option> 
                                      <?php foreach($service_subcategory as $skey=>$subcat){ ?>
                                        <option value="<?php echo $skey; ?>" ><?php echo $subcat; ?></option> 
                                      <?php } ?>
                                  </select>
                              </div>
                              <div class="sel service_availability">
                                  <select name="availability[]" title="Availability" data-placeholder="Select Availability" multiple class="wide" style="width:200px;" >
                                      <option value="mon">Mon</option>
                                      <option value="tue">Tue</option>
                                      <option value="wed">Wed</option>
                                      <option value="thu">Thu</option>
                                      <option value="fri">Fri</option>
                                      <option value="sat">Sat</option>
                                      <option value="sun">Sun</option>
                                  </select>
                              </div>
                              <div class="sel service_city">
                                  <?php echo get_all_cities(); ?>
                                  
                              </div>
                              <button type="submit" class="ui-btn dark-blue">Start Now</button>
                          </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="clear"></div>
                    
                    <div class="switcher">
                        <div><h6>Available Listing</h6></div>
                        <div>
                            <em>Sort Your Feed</em> 
                            <select id="product-sort-web" class="sortby" name="sort_by">
                                <option value="" selected="">Select Sort By</option>
                                <option value="price-low">Price Low to High</option>
                                <option value="price-high">Price High to Low</option>
                                <option value="asc">A-Z </option>
                                <option value="desc">Z-A </option>
                            </select>
                            
                        </div> 
                    </div>
                    <div class="append_html listings"></div>
                </div>
                <?php echo loading_image('cnt_loading');?>
            </div>
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
        $('.service_availability select').chosen('destroy');
        $('.service_availability select').multipleSelect({placeholder: $(this).attr('data-placeholder')});
    });

    
</script>

<style>

.old-price {
    color: black;
    font-size: 17px !important;
    text-decoration: line-through;
    margin-bottom: 7px
}

.new-price {
    color: black;
    font-size: 17px !important;
    font-family: 'proxima_nova_rgbold';
    margin: 0px
}

.old-price, .new-price {
    text-transform: uppercase
}

/* -- button -- */
.ui-btn {
  border-radius: 25px;
  border: none;
  color: white;
  text-decoration: none;
  font-family: 'Roboto', sans-serif;
  font-size: 0.97rem;
  font-weight: 600;
  padding: 0 5px;
  width: 228px; }
.ui-btn.radius-less {
  border-radius: 0; }
.ui-btn:focus {
  box-shadow: 1px 4px 20px -1px rgba(0, 0, 0, 0.54); }
.ui-btn:hover {
  box-shadow: 1px 5px 20px 1px rgba(0, 0, 0, 0.54); }
.ui-btn:active {
  color: inherit; }

/* -- end button -- */
.hide {
  display: none; }


/* -- rating stars -- */
.rating-stars i {
  display: inline-block;
  margin: 0 0.1rem 0.3rem 0;
  color: #607d8b; }
.rating-stars i.yel {
  color: #ff9a06; }

/* -- end rating stars -- */
/* -- colors -- */
.info {
  background: #17a3ff; }

.purple {
  background: linear-gradient(to right, #b702ff, #7305ff); }

.text-mayan {
  color: #7305ff; }

.danger {
  background: #ff008f; }

.greenyellow {
  background: greenyellow; }

.green {
  background: green; }

.dark-blue {
  background: rgba(0, 16, 96, 0.84); }

.rose {
  background: #ff3700; }

.text-rose {
  color: #ff3700; }

.text-white {
  color: white; }

/* -- end colors -- */
.content-wrapper {
  margin-top: 73px; }
.content-wrapper .listings-banner {
  width: 100%;
  height: 200px;
  background: linear-gradient(to bottom, rgba(57, 67, 131, 0.87), rgba(57, 67, 131, 0.78));
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  align-items: center;
  padding: 0 100px; }


.slogan {
    color: white;
    font-size: 24px;
    margin-bottom: 10px;
}  
@media (min-width: 760px) and (max-width: 1200px) {
  .content-wrapper .listings-banner {
    padding: 0 6rem; } }
    .search-fields  #search_field {  
      width:94% !important
    }
@media (max-width: 47.5em) {
  .search-fields  #search_field {  
    width:84% !important
  }
  .content-wrapper .listings-banner {
    padding: 0 5rem; } }
@media (max-width: 25em) {
  .content-wrapper .listings-banner {
    padding: 0 1rem; } }
.content-wrapper .listings-banner .select-fields {
  box-shadow: none; }
.content-wrapper .listings-banner .select-fields .ui-btn {
  box-shadow: none; }

/* ------------------------------------------------
              TWO - INDEX_ONE STYLES
--------------------------------------------------- */

.search-fields {
  background: white;
}
.search-fields  #search_field { 
  margin: 10px 0px 10px 20px;
  width: 97%;
  float: left;
  display: block;
}
.select-fields {
  width: 100%;
  /*margin-top: 3.5rem;*/
  display: flex;
  background: white;
  padding: 1rem;
  box-shadow: 0 2px 15px -4px #394383;
  border-radius: 2px; }
.select-fields .sel {
  flex-basis: 43%; padding: 6px 3px;}
.select-fields .sel .wide {
  /*height: 45px;*/
  border-radius: 0; }
.select-fields .ui-btn {
  border-radius: 0; }
@media (max-width: 47.5em) {
  .select-fields {
    display: block; }
  .select-fields .sel {
    width: 100%; }
  .select-fields .sel .wide {
    /*margin-bottom: 1rem;*/ }
  .select-fields .ui-btn {
    width: 100%; } }


/* ------------------------------------------------
              FOUR - LISTINGS STYLES
---------------------------------------------------*/
.switcher {
  width: 100%;
  margin: 0.7rem 0 3rem 0;
  border-top: 1px solid #eeeeee;
  border-bottom: 1px solid #e2e2e2;
  padding: 1rem 3rem;
  background: linear-gradient(to bottom, transparent, white, white);
  display: flex;
  justify-content: space-between; }
.switcher div {
  display: block;
  align-items: center; }
.switcher div h6 {
  margin: 0; font-size:1rem;color: #607d8b;line-height: 63px;}
@media (max-width: 47.5em) {
  .switcher div em {
    display: none; } }
@media (max-width: 25em) {
  .switcher {
    display: block; }
  .switcher div {
    text-align: center; }
  .switcher div h6 {
    width: 100%;
    text-align: center;
    margin: 0 0 15px 0; } }

.listings {
  width: 100%;
  padding: 2rem 3rem; }
.listings .listing-item {
  width: 100%;
  border-radius: 4px;
  position: relative;
  margin-bottom: 3.5rem; }
.listings .listing-item .cover-img {
  width: 100%;
  border-radius: 4px 4px 0 0;
  position: relative; }
.listings .listing-item .cover-img img {
  width: 100%;
  border-radius: inherit; }
.listings .listing-item .cover-img .cover-hover {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  border-radius: inherit;
  transition: all 600ms; }
.listings .listing-item .cover-img .cover-hover .share-like {
  position: absolute;
  top: 2rem;
  left: 5%;
  width: 90%;
  display: flex;
  justify-content: center; }
.listings .listing-item .cover-img .cover-hover .share-like a {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 6px;
  border: 1px solid whitesmoke;
  text-decoration: none;
  transition: all 600ms; }
.listings .listing-item .cover-img .cover-hover .share-like a i {
  color: whitesmoke; }
.listings .listing-item .cover-img .cover-hover .share-like a:last-child:hover {
  background: #ff008f;
  border-color: #ff008f; }
.listings .listing-item .cover-img .cover-hover .share-like a:nth-child(2):hover {
  background: #17a3ff;
  border-color: #17a3ff; }
.listings .listing-item .cover-img .cover-hover .share-like a:first-child:hover {
  background: #7305ff;
  border-color: #7305ff; }
@media (min-width: 960px) and (max-width: 1057px) {
  .listings .listing-item .cover-img .cover-hover .share-like {
    top: 1rem; } }
.listings .listing-item .listing-info {
  position: relative; }
.listings .listing-item .listing-info .details {
  width: 90%;
  margin: 0 5%;
  padding: 2.6rem 1rem 1rem 1rem;
  background: white;
  border-radius: 5px;
  box-shadow: 0 1px 10px -2px lightgrey;
  will-change: transform;
  transform: translateY(-60px);
  position: relative; }
@media (max-width: 25em) {
  .listings .listing-item .listing-info .details {
    animation: none !important;
    transform: none !important;
    transition-property: none !important;
    margin-top: 1rem;
    margin-bottom: 1rem; } }
.listings .listing-item .listing-info .details .user-pic {
  position: absolute;
  top: -40px;
  left: 1rem;
  width: 83px;
  height: 83px;
  border-radius: 50%;
  border: 3px solid #17a3ff; }
.listings .listing-item .listing-info .details .user-pic img {
  width: 100%;
  border-radius: inherit; }
.listings .listing-item .listing-info .details span {
  font-size: 0.8rem; }
.listings .listing-item .listing-info .details p {
  margin: 5px 0;
  color: #707070; }
.listings .listing-item .listing-info .details em {
  font-size: 0.86rem;
  color: #5a7582; }
.listings .listing-item .listing-info .details:hover {
  animation: anim-list-item 1600ms alternate; }
.listings .listing-item .listing-info .bottom-details {
  width: 90%;
  margin: 0 5%;
  padding: 0 0.84rem;
  transform: translateY(-30px);
  display: flex;
  justify-content: space-between; }
.listings .listing-item .listing-info .bottom-details .rating-stars {
  margin: 0; }
.listings .listing-item .listing-info .bottom-details .rating-stars i {
  margin: 0 0.02rem 0.3rem 0; }
.listings .listing-item .listing-info .bottom-details .rating-stars span {
  font-size: 0.55rem; }
@media (max-width: 25em) {
  .listings .listing-item .listing-info .bottom-details {
    display: block;
    transform: translateY(0px); } }
.listings .listing-item:hover .cover-img .cover-hover {
  opacity: 0.8;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8)); }
.listings .listing-item:before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 85%;
  border-right: 1px solid #e2deef;
  border-bottom: 1px solid #e2deef;
  border-left: 1px solid #e2deef;
  z-index: -1; }
@media (max-width: 25em) {
  .listings {
    padding: 2rem 0.5rem; } }
.listings .listing-two-item {
  width: 100%;
  background: #DEE2E3;
  border-radius: 3px;
  display: flex;
  margin-bottom: 5rem; }
.listings .listing-two-item .cover-photo {
  flex-basis: 35%;
  transform: translateY(-15px);
  position: relative;
  padding-left: 15px;
  transition: transform 500ms; }
.listings .listing-two-item .cover-photo img {
  width: 100%;
  border-radius: 3px;
  box-shadow: 0 4px 25px 1px grey; }
@media (min-width: 830px) and (max-width: 1266px) {
  .listings .listing-two-item .cover-photo img {
    height: 100%; } }
.listings .listing-two-item .cover-photo .cover-photo-hover {
  position: absolute;
  bottom: 0;
  left: 0;
  width: calc(100% - 15px);
  height: 50px;
  margin-left: 15px;
  background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
  border-radius: 3px; }
.listings .listing-two-item .cover-photo .cover-photo-hover .share-like-two {
  position: absolute;
  bottom: 1rem;
  left: 0;
  width: 100%;
  padding-left: 1rem;
  display: flex; }
.listings .listing-two-item .cover-photo .cover-photo-hover .share-like-two a {
  text-decoration: none;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  border: 1px solid whitesmoke;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 0.5rem;
  transition: all 500ms; }
.listings .listing-two-item .cover-photo .cover-photo-hover .share-like-two a i {
  color: whitesmoke; }
.listings .listing-two-item .cover-photo .cover-photo-hover .share-like-two a:hover {
  background: #ff008f;
  border-color: #ff008f; }
@media (max-width: 51.25em) {
  .listings .listing-two-item .cover-photo .cover-photo-hover {
    width: calc(100% - 30px);
    margin-right: 15px; } }
@media (max-width: 51.875em) {
  .listings .listing-two-item .cover-photo {
    width: 100%;
    padding-right: 15px; } }
.listings .listing-two-item .listing-two-item-info {
  flex-basis: 62%;
  padding: 1rem 2rem 1rem 0;
  height: 100%;
  margin-left: 3%; }
.listings .listing-two-item .listing-two-item-info .user-two-pic {
  width: 55px;
  height: 55px;
  border: 2px solid #ff008f;
  border-radius: 50%; }
.listings .listing-two-item .listing-two-item-info .user-two-pic img {
  height: 51px;
width: 51px;
  border-radius: inherit; }
.listings .listing-two-item .listing-two-item-info p {
  color: #707070; }
.listings .listing-two-item .listing-two-item-info .rating-bt {
  width: 100%;
  display: flex;
  justify-content: space-between; }
.listings .listing-two-item .listing-two-item-info .rating-bt .rating-stars span {
  font-size: 0.88rem; }

.more_details_par {
    margin-top: 30px;
}
.more_details_par h5 {
font-family: 'proxima_nova_rgregular';
color: #787878;
text-align: center;
margin: 0 0 10px;
font-size: 16px;  \
}
.more_details_par h5 span {
    position: relative;
}
.more_details_par h5 > span::before, .more_details_par h5 > span::after {
    width: 26px;
    height: 1px;
    background: #787878;
    position: absolute;
    left: -40px;
    top: 0;
    bottom: 0;
    margin: auto;
    content: '';
    transition: all 0.4s ease;
    -webkit-transition: all 0.4s ease;
}
.more_details_par h5 > span::after {
    right: -40px;
    left: inherit;
}
.txtc {
    text-align: center;
}
.more_details_par .common_but {
    font: 13px/20px 'proxima_nova_rgbold';
    border-radius: 0px;
    background: transparent;
    border: 2px solid #787878;
    padding: 6px 10px 5px 10px;
    min-width: 200px;
    color: #787878;
    cursor: pointer;
}

@media (max-width: 25em) {
  .listings .listing-two-item .listing-two-item-info .rating-bt {
    display: block; } }
@media (max-width: 51.875em) {
  .listings .listing-two-item .listing-two-item-info {
    width: 100%;
    margin-left: 0;
    margin-top: 1rem;
    padding: 0 1rem 1rem 1rem; } }
.listings .listing-two-item:hover .cover-photo {
  transform: translateY(0px); }
@media (max-width: 51.875em) {
  .listings .listing-two-item {
    display: block; } }
  @media (max-width: 800px) {
    .content-wrapper .listings-banner {
      height: auto !important; } 
    .ms-parent.wide {
      width: 100% !important;
    }  
    .slogan {
      font-size: 12px;
      margin-bottom: 10px;
      margin-top: 10px;
    }  
  }

@keyframes anim-list-item {
  0% {
    transform: translateY(-60px) rotateZ(0deg); }
  50% {
    transform: translateY(-60px) rotateZ(2deg); }
  75% {
    transform: translateY(-60px) rotateZ(-2deg); }
  100% {
    transform: translateY(-60px) rotateZ(0deg); } }

</style>