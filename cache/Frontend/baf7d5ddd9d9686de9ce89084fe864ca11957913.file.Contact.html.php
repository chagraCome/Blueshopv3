<?php /* Smarty version Smarty-3.1.18, created on 2016-10-14 13:29:50
         compiled from ".\Design\Frontend\Hide1\Modules\Crm\Frontend\Views\Contact.html" */ ?>
<?php /*%%SmartyHeaderCode:143205800cfbe4caa29-45884125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baf7d5ddd9d9686de9ce89084fe864ca11957913' => 
    array (
      0 => '.\\Design\\Frontend\\Hide1\\Modules\\Crm\\Frontend\\Views\\Contact.html',
      1 => 1476442871,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143205800cfbe4caa29-45884125',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'breadcrumb' => 0,
    'formn' => 0,
    'pageContent' => 0,
    'shop' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5800cfbe5823d4_78477280',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5800cfbe5823d4_78477280')) {function content_5800cfbe5823d4_78477280($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

<!-- BREADCRUMBS-AREA-END -->
<div class="contuct-form-map">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                    <div class="contuct-form">

                        <h1><?php echo smarty_modifier_tr('Contact Form');?>
</h1>
                        <p class="m_bottom_10"><?php echo smarty_modifier_tr('Send an email. All fields with an');?>
 <span class="scheme_color">*</span> <?php echo smarty_modifier_tr('are required');?>
.</p>

                        <?php echo $_smarty_tpl->tpl_vars['formn']->value->Render();?>


                    </div>
               
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="map-area">

                    <?php if ($_smarty_tpl->tpl_vars['pageContent']->value) {?>
                    <div id="map_canvas" style="width:100%;height:100%;"><?php echo $_smarty_tpl->tpl_vars['pageContent']->value;?>
</div>
                    <?php }?>

                </div>
                <div class="map-caption">
                    <h2>GIVE US A CALL</h2>
                    <p><i class="fa fa-map-marker f_left color_dark"></i><?php echo $_smarty_tpl->tpl_vars['shop']->value->adress;?>
</p>
                    <i class="fa fa-phone-square"></i>
                    <strong><?php echo $_smarty_tpl->tpl_vars['shop']->value->tel;?>
</strong>
                    </br>

                    <i class="fa fa-envelope f_left color_dark"></i>

                    <strong><?php echo $_smarty_tpl->tpl_vars['shop']->value->email;?>
</strong>


                </div>
            </div>


        </div>
    </div>
</div><?php }} ?>
