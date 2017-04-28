<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:08
         compiled from ".\Design\Frontend\Hide1\Modules\Product\Frontend\Views\Detail.html" */ ?>
<?php /*%%SmartyHeaderCode:2504458eaba6482b5e2-27607963%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adf5e465197ecd36b773baf59d94f9ede0f0fc15' => 
    array (
      0 => '.\\Design\\Frontend\\Hide1\\Modules\\Product\\Frontend\\Views\\Detail.html',
      1 => 1476455446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2504458eaba6482b5e2-27607963',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'skin_path' => 0,
    'current_lang' => 0,
    'product' => 0,
    'root' => 0,
    'img' => 0,
    'attribute' => 0,
    'attrs' => 0,
    'rate' => 0,
    'bookmark' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba64c16716_48414552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba64c16716_48414552')) {function content_58eaba64c16716_48414552($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_price')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.price.php';
?><link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<link href="Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.css" rel="stylesheet" type="text/css" />
<!-- JS -->

<!-- jquery js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/vendor/jquery-1.11.3.min.js"></script>

<!-- bootstrap js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/bootstrap.min.js"></script>

<!-- owl.carousel.min js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/owl.carousel.min.js"></script>

<!-- meanmenu js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.meanmenu.js"></script>

<!--jquery-ImageZoom js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.simpleLens.min.js"></script>

<!--jquery-ui.min js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery-ui.min.js"></script>

<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js"></script>

<!-- jquery.countdown js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.countdown.min.js"></script>

<!-- jquery.collapse js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.collapse.js"></script>

<!-- jquery.easing js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.easing.1.3.min.js"></script>	

<!-- jquery.scrollUp js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.scrollUp.min.js"></script>	

<!-- knob circle js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.knob.js"></script>	

<!-- jquery.appear js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.appear.js"></script>			

<!-- jquery.counterup js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.counterup.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/waypoints.min.js"></script>		

<!-- wow js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/wow.js"></script>		
<script>
    new WOW().init();
</script>

<!-- rs-plugin js -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/rs.home.js"></script>

<!-- plugins js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/plugins.js"></script>

<!-- main js -->
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/main.js"></script>
<?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='en') {?>
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/elevatezoom.min.js"></script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?>
<script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/elevatezoom_ar.min.js"></script>
<?php }?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="breadcrumbs">
                <ul>
                    <li>  <a href="index.php" class="default_t_color"><i class="fa fa-home"></i>&nbsp;<?php echo smarty_modifier_tr('Home');?>
</a></li>
                    <?php  $_smarty_tpl->tpl_vars['root'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['root']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value->getPathRoot(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['root']->key => $_smarty_tpl->tpl_vars['root']->value) {
$_smarty_tpl->tpl_vars['root']->_loop = true;
?>  
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['root']->value['link'];?>
" class="default_t_color">&nbsp; <?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?><i class="fa fa-angle-double-left "></i><?php } else { ?><i class="fa fa-angle-double-right "></i><?php }?>&nbsp;&nbsp;<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['root']->value['name'],300,"...");?>
</a> </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- PRODUCT-VIEW-AREA-START -->
<div class="product-view-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
                <div class="product-image-tab">

                    <div class="larg-img">
                        <div class="tab-content">
                            <div id="image1" class="tab-pane fade in active">

                                <?php if ($_smarty_tpl->tpl_vars['product']->value->isOffered()) {?>
                                <?php if ($_smarty_tpl->tpl_vars['product']->value->getPercentSaveAmount()>0) {?>
                                <span class="hot_stripe"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/sale_product.png" alt=""></span>       
                                <?php }?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value->is_new) {?>
                                <span class="hot_stripe"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/hot_product.png" alt=""></span>
                                <?php }?>
                                <div class="simpleLens-big-image-container">
                                    <img id="zoom_image" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getFirstBig())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" data-zoom-image="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getFirstBig())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" class="simpleLens-big-image" alt="">
                                    <a href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getFirstBig())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" class="simpleLens-lens-image">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>

                            </div>
                            <!----autre-->
                            <ul class="qv_carousel_single d_inline_middle">
                                <?php if (count($_smarty_tpl->tpl_vars['product']->value->images)>0) {?>
                                <?php  $_smarty_tpl->tpl_vars['img'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['img']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value->images; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['img']->key => $_smarty_tpl->tpl_vars['img']->value) {
$_smarty_tpl->tpl_vars['img']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['img']->key;
?>
                                <a href="#" data-image="<?php echo $_smarty_tpl->tpl_vars['img']->value->getThumb();?>
" data-zoom-image="<?php echo $_smarty_tpl->tpl_vars['img']->value->getThumb();?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['img']->value->getThumb();?>
" alt="" style="width: 100px;height: 100px;">
                                </a>
                                <?php } ?>
                                <?php }?>
                            </ul>
                            <!--end-->



                        </div>




                    </div>

                </div>
            </div>


            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
                <div class="product-details-area">
                    <h2 class="product-name"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value->getTitle(),110,"...");?>
</h2>
                    <div class="price-box">
                        <span class="special-price"><?php echo smarty_modifier_tr('Price');?>
: <?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['product']->value->getSalePrice());?>
</span>

                    </div>
                    <div class="ratings-links-area">

                        <!------->


                        <table class="product-options">
                            <tr>
                                <td><?php echo smarty_modifier_tr('Product Number');?>
:</td>
                                <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getNumber())===null||$tmp==='' ? 'N/A' : $tmp);?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_modifier_tr('Category');?>
:</td>
                                <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getCategory())===null||$tmp==='' ? 'N/A' : $tmp);?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_modifier_tr('Availability');?>
:</td>
                                <td><?php if ($_smarty_tpl->tpl_vars['product']->value->getQuantity()>0) {?><span class="color_green"><?php echo smarty_modifier_tr('In stock');?>
 </span>  <?php } else { ?> <span class="color_red"> <?php echo smarty_modifier_tr('Not available');?>
 </span>  <?php }?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value->getQuantity())===null||$tmp==='' ? '0' : $tmp);?>
 <?php echo smarty_modifier_tr('item(s)');?>
</td>
                            </tr>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value->getEntitySet()->getGeneralAttributes()) {?>
                            <?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value->getEntitySet()->getGeneralAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['attribute']->value->getLabel();?>
:</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['attribute']->value->getFrontEndComponent($_smarty_tpl->tpl_vars['product']->value);?>
</td>
                                </br>
                            </tr>
                            <?php } ?>
                            <?php }?>
                        </table>

                        <?php if ($_smarty_tpl->tpl_vars['attrs']->value) {?>
                        <div class="product-options">

                            <ul>

                                <li class="options-title" style="min-width: 307px;line-height: initial;">
                                    <p><?php echo $_smarty_tpl->tpl_vars['attrs']->value;?>
</p>

                                </li>

                            </ul>


                        </div>
                        <?php }?>

                        <!---->

                    </div>

                    <div class="price-box">
                        <span class="special-price"><?php echo smarty_modifier_tr('Price');?>
: <?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['product']->value->getSalePrice());?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value->isOffered()) {?>
                        <span class="price_offer"> <?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['product']->value->getPrice());?>
</span><br /><span class="product_price_big_date"><?php echo smarty_modifier_tr('From');?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->getSpecialPriceDateFrom();?>
 <?php echo smarty_modifier_tr('To');?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->getSpecialPriceDateTo();?>
</span>     
                        <?php }?>
                    </div>

                    <div class="add-to-cart">
                        <input type="number" value="1">
                        <button type="submit" name="addtocart" id="add_to_cart">
                            <i class="fa fa-shopping-cart"></i><?php echo smarty_modifier_tr('Add to cart');?>
</button>
                    </div>
                    <div class="add-to-box">
                        <ul>
                            <li><a href="index.php?module=product&amp;page=whishlist&amp;id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><i class="fa fa-heart"></i><?php echo smarty_modifier_tr('Wishlist');?>
</a></li> 
                            <li><a href="index.php?module=product&page=compare&id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><i class="fa fa-random"></i><?php echo smarty_modifier_tr('Compare');?>
</a></li> 

                        </ul>
                    </div>
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['product']->value->hasPriceTable()) {?>
            <p>&nbsp;</p>
            <table  class="product_table_price">
                <tr class="silver_odd">
                    <th><?php echo smarty_modifier_tr('Quantity');?>
</th>
                    <th><?php echo smarty_modifier_tr('Unit Price');?>
</th>
                    <th><?php echo smarty_modifier_tr('Save');?>
</th>
                </tr>
                <?php  $_smarty_tpl->tpl_vars['rate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rate']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value->getPriceTable(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rate']->key => $_smarty_tpl->tpl_vars['rate']->value) {
$_smarty_tpl->tpl_vars['rate']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['rate']->value->table_quantity;?>
</td>
                    <td><?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['rate']->value->table_price);?>
</td>
                    <td><strong><?php echo ceil(100-$_smarty_tpl->tpl_vars['rate']->value->table_price/$_smarty_tpl->tpl_vars['product']->value->getSalePrice()*100);?>
 %</strong></td>
                </tr>  
                <?php } ?>
            </table>
            <?php }?>

            <div class="d_inline_middle m_left_5 addthis_widget_container">
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                    <table>
                        <td class="menu_horiz_list">
                            <?php if ($_smarty_tpl->tpl_vars['bookmark']->value==1) {?><li><a href="index.php?module=product&amp;page=detail&amp;event=bookmark&amp;id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><i class="fa fa-bookmark"></i>&nbsp;<?php echo smarty_modifier_tr('Delete bookmark');?>
</a></tr>
                            <?php } else { ?><li><a href="index.php?module=product&amp;page=whishlist&amp;id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" ><i class="fa fa-bookmark"></i> &nbsp;<?php echo smarty_modifier_tr('Add bookmark');?>
</a></tr><?php }?>
                        <tr ><a href="javascript:popup('index.php?module=product&amp;page=detail&amp;event=print&amp;id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
', 860, 640);"  ><i class="fa fa-print"></i>&nbsp;<?php echo smarty_modifier_tr('Print');?>
</a></tr>
                        <tr><a href="index.php?module=product&amp;page=sendtofriend&amp;id=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" ><i class="fa fa-send"></i>&nbsp;<?php echo smarty_modifier_tr('Send to friend');?>
</a></tr>
                        <tr><a href="http://www.facebook.com/share.php?u=http://<?php echo rawurlencode($_SERVER['HTTP_HOST']);?>
<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
" target="_blank"><i class="fa fa-facebook"></i>&nbsp;<?php echo smarty_modifier_tr('Add to Facebook');?>
</a></tr>
                        <tr><a href="http://twitter.com/share?url=http://<?php echo rawurlencode($_SERVER['HTTP_HOST']);?>
<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
"  target="_blank"><i class="fa fa-twitter"></i>&nbsp;<?php echo smarty_modifier_tr('Add to Twitter');?>
</a></tr>
                        </td>
                    </table>
                </div>
                <!-- AddThis Button END -->
            </div>
        </div>
    </div>
    <!-- PRODUCT-VIEW-AREA-START -->
    <div class="product-overview-tab">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="tab-menu-area">
                        <ul>
                            <li class="active">
                                <a data-toggle="tab" href="#description"><?php echo smarty_modifier_tr('Description');?>
</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#CommentandRating"><?php echo smarty_modifier_tr('Comment and Rating');?>
</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="description" class="tab-pane fade in active">
                            <h2>Description</h2>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value->getDescription()) {?>
                            <p><?php echo $_smarty_tpl->tpl_vars['product']->value->getDescription();?>
</p>
                            <?php }?>
                        </div>
                        <div id="CommentandRating" class="tab-pane fade">

                            <h2>Comment and Rating</h2>
                            <?php echo Modules_Rating_Frontend_Boot::getRating('Product_Product_Model',$_smarty_tpl->tpl_vars['product']->value->id,'Modules/Rating/Frontend/Views/Helpers/Rating.html');?>




                        </div>

                    </div>
                </div>
            </div>


            <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Helper/Related.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Helper/Grouped.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <!-- PRODUCT-VIEW-AREA-START -->
        </div>

    </div><?php }} ?>
