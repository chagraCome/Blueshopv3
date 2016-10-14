<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BannerCest {

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

    // want to Add new banner
    public function AddBanner(AcceptanceTester $I) {
        $I->wantToTest('Link Add Banner');
        $I->wantTo('go to /admin.php?module=banner&page=add');
        $I->amOnPage('/admin.php?module=banner&page=add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Add new banner
    public function BannerForm(AcceptanceTester $I) {
        $this->AddBanner($I);
        $I->submitForm('#bannerForm_form', array('banner' => array(
                'name' => 'Miles',
                'trigger_banner_file' => '10.jpg',
                'submit' => 'Save'
        )));
        $I->see('Action was successfully done');
    }

    // want to Check List banner
    public function ListBanner(AcceptanceTester $I) {
        $I->wantToTest('List Banner');
        $I->wantTo('go to /admin.php?module=banner&page=list');
        $I->amOnPage('/admin.php?module=banner&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set Banner offline banner
    public function SetBannerOffline(AcceptanceTester $I) {
        $I->wantToTest('Banner Offline');
        $I->wantTo('go to /admin.php?module=banner&page=offline&id=4');
        $I->amOnPage('/admin.php?module=banner&page=offline&id=4');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify banner
    public function ModifyBanner(AcceptanceTester $I) {
        $I->wantToTest('Link Modify Banner');
        $I->wantTo('go to /admin.php?module=banner&page=modify&id=4');
        $I->amOnPage('/admin.php?module=banner&page=modify&id=4');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete banner
    public function DeleteBanner(AcceptanceTester $I) {
        $I->wantToTest('Link Delete Banner');
        $I->wantTo('go to /admin.php?module=banner&page=delete&id=3');
        $I->amOnPage('/admin.php?module=banner&page=delete&id=3');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set banner online
    public function SetBannerOnline(AcceptanceTester $I) {
        $I->wantToTest('Banner Online');
        $I->wantTo('go to /admin.php?module=banner&page=online&id=4');
        $I->amOnPage('/admin.php?module=banner&page=online&id=4');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check banner Setting
    public function BannerSetting(AcceptanceTester $I) {
        $I->wantToTest('banner Setting');
        $I->wantTo('go to admin.php?module=banner&page=setting');
        $I->amOnPage('/admin.php?module=banner&page=setting');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
