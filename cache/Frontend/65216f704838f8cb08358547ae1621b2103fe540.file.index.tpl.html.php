<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:29:49
         compiled from "Design\Frontend\Hide1\index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:101165800cfbd8aaa77-48070598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65216f704838f8cb08358547ae1621b2103fe540' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\index.tpl.html',
      1 => 1476438479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101165800cfbd8aaa77-48070598',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'appconfig' => 0,
    'current_lang' => 0,
    'shop' => 0,
    'page_title' => 0,
    'page_description' => 0,
    'page_keywords' => 0,
    'skin_path' => 0,
    'applicationlayout' => 0,
    'bottomblocks' => 0,
    'block' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cfbddb3ca7_88061671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cfbddb3ca7_88061671')) {function content_5800cfbddb3ca7_88061671($_smarty_tpl) {?><!doctype html>
<html class="no-js" lang="">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <base href="<?php echo $_smarty_tpl->tpl_vars['appconfig']->value->appurl;?>
/" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php if ($_smarty_tpl->tpl_vars['current_lang']->value=='ar') {?>
        <title><?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['shop']->value->name_ar);?>
 <?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['page_title']->value);?>
</title>
        <?php } else { ?>
        <title><?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['shop']->value->name_en);?>
 <?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['page_title']->value);?>
</title>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['page_description']->value) {?>
        <meta name="description" content="<?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['page_description']->value);?>
" />
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['page_keywords']->value) {?>
        <meta name="keywords" content='<?php echo htmlspecialchars_decode($_smarty_tpl->tpl_vars['page_keywords']->value);?>
' />
        <?php }?>
        <meta name="robots" content="index,follow,noodp" />
        <meta name="googlebot" content="noodp" />
        <?php if ($_smarty_tpl->tpl_vars['shop']->value->rss==1) {?>
        <link rel="alternate" type="application/rss+xml" title="RSS" href="rss.html" />
        <?php }?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/owl.carousel.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/owl.theme.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/owl.transitions.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/meanmenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/jquery.simpleLens.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/main.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/vendor/modernizr-2.8.3.min.js"></script>

    </head>
    <?php if ($_smarty_tpl->tpl_vars['shop']->value->disable_image==1) {?>	
    <body oncontextmenu="return false" class="home-15 home-9" >
        <?php } else { ?>	
    <body class="home-15 home-9">
        <?php }?>
        <?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php if (!$_GET['page']) {?>		
        <?php echo $_smarty_tpl->getSubTemplate ('banners.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>
        <!--content-->
        <?php if ($_smarty_tpl->tpl_vars['applicationlayout']->value=='1') {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Layout/layout1.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['applicationlayout']->value=='2r') {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Layout/layout2r.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['applicationlayout']->value=='2l') {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Layout/layout2l.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['applicationlayout']->value=='3') {?>
        <?php echo $_smarty_tpl->getSubTemplate ('Layout/layout3.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>
        <div>
            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bottomblocks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
            <?php echo $_smarty_tpl->tpl_vars['block']->value->Render();?>

            <?php } ?>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--js--> 
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/vendor/jquery-1.11.3.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/bootstrap.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/owl.carousel.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.meanmenu.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.simpleLens.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery-ui.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.countdown.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/parallax.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.collapse.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.easing.1.3.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.scrollUp.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.knob.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.appear.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/jquery.counterup.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/waypoints.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/wow.js"></script>
        
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/lib/rs-plugin/rs.home.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/plugins.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['skin_path']->value;?>
/js/main.js"></script>    
    </body>

</html><?php }} ?>
