<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductCest {

    public function _before(AcceptanceTester $I) {
        $I->wantToTest('Login');
        $I->wantTo('go to /admin.php?module=user&page=user-login');
        $I->amOnPage('/admin.php?module=user&page=user-login');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('fill username with admin');
        $I->fillField('//*[@id="username"]', 'admin');
        $I->wantTo('fill password with admin');
        $I->fillField('//*[@id="password"]', 'admin');
        $I->wantTo('Click login');
        $I->click('login');
        $I->wantToTest('Welcome to control panel exist ');
        $I->see('Welcome to control panel');
    }

    public function _after(AcceptanceTester $I) {
        $I->wantToTest('Logout');
        $I->wantTo('go to /admin.php?module=user&page=user-logout');
        $I->amOnPage('/admin.php?module=user&page=user-login');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
    }

    private function dontSeeAnyWarningsOrErrors(AcceptanceTester $I) {
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning:');
        $I->wantTo('check no Notice exist');
        $I->dontSee('Notice:');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
    }

    // want to Check List All Product
    public function ListProduct(AcceptanceTester $I) {
        $I->wantToTest('List Product');
        $I->wantTo('go to /admin.php?module=product&page=product-list');
        $I->amOnPage('/admin.php?module=product&page=product-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List offline product
    public function ListOfflineProduct(AcceptanceTester $I) {
        $I->wantToTest('List offline product');
        $I->wantTo('go to /admin.php?module=product&page=product-offlineproduct');
        $I->amOnPage('/admin.php?module=product&page=product-offlineproduct');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Special product
    public function ListSpecialProduct(AcceptanceTester $I) {
        $I->wantToTest('List special product');
        $I->wantTo('go to /admin.php?module=product&page=product-specialproduct');
        $I->amOnPage('/admin.php?module=product&page=product-specialproduct');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Grouped Products
    public function GroupedProducts(AcceptanceTester $I) {
        $I->wantToTest('Grouped Products');
        $I->wantTo('go to /admin.php?module=product&page=product-grouped&id=842');
        $I->amOnPage('/admin.php?module=product&page=product-grouped&id=842');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check prepare product
    public function PrepareProduct(AcceptanceTester $I) {
        $I->wantToTest('Prepare product');
        $I->wantTo('go to /admin.php?module=product&page=product-prepare');
        $I->amOnPage('/admin.php?module=product&page=product-prepare');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Add product
    public function AddProduct(AcceptanceTester $I) {
        $I->wantToTest('Add New product');
        $I->wantTo('go to /admin.php?module=product&page=product-add&setid=6&typeid=1');
        $I->amOnPage('/admin.php?module=product&page=product-add&setid=6&typeid=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product Prices
    public function ProductPrices(AcceptanceTester $I) {
        $I->wantToTest('Product Prices');
        $I->wantTo('go to /admin.php?module=product&page=price-modify&id=841');
        $I->amOnPage('/admin.php?module=product&page=price-modify&id=841');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product media
    public function ProductMedia(AcceptanceTester $I) {
        $I->wantToTest('Product media');
        $I->wantTo('go to /admin.php?module=product&page=product-media&id=83');
        $I->amOnPage('/admin.php?module=product&page=product-media&id=83');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product Shipping 
    public function ProductShipping(AcceptanceTester $I) {
        $I->wantToTest('Product Shipping ');
        $I->wantTo('go to /admin.php?module=product&page=product-shipping&id=83');
        $I->amOnPage('/admin.php?module=product&page=product-shipping&id=83');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product Marketing 
    public function ProductMarketing(AcceptanceTester $I) {
        $I->wantToTest('Product Marketing ');
        $I->wantTo('go to /admin.php?module=product&page=product-marketing&id=83');
        $I->amOnPage('/admin.php?module=product&page=product-marketing&id=83');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product Configurations 
    public function ProductConfigurations(AcceptanceTester $I) {
        $I->wantToTest('Product Configurations ');
        $I->wantTo('go to /admin.php?module=product&page=product-configuration&product_id=83');
        $I->amOnPage('/admin.php?module=product&page=product-configuration&product_id=83');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Modify Product
    public function ModifyProduct(AcceptanceTester $I) {
        $I->wantToTest('Modify Product');
        $I->wantTo('go to /admin.php?module=product&page=product-modify&id=840');
        $I->amOnPage('/admin.php?module=product&page=product-modify&id=840');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Online Product
    public function Online(AcceptanceTester $I) {
        $I->wantToTest('Online Product');
        $I->wantTo('go to /admin.php?module=product&page=product-online&id=842');
        $I->amOnPage('/admin.php?module=product&page=product-online&id=842');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Offline Product
    public function Offline(AcceptanceTester $I) {
        $I->wantToTest('Offline Product');
        $I->wantTo('go to /admin.php?module=product&page=product-offline&id=57');
        $I->amOnPage('/admin.php?module=product&page=product-offline&id=57');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Delete Product
    public function DeleteProduct(AcceptanceTester $I) {
        $I->wantToTest('Delete Product');
        $I->wantTo('go to /admin.php?module=product&page=product-delete&id=839');
        $I->amOnPage('/admin.php?module=product&page=product-delete&id=839');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Product Settings
    public function Setting(AcceptanceTester $I) {
        $I->wantToTest('Product Settings');
        $I->wantTo('go to /admin.php?module=product&page=setting');
        $I->amOnPage('/admin.php?module=product&page=setting');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Modify all products
    public function ModifyAllProducts(AcceptanceTester $I) {
        $I->wantToTest('Modify all products');
        $I->wantTo('go to /admin.php?module=product&page=product-modify-multi-list');
        $I->amOnPage('/admin.php?module=product&page=product-modify-multi-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
