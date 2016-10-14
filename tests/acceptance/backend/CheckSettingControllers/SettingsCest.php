<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SettingsCest {

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
        $I->wantToTest('Control Panel exist in login page');
        $I->see('Control Panel');
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

    // want to Check general setting
    public function GeneralSetting(AcceptanceTester $I) {
        $I->wantToTest('General setting');
        $I->wantTo('go to /admin.php?module=setting&page=general');
        $I->amOnPage('/admin.php?module=setting&page=general');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check currency list
    public function CurrencyList(AcceptanceTester $I) {
        $I->wantToTest('Currency list');
        $I->wantTo('go to /admin.php?module=setting&page=currency-list');
        $I->amOnPage('/admin.php?module=setting&page=currency-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Email Template
    public function ListEmailTemplate(AcceptanceTester $I) {
        $I->wantToTest('List Email Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-email-list');
        $I->amOnPage('/admin.php?module=setting&page=template-email-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check quicklist Email Template
    public function Quicklist(AcceptanceTester $I) {
        $I->wantToTest('Quicklist Email Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-email-quicklist');
        $I->amOnPage('/admin.php?module=setting&page=template-email-quicklist');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
    }

    // want to Check Add Email Template
    public function AddEmailTemplate(AcceptanceTester $I) {
        $I->wantToTest('Add Email Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-email-add');
        $I->amOnPage('/admin.php?module=setting&page=template-email-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Modify Email Template
    public function ModifyEmailTemplate(AcceptanceTester $I) {
        $I->wantToTest('Modify Email Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-email-modify&id=1');
        $I->amOnPage('/admin.php?module=setting&page=template-email-modify&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check delete Email Template
    public function DeleteEmailTemplate(AcceptanceTester $I) {
        $I->wantToTest('Delete Email Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-email-delete&id=21');
        $I->amOnPage('/admin.php?module=setting&page=template-email-delete&id=21');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check quicklist Print Template
    public function QuicklistPrintTemplate(AcceptanceTester $I) {
        $I->wantToTest('Quicklist Print Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-print-quicklist');
        $I->amOnPage('/admin.php?module=setting&page=template-print-quicklist');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
    }

    // want to Check Modify Print Template
    public function ModifyPrintTemplate(AcceptanceTester $I) {
        $I->wantToTest('Modify Print Template');
        $I->wantTo('go to /admin.php?module=setting&page=template-print-modify&id=1');
        $I->amOnPage('/admin.php?module=setting&page=template-print-modify&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Template Header
    public function TemplateHeader(AcceptanceTester $I) {
        $I->wantToTest('Template Header');
        $I->wantTo('go to /admin.php?module=setting&page=template-print-header&id=1');
        $I->amOnPage('/admin.php?module=setting&page=template-print-header&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Template footer 
    public function TemplateFooter(AcceptanceTester $I) {
        $I->wantToTest('Template footer');
        $I->wantTo('go to /admin.php?module=setting&page=template-print-footer&id=1');
        $I->amOnPage('/admin.php?module=setting&page=template-print-footer&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
