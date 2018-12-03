<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/products_manage.js"></script>
<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
            <div class="tt_left">
                <h1 class="title page-header text-overflow"><?php echo $module_labels; ?> </h1>
            </div>
            <div class="pull-right">
            </div>
        </div>

		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-header">
                        <div class="card-body"> 
                            <?php echo form_open('',' id="common_search" class="form-inline"');?>
                            <div class="form-group">
                             <?php  $search_array = array(
                             		'' => get_label('select'),
                             	    'customer_first_name' => get_label('customer_name'),
                             		'order_local_no' => get_label('order_local_no'),
                             );
                             
                             echo form_dropdown('search_field',$search_array,get_session_value($module."_search_field"),' style="width:200px  !important; " ');
                             
                             ?>
                            </div>
                               <div class="form-group">
                                <?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control"');?>
                            </div>
                            
                             <?php /* category filter*/ ?>
                             <div class="form-group">
                                 <?php //echo get_product_category(array('cate_availability_id !=' => 'EB62AF63-0410-47CC-9464-038E796E28C4'),get_session_value($module."_category_id"),'class="form-control search_select" id="product_category" ','pro_cate_id');?>
                            </div> 
                           
                                <div class="form-group">
                                 <?php 
                                 $status_array = array(
                                     ''    => 'All Orders',   
                                     '1'   => 'Processing',
                                     '2'   => 'Pending',
                                     '3'   => 'Unsuccessful',
                                     '4'   => 'Cancelled',
                                     '5'   => 'Completed',
                                     '6'   => 'Failed'
                                 );
                                 echo form_dropdown('status',$status_array,get_session_value($module."_search_status"),' style="width:200px  !important; " '); ?>
                            </div>                                
                            <div class="form-group">
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo base_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; <?php echo get_label('reset');?></a> 
                            </div> 
						 
                             <?php echo form_close(); ?>    
						</div>		 
							 
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(base_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
						<input  type="hidden"  name="multiaction"  id="multiaction"  value="">
					    <input  type="hidden"  name="page_id"  id="page_id" value="0">
						<div class="cntloading_wrapper min_height" > <?php echo loading_image('cnt_loading');?>  <div class="append_html"></div></div>
							
                                    <?php // echo $paging;?>
                                  <?php echo form_close();?>  
                                             
                                </div>
				</div>
			</div>
			
		
		</div>

	</div>
</div>

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});


$(".append_html").on("click", ".pagination a", function(e) {
    e.preventDefault();

    var pass_url = $(this).attr('href');
    if (typeof (pass_url) != 'undefined' && pass_url != null) {
        show_content_loading();
        $.get(pass_url+"?paging=true", function(data) {
            hide_content_loading();
            var response = jQuery.parseJSON(data);
            $(".append_html").html(response.html);
            $("#page_id").val(response.offset);

        });
    }

});

$('body').on('click', '.sort_asc', function() { 
    $(this).find('.sort_icon').removeClass('fa fa-sort fa fa-sort-alpha-asc').addClass('fa fa-sort-alpha-desc');
    $(this).removeClass('sort_asc').addClass('sort_desc');
    $(this).attr('title',"<?php echo get_label('order_by_desc'); ?>");
    var sort_field = $(this).attr('data');
    var obj = { sort_field : sort_field, sort_value : "ASC" }; 
    get_content( obj );
});	

$('body').on('click', '.sort_desc', function() {  
        $(this).find('.sort_icon').removeClass('fa fa-sort-alpha-desc').addClass('fa fa-sort-alpha-asc');
        $(this).removeClass('sort_desc').addClass('sort_asc');
        $(this).attr('title',"<?php echo get_label('order_by_asc'); ?>");
        var sort_field = $(this).attr('data');
        var obj = { sort_field : sort_field, sort_value : "DESC" }; 
        get_content( obj );
    });	
