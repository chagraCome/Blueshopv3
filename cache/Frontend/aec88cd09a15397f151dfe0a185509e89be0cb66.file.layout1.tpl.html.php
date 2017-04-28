<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:08
         compiled from "Design\Frontend\Hide1\Layout\layout1.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2333558eaba646aba33-39503415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aec88cd09a15397f151dfe0a185509e89be0cb66' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\Layout\\layout1.tpl.html',
      1 => 1476455445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2333558eaba646aba33-39503415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainblockstop' => 0,
    'block' => 0,
    'mainblocks' => 0,
    'mainblocksbottom' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba64727f88_68395479',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba64727f88_68395479')) {function content_58eaba64727f88_68395479($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mainblockstop']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['block']->value->Render();?>

<?php } ?>
<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mainblocks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['block']->value->Render();?>

<?php } ?>
<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mainblocksbottom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['block']->value->Render();?>

<?php } ?><?php }} ?>
