<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:25:18
         compiled from ".\Modules\Product\Frontend\Views\Item.html" */ ?>
<?php /*%%SmartyHeaderCode:26825800ceae535d68-43243662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5630c4bb9c551acdc1665152c93904e8dcd37dbb' => 
    array (
      0 => '.\\Modules\\Product\\Frontend\\Views\\Item.html',
      1 => 1475832906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26825800ceae535d68-43243662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'skin_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800ceaeab42b5_14341115',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800ceaeab42b5_14341115')) {function content_5800ceaeab42b5_14341115($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\modifier.truncate.php';
?><div class="col-lg-3 col-md-3">
<div class="single-product">

    <!--product preview-->
    <?php if ($_smarty_tpl->tpl_vars['item']->value->isOffered()) {?>
    <span><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/sale_product.png" alt="" style="width: auto;height: auto;"></span>
    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value->is_new) {?>
    <span><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/hot_product.png" alt="" style="width: auto;height: auto;"></span>
    <?php }?>
    <div >
        <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getUrl();?>
"> <img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value->getFirstThumb())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->getTitle();?>
"></a>
        <span data-popup="<?php echo $_smarty_tpl->tpl_vars['item']->value->getPreviewUrl();?>
">
            <a rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->getPreviewUrl();?>
" style="color: inherit;"> <?php echo smarty_modifier_tr('Quick View');?>
 </a>
        </span>
    </div>
    <!--description and price of product-->
    <div class="product-des">
        <h5 class="product-name">
            <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getUrl();?>
" class="color_dark"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->getTitle(),22,"...");?>
</a></h5>
    </div>
    <!-- add to cart -->
    <div class="action-button-15">
        <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inCart()) {?>ajax_add_to_cart_button <?php }?>product-btn cart-button" data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to cart');?>
">
            <?php if ($_smarty_tpl->tpl_vars['item']->value->inCart()) {?>

            <?php } else { ?>
            <div class="add-to-cart">
                <span><?php echo smarty_modifier_tr('Add to cart');?>
</span>
                <i class="fa fa-shopping-cart" style='display:none'></i>
            </div>
            <?php }?>


        </a>
        <!-- add to whishlist -->
        <div class="add-to-wishlist">
            <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inWhishlist()) {?>add_to_whishlist ajax_add_to_whishlist_button<?php }?> product-btn"  data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to Wishlist');?>
">
            </a>
        </div>
        <div class="compare-button">
            <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inCompare()) {?>add_to_compare  ajax_add_to_compare_button<?php }?> product-btn" data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to Compare');?>
">
            </a>
        </div>
    </div>
</div>

</div>
<?php }} ?>
