<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 01:30:45
         compiled from "Design\Frontend\Hide1\mainpage-newproducts.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1018158eab61582a206-61444602%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f1d2cb518aef9eb00bead2a62258034da16501f' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\mainpage-newproducts.tpl.html',
      1 => 1476455446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1018158eab61582a206-61444602',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newproducts' => 0,
    'new_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eab615852e01_75346438',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eab615852e01_75346438')) {function content_58eab615852e01_75346438($_smarty_tpl) {?><!-- FEATURED-TAB-START -->
<div class="tab-pane fade" id="featured">
    <div class="product-carusul-9">
       <?php if (!isset($_smarty_tpl->tpl_vars['new_product'])) $_smarty_tpl->tpl_vars['new_product'] = new Smarty_Variable(null);while ($_smarty_tpl->tpl_vars['new_product']->value = $_smarty_tpl->tpl_vars['newproducts']->value->fetch()) {?>
    <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Item.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item'=>$_smarty_tpl->tpl_vars['new_product']->value), 0);?>

    <?php }?>
    </div>
</div><?php }} ?>
