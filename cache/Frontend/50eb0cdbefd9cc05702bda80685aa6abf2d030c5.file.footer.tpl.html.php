<?php /* Smarty version Smarty-3.1.18, created on 2017-04-10 00:49:10
         compiled from "Design\Frontend\Hide1\footer.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1824058eaba66b56717-31807238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50eb0cdbefd9cc05702bda80685aa6abf2d030c5' => 
    array (
      0 => 'Design\\Frontend\\Hide1\\footer.tpl.html',
      1 => 1476461769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1824058eaba66b56717-31807238',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop' => 0,
    'payment_methods' => 0,
    'payment' => 0,
    'debugbarRenderer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58eaba66c44338_78481486',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eaba66c44338_78481486')) {function content_58eaba66c44338_78481486($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_tr')) include 'C:\\wamp\\www\\Blueshopv3\\Amhsoft\\Libraries\\View\\Smarty\\Lib\\plugins\\amhsoft\\modifier.tr.php';
?><footer>
		<div class="footer-top-area">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-lg-3 col-md-3">
						<div class="single-footer-menu">
							<div class="footer-title">
								<h2>Company Info</h2>
							</div>
							<div class="footer-menu">
								<ul>
									<li><a href="#"><?php echo smarty_modifier_tr('About');?>
</a>
									<h3 class="color_light_2 m_bottom_20"><?php echo smarty_modifier_tr('About');?>
</h3>
                    <p><?php echo smarty_modifier_tr('Address');?>
&nbsp;:&nbsp;<?php echo $_smarty_tpl->tpl_vars['shop']->value->adress;?>
 <br/> <?php echo smarty_modifier_tr('Tel');?>
&nbsp;:&nbsp;<span><?php echo $_smarty_tpl->tpl_vars['shop']->value->tel;?>
</span></p>
                    
									</li>
					
								</ul>
							</div>
						</div>
					</div>
					
					 <?php echo $_smarty_tpl->getSubTemplate ('menu_footer.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<div class="col-sm-4 col-lg-3 col-md-3">
						<div class="single-footer-menu">
							<div class="footer-title">
								<h2>Follow Us</h2>
							</div>
							<div class="social-icon">
								<ul>
										<?php if ($_smarty_tpl->tpl_vars['shop']->value->facebookAccount) {?>
									<li>
									<a href="<?php echo $_smarty_tpl->tpl_vars['shop']->value->facebookAccount;?>
"><i class="fa fa-facebook"></i></a></li>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['shop']->value->twitterAccount) {?>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['shop']->value->twitterAccount;?>
"><i class="fa fa-twitter"></i></a></li>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['shop']->value->instagramAccount) {?>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['shop']->value->instagramAccount;?>
"><i class="fa fa-instagram"></i></a></li>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['shop']->value->youtubeAccount) {?>
									<li><a href="<?php echo $_smarty_tpl->tpl_vars['shop']->value->youtubeAccount;?>
"><i class="fa fa-youtube"></i></a></li>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['shop']->value->googleplusAccount) {?>
								    <li><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['shop']->value->email;?>
"><i class="fa fa-envelope-o"></i></a></li>
										<?php }?>
								</ul>
							</div>
							<div class="news-letter">
								<h3><?php echo smarty_modifier_tr('Newsletter');?>
</h3>
								<form action="index.php?module=newsletter&amp;page=addtonewsletter" method="post">
									<input name="module" value="product" type="hidden">
									<input type="hidden" name="sec_nekot" value="<?php echo Amhsoft_Common::CsrfGenrateToken('newsletter_form');?>
"/>
									<input name="page" value="list" type="hidden">
									<input id="newsletter-input" type="email" placeholder="<?php echo smarty_modifier_tr('Your email address');?>
" class="m_bottom_20 r_corners f_size_medium full_width"  required  name="newsletter_email">
									<button type="submit" name="submitNewsletter"><?php echo smarty_modifier_tr('Subscribe');?>
</button>
							   
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottum-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="footer-bottum">
							<div class="footer-payment">
								<?php  $_smarty_tpl->tpl_vars['payment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['payment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['payment_methods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['payment']->key => $_smarty_tpl->tpl_vars['payment']->value) {
$_smarty_tpl->tpl_vars['payment']->_loop = true;
?>
										<?php if ($_smarty_tpl->tpl_vars['payment']->value->getFooterLogo()) {?>
                                                                                <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['payment']->value->getFooterLogo();?>
" class="icon_payement"></a>
										<?php }?>
								<?php } ?>  
								
							</div>
							
							<div class="copyright">
                                                                <p>
                                                                    <span> <span>&copy;</span>&nbsp;<?php echo Amhsoft_Version::getCopyrightYear();?>
&nbsp;</span>
                                                                    <span>&nbsp;<?php echo Amhsoft_Version::getLicenceDomain();?>
&nbsp;</span>. All Rights Reserved - Powered By <?php echo Amhsoft_Version::getVersion();?>
</p>

								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- FOOTER-AREA-END -->
	<?php if ($_smarty_tpl->tpl_vars['debugbarRenderer']->value) {?>
<?php echo $_smarty_tpl->tpl_vars['debugbarRenderer']->value->renderHead();?>

<?php echo $_smarty_tpl->tpl_vars['debugbarRenderer']->value->render();?>

<?php }?><?php }} ?>
