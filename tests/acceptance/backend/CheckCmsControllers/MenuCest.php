<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MenuCest {

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

    // want to Add new Menu Points
    public function AddMenuPoints(AcceptanceTester $I) {
        $I->wantToTest('Link Add Banner');
        $I->wantTo('go to /admin.php?module=cms&page=menu-add');
        $I->amOnPage('/admin.php?module=cms&page=menu-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');

        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error');

        $I->wantTo('check no syntax error exist');
        $I->dontSee('syntax error');

        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning');

        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');

        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Menu Points
    public function ModifyMenuPoints(AcceptanceTester $I) {
        $I->wantToTest('Modify Menu Points');
        $I->wantTo('go to /admin.php?module=cms&page=menu-modify&id=7');
        $I->amOnPage('/admin.php?module=cms&page=menu-modify&id=7');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->dontSee('not found');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Menu Points
    public function DeleteMenuPoints(AcceptanceTester $I) {
        $I->wantToTest('Delete Menu Points');
        $I->wantTo('go to /admin.php?module=cms&page=menu-delete&id=30');
        $I->amOnPage('/admin.php?module=cms&page=menu-delete&id=30');
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

    // want to Check Menu Points
    public function ListMenuPoints(AcceptanceTester $I) {
        $I->wantToTest('List Menu Points');
        $I->wantTo('go to /admin.php?module=cms&page=menu-list');
        $I->amOnPage('/admin.php?module=banner&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Menu Points offline
    public function SetMenuPointsOffline(AcceptanceTester $I) {
        $I->wantToTest('Set Menu Points offline');
        $I->wantTo('go to /admin.php?module=cms&page=menu-offline&id=7');
        $I->amOnPage('/admin.php?module=cms&page=menu-offline&id=7');
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

    // want to Set Menu Points online
    public function SetMenuPointsOnline(AcceptanceTester $I) {
        $I->wantToTest('Set Menu Points online');
        $I->wantTo('go to /admin.php?module=cms&page=menu-online&id=7');
        $I->amOnPage('/admin.php?module=cms&page=menu-online&id=7');
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

}
