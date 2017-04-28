<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:09
         compiled from ".\Modules\Product\Frontend\Views\Helper\Related.html" */ ?>
<?php /*%%SmartyHeaderCode:2854158eaba650b8878-77019229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8db5c69f81c82b70c6db33f1baa8b959c3a6a857' => 
    array (
      0 => '.\\Modules\\Product\\Frontend\\Views\\Helper\\Related.html',
      1 => 1476455463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2854158eaba650b8878-77019229',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'current_lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba651b2051_04159057',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba651b2051_04159057')) {function content_58eaba651b2051_04159057($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><?php if ($_smarty_tpl->tpl_vars['product']->value->getRelatedProducts()) {?>
<div class="clearfix">
    <h2 class="color_dark tt_uppercase f_left m_bottom_15 f_mxs_none"><?php echo smarty_modifier_tr('Related Products');?>
</h2>
    <div class="f_right clearfix nav_buttons_wrap f_mxs_none m_mxs_bottom_5">

        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners rp_prev"><?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?><i class="fa fa-angle-right"></i><?php } else { ?><i class="fa fa-angle-left"></i><?php }?></button>

        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners rp_next"><?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?><i class="fa fa-angle-left"></i><?php } else { ?><i class="fa fa-angle-right"></i><?php }?></button>
    </div>
</div>
<div class="related_projects m_bottom_15 m_sm_bottom_0 m_xs_bottom_15">
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value->getRelatedProducts(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Item3.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } ?>
</div>
<hr class="divider_type_3 m_bottom_15">
<?php }?><?php }} ?>
