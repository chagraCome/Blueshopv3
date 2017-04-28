<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:08
         compiled from "Design\Frontend\Hide1\menu_top.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2711058eaba641c2ab0-56742532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '956bc82ca92d5747b79c4e84f5200b6aef2bbfaf' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\menu_top.tpl.html',
      1 => 1476455446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2711058eaba641c2ab0-56742532',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'parent' => 0,
    'child' => 0,
    'subchild' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba642c0452_70025586',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba642c0452_70025586')) {function content_58eaba642c0452_70025586($_smarty_tpl) {?><div class="main-menu-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="main-menu">
                    
                    <nav role="navigation">
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['parent']->_loop = false;
 $_from = Modules_Cms_Frontend_Boot::getMegaMenuContainer(1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value) {
$_smarty_tpl->tpl_vars['parent']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['parent']->value->hasChildrens()) {?>

                            <li> <a href="<?php echo $_smarty_tpl->tpl_vars['parent']->value->getLink();?>
" <?php if ($_smarty_tpl->tpl_vars['parent']->value->getTarget()=='blank') {?>target="__blank"<?php }?>>
                                    <b><?php echo $_smarty_tpl->tpl_vars['parent']->value->getTitle();?>
</b></a>
                                <!--sub menu-->
                                <?php if ($_smarty_tpl->tpl_vars['parent']->value->hasChildrens()) {?>
                                <div class="mega-menu">
                                <div class="single-mega-menu">
                                    <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['parent']->value->getChildrens(1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->_loop = true;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['child']->value&&$_smarty_tpl->tpl_vars['child']->value->hasChildrens()) {?>
                                     
                                    <b><h3 class="hedding-border"><a href="<?php echo $_smarty_tpl->tpl_vars['child']->value->getLink();?>
" ><?php echo $_smarty_tpl->tpl_vars['child']->value->getTitle();?>
</a></h3></b>
                                            <?php  $_smarty_tpl->tpl_vars['subchild'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subchild']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child']->value->getChildrens(1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subchild']->key => $_smarty_tpl->tpl_vars['subchild']->value) {
$_smarty_tpl->tpl_vars['subchild']->_loop = true;
?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['subchild']->value->getLink();?>
" <?php if ($_smarty_tpl->tpl_vars['subchild']->value->getTarget()=='blank') {?>target="__blank"<?php }?>><span><?php echo $_smarty_tpl->tpl_vars['subchild']->value->getTitle();?>
</span></a></h3>
                                            
                                           
                                            <?php } ?>
                                    
                                    <?php } else { ?>
                                  
                                        <b> <a href="<?php echo $_smarty_tpl->tpl_vars['child']->value->getLink();?>
" <?php if ($_smarty_tpl->tpl_vars['child']->value->getTarget()=='blank') {?>target="__blank"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['child']->value->getTitle();?>
</a></b>
                                    
                                    <?php }?>
                                    <?php } ?>

                                </div>                                            </div> 

                                <?php }?>
                            </li>
                            <?php } else { ?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['parent']->value->getLink();?>
" <?php if ($_smarty_tpl->tpl_vars['parent']->value->getTarget()=='blank') {?>target="__blank"<?php }?>><b><?php echo $_smarty_tpl->tpl_vars['parent']->value->getTitle();?>
</b></a></li>
                            <?php }?>
                            <?php } ?>							

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN-MENU-AREA-END -->
<?php }} ?>
