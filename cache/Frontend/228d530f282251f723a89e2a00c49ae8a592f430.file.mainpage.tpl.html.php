<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:25:16
         compiled from "Design\Frontend\Hide1\mainpage.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:10395800ceac5123b7-70605169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '228d530f282251f723a89e2a00c49ae8a592f430' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\mainpage.tpl.html',
      1 => 1475836142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10395800ceac5123b7-70605169',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_manufacturer_home_page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800ceac608576_79281064',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800ceac608576_79281064')) {function content_5800ceac608576_79281064($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><?php echo $_smarty_tpl->getSubTemplate ('homepage.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<section class="product-tab-carousl area-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="tab-menu">
                    <ul>
                        <li class="active"><a href="#latest" data-toggle="tab"><?php echo smarty_modifier_tr('latest products');?>
</a></li>
                        <li><a href="#featured" data-toggle="tab"><?php echo smarty_modifier_tr('new products');?>
</a></li>
                        <li><a href="#special" data-toggle="tab"><?php echo smarty_modifier_tr('special products');?>
 </a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="tab-content">
                <!-- FEATURED-TAB-START -->
               
                <?php echo $_smarty_tpl->getSubTemplate ('mainpage-latestproducts.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

             
                <?php echo $_smarty_tpl->getSubTemplate ('mainpage-newproducts.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

              
                <!-- FEATURED-TAB-END -->
                

                <!-- RANDOM-TAB-START -->

                <!-- RANDOM-TAB-END -->
                <!-- SPECIAL-TAB-START -->
                <?php echo $_smarty_tpl->getSubTemplate ('mainpage-specialproducts.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


                <!-- SALE-TAB-END -->
            </div>
        </div>
    </div>
</section>
<?php if ($_smarty_tpl->tpl_vars['show_manufacturer_home_page']->value==1) {?>
<?php echo $_smarty_tpl->getSubTemplate ('brands.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php }} ?>
