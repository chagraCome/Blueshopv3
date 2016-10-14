<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CmsFrontendCest {

    public function _before(AcceptanceTester $I) {
        
    }

    public function _after(AcceptanceTester $I) {
        
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

// want to Check Cms page
    public function Page(AcceptanceTester $I) {
        $I->wantToTest('Cms page');
        $I->wantTo('go to /index.php?module=cms&page=page&id=2');
        $I->amOnPage('/index.php?module=cms&page=page&id=2');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Sitemap
    public function Sitemap(AcceptanceTester $I) {
        $I->wantToTest('Crm home page');
        $I->wantTo('go to /index.php?module=cms&page=sitemap');
        $I->amOnPage('/index.php?module=cms&page=sitemap');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

}
