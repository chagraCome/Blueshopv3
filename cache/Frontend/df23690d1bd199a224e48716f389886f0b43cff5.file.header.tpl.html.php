<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:29:49
         compiled from "Design\Frontend\Hide1\header.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:152135800cfbddea7b8-94369988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df23690d1bd199a224e48716f389886f0b43cff5' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\header.tpl.html',
      1 => 1476441372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152135800cfbddea7b8-94369988',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop' => 0,
    'loggedusername' => 0,
    'current_lang' => 0,
    'current_currency' => 0,
    'current_currency_flag' => 0,
    'locales' => 0,
    'local' => 0,
    'skin_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cfbe0d6db8_05793029',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cfbe0d6db8_05793029')) {function content_5800cfbe0d6db8_05793029($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><header class="header-area">
    <!-- TOP-LINK START-->
    <div class="top-link">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <div class="top-link-left">
                        <div class="call-us"><?php echo smarty_modifier_tr('Call us toll free');?>
:<span><?php echo $_smarty_tpl->tpl_vars['shop']->value->tel;?>
</span></div>
                        <p> <?php if ($_smarty_tpl->tpl_vars['loggedusername']->value) {?>
                            <?php echo smarty_modifier_tr('Welcome');?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['loggedusername']->value;?>

                            <a href="index.php?module=crm&page=intern-shop-logout"><b><?php echo smarty_modifier_tr('Log Out');?>
</b></a>
                            <?php } else { ?>
                            <?php echo smarty_modifier_tr('Welcome guest you can');?>
 <a href="index.php?module=crm&page=intern-shop-login"><b><?php echo smarty_modifier_tr('Log In');?>
</b></a>
                            <?php echo smarty_modifier_tr('or');?>
 <a href="index.php?module=crm&page=intern-shop-register"><b><?php echo smarty_modifier_tr('Create an Account');?>
</b><?php }?></a> 
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <div class="top-link-right">
                        <div class="righ-menu">
                            <ul>
                                <!--<li><a href="index.php?lang=en">English <i class="fa fa-caret-down"></i></a>
                                        <ul>
                                                <li class="active"><a href="#">English</a></li>
                                                <li><a href="index.php?lang=ar">العربية</a></li>
                                        </ul>
                                </li>-->

                                <!--language settings-->
                                <?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='en') {?>
                                <li>
                                    <a href="index.php?lang=ar" >
                                        العربية 
                                    </a>
                                </li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?>

                                <li>
                                    <a href="index.php?lang=en">
                                        English
                                    </a>
                                </li>

                                <?php }?>
                            </ul>
                        </div>
                        <div class="righ-menu">
                            <ul>
                                <li><a href="JavaScript:void(0);" id="currency_button"> 
                                         <span class="scheme_color"><?php echo $_smarty_tpl->tpl_vars['current_currency']->value;?>
</span> 
                            <span class="d_mxs_none">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['current_currency_flag']->value;?>
" style="padding-right:5px; padding-left:5px; margin-top: 5px;">&nbsp;
                            </span>
                                       </a>
                                    
                                        <ul style="width:93px;">
                            <?php  $_smarty_tpl->tpl_vars['local'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['local']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['locales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['local']->key => $_smarty_tpl->tpl_vars['local']->value) {
$_smarty_tpl->tpl_vars['local']->_loop = true;
?>
                            <li>
                                <a href="index.php?locale=<?php echo $_smarty_tpl->tpl_vars['local']->value['locale'];?>
" >
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['local']->value['flag'];?>
" style="margin-top: 5px;">&nbsp;<span><?php echo $_smarty_tpl->tpl_vars['local']->value['symbol'];?>
 </span>  
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                                        
                                      
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TOP-LINK END-->
    <!-- HEADER-CONTENT START-->
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-3 col-md-3">
                    <div class="logo">
                        <?php if ($_smarty_tpl->tpl_vars['shop']->value->shop_logo) {?>
                        <a href="index.php" class="logo m_xs_bottom_15 d_xs_inline_b">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['shop']->value->shop_logo;?>
" style="max-width: 230px;" >
                        </a>
                        <?php } else { ?>
                        <a href="index.php" style="font-size: 18px; font-weight: bold;" class="logo m_xs_bottom_15 d_xs_inline_b">
                            <h1><?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='en') {?><?php echo $_smarty_tpl->tpl_vars['shop']->value->name_en;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['shop']->value->name_ar;?>
<?php }?></h1> 
                        </a>
                        <?php }?>

                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-5">
                    <div class="search-box">
                        <form action="#" method="post">
                            <div class="search-form">
                                <input type="text" value="Search products..." onblur="{
                                                                                    literal
                                                                                }
                                                                                if (this.value == '') {
                                                                                    this.value = 'Search products...';
                                                                                }" onfocus="if (this.value == 'Search products...') {
                                                                                            this.value = '';
                                                                                        }
                                                                                        {
                                                                                            /literal}">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-md-4">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/img/icon-user-white.png" alt=""></a>
                                <span class="cart-position">2</span>
                                <ul>
                                    <li><a href="index.php?module=crm&page=intern-shop-home"><?php echo smarty_modifier_tr('My Account');?>
</a></li>
                                    <li><a href="index.php?module=saleorder&page=list"><?php echo smarty_modifier_tr('Checkout');?>
</a></li>
                                    <li><a href="index.php?module=crm&page=intern-shop-register"><?php echo smarty_modifier_tr('Log In');?>
</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/img/icon-cart-white.png" alt=""></a>

                            </li>
                            <li><a href="index.php?module=product&page=whishlist"><img src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/img/icon-wishlist-white.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADER-CONTENT END-->
    <!-- MAIN-MENU-AREA-START -->



    <!-- MAIN-MENU-AREA-END -->
    <!-- MOBILE-MENU-AREA START -->


    <!-- MOBILE-MENU-AREA END -->
</header>
<?php echo $_smarty_tpl->getSubTemplate ('menu_top.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<?php }} ?>
