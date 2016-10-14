<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:25:32
         compiled from "Design\Frontend\Hide1\mainpage-specialproducts.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:180565800cebc5d5395-03938090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3526d67166f63dfa768a8c604d628a426401ec6c' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\mainpage-specialproducts.tpl.html',
      1 => 1475834125,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180565800cebc5d5395-03938090',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'specialproducts' => 0,
    'specialProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cebc669ab0_70203519',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cebc669ab0_70203519')) {function content_5800cebc669ab0_70203519($_smarty_tpl) {?>
<div class="tab-pane fade" id="special">
    <div class="product-carusul-9">
      <?php if (!isset($_smarty_tpl->tpl_vars['specialProduct'])) $_smarty_tpl->tpl_vars['specialProduct'] = new Smarty_Variable(null);while ($_smarty_tpl->tpl_vars['specialProduct']->value = $_smarty_tpl->tpl_vars['specialproducts']->value->fetch()) {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Item.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item'=>$_smarty_tpl->tpl_vars['specialProduct']->value), 0);?>

        <?php }?>
    </div>
</div><?php }} ?>
