<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ContactCest {

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
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
    }

    // want to Add new Contact
    public function AddContact(AcceptanceTester $I) {
        $I->wantToTest('Add New contac');
        $I->wantTo('go to /admin.php?module=crm&page=contact-add');
        $I->amOnPage('/admin.php?module=crm&page=contact-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Contact
    public function ListContact(AcceptanceTester $I) {
        $I->wantToTest('List Contact');
        $I->wantTo('go to /admin.php?module=crm&page=contact-list');
        $I->amOnPage('/admin.php?module=crm&page=contact-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Contact
    public function ModifyContact(AcceptanceTester $I) {
        $I->wantToTest('Modify Contact');
        $I->wantTo('go to /admin.php?module=crm&page=contact-modify&id=1');
        $I->amOnPage('/admin.php?module=crm&page=contact-modify&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Contact
    public function DeleteContact(AcceptanceTester $I) {
        $I->wantToTest('Delete Contact');
        $I->wantTo('go to /admin.php?module=crm&page=contact-delete&id=2');
        $I->amOnPage('/admin.php?module=crm&page=contact-delete&id=2');
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

    // want to check Contact Details
    public function ContacDetails(AcceptanceTester $I) {
        $I->wantToTest('Contact Details');
        $I->wantTo('go to /admin.php?module=crm&page=contact-detail&id=1');
        $I->amOnPage('/admin.php?module=crm&page=contact-detail&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Convert to account
    public function ConvertToAccount(AcceptanceTester $I) {
        $I->wantToTest('Convert to Account');
        $I->wantTo('go to /admin.php?module=crm&page=contact-detail&event=convert&id=1');
        $I->amOnPage('/admin.php?module=crm&page=contact-detail&event=convert&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Contact Setting
    public function ContacSetting(AcceptanceTester $I) {
        $I->wantToTest('Contact Setting');
        $I->wantTo('go to /admin.php?module=crm&page=contactsetting');
        $I->amOnPage('/admin.php?module=crm&page=contactsetting');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
