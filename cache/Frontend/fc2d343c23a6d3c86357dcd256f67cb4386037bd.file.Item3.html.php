<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:09
         compiled from ".\Modules\Product\Frontend\Views\Item3.html" */ ?>
<?php /*%%SmartyHeaderCode:1598658eaba65494746-36013240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc2d343c23a6d3c86357dcd256f67cb4386037bd' => 
    array (
      0 => '.\\Modules\\Product\\Frontend\\Views\\Item3.html',
      1 => 1476455463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1598658eaba65494746-36013240',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'skin_path' => 0,
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba65794090_45038544',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba65794090_45038544')) {function content_58eaba65794090_45038544($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_price')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.price.php';
?><figure class="r_corners photoframe shadow relative d_inline_b d_md_block d_xs_inline_b tr_all_hover">
    <?php if ($_smarty_tpl->tpl_vars['item']->value->isOffered()) {?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value->getPercentSaveAmount()>0) {?>
    <span class="hot_stripe type_2">
        <img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/sale_product_type_2.png" alt="" style="width: auto;height: auto;">
    </span>
    <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value->is_new) {?>
    <span class="hot_stripe type_2">
        <img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/images/hot_product_type_2.png" alt="" style="width: auto;height: auto;">
    </span>
    <?php }?>
    <div class="d_block relative wrapper pp_wrap">
        <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getUrl();?>
"> <img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value->getFirstThumb())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" class="tr_all_hover" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->getTitle();?>
"></a>
        <span data-popup="<?php echo $_smarty_tpl->tpl_vars['item']->value->getPreviewUrl();?>
" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">
            <a rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->getPreviewUrl();?>
" class="quick-view  hidden-xs" style="color: inherit;"> <?php echo smarty_modifier_tr('Quick View');?>
 </a>
        </span>
    </div>
    <!--description and price of product-->
    <figcaption class="t_xs_align_l">
        <h5 class="m_bottom_10">
            <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getUrl();?>
" class="color_dark ellipsis" style="display: block; width: 235px; white-space: nowrap;"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->getTitle(),28,"...");?>

            </a>
        </h5>
        <div class="clearfix">
            <p class="scheme_color f_left f_size_large m_bottom_15"><?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['product']->value->getSalePrice());?>
</p>
            <!--rating-->
        </div>
        <figcaption>
            <!-- add to cart -->
            <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inCart()) {?>ajax_add_to_cart_button <?php }?>product-btn cart-button" data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to cart');?>
">
                <?php if ($_smarty_tpl->tpl_vars['item']->value->inCart()) {?>
                <i class="fa fa-check"></i>
                <?php } else { ?>
                <span><?php echo smarty_modifier_tr('Add to cart');?>
</span>
                <i class="fa fa-check" style='display:none'></i>
                <?php }?>
                <i class="fa fa-times" style='display:none'></i>
                <i class="fa fa-circle-o-notch fa-spin" style='display:none'></i>
            </a>
            <!-- add to whishlist -->
            <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inWhishlist()) {?>add_to_whishlist ajax_add_to_whishlist_button<?php }?> product-btn"  data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to Wishlist');?>
">
                <i class="fa fa-check" style='display:none'></i>
                <i class="fa fa-heart-o"></i>
                <i class="fa fa-circle-o-notch fa-spin" style='display:none'></i>
            </a>
            <a class="<?php if (!$_smarty_tpl->tpl_vars['item']->value->inCompare()) {?>add_to_compare  ajax_add_to_compare_button<?php }?> product-btn" data-id-product="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
" title="<?php echo smarty_modifier_tr('Add to Compare');?>
">
                <i class="fa fa-check" style='display:none'></i>
                <i class="fa fa-copy"></i>
                <i class="fa fa-circle-o-notch fa-spin" style='display:none'></i>
            </a>
        </figcaption>
    </figcaption>

</figure><?php }} ?>
