<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:48:53
         compiled from ".\Modules\Product\Frontend\Views\List.html" */ ?>
<?php /*%%SmartyHeaderCode:2999958eaba554f9519-38994578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3d8b9c217c063155a171ca3417d752483c1ded0' => 
    array (
      0 => '.\\Modules\\Product\\Frontend\\Views\\List.html',
      1 => 1476455463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2999958eaba554f9519-38994578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category_name' => 0,
    'category_banner' => 0,
    'categories' => 0,
    'product_per_page_url' => 0,
    'products_per_page' => 0,
    'sort_url' => 0,
    'sort_by' => 0,
    'total_result' => 0,
    'layout' => 0,
    'layout_url' => 0,
    'items' => 0,
    'counter' => 0,
    'pager' => 0,
    'data' => 0,
    'childs' => 0,
    'child' => 0,
    'filter_attributes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba556f6022_33060109',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba556f6022_33060109')) {function content_58eaba556f6022_33060109($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><div class="row clearfix">
    <!--left content column-->
    <section class="col-lg-9 col-md-9 col-sm-9">
        <?php if ($_smarty_tpl->tpl_vars['category_name']->value) {?>
        <h2 class="tt_uppercase color_dark m_bottom_25">
            <?php echo $_smarty_tpl->tpl_vars['category_name']->value;?>

        </h2>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['category_banner']->value) {?>
        <img class="r_corners m_bottom_40" src="<?php echo $_smarty_tpl->tpl_vars['category_banner']->value;?>
" alt="" style="
    width: 100%;
    max-height: 400px;
">
        <?php }?>
        <!--categories nav-->
        <nav class="m_bottom_40 amh-only-desktop">
            <ul class="horizontal_list clearfix categories_nav_list m_xs_right_0 t_mxs_align_c">
               <?php  $_smarty_tpl->tpl_vars['categories'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categories']->_loop = false;
 $_from = Modules_Product_Frontend_Boot::getMainCategories(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->key => $_smarty_tpl->tpl_vars['categories']->value) {
$_smarty_tpl->tpl_vars['categories']->_loop = true;
?>
                <li class="m_right_15 f_mxs_none w_mxs_auto d_mxs_inline_b m_mxs_bottom_20">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['categories']->value->getUrl();?>
" class="d_block photoframe tr_all_hover shadow color_dark r_corners">
                        <span class="d_block wrapper">
                            <img class="tr_all_long_hover" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['categories']->value->getLogoSrc())===null||$tmp==='' ? 'media/noimage.jpg' : $tmp);?>
"   style="width: 100px;height: 100px;"/>
                        </span>
                       <?php echo $_smarty_tpl->tpl_vars['categories']->value->getName();?>

                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <!--sort-->
        <div class="row clearfix m_bottom_10">
            <div class="col-lg-12 col-md-8 col-sm-12 m_sm_bottom_10">
                <div class="toolbar amh-only-desktop ">
                    <form name="list_form" method="get" action="index.php" style="display:inline;">
                        <label for="products_per_page"><?php echo smarty_modifier_tr('Products per page');?>
</label>
                        <select name="products_per_page" id="products_per_page" onchange="javascript:window.location.href = '<?php echo $_smarty_tpl->tpl_vars['product_per_page_url']->value;?>
&products_per_page=' + this.value;">
                            <option value="9" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==9) {?> selected="selected" <?php }?>>9</option>
                            <option value="12" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==12) {?> selected="selected" <?php }?>>12</option>
                            <option value="16" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==16) {?> selected="selected" <?php }?>>16</option>
                            <option value="20" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==20) {?> selected="selected" <?php }?>>20</option>
                            <option value="30" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==30) {?> selected="selected" <?php }?>>30</option>
                            <option value="50" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==50) {?> selected="selected" <?php }?>>50</option>
                            <option value="100" <?php if ($_smarty_tpl->tpl_vars['products_per_page']->value==100) {?> selected="selected" <?php }?>>100</option>
                        </select>
                        <label for="sort_by"><?php echo smarty_modifier_tr('Sort by');?>
</label>
                        <select name="sort_by" id="sort_by" onchange="javascript:window.location.href = '<?php echo $_smarty_tpl->tpl_vars['sort_url']->value;?>
&sort_by=' + this.value;">
                            <option value=""><?php echo smarty_modifier_tr('Please select');?>
</option>  
                            <option value="priceasc"<?php if ($_smarty_tpl->tpl_vars['sort_by']->value=='priceasc') {?> selected="selected"<?php }?>><?php echo smarty_modifier_tr('Price Ascending');?>
</option>
                            <option value="pricedesc"<?php if ($_smarty_tpl->tpl_vars['sort_by']->value=='pricedesc') {?> selected="selected"<?php }?>><?php echo smarty_modifier_tr('Price Descending');?>
</option>
                        </select>
                        <span></span>
                    </form>
                    <span class="item_count"><?php echo smarty_modifier_tr('Result');?>
:  <script type="text/javascript"> document.write($("#products_per_page option:selected").text());</script>  <?php echo smarty_modifier_tr('from');?>
  <?php echo $_smarty_tpl->tpl_vars['total_result']->value;?>
</span>
                    <a style="margin-top:7px;" class="layout_switch_1<?php if ($_smarty_tpl->tpl_vars['layout']->value==2) {?> current<?php }?>" title="<?php echo smarty_modifier_tr('Show one product per line.');?>
" href="<?php echo $_smarty_tpl->tpl_vars['layout_url']->value;?>
&layout=2"></a>
                    <a style="margin-top:7px;" class="layout_switch_2<?php if ($_smarty_tpl->tpl_vars['layout']->value==1) {?> current<?php }?>" title="<?php echo smarty_modifier_tr('Show multi products per line.');?>
"  href="<?php echo $_smarty_tpl->tpl_vars['layout_url']->value;?>
&layout=1"></a>
                </div>
            </div>
        </div>
        <!--products-->
        <?php if ($_smarty_tpl->tpl_vars['total_result']->value==0) {?>
        <p><?php echo smarty_modifier_tr('No Products available');?>
.</p>
        <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['counter'] = new Smarty_variable(0, null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['layout']->value==1||$_smarty_tpl->tpl_vars['layout']->value=='grid') {?>
        <section class="products_container category_grid clearfix m_bottom_15">
            <?php if (!isset($_smarty_tpl->tpl_vars['item'])) $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable(null);while ($_smarty_tpl->tpl_vars['item']->value = $_smarty_tpl->tpl_vars['items']->value->fetch()) {?>
            <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/Item.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php }?>
        </section>
        <?php } else { ?>
        <section class="products_container list_type clearfix m_bottom_5 m_left_0 m_right_0">
            <?php if (!isset($_smarty_tpl->tpl_vars['item'])) $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable(null);while ($_smarty_tpl->tpl_vars['item']->value = $_smarty_tpl->tpl_vars['items']->value->fetch()) {?>
            <?php echo $_smarty_tpl->getSubTemplate ('Modules/Product/Frontend/Views/ItemList.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('counter'=>$_smarty_tpl->tpl_vars['counter']->value++), 0);?>

            <?php }?>
        </section>
        <?php }?>
        <?php }?>
        <hr class="m_bottom_10 divider_type_3">
        <div class="row clearfix m_bottom_15 m_xs_bottom_30">
            <div class="col-lg-5 col-md-5 col-sm-4 t_align_r t_xs_align_l">
                <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

            </div>
        </div>
    </section>
    <!--right column-->
    <aside class="col-lg-3 col-md-3 col-sm-3">
        <!--widgets-->
        <figure class="widget shadow r_corners wrapper m_bottom_30">
            <figcaption>
                <h3 class="color_light"><?php echo smarty_modifier_tr('Categories');?>
</h3>
            </figcaption>
            <div class="widget_content">
                <!--Categories list-->
                <ul class="categories_list">
                    <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = Modules_Product_Frontend_Boot::getCategories(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
                    <li class="">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['url'];?>
" class="f_size_large color_dark d_block relative">
                            <b><?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
</b>
                            <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                        </a>
                        <!--second level-->
                       <ul class="d_none">
                            <?php  $_smarty_tpl->tpl_vars['childs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['childs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['childs']->key => $_smarty_tpl->tpl_vars['childs']->value) {
$_smarty_tpl->tpl_vars['childs']->_loop = true;
?>
                            <li class="active">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['childs']->value->getUrl();?>
" class="d_block f_size_large color_dark relative">
                                    <?php echo $_smarty_tpl->tpl_vars['childs']->value->getName();?>
<?php if ($_smarty_tpl->tpl_vars['child']->value&&$_smarty_tpl->tpl_vars['child']->value->hasChildrens()) {?><span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span><?php }?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </figure>
        <?php if ($_smarty_tpl->tpl_vars['filter_attributes']->value) {?>
        <figure class="widget shadow r_corners wrapper m_bottom_30 amh-only-desktop">
            <figcaption>
                <h3 class="color_light"><?php echo smarty_modifier_tr('Filter');?>
</h3>
            </figcaption>
            <div class="widget_content">
                <!--filter form-->
                <?php echo $_smarty_tpl->tpl_vars['filter_attributes']->value;?>

            </div>
        </figure>
        <?php }?>
    </aside>
</div><?php }} ?>
