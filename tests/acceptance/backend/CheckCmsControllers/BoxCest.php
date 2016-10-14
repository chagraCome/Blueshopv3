<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxCest {

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
        $I->wantToTest('Current Url is /admin.php?module=user&page=user-login');
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

    // want to PreAdd Box
    public function PreAddBox(AcceptanceTester $I) {
        $I->wantToTest('Link Add Banner');
        $I->wantTo('go to /admin.php?module=cms&page=box-preadd');
        $I->amOnPage('/admin.php?module=cms&page=box-preadd');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Add Box
    public function AddBox(AcceptanceTester $I) {
        $I->wantToTest('Add New Box');
        $I->wantTo('go to /admin.php?module=cms&page=box-add&layout=2');
        $I->amOnPage('/admin.php?module=cms&page=box-add&layout=2');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Box
    public function ModifyBox(AcceptanceTester $I) {
        $I->wantToTest('Modify Box');
        $I->wantTo('go to /admin.php?module=cms&page=box-modify&id=1');
        $I->amOnPage('/admin.php?module=cms&page=box-modify&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->dontSee('not found');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Box
    public function DeleteBox(AcceptanceTester $I) {
        $I->wantToTest('Delete Box');
        $I->wantTo('go to /admin.php?module=cms&page=box-delete&id=8');
        $I->amOnPage('/admin.php?module=cms&page=box-delete&id=8');
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

    // want to Check List Box
    public function ListBox(AcceptanceTester $I) {
        $I->wantToTest('List Box');
        $I->wantTo('go to /admin.php?module=cms&page=box-list');
        $I->amOnPage('/admin.php?module=cms&page=box-list');
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

    // want to Set Box offline
    public function SetBoxOffline(AcceptanceTester $I) {
        $I->wantToTest('Set Box Offline');
        $I->wantTo('go to admin.php?module=cms&page=box-offline&id=1');
        $I->amOnPage('admin.php?module=cms&page=box-offline&id=1');
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

    // want to Set Box online
    public function SetBoxOnline(AcceptanceTester $I) {
        $I->wantToTest('Set Box Online');
        $I->wantTo('go to /admin.php?module=cms&page=box-online&id=1');
        $I->amOnPage('/admin.php?module=cms&page=box-online&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Action was successfully done');
        $I->see('Action was successfully done');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
