<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SaleorderCest {

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

    // want to Check List Sale Order
    public function ListSaleOrder(AcceptanceTester $I) {
        $I->wantToTest('List Sale Order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-list');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List created Sale order
    public function CreatedSaleOrder(AcceptanceTester $I) {
        $I->wantToTest('List created Sale order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-list&event=created');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-list&event=created');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List accepted Sale order
    public function AcceptedSaleOrder(AcceptanceTester $I) {
        $I->wantToTest('List accepted Sale order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-list&event=accepted');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-list&event=accepted');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List today Sale order
    public function TodaySaleOrder(AcceptanceTester $I) {
        $I->wantToTest('List today Sale order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-list&event=today');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-list&event=today');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List open Sale order
    public function openSaleOrder(AcceptanceTester $I) {
        $I->wantToTest('List Banner');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-list&event=open');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-list&event=open');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Add new Sale order
    public function Add(AcceptanceTester $I) {
        $I->wantToTest('Add new Sale order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-add');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Sale Order
    public function Modify(AcceptanceTester $I) {
        $I->wantToTest('Link Modify Banner');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-modify&id=103');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-modify&id=103');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Sales Orders
    public function Delete(AcceptanceTester $I) {
        $I->wantToTest('Delete Sales Orders');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-delete&id=101');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-delete&id=101');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Sales Order Details
    public function Details(AcceptanceTester $I) {
        $I->wantToTest('Delete Sales Orders');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-details&id=103');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-details&id=103');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Update Sales Order state
    public function UpdateState(AcceptanceTester $I) {
        $I->wantToTest('Update Sales Order state');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-updatestate&id=103');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-updatestate&id=103');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
