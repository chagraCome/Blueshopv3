<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:25:16
         compiled from "Design\Frontend\Hide1\mainpage-latestproducts.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:180855800ceac76bd44-93671072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb8f195f25f889e9a85a07bf7eedc2a78996e4e2' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\mainpage-latestproducts.tpl.html',
      1 => 1475836196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180855800ceac76bd44-93671072',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'latestproducts' => 0,
    'lastedProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800ceac879609_51278429',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800ceac879609_51278429')) {function content_5800ceac879609_51278429($_smarty_tpl) {?>

<div class="tab-pane fade  in active" id="latest">
    <div class="product-carusul-9">

        <?php if (!isset($_smarty_tpl->tpl_vars['lastedProduct'])) $_smarty_tpl->tpl_vars['lastedProduct'] = new Smarty_Variable(null);while ($_smarty_tpl->tpl_vars['lastedProduct']->value = $_smarty_tpl->tpl_vars['latestproducts']->value->fetch()) {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Item.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item'=>$_smarty_tpl->tpl_vars['lastedProduct']->value), 0);?>

        <?php }?>

    </div>
</div>


<?php }} ?>
