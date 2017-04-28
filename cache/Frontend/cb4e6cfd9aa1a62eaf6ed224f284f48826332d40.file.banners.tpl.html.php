<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 01:30:37
         compiled from "Design\Frontend\Hide1\banners.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2451458eab60def7362-90676895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb4e6cfd9aa1a62eaf6ed224f284f48826332d40' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\banners.tpl.html',
      1 => 1476455446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2451458eab60def7362-90676895',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'main_banners' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eab60e03dbf8_82589662',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eab60e03dbf8_82589662')) {function content_58eab60e03dbf8_82589662($_smarty_tpl) {?>
<div class="slider-and-add-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-lg-9 col-md-9">
                <!-- SLIDER-AREA-START-->
                <div class="slider-wrap">
                    <div class="fullwidthbanner-container" >
                        <div class="fullwidthbanner-15">
                            <ul>	<!-- SLIDE-->
                                  <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['main_banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value) {
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>

                                    <li
                                        data-index="rs-26" 
                                        data-transition="random" 
                                        data-slotamount="7"  
                                        data-easein="default" 
                                        data-easeout="default"
                                        data-rotate="0"  
                                        data-saveperformance="off"> 

                                        <img src="<?php echo $_smarty_tpl->tpl_vars['banner']->value->absolutepath;?>
" data-custom-thumb="<?php echo $_smarty_tpl->tpl_vars['banner']->value->absolutepath;?>
" >
                                       


                                    </li>
                                    <?php } ?>
                               
                            </ul>

                        </div>
                    </div>
                </div>
                <!-- SLIDER-AREA-END -->



            </div>
        </div>
    </div><?php }} ?>
