<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:10
         compiled from ".\Modules\Product\Frontend\Views\Helper\Grouped.html" */ ?>
<?php /*%%SmartyHeaderCode:70758eaba66a1c3b8-66174028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9805167d79716f7e7b2ba15bd6b46537fba6cc5' => 
    array (
      0 => '.\\Modules\\Product\\Frontend\\Views\\Helper\\Grouped.html',
      1 => 1476455463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70758eaba66a1c3b8-66174028',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'groupedProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba66a9c770_38056338',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba66a9c770_38056338')) {function content_58eaba66a9c770_38056338($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
if (!is_callable('smarty_modifier_price')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.price.php';
?><?php if ($_smarty_tpl->tpl_vars['product']->value->isGrouped()) {?>
<figure class="r_corners photoframe tr_all_hover type_2 shadow relative clearfix">
    <div  style="padding: 0px; min-height: 30px">
         <h2 class="tt_uppercase color_dark m_bottom_30"><?php echo smarty_modifier_tr('Products included in the offer');?>
</h2>
        <div class="amh-container">
            <?php  $_smarty_tpl->tpl_vars['groupedProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['groupedProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value->getGroupedProducts(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['groupedProduct']->key => $_smarty_tpl->tpl_vars['groupedProduct']->value) {
$_smarty_tpl->tpl_vars['groupedProduct']->_loop = true;
?>
            <div class="amh-1_5">
                <img class="amh-full-width-rp" style="width: 100%;  box-shadow: 0px 0px 0px #989898;"  
                src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['groupedProduct']->value->getFirstBig())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" height="120"  alt="<?php echo $_smarty_tpl->tpl_vars['groupedProduct']->value->title;?>
" />
            </div>
            <div class="amh-4_5 amh-right">
                <h2 class="color_dark fw_medium m_bottom_10" style="font-size: 18px;"><?php echo $_smarty_tpl->tpl_vars['groupedProduct']->value->getTitle();?>
</h2>
                <p>
                <?php echo $_smarty_tpl->tpl_vars['groupedProduct']->value->getShortDesc(150);?>

                </p> 
                <div class="product_price"><?php echo smarty_modifier_tr('This product is also included in the offer,');?>
&nbsp;<?php echo smarty_modifier_tr('his unit price is');?>
: 
                <span style="color:red; font-weight: bold;"><?php echo smarty_modifier_price($_smarty_tpl->tpl_vars['groupedProduct']->value->getSalePrice());?>
<span></div>
            </div>
               <br/>
    <div style="clear:both"></div>
    <br/>
    <hr/><br/>
    <?php } ?>
    </div>
 </div>
   </figure>
 <?php }?><?php }} ?>
