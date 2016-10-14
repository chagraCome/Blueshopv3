<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentCest {

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

// want to Check List Sale order comment
    public function ListComment(AcceptanceTester $I) {
        $I->wantToTest('List Sale order Comment');
        $I->wantTo('go to /admin.php?module=saleorder&page=comment-list');
        $I->amOnPage('/admin.php?module=saleorder&page=comment-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify Sale order Comment
    public function ModifyComment(AcceptanceTester $I) {
        $I->wantToTest('Modify Sale order Comment');
        $I->wantTo('go to /admin.php?module=comment&page=modify&id=9');
        $I->amOnPage('/admin.php?module=comment&page=modify&id=9');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Add new comments
    public function AddComment(AcceptanceTester $I) {
        $I->wantToTest('Add new comments');
        $I->wantTo('go to /admin.php?module=comment&page=add&entity=Saleorder_Model&entityid=103');
        $I->amOnPage('/admin.php?module=comment&page=add&entity=Saleorder_Model&entityid=103');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete Comment
    public function DeleteComment(AcceptanceTester $I) {
        $I->wantToTest('Delete Comment');
        $I->wantTo('go to /admin.php?module=comment&page=delete&id=10');
        $I->amOnPage('/admin.php?module=comment&page=delete&id=10');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Go To Sales Order
    public function GoToSalesOrder(AcceptanceTester $I) {
        $I->wantToTest('Go To Sales Order');
        $I->wantTo('go to /admin.php?module=saleorder&page=saleorder-details&id=109');
        $I->amOnPage('/admin.php?module=saleorder&page=saleorder-details&id=109');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to check Comment Details
    public function CommentDetails(AcceptanceTester $I) {
        $I->wantToTest('banner Setting');
        $I->wantTo('go to /admin.php?module=comment&page=detail&id=6');
        $I->amOnPage('/admin.php?module=comment&page=detail&id=6');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
