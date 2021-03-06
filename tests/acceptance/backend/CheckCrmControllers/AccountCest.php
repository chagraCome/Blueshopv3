<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AccountCest {

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

    // want to Add new account
    public function AddAccount(AcceptanceTester $I) {
        $I->wantToTest('Add New account');
        $I->wantTo('go to /admin.php?module=crm&page=account-add');
        $I->amOnPage('/admin.php?module=crm&page=account-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Account
    public function ListAccount(AcceptanceTester $I) {
        $I->wantToTest('List Banner');
        $I->wantTo('go to /admin.php?module=crm&page=account-list');
        $I->amOnPage('/admin.php?module=crm&page=account-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify account
    public function ModifyAccount(AcceptanceTester $I) {
        $I->wantToTest('Modify account');
        $I->wantTo('go to /admin.php?module=crm&page=account-modify&id=72');
        $I->amOnPage('/admin.php?module=crm&page=account-modify&id=72');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

// want to Test account details
    public function AccountDetails(AcceptanceTester $I) {
        $I->wantToTest('Modify account');
        $I->wantTo('go to /admin.php?module=crm&page=account-detail&id=85');
        $I->amOnPage('/admin.php?module=crm&page=account-detail&id=85');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Account
    public function DeleteAccount(AcceptanceTester $I) {
        $I->wantToTest('Delete Account');
        $I->wantTo('go to /admin.php?module=crm&page=account-delete&id=69');
        $I->amOnPage('/admin.php?module=crm&page=account-delete&id=69');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Account offline
    public function SetAccountOffline(AcceptanceTester $I) {
        $I->wantToTest('Account Offline');
        $I->wantTo('go to /admin.php?module=crm&page=account-offline&id=85');
        $I->amOnPage('/admin.php?module=crm&page=account-offline&id=85');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Account online
    public function SetAccountOnline(AcceptanceTester $I) {
        $I->wantToTest('Account Online');
        $I->wantTo('go to /admin.php?module=crm&page=account-online&id=85');
        $I->amOnPage('/admin.php?module=crm&page=account-online&id=85');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Account Setting
    public function AccountSetting(AcceptanceTester $I) {
        $I->wantToTest('Account Setting');
        $I->wantTo('go to /admin.php?module=crm&page=accountsetting');
        $I->amOnPage('/admin.php?module=crm&page=accountsetting');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
