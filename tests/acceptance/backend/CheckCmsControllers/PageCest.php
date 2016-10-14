<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PageCest {

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

    public function Preadd(AcceptanceTester $I) {
        $I->wantToTest('Preadd Page');
        $I->wantTo('go to /admin.php?module=cms&page=page-preadd');
        $I->amOnPage('/admin.php?module=cms&page=page-preadd');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Add new Page
    public function AddPage(AcceptanceTester $I) {
        $I->wantToTest('Add Page');
        $I->wantTo('go to /admin.php?module=cms&page=page-add&layout=s');
        $I->amOnPage('/admin.php?module=cms&page=page-add&layout=s');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Page
    public function ModifyPage(AcceptanceTester $I) {
        $I->wantToTest('Modify Page');
        $I->wantTo('go to /admin.php?module=cms&page=page-modify&id=17');
        $I->amOnPage('/admin.php?module=cms&page=page-modify&id=17');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->dontSee('not found');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Page
    public function ListPage(AcceptanceTester $I) {
        $I->wantToTest('List page');
        $I->wantTo('go to /admin.php?module=cms&page=page-list');
        $I->amOnPage('/admin.php?module=cms&page=page-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List fixed Page
    public function ListFixedPage(AcceptanceTester $I) {
        $I->wantToTest('List Fixed page');
        $I->wantTo('go to /admin.php?module=cms&page=page-fixed');
        $I->amOnPage('/admin.php?module=cms&page=page-fixed');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Page offline
    public function SetPageOffline(AcceptanceTester $I) {
        $I->wantToTest('Page Offline');
        $I->wantTo('go to /admin.php?module=cms&page=page-offline&id=17');
        $I->amOnPage('/admin.php?module=cms&page=page-offline&id=17');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Action was successfully done');
        $I->see('Action was successfully done');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Page online
    public function SetPageOnline(AcceptanceTester $I) {
        $I->wantToTest('Page Online');
        $I->wantTo('go to /admin.php?module=cms&page=page-online&id=17');
        $I->amOnPage('/admin.php?module=cms&page=page-online&id=17');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Action was successfully done');
        $I->see('Action was successfully done');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Design
    public function ModifyDesign(AcceptanceTester $I) {
        $I->wantToTest('Modify Design');
        $I->wantTo('go to /admin.php?module=cms&page=page-design&pageid=17');
        $I->amOnPage('/admin.php?module=cms&page=page-design&pageid=17');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Page
    public function DeletePage(AcceptanceTester $I) {
        $I->wantToTest('Delete Page');
        $I->wantTo('go to /admin.php?module=cms&page=page-delete&id=18');
        $I->amOnPage('/admin.php?module=cms&page=page-delete&id=18');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
