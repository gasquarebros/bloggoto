<script>
var module_action="addpost";
</script>
<style >
.chosen-container{
    position:relative;
    display:inline-block;
    vertical-align:middle;
    -webkit-user-select:none;
    -moz-user-select:none;
    user-select:none
}
.chosen-container *{
    -webkit-box-sizing:border-box;
    -moz-box-sizing:border-box;
    box-sizing:border-box
}
.chosen-container .chosen-drop{
    position:absolute;
    top:100%;
    left:-9999px;
    z-index:1010;
    width:100%;
    border-top:0;
    background:#fff;
    box-shadow:0 4px 5px rgba(0, 0, 0, 0.15)
}
.chosen-container.chosen-with-drop .chosen-drop{
    left:0
}
.chosen-container a{
    cursor:pointer
}
.chosen-container .search-choice .group-name, .chosen-container .chosen-single .group-name{
    margin-right:4px;
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
    font-weight:normal;
    color:#999
}
.chosen-container .search-choice .group-name:after, .chosen-container .chosen-single .group-name:after{
    content:":";
    padding-left:2px;
    vertical-align:top
}
.chosen-container-single .chosen-single{
    background-color:#f5f5f5;
    cursor:pointer;
    display:block;
    height:100%;
    outline:none;
    position:relative;
    text-align:center;
    -webkit-transition:all 0.2s ease-in-out;
    transition:all 0.2s ease-in-out;
    -webkit-user-select:none;
    user-select:none;
    white-space:nowrap;
    width:100%;
    padding:0 25px 0 10px;
    font-family:'proxima_novasemibold';
    color:#3a3a3a;
    font-size:17px;
    line-height:55px
}
.chosen-container-single .chosen-single:after{
    position:absolute;
    top:0;
    right:15px;
    bottom:0;
    color:#3a3a3a;
    pointer-events:none;
    content:"\f107";
    font-family:'FontAwesome';
    line-height:55px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.chosen-with-drop .chosen-single:after{
    -webkit-transform:rotate(-180deg);
    -ms-transform:rotate(-180deg);
    transform:rotate(-180deg)
}
.chosen-container-single .chosen-default{
    color:#999
}
.chosen-container-single .chosen-single span{
    display:block;
    overflow:hidden;
    margin-right:10px;
    text-overflow:ellipsis;
    white-space:nowrap
}
.chosen-container-single .chosen-single-with-deselect span{
    margin-right:38px
}
.chosen-container-single .chosen-single abbr{
    position:absolute;
    top:6px;
    right:26px;
    display:block;
    width:12px;
    height:12px;
    font-size:1px
}
.chosen-container-single .chosen-single abbr:hover{
    background-position:-42px -10px
}
.chosen-container-single.chosen-disabled .chosen-single abbr:hover{
    background-position:-42px -10px
}
.chosen-container-single .chosen-single div{
    position:absolute;
    top:0;
    right:0;
    display:block;
    width:18px;
    height:100%;
    display:none
}
.chosen-container-single .chosen-single div b{
    display:block;
    width:100%;
    height:100%
}
.chosen-container-single .chosen-search{
    position:relative;
    z-index:1010;
    margin:0;
    padding:3px 4px;
    white-space:nowrap
}
.chosen-container-single .chosen-search input[type="text"]{
    margin:1px 0;
    padding:4px 20px 4px 5px;
    width:100%;
    height:auto;
    outline:0;
    font-size:1em;
    line-height:normal;
    border-radius:0
}
.chosen-container-single .chosen-drop{
    margin-top:0;
    border-radius:0;
    background-clip:padding-box
}
.chosen-container-single.chosen-container-single-nosearch .chosen-search{
    position:absolute;
    left:-9999px
}
.chosen-container .chosen-results{
    background:#eee;
    position:relative;
    overflow-x:hidden;
    overflow-y:auto;
    margin:0 4px 4px 0;
    padding:0 0 0 4px;
    margin:0;
    padding:0;
    max-height:240px;
    -webkit-overflow-scrolling:touch
}
.chosen-container .chosen-results li{
    display:none;
    margin:0;
    padding:8px 15px;
    list-style:none;
    line-height:15px;
    word-wrap:break-word;
    -webkit-touch-callout:none;
    float:none;
    text-align:left;
    font:15px 'proxima_nova_rgregular';
    color:#000;
    border-bottom:1px solid #e4e4e4
}
.chosen-container .chosen-results li:last-child{
    border:none
}
.chosen-container .chosen-results li.active-result{
    display:list-item;
    cursor:pointer
}
.chosen-container .chosen-results li.disabled-result{
    display:list-item;
    color:#ccc;
    cursor:default
}
.chosen-container .chosen-results li.highlighted{
    background-color:#c2c2c2;
    color:#fff
}
.chosen-container .chosen-results li.no-results{
    color:#777;
    display:list-item;
    background:#f4f4f4
}
.chosen-container .chosen-results li.group-result{
    display:list-item;
    font-weight:bold;
    cursor:default
}
.chosen-container .chosen-results li.group-option{
    padding-left:15px
}
.chosen-container .chosen-results li em{
    font-style:normal;
    text-decoration:underline
}
.chosen-container-multi .chosen-choices{
    position:relative;
    overflow:hidden;
    margin:0;
    padding:0 5px;
    width:100%;
    height:auto;
    border:1px solid #aaa;
    background-color:#fff;
    background-image:-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(1%, #eeeeee), color-stop(15%, #ffffff));
    background-image:-webkit-linear-gradient(#eee 1%, #fff 15%);
    background-image:-moz-linear-gradient(#eee 1%, #fff 15%);
    background-image:-o-linear-gradient(#eee 1%, #fff 15%);
    background-image:linear-gradient(#eee 1%, #fff 15%);
    cursor:text
}
.chosen-container-multi .chosen-choices li{
    float:left;
    list-style:none
}
.chosen-container-multi .chosen-choices li.search-field{
    margin:0;
    padding:0;
    white-space:nowrap
}
.chosen-container-multi .chosen-choices li.search-field input[type="text"]{
    margin:1px 0;
    padding:0;
    height:25px;
    outline:0;
    border:0 !important;
    background:transparent !important;
    box-shadow:none;
    color:#999;
    font-size:100%;
    line-height:normal;
    border-radius:0
}
.chosen-container-multi .chosen-choices li.search-choice{
    position:relative;
    margin:3px 5px 3px 0;
    padding:3px 20px 3px 5px;
    border:1px solid #aaa;
    max-width:100%;
    border-radius:3px;
    background-color:#eee;
    background-image:-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
    background-image:-webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:-moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:-o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-size:100% 19px;
    background-repeat:repeat-x;
    background-clip:padding-box;
    box-shadow:0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
    color:#333;
    line-height:13px;
    cursor:default
}
.chosen-container-multi .chosen-choices li.search-choice span{
    word-wrap:break-word
}
.chosen-container-multi .chosen-choices li.search-choice .search-choice-close{
    position:absolute;
    top:4px;
    right:3px;
    display:block;
    width:12px;
    height:12px;
    font-size:1px
}
.chosen-container-multi .chosen-choices li.search-choice .search-choice-close:hover{
    background-position:-42px -10px
}
.chosen-container-multi .chosen-choices li.search-choice-disabled{
    padding-right:5px;
    border:1px solid #ccc;
    background-color:#e4e4e4;
    background-image:-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
    background-image:-webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:-moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:-o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    background-image:linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
    color:#666
}
.chosen-container-multi .chosen-choices li.search-choice-focus{
    background:#d4d4d4
}
.chosen-container-multi .chosen-choices li.search-choice-focus .search-choice-close{
    background-position:-42px -10px
}
.chosen-container-multi .chosen-results{
    margin:0;
    padding:0
}
.chosen-container-multi .chosen-drop .result-selected{
    display:list-item;
    color:#ccc;
    cursor:default
}
.chosen-container-active .chosen-single{
}
.chosen-container-active.chosen-with-drop .chosen-single{
}
.chosen-container-active.chosen-with-drop .chosen-single div{
    border-left:none;
    background:transparent
}
.chosen-container-active.chosen-with-drop .chosen-single div b{
    background-position:-18px 2px
}
.chosen-container-active .chosen-choices{
    border:1px solid #5897fb;
    box-shadow:0 0 5px rgba(0, 0, 0, 0.3)
}
.chosen-container-active .chosen-choices li.search-field input[type="text"]{
    color:#222 !important
}
.chosen-disabled{
    opacity:0.5 !important;
    cursor:default
}
.chosen-disabled .chosen-single{
    cursor:default
}
.chosen-disabled .chosen-choices .search-choice .search-choice-close{
    cursor:default
}
.chosen-rtl{
    text-align:right
}
.chosen-rtl .chosen-single{
    overflow:visible;
    padding:0 8px 0 0
}
.chosen-rtl .chosen-single span{
    margin-right:0;
    margin-left:26px;
    direction:rtl
}
.chosen-rtl .chosen-single-with-deselect span{
    margin-left:38px
}
.chosen-rtl .chosen-single div{
    right:auto;
    left:3px
}
.chosen-rtl .chosen-single abbr{
    right:auto;
    left:26px
}
.chosen-rtl .chosen-choices li{
    float:right
}
.chosen-rtl .chosen-choices li.search-field input[type="text"]{
    direction:rtl
}
.chosen-rtl .chosen-choices li.search-choice{
    margin:3px 5px 3px 0;
    padding:3px 5px 3px 19px
}
.chosen-rtl .chosen-choices li.search-choice .search-choice-close{
    right:auto;
    left:4px
}
.chosen-rtl.chosen-container-single-nosearch .chosen-search, .chosen-rtl .chosen-drop{
    left:9999px
}
.chosen-rtl.chosen-container-single .chosen-results{
    margin:0 0 4px 4px;
    padding:0 4px 0 0
}
.chosen-rtl .chosen-results li.group-option{
    padding-right:15px;
    padding-left:0
}
.chosen-rtl.chosen-container-active.chosen-with-drop .chosen-single div{
    border-right:none
}
.chosen-rtl .chosen-search input[type="text"]{
    padding:4px 5px 4px 20px;
    direction:rtl
}
.chosen-rtl.chosen-container-single .chosen-single div b{
    background-position:6px 2px
}
.chosen-rtl.chosen-container-single.chosen-with-drop .chosen-single div b{
    background-position:-12px 2px
}
@media only screen and (-webkit-min-device-pixel-ratio:1.5), only screen and (min-resolution:144dpi), only screen and (min-resolution:1.5dppx){
    .chosen-rtl .chosen-search input[type="text"], .chosen-container-single .chosen-single abbr, .chosen-container-single .chosen-single div b, .chosen-container-single .chosen-search input[type="text"], .chosen-container-multi .chosen-choices .search-choice .search-choice-close, .chosen-container .chosen-results-scroll-down span, .chosen-container .chosen-results-scroll-up span{
        background-size:52px 37px !important;
        background-repeat:no-repeat !important
    }
}
.chosen-container-single .chosen-search{
    padding:0;
    height:0
}
.chosen-container-single .chosen-search input[type="text"]{
    height:0;
    padding:0;
    border:0 !important
}
 html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{
    border:0;
    font-family:inherit;
    font-size:100%;
    font-style:inherit;
    font-weight:inherit;
    margin:0;
    outline:0;
    padding:0;
    vertical-align:baseline
}
html{
    -webkit-text-size-adjust:none
}
:focus{
    outline:0
}
table{
    width:100%;
    margin:15px 0;
    border-bottom:0;
    border:1px solid #ddd;
    border-spacing:0;
    border-bottom:0
}
table th{
    text-transform:uppercase;
    font-family:'proxima_nova_rgbold';
    color:#3a3a3a
}
table td, table th{
    border-bottom:1px solid #ddd;
    text-align:left;
    padding:9px 10px;
    border-right:1px solid #ddd
}
.overlay-scale{
    display:none
}
caption{
    font-weight:normal;
    text-align:left
}
a img{
    border:0
}
article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{
    display:block
}
embed,iframe,object{
    max-width:100%
}
hr{
    border-color:#eaeaea;
    border-style:solid none none;
    border-width:1px 0 0;
    height:0;
    margin:0 0 0px
}
body{
    color:#787878;
    font-size:16px;
    line-height:normal;
    font-family:'proxima_nova_rgregular';
    word-wrap:break-word;
    background:#fff;
    margin:0 auto;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale
}
h1,h2,h3,h4,h5,h6{
    margin:0px 0px 20px 0px;
    padding:0px;
    font-weight:normal;
    line-height:normal;
    font-family:'proxima_nova_rgbold';
    color:#004282;
    text-transform:uppercase
}
h1{
    font-size:32px
}
h2{
    font-size:27px
}
h3{
    font-size:24px
}
h4{
    font-size:22px
}
h5{
    font-size:18px
}
h6{
    font-size:16px
}
p{
    font-family:'proxima_nova_rgregular';
    margin-bottom:15px;
    line-height:24px
}
a{
    color:#fe9b1a;
    text-decoration:none
}
a:hover,a:focus,a:active{
    text-decoration:none;
    color:#787878
}
img{
    max-width:100%;
    height:auto;
    vertical-align:middle
}
ol,ul{
    margin:0;
    padding:0px 0px 10px 30px
}
strong{
    font-family:'proxima_novasemibold'
}
input,textarea{
    -webkit-border-radius:0px
}
input[type="text"],input[type="email"],input[type="search"],input[type="password"],input[type="reset"],input[type="button"],input[type="submit"],textarea{
    -webkit-appearance:none !important;
    appearance:none !important
}
input[type="text"],input[type="email"],input[type="password"],textarea,select{
    padding:5px 10px;
    border:1px solid #ccc;
    line-height:20px;
    width:100%;
    margin:0 0 10px;
    background-color:#fff;
    -webkit-border-radius:0px;
    -moz-border-radius:0px;
    border-radius:0px;
    height:40px;
    font-family:'proxima_nova_rgregular';
    font-size:16px;
    color:#787878;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
input[type="reset"],input[type="button"],input[type="submit"]{
    background:#fe9b1a;
    border:none;
    color:#fff;
    display:inline-block;
    height:40px;
    margin:0px;
    padding:5px 16px;
    cursor:pointer;
    font-family:'proxima_novasemibold';
    font-size:16px;
    transition:linear 0.2s all;
    -webkit-transition:linear 0.2s all;
    text-transform:uppercase;
    letter-spacing:1px
}
input[type="reset"]:hover,input[type="button"]:hover,input[type="submit"]:hover{
    background:#004282
}
textarea{
    height:75px;
    resize:none
}
cite,em,i{
    font-style:italic
}
pre{
    background-color:#fff;
    margin-bottom:20px;
    overflow:auto;
    padding:20px
}
pre,code,kbd{
    font-family:'proxima_nova_rgregular';
    font-size:14px;
    line-height:19px;
    background-color:#F9F9F9
}
abbr,acronym,dfn{
    border-bottom:1px dotted #666;
    cursor:help
}
address{
    display:block;
    margin:0 0 1.625em
}
ins{
    background:#fff9c0
}
sup,sub{
    font-size:10px;
    height:0;
    line-height:1;
    position:relative;
    vertical-align:baseline
}
sup{
    bottom:1ex
}
sub{
    top:.5ex
}
figure{
    margin:0;
    text-align:center
}
img.alignleft,img.alignright,img.aligncenter{
    margin-bottom:1.625em
}
.clearfix:after{
    visibility:hidden;
    display:block;
    font-size:0;
    content:" ";
    clear:both;
    height:0
}
.clearfix{
    display:inline-block
}
* html .clearfix{
    height:1%
}
.clearfix{
    display:block
}
.clearfix-third,.clear{
    clear:both
}
.fl{
    float:left
}
.fr{
    float:right
}
.rel{
    position:relative
}
.txtc{
    text-align:center
}
.txtl{
    text-align:left
}
.txtr{
    text-align:right
}
.upper{
    text-transform:uppercase
}
.lower{
    text-transform:lowercase
}
.capital{
    text-transform:capitalize
}
*,*:before,*:after{
    -webkit-box-sizing:border-box;
    -moz-box-sizing:border-box;
    box-sizing:border-box
}
.container{
    padding:0 55px;
    margin:0 auto;
    width:1310px
}
header{
    box-shadow:0 0 15px rgba(218, 218, 218, 0.5);
    -webkit-box-shadow:0 0 15px rgba(218, 218, 218, 0.5);
    z-index:111;
    position:relative;
    transition:0.3s all ease
}
.head-top{
    background:#f5f5f5;
    border-bottom:1px solid #e1e1e1
}
.head-top-item:last-of-type{
    padding-right:0px
}
.head-top-item:last-of-type:after{
    display:none
}
.head-top-item{
    position:relative
}
.head-top-item:after{
    position:absolute;
    right:0;
    top:0;
    bottom:0;
    margin:auto;
    width:1px;
    height:15px;
    background:#d6d6d6;
    content:''
}
.head-top-item:last-of-type:after{
    width:inherit
}
.head-top-item, .head-top-item a{
    color:#909090;
    font-size:13px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.head-top-item a{
    display:block;
    padding:10px 20px
}
.head-top-item:last-of-type a{
}
.head-top-item a:hover,.head-top-item a:focus{
    color:#f39125
}
.head-top-item ul{
    padding:0
}
.head-top-item ul li{
    list-style:none
}
.head-top-item.buyer{
    border:none
}
.head-top-item.help{
}
.head-top-item.help ul{
    position:absolute;
    right:0;
    top:100%;
    display:none;
    width:170px;
    background:#fff;
    box-shadow:0 0 5px rgba(0, 0, 0, 0.55);
    z-index:2
}
.head-top-item.help ul li{
}
.head-top-item.help ul li a{
    padding:7px 15px;
    border-bottom:1px solid #e4e4e4
}
.head-top-item.help:hover ul{
    display:block
}
.head-top-item.currency{
    display:none
}
.head-top-item.language{
    display:none
}
#help-link{
    padding:10px 40px 10px 20px
}
#help-link:after{
    position:absolute;
    right:20px;
    top:11px;
    content:"\f107";
    font-family:'FontAwesome'
}
#moblie-link{
    padding:10px 20px 10px 40px
}
#moblie-link:before{
    position:absolute;
    left:20px;
    top:7px;
    content:"\f10b";
    font-family:'FontAwesome';
    color:#002582;
    font-size:20px
}
#currency-link{
    padding:10px 40px 10px 20px
}
#currency-link span{
    font-family:'proxima_nova_rgbold';
    color:#002582;
    display:inline-block;
    padding-left:5px
}
#currency-link:after{
    position:absolute;
    right:20px;
    top:11px;
    content:"\f107";
    font-family:'FontAwesome'
}
#lang-link{
    padding:10px 15px 10px 20px
}
#lang-link:after{
    position:absolute;
    right:0px;
    top:11px;
    content:"\f107";
    font-family:'FontAwesome'
}
.head-bot-left{
    width:20%
}
.head-bot-right{
}
.head-bot-right:after{
    clear:both;
    display:block;
    content:''
}
.main-menu{
    font-size:0
}
.cart-login{
    padding-left:30px;
    display:inline-block;
    float:right
}
.head-bottom, .head-bottom .container{
    position:relative
}
.head-bottom .logo{
    display:inline-block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    margin-top:13px;
    max-width:200px
}
.cart-part{
    position:relative
}
.cart-part:after{
    position:absolute;
    width:1px;
    height:80px;
    background:#d6d6d6;
    top:0;
    right:0;
    bottom:0;
    margin:auto;
    content:'';
    display:none
}
.cart-part .cart-number{
    width:30px;
    height:30px;
    background:#fe9b1a;
    display:inline-block;
    text-align:center;
    line-height:30px;
    color:#fff;
    border-radius:50%;
    position:absolute;
    right:15px;
    top:20px;
    transition:all 0.8s ease;
    -webkit-transition:all 0.8s ease;
    font-size:14px
}
.cart-part:hover .cart-number{
    background:#004282
}
.cart-part a{
    display:inline-block;
    padding:38px 30px 25px 30px
}
.head-cart{
    display:inline-block;
    background:url(../media/full_sprite.png) no-repeat scroll -211px -943px transparent;
    width:34px;
    height:32px
}
.head-man{
    display:inline-block;
    background:url(../media/full_sprite.png) no-repeat scroll -215px -995px transparent;
    width:29px;
    height:32px
}
.cart-login{
    padding-left:0
}
.notify-part{
    position:relative
}
.notify-part>a{
    padding:7px 10px 7px 12px;
    cursor:pointer;
    display:inline-block
}
.notify-part .head-cart{
    display:inline-block;
    background:url(../media/full_sprite.png) no-repeat scroll -465px -371px transparent;
    width:18px;
    height:22px
}
.notify-part .cart-number{
    width:20px;
    height:20px;
    background:#fe9b1a;
    display:inline-block;
    text-align:center;
    line-height:20px;
    color:#fff;
    border-radius:50%;
    position:absolute;
    right:0;
    top:3px;
    transition:all 0.8s ease;
    -webkit-transition:all 0.8s ease;
    font-size:10px
}
.login-part{
    max-width:140px;
    width:140px;
    border:1px solid #d6d6d6;
    position:relative;
    margin:20px 0 0 45px
}
.login-part-top{
    font-size:0
}
.login-part-top .logout{
    width:100%;
    border:none;
    background:#fff;
    padding:6px 0;
    font:15px 'proxima_novasemibold';
    cursor:pointer;
    transition:all 0.7s ease;
    -webkit-transition:all 0.7s ease
}
.login-part-top a{
    color:#3a3a3a;
    text-align:center;
    display:inline-block;
    padding:5px;
    font-family:'proxima_novasemibold';
    font-size:15px;
    width:50%;
    position:relative;
    transition:all 0.7s ease;
    -webkit-transition:all 0.7s ease
}
.login-part-top a:hover, .login-part-top .logout:hover{
    color:#fff;
    background:#004282
}
.login-part-top a:hover::after{
    display:none
}
.login-part-top a:after{
    position:absolute;
    width:1px;
    height:20px;
    background:#d6d6d6;
    top:0;
    right:0;
    bottom:0;
    margin:auto;
    content:''
}
.login-part-top .signup:after{
    background:transparent
}
.stickytop .login-part-top .login{
    width:auto
}
.stickytop .login-part-top .login:hover{
    background:inherit
}
.stickytop .login-part-top a::after{
    display:none
}
.login-part-bottom a{
    font-family:'proxima_novasemibold';
    margin:0 -1px;
    display:block;
    text-align:center;
    background:#fe9b1a;
    color:#fff;
    padding:6px 0;
    font-size:15px;
    transition:all 0.7s ease;
    -webkit-transition:all 0.7s ease;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    padding:6px
}
.login-part-bottom a:hover{
    background:#004282
}
.stickytop{
    background:#fff;
    position:fixed;
    left:0;
    right:0;
    z-index:1000;
    top:-100%;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease;
    box-shadow:0 0 10px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 0 10px rgba(0, 0, 0, 0.2);
    padding:13px 0;
    min-height:70px
}
.stickytop .container, .stickytop .sticky_inner{
    position:relative
}
.stickytop .menu_bar{
    display:block !important;
    left:12px;
    right:inherit
}
.stickytop.visible{
    top:0
}
.stickytop .cart-part a{
    padding:21px 30px
}
.stickytop .login-part{
    margin:0px 0 0 60px
}
.stickytop .cart-part a{
    padding:6px 12px
}
.stickytop .main-menu > li:first-child:before, .stickytop .main-menu > li:after, .stickytop .cart-part:after{
    height:30px
}
.stickytop .login-part-top a, .stickytop .login-part-bottom a, .stickytop .login-part-top .logout{
    font-size:12px
}
.stickytop .login-part{
    min-width:100px;
    display:none
}
.stickytop .cart-part .cart-number{
    right:7px;
    top:5px;
    width:20px;
    height:20px;
    line-height:20px;
    font-size:12px
}
.sticky-search{
    margin-right:20px;
    width:65.83333333333333%
}
.stickyright{
    position:relative
}
.stickyleft{
    position:relative
}
.stickytop .menu_bar .menu_bar_line{
    left:0;
    right:inherit
}
.stickytop .custom-select select{
    height:40px;
    font-size:14px
}
.stickytop .custom-select:after{
    line-height:40px
}
.stickytop .searchbar-form{
    margin:0;
    box-shadow:none;
    -webkit-box-shadow:none;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.stickytop .search-key-box input[type="text"]{
    height:40px;
    padding:10px 15px;
    font-size:13px;
    border:1px solid #ececec
}
.stickytop .sbHolder, .stickytop .sbSelector{
    height:40px
}
.stickytop .sbSelector{
    line-height:30px;
    padding:5px;
    font-size:13px;
    font-size:13px
}
.stickytop .search-operate-box input[type="submit"]{
    background:url(/images/search.png) no-repeat scroll center center #fe9b1a;
    height:40px;
    width:40px
}
.stickytop .search-operate-box input[type="submit"]:hover{
    background:url(/images/search.png) no-repeat scroll center center #004282
}
.stickytop .search-key-box{
    width:68.9873417721519%
}
.stickytop .search-operate-box{
    width:31.0126582278481%
}
.stickytop .search-operate-box{
    padding-right:39px
}
.stickytop .search-operate-box .chosen-container-single .chosen-single{
    line-height:40px;
    font-size:14px
}
.stickytop .search-operate-box .chosen-container-single .chosen-single:after{
    line-height:40px
}
.stickytop .search-operate-box fieldset{
    max-width:140px
}
.stickytop .sbOptions{
    min-width:180px
}
.stickytop .sbToggle:before, .stickytop .sbToggleOpen:before{
    top:12px;
    right:12px
}
.stickytop .sbOptions li a{
    padding:5px 10px
}
.stickytop .sticky_menu{
    background:#f5f5f5;
    width:18.75%;
    height:44px;
    line-height:44px;
    margin-right:1.4166666666666666%;
    padding-left:55px;
    position:relative;
    cursor:pointer;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.stickytop .sticky_menu:hover{
    background:#e6e6e6
}
.stickytop .menu_bar:hover .menu_bar_line{
    background:#1f1f1f
}
.stickytop .sticky_menu .nav_title{
    font:16px 'proxima_novasemibold';
    color:#1f1f1f
}
.stickytop .logo{
    margin-right:1.4166666666666666%;
    width:3.666666666666667%;
    line-height:44px
}
.sticky_menu:hover .menu_bar .menu_bar_line.one{
    width:100%
}
.sticky_menu:hover .menu_bar .menu_bar_line.two{
    width:65%
}
.sticky_menu:hover .menu_bar .menu_bar_line.three{
    width:90%
}
.sticky_menu:hover .menu_bar .menu_bar_line.four{
    width:60%
}
.header_inner{
    display:none
}
.header_inner{
    background:#fff;
    left:0;
    right:0;
    z-index:1000;
    top:-100%;
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease;
    padding:13px 0;
    min-height:70px
}
.header_inner .container, .header_inner .sticky_inner{
    position:relative
}
.header_inner .menu_bar{
    display:block !important;
    left:12px;
    right:inherit
}
.header_inner.visible{
    top:0
}
.header_inner .cart-part a{
    padding:21px 30px
}
.header_inner .login-part{
    margin:0px 0 0 60px
}
.header_inner .cart-part a{
    padding:6px 12px
}
.header_inner .main-menu > li:first-child:before, .header_inner .main-menu > li:after, .header_inner .cart-part:after{
    height:30px
}
.header_inner .login-part-top a, .header_inner .login-part-bottom a, .header_inner .login-part-top .logout{
    font-size:12px
}
.header_inner .login-part{
    min-width:100px;
    display:none
}
.header_inner .cart-part .cart-number{
    right:7px;
    top:5px;
    width:20px;
    height:20px;
    line-height:20px;
    font-size:12px
}
.sticky-search{
    margin-right:0;
    width:74.75%
}
.stickyright{
    position:relative
}
.stickyleft{
    position:relative
}
.header_inner .menu_bar .menu_bar_line{
    left:0;
    right:inherit
}
.header_inner .custom-select select{
    height:40px;
    font-size:14px
}
.header_inner .custom-select:after{
    line-height:40px
}
.header_inner .searchbar-form{
    margin:0;
    box-shadow:none;
    -webkit-box-shadow:none;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.header_inner .search-key-box input[type="text"]{
    height:40px;
    padding:10px 15px;
    font-size:13px;
    border:1px solid #ececec
}
.header_inner .sbHolder, .header_inner .sbSelector{
    height:40px
}
.header_inner .sbSelector{
    line-height:30px;
    padding:5px;
    font-size:13px;
    font-size:13px
}
.stickytop .search-operate-box input[type="submit"]{
    background:url(/images/search.png) no-repeat scroll center center #fe9b1a;
    height:40px;
    width:40px
}
.header_inner .search-operate-box input[type="submit"]:hover{
    background:url(/images/search.png) no-repeat scroll center center #004282
}
.header_inner .search-key-box{
    width:68.9873417721519%
}
.header_inner .search-operate-box{
    width:31.0126582278481%
}
.header_inner .search-operate-box{
    padding-right:39px
}
.header_inner .search-operate-box .nice-select{
    line-height:40px;
    font-size:14px
}
.header_inner .search-operate-box .nice-select:after{
    line-height:40px
}
.header_inner .search-operate-box .nice-select .option{
    font-size:13px;
    padding:7px 14px
}
.header_inner .search-operate-box fieldset{
    max-width:140px
}
.header_inner .sbOptions{
    min-width:180px
}
.header_inner .sbToggle:before, .stickytop .sbToggleOpen:before{
    top:12px;
    right:12px
}
.header_inner .sbOptions li a{
    padding:5px 10px
}
.header_inner .sticky_menu{
    background:#f5f5f5;
    width:18.75%;
    height:44px;
    line-height:44px;
    margin-right:1.4166666666666666%;
    padding-left:55px;
    position:relative;
    cursor:pointer;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.header_inner .sticky_menu:hover{
    background:#e6e6e6
}
.header_inner .menu_bar:hover .menu_bar_line{
    background:#1f1f1f
}
.header_inner .sticky_menu .nav_title{
    font:16px 'proxima_novasemibold';
    color:#1f1f1f
}
.header_inner .logo{
    margin-right:1.4166666666666666%;
    width:3.666666666666667%;
    line-height:44px
}
.header_inner:hover .menu_bar .menu_bar_line.one{
    width:100%
}
.header_inner:hover .menu_bar .menu_bar_line.two{
    width:65%
}
.header_inner:hover .menu_bar .menu_bar_line.three{
    width:90%
}
.header_inner:hover .menu_bar .menu_bar_line.four{
    width:60%
}
.header_inner .login-part-top a{
    width:auto;
    position:relative
}
.header_inner .login-part-top a:hover{
    background:inherit;
    opacity:0.6
}
.header_inner .login-part-top a::after{
    content:"";
    background:inherit;
    position:absolute
}
.header_inner .search-operate-box input[type="submit"]{
    width:40px;
    height:40px
}
.mobile-header-gray{
    background:#c2c2c2;
    position:relative;
    padding:15px 0
}
.mobile-header-gray .cart{
    display:block;
    height:35px;
    line-height:35px
}
.mobile-header-gray .cart a:before{
    content:"\f07a";
    font-family:'FontAwesome';
    color:#e4e4e4;
    font-size:20px
}
.mobile-header-gray .cart a:hover:before{
    color:#fff
}
.mobile-header-gray .menu_bar{
    left:15px;
    right:inherit
}
.sidemenubar{
    position:fixed;
    left:-350px;
    background:#fff;
    width:300px;
    z-index:9999;
    bottom:0;
    top:0;
    box-shadow:0 0 20px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow:0 0 20px rgba(0, 0, 0, 0.3);
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease;
    overflow-y:auto
}
.sidemenubar.open{
    left:0
}
.sidemenubar .multi_logo_wrap{
    margin:0px;
    text-align:left
}
.sidemenubar .side-menu .signin{
}
.menu_slash{
    margin:0 6px;
    color:#fff;
    position:relative;
    top:-1px
}
.sidemenubar .side-menu .menu-close{
    border:none;
    background:none;
    cursor:pointer;
    height:inherit;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease;
    position:absolute;
    top:5px;
    right:8px
}
.sidemenubar .side-menu .signin, .sidemenubar .side-menu .menu-close, .sidemenubar .mobile_username_menu, .sidemenubar .mobile_logout{
    font:13px 'proxima_novasemibold';
    color:#fff;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease;
    text-transform:uppercase
}
.sidemenubar .side-menu .signin:hover, .sidemenubar .side-menu .menu-close:hover, .sidemenubar .mobile_username_menu:hover, .sidemenubar .mobile_logout:hover{
    color:#2d2a2a
}
.sidemenubar .mobile_logout{
    border:none;
    background:transparent;
    cursor:pointer;
    padding:0;
    margin:0
}
.sidemenubar .mCSB_container{
    margin-right:0
}
.sign-part{
    padding:25px 20px 25px 60px;
    background:#fe9b1a;
    position:relative
}
.sign-part:before{
    font-family:'FontAwesome';
    font-size:30px;
    color:#231d1f;
    position:absolute;
    left:20px;
    top:17px;
    content:"\f2be"
}
.sidemenubar .side-menu .side-menu{
    padding:20px
}
.mobile-header-gray .mob_menu_bar{
    width:26px;
    height:15px;
    position:absolute;
    left:20px;
    cursor:pointer;
    bottom:0;
    top:0;
    margin:auto
}
.mobile-header-gray .mob_menu_bar .menu_bar_line{
    width:100%;
    height:2px;
    position:absolute;
    top:0;
    left:0;
    background:#2A2A2A;
    display:block;
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease;
    margin:auto;
    right:0
}
.mobile-header-gray .mob_menu_bar:hover .menu_bar_line{
    background:#ff7d0b
}
.mobile-header-gray .mob_menu_bar .menu_bar_line.two{
    top:6px
}
.mobile-header-gray .mob_menu_bar .menu_bar_line.three{
    top:12px
}
.mobile-header-gray .mob_menu_bar .menu_bar_line.one{
    width:70%
}
.mobile-header-gray .mob_menu_bar .menu_bar_line.two{
    width:100%
}
.mobile-header-gray .mob_menu_bar .menu_bar_line.three{
    width:70%
}
.mobile-header-gray .mob_menu_bar:hover .menu_bar_line.one{
    width:100%
}
.mobile-header-gray .mob_menu_bar:hover .menu_bar_line.two{
    width:100%
}
.mobile-header-gray .mob_menu_bar:hover .menu_bar_line.three{
    width:100%
}
.res_cart_part{
}
.res_cart_part a{
    display:none;
    color:#FE9B1A;
    font-size:18px;
    transition:all 0.3s ease
}
.res_cart_part a:hover{
    color:#ff7d0b
}
.sidemenubar .side-menu{
}
.sidemenubar .side-menu ul{
    padding:0
}
.sidemenubar .side-menu li{
    list-style:none;
    position:relative
}
.sidemenubar .res_common{
    position:relative
}
.sidemenubar .res_common{
    background:transparent url("../media/full_sprite.png");
    position:absolute;
    width:26px;
    height:26px;
    display:block;
    top:10px;
    left:0px
}
.sidemenubar .res_common.res_notification{
    background-position:-462px -370px
}
.sidemenubar .res_common.res_home{
    background-position:-190px -43px
}
.sidemenubar .side-menu li:hover .res_home{
    background-position:-217px -43px
}
.sidemenubar .res_common.res_freedeals{
    background-position:-192px -83px
}
.sidemenubar .side-menu li:hover .res_freedeals{
    background-position:-218px -83px
}
.sidemenubar .res_common.res_merchants{
    background-position:-190px -125px
}
.sidemenubar .side-menu li:hover .res_merchants{
    background-position:-218px -125px
}
.sidemenubar .res_common.res_flashsale{
    background-position:-192px -160px
}
.sidemenubar .side-menu li:hover .res_flashsale{
    background-position:-217px -160px
}
.sidemenubar .side-menu li a, .sidemenubar .side-menu li span{
    display:block;
    font:15px 'proxima_nova_rgregular';
    text-transform:capitalize;
    ;
    padding:13px 0 13px 35px;
    border-bottom:1px solid #ededed;
    cursor:pointer;
    color:#8e96a0;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.sidemenubar .side-menu li a .cart-number{
    width:25px;
    height:25px;
    background:#fe9b1a;
    display:inline-block;
    text-align:center;
    line-height:25px;
    color:#fff;
    border-radius:50%;
    transition:all 0.8s ease;
    -webkit-transition:all 0.8s ease;
    font-size:11px;
    font-style:normal;
    margin-left:5px
}
.sidemenubar .side-menu li a:hover, .sidemenubar .side-menu li span:hover{
    color:#000
}
.sidemenubar .side-menu li.parent span:after{
    position:absolute;
    right:10px;
    top:12px;
    content:"\f107";
    font-size:15px;
    font-family:'FontAwesome';
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.sidemenubar .side-menu li.parent.active span:after{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg)
}
.sidemenubar .side-menu .submenu li a{
    font:14px 'proxima_nova_rgregular';
    position:relative
}
.sidemenubar .side-menu .submenu li a:before{
    position:absolute;
    left:8px;
    top:13px;
    font-family:'FontAwesome';
    font-size:15px;
    color:#8e96a0;
    content:"\f105"
}
.sidemenubar .side-menu li.side_buyer a:before, .sidemenubar .side-menu li.side_help span:before, .sidemenubar .side-menu li.side_save a:before, .sidemenubar .side-menu li.side_cur a:before, .sidemenubar .side-menu li.side_lang a:before{
    position:absolute;
    left:-5px;
    top:13px;
    font-family:'FontAwesome';
    font-size:15px;
    color:#8e96a0;
    content:"\f09d"
}
.sidemenubar .side-menu li.side_buyer a:before{
    font-size:15px;
    top:14px;
    left:0px
}
.sidemenubar .side-menu li.side_help span:before{
    content:"\f05a";
    font-size:20px;
    left:3px
}
.sidemenubar .side-menu li.side_save a:before{
    content:"\f10b";
    font-size:28px;
    top:9px;
    left:-2px
}
.sidemenubar .side-menu li.side_cur a:before{
    content:"\f155";
    font-size:17px
}
.sidemenubar .side-menu li.side_lang a:before{
    content:"\f1ab"
}
.sidemenubar .side-menu .side_cur{
    display:none
}
.sidemenubar .side-menu .side_lang{
    display:none
}
.rating-container input.hide{
    display:none !important
}
.main-menu{
    margin:0;
    padding:0
}
.main-menu>li{
    margin:0;
    padding:0px;
    position:relative;
    list-style:none;
    vertical-align:middle;
    text-align:center;
    display:inline-block;
    min-width:105px
}
.main-menu>li:after{
    position:absolute;
    right:0;
    top:0;
    bottom:0;
    width:1px;
    height:80px;
    margin:auto;
    content:''
}
.main-menu>li:first-child:before{
    position:absolute;
    left:0;
    top:0;
    bottom:0;
    width:1px;
    height:80px;
    margin:auto;
    content:''
}
.main-menu>li>a{
    display:block;
    position:relative;
    padding:0;
    font-family:'proxima_novasemibold';
    color:#3a3a3a;
    margin:0;
    transition:all 0.7s ease;
    -webkit-transition:all 0.7s ease;
    font-size:15px;
    padding:15px 22px
}
.main-menu>li>a>span{
    display:block;
    margin-bottom:15px
}
.main-menu>li:hover>a,.main-menu>li>a:hover,.main-menu>li>a.active{
    box-shadow:inset 0 150px 0 0 #f5f5f5;
    -webkit-box-shadow:inset 0 150px 0 0 #f5f5f5
}
.main-menu ul{
    margin:0px 0px 0px 0px;
    background:#dfae1f;
    z-index:1;
    box-shadow:0 0 14px 0 rgba(0,0,0,0.2);
    width:230px;
    position:absolute;
    left:0px;
    top:100%;
    padding:0px;
    display:none
}
.main-menu>li:last-child>ul{
    left:inherit;
    right:0px
}
.main-menu > li:last-child > ul ul{
    left:inherit;
    right:100%
}
.main-menu ul ul{
    left:100%;
    top:0px;
    right:inherit
}
.main-menu ul li{
    margin:0px 0px 0px 0px;
    padding:0;
    float:none;
    display:block;
    line-height:normal;
    text-align:left;
    position:relative;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.main-menu ul li:last-child{
    border:none
}
.main-menu ul li a{
    display:block;
    padding:9px 15px;
    color:#fff;
    font:14px 'gothambold';
    text-transform:capitalize;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s;
    border-bottom:1px solid #cea11e
}
.main-menu ul li:last-child a{
    border:none
}
.main-menu li:hover > ul, .main-menu ul li:hover>ul{
    display:block;
    -webkit-animation:menu_up ease-out 0.3s 0s;
    -webkit-animation-fill-mode:both;
    animation:menu_up ease-out 0.3s 0s;
    animation-fill-mode:both
}
@-webkit-keyframes menu_up{
    0%{
        -webkit-transform:translateY(30px);
        opacity:0
    }
    100%{
        -webkit-transform:translateY(0px);
        opacity:1
    }
}
@keyframes menu_up{
    0%{
        transform:translateY(30px);
        opacity:0
    }
    100%{
        transform:translateY(0px);
        opacity:1
    }
}
.main-menu ul ul{
    left:100%;
    top:1px
}
.main-menu ul li:hover > a, .main-menu ul li a:hover{
    color:#fff;
    box-shadow:inset 255px 0px 0px #dbddff;
    -webkit-box-shadow:inset 255px 0px 0px #dbddff
}
.lazy{
    opacity:1;
    -webkit-transition:opacity 0.1s linear 0s;
    transition:opacity 0.1s linear 0s
}
.alternate{
    opacity:0;
    display:block;
    z-index:1;
    -webkit-transition:opacity 0.6s ease 0s;
    transition:opacity 0.6s ease 0s;
    position:absolute;
    top:15px;
    left:0;
    right:0;
    margin:auto
}
.main-menu > li:hover .alternate, .main-menu > li > a:hover .alternate, .main-menu > li > a.active .alternate{
    opacity:1
}
.menu_bar{
    width:26px;
    height:20px;
    position:absolute;
    right:15px;
    cursor:pointer;
    display:none;
    bottom:0;
    top:0;
    margin:auto
}
.menu_bar .menu_bar_line{
    width:100%;
    height:2px;
    position:absolute;
    top:0;
    right:0;
    background:#1f1f1f;
    display:block;
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease
}
.menu_bar:hover .menu_bar_line{
    background:#FE9B1A
}
.menu_bar .menu_bar_line.two{
    top:6px
}
.menu_bar .menu_bar_line.three{
    top:12px
}
.menu_bar .menu_bar_line.four{
    top:18px
}
.menu_bar .menu_bar_line.one{
    width:65%
}
.menu_bar .menu_bar_line.two{
    width:100%
}
.menu_bar .menu_bar_line.three{
    width:60%
}
.menu_bar .menu_bar_line.four{
    width:100%
}
.menu_bar:hover .menu_bar_line.one{
    width:100%
}
.menu_bar:hover .menu_bar_line.two{
    width:65%
}
.menu_bar:hover .menu_bar_line.three{
    width:90%
}
.menu_bar:hover .menu_bar_line.four{
    width:60%
}
.main-banner{
    position:relative
}
.main-banner .bxslider{
    padding:0px
}
.main-banner .bxslider{
    padding:0
}
.main-banner .bx-wrapper .bx-viewport{
    -webkit-transform:translatez(0);
    -moz-transform:translatez(0);
    -ms-transform:translatez(0);
    -o-transform:translatez(0);
    transform:translatez(0)
}
.main-banner .bxslider li img{
    display:block;
    margin:auto;
    width:100%
}
.main-banner{
    position:relative
}
.main-banner img{
    display:block;
    margin:auto;
    width:100%
}
.main-banner .banner-con{
    position:absolute;
    left:0;
    right:0;
    text-align:center;
    margin:0 auto;
    padding:30px 40px;
    width:730px;
    max-width:730px;
    background:#fff;
    background:rgba(255, 255, 255, 0.7);
    bottom:17.142857142857143%
}
.main-banner .banner-con h2{
    font-family:'proxima_novasemibold';
    margin-bottom:6px
}
.main-banner .banner-con h6{
    font-family:'proxima_nova_rgregular';
    color:#3a3a3a;
    margin-bottom:0px;
    line-height:26px
}
.main-banner .banner-con h6 a{
    font-family:'proxima_nova_rgbold';
    color:#f77913;
    position:relative;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.main-banner .banner-con h6 a:after{
    position:absolute;
    width:100%;
    height:1px;
    background:#f77913;
    content:'';
    left:0;
    bottom:0
}
.main-banner .banner-con h6 a:hover,.main-banner .banner-con h6 a:focus{
    color:#3a3a3a
}
.main-banner .banner-con h6 a:hover:after{
    background:#3a3a3a
}
.searchbar-form{
    margin:auto;
    box-shadow:0 0 50px #c1c1c1;
    -webkit-box-shadow:0 0 50px #c1c1c1;
    margin-bottom:40px;
    border-bottom:3px solid #fe9b1a;
    border-radius:0 0 7px 7px;
    -webkit-border-radius:0 0 7px 7px
}
.searchbar-form:after{
    clear:both;
    display:block;
    content:''
}
.search-key-box{
    width:65%
}
.search-key-box input[type="text"]{
    border:none;
    font-family:'proxima_novasemibold';
    font-size:17px;
    color:#909090;
    height:55px;
    margin-bottom:0px;
    padding:10px 25px;
    border-right:1px solid #e7e7e7;
    border-radius:5px 0 0 5px
}
.search-operate-box{
    width:35%;
    position:relative;
    padding-right:69px
}
.chosen-container{
    width:100% !important
}
.search-operate-box select{
    margin:0px
}
.search-operate-box input[type="submit"]{
    position:absolute;
    right:-1px;
    top:0;
    background:url(/images/search-icon.png) no-repeat scroll center center #fe9b1a;
    height:56px;
    width:70px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    padding:5px;
    border-radius:0 5px 5px 0;
    -webkit-border-radius:0 5px 5px 0
}
.search-operate-box input[type="submit"]:hover{
    background:url(/images/search-icon.png) no-repeat scroll center center #004282
}
.search-operate-box fieldset{
    max-width:230px
}
.main-banner .searchbar-form{
    width:860px;
    max-width:860px;
    box-shadow:0 0 40px #c1c1c1;
    -webkit-box-shadow:0 0 40px #c1c1c1;
    position:absolute;
    bottom:47.14285714285714%;
    left:0;
    right:0;
    margin:0 auto;
    margin-top:-15px;
    z-index:1;
    display:none
}
.sbSelector{
    display:block;
    height:70px;
    line-height:45px;
    outline:none;
    overflow:hidden;
    padding:15px;
    border-left:solid 1px #e7e7e7;
    font-size:17px;
    background:#f5f5f5;
    color:#3a3a3a;
    font-family:'proxima_novasemibold';
    text-align:center
}
.sbHolder{
    background-color:#fff;
    height:70px;
    position:relative;
    width:100%
}
.sbToggle:before,.sbToggleOpen:before{
    display:block;
    outline:none;
    font-family:'FontAwesome';
    font-size:16px;
    color:#3a3a3a;
    position:absolute;
    top:30px;
    right:40px;
    line-height:normal;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.sbToggle:before{
    content:"\f107"
}
.sbToggleOpen:before{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg)
}
.sbOptions{
    background-color:#fff;
    border:solid 1px #e1e1e1;
    list-style:none;
    left:0px;
    margin:0;
    padding:0;
    position:absolute;
    top:100% !important;
    width:100%;
    z-index:1;
    overflow-y:auto;
    font-size:15px;
    text-align:left
}
.sbOptions li{
    list-style:none
}
.sbOptions li a{
    color:#666;
    padding:8px 12px;
    display:block;
    line-height:20px;
    font-size:14px;
    border-bottom:1px solid #eaeaea;
    cursor:pointer
}
.sbOptions li a:hover{
    color:#000 !important;
    background:#ececec
}
.side-panel{
    width:45px;
    background-color:#fff;
    position:absolute;
    left:5px;
    top:25px
}
.side-panel-list{
    padding:0
}
.side-panel-list li{
    list-style:none;
    height:45px
}
.side-panel-list li a{
    position:relative;
    display:block;
    height:45px;
    line-height:45px
}
.side-panel-list li a:hover{
    background-color:#f3124a;
    text-decoration:none;
    z-index:9;
    position:absolute
}
.side-panel-list li a:after{
    position:absolute;
    left:0;
    right:0;
    bottom:0;
    width:40px;
    height:1px;
    background:#dedede;
    content:'';
    margin:auto
}
.side-panel-list li:last-child a:after{
    background:transparent
}
.side-panel-list li a:hover:after{
    background:transparent
}
.side-panel-list li span{
    color:#fff;
    display:none;
    padding:0 10px;
    margin-left:50px;
    font-size:16px;
    white-space:nowrap;
    min-width:170px
}
.side-panel-list li a:hover span{
    display:block
}
.side-panel-list li i{
    position:absolute;
    top:0;
    left:0px;
    content:'';
    width:45px;
    height:45px;
    display:block;
    background:url(../media/full_sprite.png) no-repeat scroll 7px -425px transparent
}
.side-panel-list li.nav-sale i{
    background-position:7px -475px
}
.side-panel-list li.nav-store i{
    background-position:7px -90px
}
.side-panel-list li.nav-future i{
    background-position:7px -575px
}
.side-panel-list li.nav-free i{
    background-position:7px -425px
}
.side-panel-list li.nav-redeem i{
    background-position:7px -190px
}
.side-panel-list li.official i,.cate_main .cate_list ul li.official a::before{
    background-position:7px -680px
}
.side-panel-list li.men i{
    background-position:7px -1585px
}
.side-panel-list li.phone i{
    background-position:7px -1635px
}
.side-panel-list li.women i{
    background-position:7px -1535px
}
.side-panel-list li.official i{
    background-position:7px -680px
}
.side-panel-list li.fashion i{
    background-position:7px -735px
}
.side-panel-list li.face-skin i{
    background-position:-170px -733px
}
.side-panel-list li.homeservices i{
    background-position:7px -835px
}
.side-panel-list li.travel i{
    background-position:7px -885px
}
.side-panel-list li.wedding i{
    background-position:7px -935px
}
.side-panel-list li.testing i{
    background-position:7px -2135px
}
.side-panel-list li.spa-body i{
    background-position:7px -1085px
}
.side-panel-list li.computer i{
    background-position:7px -1035px
}
.side-panel-list li.consumer i{
    background-position:7px -1735px
}
.side-panel-list li.jewelry i{
    background-position:7px -1785px
}
.side-panel-list li.furniture i{
    background-position:7px -1835px
}
.side-panel-list li.bags i{
    background-position:7px -1885px
}
.side-panel-list li.toys i{
    background-position:7px -1935px
}
.side-panel-list li.health i{
    background-position:7px -2035px
}
.side-panel-list li.food i{
    background-position:7px -2085px
}
.side-panel-list li.sports i{
    background-position:7px -1985px
}
.side-panel-list li.bicycle i{
    background-position:7px -1135px
}
.side-panel-list li.automotive i{
    background-position:7px -1185px
}
.side-panel-list li.automobile i{
    background-position:-173px -423px
}
.side-panel-list li.dining i{
    background-position:7px -1235px
}
.side-panel-list li.saloons i{
    background-position:7px -1285px
}
.side-panel-list li.personal i{
    background-position:-173px -630px
}
.side-panel-list li.stationary i{
    background-position:7px -985px
}
.side-panel-list li.digital i{
    background-position:7px -1035px
}
.side-panel-list li.baby_kids i{
    background-position:-173px -475px
}
.side-panel-list li.lifestyle i{
    background-position:-173px -525px
}
.side-panel-list li.gadgets i{
    background-position:-173px -575px
}
.side-panel-list li.transport i{
    background-position:7px -1335px
}
.side-panel-list li.household i{
    background-position:7px -1385px
}
.side-panel-list li.cosmetics i{
    background-position:7px -1435px
}
.side-panel-list li.hotel_resorts i{
    background-position:-173px -785px
}
.side-panel-list li.gift i{
    background-position:-173px -840px
}
.side-panel-list li.cameras-video i{
    background-position:7px -1485px
}
.side-panel-list li.allcategories i{
    background-position:-173px -885px
}
.side-panel-list li.allcategory i{
    background-position:-173px -885px
}
.side-panel-list li.beauty i{
    background-position:7px -1085px
}
.side-panel-list li.nav-free a:hover i, .side-panel-list li.nav-free.active a:hover i{
    background-position:-50px -425px
}
.side-panel-list li.nav-free.active a i{
    background-position:-50px -425px;
    background-color:#25c0d6
}
.side-panel-list li.nav-sale a:hover i, .side-panel-list li.nav-sale.active a:hover i{
    background-position:-53px -475px
}
.side-panel-list li.nav-sale.active a i{
    background-position:-53px -475px;
    background-color:#53a318
}
.side-panel-list li.nav-store a:hover i{
    background-position:-50px -90px
}
.side-panel-list li.nav-future a:hover i, .side-panel-list li.nav-future.active a:hover i{
    background-position:-50px -575px
}
.side-panel-list li.nav-future.active a i{
    background-position:-50px -575px;
    background-color:#00267e
}
.side-panel-list li.men a:hover i{
    background-position:-50px -1585px
}
.side-panel-list li.phone a:hover i{
    background-position:-50px -1635px
}
.side-panel-list li.women a:hover i{
    background-position:-50px -1535px
}
.side-panel-list li.consumer a:hover i{
    background-position:-50px -1735px
}
.side-panel-list li.jewelry a:hover i{
    background-position:-50px -1785px
}
.side-panel-list li.furniture a:hover i{
    background-position:-50px -1835px
}
.side-panel-list li.toys a:hover i{
    background-position:-50px -1935px
}
.side-panel-list li.health a:hover i{
    background-position:-50px -2035px
}
.side-panel-list li.food a:hover i{
    background-position:-50px -2085px
}
.side-panel-list li.sports a:hover i{
    background-position:-50px -1985px
}
.side-panel-list li.bags a:hover i{
    background-position:-50px -1885px
}
.side-panel-list li.nav-redeem a:hover i{
    background-position:-50px -190px
}
.side-panel-list li.official a:hover i{
    background-position:-50px -680px
}
.side-panel-list li.face-skin a:hover i{
    background-position:-232px -733px
}
.side-panel-list li.homeservices a:hover i{
    background-position:-50px -835px
}
.side-panel-list li.travel a:hover i{
    background-position:-50px -885px
}
.side-panel-list li.wedding a:hover i{
    background-position:-50px -935px
}
.side-panel-list li.testing a:hover i{
    background-position:-50px -2135px
}
.side-panel-list li.fashion a:hover i{
    background-position:-50px -735px
}
.side-panel-list li.spa-body a:hover i{
    background-position:-50px -1085px
}
.side-panel-list li.computer a:hover i{
    background-position:-50px -1035px
}
.side-panel-list li.bicycle a:hover i{
    background-position:-50px -1135px
}
.side-panel-list li.automotive a:hover i{
    background-position:-50px -1185px
}
.side-panel-list li.automobile a:hover i{
    background-position:-233px -423px
}
.side-panel-list li.dining a:hover i{
    background-position:-50px -1235px
}
.side-panel-list li.saloons a:hover i{
    background-position:-50px -1285px
}
.side-panel-list li.personal a:hover i{
    background-position:-231px -630px
}
.side-panel-list li.stationary a:hover i{
    background-position:-50px -985px
}
.side-panel-list li.digital a:hover i{
    background-position:-50px -1035px
}
.side-panel-list li.baby_kids a:hover i{
    background-position:-232px -475px
}
.side-panel-list li.lifestyle a:hover i{
    background-position:-232px -525px
}
.side-panel-list li.gadgets a:hover i{
    background-position:-232px -575px
}
.side-panel-list li.transport a:hover i{
    background-position:-50px -1335px
}
.side-panel-list li.nav-free a:hover i{
    background-position:-50px -425px
}
.side-panel-list li.nav-future a:hover i{
    background-position:-50px -575px
}
.side-panel-list li.household a:hover i{
    background-position:-50px -1385px
}
.side-panel-list li.hotel_resorts a:hover i{
    background-position:-233px -785px
}
.side-panel-list li.gift a:hover i{
    background-position:-233px -840px
}
.side-panel-list li.cosmetics a:hover i{
    background-position:-50px -1435px
}
.side-panel-list li.cameras-video a:hover i{
    background-position:-50px -1485px
}
.side-panel-list li.beauty a:hover i{
    background-position:-50px -1085px
}
.side-panel-list li.allcategories a:hover i{
    background-position:-233px -885px
}
.side-panel-list li.allcategory a:hover i{
    background-position:-233px -885px
}
.side-panel-list li.nav-free a:hover{
    background-color:#25c0d5
}
.side-panel-list li.nav-sale a:hover{
    background-color:#53a318
}
.side-panel-list li.nav-store a:hover{
    background-color:#da0001
}
.side-panel-list li.nav-future a:hover{
    background-color:#00267e
}
.side-panel-list li.nav-redeem a:hover{
    background-color:#f39125
}
.side-panel-list li.official a:hover{
    background-color:#002078
}
.side-panel-list li.fashion_access a:hover{
    background-color:#da0001
}
.product-section{
    padding:30px 0;
    background:#eee
}
.home-product-section{
    padding:0 0 30px 0
}
.product-section .container{
    position:relative
}
.pro-com{
    box-shadow:0 0 10px #e2e2e2;
    -webkit-box-shadow:0 0 10px #e2e2e2;
    border-top:4px solid #3a3a3a;
    margin-bottom:30px
}
.pro-com h3{
    position:relative;
    padding-bottom:13px;
    margin-bottom:20px;
    font-size:22px;
    line-height:24px;
    margin-right:15px
}
.pro-com h3:after{
    position:absolute;
    right:0;
    bottom:0;
    width:44%;
    height:2px;
    background:#3a3a3a;
    content:'';
    max-width:100px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.pro-com-left:hover h3:after{
    width:54%;
    max-width:120px
}
.pro-com h3 span{
    color:#3a3a3a;
    font-family:'proxima_nova_rgregular';
    display:block
}
.pro-com-left{
    background:#f8f8f8;
    overflow:hidden;
    overflow-y:auto;
    padding:20px 0px;
    width:19.0625%
}
.pro-com-left ul{
    padding:0px;
    margin-right:15px
}
.pro-com-left ul li{
    list-style:none;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.pro-com-left ul li a{
    color:#4e4e43;
    font-size:15px;
    margin-bottom:12px;
    display:inline-block;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.pro-com-left ul li a.view_link{
    color:#4e4e4e;
    font:15px 'proxima_nova_rgbold';
    text-decoration:underline
}
.pro-com.store-sec,.pro-com.fashion_access{
    border-top:4px solid #da0001
}
.pro-com.store-sec h3, .pro-com.fashion_access h3{
    color:#da0001
}
.pro-com.store-sec h3:after, .pro-com.fashion_access h3:after{
    background:#da0001
}
.pro-com.store-sec a:hover, .pro-com.fashion_access a:hover{
    color:#da0001
}
.pro-com.store-sec .pro-com-right{
    padding:0px
}
.pro-com.store-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#da0001;
    opacity:0.8
}
.pro-com.store-sec .store-slider .cont-part{
    padding:15px;
    background:#74d056;
    position:absolute;
    left:0;
    right:0;
    bottom:70px;
    width:77.64705882352941%;
    margin:auto;
    font-size:16px
}
.pro-com.store-sec .store-slider .cont-part h5{
    font:18px 'proxima_nova_rgbold';
    color:#fff;
    border-bottom:1px solid #b2f59d;
    padding-bottom:7px;
    margin:0
}
.pro-com.store-sec .store-slider .cont-part p{
    font-family:'proxima_nova_rgregular';
    color:#fff;
    margin:0;
    padding-top:10px;
    line-height:20px
}
.pro-com-right .store-slider{
    padding:0px
}
.pro-com-right .store-slider img{
    width:100%
}
.pro-com-right .store-slider li{
    height:405px;
    background-size:cover;
    -webkit-background-size:cover;
    background-repeat:no-repeat
}
.pro-com.store-sec .slide-right-part{
}
.pro-com.store-sec .slide-right-part ul li:nth-child(2), .pro-com.store-sec .slide-right-part ul li:nth-child(5){
    border-right:0px solid transparent
}
.pro-com.store-sec .slide-right-part ul li:first-child{
    width:66.66666666666666%;
    background:#f6f3ec;
    border:10px solid #fff;
    box-shadow:0 0 1px #dedede;
    -webkit-box-shadow:0 0 1px #dedede;
    overflow:hidden
}
.pro-com.store-sec .slide-right-part ul li:first-child .cont-part,.pro-com.store-sec .slide-right-part ul li:first-child .img-part{
    width:50%
}
.pro-com.store-sec .slide-right-part ul li:first-child .img-part{
}
.pro-com.store-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#cb8b00;
    margin-bottom:10px;
    text-transform:uppercase
}
.pro-com.store-sec .slide-right-part ul li:first-child .cont-part p{
    font-size:16px;
    margin:0 0 8px
}
.pro-com.store-sec .slide-right-part .img-part img{
    display:block;
    margin:auto;
    position:relative;
    top:50%;
    transform:translateY(-50%);
    -webkit-transform:translateY(-50%)
}
.pro-com.store-sec .slide-right-part .cont-part{
    text-align:center;
    padding:20px
}
.pro-com.store-sec .slide-right-part .cont-part h5{
    color:#2a2a2a;
    font-family:'proxima_nova_rgbold';
    text-transform:inherit;
    margin:0 0 0px
}
.pro-com.store-sec .slide-right-part .cont-part p{
    margin:0;
    font-size:15px;
    line-height:20px;
    height:40px;
    overflow:hidden
}
.pro-com.store-sec .slide-right-part ul li{
    height:201px
}
.pro-com.store-sec .slide-right-part ul li .img-part{
    height:130px
}
.pro-com.store-sec .slide-right-part ul li:first-child .img-part, .pro-com.store-sec .slide-right-part ul li:first-child .cont-part{
    height:inherit
}
.pro-com.store-sec .slide-right-part ul li:first-child .cont-part .cont-part-inner{
    position:relative;
    top:50%;
    transform:translateY(-50%);
    -webkit-transform:translateY(-50%)
}
.pro-com.store-sec .slide-right-part ul li .img-part img{
    max-height:100%
}
.pro-com.store-sec .slide-right-part ul li .cont-part{
    height:70px;
    padding:8px
}
.pro-com.store-sec .slide-right-part .cont-part h5{
    font-size:17px
}
.store-sec .bx-wrapper .bx-pager, .store-sec .bx-wrapper .bx-controls-auto{
    position:absolute;
    bottom:25px;
    width:100%;
    left:0
}
.store-sec .bx-wrapper .bx-pager{
    text-align:center;
    font-size:0
}
.store-sec .bx-wrapper .bx-pager .bx-pager-item, .store-sec .bx-wrapper .bx-controls-auto .bx-controls-auto-item{
    display:inline-block;
    *zoom:1;
    *display:inline
}
.store-sec .bx-wrapper .bx-pager.bx-default-pager a{
    text-indent:-9999px;
    display:block;
    width:13px;
    height:13px;
    margin:0 3px;
    outline:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    background:#fff;
    border-radius:50%;
    -webkit-border-radius:50%
}
.store-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#da0001
}
.pro-com.feature-sec{
    border-top:4px solid #002078
}
.pro-com.feature-sec .pro-com-right{
    padding:0px
}
.pro-com.feature-sec h3{
    color:#003192
}
.pro-com.feature-sec h3:after{
    background:#003192
}
.pro-com.feature-sec a:hover{
    color:#004283
}
.slide-part{
    width:31%;
    position:relative
}
.slide-part .fea-slider{
    padding:0px
}
.slide-part .fea-slider img{
    width:100%
}
.pro-com.feature-sec .slide-right-part ul li:nth-child(3n+3){
    border-right:0px solid #e2e2e2
}
.slide-part .bx-wrapper .bx-controls-direction a{
    position:absolute;
    bottom:0;
    top:0;
    outline:0;
    width:20px;
    height:40px;
    font-size:0;
    z-index:50;
    margin:auto;
    background:#2a2a2a;
    opacity:0.5;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#003192
}
.slide-part .bx-wrapper .bx-prev{
    left:0;
    border-radius:0 5px 5px 0
}
.slide-part .bx-wrapper .bx-next{
    right:0;
    border-radius:5px 0 0 5px
}
.slide-part .bx-wrapper .bx-prev:after, .slide-part .bx-wrapper .bx-next:after{
    content:"\f104";
    font-family:'FontAwesome';
    color:#fff;
    font-size:22px;
    position:absolute;
    left:0px;
    top:0;
    bottom:0;
    margin:auto;
    opacity:1;
    line-height:40px;
    width:20px;
    text-align:center
}
.slide-part .bx-wrapper .bx-next:after{
    content:"\f105"
}
.slide-right-part{
    width:69%
}
.slide-right-part ul{
    padding:0;
    border-left:1px solid #e2e2e2;
    border-bottom:1px solid #e2e2e2
}
.slide-right-part ul:after{
    clear:both;
    display:block;
    content:''
}
.slide-right-part ul li{
    list-style:none;
    float:left;
    width:33.3%;
    border-top:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.slide-right-part ul li:hover{
    box-shadow:0 5px 6px 0 #dedede;
    -webkit-box-shadow:0 5px 6px 0 #dedede
}
.slide-right-part ul li a{
    display:block;
    color:#2a2a2a
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li{
    overflow:hidden;
    height:290px
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .img-part a{
    text-align:center;
    filter:none;
    -webkit-filter:
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li a img{
    max-height:100%
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .cont-part{
    height:69px;
    padding:0 5px
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .cont-part h5{
    max-height:22px;
    overflow:hidden;
    font-size:15px;
    padding:0 5px
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .cont-part h5 a{
    color:#2a2a2a;
    text-transform:none;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .cont-part h5 a:hover{
    color:#00267E
}
.home-product-section .pro-com.feature-sec .slide-right-part ul li .cont-part p{
    line-height:normal;
    margin-bottom:0;
    max-height:32px;
    overflow:hidden;
    font-size:14px;
    padding:0 5px;
    color:#787878
}
.home-product-section .pro-com.feature-sec .pro-com-right .home-merchant-carousel .img-part{
    padding:15px
}
.home-product-section .pro-com.feature-sec .pro-com-right .fea-slider li{
    height:580px;
    background-size:cover;
    -webkit-background-size:cover;
    background-repeat:no-repeat;
    background-position:center center
}
.home-product-section .pro-com.feature-sec .pro-com-right .fea-slider li a{
    display:block;
    height:100%
}
.home-product-section .slide-right-part .home-merchant-carousel ul li{
    width:100%;
    border-right:inherit;
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease;
    cursor:pointer
}
.home-product-section .slide-right-part .home-merchant-carousel ul li:hover{
    box-shadow:0 0 10px rgba(0, 0, 0, 0.45);
    -webkit-box-shadow:0 0 10px rgba(0, 0, 0, 0.45)
}
.home-product-section .owl-carousel .owl-wrapper, .home-product-section .owl-carousel .owl-item, .home-product-section .owl-carousel .owl-item .item{
    padding:0px
}
.home-product-section .slide-right-part .home-merchant-carousel ul li h5, .merchant-product-section .slide-right-part ul li a{
    display:block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#2a2a2a;
    text-transform:none;
    margin:0
}
.home-product-section .pro-com-right .mer-slider li{
    height:469px;
    background-size:cover;
    -webkit-background-size:cover;
    background-repeat:no-repeat;
    background-position:center center
}
.pro-com.free-sec{
    border-top:4px solid #25c0d5
}
.pro-com.free-sec h3{
    color:#25c0d5
}
.pro-com.free-sec h3:after{
    background:#25c0d5
}
.pro-com.free-sec .pro-com-left a:hover{
    color:#25c0d5
}
.free-sec .pro-slide .pro-slide-con{
    text-align:left
}
.free-sec .pro-slide .pro-slide-con .quiz_list_title, .free-sec .pro-slide .pro-slide-con .quiz_list_title a{
    color:#2a2a2a;
    text-transform:none;
    font-size:15px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    line-height:normal
}
.free-sec .pro-slide .pro-slide-con .quiz_list_title a:hover{
    color:#25c0d5
}
.free-sec .pro-slide .pro-slide-con h4 a{
    color:#2a2a2a
}
.free-sec .pro-slide .pro-slide-con h4 a:hover{
    color:#25c0d5
}
.free-sec .pro-slide .pro-slide-con .quiz_merchant_title{
    font:14px 'proxima_nova_rgbold';
    text-transform:none;
    line-height:20px;
    margin-bottom:0
}
.free-sec .pro-slide .pro-slide-con .common_but{
    display:none
}
.free-sec .pro-slide .pro-slide-con .quiz_description{
    font-size:14px;
    text-transform:none;
    font-family:"proxima_nova_rgregular";
    line-height:20px;
    max-height:40px;
    overflow:hidden
}
.pro-com.sale-sec{
    border-top:4px solid #53a318
}
.pro-com.sale-sec h3{
    color:#53a318
}
.pro-com.sale-sec h3:after{
    background:#53a318
}
.pro-com.sale-sec a:hover{
    color:#53a318
}
.pro-com.sale-sec .pro-slide-img{
    position:relative
}
.pro-com.sale-sec .pro-slide-img .discount-tag{
    position:absolute;
    left:0;
    bottom:0;
    background:#53a318;
    color:#fff;
    font-family:"proxima_nova_rgbold";
    padding:5px 10px 5px 10px;
    height:30px
}
.pro-com.sale-sec .discount-part p, .pro-com.sale-sec .price-part p{
    margin:0px;
    line-height:normal
}
.pro-com.sale-sec .discount-part .discount{
    color:#67a136;
    font-size:14px;
    font-family:'proxima_nova_rgregular';
    margin-bottom:15px;
    border:1px solid #67a136;
    border-radius:3px;
    -webkit-border-radius:3px;
    text-align:center;
    padding:2px 6px;
    display:inline-block
}
.pro-com.sale-sec .discount-part .sold{
    font-size:14px;
    font-family:'proxima_nova_rgregular';
    position:relative;
    padding:0 0 0 20px
}
.pro-com.sale-sec .discount-part .sold:before{
    position:absolute;
    left:0;
    top:0;
    content:'';
    width:16px;
    height:16px;
    background:url(../media/full_sprite.png) no-repeat scroll -414px -310px transparent
}
.pro-com.sale-sec .price-part .old-price{
    color:#2a2a2a;
    font-size:15px;
    text-decoration:line-through;
    margin-bottom:10px;
    margin-top:3px
}
.pro-com.sale-sec .price-part .new-price, .pro-com.sale-sec .price-part .price{
    color:#53a318;
    font:18px 'proxima_nova_rgbold';
    text-transform:uppercase
}
.pro-com.sale-sec .discount-part .discount, .pro-com.sale-sec .price-part .old-price{
    margin-bottom:5px
}
.product_merchant{
    font-size:14px;
    font-family:'proxima_nova_rgbold';
    color:#2a2a2a;
    clear:both;
    display:block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    margin-bottom:12px;
    max-height:34px;
    overflow:hidden
}
.product_merchant:hover{
    color:#53a318
}
.pro-com.sale-sec .pro-slide-con h4, .pro-com.sale-sec .pro-slide-con h4+p{
    margin-bottom:12px
}
.pro-com.sale-sec .pro-slide-con h4{
    max-height:37px;
    overflow:hidden;
    text-transform:none
}
.pro-com.sale-sec .pro-slide-con p{
    line-height:normal
}
.pro-com.sale-sec .owl-carousel .owl-prev{
    left:-30px
}
.pro-com.sale-sec .owl-carousel .owl-next{
    right:-30px
}
.pro-com.sale-sec .pro-com-right .pro-slide-con h4+p{
    line-height:normal;
    max-height:32px;
    overflow:hidden;
    font-size:14px
}
.pro-com.redeem-sec{
    border-top:4px solid #f39125;
    margin-bottom:0
}
.pro-com.redeem-sec h3{
    color:#f39125
}
.pro-com.redeem-sec h3:after{
    background:#f39125
}
.pro-com.redeem-sec .points{
    margin-bottom:30px
}
.pro-com.redeem-sec .points span{
    color:#2a2a2a;
    font-size:21px;
    font-family:'proxima_novaextrabold';
    display:inline-block
}
.pro-com.redeem-sec .pro-slide-con p:first-of-type{
    margin-bottom:5px
}
.pro-com.redeem-sec .common_but{
    background:#f39125
}
.pro-com.redeem-sec a:hover{
    color:#f39125
}
.pro-slide{
    border:1px solid transparent;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    float:none
}
.pro-slide:hover{
    border:1px solid #f1f1f1;
    box-shadow:0 0px 10px #e2e2e2;
    -webkit-box-shadow:0 0px 10px #e2e2e2
}
.pro-slide .pro-slide-img{
    overflow:hidden;
    text-align:center
}
.pro-slide .pro-slide-img .image_freedeal_title{
    display:block
}
.pro-slide .pro-slide-img img{
    display:block;
    margin:auto;
    max-height:100%
}
.pro-slide .pro-slide-con{
    padding:20px 10px 20px 10px
}
.pro-slide .pro-slide-con h4{
    color:#2a2a2a;
    font:15px 'proxima_nova_rgbold';
    margin-bottom:5px;
    position:relative
}
.pro-slide .pro-slide-con h4 a{
    color:#2a2a2a;
    transition:all 0.3s ease
}
.pro-slide .pro-slide-con .price-part .old-price, .pro-slide .pro-slide-con .price-part .new-price{
    text-transform:uppercase
}
.pro-slide .pro-slide-con h4 a .merchant_icon{
    background-position:113px -123px
}
.pro-slide .pro-slide-con h4 a:hover .merchant_icon{
    background-position:85px -123px
}
.pro-slide .pro-slide-con .quiz_list_title{
    color:#25c0d5;
    font-family:"proxima_nova_rgbold";
    text-transform:capitalize;
    font-size:15px;
    max-height:37px;
    overflow:hidden
}
.pro-slide .pro-slide-con p{
    font-size:14px;
    text-transform:none;
    font-family:"proxima_nova_rgregular";
    line-height:20px;
    color:#787878
}
.pro-slide .pro-slide-con p span nth-child(1){
    font-family:"proxima_nova_rgregular"
}
.pro-slide .pro-slide-con p span{
    display:block
}
.quiz_list_desc{
    font-family:'proxima_novasemibold'
}
.common_but{
    position:relative;
    margin:0px auto;
    font:14px 'proxima_nova_rgbold';
    overflow:hidden;
    color:#fff;
    display:inline-block;
    z-index:8;
    transition:all 0.1s ease;
    -webkit-transition:all 0.1s ease;
    background:#25c0d5;
    text-transform:uppercase;
    padding:7px 10px 6px 10px;
    border-radius:5px;
    -webkit-border-radius:5px;
    min-width:90px;
    text-align:center
}
.common_but:hover,.common_but:focus{
    background:#2a2a2a;
    color:#fff !important
}
.pro-com-right{
    border-left:1px solid #e2e2e2;
    overflow:hidden;
    background:#fff;
    padding:20px 30px;
    width:80.9375%
}
.free-sec .owl-carousel .owl-item{
    padding-bottom:0px
}
.home-product-section #free-sec .pro-com-right{
    padding:20px 30px
}
.scrollup{
    width:35px;
    height:35px;
    position:fixed;
    bottom:45px;
    right:15px;
    border-radius:3px;
    -webkit-border-radius:3px;
    text-align:center;
    line-height:35px;
    transition:all 0.4s ease 0s;
    -webkit-transition:all 0.4s ease 0s;
    cursor:pointer;
    z-index:999;
    background:#fe9b1a;
    color:#fff;
    font-size:12px
}
.scrollup:hover{
    background:#004282
}
footer{
}
.foot-top{
    background:#e8e8e8;
    padding-top:20px
}
.subscription{
    border:1px solid #d8d8d8;
    box-shadow:0 0 10px #dadada;
    -webkit-box-shadow:0 0 10px #dadada
}
.sub-top{
    background:#f8f8f8;
    border-bottom:1px solid #d8d8d8;
    padding:40px 0
}
.sub-top ul{
    padding:0
}
.sub-top ul:after{
    clear:both;
    display:block;
    content:''
}
.sub-top ul li{
    width:20%;
    float:left;
    list-style:none;
    padding:0 25px;
    border-right:1px solid #e2e2e2;
    min-height:180px
}
.sub-top ul li:last-child{
    border:none
}
.sub-top ul li img{
    margin-bottom:25px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.sub-top ul li h6{
    color:#2a2a2a;
    text-transform:initial;
    margin-bottom:12px
}
.sub-top ul li p{
    color:#6b6b6b;
    font-size:14px;
    margin-bottom:0px;
    line-height:22px
}
.sub-top ul li span{
    display:inline-block;
    margin-bottom:25px
}
.sub-top ul li span.value{
    width:48px;
    height:52px;
    background:url(../media/full_sprite.png) no-repeat scroll -296px -979px transparent
}
.sub-top ul li span.delivery{
    width:61px;
    height:50px;
    background:url(../media/full_sprite.png) no-repeat scroll -387px -976px transparent
}
.sub-top ul li span.payment{
    width:65px;
    height:50px;
    background:url(../media/full_sprite.png) no-repeat scroll -291px -1060px transparent
}
.sub-top ul li span.shop{
    width:54px;
    height:50px;
    background:url(../media/full_sprite.png) no-repeat scroll -399px -1060px transparent
}
.sub-top ul li span.help{
    width:54px;
    height:50px;
    background:url(../media/full_sprite.png) no-repeat scroll -295px -1153px transparent
}
.success-subscription{
    position:absolute;
    font-size:14px;
    padding:0px 15px;
    top:-17px;
    color:#2CB507
}
.sub-bot-right .success-subscription::before{
    content:"\f00c";
    font-family:"FontAwesome";
    font-size:11px;
    left:0;
    position:absolute;
    top:3px
}
.black{
    color:#2a2a2a
}
.sub-bottom{
}
.sub-bottom{
    padding:20px;
    background:#fff
}
.sub-bottom h3{
    text-transform:initial;
    font-family:'proxima_novasemibold';
    margin:0px
}
.sub-bottom p{
    font-size:15px;
    margin:0px
}
.sub-bot-left{
    padding-right:25px;
    width:43.75%
}
.sub-bot-right{
    padding-left:25px;
    width:56.25%
}
.sub-bot-right form{
    position:relative;
    max-width:520px;
    top:4px
}
.sub-bot-right form .control-label{
    display:none
}
.sub-bot-right form .has-error .help-block{
    position:absolute;
    color:#f00;
    left:0;
    top:-17px;
    padding:0 0 0 12px;
    font-size:14px
}
.sub-bot-right form .has-error .help-block:before{
    content:"\f175";
    position:absolute;
    left:0;
    top:3px;
    font-family:'FontAwesome';
    font-size:11px
}
.sub-bot-right form input[type="text"]{
    border:3px solid #fe9b1a;
    height:50px;
    border-radius:5px;
    -webkit-border-radius:5px;
    margin:0;
    padding:10px 160px 10px 20px;
    font-family:'proxima_novasemibold'
}
.sub-bot-right form input[type="text"]::-webkit-input-placeholder{
    color:#909090
}
.sub-bot-right form input[type="text"]:-moz-placeholder{
    color:#909090
}
.sub-bot-right form input[type="text"]::-moz-placeholder{
    color:#909090
}
.sub-bot-right form input[type="text"]:-ms-input-placeholder{
    color:#909090
}
.sub-bot-right form button[type="submit"]{
    position:absolute;
    right:0;
    top:0;
    background:#fe9b1a;
    font-size:17px;
    font-family:'proxima_novasemibold';
    text-transform:initial;
    width:145px;
    height:50px;
    border-radius:0 5px 5px 0;
    -webkit-border-radius:0 5px 5px 0;
    padding:10px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#fff;
    border:none;
    cursor:pointer
}
.sub-bot-right form button[type="submit"]:hover{
    background:#004282
}
.press-logos{
    padding:20px 0 0 0;
    margin:0 auto;
    max-width:98%
}
.press-logos h6{
    text-transform:initial;
    font-family:'proxima_nova_rgbold';
    color:#2a2a2a
}
.press-logos ul{
    padding:0
}
.press-logos ul:after{
    clear:both;
    display:block;
    content:''
}
.press-logos ul li{
    list-style:none;
    width:14%;
    float:left;
    padding-left:15px;
    padding-right:15px
}
.foot-menu{
    padding:30px 0;
    max-width:93%;
    margin:0 auto
}
.foot-menu ul{
    padding:0
}
.foot-menu ul:after{
    clear:both;
    display:block;
    content:''
}
.foot-menu ul li{
    list-style:none
}
.foot-menu ul li a{
    color:#6b6b6b;
    font-size:14px;
    display:inline-block;
    margin:0 0 7px;
    position:relative;
    padding:0 0 0 14px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.foot-menu ul li:last-child>a{
    margin-bottom:0px
}
.foot-menu ul li a:hover, .foot-menu ul li a:focus{
    color:#fe9b1a
}
.foot-menu ul li a:before{
    position:absolute;
    left:0;
    top:0;
    content:"\f0da";
    font-family:'FontAwesome'
}
.foot-menu>ul>li{
    float:left;
    padding-right:20px;
    padding-right:30px
}
.foot-menu>ul>li,.foot-menu>ul>li:nth-child(2){
    width:20%
}
.foot-menu > ul > li h6{
    color:#2a2a2a;
    text-transform:initial;
    font-family:'proxima_nova_rgbold';
    margin-bottom:15px
}
.copy-part{
    background:#333;
    font-size:15px;
    text-align:center;
    color:#d6d6d6;
    padding:11px 0
}
.accordion-header{
    cursor:pointer;
    font-size:15px;
    margin:0 0px;
    padding:10px 30px 10px 15px;
    position:relative;
    text-transform:initial;
    background:#fe9b1a;
    color:#fff;
    font-family:'proxima_novasemibold';
    border-bottom:5px solid #e8e8e8;
    letter-spacing:1px;
    text-transform:uppercase
}
.accordion-header:after{
    content:"\f107";
    font-family:'FontAwesome';
    color:#fff;
    position:absolute;
    right:10px;
    top:11px;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.active-header:after{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg)
}
.accordion-content{
    -moz-border-bottom-colors:none;
    -moz-border-left-colors:none;
    -moz-border-right-colors:none;
    -moz-border-top-colors:none;
    background:#fff none repeat scroll 0 0;
    border-color:-moz-use-text-color #ccc #cccccc;
    border-image:none;
    border-radius:0px;
    display:none;
    padding:15px 20px;
    width:100% !important;
    border-color:#D3D3D3;
    margin:0 0 5px
}
.inactive-header{
    background:#004282
}
.active-header{
}
.alert{
    padding:9px 8px 9px 40px;
    background-repeat:no-repeat;
    background-position:10px 10px;
    line-height:normal;
    text-transform:uppercase;
    position:relative;
    border-radius:3px;
    -webkit-border-radius:3px;
    font-size:13px;
    margin:0 15px;
    z-index:999;
    position:absolute;
    left:0;
    right:0;
    max-width:1280px;
    margin:auto;
    top:150px
}
.alert-success{
    background-color:#c4dab6;
    color:#4F8A10
}
.alert-danger{
    background-color:#FFBABA;
    color:#ff4a54
}
.alert-success:before,.alert-danger:before{
    position:absolute;
    left:15px;
    top:8px;
    content:"\f00c";
    font-family:'FontAwesome';
    font-size:15px
}
.alert-danger:before{
    content:"\f06a"
}
.alert .close{
    position:absolute;
    right:-10px;
    top:-15px;
    color:#fff;
    font-size:12px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    cursor:pointer;
    border:none;
    width:15px;
    height:15px;
    padding:0;
    border-radius:50%;
    background:#969696
}
.alert .close:hover{
    background:#696969
}
.mfp-content .alert{
    position:relative
}
.mfp-content{
    max-width:1024px
}
body.flash-sale .mfp-content{
    max-width:1300px
}
.question_popup .alert{
    top:0
}
.question_popup .close{
    display:none
}
.error-summary{
    color:#ff6868
}
.error-summary ul{
    padding:0px;
    margin:0 0 25px
}
.error-summary ul li{
    list-style:none;
    margin:0 0 10px
}
.authenpart-right .error-summary p{
    margin:0px;
    color:inherit
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-prev, .home-product-section .owl-theme .owl-controls .owl-buttons .owl-next{
    font-size:0;
    width:20px;
    height:40px;
    margin:auto;
    background:#9a9a9a;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-prev, .home-product-section .owl-theme .owl-controls .owl-buttons .owl-next{
    position:absolute;
    top:0;
    bottom:0;
    left:0px;
    border-radius:0 5px 5px 0
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-next{
    right:0;
    left:inherit;
    border-radius:5px 0 0 5px
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-prev:after, .home-product-section .owl-theme .owl-controls .owl-buttons .owl-next:before{
    content:"\f104";
    font-family:'FontAwesome';
    color:#fff;
    font-size:22px;
    position:absolute;
    left:6px;
    top:0;
    bottom:0;
    margin:auto;
    line-height:40px
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-next:before{
    content:"\f105";
    right:0
}
.home-product-section .owl-theme .owl-controls .owl-buttons .owl-prev:hover, .home-product-section .owl-theme .owl-controls .owl-buttons .owl-next:hover{
    background:#2a2a2a
}
.home-product-section .free-sec .owl-theme .owl-prev, .home-product-section .free-sec .owl-theme .owl-next{
    background:transparent;
    left:-25px
}
.home-product-section .free-sec .owl-theme .owl-next{
    left:inherit;
    right:-25px
}
.home-product-section .free-sec .owl-theme .owl-prev:after, .home-product-section .free-sec .owl-theme .owl-next:before{
    color:#cacaca;
    font-size:30px
}
.home-product-section .free-sec .owl-theme .owl-prev:hover:after, .home-product-section .free-sec .owl-theme .owl-next:hover:before{
    color:#000
}
.circletag{
    display:block;
    width:150px;
    height:150px;
    background:#E6E7ED;
    -moz-border-radius:150px;
    -webkit-border-radius:150px;
    text-align:center
}
.circletag img{
    width:100%;
    height:150px;
    -moz-border-radius:150px;
    -webkit-border-radius:150px
}
.headcircletag{
    display:block;
    width:150px;
    height:150px;
    background:#E6E7ED;
    -moz-border-radius:150px;
    -webkit-border-radius:150px;
    text-align:center
}
.login-part img{
    max-width:100%;
    height:auto
}
.head-img-circle{
}
.header-profile{
    width:45px;
    height:35px;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    position:absolute;
    left:-57px;
    top:12px;
    text-align:center;
    overflow:hidden;
    line-height:40px
}
.mfp-bg{
    background:#000 !important;
    filter:alpha(opacity=40) !important;
    -moz-opacity:0.4 !important;
    -khtml-opacity:0.4 !important;
    opacity:0.4 !important
}
body.greybg{
    overflow-y:hidden
}
body.greybg:before{
    position:fixed;
    background:#000;
    filter:alpha(opacity=40);
    -moz-opacity:0.4;
    -khtml-opacity:0.4;
    opacity:0.4;
    width:100%;
    height:100%;
    z-index:9998;
    content:''
}
.brand_details_inner .owl-stage:nth-of-type(2){
    display:none
}
.no-js .owl-carousel{
    display:block
}
.owl-carousel{
    display:none;
    width:100%;
    -webkit-tap-highlight-color:transparent;
    position:relative;
    z-index:1
}
.owl-carousel .owl-stage{
    position:relative;
    -ms-touch-action:pan-Y;
    -moz-backface-visibility:hidden
}
.owl-carousel .owl-stage:after{
    content:".";
    display:block;
    clear:both;
    visibility:hidden;
    line-height:0;
    height:0
}
.owl-carousel .owl-stage-outer{
    position:relative;
    overflow:hidden;
    -webkit-transform:translate3d(0px, 0px, 0px)
}
.owl-carousel .owl-wrapper, .owl-carousel .owl-item{
    -webkit-backface-visibility:hidden;
    -moz-backface-visibility:hidden;
    -ms-backface-visibility:hidden;
    -webkit-transform:translate3d(0, 0, 0);
    -moz-transform:translate3d(0, 0, 0);
    -ms-transform:translate3d(0, 0, 0)
}
.owl-carousel .owl-item{
    position:relative;
    min-height:1px;
    float:left;
    -webkit-backface-visibility:hidden;
    -webkit-tap-highlight-color:transparent;
    -webkit-touch-callout:none
}
.owl-carousel .owl-nav.disabled, .owl-carousel .owl-dots.disabled{
    display:none
}
.owl-carousel.owl-loaded{
    display:block
}
.owl-carousel.owl-loading{
    opacity:0;
    display:block
}
.owl-carousel.owl-hidden{
    opacity:0
}
.owl-carousel.owl-refresh .owl-item{
    visibility:hidden
}
.owl-carousel.owl-drag .owl-item{
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.owl-carousel.owl-grab{
    cursor:move;
    cursor:grab
}
.owl-carousel.owl-rtl{
    direction:rtl
}
.owl-carousel.owl-rtl .owl-item{
    float:right
}
.owl-nav{
    filter:alpha(opacity=0);
    -moz-opacity:0;
    -khtml-opacity:0;
    opacity:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    visibility:hidden
}
.pro-com-right:hover .owl-nav, .owl-carousel:hover .owl-nav{
    filter:alpha(opacity=100);
    -moz-opacity:1;
    -khtml-opacity:1;
    opacity:1;
    visibility:visible
}
.brd_menu .owl-nav{
    filter:alpha(opacity=100);
    -moz-opacity:1;
    -khtml-opacity:1;
    opacity:1;
    visibility:visible
}
.owl-theme .owl-prev, .owl-theme .owl-next{
    font-size:0;
    width:20px;
    height:40px;
    margin:auto;
    background:#9a9a9a;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    position:absolute;
    top:0;
    bottom:0;
    left:0px;
    border-radius:0 5px 5px 0;
    cursor:pointer;
    z-index:100
}
.owl-theme .owl-next{
    right:0;
    left:inherit;
    border-radius:5px 0 0 5px
}
.owl-theme .owl-prev:after, .owl-theme .owl-next:before{
    content:"\f104";
    font-family:'FontAwesome';
    color:#fff;
    font-size:22px;
    position:absolute;
    left:6px;
    top:0;
    bottom:0;
    margin:auto;
    line-height:40px
}
.owl-theme .owl-next:before{
    content:"\f105";
    right:0
}
.owl-theme .owl-prev:hover, .owl-theme .owl-next:hover{
    background:#2a2a2a
}
.head-top-item.buyer, .head-top-item.mobile-app, .subscription .sub-top{
    display:block
}
.foot-menu ul li{
    display:block
}
.home-product-section .slide-right-part ul li .cont-part h5 a{
    max-height:22px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    text-transform:uppercase
}
.mCSB_scrollTools .mCSB_draggerContainer{
    opacity:0
}
.cate_list:hover .mCSB_scrollTools .mCSB_draggerContainer{
    opacity:1
}
.merchant_listing_page:hover .mCSB_scrollTools .mCSB_draggerContainer{
    opacity:1
}
.pro-com-left:hover .mCSB_scrollTools .mCSB_draggerContainer{
    opacity:1
}
#map-canvas{
    height:100%
}
.social_icon{
    position:fixed;
    top:200px;
    right:-98px;
    z-index:9988
}
.social_iconinner{
    width:100%;
    display:inline-block;
    padding:0px
}
.social_iconinner li{
    list-style:none
}
.social_iconinner li a{
    border-radius:3px 0 0 3px;
    display:inline-block;
    margin-bottom:2px;
    transition:0.5s all ease-in-out;
    width:100%;
    padding:10px 15px
}
.social_iconinner li a i{
    font-size:20px
}
.social_instagram{
    background:#9235A8
}
.social_iconinner li a{
    color:#fff;
    right:0px;
    position:relative;
    transition:0.5s all ease-in-out
}
.social_iconinner li a:hover{
    right:98px
}
.social_iconinner li em{
    display:inline-block;
    padding-right:25px;
    vertical-align:middle
}
.social_iconinner li span{
    display:inline-block;
    vertical-align:middle
}
.social_fb{
    background:#3B5998
}
.social_tw{
    background:#3FCDFD
}
.social_pinterest{
    background:#DC4A38
}
.social_in{
    background:#1686B0
}
.download-part{
    padding:5px 5px 5px 20px;
    display:none;
    border-bottom:1px solid #ebebeb
}
.download-part .container{
    padding:0px
}
.download-part-inner{
    position:relative;
    padding:0 73px 0 58px;
    min-height:55px
}
.download-part-inner .down-logo{
    display:inline-block;
    max-width:50px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    position:absolute;
    left:0;
    top:3px
}
.download-part-inner p{
    line-height:normal;
    font-size:13px;
    margin:0px
}
.download-part-inner p.para-tiny{
    font-size:12px
}
.download-part-inner p.para-large{
    color:#000;
    padding:5px 0 0 0
}
.download-part-inner .get-icon{
    background:#004282;
    color:#fff;
    text-transform:uppercase;
    font-size:10px;
    border-radius:3px;
    -webkit-border-radius:3px;
    padding:5px 7px;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease;
    position:absolute;
    right:0;
    top:0;
    bottom:0;
    height:22px;
    margin:auto;
    text-align:center
}
.download-part-inner .get-icon:hover{
    background:#fe9b1a
}
.download-part-inner .close-icon{
    color:#444;
    font-size:12px;
    position:absolute;
    left:-18px;
    top:0;
    bottom:0;
    width:15px;
    height:15px;
    text-align:center;
    margin:auto
}
 .authenpart{
    background:#f7f7f7;
    max-width:800px;
    margin:20px auto;
    box-shadow:0 0 50px rgba(0, 0, 0, 0.5);
    -webkit-box-shadow:0 0 50px rgba(0, 0, 0,0.5);
    position:relative
}
.authenpart .mfp-close, .flash_popup .mfp-close{
    color:#adadad;
    transition:0.3s ease all;
    -webkit-transition:0.3s ease all
}
.authenpart .mfp-close:hover, .flash_popup .mfp-close:hover{
    color:#303030
}
.authenpart-left{
    width:45.88235294117647%;
    background:#FE9B1A;
    padding:65px 45px
}
.authenpart-left h2{
    font-size:24px;
    color:#fff;
    text-align:right;
    line-height:24px;
    margin-bottom:15px
}
.authenpart-left p{
    color:#fff;
    text-align:right;
    font-size:15px;
    line-height:20px
}
.authenpart-left h2, .authenpart-left p{
    z-index:2;
    position:relative
}
.authenpart-left .bag_img{
    display:block;
    margin:auto;
    margin-top:30px
}
.register-sec .authenpart-left .bag_img{
    margin-top:110px
}
.authenpart-right{
    width:54.11764705882353%;
    padding:50px
}
.authenpart-right .resetbutton{
    text-transform:uppercase;
    font:15px 'proxima_nova_rgbold';
    color:#4d4d4d;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.authenpart-right .resetbutton:hover{
    color:#FE9B1A
}
.forgot-sec .authenpart-left{
    position:relative;
    overflow:hidden
}
.forgot-sec .authenpart-left .bag_img{
    position:absolute;
    right:0;
    bottom:-70px;
    transform:rotate(-40deg);
    -webkit-transform:rotate(-40deg)
}
.sociallogin{
    margin:0;
    text-align:center
}
.sociallogin:after{
    clear:both;
    display:block;
    content:''
}
.sociallogin .fbloginbtn{
    padding:7px 10px;
    font-size:14px;
    background:#3b5998;
    color:#fff;
    border-radius:3px;
    -webkit-border-radius:3px;
    position:relative;
    padding-left:43px;
    float:none;
    margin-right:10px;
    display:inline-block;
    vertical-align:middle
}
.sociallogin .fbloginbtn:after{
    background:url(../media/full_sprite.png) no-repeat;
    background-position:-133px 0px;
    width:33px;
    height:30px;
    position:absolute;
    left:0;
    top:0;
    content:''
}
.sociallogin #signinButton{
    float:none;
    vertical-align:middle;
    height:30px;
    display:inline-block
}
.sociallogin .fbloginbtn, .sociallogin #signinButton{
    margin-top:5px;
    margin-bottom:5px
}
.sociallogin .fbloginbtn:hover{
    box-shadow:inset 0 -3px 0 #2d4475;
    -webkit-box-shadow:inset 0 -3px 0 #2d4475
}
.new-group{
    position:relative;
    margin-bottom:25px
}
.new-group input{
    font-size:14px;
    padding:5px 10px 5px 45px;
    border:none;
    border-bottom:2px solid #787878;
    background:transparent;
    margin:0;
    box-shadow:none;
    -webkit-box-shadow:none
}
.new-group input:focus{
    outline:none
}
.new-group input:hover #signupform-phoneno{
    display:none
}
.sp-icon{
    border-right:1px solid #787878;
    padding:0 10px 0 10px;
    position:absolute;
    top:10px
}
.new-group label.cm-name{
    color:#787878;
    font-size:14px;
    font-weight:normal;
    position:absolute;
    pointer-events:none;
    left:45px;
    top:10px;
    transition:0.2s ease all;
    -webkit-transition:0.2s ease all
}
.new-group input:focus ~ label.cm-name, .new-group input:valid~label.cm-name{
    top:-10px;
    font-size:15px;
    left:0px
}
.new-group .bar{
    position:relative;
    display:block;
    width:300px;
    width:100%
}
.new-group .bar:before, .new-group .bar:after{
    content:'';
    height:2px;
    width:0;
    bottom:0px;
    position:absolute;
    background:#FE9B1A;
    transition:0.4s ease all;
    -webkit-transition:0.4s ease all
}
.new-group .bar:before{
    left:50%
}
.new-group .bar:after{
    right:50%
}
.new-group input:focus ~ .bar:before, .new-group input:focus~.bar:after{
    width:50%
}
.new-group input:focus~.highlight{
    -webkit-animation:inputHighlighter 0.4s ease;
    animation:inputHighlighter 0.3s ease
}
.new-group .checkbox label{
    margin:0 0 0 15px;
    position:relative;
    top:-2px
}
.authenpart-right .common_but{
    font:15px 'proxima_nova_rgbold';
    border:none;
    background:#FE9B1A;
    width:200px;
    height:35px;
    text-transform:uppercase;
    cursor:pointer
}
.authenpart-right .common_but:hover{
    background:#004282
}
.authenpart-right p{
    color:#9a9b9c;
    margin-top:10px;
    font-size:14px
}
.authenpart-right .joinnow{
    display:block;
    font:13px 'proxima_nova_rgbold';
    text-transform:uppercase;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#2a2a2a
}
.authenpart-right .joinnow:hover{
    color:#FE9B1A
}
.authenpart-right .or{
    text-align:center;
    margin:15px 0 0 0;
    position:relative
}
.authenpart-right .or:after{
    position:absolute;
    left:0;
    right:0;
    content:'';
    width:100%;
    top:10px;
    border-bottom:1px dashed #bbb
}
.authenpart-right .or span{
    background:#f7f7f7;
    position:relative;
    z-index:1;
    padding:0 10px;
    display:inline-block;
    font-size:14px
}
.has-error .help-block-error{
    margin:0;
    background:#ffd7d7;
    color:#ff6f6f;
    font-size:13px;
    padding:5px 10px;
    position:absolute;
    left:0;
    right:0;
    z-index:1;
    line-height:normal;
    bottom:-23px
}
.has-error .help-block-error:after{
    position:absolute;
    left:27px;
    top:-4px;
    content:'';
    border-bottom:4px solid #ffd7d7;
    border-left:4px solid transparent;
    border-right:4px solid transparent
}
.inner-main{
    background:#eee;
    padding:20px 0
}
.cate_left{
    width:19.0625%
}
.cate_main{
    background:#fff;
    border:1px solid #ececec;
    box-shadow:1px 1px 8px #e3e3e3;
    -webkit-box-shadow:1px 1px 8px #e3e3e3
}
.cate_main .cate_title{
    background:#f5f5f5;
    border-bottom:1px solid #e9e9e9;
    transition:all 0.3s ease
}
.cate_main .cate_title h6{
    font:13px 'proxima_nova_rgbold';
    color:#3a3a3a;
    margin:0;
    padding:20px 25px 20px 30px;
    position:relative
}
.cate_main .cate_title h6 .fa{
    position:absolute;
    left:12px
}
.cate_main .cate_title h6:after{
    content:"\f107";
    position:absolute;
    right:10px;
    top:17px;
    font-family:'FontAwesome';
    font-size:20px
}
.cate_main .cate_title h6 a{
    color:#FE9B1A
}
.cate_main .cate_title h6 .mer_cat_section{
    color:#4e4e4e
}
.cate_main .cate_list{
    position:relative
}
.cate_main .cate_list ul{
    padding:0px
}
.cate_main .cate_list ul:hover{
    opacity:1
}
.cate_main .cate_list ul li{
    list-style:none;
    position:relative
}
.cate_main .cate_list>ul>li{
    border-bottom:1px solid #e9e9e9
}
.cate_main .cate_list>ul>li>a{
    display:inline-block;
    padding:10px 19px 11px 45px
}
.cate_main .cate_list ul li a{
    font-size:15px;
    color:#4e4e4e;
    position:relative;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.cate_main .cate_list ul li a:hover{
    color:#FE9C1E
}
.cate_main .cate_list ul li a:before{
    background:url(../media/full_sprite.png) no-repeat scroll 0 0 transparent;
    width:35px;
    height:35px;
    position:absolute;
    left:10px;
    top:-7px;
    content:'';
    bottom:0;
    margin:auto;
    background-position:-3px -1585px
}
.cate_main .cate_list ul li a:after{
    width:1px;
    height:39px;
    position:absolute;
    right:-1px;
    top:0;
    content:'';
    background:#fff;
    z-index:51;
    display:none
}
.cate_main .cate_list ul li.cat_side_menu_active:hover a:after{
    display:block
}
.cate_main .cate_list ul li span{
    display:none
}
.cate_main .cate_list ul li.women a:before{
    background-position:-3px -1535px
}
.cate_main .cate_list ul li.women a:hover:before{
    background-position:-123px -1535px
}
.cate_main .cate_list ul li.men a:before{
    background-position:-3px -1585px
}
.cate_main .cate_list ul li.men a:hover:before{
    background-position:-123px -1585px
}
.cate_main .cate_list ul li.phone a:before{
    background-position:-3px -1635px
}
.cate_main .cate_list ul li.phone a:hover:before{
    background-position:-123px -1635px
}
.cate_main .cate_list ul li.computer a:before{
    background-position:-3px -1685px
}
.cate_main .cate_list ul li.computer a:hover:before{
    background-position:-123px -1685px
}
.cate_main .cate_list ul li.consumer a:before{
    background-position:-3px -1735px
}
.cate_main .cate_list ul li.consumer a:hover:before{
    background-position:-123px -1735px
}
.cate_main .cate_list ul li.jewelry a:before{
    background-position:-3px -1785px
}
.cate_main .cate_list ul li.jewelry a:hover:before{
    background-position:-123px -1785px
}
.cate_main .cate_list ul li.wedding a:before{
    background-position:-3px -1785px
}
.cate_main .cate_list ul li.wedding a:hover:before{
    background-position:-123px -1785px
}
.cate_main .cate_list ul li.testing a:before{
    background-position:-3px -2135px
}
.cate_main .cate_list ul li.testing a:hover:before{
    background-position:-123px -2135px
}
.cate_main .cate_list ul li.furniture a:before{
    background-position:-3px -1835px
}
.cate_main .cate_list ul li.furniture a:hover:before{
    background-position:-123px -1835px
}
.cate_main .cate_list ul li.bags a:before{
    background-position:-3px -1885px
}
.cate_main .cate_list ul li.bags a:hover:before{
    background-position:-123px -1885px
}
.cate_main .cate_list ul li.toys a:before{
    background-position:-3px -1935px
}
.cate_main .cate_list ul li.toys a:hover:before{
    background-position:-123px -1935px
}
.cate_main .cate_list ul li.sports a:before{
    background-position:-3px -1985px
}
.cate_main .cate_list ul li.sports a:hover:before{
    background-position:-123px -1985px
}
.cate_main .cate_list ul li.health a:before{
    background-position:0 -392px
}
.cate_main .cate_list ul li.health a:hover:before{
    background-position:-28px -392px
}
.cate_main .cate_list ul li.spa-body a:before{
    background-position:-3px -1085px
}
.cate_main .cate_list ul li.spa-body a:hover:before{
    background-position:-122px -1085px
}
.cate_main .cate_list ul li.bicycle a:before{
    background-position:-3px -1137px
}
.cate_main .cate_list ul li.bicycle a:hover:before{
    background-position:-122px -1137px
}
.cate_main .cate_list ul li.official a:before{
    background-position:-3px -680px
}
.cate_main .cate_list ul li.official a:hover:before{
    background-position:-122px -680px
}
.cate_main .cate_list ul li.fashion a:before{
    background-position:-3px -735px
}
.cate_main .cate_list ul li.fashion a:hover:before{
    background-position:-122px -735px
}
.cate_main .cate_list ul li.gift a:before{
    background-position:-183px -840px
}
.cate_main .cate_list ul li.gift a:hover:before{
    background-position:-303px -840px
}
.cate_main .cate_list ul li.food a:before{
    background-position:-3px -2085px
}
.cate_main .cate_list ul li.food a:hover:before{
    background-position:-123px -2085px
}
.cate_main .cate_list ul li.beauty a:before{
    background-position:-3px -1085px
}
.cate_main .cate_list ul li.beauty a:hover:before{
    background-position:-122px -1085px
}
.cate_main .cate_list ul li.digital a:before{
    background-position:-3px -1035px
}
.cate_main .cate_list ul li.digital a:hover:before{
    background-position:-121px -1035px
}
.cate_main .cate_list ul li.travel a:before{
    background-position:-3px -885px
}
.cate_main .cate_list ul li.travel a:hover:before{
    background-position:-121px -885px
}
.cate_main .cate_list ul li.personal a:before{
    background-position:-183px -630px
}
.cate_main .cate_list ul li.personal a:hover:before{
    background-position:-302px -630px
}
.cate_main .cate_list ul li.lifestyle a:before{
    background-position:-183px -525px
}
.cate_main .cate_list ul li.lifestyle a:hover:before{
    background-position:-302px -525px
}
.cate_main .cate_list ul li.gadgets a:before{
    background-position:-183px -577px
}
.cate_main .cate_list ul li.gadgets a:hover:before{
    background-position:-302px -577px
}
.cate_main .cate_list ul li.homeservices a:before{
    background-position:-3px -835px
}
.cate_main .cate_list ul li.homeservices a:hover:before{
    background-position:-121px -835px
}
.cate_main .cate_list ul li.automobile a:before{
    background-position:-183px -427px
}
.cate_main .cate_list ul li.automobile a:hover:before{
    background-position:-303px -427px
}
.cate_main .cate_list ul li.baby_kids a:before{
    background-position:-184px -477px
}
.cate_main .cate_list ul li.baby_kids a:hover:before{
    background-position:-303px -477px
}
.cate_main .cate_list ul li.dining a:before{
    background-position:-2px -1235px
}
.cate_main .cate_list ul li.dining a:hover:before{
    background-position:-120px -1235px
}
.cate_main .cate_list ul li.face-skin a:before{
    background-position:-183px -737px
}
.cate_main .cate_list ul li.face-skin a:hover:before{
    background-position:-303px -737px
}
.cate_main .cate_list ul li.automotive a:before{
    background-position:-2px -1188px
}
.cate_main .cate_list ul li.automotive a:hover:before{
    background-position:-119px -1188px
}
.cate_main .cate_list ul li.saloons a:before{
    background-position:-3px -1285px
}
.cate_main .cate_list ul li.saloons a:hover:before{
    background-position:-121px -1285px
}
.cate_main .cate_list ul li.transport a:before{
    background-position:-3px -1337px
}
.cate_main .cate_list ul li.transport a:hover:before{
    background-position:-120px -1337px
}
.cate_main .cate_list ul li.household a:before{
    background-position:-3px -1385px
}
.cate_main .cate_list ul li.household a:hover:before{
    background-position:-121px -1385px
}
.cate_main .cate_list ul li.cosmetics a:before{
    background-position:-3px -1435px
}
.cate_main .cate_list ul li.cosmetics a:hover:before{
    background-position:-122px -1435px
}
.cate_main .cate_list ul li.cameras-video a:before{
    background-position:-3px -1485px
}
.cate_main .cate_list ul li.cameras-video a:hover:before{
    background-position:-122px -1485px
}
.cate_main .cate_list ul li.hotel_resorts a:before{
    background-position:-183px -787px
}
.cate_main .cate_list ul li.hotel_resorts a:hover:before{
    background-position:-302px -787px
}
.cate_main .cate_list ul li.allcategories a:before{
    background-position:-183px -887px
}
.cate_main .cate_list ul li.allcategories a:hover:before{
    background-position:-303px -887px
}
.cate_main .cate_list ul li.allcategory a:before{
    background-position:-183px -887px
}
.cate_main .cate_list ul li.allcategory a:hover:before{
    background-position:-303px -887px
}
.cate_main .cate_list ul li.stationary a:before{
    background-position:-3px -985px
}
.cate_main .cate_list ul li.stationary a:hover:before{
    background-position:-122px -985px
}
.merchant_cashpay{
    font-size:0;
    margin-top:7px
}
.merchant_cashpay .cashback{
    display:inline-block;
    background:#fe9b1a;
    color:#fff;
    font:15px 'proxima_nova_rgregular';
    padding:3px 5px;
    width:50%;
    border-radius:4px;
    border:1px solid #fe9b1a;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    position:relative;
    z-index:1;
    text-align:center
}
.merchant_cashpay .online{
    background:#fff;
    color:#fe9b1a
}
.merchant_cashpay .in-store{
    border-radius:0 4px 4px 0;
    -webkit-border-radius:0 4px 4px 0;
    margin-left:-3px;
    z-index:0
}
.merchant-product-section .merchant_cashpay{
    min-height:24px
}
.category_part .searchbar-form{
    max-width:inherit
}
.category_part .cate_right{
    width:79.6875%
}
.cate_right #form-freedeal-searchbar, .cate_right #form-flashsale-searchbar, .cate_right #form-merchant-searchbar, .cate_right #form-merchantdetail-searchbar{
    box-shadow:0 0 20px #c1c1c1;
    -webkit-box-shadow:none;
    max-width:1275px;
    margin:0 0 20px;
    border-bottom:3px solid #fe9b1a;
    -webkit-border-radius:0 0 7px 7px;
    border-radius:0 0 7px 7px
}
.cate_right #form-freedeal-searchbar .search-key-box input[type="text"], .cate_right #form-flashsale-searchbar .search-key-box input[type="text"], .cate_right #form-merchant-searchbar .search-key-box input[type="text"], .cate_right #form-merchantdetail-searchbar .search-key-box input[type="text"]{
    border-radius:5px 0 0 5px;
    -webkit-border-radius:5px 0 0 5px
}
.cate_right .searchbar-form .search-key-box input[type="text"]{
    border-radius:0px;
    -webkit-border-radius:0px
}
.cate_right .search-operate-box button[type="submit"]{
    border-radius:0 5px 5px 0;
    -webkit-border-radius:0 5px 5px 0;
    right:-1px;
    position:absolute;
    top:0;
    background:url(/images/search-icon.png) no-repeat scroll center center #fe9b1a;
    height:55px;
    width:70px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    padding:5px;
    border:none;
    cursor:pointer
}
.cate_right .search-operate-box button[type="submit"]:hover{
    background:url(/images/search-icon.png) no-repeat scroll center center #004282
}
.cate_banner{
    margin-bottom:40px
}
.cate_banner_left,.cate_banner_right{
    width:49.254901960784314%
}
.cate_main .cate_list .cat_side_menu{
    position:absolute;
    top:0;
    left:105%;
    max-width:700px;
    z-index:55;
    background:#fff;
    border:1px solid #e9e9e9;
    padding:15px 20px;
    box-shadow:5px 5px 5px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:5px 5px 5px rgba(0, 0, 0, 0.1);
    z-index:999;
    visibility:hidden;
    opacity:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    width:700px
}
.cate_main .cate_list ul li:hover .cat_side_menu, .cate_main .cate_list ul li a:hover .cat_side_menu{
    left:100%;
    visibility:visible;
    opacity:1
}
.cate_main .cate_list .cat_side_menu>li{
    margin-bottom:10px;
    float:left;
    margin-bottom:20px;
    padding-bottom:20px;
    margin-right:1%;
    width:49%;
    position:relative
}
.cate_main .cate_list .cat_side_menu>li:last-child:before{
    display:none
}
.cate_main .cate_list .cat_side_menu>li:last-child{
    margin-bottom:0px;
    padding-bottom:0px
}
.cate_main .cate_list .cat_side_menu > li h3{
    font-size:15px;
    color:#4e4e4e;
    font-family:"proxima_novasemibold";
    position:relative;
    padding:0 0 8px
}
.cate_main .cate_list .cat_side_menu > li h3::after{
    background:#ff7005 none repeat scroll 0 0;
    bottom:-1px;
    content:"";
    height:2px;
    left:0;
    position:absolute;
    width:50px
}
.cate_main .cate_list .cat_side_menu>li:last-child{
    margin-bottom:0
}
.cate_main .cate_list .cat_side_menu .merchant_submenu_inner li{
    float:left;
    padding:0 10px 0 0;
    position:relative
}
.cate_main .cate_list .cat_side_menu .merchant_submenu_inner li::before{
    background:#ccc none repeat scroll 0 0;
    content:"";
    height:80%;
    position:absolute;
    right:5px;
    top:1px;
    width:1px
}
.cate_main .cate_list .cat_side_menu>li:nth-child(3n+3){
    margin-right:0px
}
.cate_main .cate_list .cat_side_menu li a{
    padding:0;
    border:none;
    text-transform:capitalize;
    font-size:14px
}
.cate_main .cate_list .cat_side_menu li a:hover{
}
.cate_main .cate_list .cat_side_menu li a:before{
    background:inherit;
    position:inherit
}
.cate_main .cate_list .cat_side_menu li a:hover:before{
}
.cate_main .cate_list .cat_side_menu li h3.title{
    margin:0 0 6px;
    text-transform:inherit;
    font-family:'proxima_novasemibold';
    padding:0 0 8px;
    margin:0 0 15px;
    border-bottom:1px solid #e9e9e9;
    position:relative
}
.cate_main .cate_list .cat_side_menu li h3.title:after{
    position:absolute;
    left:0;
    bottom:-1px;
    width:50px;
    height:2px;
    background:#ff7005;
    content:''
}
.cate_main .cate_list .cat_side_menu li h3.title a{
    font-family:'proxima_novasemibold';
    text-transform:uppercase;
    font-size:15px
}
.cate_main .cate_list .cat_side_menu li h3.title a:hover{
}
.cate_main .cate_list .cat_side_menu ul li{
    margin-bottom:7px
}
.cate_main .cate_list .cat_side_menu ul li:last-child{
    margin-bottom:0px
}
.category_with_search{
    margin-bottom:20px;
    position:relative;
    z-index:52
}
.category_with_search .cate_main_mobile{
    width:228px;
    position:absolute;
    left:0;
    top:0;
    z-index:1
}
.cate_main.cate_main_mobile .cate_title h6:after{
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease
}
.cate_main.cate_main_mobile .cate_title.active h6:after{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg)
}
.cate_main.cate_main_mobile .cate_list{
    left:0;
    top:100%;
    background:#fff;
    width:100%;
    box-shadow:3px 3px 6px rgba(0, 0, 0, 0.22);
    -webkit-box-shadow:3px 3px 6px rgba(0, 0, 0, 0.22);
    position:relative
}
.cate_main.cate_main_mobile .cate_list ul{
}
.cate_main.cate_main_mobile .cate_list .submenu li{
}
.cate_main.cate_main_mobile .cate_list .submenu .title{
    margin:0
}
.cate_main.cate_main_mobile .cate_list .submenu li a{
    padding:10px 10px 10px 15px;
    text-transform:capitalize
}
.cate_main.cate_main_mobile .cate_list .submenu li a:before{
    background:inherit;
    position:inherit
}
.cate_list .mCSB_scrollTools .mCSB_draggerContainer{
    right:-12px
}
.cate_list .mCSB_inside .mCSB_container{
    margin-right:0
}
.deals_part{
}
.deals_part h3{
    font-family:'proxima_nova_rgregular';
    letter-spacing:1px;
    color:#3a3a3a;
    text-align:center;
    margin:0 0 40px
}
.deals_part h3 span{
    position:relative
}
.deals_part h3 span:before, .deals_part h3 span:after{
    width:40px;
    height:2px;
    background:#3a3a3a;
    position:absolute;
    left:-90px;
    top:0;
    bottom:0;
    margin:auto;
    content:'';
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease
}
.deals_part h3 span:after{
    right:-90px;
    left:inherit
}
.deals_part:hover h3 span:before{
    left:-50px
}
.deals_part:hover h3 span:after{
    right:-50px
}
.deals_part ul{
    padding:0px
}
.deals_part ul:after{
    clear:both;
    display:block;
    content:''
}
.deals_part ul li{
    list-style:none;
    float:left;
    background:#fff;
    width:32.282352941176473%;
    margin-right:1.568627450980392%;
    margin-bottom:1.568627450980392%;
    position:relative;
    padding:15px 15px 15px 15px
}
.deals_part ul li:hover{
    box-shadow:0 0 10px rgb(204, 204, 204);
    -webkit-box-shadow:0 0 10px rgb(204, 204, 204)
}
.deals_part ul li:nth-child(3n+3){
    margin-right:0px
}
.deals_part ul li .img_part{
    position:relative;
    overflow:hidden;
    text-align:center;
    width:100%;
    margin-bottom:17px
}
.deals_part ul li .img_part .deal_icon{
    position:absolute;
    z-index:1;
    max-width:60px;
    right:5px;
    bottom:5px
}
.deals_part ul li .cont_part{
    padding:10px 10px 15px 10px
}
.deals_part ul li .cont_part .freedeals_list_bottom{
    min-height:35px
}
.deals_part ul li .cont_part .freedeals_list_bottom:after{
    clear:both;
    display:block;
    content:''
}
.deals_part ul li .cont_part .freedeals_list_bottom .quiz_merchant_sec, .deals_part ul li .cont_part .freedeals_list_bottom .endby{
    float:left;
    width:48.5%
}
.deals_part ul li .cont_part .freedeals_list_bottom .endby{
    float:right;
    text-align:right
}
.deals_part ul li .cont_part .sub_offer{
    color:#d92b2e;
    font:16px 'proxima_nova_rgbold';
    margin:0 0 10px
}
.deals_part ul li .cont_part a{
    color:#2a2a2a;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.deals_part ul li .cont_part a.quiz_merchant_sec{
    font:14px 'proxima_nova_rgbold'
}
.deals_part ul li .cont_part .quiz_merchant_title{
    font-size:13px;
    text-transform:none;
    margin-bottom:10px
}
.deals_part ul li .cont_part a:hover{
    color:#25c0d5
}
.deals_part ul li .cont_part .endby{
    margin:0px;
    color:#2a2a2a;
    font:14px 'proxima_nova_rgbold';
    min-height:35px
}
.deals_part ul li .cont_part .endby span{
    font-family:'proxima_nova_rgbold'
}
.deals_part ul li .cont_part .endby span:nth-child(2){
    color:#25C6E1
}
.deals_part ul li .cont_part p{
    margin-bottom:12px;
    line-height:normal;
    font-size:14px;
    max-height:38px;
    overflow:hidden
}
.deals_part ul li .cont_part .quiz_list_title{
    font-family:"proxima_nova_rgbold";
    text-transform:none;
    font-size:15px;
    line-height:normal
}
.deals_part ul li .cont_part .quiz_list_title a, .deals_part ul li .cont_part .quiz_list_title span{
    display:block
}
.deals_part ul li .cont_part .quiz_description{
    font:14px 'proxima_nova_rgregular';
    max-height:32px
}
.deals_part ul li .cont_part .startby{
    margin:0px;
    color:#2a2a2a;
    font:14px 'proxima_nova_rgbold';
    min-height:35px
}
.deals_part ul li .cont_part .startby span{
    font-family:'proxima_nova_rgbold'
}
.deals_part ul li .cont_part .startby span:nth-child(2){
    color:#25C6E1
}
.deals_part ul li .button_bar{
    text-align:center;
    background:#fff;
    position:absolute;
    left:0;
    right:0;
    bottom:-49px;
    padding:0 10px 10px 10px;
    z-index:10;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    -khtml-opacity:0;
    opacity:0;
    box-shadow:0 0 10px rgb(204, 204, 204);
    -webkit-box-shadow:0 0 10px rgb(204, 204, 204);
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.deals_part ul li:hover .button_bar{
    filter:alpha(opacity=100);
    -moz-opacity:1;
    -khtml-opacity:1;
    opacity:1
}
.deals_part ul li .button_bar .common_but{
    font-size:16px;
    width:100%;
    padding:11px 10px 9px 10px;
    line-height:normal;
    background-color:#25c0d5;
    border:1px solid transparent;
    color:#fff;
    display:block;
    border-radius:4px;
    -webkit-border-radius:4px
}
.deals_part ul li .button_bar .common_but:hover{
    border:1px solid #25c0d5;
    color:#25c0d5;
    background-color:#fff
}
.deals_part ul li .button_bar .common_but:hover span{
    color:#25c0d5
}
.deals_part ul li .button_bar:before{
    width:100%;
    height:10px;
    background:#fff;
    content:'';
    position:absolute;
    left:0;
    right:0;
    top:-10px
}
.more_details_par{
    margin-top:30px
}
.more_details_par h5{
    font-family:'proxima_nova_rgregular';
    color:#787878;
    text-align:center;
    margin:0 0 10px;
    font-size:16px
}
.more_details_par h5 span{
    position:relative
}
.more_details_par h5 > span:before, .more_details_par h5>span:after{
    width:26px;
    height:1px;
    background:#787878;
    position:absolute;
    left:-40px;
    top:0;
    bottom:0;
    margin:auto;
    content:'';
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease
}
.more_details_par h5>span:after{
    right:-40px;
    left:inherit
}
.sale_banner{
    margin:40px 0
}
.more_details_par .common_but{
    font:13px/20px 'proxima_nova_rgbold';
    border-radius:0px;
    background:transparent;
    border:2px solid #787878;
    padding:6px 10px 5px 10px;
    min-width:200px;
    color:#787878
}
.more_details_par .common_but:hover{
    background:#25c0d5;
    color:#fff;
    border:2px solid #25c0d5
}
.merchant-main .more_details_par .common_but:hover{
    background:#004282;
    color:#fff;
    border:2px solid #004282
}
.flashsale-main .cate_main .cate_list .cat_side_menu{
    width:320px;
    max-width:320px
}
.flashsale-main .cate_main .cate_list .cat_side_menu>li{
    float:none;
    width:100%
}
.flashsale-main .cate_main .cate_list .cat_side_menu .merchant_submenu_inner li{
    float:none
}
.flashsale-main .cate_main .cate_list .cat_side_menu .merchant_submenu_inner li:before{
    display:none
}
.flashsale-main .category_part .cate_right{
    padding-bottom:20px
}
.flashsale-main .deals_part ul li .img_part{
    position:relative
}
.flashsale-main .deals_part ul li .img_part img{
    max-height:195px
}
.flash_sale_deals ul li .img_part .feature-tag, .flashsale-main .redemption_list .img_part .feature-tag{
    position:absolute;
    left:0;
    top:0
}
.flash_sale_deals ul li .cont_part a:hover{
    color:#53a318
}
.flash_sale_deals ul li .cont_part a.main-title{
    font-family:"proxima_nova_rgbold";
    text-transform:none;
    font-size:15px;
    line-height:normal;
    display:block;
    margin-bottom:10px;
    max-height:38px;
    overflow:hidden
}
.flash_sale_deals ul li .cont_part a.main-title:hover{
    color:#53a318
}
.flash_sale_deals ul li .cont_part p{
    font:14px 'proxima_nova_rgregular';
    max-height:32px
}
.flash_sale_deals .more_details_par .common_but:hover{
    background:#53a318;
    border:2px solid #53a318
}
.flash_sale_deals .discount-part .discount{
    color:#67a136;
    font-size:13px;
    margin-bottom:7px;
    border:1px solid #67a136;
    border-radius:3px;
    -webkit-border-radius:3px;
    text-align:center;
    padding:2px 5px
}
.flash_sale_deals .discount-part .sold{
    font-size:14px;
    font-family:'proxima_nova_rgregular';
    background:url(/images/tag_big.png) no-repeat scroll left -2px transparent;
    padding:0 0 0 25px;
    margin:0;
    background-size:contain
}
.flash_sale_deals .price-part .old-price{
    color:#787878;
    font-size:14px;
    text-decoration:line-through;
    margin-bottom:7px
}
.flash_sale_deals .price-part .new-price{
    color:#53a318;
    font-size:15px;
    font-family:'proxima_nova_rgbold';
    margin:0px
}
.flash_sale_deals .price-part .old-price, .flash_sale_deals .price-part .new-price{
    text-transform:uppercase
}
.flash_sale_deals ul li .button_bar{
    clear:both
}
.flash_sale_deals ul li .button_bar .common_but{
    background-color:#53a318
}
.flash_sale_deals ul li .button_bar .common_but:hover{
    border:1px solid #53a318;
    color:#53a318;
    background-color:#fff
}
.flash_sale_deals ul li .button_bar .common_but:hover span{
    color:#53a318
}
.flash_popup{
    background:#fff none repeat scroll 0 0;
    border-radius:3px;
    box-shadow:0 0 50px rgba(0, 0, 0, 0.5);
    margin:80px auto;
    max-width:1080px;
    padding:40px;
    position:relative
}
.shopping_cart{
    padding-bottom:30px
}
.shopping_cart>h2{
    color:#3a3a3a;
    text-transform:none;
    margin-bottom:8px
}
.shopping_cart>p{
    font-size:20px;
    margin-bottom:20px
}
.shopping_cart > p .small_desc{
    margin-right:10px
}
.shopping_cart > p .small_desc a{
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#787878
}
.shopping_cart > p .small_desc a:hover{
    color:#53a318
}
.shopping_cart > p .star{
    font-size:17px
}
.shopping_cart > p .star .fa{
    color:#f39125
}
.shopping_cart_left{
    border-right:1px solid #d3d3d3;
    margin-right:1.53846%;
    padding-right:1.53846%;
    width:62.1538%
}
.shopping_cart_left .slider-part{
    overflow:hidden
}
.shopping_cart_left .slider-part .slider-desc{
    margin-top:10px
}
.shopping_cart_left .slider-part .slider-desc p{
    line-height:23px;
    font-size:16px
}
.shopping_cart_left .slider-part .slider-desc p:last-of-type{
    margin-bottom:0px
}
.shopping_cart_left .slider-part .desc-part{
    margin-top:40px
}
.shopping_cart_left .slider-part .desc-part.desc-part-enquiry{
    display:none
}
.shopping_cart_left .ask-question-section{
    margin-bottom:10px
}
.shopping_cart_left .slider-part .desc-part h3{
    font-family:'proxima_novasemibold';
    font-size:18px;
    text-transform:none;
    color:#3a3a3a;
    line-height:inherit;
    padding-bottom:15px;
    margin-bottom:20px;
    position:relative
}
.shopping_cart_left .slider-part .desc-part h3:after{
    position:absolute;
    content:'';
    height:1px;
    width:100%;
    background:#d3d3d3;
    left:0;
    bottom:0
}
.shopping_cart_left .slider-part .desc-part ul{
    padding:0 0 0 12px
}
.shopping_cart_left .slider-part .desc-part ul li{
    list-style:none;
    position:relative;
    font-size:16px;
    padding-left:18px;
    margin-bottom:7px
}
.shopping_cart_left .slider-part .desc-part ul li:before{
    position:absolute;
    content:'';
    height:7px;
    width:7px;
    background:#3a3a3a;
    left:0;
    top:5px;
    border-radius:50%
}
.shopping_cart_left .slider-part .reviews-part .star{
    font-size:17px;
    margin-bottom:15px;
    display:inline-block
}
.shopping_cart_left .slider-part .reviews-part .star .fa{
    color:#f39125;
    margin:0 3px 0 0
}
.shopping_cart_left .slider-part .reviews-part ul{
    padding:0px
}
.shopping_cart_left .slider-part .reviews-part ul li{
    padding:0px;
    margin:0 0 20px
}
.shopping_cart_left .slider-part .reviews-part ul li:before{
    display:none
}
.shopping_cart_left .slider-part .reviews-part ul li p{
    margin-bottom:0px;
    color:#3a3a3a
}
.shopping_cart_left .slider-part .reviews-part ul li span{
    color:#888
}
.shopping_cart_left .slider-part .reviews-part .see_all_review{
    font:17px 'proxima_novasemibold';
    color:#53a318
}
.shopping_cart_left .slider-part .reviews-part .see_all_review:hover{
    color:#3a3a3a
}
.shopping_cart_left .slider-part .desc-part .common_but{
    text-transform:none;
    font-size:19px;
    background:#53a318;
    padding:8px 32px;
    cursor:pointer
}
.shopping_cart_left .slider-part .desc-part .common_but:hover{
    background:#2a2a2a
}
.shopping_cart_left .product_enquiry form{
    margin-top:15px
}
.shopping_cart_left .product_enquiry form:after{
    clear:both;
    display:block;
    content:''
}
.shopping_cart_left .product_enquiry label{
    display:block;
    margin-bottom:10px
}
.shopping_cart_left .product_enquiry textarea{
    border:3px solid #eee;
    height:140px;
    margin-bottom:25px
}
.shopping_cart_left .product_enquiry input[type="submit"]{
    float:right;
    width:150px;
    height:45px;
    border-radius:5px;
    -webkit-border-radius:5px;
    text-transform:none;
    font-size:20px;
    background:#53a318
}
.shopping_cart_left .product_enquiry input[type="submit"]:hover{
    background:#2a2a2a
}
.shopping_cart_right{
    width:36.3077%
}
.shopping_cart_right .option-part.simple-product{
    padding-left:0px
}
.shopping_cart_right .option-part{
    border-bottom:1px solid #d3d3d3;
    margin-bottom:20px;
    padding-bottom:15px;
    position:relative;
    padding-left:45px
}
.shopping_cart_right .option-part .field{
    position:absolute;
    left:0;
    top:25px
}
.shopping_cart_right .option-part .prdtitle{
    color:#3a3a3a;
    font:18px/22px 'proxima_novasemibold';
    display:block;
    margin-bottom:10px
}
.shopping_cart_right .price-part:after{
    clear:both;
    display:block;
    content:''
}
.shopping_cart_right .option-part .field input[type=radio].css-radio:checked+label.css-label{
    background-image:url(/images/two-green.png)
}
.shopping_cart_right .attribute_add_error{
    color:#f00;
    margin:0 0 5px;
    line-height:normal;
    font-size:14px
}
.shopping_cart_right .price-part span{
    display:inline-block
}
.shopping_cart_right .price-part .price{
    text-align:right;
    float:right
}
.shopping_cart_right .price-part .old-price{
    display:block;
    text-decoration:line-through
}
.shopping_cart_right .price-part .old-price .priceval{
    text-decoration:line-through
}
.shopping_cart_right .price-part .price .new-price{
    font-size:26px;
    font-family:'proxima_nova_rgbold';
    color:#53a318
}
.shopping_cart_right .price-part .old-price, .shopping_cart_right .price-part .price .new-price{
    text-transform:uppercase
}
.shopping_cart_right .price-part .offer{
    color:#53a318;
    border-radius:3px;
    -webkit-border-radius:3px;
    padding:3px 9px;
    margin-right:20px;
    float:left;
    border:1px solid #53a318;
    position:relative;
    top:15px
}
.shopping_cart_right .price-part .sold{
    font-size:18px;
    position:relative;
    padding-left:32px;
    float:left;
    position:relative;
    top:15px;
    line-height:28px
}
.shopping_cart_right .price-part .sold:before{
    position:absolute;
    left:0;
    content:url(/images/tag_large.png)
}
.shopping_cart_right .qty-box-full{
    position:relative;
    padding-left:135px
}
.color-size-ship{
    border-bottom:1px solid #d3d3d3;
    margin-bottom:23px;
    position:relative
}
.shopping_cart_right .color-size-ship .attribute_add_error{
    position:absolute;
    bottom:0;
    margin:0 0 3px;
    border:none;
    background:transparent;
    padding:0
}
.shopping_cart_right .color-size-ship .attribute_add_error:before{
    display:none
}
.shopping_cart_right .qty-box-full-outer{
    border-bottom:1px solid #d3d3d3;
    margin-bottom:15px;
    padding-bottom:23px
}
.shopping_cart_right .qty-box-full-outer .qty_exceed_error{
    color:#f00;
    line-height:normal;
    font-size:14px
}
.shopping_cart_right .option-part .cashback{
    color:#53a318
}
.error-info,.success-info{
    text-transform:initial;
    font-size:13px;
    margin:5px 0;
    padding:4px 8px 4px 25px;
    line-height:inherit;
    border-radius:3px;
    position:relative
}
.success-info{
    background-color:#e2f6e0;
    border:1px solid #b2e6ac;
    color:#2f773b
}
.success-info:before{
    font-family:'FontAwesome';
    position:absolute;
    left:6px;
    top:6px;
    content:"\f00c";
    font-size:12px
}
.error-info{
    background-color:#f9e5e6;
    border:1px solid #f0bbbe;
    color:#d23e17
}
.error-info:before{
    font-family:'FontAwesome';
    position:absolute;
    left:6px;
    top:6px;
    content:"\f071";
    font-size:12px
}
.shopping_cart_right .qty-box{
    position:absolute;
    left:0
}
.shopping_cart_right .qty-box .title{
    display:inline-block;
    vertical-align:middle;
    margin-right:5px;
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.qty-full{
    position:relative;
    display:inline-block;
    vertical-align:middle;
    border:1px solid #d3d3d3;
    border-radius:2px;
    color:#4e4e4e;
    font-size:14px;
    font-family:"proxima_novasemibold"
}
.qty-full i{
    cursor:pointer;
    float:left;
    width:20px;
    height:40px;
    text-align:center;
    line-height:40px;
    color:#4e4e4e;
    font-size:10px
}
.qty-full input{
    float:left;
    border:0 none;
    display:block;
    width:40px;
    line-height:14px;
    margin-top:6px;
    text-align:center;
    margin:0;
    padding:0;
    height:40px;
    color:#4e4e4e;
    font-size:14px;
    font-family:"proxima_novasemibold"
}
.shopping_cart_right .common_but{
    display:block;
    font:18px 'proxima_nova_rgbold';
    padding:10px 10px;
    background:#53a318;
    max-width:285px;
    margin:0;
    cursor:pointer
}
.shopping_cart_right .common_but:hover{
    background:#2a2a2a
}
.shopping_cart_right #makefollow{
    background:#f39125;
    font-size:15px;
    width:auto;
    display:inline-block;
    padding:6px 14px;
    text-transform:none;
    vertical-align:middle;
    margin-right:5px;
    border:none;
    font-family:'proxima_nova_rgbold';
    color:#fff;
    cursor:pointer;
    border-radius:5px;
    -webkit-border-radius:5px;
    display:block
}
.shopping_cart_right #makefollow:hover{
    background:#2a2a2a
}
.deal-redeem{
    border-bottom:1px solid #d3d3d3;
    padding-bottom:10px
}
.deal-redeem ul{
    padding:0px
}
.deal-redeem ul:after{
    clear:both;
    content:'';
    display:block
}
.deal-redeem ul li{
    list-style:none;
    float:left;
    width:50%;
    text-align:center;
    font-size:18px;
    line-height:24px
}
.deal-redeem ul li .icon, .deal-redeem ul li .day{
    display:block;
    color:#53a318;
    margin-bottom:7px
}
.deal-redeem ul li .icon{
    font-size:28px
}
.redeem-offer{
    border-bottom:1px solid #d3d3d3;
    padding-bottom:20px;
    padding-top:20px
}
.redeem-offer-inner{
    position:relative;
    padding-left:145px;
    min-height:115px
}
.redeem-offer h6{
    font-size:18px;
    color:#3a3a3a;
    text-transform:none;
    margin-bottom:10px;
    font-family:"proxima_novasemibold"
}
.redeem-offer .img-part{
    width:130px;
    height:115px;
    overflow:hidden;
    border:1px solid #d3d3d3;
    position:absolute;
    left:0px
}
.redeem-offer .img-part img{
    width:100%;
    height:100%;
    object-fit:cover
}
.redeem-offer .cont-part{
}
.redeem-offer .cont-part p{
    font:15px/24px 'proxima_nova_rgbold';
    color:#f39125;
    margin-bottom:8px
}
.redeem-offer .cont-part h6, .redeem-offer .cont-part h6 a{
    color:#3a3a3a;
    text-transform:none;
    font:18px/22px 'proxima_nova_rgbold';
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.redeem-offer .cont-part h6 a:hover{
    color:#53a318
}
.redeem-offer .cont-part .common_but{
    background:#f39125;
    font-size:15px;
    width:auto;
    display:inline-block;
    padding:6px 14px;
    text-transform:none;
    vertical-align:middle;
    margin-right:5px
}
.redeem-offer .cont-part .common_but:hover{
    background:#2a2a2a
}
.redeem-offer .cont-part .show{
    color:#3a3a3a;
    text-decoration:underline
}
.redeem-offer .cont-part .show:hover{
    color:#53a318
}
.redeem-offer-inner .show-redeem-outlet{
    cursor:pointer;
    text-decoration:underline;
    color:#3a3a3a;
    display:inline-block;
    margin-bottom:10px
}
.redeem-offer-inner .show-redeem-outlet:hover{
    color:#53a318
}
.redeem-offer-inner-section ul{
    padding:0px;
    margin-top:15px
}
.redeem-offer-inner-section ul li{
    list-style:none;
    border-bottom:1px dashed #ccc;
    padding-bottom:10px;
    margin-bottom:10px
}
.redeem-offer-inner-section ul li:last-child{
    border:none;
    margin:0;
    padding:0
}
.redeem-offer-inner-section ul li .redeem_outlet_name{
    font:16px 'proxima_novasemibold';
    color:#3a3a3a;
    margin:0 0 5px
}
.redeem-offer-inner-section ul li .redeem_outlet_address{
    line-height:normal;
    font-size:15px
}
.redeem-offer-inner-section ul li .redeem_outlet_address:last-of-type{
    margin-bottom:0px
}
.share_icon{
    position:relative;
    padding-top:20px;
    margin-bottom:40px
}
.share_icon span{
    display:inline-block;
    text-transform:uppercase;
    font-size:14px;
    margin-bottom:10px
}
.share_icon ul{
    padding:0px
}
.share_icon ul:after{
    clear:both;
    display:block;
    content:''
}
.share_icon ul li{
    float:left;
    margin-right:10px;
    list-style:none
}
.share_icon ul li:last-child{
    margin-right:0px
}
.share_icon ul li a{
    color:#787878;
    font-size:25px;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.share_icon ul li a:hover{
    color:#53a318
}
.how-to-redeem{
}
.how-to-redeem h6{
    position:relative;
    padding-bottom:15px;
    margin-bottom:15px;
    font:18px 'proxima_novasemibold';
    color:#3a3a3a;
    text-transform:none
}
.how-to-redeem h6:after{
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:1px;
    background:#d3d3d3;
    content:''
}
.no-print{
    position:relative;
    min-height:60px;
    padding-left:70px;
    padding-top:5px;
    margin-bottom:30px
}
.no-print-img{
    width:60px;
    height:60px;
    overflow:hidden;
    border-radius:50%;
    -webkit-border-radius:50%;
    position:absolute;
    left:0;
    top:0
}
.no-print-img img{
    width:100%;
    height:100%;
    object-fit:cover
}
.steps-part ul{
    padding:0 0 20px;
    border-bottom:1px solid #eeeeef
}
.steps-part ul li{
    list-style:none;
    margin-bottom:30px
}
.steps-part ul li:last-child{
    margin-bottom:0px
}
.steps-part ul li .icon{
    display:inline-block;
    background:#f39125;
    color:#fff;
    padding:6px 20px;
    border-radius:30px;
    margin-bottom:15px
}
.steps-part ul li img{
    display:block;
    margin:auto;
    margin-bottom:15px
}
.steps-part ul li p{
    margin-bottom:0px;
    text-align:center
}
.how-to-redeem .show-hide{
    color:#53a318;
    font-size:17px;
    margin-top:15px;
    display:inline-block;
    cursor:pointer
}
.how-to-redeem .show-hide:hover{
    color:#2a2a2a
}
.cancel-policy{
    margin-top:30px;
    display:block
}
.cancel-policy h6{
    position:relative;
    margin-bottom:10px;
    font:18px 'proxima_novasemibold';
    color:#3a3a3a;
    text-transform:none
}
.cancel-policy p{
    margin:0;
    border-top:1px solid #eeeeef;
    border-bottom:1px solid #eeeeef;
    padding:20px 0;
    margin-bottom:20px;
    font-size:16px
}
.cancel-policy a{
    color:#53a318
}
.cancel-policy a:hover{
    color:#2a2a2a
}
.more_offers_slider_part{
    padding:40px;
    background:#f5f5f5;
    margin:0 -40px -40px -40px;
    border-top:1px solid #d3d3d3
}
.more_offers_top{
    margin-bottom:50px
}
.more_offers_title{
    position:relative;
    padding-right:80px
}
.more_offers_title h6{
    margin-bottom:30px;
    font:24px 'proxima_novasemibold';
    color:#3a3a3a;
    text-transform:none
}
.more_offers_title a{
    position:absolute;
    right:0;
    top:7px;
    color:#53a318;
    font:17px 'proxima_novasemibold'
}
.more_offers_title a:hover{
    color:#2a2a2a
}
.more_offer_slider .pro-slide-con .main-title{
    color:#2a2a2a;
    font-family:'proxima_novaextrabold';
    font-size:19px;
    margin-bottom:12px;
    display:inline-block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.more_offer_slider .pro-slide-con .main-title:hover{
    color:#53a318
}
.more_offer_slider .pro-slide-con .discount{
    color:#53a318;
    margin:0 0 10px;
    font-size:17px;
    font-family:'proxima_novasemibold'
}
.more_offer_slider .pro-slide-con .sold{
    font-size:17px;
    font-family:'proxima_nova_rgregular';
    background:url(/images/tag_big.png) no-repeat scroll left -2px transparent;
    padding:0 0 0 28px;
    margin:0
}
.more_offer_slider .pro-slide-con .price-part .old-price{
    font-size:17px;
    text-decoration:line-through;
    margin-bottom:10px
}
.more_offer_slider .pro-slide-con .price-part .new-price{
    color:#53a318;
    font-size:21px;
    font-family:'proxima_novaextrabold';
    margin:0px
}
.more_product_slider .pro-slide .pro-slide-con{
    padding:20px
}
.more_product_slider .pro-slide p{
    font:16px/22px 'proxima_nova_rgregular';
    margin-bottom:20px
}
.more_product_slider .pro-slide{
    background:#fff;
    border-radius:5px;
    -webkit-border-radius:5px;
    position:relative;
    overflow:hidden
}
.more_product_slider .item{
    padding:0px
}
.more_product_slider .review-part .review-icon{
    margin:0;
    color:#f3801a
}
.more_product_slider .review-part .reviews{
    margin:0
}
.more_product_slider .price-part .old-price{
    margin:0px;
    text-decoration:line-through
}
.more_product_slider .price-part .new-price{
    margin:0px;
    color:#2a2a2a;
    font-size:21px;
    font-family:'proxima_novaextrabold'
}
.more_offers_slider_part .owl-carousel{
    padding:0 30px
}
.more_offers_slider_part .owl-theme .owl-prev, .more_offers_slider_part .owl-theme .owl-next{
    background:transparent;
    left:-10px
}
.more_offers_slider_part .owl-theme .owl-next{
    right:-10px;
    left:inherit
}
.more_offers_slider_part .owl-theme .owl-prev:after, .more_offers_slider_part .owl-theme .owl-next:before{
    color:#2a2a2a;
    font-size:30px
}
.other_product_slider .pro-slide .pro-slide-img{
    padding-top:20px
}
.more_offers_slider_part .more_offer_slider .owl-carousel img{
    width:100%
}
.flash_detail_product_popup{
}
.flash_detail_product_popup .shopping_cart_right .option-part{
    padding-left:0px
}
.shopping_cart_right .option-part .price-part{
    min-height:51px
}
.zoomContainer{
    z-index:1100
}
.zoomContainer .zoomLens{
    border:3px solid #ccc !important
}
.flash_detail_product_popup .shopping_cart_left .slider-part .elevatezoom>img{
    margin:0 auto;
    display:block;
    max-width:600px;
    max-height:600px;
    overflow:hidden
}
.shopping_cart_left .slider-part .elevatezoom #galez{
    margin-top:15px
}
.shopping_cart_left .slider-part .elevatezoom #galez:after{
    clear:both;
    display:block;
    content:''
}
.shopping_cart_left .slider-part .elevatezoom #galez a{
    display:block;
    width:90px;
    height:90px;
    overflow:hidden;
    float:left;
    margin:0 10px 10px 0;
    border:1px solid #e4e4e4;
    padding:5px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.shopping_cart_left .slider-part .elevatezoom #galez a:hover, .shopping_cart_left .slider-part .elevatezoom #galez a.zoomGalleryActive{
    border:1px solid #53a318
}
.shopping_cart_left .slider-part .elevatezoom #galez a img{
    width:100%;
    height:100%;
    object-fit:cover;
    padding:0
}
.color-size-ship h6{
    color:#3a3a3a;
    margin-bottom:10px
}
.color-size-ship ul{
    padding:0px
}
.color-size-ship ul li{
    list-style:none
}
.color-size-ship .color-part{
    margin-bottom:15px
}
.color-size-ship .color-part ul:after{
    clear:both;
    display:block;
    content:''
}
.color-size-ship .color-part ul li.disabled a{
    filter:alpha(opacity=40);
    -moz-opacity:0.4;
    -khtml-opacity:0.4;
    opacity:0.4
}
.color-size-ship .color-part ul li a{
    width:60px;
    height:60px;
    overflow:hidden;
    display:block;
    float:left;
    margin:0 10px 10px 0;
    border:2px solid #d3d3d3;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    cursor:pointer
}
.color-size-ship .color-part ul li a:hover, .color-size-ship .color-part ul li a.active{
    border:2px solid #53a318
}
.color-size-ship .color-part ul li a img{
    width:100%;
    height:100%;
    object-fit:cover
}
.color-size-ship .size-part{
    margin-bottom:20px
}
.color-size-ship .size-part ul:after{
    clear:both;
    display:block;
    content:''
}
.color-size-ship .size-part ul li{
    float:left;
    margin-right:10px;
    margin-top:2px;
    margin-bottom:2px;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.color-size-ship .size-part ul li.disabled a{
    filter:alpha(opacity=40);
    -moz-opacity:0.4;
    -khtml-opacity:0.4;
    opacity:0.4
}
.color-size-ship .size-part ul li a{
    font:14px 'proxima_novasemibold';
    min-width:28px;
    height:28px;
    overflow:hidden;
    text-align:center;
    line-height:28px;
    color:#4e4e4e;
    display:block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    border:1px solid #d3d3d3;
    border-radius:3px;
    -webkit-border-radius:3px;
    cursor:pointer;
    text-transform:uppercase;
    padding:0 3px
}
.color-size-ship .size-part ul li a:hover, .color-size-ship .size-part ul li a.active{
    border:1px solid #53a318
}
.selectship-part{
    margin-bottom:15px
}
.selectship-part h6{
    position:relative;
    color:#53a318
}
.selectship-part span.estimate{
    position:absolute;
    right:0;
    top:0;
    color:#53a318;
    font-family:'proxima_nova_rgregular';
    text-transform:none
}
.selectship-part .chosen-container-single .chosen-single, .selectship-part .chosen-container-single .chosen-single:after{
    line-height:40px
}
.selectship-part .chosen-container-single .chosen-single{
    text-align:left;
    border:1px solid #d3d3d3;
    background:transparent;
    margin:0 0 5px
}
.selectship-part .chosen-container-single .chosen-single:after{
    right:0;
    width:25px;
    text-align:center;
    background:#f3f3f3;
    border-left:1px solid #d3d3d3;
    transition:none;
    transform:none
}
input[type=radio].css-radio{
    position:absolute;
    z-index:-1000;
    left:-1000px;
    overflow:hidden;
    clip:rect(0 0 0 0);
    height:1px;
    width:1px;
    margin:-1px;
    padding:0;
    border:0
}
input[type=radio].css-radio+label.css-label{
    padding-left:35px;
    display:inline-block;
    background-repeat:no-repeat;
    vertical-align:middle;
    cursor:pointer;
    font:16px/22px 'proxima_nova_rgregular'
}
input[type=radio].css-radio:checked+label.css-label{
    background-image:url(/images/two.png)
}
label.css-label{
    background-image:url(/images/one.png);
    -webkit-touch-callout:none;
    -webkit-user-select:none;
    -khtml-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.shopping_slide_part{
    position:relative
}
.shop_slider{
    padding:0
}
.shopping_slide_part .bx-wrapper .bx-pager, .shopping_slide_part .bx-wrapper .bx-controls-auto{
    position:absolute;
    bottom:25px;
    width:100%;
    left:0;
    z-index:51
}
.shopping_slide_part .bx-wrapper .bx-pager{
    text-align:center;
    font-size:0
}
.shopping_slide_part .bx-wrapper .bx-pager .bx-pager-item, .shopping_slide_part .bx-wrapper .bx-controls-auto .bx-controls-auto-item{
    display:inline-block;
    *zoom:1;
    *display:inline
}
.shopping_slide_part .bx-wrapper .bx-pager.bx-default-pager a{
    text-indent:-9999px;
    display:block;
    width:12px;
    height:12px;
    border-radius:50%;
    -webkit-border-radius:50%;
    margin:0 3px;
    outline:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    border:2px solid #fff;
    background:transparent
}
.shopping_slide_part .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#ed1c4a;
    border:2px solid #ed1c4a
}
.shop_now_part{
    margin-top:20px
}
.shop_now_part:after{
    clear:both;
    display:block;
    content:''
}
.shop_now_part .shop_now{
    float:left;
    width:32.5%;
    margin-right:1.25%;
    background:#fff
}
.shop_now_part .shop_now:nth-of-type(3n+3){
    margin-right:0px
}
.shop_now_part .shop_now_inner{
    padding:20px
}
.shop_now_part .skyblue .shop_now_inner{
    background:#00b1bb
}
.shop_now_part .skyblue .shop_now_cont{
    text-align:center;
    color:#fff
}
.shop_now_part .skyblue .shop_now_cont h3{
    text-transform:inherit;
    font:36px 'TiemposHeadlineBold';
    position:relative;
    color:#fff;
    padding-bottom:11px;
    margin:0 0 15px
}
.shop_now_part .skyblue .shop_now_cont h3:after{
    bottom:0;
    position:absolute;
    left:0;
    right:0;
    margin:auto;
    height:1px;
    width:100px;
    content:'';
    background:#fff
}
.shop_now_part .shop_link{
    font:16px 'proxima_nova_rgbold';
    text-transform:uppercase;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    display:block;
    padding:15px 20px
}
.shop_now_part .skyblue .shop_link{
    color:#00b1bb
}
.shop_now_part .skyblue .shop_now_cont p{
    font:15px/20px 'NationalBook'
}
.shop_now_part .green .shop_now_inner{
    background:#97d44e
}
.shop_now_part .green .shop_now_inner h3{
    text-align:center;
    color:#fff;
    margin:0 0 5px;
    font:28px/30px 'texgyreadventorbold'
}
.shop_now_part .green .shop_now_inner p{
    font:15px 'texgyreadventorregular';
    color:#fff;
    text-align:right;
    margin:0;
    line-height:1
}
.shop_now_part .green .shop_now_inner p span{
    font:24px 'texgyreadventorbold';
    color:#ffe615;
    display:block;
    text-transform:uppercase
}
.shop_now_part .green .shop_link{
    color:#97d44e
}
.shop_now_part .yellow .shop_now_inner{
    background:#ff9515
}
.shop_now_part .yellow .shop_now_inner h3{
    text-align:center;
    font-size:21px;
    font-family:tahoma,sans-serif;
    line-height:24px;
    color:#fff;
    margin:0 0 10px;
    text-transform:inherit
}
.shop_now_part .yellow .shop_now_inner p{
    text-align:center;
    color:#fff
}
.shop_now_part .yellow .shop_now_inner p span{
    display:block;
    font-family:'terminal_dosisextrabold';
    margin:0 0 8px
}
.shop_now_part .yellow .upto{
    font-size:17px
}
.shop_now_part .yellow .percent{
    font-size:38px
}
.shop_now_part .yellow .disc{
    font-size:18px;
    text-transform:uppercase
}
.shop_now_part .yellow .shop_link{
    color:#ff9515
}
.shop_now_part .skyblue .shop_link:hover, .shop_now_part .green .shop_link:hover, .shop_now_part .yellow .shop_link:hover{
    color:#2a2a2a
}
.shop_now .shop_now_img{
    width:42.30769230769231%
}
.shop_now .shop_now_cont{
    width:57.69230769230769%;
    padding-right:10px
}
.shop-product-section .womens-sec .pro-com-right{
    padding:0px
}
.shop-product-section .womens-sec{
    border-top:4px solid #ff3a81
}
.shop-product-section .womens-sec h3{
    color:#ff3a81
}
.shop-product-section .womens-sec h3:after{
    background:#ff3a81
}
.shop-product-section .womens-sec a:hover{
    color:#ff3a81
}
.shop-product-section .womens-sec .store-slider .cont-part{
    background:#ff3a81
}
.shop-product-section .womens-sec .store-slider .cont-part h5{
    border-bottom:1px solid #ff72a5
}
.shop-product-section .womens-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#ff3a81
}
.shop-product-section .womens-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#ff3a81
}
.shop-product-section .womens-sec .slide-right-part ul li:first-child{
    background:#eeedd9
}
.shop-product-section .mens-sec .pro-com-right{
    padding:0px
}
.shop-product-section .mens-sec{
    border-top:4px solid #3e4cb7
}
.shop-product-section .mens-sec h3{
    color:#3e4cb7
}
.shop-product-section .mens-sec h3:after{
    background:#3e4cb7
}
.shop-product-section .mens-sec a:hover{
    color:#3e4cb7
}
.shop-product-section .mens-sec .store-slider .cont-part{
    background:#3e4cb7
}
.shop-product-section .mens-sec .store-slider .cont-part h5{
    border-bottom:1px solid #5e6cd5
}
.shop-product-section .mens-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#3e4cb7
}
.shop-product-section .mens-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#3e4cb7
}
.shop-product-section .mens-sec .slide-right-part ul li:first-child{
    background:#eff2f7
}
.shop-product-section .mens-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#3a6fb9
}
.shop-product-section .mens-sec .pro-com-right{
    padding:0px
}
.shop-product-section .mens-sec{
    border-top:4px solid #f6402b
}
.shop-product-section .mens-sec h3{
    color:#f6402b
}
.shop-product-section .mens-sec h3:after{
    background:#f6402b
}
.shop-product-section .mens-sec a:hover{
    color:#f6402b
}
.shop-product-section .mens-sec .store-slider .cont-part{
    background:#f6402b
}
.shop-product-section .mens-sec .store-slider .cont-part h5{
    border-bottom:1px solid #f77465
}
.shop-product-section .mens-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#f6402b
}
.shop-product-section .mens-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#f6402b
}
.shop-product-section .mens-sec .slide-right-part ul li:first-child{
    background:#f0f1f3
}
.shop-product-section .mens-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#373840
}
.shop-product-section .comp-sec .pro-com-right{
    padding:0px
}
.shop-product-section .comp-sec{
    border-top:4px solid #46af4a
}
.shop-product-section .comp-sec h3{
    color:#46af4a
}
.shop-product-section .comp-sec h3:after{
    background:#46af4a
}
.shop-product-section .comp-sec a:hover{
    color:#f6402b
}
.shop-product-section .comp-sec .store-slider .cont-part{
    background:#46af4a
}
.shop-product-section .comp-sec .store-slider .cont-part h5{
    border-bottom:1px solid #64ce68
}
.shop-product-section .comp-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#46af4a
}
.shop-product-section .comp-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#46af4a
}
.shop-product-section .comp-sec .slide-right-part ul li:first-child{
    background:#eef3f7
}
.shop-product-section .comp-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#373840
}
.shop-product-section .elect-sec .pro-com-right{
    padding:0px
}
.shop-product-section .elect-sec, .merchant-product-section .life_style{
    border-top:4px solid #88c440
}
.shop-product-section .elect-sec h3, .merchant-product-section .life_style h3{
    color:#88c440
}
.shop-product-section .elect-sec h3:after, .merchant-product-section .life_style h3:after{
    background:#88c440
}
.shop-product-section .elect-sec a:hover, .merchant-product-section .life_style a:hover{
    color:#88c440
}
.shop-product-section .elect-sec .store-slider .cont-part{
    background:#88c440
}
.shop-product-section .elect-sec .store-slider .cont-part h5{
    border-bottom:1px solid #88c440
}
.shop-product-section .elect-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#88c440
}
.shop-product-section .elect-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#88c440
}
.shop-product-section .elect-sec .slide-right-part ul li:first-child{
    background:#dadad8
}
.shop-product-section .elect-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#333534
}
.shop-product-section .watch-sec .pro-com-right{
    padding:0px
}
.shop-product-section .watch-sec{
    border-top:4px solid #1193f5
}
.shop-product-section .watch-sec h3{
    color:#1193f5
}
.shop-product-section .watch-sec h3:after{
    background:#1193f5
}
.shop-product-section .watch-sec a:hover{
    color:#1193f5
}
.shop-product-section .watch-sec .store-slider .cont-part{
    background:#1193f5
}
.shop-product-section .watch-sec .store-slider .cont-part h5{
    border-bottom:1px solid #65b4f0
}
.shop-product-section .watch-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#1193f5
}
.shop-product-section .watch-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#1193f5
}
.shop-product-section .watch-sec .slide-right-part ul li:first-child{
    background:#f5f2eb
}
.shop-product-section .watch-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#dd980d
}
.shop-product-section .furn-sec .pro-com-right{
    padding:0px
}
.shop-product-section .furn-sec{
    border-top:4px solid #7a5447
}
.shop-product-section .furn-sec h3{
    color:#7a5447
}
.shop-product-section .furn-sec h3:after{
    background:#7a5447
}
.shop-product-section .furn-sec a:hover{
    color:#ab583c
}
.shop-product-section .furn-sec .store-slider .cont-part{
    background:#7a5447
}
.shop-product-section .furn-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#7a5447
}
.shop-product-section .furn-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#7a5447
}
.shop-product-section .furn-sec .store-slider .cont-part h5{
    border-bottom:1px solid #9e7c71
}
.shop-product-section .furn-sec .slide-right-part ul li:first-child{
    background:#f2f0e4
}
.shop-product-section .furn-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#e68346
}
.shop-product-section .shoe-sec .pro-com-right{
    padding:0px
}
.shop-product-section .shoe-sec{
    border-top:4px solid #6aa5c6
}
.shop-product-section .shoe-sec h3{
    color:#6aa5c6
}
.shop-product-section .shoe-sec h3:after{
    background:#6aa5c6
}
.shop-product-section .shoe-sec a:hover{
    color:#6aa5c6
}
.shop-product-section .shoe-sec .store-slider .cont-part{
    background:#6aa5c6
}
.shop-product-section .shoe-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#6aa5c6
}
.shop-product-section .shoe-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#6aa5c6
}
.shop-product-section .shoe-sec .store-slider .cont-part h5{
    border-bottom:1px solid #8cbdd9
}
.shop-product-section .shoe-sec .slide-right-part ul li:first-child{
    background:#f4f4f4
}
.shop-product-section .shoe-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#e68346
}
.shop-product-section .baby-sec .pro-com-right{
    padding:0px
}
.shop-product-section .baby-sec{
    border-top:4px solid #009788
}
.shop-product-section .baby-sec h3{
    color:#009788
}
.shop-product-section .baby-sec h3:after{
    background:#009788
}
.shop-product-section .baby-sec a:hover{
    color:#009788
}
.shop-product-section .baby-sec .store-slider .cont-part{
    background:#009788
}
.shop-product-section .baby-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#009788
}
.shop-product-section .baby-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#009788
}
.shop-product-section .baby-sec .store-slider .cont-part h5{
    border-bottom:1px solid #0cbbaa
}
.shop-product-section .baby-sec .slide-right-part ul li:first-child{
    background:#f6eced
}
.shop-product-section .baby-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#a96153
}
.shop-product-section .out-sec .pro-com-right{
    padding:0px
}
.shop-product-section .out-sec{
    border-top:4px solid #ff9801
}
.shop-product-section .out-sec h3{
    color:#ff9801
}
.shop-product-section .out-sec h3:after{
    background:#ff9801
}
.shop-product-section .out-sec a:hover{
    color:#ff9801
}
.shop-product-section .out-sec .store-slider .cont-part{
    background:#ff9801
}
.shop-product-section .out-sec .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#ff9801
}
.shop-product-section .out-sec .slide-part .bx-wrapper .bx-controls-direction a:hover{
    background:#ff9801
}
.shop-product-section .out-sec .store-slider .cont-part h5{
    border-bottom:1px solid #ffb64c
}
.shop-product-section .out-sec .slide-right-part ul li:first-child{
    background:#f8faf7
}
.shop-product-section .out-sec .slide-right-part ul li:first-child .cont-part h5{
    color:#82483d
}
.freedeal_popup{
    padding:25px;
    border-radius:5px;
    -webkit-border-radius:5px;
    max-width:1024px;
    margin:30px auto;
    position:relative;
    background:#fff
}
.freedeal_popup .mfp-close{
    color:#2a2a2a
}
.freedeal_popup .freedeal_popup_left{
    width:37.11340206185567%;
    position:relative
}
.freedeal_popup .freedeal_popup_right{
    width:58.76288659793815%
}
.freedeal_popup h2{
    color:#3a3a3a;
    font:23px "proxima_nova_rgbold";
    text-transform:uppercase;
    margin-bottom:15px;
    position:relative
}
.freedeal_popup h2 a{
    color:#555;
    padding-left:30px;
    position:relative
}
.freedeal_popup h2 a::after{
    content:"";
    background:transparent url(../media/full_sprite.png);
    display:block;
    height:25px;
    width:25px;
    left:0px;
    position:absolute;
    top:-4px;
    background-position:111px -124px
}
.freedeal_popup h2 a:hover::after{
    background-position:83px -124px
}
.freedeal_popup .free{
    color:#000;
    font:23px 'proxima_nova_rgbold';
    display:block;
    margin-bottom:15px;
    text-transform:uppercase;
    padding-right:80px
}
.freedeal_popup .quiz_link{
    color:#3a3a3a;
    font:17px 'proxima_nova_rgbold';
    display:block;
    margin-bottom:15px
}
.freedeal_popup .time{
    color:#2a2a2a;
    font:15px "proxima_nova_rgbold";
    margin-bottom:0px
}
.freedeal_popup .time span{
    color:#25c0d5;
    font:18px 'proxima_nova_rgbold';
    margin-top:7px;
    display:block
}
.freedeal_popup .common_but{
    font-size:18px;
    padding:8px 33px;
    border:none;
    cursor:pointer
}
.mfp-content .question_ttiel .free{
}
.freedeal_popup_left .freedeal_image_detail_slider{
    padding:0
}
.participate_bottom{
    margin-bottom:20px
}
.participate_bottom:after{
    clear:both;
    display:block;
    content:''
}
.participate_bottom_left .visit_merchant{
    display:inline-block;
    margin:0;
    position:relative;
    color:#25c6e1;
    font:15px 'proxima_nova_rgbold';
    text-decoration:underline;
    text-decoration-color:#d7f1f8;
    padding-left:22px
}
.participate_bottom_left .visit_merchant:hover{
    color:#2a2a2a
}
.participate_bottom_left .visit_merchant:before{
    position:absolute;
    left:0;
    top:2px;
    color:#888;
    content:"\f0c1";
    font-family:'FontAwesome'
}
.participate_bottom_left p{
    margin-bottom:0px;
    margin-top:7px;
    color:#2a2a2a;
    font:18px 'proxima_nova_rgbold'
}
.participate_bottom_left,.participate_bottom_right{
    float:left;
    width:48.5%
}
.participate_bottom_right{
    float:right
}
.participate_popup .freedeal_popup_right{
    position:relative
}
.participate_popup .freedeal_popup_right .deal_icon{
    position:absolute;
    right:20px;
    top:-10px;
    max-width:50px
}
.freedeal_popup .adidas_inner{
    width:100%;
    display:inline-block
}
.freedeal_popup .adidas_left{
    width:37.1134%;
    float:left;
    padding-right:10px
}
.freedeal_popup .adidas_right{
    width:58.7629%;
    float:right
}
.freedeal_popup .adidas_logo{
    margin-bottom:30px
}
.ques_title{
    font:17px 'proxima_novasemibold';
    color:#3a3a3a;
    margin:0 0 20px
}
.question_popup{
    padding:50px
}
.question_popup .common_but{
    font-size:18px;
    width:auto;
    padding:10px 25px;
    border:none;
    background:#FE9B1A;
    float:right;
    margin-top:75px
}
.question_popup .common_but:hover{
    background:#2a2a2a;
    color:#fff
}
.question_popup form:after{
    clear:both;
    display:block;
    content:''
}
.question_popup form .ques-group{
    margin:15px 0 25px
}
.question_popup form .ques-group:last-of-type{
    margin-bottom:0px
}
.question_popup form .ques-group:nth-of-type(even){
}
.question_popup .hidden_fields{
    display:none
}
.participate_error{
    color:#d92b2e
}
.question_popup .owl-carousel .owl-wrapper, .question_popup .owl-carousel .owl-item{
    padding:0px
}
.question_popup .owl-carousel .owl-wrapper-outer{
    padding-bottom:0px
}
.question_popup .owl-theme .owl-controls{
    text-align:left;
    position:absolute;
    bottom:0px
}
.question_popup .owl-theme .owl-controls .owl-buttons div{
    background:transparent
}
.question_popup .owl-theme .owl-controls .owl-buttons .owl-prev, .question_popup .owl-theme .owl-controls .owl-buttons .owl-next{
    position:relative;
    width:auto;
    height:auto;
    padding:5px 25px;
    border:none;
    background:#FE9B1A;
    margin-top:10px;
    opacity:1;
    border-radius:5px;
    text-transform:uppercase;
    font:18px/24px 'proxima_nova_rgbold';
    left:0;
    bottom:0;
    top:inherit;
    right:inherit
}
.question_popup .owl-theme .owl-controls .owl-buttons .owl-prev:hover, .question_popup .owl-theme .owl-controls .owl-buttons .owl-next:hover{
    background:#2a2a2a
}
.question_popup .owl-theme .owl-controls .owl-buttons .owl-prev:after, .question_popup .owl-theme .owl-controls .owl-buttons .owl-next:before{
    display:none
}
.quiz-participation-class .owl-prev.disabled{
    display:none !important
}
.quiz-participation-class .owl-next.disabled{
    display:none !important
}
.question_popup .form-group{
    clear:both
}
.winners_popup{
    padding:10px;
    border-radius:10px
}
.winners_popup h3{
    font:18px 'proxima_nova_rgbold';
    color:#333;
    background:#f7f7f7;
    border-bottom:1px solid #e5e5e5;
    margin:-10px -10px 0 -10px;
    padding:14px 25px 13px 20px;
    border-radius:10px 10px 0 0;
    -webkit-border-radius:10px 10px 0 0
}
.draw_part{
    position:relative;
    min-height:84px;
    padding:10px 0 10px 85px
}
.draw_img{
    width:64px;
    height:64px;
    position:absolute;
    left:0;
    top:10px;
    overflow:hidden
}
.draw_cont p{
    margin-bottom:5px;
    text-transform:uppercase;
    color:#333;
    font-family:'proxima_nova_rgbold'
}
.draw_cont span{
    color:#888
}
.draw_cont .devider{
    margin:0 10px
}
[data-simplebar]{
    position:relative;
    z-index:0;
    overflow:hidden;
    -webkit-overflow-scrolling:touch
}
[data-simplebar=init]{
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex
}
.simplebar-scroll-content{
    overflow-x:hidden;
    overflow-y:scroll;
    min-width:100%;
    box-sizing:content-box
}
.simplebar-content{
    overflow-x:scroll;
    overflow-y:hidden;
    box-sizing:border-box;
    min-height:100%
}
.simplebar-track{
    z-index:1;
    position:absolute;
    right:0;
    bottom:0;
    width:11px
}
.simplebar-scrollbar{
    position:absolute;
    right:2px;
    border-radius:7px;
    min-height:10px;
    width:7px;
    opacity:0;
    -webkit-transition:opacity .2s linear;
    transition:opacity .2s linear;
    background:#000;
    background-clip:padding-box
}
.simplebar-track:hover .simplebar-scrollbar{
    opacity:.5;
    -webkit-transition:opacity 0 linear;
    transition:opacity 0 linear
}
.simplebar-track .simplebar-scrollbar.visible{
    opacity:.5
}
.simplebar-track.horizontal{
    left:0;
    width:auto;
    height:11px
}
.simplebar-track.vertical{
    top:0
}
.horizontal.simplebar-track .simplebar-scrollbar{
    right:auto;
    top:2px;
    height:7px;
    min-height:0;
    min-width:10px;
    width:auto
}
.scroll_bar{
    margin:10px 0;
    width:100%;
    height:335px
}
.thankyou_popup{
    padding:0px
}
.thanks_part{
    padding:40px
}
.thanks_part h2{
    font:38px 'proxima_novalight';
    color:#3b3b3b;
    margin-bottom:15px
}
.thanks_part p{
    font-size:18px
}
.thanks_part .exbold{
    font-family:'proxima_novaextrabold';
    color:#3a3a3a;
    font-size:17px
}
.thanks_part .point{
    font-size:15px;
    margin:20px 0 0 0
}
.thanks_part .point span{
    color:#2ac0d5;
    font:16px 'proxima_nova_rgbold'
}
.sale_store{
    padding:40px;
    background:#f5f5f5
}
.store_part h3{
    color:#da0001
}
.sale_part h3{
    color:#53a318
}
.store_part h3 span, .sale_part h3 span{
    color:#3a3a3a;
    font-family:'proxima_nova_rgregular'
}
.sale_part{
    margin-bottom:40px
}
.sale_part_sec{
    border-radius:5px;
    -wekbit-border-radius:5px;
    background:#fff;
    border-top:4px solid #53a318;
    padding:30px
}
.sale_part_left{
    width:62.30366492146597%;
    text-align:center
}
.sale_part_right{
    width:37.69633507853403%
}
.sale_part_right h3{
    font-size:22px;
    color:#2a2a2a;
    margin:0 0 10px
}
.sale_part_right h3 a{
    color:#2a2a2a;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.sale_part_right h3 a:hover{
    color:#53a318
}
.sale_part_right p{
    font-size:16px;
    margin:0 0 30px
}
.sale_part_right .price{
    font-size:22px;
    color:#2a2a2a;
    margin:0 0 10px;
    font-family:'proxima_novaextrabold'
}
.sale_part_right .spl-price{
    margin:0 0 10px
}
.sale_part_right .spl-price .dis{
    color:#53a318;
    font-size:15px;
    padding-left:10px;
    font-family:'proxima_novasemibold'
}
.sale_part_right .spl-price .strike{
    text-decoration:line-through
}
.sale_part_right .sold{
    margin:0 0 30px;
    position:relative;
    padding:0 0 0 20px;
    font-size:15px
}
.sale_part_right .sold img{
    position:absolute;
    top:1px;
    left:0
}
.sale_part_right .sold span{
    display:inline-block
}
.sale_part_right .common_but{
    background:#53a318;
    font-size:15px;
    width:115px;
    height:30px;
    padding:4px 10px
}
.sale_part_right .common_but:hover{
    color:#fff;
    background:#2a2a2a
}
.store-part-owl-carousel .pro-slide .pro-slide-con{
    padding:15px
}
.store-part-owl-carousel .pro-slide p{
    font:16px/21px 'proxima_nova_rgregular'
}
.store-part-owl-carousel .pro-slide{
    background:#fff;
    border-radius:5px;
    -webkit-border-radius:5px;
    position:relative;
    overflow:hidden
}
.store-part-owl-carousel .pro-slide:hover .button_bar{
    bottom:0px
}
.store-part-owl-carousel .pro-slide .button_bar{
    text-align:center;
    position:absolute;
    left:0;
    right:0;
    bottom:-100px;
    background:#d4d4d4;
    padding:20px 0;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease
}
.store-part-owl-carousel .pro-slide .button_bar .common_but{
    font-size:15px;
    width:130px;
    height:30px;
    padding:0;
    line-height:30px;
    background:#da0001
}
.store-part-owl-carousel .pro-slide .button_bar .common_but:hover{
    color:#fff;
    background:#2a2a2a
}
.store-part-owl-carousel .item{
    padding:0px
}
.store-part-owl-carousel .review-part{
}
.store-part-owl-carousel .review-part .review-icon{
    margin:0;
    color:#f3801a
}
.store-part-owl-carousel .review-part .reviews{
    margin:0
}
.store-part-owl-carousel .price-part{
}
.store-part-owl-carousel .price-part .old-price{
    margin:0px;
    text-decoration:line-through
}
.store-part-owl-carousel .price-part .new-price{
    margin:0px;
    color:#2a2a2a;
    font-size:21px;
    font-family:'proxima_novaextrabold'
}
.view_but{
    margin:20px 0 0 0
}
.view_but a{
    color:#2a2a2a;
    font:17px 'proxima_nova_rgbold'
}
.view_but a:hover{
    color:#f3801a
}
.datepicker{
    background:#f1f1f1
}
.quiz_section_contents{
}
.merchants_section_contents{
    margin:25px 0 0 0
}
.merchants_section_contents h3{
}
.merchants_section_contents ul{
    padding:0
}
.merchants_section_contents ul:after{
    clear:both;
    display:block;
    content:''
}
.merchants_section_contents ul li{
    list-style:none;
    float:left;
    width:32.282352941176473%;
    margin-right:1.568627450980392%;
    margin-bottom:1.568627450980392%
}
.merchants_section_contents ul li:nth-child(3n+3){
    margin-right:0px
}
.merchants_section_contents ul li img{
    width:100%
}
.inner_content{
    padding:50px 0
}
.inner_content ol li, .inner_content ul li{
    line-height:24px;
    margin-bottom:5px
}
.breadcrumb{
    margin-bottom:25px;
    color:#3a3a3a;
    font:15px 'proxima_nova_rgbold';
    text-transform:uppercase
}
.breadcrumb p{
    margin-bottom:0px;
    font-family:inherit
}
.breadcrumb a{
    color:#787878;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease;
    font:15px 'proxima_nova_rgregular'
}
.breadcrumb a:hover{
    color:#da0001
}
.breadcrumb .slug{
    display:inline-block;
    margin:0 10px 0 8px;
    color:#787878
}
.breadcrumb header{
    box-shadow:inherit
}
.inner_banner img{
    display:block;
    margin:0 auto
}
.my_acc_part{
}
.my_acc_part .more_details_par .common_but:hover, .my_acc_part .more_details_par .common_but:focus{
    background:#fe9b1a;
    color:#fff;
    border:2px solid #fe9b1a
}
.my_acc_part .my_acc_left{
    background:#eee;
    border:1px solid #e9e9e9;
    box-shadow:0 0 10px #e2e2e2;
    -webkit-box-shadow:0 0 10px #e2e2e2;
    width:230px
}
.my_acc_part .my_acc_left h4{
    color:#3a3a3a;
    text-transform:inherit;
    margin:0;
    border-bottom:1px solid #e9e9e9;
    font:21px 'proxima_novasemibold';
    padding:9px 20px 8px 20px
}
.my_acc_left .main_list ul{
    padding:0px
}
.my_acc_left .main_list ul li{
    list-style:none
}
.my_acc_left .main_list ul li a{
    font-size:16px;
    color:#4e4e4e;
    display:block;
    position:relative;
    padding:10px 20px 10px 55px;
    border-bottom:1px solid #e9e9e9;
    transition:all 0.5s ease;
    -webkit-transition:all 0.5s ease;
    background:#fff;
    font-family:'proxima_nova_rgregular'
}
.my_acc_left .main_list ul li a:hover, .my_acc_left .main_list ul li a.active{
    color:#fe9b1a
}
.my_acc_left .main_list ul li a:before{
    background:url(../media/full_sprite.png) no-repeat scroll 0 0 transparent;
    width:24px;
    height:24px;
    position:absolute;
    left:20px;
    top:8px;
    content:''
}
.my_acc_left .main_list ul li a:after{
    width:1px;
    height:39px;
    position:absolute;
    right:-1px;
    top:0;
    content:'';
    background:#fff;
    z-index:51;
    display:none
}
.my_acc_left .main_list ul li.cat_side_menu_active:hover a:after{
    display:block
}
.my_acc_left .main_list ul li a:hover:before{
    background-position:-28px 0
}
.my_acc_left .main_list ul li.profile a:before{
    background-position:-322px -4px
}
.my_acc_left .main_list ul li.profile a:hover:before, .my_acc_left .main_list ul li.profile a.active:before{
    background-position:-358px -4px
}
.my_acc_left .main_list ul li.my_order a:before{
    background-position:-322px -85px
}
.my_acc_left .main_list ul li.my_order a:hover:before, .my_acc_left .main_list ul li.my_order a.active:before{
    background-position:-358px -85px
}
.my_acc_left .main_list ul li.valet_points a:before{
    background-position:-323px -118px
}
.my_acc_left .main_list ul li.valet_points a:hover:before, .my_acc_left .main_list ul li.valet_points a.active:before{
    background-position:-359px -118px
}
.my_acc_left .main_list ul li.req_withdraw a:before{
    background-position:-323px -360px
}
.my_acc_left .main_list ul li.req_withdraw a:hover:before, .my_acc_left .main_list ul li.req_withdraw a.active:before{
    background-position:-358px -360px
}
.my_acc_left .main_list ul li.rewards a:before{
    background-position:-322px -145px
}
.my_acc_left .main_list ul li.rewards a:hover:before, .my_acc_left .main_list ul li.rewards a.active:before{
    background-position:-358px -145px
}
.my_acc_left .main_list ul li.invite a:before{
    background-position:-321px -297px
}
.my_acc_left .main_list ul li.invite a:hover:before, .my_acc_left .main_list ul li.invite a.active:before{
    background-position:-357px -297px
}
.my_acc_left .main_list ul li.wishlist a:before{
    background-position:-322px -178px
}
.my_acc_left .main_list ul li.wishlist a:hover:before, .my_acc_left .main_list ul li.wishlist a.active:before{
    background-position:-358px -178px
}
.my_acc_left .main_list ul li.follow_mer a:before{
    background-position:-323px -207px
}
.my_acc_left .main_list ul li.follow_mer a:hover:before, .my_acc_left .main_list ul li.follow_mer a.active:before{
    background-position:-359px -207px
}
.my_acc_left .main_list ul li.redemption a:before{
    background-position:-324px -236px
}
.my_acc_left .main_list ul li.redemption a:hover:before, .my_acc_left .main_list ul li.redemption a.active:before{
    background-position:-360px -236px
}
.my_acc_left .main_list ul li.cha_pass a:before{
    background-position:-324px -264px
}
.my_acc_left .main_list ul li.cha_pass a:hover:before, .my_acc_left .main_list ul li.cha_pass a.active:before{
    background-position:-360px -264px
}
.my_acc_left .main_list ul li.msgs a:before{
    background-position:-322px -34px
}
.my_acc_left .main_list ul li.msgs a:hover:before, .my_acc_left .main_list ul li.msgs a.active:before{
    background-position:-358px -34px
}
.my_acc_left .main_list ul li.follow_deals a:before{
    background-position:-184px -690px
}
.my_acc_left .main_list ul li.follow_deals a:hover:before, .my_acc_left .main_list ul li.follow_deals a.active:before{
    background-position:-303px -690px
}
.my_acc_left .main_list ul li.my-coup a:before{
    top:10px;
    background-position:-321px -60px
}
.my_acc_left .main_list ul li.my-coup a:hover:before, .my_acc_left .main_list ul li.my-coup a.active:before{
    background-position:-357px -60px
}
.my_acc_part .my_acc_right{
    padding:30px;
    background:#fff;
    box-shadow:0 0 10px #e2e2e2;
    -webkit-box-shadow:0 0 10px #e2e2e2;
    width:calc(100% - 250px);
    width:-webkit-calc(100% - 250px);
    min-height:600px
}
.my_acc_part .my_acc_right h4{
    position:relative;
    font:24px 'proxima_novasemibold';
    color:#000;
    text-transform:capitalize;
    padding:0 0 10px;
    background:#eee;
    padding:10px 15px;
    margin:-30px -30px 20px -30px
}
.my_acc_part .my_acc_right form{
    max-width:970px;
    margin-top:50px
}
.my_acc_part .my_acc_right form .form-field-left, .my_acc_part .my_acc_right form .form-field-right{
    width:48.96907216494845%;
    position:relative
}
.form-field-right .datepicker{
    position:relative
}
.up_coming .my_acc_right form{
    max-width:970px;
    margin-top:50px
}
.up_coming .my_acc_right form .form-field-left, .my_acc_part .my_acc_right form .form-field-right{
    width:48.96907216494845%;
    position:relative
}
.my_acc_part .my_acc_right form .form-field{
    margin-bottom:20px
}
.my_acc_part .my_acc_right form .form-field label{
    width:32.653061224489793%;
    margin-right:6.1224489795918366%;
    float:left;
    text-align:right;
    position:relative
}
.my_acc_part .my_acc_right form .form-field input, .my_acc_part .my_acc_right form .form-field .chosen-container{
    width:61.22448979591837% !important;
    float:right;
    margin:0px;
    font:17px 'proxima_nova_rgbold';
    color:#3a3a3a;
    -webkit-box-shadow:inset 0px 0px 5px 0px rgba(212,212,212,1);
    box-shadow:inset 0px 0px 5px 0px rgba(212,212,212,1);
    border:1px solid #c4c4c4
}
.my_acc_part .my_acc_right form .form-field .chosen-container .chosen-single{
    text-align:left
}
.my_acc_part .my_acc_right form .form-field .chosen-container .chosen-single, .my_acc_part .my_acc_right form .form-field .chosen-container .chosen-single:after{
    line-height:40px
}
.my_acc_part .my_acc_right form .form-field .chosen-container input{
    float:none;
    width:100% !important
}
input[type="file"],input[type="file"]:hover{
    cursor:pointer
}
.my_acc_part .my_acc_right form .form-field input[type="file"]{
    -webkit-box-shadow:inherit;
    box-shadow:inherit;
    border:none
}
.my_acc_part .my_acc_right form .form-field button[type="submit"]{
    background:#FE9B1A;
    padding:8px 25px;
    font:15px 'proxima_nova_rgbold';
    border:none;
    color:#fff;
    text-transform:uppercase;
    border-radius:3px;
    -webkit-border-radius:3px;
    cursor:pointer;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.my_acc_part .my_acc_right form .form-field button[type="submit"]:hover{
    background:#004282
}
.merchant-product-section .slide-right-part .img-part{
    padding:15px
}
.merchant-product-section .slide-right-part .img-part a{
    position:relative;
    margin:0
}
.merchant-product-section .pro-com .pro-com-right .item ul li img{
    max-height:100%
}
.merchant-product-section .slide-right-part .cont-part{
    padding:0 15px 15px 15px
}
.merchant-product-section .slide-right-part ul li{
    width:100%;
    border-right:inherit;
    transition:all 0.4s ease;
    -webkit-transition:all 0.4s ease;
    cursor:pointer;
    overflow:hidden;
    height:290px
}
.merchant-product-section .owl-carousel .owl-wrapper, .merchant-product-section .owl-carousel .owl-item, .merchant-product-section .owl-carousel .owl-item .item{
    padding:0px
}
.merchant-product-section .slide-right-part ul li:hover{
    box-shadow:0 0 10px rgba(0, 0, 0, 0.45);
    -webkit-box-shadow:0 0 10px rgba(0, 0, 0, 0.45)
}
.merchant-product-section .slide-right-part ul li h5, .merchant-product-section .slide-right-part ul li a{
    display:block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#2a2a2a;
    text-transform:none;
    margin:0 0 0px;
    font-size:15px
}
.merchant-product-section .slide-right-part ul li .cont-part h5 a{
    max-height:22px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    text-transform:none
}
.merchant-product-section .slide-right-part ul li a:hover{
    box-shadow:inherit;
    -webkit-box-shadow:inherit
}
.merchant-product-section .slide-right-part p{
    color:#7a7a7a;
    line-height:normal;
    font-size:14px;
    margin-bottom:0px;
    height:32px;
    overflow:hidden
}
.merchant-product-section .pro-com-right .mer-slider li{
    height:580px;
    background-size:cover;
    -webkit-background-size:cover;
    background-repeat:no-repeat;
    background-position:center center
}
.merchant-product-section .pro-com-right .mer-slider li a{
    height:100%;
    display:block
}
.merchant-product-section .mCSB_scrollTools .mCSB_draggerContainer{
    right:-13px
}
.merchant-product-section .mCSB_inside .mCSB_container{
    margin-right:0
}
.pro-com.feature-sec.fashion_access{
    border-top:4px solid #da0001
}
.pro-com.feature-sec.fashion_access h3{
    color:#da0001
}
.pro-com.feature-sec.fashion_access h3:after{
    background:#da0001
}
.pro-com.feature-sec.fashion_access a:hover{
    color:#da0001
}
.pro-com.feature-sec.food_dining{
    border-top:4px solid #fb0
}
.pro-com.feature-sec.food_dining h3{
    color:#ffc000
}
.pro-com.feature-sec.food_dining h3:after{
    background:#ffc000
}
.pro-com.feature-sec.food_dining a:hover{
    color:#ffc000
}
.pro-com.feature-sec.buauty_spa{
    border-top:4px solid #e51442
}
.pro-com.feature-sec.buauty_spa h3{
    color:#ec1f5b
}
.pro-com.feature-sec.buauty_spa h3:after{
    background:#ec1f5b
}
.pro-com.feature-sec.buauty_spa a:hover{
    color:#ec1f5b
}
.pro-com.feature-sec.digital_elect{
    border-top:4px solid #0a79f1
}
.pro-com.feature-sec.digital_elect h3{
    color:#1193f5
}
.pro-com.feature-sec.digital_elect h3:after{
    background:#1193f5
}
.pro-com.feature-sec.digital_elect a:hover{
    color:#1193f5
}
.pro-com.feature-sec.travel_vac{
    border-top:4px solid #008d7b
}
.pro-com.feature-sec.travel_vac h3{
    color:#00a595
}
.pro-com.feature-sec.travel_vac h3:after{
    background:#00a595
}
.pro-com.feature-sec.travel_vac a:hover{
    color:#00a595
}
.pro-com.feature-sec.per_service{
    border-top:4px solid #ee7010
}
.pro-com.feature-sec.per_service h3{
    color:#f38a1a
}
.pro-com.feature-sec.per_service h3:after{
    background:#f38a1a
}
.pro-com.feature-sec.per_service a:hover{
    color:#f38a1a
}
.merchant-product-section .container{
}
.merchant-product-section .bx-wrapper .bx-pager, .merchant-product-section .bx-wrapper .bx-controls-auto{
    position:absolute;
    bottom:25px;
    width:100%;
    left:0;
    ;
    z-index:99
}
.merchant-product-section .bx-wrapper .bx-pager{
    text-align:center;
    font-size:0
}
.merchant-product-section .bx-wrapper .bx-pager .bx-pager-item, .merchant-product-section .bx-wrapper .bx-controls-auto .bx-controls-auto-item{
    display:inline-block;
    *zoom:1;
    *display:inline
}
.merchant-product-section .bx-wrapper .bx-pager.bx-default-pager a{
    text-indent:-9999px;
    display:block;
    width:10px;
    height:10px;
    border-radius:50%;
    -webkit-border-radius:50%;
    margin:0 2px;
    outline:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    border:2px solid #fff;
    background:transparent
}
.merchant-product-section .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#fff;
    border:2px solid #fff
}
.participate_popup .freedeal_popup_left .bx-wrapper .bx-pager, .participate_popup .freedeal_popup_left .bx-wrapper .bx-controls-auto{
    position:absolute;
    bottom:-20px;
    width:100%;
    left:0;
    right:0;
    text-align:center;
    z-index:99
}
.participate_popup .freedeal_popup_left .bx-wrapper .bx-pager{
    font-size:0
}
.participate_popup .freedeal_popup_left .bx-wrapper .bx-pager .bx-pager-item, .participate_popup .freedeal_popup_left .bx-wrapper .bx-controls-auto .bx-controls-auto-item{
    display:inline-block;
    *zoom:1;
    *display:inline
}
.participate_popup .freedeal_popup_left .bx-wrapper .bx-pager.bx-default-pager a{
    text-indent:-9999px;
    display:block;
    width:10px;
    height:10px;
    border-radius:50%;
    -webkit-border-radius:50%;
    margin:0 2px;
    outline:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    border:2px solid #C2C2C2;
    background:transparent
}
.participate_popup .freedeal_popup_left .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#A9A9A9;
    border:2px solid #A9A9A9
}
.home-product-section .bx-wrapper .bx-pager, .home-product-section .bx-wrapper .bx-controls-auto{
    position:absolute;
    bottom:25px;
    width:100%;
    left:0;
    z-index:99
}
.home-product-section .bx-wrapper .bx-pager{
    text-align:center;
    font-size:0
}
.home-product-section .bx-wrapper .bx-pager .bx-pager-item, .home-product-section .bx-wrapper .bx-controls-auto .bx-controls-auto-item{
    display:inline-block;
    *zoom:1;
    *display:inline
}
.home-product-section .bx-wrapper .bx-pager.bx-default-pager a{
    text-indent:-9999px;
    display:block;
    width:10px;
    height:10px;
    border-radius:50%;
    -webkit-border-radius:50%;
    margin:0 2px;
    outline:0;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    border:2px solid #fff;
    background:transparent
}
.home-product-section .bx-wrapper .bx-pager.bx-default-pager a.active{
    background:#fff;
    border:2px solid #fff
}
.merchant_filter_section{
    border-top:3px solid #004282
}
.merchant-main .merchant_filter .filter_arrow:hover, .merchant-main .filtermore .filter_arrow{
    color:#004282
}
.merchant_filter_section:after{
    clear:both;
    display:block;
    content:''
}
.merchant_filter{
    height:51px;
    overflow:hidden;
    position:relative;
    background:#fff;
    padding-right:40px;
    width:70%;
    float:left;
    margin-bottom:30px
}
.merchant_filter.filtermore{
    height:auto;
    min-height:51px
}
.merchant_filter ul{
    padding:0
}
.merchant_filter ul li{
    list-style:none;
    float:left
}
.merchant_filter ul li a{
    padding:16px 18px;
    display:block;
    color:#787878;
    position:relative;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s
}
.merchant_filter ul li.active a{
    font-family:'proxima_nova_rgbold';
    color:#114E8A
}
.merchant_filter ul li a:hover:after, .merchant_filter ul li.active a:after{
    width:100%;
    opacity:1
}
.merchant_filter ul li.active a,.merchant_filter ul li a:hover{
}
.merchant_filter .filter_arrow{
    position:absolute;
    right:5px;
    top:12px;
    color:#3a3a3a;
    transition:all 0.3s ease 0s;
    -webkit-transition:all 0.3s ease 0s;
    width:30px;
    height:30px;
    text-align:center;
    line-height:30px
}
.merchant_filter .filter_arrow:hover{
    color:#fe9b1a
}
.filtermore .filter_arrow{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg);
    color:#fe9b1a
}
.merchant_filtersort{
    width:100%;
    display:inline-block
}
.merchant_sortby{
    height:51px;
    position:relative;
    background:#fff;
    width:30%;
    border-left:1px solid #ccc;
    float:left;
    margin-bottom:30px;
    text-align:center
}
.merchant_sortby.filtersort{
    height:auto
}
.merchant_sortby ul{
    padding:0
}
.merchant_filtersort .filter_heading{
}
.merchant_filtersort .filter_heading span{
    padding:10px;
    background:#F8F8F8;
    display:inline-block
}
.merchant_sortby .nice-select{
    background:inherit
}
.merchant_sortby .nice-select .list li{
    width:100%
}
.merchant_sortby ul li{
    list-style:none;
    float:left
}
.merchant_sortby ul li a{
    padding:16px 18px;
    display:block;
    color:#787878;
    position:relative;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s
}
.merchant_sortby ul li a:after{
    border-bottom:3px solid #002482;
    content:'';
    display:block;
    width:0%;
    bottom:0;
    margin:auto;
    position:absolute;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s;
    opacity:0;
    left:0;
    right:0
}
.merchant_sortby ul li a:hover:after, .merchant_sortby ul li.active a:after{
    width:100%;
    opacity:1
}
.merchant_sortby ul li.active a,.merchant_sortby ul li a:hover{
    color:#3a3a3a
}
.merchant_sortby .filter_arrowsort{
    position:absolute;
    right:15px;
    top:17px;
    color:#3a3a3a;
    transition:all 0.3s ease 0s;
    -webkit-transition:all 0.3s ease 0s;
    width:10px;
    height:15px;
    text-align:center
}
.merchant_sortby .filter_arrowsort:hover{
    color:#fe9b1a
}
.filter_arrowsort{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg);
    color:#fe9b1a
}
.merchant_sortby .chosen-container-single .chosen-single, .merchant_sortby .chosen-container-single .chosen-single:after{
    line-height:51px
}
.flashsale-main .filter_section{
    border-top:3px solid #53a318
}
.flashsale-main .filters ul li.active a{
    font-family:'proxima_nova_rgbold';
    color:#53a318
}
.flash_sale_deals ul li .img_part .discount-tag{
    position:absolute;
    left:0;
    bottom:0;
    background:#53a318;
    color:#fff;
    font-family:"proxima_nova_rgbold";
    padding:5px 10px 5px 10px;
    height:30px
}
.filter_part{
    margin-top:10px
}
.filter_section:after{
    clear:both;
    display:block;
    content:''
}
.filter_part .filter_heading span{
    padding:10px;
    background:#F8F8F8;
    display:inline-block
}
.filter_section .filters{
    height:51px;
    overflow:hidden;
    position:relative;
    background:#fff;
    padding-right:40px;
    width:70%;
    float:left;
    margin-bottom:30px
}
.filters.filtermore{
    height:auto;
    min-height:51px
}
.filters ul{
    padding:0
}
.filters ul:after{
    clear:both;
    display:block;
    content:''
}
.filters ul li{
    list-style:none;
    float:left
}
.filters ul li a{
    padding:16px 18px;
    display:block;
    color:#787878;
    position:relative;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s
}
.filters ul li a:hover:after, .filters ul li.active a:after{
    width:100%;
    opacity:1
}
.filters .filter_arrow{
    position:absolute;
    right:5px;
    top:12px;
    color:#3a3a3a;
    transition:all 0.3s ease 0s;
    -webkit-transition:all 0.3s ease 0s;
    width:30px;
    height:30px;
    text-align:center;
    line-height:30px
}
.filters .filter_arrow:hover{
    color:#53a318
}
.filters.filtermore .filter_arrow{
    transform:rotate(180deg);
    -webkit-transform:rotate(180deg);
    color:#53a318
}
.filter_section .filter_sortby{
    height:51px;
    position:relative;
    background:#fff;
    width:30%;
    border-left:1px solid #ccc;
    float:left;
    margin-bottom:30px;
    text-align:center
}
.filter_sortby.filtersort{
    height:auto
}
.filter_sortby ul{
    padding:0
}
.merchant_filtersort .filter_heading span{
    padding:10px;
    background:#F8F8F8;
    display:inline-block
}
.filter_sortby ul li{
    list-style:none;
    float:left
}
.filter_sortby ul li a{
    padding:16px 18px;
    display:block;
    color:#787878;
    position:relative;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s
}
.filter_sortby ul li a:after{
    border-bottom:3px solid #002482;
    content:'';
    display:block;
    width:0%;
    bottom:0;
    margin:auto;
    position:absolute;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s;
    opacity:0;
    left:0;
    right:0
}
.filter_sortby ul li a:hover:after, .filter_sortby ul li.active a:after{
    width:100%;
    opacity:1
}
.filter_sortby ul li.active a, .filter_sortby ul li a:hover{
    color:#3a3a3a
}
.filter_sortby .filter_arrowsort{
    position:absolute;
    right:15px;
    top:17px;
    color:#3a3a3a;
    transition:all 0.3s ease 0s;
    -webkit-transition:all 0.3s ease 0s;
    width:10px;
    height:15px;
    text-align:center
}
.filter_sortby .filter_arrowsort:hover{
    color:#fe9b1a
}
.filter_arrowsort{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg);
    color:#fe9b1a
}
.filter_sortby .chosen-container-single .chosen-single, .filter_sortby .chosen-container-single .chosen-single:after{
    line-height:51px
}
.merchant_sort{
    margin:30px 20px
}
.merchant_sort ul{
    padding:0px
}
.merchant_sort ul li{
    list-style:none;
    float:left
}
.merchant_sort ul li span{
    font:17px 'proxima_nova_rgbold';
    color:#3a3a3a
}
.merchant_sort ul li a{
    font-size:17px;
    padding:0 25px;
    position:relative;
    display:block;
    color:#787878;
    transition:all 0.5s ease 0s;
    -webkit-transition:all 0.5s ease 0s;
    cursor:pointer
}
.merchant_sort ul li.active a{
    color:#002482
}
.merchant_sort ul li a:hover{
    color:#002482
}
.merchant_sort ul li a:after{
    background:#c8c8c8;
    width:1px;
    height:16px;
    content:'';
    position:absolute;
    right:0;
    top:0;
    bottom:0;
    margin:auto
}
.merchant_sort ul li:last-child a:after{
    background:transparent
}
.merchant_list{
}
.merchant_list ul{
    padding:0
}
.merchant_list ul li{
    width:23.828125%;
    float:left;
    margin-right:1.5625%;
    margin-bottom:1.5625%;
    background:#fff;
    list-style:none
}
.merchant_list ul li:hover{
    box-shadow:0px 0px 6px rgba(0, 0, 0, 0.19)
}
.merchant_list ul li:nth-child(4n+4){
    margin-right:0px
}
.merchant_list ul li .img-part{
    padding:15px
}
.merchant_list ul li .cont-part{
    padding:15px
}
.merchant_list ul li .cont-part h5, .merchant_list ul li .cont-part h5 a{
    margin-bottom:5px;
    text-transform:none;
    color:#2a2a2a;
    font-family:'proxima_nova_rgbold';
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    font-size:15px;
    max-height:38px;
    line-height:normal;
    overflow:hidden
}
.merchant_list ul li .cont-part h5 a:hover{
    color:#003092
}
.merchant_list ul li .cont-part p{
    color:#7a7a7a;
    font:14px 'proxima_nova_rgregular';
    margin-bottom:0px;
    max-height:32px;
    overflow:hidden
}
.merchant_list ul li .button_bar{
    text-align:center;
    background:#fff;
    padding:0 0 35px 0;
    z-index:2;
    position:relative;
    display:none;
    box-shadow:0px 4px 5px rgba(0, 0, 0, 0.19);
    -webkit-box-shadow:0px 4px 5px rgba(0, 0, 0, 0.19)
}
.merchant_list ul li:hover .button_bar{
    display:block
}
.merchant_list ul li .button_bar .common_but{
    background:#002482
}
.merchant_list ul li .button_bar .common_but:hover{
    background:#2a2a2a
}
.inner-main.merchant-list-details{
    padding-bottom:40px
}
.merchant-list-details .cate_main_mobile{
    display:block !important
}
.merchant-list-details .cate_right{
    float:none;
    width:100% !important
}
.merchant-list-details .category_with_search{
    padding:0 0 0 243px
}
.merchant-list-details .cate_main.cate_main_mobile .cate_title h6{
    cursor:pointer
}
.merchant-list-details .search-key-box input[type="text"], .merchant-list-details .custom-select .nice-select, .merchant-list-details .search-operate-box button[type="submit"]{
}
.merchant-list-details .search-operate-box button[type="submit"]{
    background:url(/images/search.png) no-repeat scroll center center #fe9b1a;
    width:70px
}
.merchant-list-details .search-operate-box{
    padding-right:69px
}
.merchant-list-details .custom-select:after{
    line-height:50px
}
.merchant-list-details .loading{
    text-align:center;
    position:absolute;
    left:18%;
    top:0;
    width:12%
}
.merchant-list-details .merchant_detail_content .loading{
    position:relative
}
.merchant_detail_content .filter_section{
    border-top:3px solid #53a318
}
.merchant_detail_content .filter_section .filters{
    box-shadow:0 0 10px #e8e8e8;
    -webkit-box-shadow:0 0 10px #e8e8e8
}
.merchant_detail_content .filter_section .filter_sortby .chosen-with-drop .chosen-results{
    display:block !important
}
.merchant_detail_content .filters ul li.active a{
    font-family:'proxima_nova_rgbold';
    color:#53a318
}
.brand_details{
    background:#fff;
    padding-bottom:40px
}
.brand_details_inner{
    max-width:1100px;
    margin:auto;
    padding-left:15px;
    padding-right:15px
}
.brand_details_inner ul.brd_menu{
    padding:20px 0 20px 200px;
    border-bottom:1px solid #dcdcdc;
    margin-bottom:20px;
    display:block
}
.brand_details_inner ul.brd_menu li{
    list-style:none;
    float:left
}
.brand_details_inner ul.brd_menu li a{
    display:block;
    padding:0 20px;
    position:relative;
    color:#3a3a3a;
    font:17px 'proxima_novasemibold';
    transition:al 0.3s ease;
    -webkit-transition:al 0.3s ease
}
.brand_details_inner ul.brd_menu li a:hover, .brand_details_inner ul.brd_menu li.active a{
    color:#fe9b1a
}
.brand_details_inner ul.brd_menu li a:after{
    background:#d6d6d6;
    width:1px;
    height:15px;
    position:absolute;
    right:0;
    margin:auto;
    content:'';
    top:0;
    bottom:0
}
.brand_details_inner ul.brd_menu li:last-child a:after{
    background:transparent
}
.brand_details_inner ul.brd_menu li:last-child a{
    padding-right:0px
}
.mob_brd_menu{
    position:relative;
    max-width:300px;
    text-align:left
}
.mob_brd_menu .title{
    font-family:'proxima_novasemibold';
    margin:0;
    background:#3a3a3a;
    color:#fff;
    padding:12px 30px 12px 15px;
    position:relative;
    display:none;
    cursor:pointer
}
.mob_brd_menu .title:after{
    position:absolute;
    top:10px;
    right:15px;
    content:"\f107";
    font-size:20px;
    font-family:'FontAwesome';
    transition:al 0.3s ease;
    -webkit-transition:al 0.3s ease;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.mob_brd_menu .title.active:after{
    transform:rotate(-180deg);
    -webkit-transform:rotate(-180deg)
}
.mob_brd_menu ul{
    padding:0;
    background:#f1f1f1;
    position:absolute;
    width:100%;
    top:100%;
    left:0;
    z-index:5;
    display:none !important
}
.mob_brd_menu ul li{
    list-style:none
}
.mob_brd_menu ul li a{
    display:block;
    padding:8px 15px;
    border-bottom:1px solid #e6e6e6;
    color:#333;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.mob_brd_menu ul li a:hover, .mob_brd_menu ul li a.active{
    color:#ef6800
}
.offer_box{
    max-width:800px;
    min-height:150px;
    background:url(/images/offer_box_bg.jpg) no-repeat center center transparent;
    margin:50px auto;
    position:relative;
    padding:35px;
    background-size:cover;
    -webkit-background-size:cover
}
.offer_box h3{
    font:50px 'univers_condensedbold';
    color:#fff;
    margin:0;
    position:absolute;
    left:15px;
    top:8px
}
.offer_box p{
    margin:0;
    color:#fff;
    font-size:15px;
    text-align:center;
    line-height:normal
}
.offer_box p span{
    font:22px 'proxima_nova_rgbold';
    display:block;
    text-transform:uppercase
}
.offer_box_left,.offer_box_right{
    border:2px solid #fff;
    width:47.94520547945205%;
    padding:15px 15px 15px 130px;
    position:relative
}
.offer_box_right{
    float:right
}
.offer_box:before,.offer_box:after{
    width:86px;
    height:86px;
    left:-10px;
    top:-10px;
    content:'';
    position:absolute;
    z-index:1;
    background:url(/images/left_curve.png)
}
.offer_box:after{
    left:inherit;
    bottom:-10px;
    right:-10px;
    top:inherit;
    background:url(/images/right_curve.png)
}
.brand_banner .merchant_cashpay{
    width:285px;
    position:absolute;
    right:40px;
    bottom:40px;
    border-radius:5px;
    -webkit-border-radius:5px
}
.brand_banner .merchant_cashpay .cashback{
    font:20px 'proxima_novasemibold';
    padding:4px 5px;
    border:2px solid #fe9b1a
}
.brand_banner{
    position:relative
}
.brand_banner>img{
    display:block;
    margin:0 auto
}
.brand_pic_full{
    position:absolute;
    left:15px;
    bottom:-50px;
    max-width:1100px;
    right:0;
    margin:0 auto
}
.brand_pic{
    width:200px;
    height:200px;
    border-radius:3px;
    -webkit-border-radius:3px;
    border:1px solid #d3d3d3;
    position:relative;
    background:#fff
}
.brand_pic img{
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    margin:auto
}
.brand_pic,.brand_pic_cont{
    display:table-cell;
    vertical-align:top
}
.brand_pic_cont{
    padding-left:20px
}
.brand_details .mess_button{
    background:#eee;
    color:#3a3a3a;
    bottom:40px;
    font-size:14px;
    padding:6px 6px 6px 30px;
    width:145px;
    height:40px;
    position:absolute;
    right:40px;
    font-family:'proxima_novasemibold';
    border-radius:5px
}
.brand_details .mess_button img{
    display:none
}
.brand_details .mess_button:before{
    content:"";
    height:21px;
    left:10px;
    position:absolute;
    top:10px;
    width:33px;
    background:url(/images/message.png);
    background-size:cover
}
.brand_details .mess_button:hover:before{
    background:url(/images/message_hover.png)
}
.brand_details .mess_button:hover{
    background:#FE9B1A
}
.brand_details .mess_button span{
    font-size:15px;
    color:#3a3a3a;
    vertical-align:middle;
    padding:0 10px;
    display:inline-block
}
.brand_details .mess_button:hover span{
    color:#fff
}
.brand_details .mess_button_outer{
    text-align:center;
    display:none
}
.brand_pic_cont #rating_link, .brand_pic_cont #fetch_review{
    display:table-cell;
    vertical-align:middle
}
.brand_pic_cont #fetch_review{
    padding-left:10px;
    color:#fff;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    font:18px 'proxima_nova_rgbold';
    text-shadow:0 0 5px rgba(0, 0, 0, 0.7)
}
.brand_pic_cont #fetch_review:hover{
    color:#fe9b1a
}
.brand_pic_cont h3{
    font:30px 'proxima_nova_rgbold';
    color:#fff;
    margin-bottom:5px;
    text-transform:inherit;
    text-shadow:0 0 5px rgba(0, 0, 0, 0.7)
}
.brand_pic_cont p{
    font:18px 'proxima_nova_rgbold';
    color:#fff;
    text-shadow:0 0 5px rgba(0, 0, 0, 0.7);
    position:relative
}
.brand_pic_cont button{
    background:#fe9b1a;
    font:16px 'proxima_novasemibold';
    width:140px;
    height:40px;
    padding:10px;
    cursor:pointer;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    margin-right:10px;
    border:none;
    color:#fff;
    border-radius:5px;
    -webkit-border-radius:5px
}
.brand_pic_cont button:hover{
    color:#fe9b1a;
    background:#fff
}
.brand_video{
    position:relative;
    margin:50px 0 40px 0
}
.brand_video:before,.brand_video:after{
    width:50%;
    background:#000;
    background:rgba(0, 0, 0, 0.36);
    position:absolute;
    left:0;
    top:0;
    bottom:0;
    height:100%;
    content:'';
    transition:all 0.8s ease;
    -webkit-transition:all 0.8s ease
}
.brand_video:after{
    left:inherit;
    right:0
}
.brand_video:hover:before,.brand_video:hover:after{
    width:0%
}
.brand_video .video_icon{
    position:absolute;
    left:0;
    right:0;
    top:0;
    bottom:0;
    width:100px;
    height:110px;
    margin:auto;
    text-align:center;
    z-index:10
}
.brand_video .video_icon .video_icon_shape{
    z-index:1;
    line-height:80px;
    font-size:35px;
    color:#fff;
    border:2px solid #fff;
    border-radius:50%;
    text-align:center;
    display:inline-block;
    width:80px;
    height:80px
}
.brand_video .video_icon .video_icon_shape .fa{
    position:relative;
    left:5px
}
.brand_video .video_icon a{
    display:inline-block
}
.brand_video .video_icon span{
    display:block;
    margin-top:15px;
    text-transform:uppercase;
    font:15px 'proxima_novasemibold';
    color:#fff
}
.brand_link_left,.brand_link_right{
    width:47.94520547945205%
}
.brand_link_right_bottom{
    margin-top:7.5%
}
.merchant_product_details .brand_details{
    padding-bottom:0px
}
.all_category{
    margin:20px 0;
    background:#fff;
    border-radius:5px;
    -webkit-border-radius:5px
}
.merchant_detail_content .flash_sale_deals ul li{
    border:1px solid #e4e4e4;
    width:23.925233644859814%;
    margin-right:1.4018691588785047%
}
.merchant_detail_content .flash_sale_deals ul li:nth-child(3n+3){
    margin-right:1.4018691588785047%
}
.merchant_detail_content .flash_sale_deals ul li:nth-child(4n+4){
    margin-right:0
}
.all_category_list{
}
.all_category_list ul{
    padding:0px
}
.all_category_list ul li{
    list-style:none;
    float:left
}
.all_category_list ul li.active a{
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.all_category_list ul li a{
    color:#787878;
    padding:16px 18px 15px 18px;
    display:block;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.all_category_list ul li a:hover{
    color:#3a3a3a
}
.all_category{
    background:#fff
}
.all_category_select{
    width:200px;
    position:relative
}
.all_category_select:after{
    position:absolute;
    top:0;
    right:20px;
    bottom:0;
    color:#3a3a3a;
    pointer-events:none;
    content:"\f107";
    font-family:'FontAwesome';
    line-height:50px
}
.all_category_select select{
    height:50px;
    margin:0;
    color:#787878;
    font:15px 'proxima_novasemibold';
    border:none;
    background-color:white;
    border-left:1px solid #e2e2e2;
    border-right:1px solid #e2e2e2;
    padding:5px 20px;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none
}
.all_category_search input[type="submit"]{
    height:50px;
    width:50px;
    background:url(../media/full_sprite.png) no-repeat scroll -55px -370px transparent;
    border-radius:0 5px 5px 0;
    -webkit-border-radius:0 5px 5px 0;
    transition:none;
    -webkit-transition:none
}
.all_category_search input[type="submit"]:hover{
    background:url(../media/full_sprite.png) no-repeat scroll -55px -320px #000
}
.merchant_inner_com{
    margin:45px 0 0 0
}
.merchant_inner_com h2{
    position:relative;
    font:30px 'proxima_novasemibold';
    color:#333;
    margin:0 0 30px;
    padding:0 0 15px;
    text-transform:none
}
.merchant_inner_com h2:after{
    width:80px;
    height:4px;
    background:#002482;
    position:absolute;
    left:0;
    bottom:0;
    content:''
}
.merchant_inner_com p{
    margin-bottom:20px
}
.merchant_about p{
    color:#3a3a3a
}
.merchant_about .merchant_about_img{
    margin-bottom:40px
}
.store_locator ul{
    padding:0
}
.store_locator ul:after{
    clear:both;
    display:block;
    content:''
}
.store_locator ul li{
    list-style:none;
    float:left;
    margin:0 0 40px;
    width:33.3%;
    padding-right:30px
}
.store_locator ul li h3{
    font:21px 'proxima_nova_rgbold';
    color:#3a3a3a;
    text-transform:none;
    position:relative;
    padding-left:32px
}
.store_locator ul li h3:before{
    position:absolute;
    left:0;
    top:-3px;
    content:url(/images/locator.png)
}
.store_locator ul li p{
    line-height:28px;
    margin:0
}
.store_locator ul li .phone{
    display:block;
    position:relative;
    font-family:'proxima_nova_rgbold';
    padding-left:17px
}
.store_locator ul li .phone:before{
    position:absolute;
    left:0;
    top:0;
    content:"\f095";
    font-family:'FontAwesome';
    color:#fe9b1a
}
.merchant_review{
    position:relative
}
.merchant_review h2{
    position:relative
}
.merchant_review .write_review{
    font:17px 'proxima_novasemibold';
    background:#002482;
    color:#fff;
    border-radius:5px;
    -webkit-border-radius:5px;
    padding:10px 15px;
    position:absolute;
    right:0;
    top:0;
    cursor:pointer;
    transition:all 0.3s ease;
    display:inline-block
}
.merchant_review .write_review:hover{
    background:#FE9B1A
}
.merchant_review .review_sort .merchant_sort{
    margin:0;
    padding:13px 25px 12px 25px;
    background:#eee
}
.merchant_review .review_sort .merchant_sort h4{
    color:#3a3a3a;
    font:17px 'proxima_nova_rgbold';
    text-transform:none;
    margin:0
}
.merchant_review .review_sort .merchant_sort li:last-child a{
    padding-right:0
}
.review_sort_list ul{
    padding:0px
}
.review_sort_list ul li{
    border-bottom:1px solid #eee;
    padding:25px 25px 25px 150px;
    list-style:none;
    position:relative;
    min-height:170px
}
.review_sort_list ul li .image_part{
    text-align:center;
    position:absolute;
    left:20px;
    top:20px
}
.review_sort_list ul li .image_circle{
    width:92px;
    height:92px;
    overflow:hidden;
    margin:0 auto 10px;
    border-radius:50%;
    -webkit-border-radius:50%;
    line-height:86px;
    box-shadow:0 0 10px #ccc;
    -webkit-box-shadow:0px 0px 10px #ccc
}
.review_sort_list ul li .image_circle img{
    width:100%;
    height:100%;
    object-fit:cover
}
.review_sort_list ul li span.name{
    color:#979797;
    font-size:14px
}
.review_sort_list ul li .cont_part p{
    line-height:30px
}
.review_sort_list ul li .cont_part p:last-of-type{
    margin-bottom:0px;
    width:100%;
    display:inline-block
}
.review_sort_list ul li .cont_part .toprating_bar{
    margin-bottom:15px
}
.review_sort_list ul li .cont_part .toprating_bar .star, .review_sort_list ul li .cont_part .toprating_bar .date, .review_sort_list ul li .cont_part .toprating_bar .time{
    margin-right:8px
}
.review_sort_list ul li .cont_part .toprating_bar .star{
    color:#f3801a;
    float:left
}
.review_sort_list ul li .cont_part .toprating_bar .date{
    float:left;
    padding-top:7px
}
.review_sort_list ul li .cont_part .toprating_bar .time{
    float:left;
    padding-top:7px
}
.brand_details_inner .review_sort_list .pagination{
    padding:30px 0 0 0
}
.brand_details_inner .review_sort_list .pagination li{
    margin-right:15px;
    padding:0;
    border:none;
    float:left;
    min-height:inherit
}
.brand_details_inner .review_sort_list .pagination li a{
    font-size:14px;
    color:#979797;
    padding:0
}
.brand_details_inner .review_sort_list .pagination li:first-child a, .brand_details_inner .review_sort_list .pagination li:last-child a{
    font-size:16px
}
.brand_details_inner .review_sort_list .pagination li a:hover, .brand_details_inner .review_sort_list .pagination li.active a{
    color:#3a3a3a
}
.pagination{
    padding:30px 0 0 0
}
.pagination li{
    margin-right:15px;
    padding:0;
    border:none;
    float:left;
    min-height:inherit;
    list-style:none
}
.pagination li a{
    font-size:14px;
    color:#979797;
    padding:0
}
.pagination li:first-child a{
    font-size:16px
}
.pagination li a:hover, .pagination li.active a{
    color:#3a3a3a
}
.write_new_review{
    margin-bottom:30px
}
.write_new_review h4{
    color:#3a3a3a;
    font:17px 'proxima_nova_rgbold';
    text-transform:none;
    margin:0;
    padding:13px 25px 12px 25px;
    background:#eee;
    margin-bottom:10px
}
.write_new_review #review_form{
    max-width:760px;
    padding:25px
}
.write_new_review #review_form label.comments{
    display:block;
    margin:0 0 10px
}
.write_new_review #review_form textarea{
    margin-bottom:0px
}
.write_new_review #review_form label.rating{
    font-size:16px;
    margin:0 0 10px;
    display:block
}
.write_new_review #review_form #rating{
    margin:0 0 25px
}
.write_new_review #review_form .rating span{
    color:#FE9B1A;
    font-family:'proxima_novasemibold'
}
.merchant_review .rating .filled-stars{
    -webkit-text-stroke:0 !important
}
.write_new_review #review_form input[type="submit"]{
    background:#fe9b1a;
    border-radius:5px;
    height:inherit;
    padding:13px 15px 12px 15px;
    float:right;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.write_new_review #review_form input[type="submit"]:hover{
    background:#004282
}
.store_areas{
}
.store_areas ul{
    padding:0px;
    margin-bottom:30px
}
.store_areas ul li{
    list-style:none;
    border:1px dashed #ccc;
    padding:20px;
    margin-top:20px
}
.store_areas ul li h5{
    margin-bottom:8px
}
.store_areas ul li p{
    margin-bottom:8px
}
.store_areas ul li .stars{
    margin:0 10px 0 0
}
.store_areas #review_form label.rating{
    position:relative;
    top:1px;
    margin-right:10px
}
.store_areas #review_form .rating>label:before{
    margin:2px;
    font-size:18px
}
.store_areas #review_form .comments{
    display:block;
    clear:both;
    margin:0 0 5px
}
.merchant_filter ul:after, .merchant_sort ul:after, .merchant_list ul:after, .brand_details_inner ul:after, .mer_product_details ul:after, .all_category:after, .all_category_list ul:after{
    clear:both;
    display:block;
    content:''
}
.redemption-main .filter_section{
    border-top:3px solid #fe9b1a
}
.redemption-main .filters .filter_arrow:hover, .redemption-main .filters.filtermore .filter_arrow{
    color:#fe9b1a
}
.redemption-main .filters ul li.active a{
    font-family:'proxima_nova_rgbold';
    color:#fe9b1a
}
.redemption_list ul{
    padding:0
}
.redemption_list ul:after{
    clear:both;
    display:block;
    content:''
}
.redemption_list ul li{
    background:#fff;
    list-style:none;
    padding:15px;
    position:relative;
    float:left;
    width:32.2890625%;
    margin-right:1.5625%;
    margin-bottom:1.5625%
}
.redemption_list ul li:hover{
    box-shadow:0px 0px 6px rgba(0, 0, 0, 0.19)
}
.redemption_list ul li:nth-child(3n+3){
    margin-right:0px
}
.redemption_list ul li .img_part{
    margin-bottom:20px;
    position:relative
}
.redemption_list ul li .img_part img{
    display:block;
    margin:auto
}
.redemption-main .redemption_list ul li .cont_part .main-title{
    margin-bottom:10px;
    color:#2a2a2a;
    font:15px/19px 'proxima_nova_rgbold';
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    display:block
}
.redemption-main .redemption_list ul li .cont_part .main-title:hover{
    color:#f39125
}
.redemption-main .redemption_list ul li .cont_part p{
    font:14px 'proxima_nova_rgregular';
    max-height:37px;
    overflow:hidden;
    line-height:19px
}
.redemption-main .redemption_list ul li .cont_part p.points{
    font-family:'proxima_nova_rgbold'
}
.redemption-main .redemption_list ul li .cont_part a:hover{
    color:#f39125
}
.redem_bottom a,.redem_bottom p{
    margin-bottom:0px
}
.redem_bottom:after{
    clear:both;
    display:block;
    content:''
}
.redem_bottom_left,.redem_bottom_right{
    width:50%;
    text-align:left
}
.redem_bottom_right{
    text-align:right
}
.redem_bottom_left p, .redem_bottom_right .points{
    font-size:14px;
    color:#2a2a2a;
    margin:0;
    font-family:'proxima_nova_rgbold';
    line-height:18px
}
.redem_bottom_right .points span{
    color:#f39126;
    font-size:22px;
    display:block
}
.redemption-main .redemption_list ul li .button_bar .common_but{
    background-color:#f39126
}
.redemption-main .redemption_list ul li .button_bar .common_but:hover{
    border:1px solid #f39126;
    color:#f39126;
    background-color:#fff
}
.redemption-main .redemption_list ul li .button_bar .common_but:hover span{
    color:#f39126
}
.redemption-main .redemption_list ul li .button_bar:before{
    width:100%;
    height:10px;
    background:#fff;
    content:'';
    position:absolute;
    left:0;
    right:0;
    top:-10px
}
.sprite-icon{
    background:url('/images/rating-star.png');
    background-repeat:no-repeat;
    display:inline-block;
    overflow:hidden;
    width:101px;
    height:30px
}
.rating-0{
    background-position:0 0
}
.rating-1{
    background-position:-124px 0
}
.rating-2{
    background-position:-233px 0
}
.rating-3{
    background-position:-350px 0
}
.rating-4{
    background-position:-463px 0
}
.rating-5{
    background-position:-580px 0
}
.rating-0.5{
    background-position:-698px 0
}
.rating-1.5{
    background-position:-815px 0
}
.rating-2.5{
    background-position:-936px 0
}
.rating-3.5{
    background-position:-1059px 0
}
.rating-4.5{
    background-position:-1180px 0
}
.my_account_part .form-field .help-block{
    color:red;
    display:inline-block;
    font-size:14px;
    text-align:right;
    width:100%
}
.my_account_part .custom_user_img #cls{
    margin-left:38.1888%
}
.custom_user_img .circletag{
    margin:0 auto;
    text-align:center
}
.custom_user_img .fl{
    text-align:center
}
.merchant_review .write_new_review .new-group{
    clear:left
}
.merchant_review .write_new_review .new-group .control-label{
    margin:20px 0 8px;
    display:inline-block
}
.merchant_review .new-group .common_but{
    background:#fe9b1a;
    float:right;
    padding:14px 30px;
    border:0;
    cursor:pointer;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.merchant_review .new-group .common_but:hover{
    background:#004282
}
.merchant_review .write_new_review .form-horizontal{
    padding:0 25px 25px 25px !important
}
.form-field-left .nice-select.form-control{
    width:61.2245%;
    float:right;
    line-height:40px;
    height:40px;
    position:relative
}
.form-field-left .nice-select::after{
    position:absolute;
    content:"\f107";
    top:0px;
    height:40px;
    line-height:40px
}
.field-siteuser-country .nice-select.form-control{
    width:61.2245%;
    float:right;
    line-height:40px;
    height:40px;
    position:relative
}
.field-siteuser-country .nice-select::after{
    position:absolute;
    content:"\f107";
    top:0px;
    height:40px;
    line-height:40px
}
.field-siteuser-country .form-control ul{
    max-height:275px;
    overflow-y:auto
}
.btgrid .row.row-1{
    width:100%;
    display:inline-block
}
.container-fluid{
    padding-right:15px;
    padding-left:15px;
    margin-right:auto;
    margin-left:auto
}
.row{
    margin-right:-15px;
    margin-left:-15px
}
.col-xs-1,.col-sm-1,.col-md-1,.col-lg-1,.col-xs-2,.col-sm-2,.col-md-2,.col-lg-2,.col-xs-3,.col-sm-3,.col-md-3,.col-lg-3,.col-xs-4,.col-sm-4,.col-md-4,.col-lg-4,.col-xs-5,.col-sm-5,.col-md-5,.col-lg-5,.col-xs-6,.col-sm-6,.col-md-6,.col-lg-6,.col-xs-7,.col-sm-7,.col-md-7,.col-lg-7,.col-xs-8,.col-sm-8,.col-md-8,.col-lg-8,.col-xs-9,.col-sm-9,.col-md-9,.col-lg-9,.col-xs-10,.col-sm-10,.col-md-10,.col-lg-10,.col-xs-11,.col-sm-11,.col-md-11,.col-lg-11,.col-xs-12,.col-sm-12,.col-md-12,.col-lg-12{
    position:relative;
    min-height:1px;
    padding-right:15px;
    padding-left:15px
}
.col-xs-1,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9,.col-xs-10,.col-xs-11,.col-xs-12{
    float:left
}
.col-xs-12{
    width:100%
}
.col-xs-11{
    width:91.66666667%
}
.col-xs-10{
    width:83.33333333%
}
.col-xs-9{
    width:75%
}
.col-xs-8{
    width:66.66666667%
}
.col-xs-7{
    width:58.33333333%
}
.col-xs-6{
    width:50%
}
.col-xs-5{
    width:41.66666667%
}
.col-xs-4{
    width:33.33333333%
}
.col-xs-3{
    width:25%
}
.col-xs-2{
    width:16.66666667%
}
.col-xs-1{
    width:8.33333333%
}
.col-xs-pull-12{
    right:100%
}
.col-xs-pull-11{
    right:91.66666667%
}
.col-xs-pull-10{
    right:83.33333333%
}
.col-xs-pull-9{
    right:75%
}
.col-xs-pull-8{
    right:66.66666667%
}
.col-xs-pull-7{
    right:58.33333333%
}
.col-xs-pull-6{
    right:50%
}
.col-xs-pull-5{
    right:41.66666667%
}
.col-xs-pull-4{
    right:33.33333333%
}
.col-xs-pull-3{
    right:25%
}
.col-xs-pull-2{
    right:16.66666667%
}
.col-xs-pull-1{
    right:8.33333333%
}
.col-xs-pull-0{
    right:auto
}
.col-xs-push-12{
    left:100%
}
.col-xs-push-11{
    left:91.66666667%
}
.col-xs-push-10{
    left:83.33333333%
}
.col-xs-push-9{
    left:75%
}
.col-xs-push-8{
    left:66.66666667%
}
.col-xs-push-7{
    left:58.33333333%
}
.col-xs-push-6{
    left:50%
}
.col-xs-push-5{
    left:41.66666667%
}
.col-xs-push-4{
    left:33.33333333%
}
.col-xs-push-3{
    left:25%
}
.col-xs-push-2{
    left:16.66666667%
}
.col-xs-push-1{
    left:8.33333333%
}
.col-xs-push-0{
    left:auto
}
.col-xs-offset-12{
    margin-left:100%
}
.col-xs-offset-11{
    margin-left:91.66666667%
}
.col-xs-offset-10{
    margin-left:83.33333333%
}
.col-xs-offset-9{
    margin-left:75%
}
.col-xs-offset-8{
    margin-left:66.66666667%
}
.col-xs-offset-7{
    margin-left:58.33333333%
}
.col-xs-offset-6{
    margin-left:50%
}
.col-xs-offset-5{
    margin-left:41.66666667%
}
.col-xs-offset-4{
    margin-left:33.33333333%
}
.col-xs-offset-3{
    margin-left:25%
}
.col-xs-offset-2{
    margin-left:16.66666667%
}
.col-xs-offset-1{
    margin-left:8.33333333%
}
.col-xs-offset-0{
    margin-left:0
}
@media (min-width:768px){
    .col-sm-1,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-10,.col-sm-11,.col-sm-12{
        float:left
    }
    .col-sm-12{
        width:100%
    }
    .col-sm-11{
        width:91.66666667%
    }
    .col-sm-10{
        width:83.33333333%
    }
    .col-sm-9{
        width:75%
    }
    .col-sm-8{
        width:66.66666667%
    }
    .col-sm-7{
        width:58.33333333%
    }
    .col-sm-6{
        width:50%
    }
    .col-sm-5{
        width:41.66666667%
    }
    .col-sm-4{
        width:33.33333333%
    }
    .col-sm-3{
        width:25%
    }
    .col-sm-2{
        width:16.66666667%
    }
    .col-sm-1{
        width:8.33333333%
    }
    .col-sm-pull-12{
        right:100%
    }
    .col-sm-pull-11{
        right:91.66666667%
    }
    .col-sm-pull-10{
        right:83.33333333%
    }
    .col-sm-pull-9{
        right:75%
    }
    .col-sm-pull-8{
        right:66.66666667%
    }
    .col-sm-pull-7{
        right:58.33333333%
    }
    .col-sm-pull-6{
        right:50%
    }
    .col-sm-pull-5{
        right:41.66666667%
    }
    .col-sm-pull-4{
        right:33.33333333%
    }
    .col-sm-pull-3{
        right:25%
    }
    .col-sm-pull-2{
        right:16.66666667%
    }
    .col-sm-pull-1{
        right:8.33333333%
    }
    .col-sm-pull-0{
        right:auto
    }
    .col-sm-push-12{
        left:100%
    }
    .col-sm-push-11{
        left:91.66666667%
    }
    .col-sm-push-10{
        left:83.33333333%
    }
    .col-sm-push-9{
        left:75%
    }
    .col-sm-push-8{
        left:66.66666667%
    }
    .col-sm-push-7{
        left:58.33333333%
    }
    .col-sm-push-6{
        left:50%
    }
    .col-sm-push-5{
        left:41.66666667%
    }
    .col-sm-push-4{
        left:33.33333333%
    }
    .col-sm-push-3{
        left:25%
    }
    .col-sm-push-2{
        left:16.66666667%
    }
    .col-sm-push-1{
        left:8.33333333%
    }
    .col-sm-push-0{
        left:auto
    }
    .col-sm-offset-12{
        margin-left:100%
    }
    .col-sm-offset-11{
        margin-left:91.66666667%
    }
    .col-sm-offset-10{
        margin-left:83.33333333%
    }
    .col-sm-offset-9{
        margin-left:75%
    }
    .col-sm-offset-8{
        margin-left:66.66666667%
    }
    .col-sm-offset-7{
        margin-left:58.33333333%
    }
    .col-sm-offset-6{
        margin-left:50%
    }
    .col-sm-offset-5{
        margin-left:41.66666667%
    }
    .col-sm-offset-4{
        margin-left:33.33333333%
    }
    .col-sm-offset-3{
        margin-left:25%
    }
    .col-sm-offset-2{
        margin-left:16.66666667%
    }
    .col-sm-offset-1{
        margin-left:8.33333333%
    }
    .col-sm-offset-0{
        margin-left:0
    }
}
@media (min-width:992px){
    .col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12{
        float:left
    }
    .col-md-12{
        width:100%
    }
    .col-md-11{
        width:91.66666667%
    }
    .col-md-10{
        width:83.33333333%
    }
    .col-md-9{
        width:75%
    }
    .col-md-8{
        width:66.66666667%
    }
    .col-md-7{
        width:58.33333333%
    }
    .col-md-6{
        width:50%
    }
    .col-md-5{
        width:41.66666667%
    }
    .col-md-4{
        width:33.33333333%
    }
    .col-md-3{
        width:25%
    }
    .col-md-2{
        width:16.66666667%
    }
    .col-md-1{
        width:8.33333333%
    }
    .col-md-pull-12{
        right:100%
    }
    .col-md-pull-11{
        right:91.66666667%
    }
    .col-md-pull-10{
        right:83.33333333%
    }
    .col-md-pull-9{
        right:75%
    }
    .col-md-pull-8{
        right:66.66666667%
    }
    .col-md-pull-7{
        right:58.33333333%
    }
    .col-md-pull-6{
        right:50%
    }
    .col-md-pull-5{
        right:41.66666667%
    }
    .col-md-pull-4{
        right:33.33333333%
    }
    .col-md-pull-3{
        right:25%
    }
    .col-md-pull-2{
        right:16.66666667%
    }
    .col-md-pull-1{
        right:8.33333333%
    }
    .col-md-pull-0{
        right:auto
    }
    .col-md-push-12{
        left:100%
    }
    .col-md-push-11{
        left:91.66666667%
    }
    .col-md-push-10{
        left:83.33333333%
    }
    .col-md-push-9{
        left:75%
    }
    .col-md-push-8{
        left:66.66666667%
    }
    .col-md-push-7{
        left:58.33333333%
    }
    .col-md-push-6{
        left:50%
    }
    .col-md-push-5{
        left:41.66666667%
    }
    .col-md-push-4{
        left:33.33333333%
    }
    .col-md-push-3{
        left:25%
    }
    .col-md-push-2{
        left:16.66666667%
    }
    .col-md-push-1{
        left:8.33333333%
    }
    .col-md-push-0{
        left:auto
    }
    .col-md-offset-12{
        margin-left:100%
    }
    .col-md-offset-11{
        margin-left:91.66666667%
    }
    .col-md-offset-10{
        margin-left:83.33333333%
    }
    .col-md-offset-9{
        margin-left:75%
    }
    .col-md-offset-8{
        margin-left:66.66666667%
    }
    .col-md-offset-7{
        margin-left:58.33333333%
    }
    .col-md-offset-6{
        margin-left:50%
    }
    .col-md-offset-5{
        margin-left:41.66666667%
    }
    .col-md-offset-4{
        margin-left:33.33333333%
    }
    .col-md-offset-3{
        margin-left:25%
    }
    .col-md-offset-2{
        margin-left:16.66666667%
    }
    .col-md-offset-1{
        margin-left:8.33333333%
    }
    .col-md-offset-0{
        margin-left:0
    }
}
@media (min-width:1200px){
    .col-lg-1,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-10,.col-lg-11,.col-lg-12{
        float:left
    }
    .col-lg-12{
        width:100%
    }
    .col-lg-11{
        width:91.66666667%
    }
    .col-lg-10{
        width:83.33333333%
    }
    .col-lg-9{
        width:75%
    }
    .col-lg-8{
        width:66.66666667%
    }
    .col-lg-7{
        width:58.33333333%
    }
    .col-lg-6{
        width:50%
    }
    .col-lg-5{
        width:41.66666667%
    }
    .col-lg-4{
        width:33.33333333%
    }
    .col-lg-3{
        width:25%
    }
    .col-lg-2{
        width:16.66666667%
    }
    .col-lg-1{
        width:8.33333333%
    }
    .col-lg-pull-12{
        right:100%
    }
    .col-lg-pull-11{
        right:91.66666667%
    }
    .col-lg-pull-10{
        right:83.33333333%
    }
    .col-lg-pull-9{
        right:75%
    }
    .col-lg-pull-8{
        right:66.66666667%
    }
    .col-lg-pull-7{
        right:58.33333333%
    }
    .col-lg-pull-6{
        right:50%
    }
    .col-lg-pull-5{
        right:41.66666667%
    }
    .col-lg-pull-4{
        right:33.33333333%
    }
    .col-lg-pull-3{
        right:25%
    }
    .col-lg-pull-2{
        right:16.66666667%
    }
    .col-lg-pull-1{
        right:8.33333333%
    }
    .col-lg-pull-0{
        right:auto
    }
    .col-lg-push-12{
        left:100%
    }
    .col-lg-push-11{
        left:91.66666667%
    }
    .col-lg-push-10{
        left:83.33333333%
    }
    .col-lg-push-9{
        left:75%
    }
    .col-lg-push-8{
        left:66.66666667%
    }
    .col-lg-push-7{
        left:58.33333333%
    }
    .col-lg-push-6{
        left:50%
    }
    .col-lg-push-5{
        left:41.66666667%
    }
    .col-lg-push-4{
        left:33.33333333%
    }
    .col-lg-push-3{
        left:25%
    }
    .col-lg-push-2{
        left:16.66666667%
    }
    .col-lg-push-1{
        left:8.33333333%
    }
    .col-lg-push-0{
        left:auto
    }
    .col-lg-offset-12{
        margin-left:100%
    }
    .col-lg-offset-11{
        margin-left:91.66666667%
    }
    .col-lg-offset-10{
        margin-left:83.33333333%
    }
    .col-lg-offset-9{
        margin-left:75%
    }
    .col-lg-offset-8{
        margin-left:66.66666667%
    }
    .col-lg-offset-7{
        margin-left:58.33333333%
    }
    .col-lg-offset-6{
        margin-left:50%
    }
    .col-lg-offset-5{
        margin-left:41.66666667%
    }
    .col-lg-offset-4{
        margin-left:33.33333333%
    }
    .col-lg-offset-3{
        margin-left:25%
    }
    .col-lg-offset-2{
        margin-left:16.66666667%
    }
    .col-lg-offset-1{
        margin-left:8.33333333%
    }
    .col-lg-offset-0{
        margin-left:0
    }
}
.clearfix:before, .clearfix:after, .dl-horizontal dd:before, .dl-horizontal dd:after, .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after, .form-horizontal .form-group:before, .form-horizontal .form-group:after,.btn-toolbar:before,.btn-toolbar:after,.btn-group-vertical>.btn-group:before,.btn-group-vertical>.btn-group:after,.nav:before,.nav:after,.navbar:before,.navbar:after,.navbar-header:before,.navbar-header:after,.navbar-collapse:before,.navbar-collapse:after,.pager:before,.pager:after,.panel-body:before,.panel-body:after,.modal-header:before,.modal-header:after,.modal-footer:before,.modal-footer:after{
    display:table;
    content:" "
}
.clearfix:after, .dl-horizontal dd:after, .container:after, .container-fluid:after, .row:after, .form-horizontal .form-group:after,.btn-toolbar:after,.btn-group-vertical>.btn-group:after,.nav:after,.navbar:after,.navbar-header:after,.navbar-collapse:after,.pager:after,.panel-body:after,.modal-header:after,.modal-footer:after{
    clear:both
}
.my_order_list table{
    border:0
}
.my_order_listing .pro_name .color{
    padding-right:0;
    display:block;
    margin:8px 0 0 0
}
.my_order_listing .pro_name p{
    line-height:normal
}
.my_order_list table th{
    border-bottom:#eee;
    border-right:0;
    background:#eee;
    font-size:15px;
    color:#787878;
    font-family:'proxima_novasemibold';
    text-transform:capitalize;
    padding:15px 20px
}
.my_order_list table td{
    border-bottom:1px solid #eee;
    border-right:0;
    color:#3b3b3b;
    font-size:15px;
    padding:22px 20px
}
.my_order_list table td.my-order-price{
    text-transform:uppercase
}
.my_order_view{
    font-family:'proxima_nova_rgregular'
}
.my_order_num{
    font-family:'proxima_nova_rgbold'
}
.my_order_det .my_order_det_order h2{
    font-size:24px;
    text-align:center;
    font-family:'proxima_nova_rgregular';
    text-transform:inherit;
    color:#3b3b3b;
    text-transform:inherit
}
.my_order_det .my_order_det_order h2 span{
    font-family:'proxima_nova_rgbold';
    color:#FE9B1A
}
.my_order_det .my_order_det_order .my_order_det_left{
    padding-left:20px
}
.my_order_det .my_order_det_order .my_order_det_left h3{
    font-size:17px;
    font-family:'proxima_nova_rgregular';
    color:#3b3b3b;
    text-transform:inherit
}
.my_order_det .my_order_det_order .my_order_det_left span{
    font-family:'proxima_nova_rgbold';
    color:#3a3a3a
}
.my_order_det .my_order_det_order .my_order_det_right{
    padding-right:20px
}
.my_order_det .my_order_det_order .my_order_det_right h3{
    font-size:17px;
    font-family:'proxima_nova_rgregular';
    color:#3a3a3a;
    text-transform:inherit
}
.my_order_det .my_order_det_order .my_order_det_right span{
    font-family:'proxima_nova_rgbold';
    color:#3b3b3b
}
.my_order_det_productleft{
    width:25%
}
.my_order_det_productright{
    width:75%;
    padding-left:15px
}
.my_order_det_productright p{
    font-size:17px;
    margin-bottom:40px
}
.my_order_det_productright h3{
    font-size:17px;
    text-transform:inherit
}
.my_order_det_full{
    border-top:1px solid #eee;
    padding:15px 0 0 0
}
.my_order_det_full h3{
    margin:0px
}
.my_order_det table{
    border-right:1px solid #eee;
    border-left:1px solid #eee
}
.my_order_det table td.pro_name{
    width:36%;
    border-right:0 none;
    padding:25px 15px 25px 110px;
    position:relative
}
.my_order_det table td.pro_name .pro_pic{
    display:inline-block;
    height:70px;
    left:15px;
    overflow:hidden;
    position:absolute;
    width:70px
}
.my_order_det table .pro_name em img{
    margin-bottom:10px
}
.my_order_det table td.pro_price{
    width:17%;
    text-transform:uppercase
}
.my_order_det table td.pro_qua{
    width:7%
}
.my_order_det table td.pro_amount{
    width:15%;
    text-transform:uppercase
}
.my_order_det table td.pro_status{
    width:15%
}
.my_order_det table td.pro_status strong{
    display:block;
    margin:5px 0 10px 0
}
.my_order_det table td.pro_status a{
    font-family:'proxima_nova_rgbold';
    font-size:14px;
    padding:8px;
    border-radius:5px;
    border:1px solid #f39125;
    color:#f39125;
    display:inline-block;
    transition:0.2s all ease-in-out
}
.my_order_det table td.pro_status a:hover{
    color:#3a3a3a;
    border:1px solid #3a3a3a
}
.my_order_detail .my_order_det p{
    margin-bottom:0;
    color:#787878
}
.my_order_detail .my_order_det strong{
    color:#3a3a3a
}
.my_order_detail .my_order_det .desc{
    margin-bottom:20px;
    line-height:normal
}
.my_order_detail .my_order_det .merchant{
    margin-bottom:2px
}
.my_order_detail .my_order_det table th{
    text-transform:inherit
}
.my_detailtableinner{
    background:#eee
}
.my_detailtableinner .my_detailtrack a{
    font-family:'proxima_nova_rgbold';
    font-size:14px;
    padding:10px;
    border-radius:5px;
    background:#fff;
    color:#fe9b1a;
    border:1px solid #fe9b1a;
    display:block;
    transition:0.2s all ease-in-out;
    text-transform:uppercase;
    text-align:center;
    text-transform:none
}
.my_detailtableinner .my_detailtrack a:hover{
    background:#fe9b1a;
    color:#fff
}
.my_detailtableinner .my_confirm a{
    font-family:'proxima_nova_rgbold';
    font-size:14px;
    padding:10px;
    border-radius:5px;
    background:#fe9b1a;
    color:#fff;
    display:block;
    transition:0.2s all ease-in-out;
    text-transform:uppercase;
    text-align:center;
    text-transform:none;
    border:1px solid #fe9b1a
}
.my_detailtableinner .my_confirm a:hover{
    background:#fff;
    color:#fe9b1a
}
.my_detailtableinner tr td{
    border-bottom:0
}
.my_detailtableinner td{
    border-bottom:0 !important;
    padding:5px 20px !important
}
.my_detailtableinner .my_order_det table td.pro_status a:hover{
    color:
}
.my_detailtableone{
    width:43%
}
.my_detailtabletwo{
    width:34%
}
.my_detailtablethree{
    width:23%;
    vertical-align:middle
}
.detail_address{
    margin-top:40px;
    padding:0 25px
}
.detail_address_Left h3{
    position:relative;
    font-size:21px;
    text-transform:inherit;
    color:#2a2a2a;
    padding-bottom:6px
}
.detail_address_Left h3:after{
    background:#787878;
    height:2px;
    width:50px;
    position:absolute;
    left:0;
    bottom:0;
    content:''
}
.detail_address table{
    border:none;
    margin:0px
}
.detail_address table th, .thank_ship_add_right table td{
    border:none;
    padding:5px;
    text-transform:none;
    color:#787878;
    font-family:'proxima_nova_rgregular';
    background:inherit
}
.detail_address table td{
    text-align:right;
    font-family:'proxima_nova_rgbold';
    color:#3a3a3a;
    padding:5px;
    border-bottom:0
}
.detail_address table td.total{
    color:#f90
}
.detail_address table td.price{
    text-transform:uppercase
}
.detail_address .detail_address_Left table{
    width:250px
}
.my_order_review{
}
.account_message .account_message_inner{
    background:#EEE
}
.account_message .account_message_left{
    float:left
}
.account_message .account_message_left h4{
    margin-bottom:0;
    text-transform:none
}
.account_message .account_message_right{
    float:right;
    padding:18px 15px 18px 0
}
.account_message .account_message_right_inner{
    margin:0;
    padding:0
}
.account_message .account_message_right_inner:after{
    clear:both;
    display:block;
    content:''
}
.account_message .account_message_right_inner li{
    float:left;
    list-style:none;
    font-family:'proxima_nova_rgbold'
}
.account_message .account_message_right_inner li a{
    color:#3a3a3a;
    position:relative;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    padding:0 20px
}
.account_message .account_message_right_inner li a:after{
    position:absolute;
    right:0;
    bottom:0;
    top:0;
    margin:auto;
    width:1px;
    height:12px;
    background:#b6b6b6;
    content:''
}
.account_message li a:hover, .account_message li.active a{
    color:#FE9B1A
}
.account_message .account_message_right_inner li:last-child a{
    padding-right:0px
}
.account_message .account_message_right_inner li:last-child a:after{
    display:none
}
.account_message table{
    border:0
}
.account_message table th{
    border-right:0;
    color:#787878;
    font-family:"proxima_novasemibold";
    text-transform:capitalize;
    padding:12px 15px;
    background:#eee;
    border:none
}
.account_message table td{
    border-bottom:1px solid #eee;
    border-right:0;
    color:#3b3b3b;
    font-size:15px;
    padding:20px 15px
}
.account_message .res-table table span{
    font-family:'proxima_novasemibold';
    color:#3a3a3a
}
.account_message .res-table table p{
    color:#FEA025;
    line-height:normal;
    margin:3px 0 0 0;
    font-size:14px
}
.account_message .res-table table td{
    color:#787878;
    vertical-align:middle
}
.account_message .res-table table img{
    display:inline-block;
    margin-top:-7px;
    padding-right:5px
}
.account_message .pagination{
    margin:15px 0 0 0;
    padding:0
}
.account_message .pagination li{
    margin-right:15px;
    padding:0;
    border:none;
    float:left;
    min-height:inherit;
    list-style:none
}
.account_message .pagination li a{
    font-size:14px;
    color:#979797;
    padding:0
}
.account_message .pagination li:first-child a, .brand_details_inner .review_sort_list .pagination li:last-child a{
    font-size:16px
}
.account_message .pagination li a:hover, .brand_details_inner .review_sort_list .pagination li.active a{
    color:#3a3a3a
}
.account_tab{
    padding:0;
    margin:15px 0 0px
}
.account_tab:after{
    clear:both;
    display:block;
    content:''
}
.account_tab li{
    list-style:none;
    float:left;
    padding:0;
    margin:0
}
.account_tab li a{
    position:relative;
    color:#3a3a3a;
    padding:0 15px;
    transition:all 0.3s ease
}
.account_tab li a:hover, .account_tab li.active a{
    color:#fe9b1a
}
.account_tab li a:after{
    position:absolute;
    right:0;
    bottom:0;
    top:0;
    margin:auto;
    width:1px;
    height:12px;
    background:#b6b6b6;
    content:''
}
.account_tab li:first-child{
    padding-left:0
}
.account_tab li:last-child{
    padding-right:0
}
.account_tab li:last-child a:after{
    display:none
}
.account_evalet .evalet-points{
    padding:30px 0 15px 0
}
.account_evalet .evalet-points h5{
    margin-bottom:0px;
    color:#3a3a3a;
    font-size:22px;
    text-transform:none;
    position:relative;
    padding-left:70px
}
.account_evalet .evalet-points h5:before{
    position:absolute;
    left:0;
    top:0;
    content:'';
    background:url(../media/full_sprite.png) no-repeat scroll -253px -96px transparent;
    width:50px;
    height:41px
}
.account_evalet .evalet-points span{
    display:block;
    font-size:16px;
    font-family:'proxima_nova_rgregular';
    margin-top:5px
}
.account_evalet table{
    font-size:16px
}
.account_evalet table td.points{
    color:#3a3a3a;
    font-family:'proxima_novasemibold'
}
.account_evalet table td .yellow{
    color:#fe9b1a
}
.account_evalet .account_evalet_top{
    padding:15px 0
}
.account_evalet .account_evalet_top:after{
    clear:both;
    display:block;
    content:''
}
.account_evalet .my_acc_right .evalet-points, .account_evalet .my_acc_right .account_tab{
    width:33.3%;
    float:left;
    padding:0 7px 0 0
}
.account_evalet .my_acc_right .account_tab{
    padding:0
}
.account_evalet .my_acc_right .evalet-rightbut{
    text-align:right;
    margin:0
}
.account_evalet .my_acc_right .evalet-rightbut li{
    float:none
}
.account_evalet .my_acc_right .evalet-rightbut a{
    background:#fe9b1a;
    font:16px 'proxima_novasemibold';
    padding:10px 15px;
    cursor:pointer;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    color:#fff;
    border-radius:5px;
    -webkit-border-radius:5px;
    display:inline-block
}
.account_evalet .my_acc_right .evalet-rightbut a:hover{
    background:#004282
}
.account_withdraw .my_acc_right .evalet-points{
    width:100% !important;
    float:none !important
}
.account_withdraw .my_acc_right .evalet-points:after{
    clear:both;
    display:block;
    content:''
}
.account_withdraw .my_acc_right .evalet-points h5{
    float:left;
    padding-right:20px;
    margin-right:20px;
    position:relative
}
.account_withdraw .my_acc_right .evalet-points h5:after{
    position:absolute;
    right:0;
    top:0;
    bottom:0;
    width:1px;
    height:100%;
    content:'';
    background:#dedede
}
.account_withdraw .my_acc_right .evalet-points p{
    margin:0;
    float:right;
    width:calc(100% - 290px);
    width:-webkit-calc(100% - 290px);
    color:#3a3a3a
}
.account_evalet .evalet-cashback h5:before{
    position:absolute;
    left:0;
    top:0;
    content:'';
    background:url(../media/full_sprite.png) no-repeat scroll -255px -155px transparent;
    width:45px;
    height:45px
}
.contact{
    width:100%;
    display:inline-block;
    padding:50px 0
}
.contact h3{
    font-size:22px;
    line-height:24px;
    margin-bottom:0px;
    padding-bottom:13px;
    position:relative;
    text-align:center
}
.contact p{
    width:70%;
    text-align:center;
    margin:0 auto 20px auto
}
.contact_inner{
    margin-top:50px
}
.contact_inner .form-group{
    position:relative;
    margin-bottom:20px
}
.contact .form-group p{
    width:auto;
    text-align:left;
    position:absolute;
    right:inherit
}
.contact .chosen-container-single .chosen-single:after, .contact .chosen-container-single .chosen-single{
    line-height:40px
}
.contact .chosen-container-single .chosen-single{
    font-size:15px;
    text-align:left
}
.contact_left{
    width:70%
}
.contact_right{
    width:30%;
    padding-left:15px
}
.contact_left .has-error .help-block-error{
    bottom:-14px
}
.contact_left_inner{
    width:50%;
    float:left
}
.contact_left .contact_left_inner{
    padding:0 20px 0 0
}
.contact_left .contact_left_inner input[type="text"]{
    box-shadow:none
}
.contact_left .contact_left_message{
    padding:0 20px 0 0;
    width:100%;
    clear:both
}
.contact_left .contact_left_message textarea{
    height:130px;
    padding:10px;
    box-shadow:none;
    margin-bottom:6px
}
.contact_left .contact_left_submit{
    width:100%;
    display:inline-block
}
.contact_left .contact_left_submit .btn{
    background:#FE9B1A;
    border:0 none;
    color:#fff;
    font-family:"proxima_novasemibold";
    font-size:15px;
    padding:10px 25px;
    cursor:pointer
}
.contact_left .contact_left_submit .btn:hover{
    background:#004282
}
.contact_right_inner{
    background:#F4F4F4;
    display:inline-block;
    padding:20px 25px;
    width:100%
}
.contact_address{
    width:100%;
    display:inline-block;
    margin:10px 0;
    position:relative;
    padding-left:70px
}
.contact_address_left{
    position:absolute;
    left:0;
    top:0
}
.contact_address_left::before{
    font-family:"FontAwesome";
    content:"\f095";
    position:absolute;
    top:0;
    font-size:21px;
    background:#fe9b1a;
    border-radius:50%;
    color:#fff;
    font-size:21px;
    height:45px;
    line-height:45px;
    text-align:center;
    width:45px
}
.contact_address_icon2::before{
    content:"\f0e0";
    font-size:16px
}
.contact_address_left i{
    border-radius:50%;
    color:#fff;
    font-size:21px;
    height:45px;
    line-height:45px;
    text-align:center;
    width:45px;
    background:#FE9B1A
}
.contact_address_left .fa-envelope{
    font-size:16px
}
.contact_address_right h4{
    font-size:18px;
    text-transform:none;
    margin-bottom:10px
}
.contact_address_right span{
    display:block;
    margin:8px 0 0 0
}
.contact_address_right a{
    color:#787878;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease
}
.contact_address_right a:hover{
    color:#fe9b1a
}
.contact_map{
    width:100%;
    display:inline-block;
    padding-bottom:50px
}
.progress_bar{
    margin-bottom:35px
}
.progress_bar ul{
    padding:0px;
    position:relative;
    font-size:0;
    text-align:center
}
.progress_bar ul:after{
    clear:both;
    display:block;
    content:''
}
.progress_bar ul li{
    list-style:none;
    display:inline-block;
    width:25%;
    text-align:center;
    position:relative
}
.progress_bar ul:before{
    width:100%;
    height:6px;
    background:#eee;
    position:absolute;
    left:0;
    right:0;
    bottom:30px;
    content:'';
    z-index:1
}
.progress_bar ul li a, .progress_bar ul li span{
    display:block
}
.progress_bar ul li span{
    width:70px;
    height:70px;
    margin:15px auto 0;
    line-height:70px;
    background:#eee;
    border-radius:3px;
    -webkit-border-radius:3px;
    position:relative;
    transition:all 0.6s ease;
    -webkit-transition:all 0.6s ease;
    border:1px solid transparent
}
.progress_bar ul li span .lazy{
    position:absolute;
    left:0;
    top:0;
    right:0;
    bottom:0;
    margin:auto
}
.progress_bar ul li span .alternate{
    top:0;
    bottom:0px
}
.progress_bar ul li a:hover span, .progress_bar ul li.active a span{
    border:1px solid #f39125
}
.progress_bar ul li a{
    color:#909090;
    font-family:'proxima_nova_rgbold';
    text-transform:uppercase;
    position:relative;
    z-index:2;
    font-size:16px
}
.progress_bar ul li a:hover, .progress_bar ul li.active a{
    color:#3b3b3b
}
.progress_bar ul li:hover .alternate, .progress_bar ul li.active .alternate, .progress_bar > li > a.active .alternate{
    opacity:1
}
.ship_add_full{
    padding:35px;
    background:#fff
}
.ship_add_full h3{
    color:#3b3b3b;
    text-transform:inherit;
    margin-bottom:30px
}
.ship_add{
    margin-bottom:30px
}
.address_list{
    padding:0;
    position:relative
}
.address_list:after{
    clear:both;
    display:block;
    content:''
}
.address_list li{
    list-style:none;
    float:left;
    width:48%;
    margin-bottom:4%;
    border:2px solid transparent
}
.address_list li.active{
    border:2px solid #fe9b1a
}
.address_list li:nth-child(even){
    float:right
}
.address_list .address{
    background:#eee;
    border-radius:3px;
    -webkit-border-radius:3px;
    position:relative
}
.address_list .address.add{
    background:transparent
}
.address_list .address h6{
    color:#3b3b3b;
    text-transform:inherit;
    font-size:17px;
    border-bottom:1px solid #d4d4d4;
    margin-bottom:0;
    padding:20px 185px 19px 90px;
    position:relative;
    min-height:60px;
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis
}
.address_list .address h6:before{
    background:url(../media/full_sprite.png) no-repeat scroll -191px -312px transparent;
    width:41px;
    height:41px;
    content:'';
    position:absolute;
    left:30px;
    top:8px
}
.address_list .address .description{
    font:16px/26px 'proxima_nova_rgregular';
    color:#3b3b3b;
    padding:24px 30px
}
.address_list .address .three-icons{
    position:absolute;
    right:0;
    top:0;
    font-size:0
}
.address_list .address .edit_icon{
    width:60px;
    height:60px;
    line-height:60px;
    border-left:1px solid #d4d4d4;
    background:url(../media/full_sprite.png) no-repeat scroll -180px -365px transparent;
    display:inline-block
}
.address_list .address .edit_icon:hover{
    background:url(../media/full_sprite.png) no-repeat scroll -240px -365px transparent
}
.address_list .address .delete_icon{
    background:url(../media/full_sprite.png) no-repeat scroll -442px -193px transparent
}
.address_list .address .delete_icon:hover{
    background:url(../media/full_sprite.png) no-repeat scroll -391px -193px transparent
}
.address_list .address .delivery_icon{
    background:url(../media/full_sprite.png) no-repeat scroll -445px -250px transparent
}
.address_list .address .delivery_icon:hover{
    background:url(../media/full_sprite.png) no-repeat scroll -394px -250px transparent
}
.address_list .address .address_inner{
    border:2px dashed #cdcdcd;
    min-height:180px
}
.address_list .address .address_inner .add_address{
    color:#909090;
    position:relative;
    display:block;
    font:19px 'proxima_nova_rgbold';
    text-transform:uppercase;
    cursor:pointer
}
.address_list .address .address_inner .add_address:hover{
    color:#2a2a2a
}
.address_list .address .address_inner .add_address:before{
    background:url(../media/full_sprite.png) no-repeat scroll -412px -89px transparent;
    width:64px;
    height:64px;
    content:'';
    position:relative;
    top:30px;
    display:block;
    margin:auto;
    margin-bottom:50px
}
.address_list .address .address_inner .add_address:hover:before{
    background:url(../media/full_sprite.png) no-repeat scroll -412px -1px transparent
}
.address_list .address .address_inner{
    -webkit-transform:rotateX(0);
    -moz-transform:rotateX(0);
    -o-transform:rotateX(0);
    -ms-transform:rotateX(0);
    transform:rotateX(0);
    -webkit-backface-visibility:hidden;
    -moz-backface-visibility:hidden;
    -ms-backface-visibility:hidden;
    backface-visibility:hidden;
    -webkit-transition:all .4s linear;
    -moz-transition:all .4s linear;
    -o-transition:all .4s linear;
    -ms-transition:all .4s linear;
    transition:all .4s linear
}
.address_list .address.edit_address .address_inner{
    -webkit-transform:rotateY(180deg);
    -moz-transform:rotateY(180deg);
    -o-transform:rotateY(180deg);
    -ms-transform:rotateY(180deg);
    transform:rotateY(180deg)
}
.address_list .address .address_form{
    min-height:375px;
    position:absolute;
    z-index:100;
    top:0;
    left:0;
    background-color:#efefef;
    -webkit-border-radius:2px;
    border-radius:2px;
    border:1px solid #ccc;
    -webkit-box-shadow:0 5px 25px rgba(0,0,0,.2);
    box-shadow:0 5px 25px rgba(0,0,0,.2);
    display:none;
    max-width:1140px
}
.address_list .address:nth-child(even) .address_form{
    left:-110%;
    right:0
}
.address_list .address:nth-child(odd) .address_form{
    left:0;
    right:-110%
}
.address_list .address .address_form{
    display:block;
    -webkit-transform:rotateY(-180deg) scale(.3,.8);
    -moz-transform:rotateY(-180deg) scale(.3,.8);
    -o-transform:rotateY(-180deg) scale(.3,.8);
    -ms-transform:rotateY(-180deg) scale(.3,.8);
    transform:rotateY(-180deg) scale(.3,.8);
    -webkit-backface-visibility:hidden;
    -moz-backface-visibility:hidden;
    -ms-backface-visibility:hidden;
    backface-visibility:hidden;
    opacity:0;
    filter:alpha(opacity=0);
    -ms-filter:"alpha(Opacity=0)";
    -webkit-transition:all .4s linear;
    -moz-transition:all .4s linear;
    -o-transition:all .4s linear;
    -ms-transition:all .4s linear;
    transition:all .4s linear
}
.address_list .address.edit_address .address_form{
    opacity:1;
    -ms-filter:none;
    filter:none;
    -webkit-transform:rotateY(0) scale(1);
    -moz-transform:rotateY(0) scale(1);
    -o-transform:rotateY(0) scale(1);
    -ms-transform:rotateY(0) scale(1);
    transform:rotateY(0) scale(1)
}
.ship_add .address_list .address{
    background:transparent
}
.ship_add .address_list .address .address_one_inner{
    background:#eee
}
.ship_add .address .address_one_inner{
    -webkit-transform:rotateX(0);
    -moz-transform:rotateX(0);
    -o-transform:rotateX(0);
    -ms-transform:rotateX(0);
    transform:rotateX(0);
    -webkit-backface-visibility:hidden;
    -moz-backface-visibility:hidden;
    -ms-backface-visibility:hidden;
    backface-visibility:hidden;
    -webkit-transition:all .4s linear;
    -moz-transition:all .4s linear;
    -o-transition:all .4s linear;
    -ms-transition:all .4s linear;
    transition:all .4s linear
}
.ship_add .address.ship_edit .address_one_inner{
    -webkit-transform:rotateY(180deg);
    -moz-transform:rotateY(180deg);
    -o-transform:rotateY(180deg);
    -ms-transform:rotateY(180deg);
    transform:rotateY(180deg)
}
.close_icon{
    position:absolute;
    right:0;
    top:0;
    width:30px;
    height:30px;
    line-height:30px;
    text-align:center;
    color:#fff;
    background:#2a2a2a;
    font-size:13px;
    display:inline-block;
    cursor:pointer
}
.close_icon:hover{
    background:#fe9b1a
}
.delivery_address input[type="button"]{
    margin-top:15px;
    white-space:normal;
    height:auto;
    padding:10px 16px
}
.delivery_address .delivery_add_left .odd, .delivery_address .delivery_add_left .even{
    float:left;
    width:48.5%
}
.delivery_address .delivery_add_left .even{
    float:right
}
.delivery_address label{
    text-transform:uppercase;
    font-size:15px
}
.delivery_address{
    position:relative
}
.delivery_address .delivery_add_left{
    width:51.30890052356021%;
    padding:30px 20px 20px 20px;
    position:relative
}
.delivery_address .title{
    position:relative;
    font-size:24px;
    color:#3a3a3a;
    padding-left:50px;
    min-height:28px
}
.delivery_address .title span{
    font:20px 'proxima_novasemibold';
    background:#fe9b1a;
    width:35px;
    height:35px;
    position:absolute;
    left:0;
    content:'';
    text-align:center;
    line-height:35px;
    color:#fff;
    border-radius:50%;
    -webkit-border-radius:50%;
    top:-7px
}
.delivery_address .delivery_add_left form{
}
.delivery_address form .form-field{
}
.delivery_address form .form-field .odd{
    width:48%
}
.delivery_address form .form-field .even{
    float:right
}
.delivery_address form label{
    font:13px 'proxima_novasemibold';
    display:block;
    margin-bottom:5px
}
.delivery_address form input[type="text"]{
}
.delivery_address form input[type="submit"]{
    border-radius:3px;
    -webkit-border-radius:3px;
    margin-top:20px
}
.delivery_address .delivery_add_right{
    width:48.69109947643979%
}
.delivery_add_two{
    padding:30px
}
.delivery_add_two .require{
    color:red
}
.delivery_add_two .form-field-left{
    width:48%;
    float:left
}
.delivery_add_two .form-field-right{
    width:48%;
    float:right
}
.delivery_add_two .form-field-right textarea{
    height:110px
}
.delivery_add_two .form-field-right .form-field label{
    text-transform:uppercase
}
.form_change{
    width:100%;
    display:inline-block
}
.form_change_inner{
    margin:25px 0 0 0
}
.form_change .form_left{
    float:left
}
.form_change .form_left i{
    padding-right:10px;
    color:
}
.form_change .form_left span{
    color:#787878;
    font-family:'proxima_novasemibold';
    text-transform:uppercase;
    cursor:pointer;
    transition:all 0.3s ease
}
.form_change .form_left span:hover{
    color:#000
}
.form_change .form_right{
    float:right
}
.next_but input[type="submit"]{
    font:19px 'proxima_novaextrabold';
    border-radius:5px;
    -webkit-border-radius:5px;
    padding:11px 16px;
    height:auto;
    min-width:150px
}
.ship_add_full{
    padding:35px;
    background:#fff
}
.ship_add_full h3{
    color:#3b3b3b;
    text-transform:inherit;
    margin-bottom:40px;
    font-size:30px
}
.ship_add_left{
    background:#eee;
    border-radius:3px;
    -webkit-border-radius:3px
}
.ship_add_com{
    float:left;
    width:47.34042553191489%
}
.ship_add_com:nth-of-type(even){
    float:right
}
.ship_add{
    margin-bottom:30px
}
.ship_add_left{
    position:relative
}
.ship_add_left h6{
    color:#3b3b3b;
    text-transform:inherit;
    font-size:17px;
    border-bottom:1px solid #d4d4d4;
    margin-bottom:0;
    padding:20px 65px 19px 90px;
    position:relative
}
.ship_add_left h6:before{
    background:url(../media/full_sprite.png) no-repeat scroll -191px -312px transparent;
    width:41px;
    height:41px;
    content:'';
    position:absolute;
    left:30px;
    top:8px
}
.ship_add_left .edit_icon{
    position:absolute;
    right:0;
    top:0;
    width:60px;
    height:60px;
    line-height:60px;
    border-left:1px solid #d4d4d4;
    background:url(../media/full_sprite.png) no-repeat scroll -180px -365px transparent
}
.ship_add_left .edit_icon:hover{
    background:url(../media/full_sprite.png) no-repeat scroll -240px -365px transparent
}
.ship_add_left .description{
    font:15px/24px 'proxima_nova_rgregular';
    color:#3b3b3b;
    padding:24px 30px
}
.ship_add_right{
    border:2px dashed #cdcdcd;
    min-height:180px
}
.ship_add_right a{
    color:#909090;
    position:relative;
    display:block;
    font:19px 'proxima_nova_rgbold';
    text-transform:uppercase
}
.ship_add_right a:hover{
    color:#2a2a2a
}
.ship_add_right a:before{
    background:url(../media/full_sprite.png) no-repeat scroll -237px -233px transparent;
    width:64px;
    height:64px;
    content:'';
    position:relative;
    top:30px;
    display:block;
    margin:auto;
    margin-bottom:50px
}
.ship_add_right a:hover:before{
    background:url(../media/full_sprite.png) no-repeat scroll -237px -157px transparent
}
.contact_info{
    padding:0 30px 30px 20px
}
.contact_info h3 span{
    font:14px 'proxima_nova_rgregular';
    color:#8e8e8e
}
.sidetext{
    font:15px 'proxima_nova_rgregular';
    position:relative;
    top:10px
}
.contact_info label{
    display:block;
    padding-right:5px
}
.contact_info input[type="text"], .contact_info textarea{
    border:2px solid #cdcdcd;
    font-size:15px;
    margin-bottom:0px
}
.contact_info textarea{
    height:55px
}
.contact_info .form-field{
    margin-bottom:20px
}
.contact_info .label_part{
    width:19.148936170212766%;
    position:relative;
    top:10px
}
.contact_info .input_part{
    width:80.85106382978723%
}
.contact_info .input_part_left{
    width:35.526315789473684%
}
.contact_info .input_part_right{
    width:62.5%
}
.contact_info .required{
}
.address_list .address .ship_edit_icon{
    min-height:375px;
    position:absolute;
    z-index:100;
    top:0;
    left:0;
    right:-110%;
    background-color:#efefef;
    -webkit-border-radius:2px;
    border-radius:2px;
    border:1px solid #ccc;
    -webkit-box-shadow:0 5px 25px rgba(0,0,0,.2);
    box-shadow:0 5px 25px rgba(0,0,0,.2);
    display:none;
    max-width:1140px
}
.address_list .address:nth-child(even) .ship_edit_icon{
    left:-110%;
    right:0
}
.address_list .address .ship_edit_icon{
    display:block;
    -webkit-transform:rotateY(-180deg) scale(.3,.8);
    -moz-transform:rotateY(-180deg) scale(.3,.8);
    -o-transform:rotateY(-180deg) scale(.3,.8);
    -ms-transform:rotateY(-180deg) scale(.3,.8);
    transform:rotateY(-180deg) scale(.3,.8);
    -webkit-backface-visibility:hidden;
    -moz-backface-visibility:hidden;
    -ms-backface-visibility:hidden;
    backface-visibility:hidden;
    opacity:0;
    filter:alpha(opacity=0);
    -ms-filter:"alpha(Opacity=0)";
    -webkit-transition:all .4s linear;
    -moz-transition:all .4s linear;
    -o-transition:all .4s linear;
    -ms-transition:all .4s linear;
    transition:all .4s linear
}
.address_list .address.ship_edit .ship_edit_icon{
    opacity:1;
    -ms-filter:none;
    filter:none;
    -webkit-transform:rotateY(0) scale(1);
    -moz-transform:rotateY(0) scale(1);
    -o-transform:rotateY(0) scale(1);
    -ms-transform:rotateY(0) scale(1);
    transform:rotateY(0) scale(1)
}
.address_list .ship_edit_icon{
    padding:30px
}
.address_list .ship_edit_icon h3{
    color:#3a3a3a;
    font-size:24px;
    font-family:'proxima_nova_rgregular'
}
.address_list .ship_edit_iconinner{
    width:100%;
    display:inline-block;
    padding-left:0
}
.address_list .ship_edit_iconinner label{
    display:block;
    font:13px "proxima_novasemibold";
    margin-bottom:5px;
    text-transform:uppercase
}
.ship_edit_iconinner .require{
    color:red
}
.address_list .ship_edit_iconinner li{
    float:left;
    width:25%;
    box-sizing:border-box;
    padding-right:1%;
    margin-bottom:0
}
.address_list .ship_edit_iconinner li:last-child{
    padding-right:0
}
.address_list .ship_icon_left_one{
    width:48%;
    float:left
}
.address_list .ship_icon_left_two{
    float:right;
    width:48%
}
.address_list .shipping_address{
    width:100% !important
}
.shipping_address .form-field .help-block{
    color:red;
    display:inline-block;
    font-size:14px;
    text-align:right;
    width:100%
}
.form_delete{
    width:100%;
    display:inline-block
}
.form_delete_inner{
    margin:25px 0 0 0
}
.form_delete .form_delete_left{
    float:left
}
.form_delete .form_delete_left i{
    padding-right:10px;
    color:
}
.form_delete .form_delete_left span{
    color:#787878;
    font-family:'proxima_novasemibold';
    text-transform:uppercase
}
.form_delete .form_deleteright{
    float:right
}
.wallet-credits{
    border:1px solid #eee;
    margin-bottom:15px;
    border:1px solid #eee
}
.wallet-credits h4{
    border-bottom:1px solid #cdcdcd;
    margin-bottom:0;
    padding:20px 115px 20px 25px;
    position:relative
}
.wallet-credits h4 p{
    margin:0;
    position:absolute;
    right:20px;
    top:12px;
    line-height:normal;
    text-align:right
}
.wallet-credits h4 p .price, .wallet-credits-inner .check-part-credits .price{
    color:#fe9b1a;
    text-transform:uppercase;
    font-size:20px;
    font-family:'proxima_nova_rgbold'
}
.wallet-credits h4 p .small-text, .wallet-credits-inner .check-part-credits .small-text{
    font-size:12px;
    color:#777;
    display:block
}
.wallet-credits-inner{
    padding:23px
}
.wallet-credits-inner ul{
    padding:0px
}
.wallet-credits-inner ul:after{
    clear:both;
    display:block;
    content:''
}
.wallet-credits-inner ul>li{
    margin-bottom:17px
}
.wallet-credits-inner ul li{
    list-style:none;
    position:relative
}
.wallet-credits-inner .check-part{
    position:relative
}
.wallet-credits-inner .check-part-credits{
    text-align:right
}
.wallet-credits-inner .submitwallet{
    background:#fe9b1a;
    color:#fff;
    padding:12px 15px;
    font-family:'proxima_novasemibold';
    font-size:16px;
    text-transform:uppercase;
    display:block;
    text-align:center;
    border-radius:3px;
    -webkit-border-radius:3px;
    width:140px;
    height:40px;
    cursor:pointer;
    letter-spacing:1px
}
.wallet-credits-inner .submitwallet:hover{
    background:#004282
}
.wallet-credits-inner .wallet_submit_section{
    width:140px;
    min-height:40px;
    float:right;
    text-align:center
}
.wallet-credits-inner .wallet_submit_section .loading{
    margin:0
}
.wallet-credits-inner ul.limit-adjust{
    padding:0 0 0 40px;
    font-size:15px;
    margin-bottom:10px
}
.wallet-credits-inner ul.limit-adjust li .yellow{
    color:#f39125;
    margin-bottom:10px
}
.wallet-credits .checkbox{
    display:inline-block;
    cursor:pointer;
    padding-left:38px;
    min-height:25px;
    color:#3b3b3b;
    font-family:'proxima_nova_rgbold';
    padding-top:4px
}
.wallet-credits input[type=checkbox]{
    display:none
}
.wallet-credits .checkbox:before{
    content:"";
    width:25px;
    height:25px;
    vertical-align:middle;
    text-align:center;
    box-shadow:none;
    border-radius:0;
    border:2px solid #cdcdcd;
    display:inline-block;
    position:absolute;
    left:0;
    top:0px
}
.wallet-credits input[type=checkbox]:checked+.checkbox:before{
    content:"\f00c";
    text-shadow:none;
    font-size:14px;
    color:#f39125;
    font-family:'FontAwesome';
    padding:3px
}
.payment_method_full .fa-info-circle{
    color:#999;
    bottom:2px;
    position:relative
}
.payment_method_full h4{
    font:20px 'proxima_nova_rgbold';
    text-transform:none;
    color:#3b3b3b;
    position:relative
}
.payment_method_outer{
    width:48.5%
}
.payment_method{
    background:#eee
}
.payment_method h4{
    border-bottom:1px solid #cdcdcd;
    margin-bottom:0;
    padding:20px 25px 20px 80px
}
.payment_method h4:before{
    position:absolute;
    left:20px;
    top:19px;
    width:46px;
    height:36px;
    content:'';
    background:url(../media/full_sprite.png) no-repeat scroll -253px 0px transparent
}
.payment_method_outer,.order_summary{
    border-radius:3px;
    -webkit-border-radius:3px
}
.payment_method_inner{
    padding:20px
}
.payment_method_inner ul li .payment_description{
    line-height:20px;
    margin:15px 0 0 0;
    font-size:15px
}
.payment_method_inner ul{
    padding:0px
}
.payment_method_inner ul li{
    list-style:none;
    margin:0 0 15px
}
.payment_method_inner ul li input[type="radio"]{
    margin:5px 8px 5px 5px
}
.payment_method_inner ul li img{
    vertical-align:top
}
.payment_method_inner .field input[type=radio].css-radio:checked+label.css-label{
    background-image:url(/images/two-green.png);
    background-position:0 4px
}
.payment_method_inner ul>li>ul.evalet-inside{
    padding:0 0 0 40px;
    margin:10px 0 0 0
}
.payment_method_inner ul>li>ul.price-range{
    padding:0 0 0 40px;
    margin:5px 0 0 0
}
.payment_method_inner ul li .slider_partial p{
    line-height:normal;
    margin:5px 0 0 0
}
.payment_method_inner ul li .slider_partial p:after{
    clear:both;
    display:block;
    content:''
}
.payment_method_inner ul li .slider_partial p .avail_credit{
    float:left
}
.payment_method_inner ul li .slider_partial p .max_credit{
    float:right
}
.payment_method_inner ul li .slider_partial p .price, .payment_method_inner ul li .slider_partial p .display_amount{
    text-transform:uppercase;
    color:#fe9b1a
}
.payment_method_inner ul li .slider_partial #slider-range-max{
    margin:10px 0 0 8px
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
    border:1px solid #d7d7d7 !important;
    background:#f6f6f6 !important
}
.ui-widget.ui-widget-content{
    border:1px solid #d7d7d7 !important
}
.order_summary{
    width:48.5%;
    border:1px solid #eee
}
.order_summary h4{
    border-bottom:1px solid #cdcdcd;
    margin-bottom:0;
    padding:20px 25px
}
.order_sum_inner .order_item, .order_sum_inner .order_coupon{
    padding:20px
}
.order_sum_inner .order_item table{
    border:none;
    margin:0px
}
.order_sum_inner .order_item .order-total{
    padding:12px 0 0 0;
    border-top:1px solid #e3e3e3
}
.order_sum_inner .order_item .amount-to-pay{
    color:#3b3b3b;
    border-top:1px solid #e3e3e3;
    padding:17px 0 0 0
}
.order_sum_inner .order_item .amount-to-pay th, .order_sum_inner .order_item .amount-to-pay td{
    font-family:'proxima_nova_rgbold';
    font-size:16px;
    color:#3b3b3b;
    padding-bottom:0px
}
.order_sum_inner .order_item .amount-to-pay td{
    font-size:20px
}
.order_sum_inner .order_item table .yellow{
    color:#f39125
}
.order_sum_inner .order_item table th, .order_sum_inner .order_item table td{
    border:none;
    padding:0px 5px 10px 5px;
    text-transform:none;
    color:#787878;
    font-family:'proxima_nova_rgregular'
}
.order_sum_inner .order_item table td{
    text-align:right
}
.order_sum_inner .order_item table td.credits{
    color:#3b3b3b;
    font-family:'proxima_nova_rgbold'
}
.order_summary .order_sum_inner td.credit-part{
    border-top:1px solid #d9d9d9;
    padding-top:15px
}
.order_summary .order_sum_inner td.credit-part td, .order_summary .order_sum_inner td.credit-part th{
    padding:0px
}
.my_order_right .my_order_num{
    color:#FE9B1A
}
.my_order_list .my_order_right .my_ordnum td{
    color:#FE9B1A
}
.order_sum_inner .order_item .total_items{
    color:#3b3b3b;
    font-family:'proxima_nova_rgbold';
    line-height:normal;
    padding-left:5px
}
body.checkout .ui-widget.ui-widget-content{
    border:1px solid #d7d7d7 !important;
    font-size:14px;
    color:#777
}
.order_sum_inner .order_coupen{
    border-top:1px solid #d9d9d9;
    padding:23px
}
.order_sum_inner .order_coupen h6{
    font-family:'proxima_nova_rgbold';
    font-size:16px;
    color:#3b3b3b;
    text-transform:none;
    margin:0 0 15px
}
.order_sum_inner .order_coupen p{
    font-size:15px;
    margin-bottom:0px;
    line-height:normal
}
.order_sum_inner .order_coupen form{
    margin-bottom:25px;
    position:relative;
    padding-right:150px
}
.order_sum_inner .order_coupen .submit_section .clear{
    font-family:'proxima_novasemibold';
    font-size:13px;
    text-transform:uppercase;
    display:inline-block;
    margin-top:5px
}
.order_sum_inner .order_coupen input[type="text"]{
    margin-bottom:0;
    font-size:15px;
    border:2px solid #ccc
}
.order_sum_inner .order_coupen .submit_section{
    position:absolute;
    right:0;
    top:0;
    width:140px;
    min-height:40px;
    text-align:center
}
.order_sum_inner .order_coupen input[type="submit"]{
    border-radius:3px;
    -webkit-border-radius:3px;
    min-width:140px
}
.order_sum_inner .order_coupen form .coupon_error{
    position:absolute;
    color:#f00;
    left:0;
    top:-17px;
    font-size:14px
}
.order_sum_inner .order_total table{
    border:none;
    margin:0px
}
.order_sum_inner .order_total table th, .order_sum_inner .order_total table td{
    border:none;
    padding:5px 0;
    text-transform:none;
    font-family:'proxima_nova_rgbold'
}
.order_sum_inner .order_total table th{
    color:#3b3b3b
}
.order_sum_inner .order_total table td{
    color:#FE9B1A
}
.order_sum_inner .order_total table td{
    text-align:right;
    text-transform:uppercase
}
.thank_part{
    margin-bottom:35px
}
.thank_part .circle{
    width:70px;
    height:70px;
    text-align:center;
    margin:0 auto;
    background:#008001;
    color:#fff;
    display:inline-block;
    border-radius:50%;
    -webkit-border-radius:50%;
    line-height:70px;
    font-size:36px
}
.thank_part h2{
    color:#3b3b3b;
    font:40px 'proxima_novasemibold'
}
.thank_part .order_para{
    text-transform:uppercase;
    color:#3b3b3b;
    font-size:18px
}
.thank_part .order_no_title, .thank_part .order_no{
    font-family:'proxima_nova_rgbold'
}
.thank_part .order_no{
    color:#f90
}
.thank_part p:last-of-type{
    font-size:15px;
    margin-bottom:0
}
.thank_order_summary{
    border-top:1px solid #bbb;
    padding:23px 15px 24px 15px
}
.thank_order_sum_left{
}
.thank_order_sum_left h6{
    color:#3b3b3b;
    font:18px 'proxima_nova_rgbold';
    margin-bottom:0px
}
.thank_order_sum_left h6 span{
    font:15px 'proxima_nova_rgregular';
    color:#787878;
    text-transform:none
}
.thank_order_sum_right{
}
.thank_order_sum_right h6{
    font:16px 'proxima_nova_rgbold';
    color:#3a3a3a;
    text-transform:none;
    margin-bottom:0px
}
.thank_order_sum_right h6 span{
    color:#f90;
    font:17px 'proxima_nova_rgbold';
    text-transform:uppercase
}
.thank_order_sum_left,.thank_order_sum_right{
    width:50%
}
.thank_summary_table .res-table>table{
    border:1px solid #bbb
}
.thank_summary_table table{
    border:none;
    margin:0;
    font-size:15px
}
.thank_summary_table table th{
    font:16px 'proxima_novasemibold';
    color:#787878;
    text-transform:none;
    border-right:0;
    border-bottom:1px solid #bbb;
    padding:15px 15px 14px 15px
}
.thank_summary_table table td{
    border-right:0;
    border-bottom:1px solid #bbb;
    padding:25px 15px;
    position:relative
}
.thank_summary_table table td.mer_name{
    background:#e3e3e3;
    padding:10px 15px
}
.thank_summary_table table td.mer_name span{
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.thank_summary_table table td.pro_name .pro_pic{
    display:inline-block;
    width:70px;
    height:70px;
    overflow:hidden;
    position:absolute;
    left:15px;
    border:1px solid #ececec
}
.thank_summary_table table td.pro_name .pro_pic img{
    width:100%;
    height:100%;
    object-fit:contain
}
.thank_summary_table table td.pro_name .desc{
    color:#3b3b3b;
    line-height:24px;
    min-height:70px
}
.thank_summary_table table td.pro_name .merchant{
    line-height:normal;
    margin-bottom:5px
}
.thank_summary_table table td.pro_name .merchant strong{
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.thank_summary_table table td.pro_name .color, .thank_summary_table table td.pro_name .size, .thank_summary_table table td.pro_name .qty{
    display:inline-block;
    margin-right:7px
}
.thank_summary_table strong{
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.thank_summary_table table td.pro_name p:last-of-type{
    margin-bottom:0px
}
.thank_summary_table table td.pro_status{
}
.thank_summary_table table td.pro_status strong{
    display:block
}
.thank_summary_table table td.pro_name{
    width:57.32217573221757%;
    padding-left:110px
}
.thank_summary_table table td.pro_status{
    width:26.10878661087866%
}
.thank_summary_table table td.pro_amount{
    width:16.736401673640167%
}
.thank_summary_table table td.pro_amount strong{
    text-transform:uppercase
}
.thank_ship_add{
    margin-top:30px;
    padding:0 15px
}
.thank_ship_add_left{
}
.thank_ship_add_left h3{
    position:relative;
    font-size:21px;
    text-transform:inherit;
    color:#FE9B1A;
    padding-bottom:6px;
    margin-bottom:20px
}
.thank_ship_add_left h3:after{
    background:#787878;
    height:2px;
    width:50px;
    position:absolute;
    left:0;
    bottom:0;
    content:''
}
.thank_ship_add_right{
}
.thank_ship_add_right table{
    border:none;
    margin:0px
}
.thank_ship_add_right table th{
    padding-right:15px !important
}
.thank_ship_add_right table td{
}
.thank_ship_add_right table th, .thank_ship_add_right table td{
    border:none;
    padding:5px 0;
    text-transform:none;
    color:#787878;
    font-family:'proxima_nova_rgregular'
}
.thank_ship_add_right table td{
    text-align:right;
    font-family:'proxima_nova_rgbold';
    color:#3a3a3a
}
.thank_ship_add_right table td.total{
    color:#f90;
    text-transform:uppercase
}
.thank_ship_add_right table td.price{
    text-transform:uppercase
}
.thank_summary_table table td.inner_table{
    padding:20px 15px;
    background:#f5f5f5;
    border-bottom:0
}
.thank_summary_table table td.inner_table td{
    padding:0;
    border:0
}
.thank_summary_table table td.inner_table td p{
    margin:0
}
.shopping_listing_part{
    position:relative;
    padding-left:248px
}
.shopping_listing_full_part .breadcrumb{
    margin:35px 0
}
.shopping_listing_part .all_category{
    margin-top:0
}
.shopping_listing_part .all_category li{
    width:auto !important;
    height:auto !important
}
.initial_list{
    height:330px
}
.shop_list_accord .color-part{
    height:165px
}
.shop_list_accord .material-part{
    height:225px
}
.shopping_listing_full{
    background:#eee
}
.shopping_listing_left{
    background:#fff;
    padding:20px;
    border-radius:5px;
    -webkit-border-radius:5px;
    width:228px;
    position:absolute;
    left:0;
    top:0
}
.shopping_listing_left h3{
    font:19px 'proxima_novasemibold';
    color:#3a3a3a;
    position:relative;
    padding-bottom:12px;
    margin-bottom:20px
}
.shopping_listing_left h3:after{
    width:50px;
    height:3px;
    background:#da0001;
    position:absolute;
    left:0;
    bottom:0;
    content:''
}
.shopping_listing_left ul{
    padding:0
}
.shopping_listing_left ul li{
    list-style:none;
    display:block;
    height:inherit !important;
    width:100% !important;
    margin:0 0 12px !important;
    padding:0
}
.shopping_listing_left ul li:last-child{
    margin-bottom:0px !important
}
.shopping_listing_left ul li a{
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease;
    color:#4e4e4e;
    display:block
}
.shopping_listing_left ul li a:hover{
    color:#da0001
}
.shop_list_accord{
    margin-top:20px
}
.shop_list_accord .accordion-header{
    font:17px 'proxima_nova_rgbold';
    color:#3a3a3a;
    padding:0;
    background:transparent;
    text-transform:none;
    padding-left:20px;
    border-bottom:0;
    margin-bottom:12px
}
.shop_list_accord .accordion-header:after{
    right:inherit;
    left:0;
    top:0;
    content:"\f0da";
    color:#3a3a3a
}
.shop_list_accord .active-header:after{
    top:2px;
    transform:rotate(90deg);
    -webkit-transform:rotate(90deg)
}
.shop_list_accord .accordion-content{
    padding:0;
    margin:0 0 15px
}
.custom_check input[type=checkbox]{
    display:none
}
.custom_check .checkbox{
    display:block;
    cursor:pointer;
    line-height:normal;
    color:#4e4e4e;
    font-size:16px;
    margin-bottom:15px
}
.custom_check .checkbox:before{
    content:"";
    display:inline-block;
    width:20px;
    height:20px;
    vertical-align:middle;
    background-color:#fff;
    color:#f3f3f3;
    text-align:center;
    box-shadow:none;
    border-radius:0;
    border:2px solid #787878;
    margin-right;
    18px
}
.custom_check input[type=checkbox]:checked+.checkbox:before{
    content:"\f00c";
    text-shadow:none;
    font-size:12px;
    color:#fe9b1a;
    font-family:'FontAwesome';
    padding:2px
}
.custom_check .check{
    display:inline-block;
    vertical-align:middle;
    margin-left:10px
}
.shop_list_accord .color-part .check{
    width:40px;
    height:20px;
    background:#ccc
}
.shop_list_accord .color-part .check.color1{
    background:#f8f7e7
}
.shop_list_accord .color-part .check.color2{
    background:#000
}
.shop_list_accord .color-part .check.color3{
    background:#0080ff
}
.shop_list_accord .color-part .check.color4{
    background:#8d6468
}
.shop_list_accord .color-part .check.color5{
    background:#ffd700
}
.ok_but{
    background:#da0001;
    display:inline-block;
    color:#fff;
    padding:6px 19px 5px 19px;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.ok_but:hover{
    color:#fff;
    background:#2a2a2a
}
.shopping_listing_right{
}
.shopping_listing_full .pro-slide .pro-slide-img{
    height:auto;
    padding:20px
}
.shopping_listing_full .pro-slide .pro-slide-con{
    padding:0 15px 15px 15px
}
.shopping_listing_full .pro-slide .pro-slide-con .title{
    color:#787878;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.shopping_listing_full .pro-slide .pro-slide-con .title:hover{
    color:#da0001
}
.shopping_listing_full .pro-slide .pro-slide-con .review-part, .shopping_listing_full .pro-slide .pro-slide-con .price-part{
    width:50%
}
.shopping_listing_full .pro-slide .pro-slide-con p{
    margin-bottom:15px;
    font-size:16px
}
.shopping_listing_full ul li .review-part .reviews, .shopping_listing_full ul li .price-part .new-price{
    margin-top:4px
}
.main_shopping_cart{
    position:relative
}
.main_shopping_cart h4{
    font:21px 'proxima_nova_rgbold';
    color:#FE9B1A;
    text-transform:none;
    padding-right:170px
}
.main_shopping_cart h4 span{
    font:15px 'proxima_nova_rgregular';
    color:#787878
}
.main_shopping_cart .continue_link{
    font:17px 'proxima_nova_rgregular';
    color:#787878;
    position:absolute;
    right:0;
    top:0;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease;
    cursor:pointer
}
.main_shopping_cart .continue_link:hover{
    color:#fe9b1a
}
.main_shopping_cart a.delete-icon{
    display:inline-block;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.main_shopping_cart a.delete-icon:hover{
    opacity:0.5
}
.main_shopping_cart .button-part{
    clear:both;
    margin-top:15px
}
.main_shopping_cart .button-part .button{
    font:19px 'proxima_novaextrabold';
    background:#f39125;
    color:#fff;
    text-transform:uppercase;
    padding:11px 35px;
    border-radius:5px;
    -webkit-border-radius:5px;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    float:right
}
.main_shopping_cart .button-part .button:hover{
    background:#004282
}
.main_shopping_cart table{
    font-size:17px;
    border:1px solid #bbb;
    border-bottom:0
}
.main_shopping_cart table th{
    font:16px 'proxima_novasemibold';
    color:#787878;
    text-transform:none;
    border-right:0;
    padding:15px 15px 14px 15px;
    border-bottom:1px solid #bbb
}
.main_shopping_cart table td.mer_name{
    background:#e3e3e3;
    padding:10px 15px
}
.main_shopping_cart table td.mer_name span{
    color:#3a3a3a;
    font-family:'proxima_nova_rgbold'
}
.main_shopping_cart table td.pro_name{
    padding-left:105px;
    width:52%
}
.main_shopping_cart table td{
    border-right:0;
    padding:25px 15px;
    position:relative;
    border-bottom:1px solid #bbb
}
.main_shopping_cart table td.pro_name .pro_pic{
    display:inline-block;
    width:65px;
    height:65px;
    overflow:hidden;
    position:absolute;
    left:15px
}
.main_shopping_cart table td.pro_name .desc{
    color:#3b3b3b;
    line-height:27px;
    margin-bottom:15px;
    height:54px
}
.main_shopping_cart table td.pro_name p{
    margin-bottom:0px
}
.main_shopping_cart table td.pro_name .color img{
    max-width:25px;
    vertical-align:top
}
.main_shopping_cart table td.pro_name .color, .main_shopping_cart table td.pro_name .size, .main_shopping_cart table td.pro_name .qty{
    display:block;
    color:#3a3a3a;
    position:relative;
    line-height:normal;
    margin-bottom:10px
}
.main_shopping_cart table td.pro_name strong{
}
.main_shopping_cart table .inner_table{
    background:#f5f5f5
}
.main_shopping_cart table .inner_table table{
    margin:0;
    border:none;
    font-size:16px
}
.main_shopping_cart table .inner_table td{
    padding:0;
    border:none
}
.main_shopping_cart table td.qty{
    width:22%
}
.main_shopping_cart table td.qty .qty-txt{
    display:inline-block;
    vertical-align:middle;
    font-size:15px;
    color:#000;
    padding:0 5px
}
.main_shopping_cart table td.price{
    width:12%;
    color:#3a3a3a;
    font:17px 'proxima_nova_rgbold';
    text-transform:uppercase
}
.main_shopping_cart table td.delete{
    width:9%;
    text-align:center
}
.main_shopping_cart table td.ship_method{
    width:40%
}
.main_shopping_cart table td.ship_charge, .main_shopping_cart table td.ship_price{
    width:30%
}
.main_shopping_cart table td.ship_method p{
    margin-bottom:8px;
    line-height:normal
}
.main_shopping_cart table td.ship_method p:last-of-type{
    margin-bottom:0px
}
.main_shopping_cart table td.ship_method strong{
    font:16px 'proxima_nova_rgbold';
    color:#3a3a3a
}
.main_shopping_cart table td.ship_charge p{
    margin-bottom:5px;
    line-height:normal
}
.main_shopping_cart table td.ship_charge p:last-of-type{
    margin-bottom:0px
}
.main_shopping_cart table td.ship_charge strong, .main_shopping_cart table td.ship_charge p:last-of-type{
    font:16px 'proxima_nova_rgbold';
    color:#3a3a3a
}
.main_shopping_cart table td.ship_price{
    text-align:right
}
.main_shopping_cart table td.ship_price p{
    margin-bottom:0px;
    line-height:normal
}
.main_shopping_cart table td.ship_price strong{
    font:18px 'proxima_nova_rgbold';
    color:#FE9B1A;
    text-transform:uppercase
}
.buyer_production{
    position:relative;
    margin-top:20px;
    padding-left:250px;
    min-height:50px
}
.buyer_production .continue_link{
    right:inherit;
    left:0;
    top:25px
}
.buyer_production .removeall_link{
    left:0;
    top:0;
    position:absolute;
    margin-bottom:0;
    color:#ec1c49;
    transition:all 0.3s ease;
    -webkit-transition:all 0.3s ease;
    text-decoration:underline
}
.buyer_production .removeall_link:hover{
    color:#3a3a3a
}
.buyer_pro_left{
    position:relative;
    padding-left:43px;
    width:68.79432624113475%;
    padding-right:10px;
    display:none
}
.buyer_pro_left h6{
    font:17px 'proxima_nova_rgbold';
    color:#3a3a3a;
    text-transform:none;
    padding-top:6px;
    margin-bottom:16px
}
.buyer_pro_left h6:before{
    position:absolute;
    left:0;
    top:0;
    width:31px;
    height:36px;
    content:'';
    background:url(../media/full_sprite.png) no-repeat scroll -261px -49px transparent
}
.buyer_pro_left ul{
    padding:0px;
    font-size:15px
}
.buyer_pro_left ul li{
    list-style:none;
    position:relative;
    line-height:normal;
    margin-bottom:12px;
    padding-left:17px
}
.buyer_pro_left ul li:before{
    position:absolute;
    left:0;
    content:"\f0da";
    font-family:'FontAwesome'
}
.buyer_pro_left .learn_link{
    color:#ec1c49;
    text-decoration:underline;
    transition:all 0.2s ease;
    -webkit-transition:all 0.2s ease
}
.buyer_pro_left .learn_link:hover{
    color:#3a3a3a
}
.buyer_pro_right{
    width:31.20567375886525%;
    max-width:240px;
    padding-right:15px
}
.buyer_pro_right table{
    border:none;
    margin:0px;
    font-size:17px
}
.buyer_pro_right table th, .buyer_pro_right table td{
    border:none;
    padding:7px 0;
    text-transform:none;
    color:#787878;
    font-family:'proxima_nova_rgregular'
}
.buyer_pro_right table td{
    text-align:right;
    font-family:'proxima_novaextrabold';
    color:#3a3a3a;
    text-transform:uppercase
}
.merchant_message_popup h2{
    color:#333;
    font:36px 'proxima_novasemibold';
    text-transform:none;
    position:relative;
    padding-bottom:22px;
    margin-bottom:25px
}
.merchant_message_popup h2:after{
    width:100px;
    height:4px;
    background:#002482;
    position:absolute;
    left:0;
    bottom:0;
    content:''
}
.merchant_message_popup h6{
    background:#eee;
    padding:15px 30px;
    margin-bottom:0px
}
.merchant_message_popup form{
    padding:30px 0 0 30px
}
.merchant_message_popup .product_enquiry input[type="submit"]{
    font-size:18px
}
.shipping_profile{
}
.shipping_profile .my_acc_right{
    width:100% !important;
    padding:0;
    box-shadow:inherit
}
.shipping_profile .my_acc_right .help-block{
    color:#f00;
    display:inline-block;
    font-size:14px;
    text-align:right;
    width:100%
}
</style>

<!-- merchant part-->
<div class="inner-main">
	<div class="container">
		<!-- Select your Shipping Address -->
		<div class="ship_add_full">
			<div class="progress_bar">
				<ul>
					<li>
						<a href="javascript:void(0);">
							Profile
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/profile-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/profile-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li class="active">
						<a href="javascript:void(0);">
							Shipping address
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/ship-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/ship-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							Payment
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/payment-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/payment-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							completed
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/complete-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/complete-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="shipping_address my_acc_part">
			<div class="ship_add">
						<h3 class="txtc">Select your Shipping Address</h3>
						<input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>checkout/shipping">
						<?php if(!empty($form_error)) { 
							foreach($form_error as $formerror) {
								echo "<p class='error'>".$formerror."</p>";
							}
						}
						else if(!empty($error)) { 
							echo "<p class='error'>".$error."</p>";
						}
						?>
						<ul class="address_list">
							<?php
							$is_default = 0;
							if(!empty($shippingaddress)) { 
	
								foreach ($shippingaddress as $address) {
									if($address['is_default']==1) {
										$is_default = $address['address_id'];
									}

									?>
									<li class="address address_one edit  <?=($address['is_default']=='1')?'active':''?>" id="<?=$address['address_id']?>">
										<div class="address_one_inner">
											<h6 class="set_active" id="<?=$address['address_id']?>">
												<?=ucwords($address['first_name'].' '.$address['last_name'])?>
											</h6>
											<div class="three-icons">
													<a href="javascript:void(0);" class="delviery <?=($address['is_default']=='1')?'edit_icon delivery_icon':''?> " title="Set Default" id="<?=$address['address_id']?>"></a>
													<a href="javascript:void(0);" class="edit_icon edit_address"></a>
													<a href="javascript:void(0);" class="edit_icon delete_icon delete_address "id="<?=$address['address_id']?>" title="Delete"></a>
											</div>
											<div class="set_active description" id="<?=$address['address_id']?>">
											<?php /*
												# <?=$address['floor'].'-'.$address['unit'].' '.$address['building_name'].'<br />SINGAPORE '.$address['postal_code']*/?>
												# <?=$address['floor'].'-'.$address['unit'].' '.$address['building_name']?>
											</div>
										</div>
										<div class="ship_edit_icon">
										   <h3> Edit your delivery address</h3>
                                           <?php echo form_open(base_url(),array("class"=>"action_form update_form"));?>
										   <?php //echo "<pre>"; print_r($shippingaddress); exit; ?>
											<ul class="ship_edit_iconinner">
												<li>
													<div class="form-field">
                                                        <label>First Name</label>
                                                        <input type="text" maxlength="50" name="first_name" value="<?php echo $address['first_name']; ?>"  readonly class="required">
														<span class="help-block"></span>
													</div>
												</li>
												<li>
													<div class="form-field">
                                                        <label>Last Name</label>
                                                        <input type="text" maxlength="50" name="last_name" readonly value="<?php echo $address['last_name']; ?>" class="required">
														<span class="help-block"></span>
                                                        
													</div>
												</li>
												<li>
													<div class="form-field">
                                                        <label>Building Name</label>
                                                        <input type="text" maxlength="50" name="building_name" value="<?php echo $address['building_name']; ?>" class="">
														<span class="help-block"></span>
                                                        
														
													</div>
												</li>
												<li>
													<div class="form-field">
                                                        <label>Postal Code</label>
                                                        <input type="text" maxlength="50" name="postal_code" value="<?php echo $address['postal_code']; ?>" readonly class="required">
														<span class="help-block"></span>
                                                        
													</div>
												</li>
												<li>
												   <div class="ship_icon_left_one">
														<div class="form-field">
                                                            <label>floor</label>
                                                            <input type="text" maxlength="50" name="floor" value="<?php echo $address['floor']; ?>" class="required">
                                                            <span class="help-block"></span>
                                                            
															
														</div>
													</div>
													<div class="ship_icon_left_two">
														<div class="form-field">
                                                            <label>unit</label>
                                                            <input type="text" maxlength="50" name="unit" value="<?php echo $address['unit']; ?>" class="required">
                                                            <span class="help-block"></span>
                                                            
														</div>
													</div>
												</li>
												<li>
													<div class="form-field">
                                                        <label>Company Name</label>
                                                        <input type="text" maxlength="50" name="company_name" value="<?php echo $address['company_name']; ?>" class="required">
                                                        <span class="help-block"></span>
                                                          
													</div>
												</li>

												<li class="shipping_address">
													<div class="form-field">
                                                    <label>Special Info</label>
                                                        <textarea  name="special_info" class="required"><?php echo $address['special_info']; ?></textarea>
                                                        <span class="help-block"></span>
													</div>
												</li>
												<div class="form_delete">
													<div class="form_delete_inner">
														<div class="form_delete_left">
															<?php /*<span><i class="fa fa-angle-left"></i>Close</span>*/ ?>
														</div>
														<div class="form_deleteright">
															<input type="hidden" name="address_id" value="<?=$address['address_id']?>">
															<input type="hidden" name="action" value="update">
                                                            <input class="secure_key" name="secure_key" value="" type="textbox"/>
															<input value="save" type="submit">
														</div>
													</div>
												</div>
											</ul>
											<?php echo form_close();?>  
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
										</div>
									</li>

									<?php
								}
							}
							?>
							<li class="address add">

                            <?php echo form_open(base_url(),array("id"=>'shipping_form',"class"=>"action_form"));?>
								<div class="address_inner txtc">
									<span class="add_address">Add new delivery address</span>
								</div>
								<div class="address_form">
									<div class="delivery_address" >
										<div class="delivery_add_one" >
											<div class="delivery_add_left fl">
												<p class="title"><span class="count">1</span> Add a Delivery Address</p>
													<div class="form-field">
														<label>ENTER YOUR POSTAL CODE</label>
														<input type="text" name="addressSearch" id="addressSearch" class="required">
                                                        <span class="help-block"></span>
													</div>
													<div class="form-field required has-error">
														<label>BUILDING NAME (OPTIONAL)</label>
														<input type="text" maxlength="50" name="building_name" value="">
                                                        <span class="help-block"></span>
													</div>
													<div class="form-field required has-error">
														<div class="odd fl">
															<label>FLOOR <span class="required">*</span></label>
                                                            <input type="text" maxlength="50" name="floor" value="" class="required">
															
														</div>
														<div class="odd even fr required has-error">
															<label>UNIT</label>
                                                            <input type="text" maxlength="50" name="unit" value="" class="required">
															<span class="help-block"></span>
														</div>
														<div class="clear"></div>
													</div>
													<input type="button" value="Select This Address" id="address_next">
											</div>
											<div class="delivery_add_right fr">
												
											</div>
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
											<div class="clear"></div>
										</div>
										<div class="delivery_add_two" style="display:none;">
											<p class="title"><span class="count">2</span> Just a bit more</p>
											<p>We'll need your name to be able to address you for the delivery.</p>

												<div class="form-field-left fl">
													<div class="form-field">
                                                        <label>FIRST NAME <span class="require">*</span></label>
                                                        <input type="text" maxlength="50" name="first_name" value="" class="required">
														<span class="help-block"></span>
													</div>
													<div class="form-field">
														<label>LAST NAME <span class="require">*</span></label>
														<input type="text" maxlength="50" name="last_name" value="" class="required">
                                                        <span class="help-block"></span>
													</div>
													<div class="form-field">
														<label>COMPANY NAME (OPTIONAL)</label>
                                                        <input type="text" maxlength="50" name="company_name" value="" >
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-field-left form-field-right fr">
													<div class="form-field">
														<label>Address specific instructions (optional)<span class="require">*</span></label>
                                                        <textarea name="special_info"></textarea>
													</div>
												</div>
												<div class="form_change">
													<div class="form_change_inner">
														<div class="form_left">
															<span id="initial_address"><i class="fa fa-angle-left"></i>Change address</span>
														</div>
														<div class="form_right">
															<input type="submit" value="save" id="save_address">
															<input type="hidden" name="action" value="create">
														</div>
													</div>
												</div>
												<div class="clear"></div>
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
										</div>
									</div>
								</div>
								<?php echo form_close();?>  
							</li>
						</ul>

						<div class="clear"></div>
					</div>
					<div class="contact_info">
						<h3>Just for this Order <span>( We require this information )</span></h3>
						<?php echo form_open(base_url(),array("class"=>"action_form",'id'=>'common_shipping_form'));?>
							<input type="hidden" name="is_default" id="is_default" value="<?=$is_default?>">
							<div class="form-field">
								<div class="label_part fl">
									<label>Contact Number<span class="required">*</span></label>
								</div>
								<div class="input_part fl">
									<div class="input_part_left fl">
									<?php
									$contact_number = '';
									?>
                                        <input type="text" maxlength="50" name="contact_number" value="<?php echo $contact_number; ?>" placeholder='Enter Your Contact Number' class="required">
                                        <span class="help-block"></span>
									</div>
									<div class="input_part_right fr">
										<span class="sidetext"><span class="required">*</span>Just in case we need to call or sms you regarding the delivery</span>
									</div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="form-field">
								<div class="label_part fl">
									<label>Any Special Instructions?</label>
								</div>
								<div class="input_part fl">
									<div class="input_part_left fl">
										<?php $additional_info  = ''; ?>
                                        <textarea placeholder="Message" name="additional_info"><?php echo $additional_info; ?></textarea>             
									</div>
									<div class="input_part_right fr">
										<span class="sidetext">(Optional)</span>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<p class="txtc next_but" style="margin-bottom:0px;"><input type="submit" value="Next"></p>
                        <?php echo form_close();?>  
					</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/shipping.js"></script>