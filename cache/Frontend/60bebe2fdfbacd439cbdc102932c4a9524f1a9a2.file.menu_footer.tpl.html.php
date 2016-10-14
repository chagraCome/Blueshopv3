<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:29:51
         compiled from "Design\Frontend\Hide1\menu_footer.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:266065800cfbf079537-47977503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60bebe2fdfbacd439cbdc102932c4a9524f1a9a2' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\menu_footer.tpl.html',
      1 => 1475577517,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266065800cfbf079537-47977503',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'child' => 0,
    'current_lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cfbf1f4411_31232704',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cfbf1f4411_31232704')) {function content_5800cfbf1f4411_31232704($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = Modules_Cms_Frontend_Boot::getMegaMenuContainer(6); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
<div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30">
    <h3 class="color_light_2 m_bottom_20"><a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value->getLink();?>
" <?php if ($_smarty_tpl->tpl_vars['menu']->value->getTarget()=='blank') {?>target="__blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['menu']->value->getTitle();?>
</a></h3>
    <?php if ($_smarty_tpl->tpl_vars['menu']->value->hasChildrens()) {?>
    <ul class="vertical_list">
        <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value->getChildrens(1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->_loop = true;
?>
        <li><a class="color_light tr_delay_hover" <?php if ($_smarty_tpl->tpl_vars['child']->value->getTarget()=='blank') {?>target="__blank"<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['child']->value->getLink();?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value->getTitle();?>
<?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?><i class="fa fa-angle-left"></i><?php } else { ?><i class="fa fa-angle-right"></i><?php }?></a></li>
        <?php } ?>
    </ul>
    <?php }?>
</div>
<?php } ?>
<?php }} ?>
