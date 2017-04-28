<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 01:30:38
         compiled from "Design\Frontend\Hide1\homepage.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1383858eab60e6faf64-72678996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf5e50338c587414f9a1b14ae1a7b76cd8383916' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\homepage.tpl.html',
      1 => 1476455446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1383858eab60e6faf64-72678996',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'homePageContent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eab60e7baae3_54372368',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eab60e7baae3_54372368')) {function content_58eab60e7baae3_54372368($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['homePageContent']->value) {?>
<h2><?php echo $_smarty_tpl->tpl_vars['homePageContent']->value->getTitle();?>
</h2>
<div>
    <section>
        <p><?php echo $_smarty_tpl->tpl_vars['homePageContent']->value->getContent();?>
</p>
    </section>
</div>
<div style="clear:both;"></div>
<br/>
<br/>
<?php }?><?php }} ?>
