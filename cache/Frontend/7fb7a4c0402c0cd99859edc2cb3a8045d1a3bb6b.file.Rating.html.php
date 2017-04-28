<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:07
         compiled from ".\Modules\Rating\Frontend\Views\Helpers\Rating.html" */ ?>
<?php /*%%SmartyHeaderCode:1364358eaba6351b0b5-45289368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fb7a4c0402c0cd99859edc2cb3a8045d1a3bb6b' => 
    array (
      0 => '.\\Modules\\Rating\\Frontend\\Views\\Helpers\\Rating.html',
      1 => 1476455466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1364358eaba6351b0b5-45289368',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ratingForm' => 1,
    'ratings' => 1,
    'rating' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba635e3148_12666607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba635e3148_12666607')) {function content_58eaba635e3148_12666607($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?>

    
    <?php if ($_smarty_tpl->tpl_vars['ratingForm']->value) {?>

    <?php  $_smarty_tpl->tpl_vars['rating'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rating']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ratings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rating']->key => $_smarty_tpl->tpl_vars['rating']->value) {
$_smarty_tpl->tpl_vars['rating']->_loop = true;
?>

    <table style="width: 98%;">
        <tr><td><h3 class="active"><i class="fa fa-comment-o"></i>&nbsp;<?php echo smarty_modifier_tr('Comment');?>
</h3></td></tr>
        <tr><td><?php echo $_smarty_tpl->tpl_vars['rating']->value->getRateComponent()->Render();?>
</td></tr>
        <tr><td><p><strong><?php echo smarty_modifier_tr('Name');?>
: </strong><?php echo $_smarty_tpl->tpl_vars['rating']->value->getName();?>
</p></td></tr>
        <tr><td><p><strong><?php echo smarty_modifier_tr('Comment');?>
: </strong><?php echo nl2br($_smarty_tpl->tpl_vars['rating']->value->getComment());?>
</p></td></tr>
        <tr><td><p><strong><?php echo smarty_modifier_tr('Posted');?>
: </strong><?php echo $_smarty_tpl->tpl_vars['rating']->value->getRateDateTime();?>
</p></td></tr>
        <br/>

    </table>
    <hr>
    <?php } ?>

    <div>
         <h5 class="fw_medium m_bottom_15"><i class="fa fa-comment"></i>&nbsp;<?php echo smarty_modifier_tr('Add comment');?>
</h5><br/>
        <?php echo $_smarty_tpl->tpl_vars['ratingForm']->value->Render();?>

    </div>
    <br />
    <?php }?>
    

<?php }} ?>