</script>
<style>
.table_overflow {
    overflow-x: auto;
    max-width: 100%;
}
table { 
    border-collapse: collapse;
    width: 100%;
    margin: 0 auto;
}
thead {
    background: #F1F1F1;
}
tr {
    height:50px;
    text-align:center;
}
td, th{
    border: 1px solid #d4d4d4;
    border-collapse: collapse;
    text-align: center;
    padding: 8px;
    padding-left: 8px;
    vertical-align: top;
}
#common_search, .page-title {
    margin: 0 auto;
    width: 96%;
}
.page-title { padding:15px; }
.form-group {
    width: auto;
    float: left;
    margin: 0 auto;
    padding-right: 10px;
}
.append_html {
    width: 96%;
    margin: 0 auto;
}
.page-header {
	margin: 0 auto;
	text-align: center;
	padding: 10px;
}

.chosen-container-single .chosen-single {
    height: 37px;
    line-height:37px;
}
.chosen-container-single .chosen-single div {
    top:7px;
}



/* Custom Pagination */
.pagination_bar{ margin-bottom: 12px;}
.pagination_txt{ display: inline-block; vertical-align: middle; margin: 12px 10px 12px 0;}
.pagination { margin-top: 5px;  margin-bottom: 5px; display: inline-block; padding-left: 0; border-radius: 4px; }
.pagination_custom nav{ display: inline-block; vertical-align: middle;}
.pagination .active > a,  .pagination .active > a:focus,  .pagination .active > a:hover, .pagination .active span, .pagination .active > span:focus, .pagination .active > span:hover{ background-color: #e84c3d; border-color: #e84c3d;}


.pagination {
 display:inline-block;
 padding-left:0;
 margin:20px 0;
 border-radius:4px
}
.pagination>li {
 display:inline
}
.pagination>li>a,.pagination>li>span {
 position:relative;
 float:left;
 padding:6px 12px;
 margin-left:-1px;
 line-height:1.42857143;
 color:#337ab7;
 text-decoration:none;
 background-color:#fff;
 border:1px solid #ddd
}
.pagination>li:first-child>a,.pagination>li:first-child>span {
 margin-left:0;
 border-top-left-radius:4px;
 border-bottom-left-radius:4px
}
.pagination>li:last-child>a,.pagination>li:last-child>span {
 border-top-right-radius:4px;
 border-bottom-right-radius:4px
}
.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover {
 z-index:2;
 color:#23527c;
 background-color:#eee;
 border-color:#ddd
}
.pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover {
 z-index:3;
 color:#fff;
 cursor:default;
 background-color:#337ab7;
 border-color:#337ab7
}
.pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover {
 color:#777;
 cursor:not-allowed;
 background-color:#fff;
 border-color:#ddd
}
.pagination-lg>li>a,.pagination-lg>li>span {
 padding:10px 16px;
 font-size:18px;
 line-height:1.3333333
}
.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span {
 border-top-left-radius:6px;
 border-bottom-left-radius:6px
}
.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span {
 border-top-right-radius:6px;
 border-bottom-right-radius:6px
}
.pagination-sm>li>a,.pagination-sm>li>span {
 padding:5px 10px;
 font-size:12px;
 line-height:1.5
}
.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span {
 border-top-left-radius:3px;
 border-bottom-left-radius:3px
}
.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span {
 border-top-right-radius:3px;
 border-bottom-right-radius:3px
}
.pager {
 padding-left:0;
 margin:20px 0;
 text-align:center;
 list-style:none
}
.pager li {
 display:inline
}
.pager li>a,.pager li>span {
 display:inline-block;
 padding:5px 14px;
 background-color:#fff;
 border:1px solid #ddd;
 border-radius:15px
}
.pager li>a:focus,.pager li>a:hover {
 text-decoration:none;
 background-color:#eee
}
.pager .next>a,.pager .next>span {
 float:right
}
.pager .previous>a,.pager .previous>span {
 float:left
}
.pager .disabled>a,.pager .disabled>a:focus,.pager .disabled>a:hover,.pager .disabled>span {
 color:#777;
 cursor:not-allowed;
 background-color:#fff
}
/* .pagination-sm>li>a, .pagination-sm>li>span{ padding: 14px 15px;} */
</style>