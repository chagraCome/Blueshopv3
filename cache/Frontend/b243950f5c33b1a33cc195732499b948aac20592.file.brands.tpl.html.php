<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:25:32
         compiled from "Design\Frontend\Hide1\brands.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:102735800cebc6811c1-21131834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b243950f5c33b1a33cc195732499b948aac20592' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\brands.tpl.html',
      1 => 1476199512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102735800cebc6811c1-21131834',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'manufact' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cebc702066_75515879',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cebc702066_75515879')) {function content_5800cebc702066_75515879($_smarty_tpl) {?>
	<!-- PRODUCT-TAB-CAROSUL-AREA-END -->
<!--product brands-->
<div class="logo-brand-area">
		<div class="container">
			<div class="logo-brand-carosul-area">
				<div class="row">
					<div class="logo-brand-carosul">
						<?php  $_smarty_tpl->tpl_vars['manufact'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manufact']->_loop = false;
 $_from = Modules_Product_Frontend_Boot::getManufacturer(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manufact']->key => $_smarty_tpl->tpl_vars['manufact']->value) {
$_smarty_tpl->tpl_vars['manufact']->_loop = true;
?>
                                                <div class="col-lg-2 col-md-2">
                                                  <a href="index.php?module=product&page=list&man_id=<?php echo $_smarty_tpl->tpl_vars['manufact']->value->getId();?>
" class="d_block t_align_c animate_fade" >
                                                      <img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['manufact']->value->getPictureSrc())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
" alt="" style="width: 75%;height: 100px;">
                                                  </a>
                                                
                                                </div>
                                                <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGO-BRAND-AREA END-->
   <?php }} ?>
