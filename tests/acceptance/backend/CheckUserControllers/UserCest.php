<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserCest {

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

    // want to Add new User
    public function AddUser(AcceptanceTester $I) {
        $I->wantToTest('Add New User');
        $I->wantTo('go to /admin.php?module=user&page=user-add');
        $I->amOnPage('/admin.php?module=user&page=user-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning:');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
     
    }

    // want to Check List User
    public function ListUser(AcceptanceTester $I) {
        $I->wantToTest('List User');
        $I->wantTo('go to /admin.php?module=user&page=user-list');
        $I->amOnPage('/admin.php?module=user&page=user-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Modify User
    public function ModifyUser(AcceptanceTester $I) {
        $I->wantToTest('Modify user');
        $I->wantTo('go to /admin.php?module=user&page=user-modify&id=4');
        $I->amOnPage('/admin.php?module=user&page=user-modify&id=4');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning:');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

// want to Test user details
    public function UserDetails(AcceptanceTester $I) {
        $I->wantToTest('user details');
        $I->wantTo('go to /admin.php?module=user&page=user-details&id=4');
        $I->amOnPage('/admin.php?module=user&page=user-details&id=4');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning:');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Delete user
    public function DeleteUser(AcceptanceTester $I) {
        $I->wantToTest('Delete User');
        $I->wantTo('go to /admin.php?module=user&page=user-delete&id=1');
        $I->amOnPage('/admin.php?module=user&page=user-delete&id=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set user offline
    public function SetUserOffline(AcceptanceTester $I) {
        $I->wantToTest('Set User Offline');
        $I->wantTo('go to /admin.php?module=user&page=user-online&id=3');
        $I->amOnPage('/admin.php?module=user&page=user-online&id=3');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Set User online
    public function SetUserOnline(AcceptanceTester $I) {
        $I->wantToTest('User Online');
        $I->wantTo('go to /admin.php?module=user&page=user-online&id=3');
        $I->amOnPage('/admin.php?module=user&page=user-online&id=3');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check user profile
    public function Profile(AcceptanceTester $I) {
        $I->wantToTest('user profile');
        $I->wantTo('go to /admin.php?module=user&page=user-profile');
        $I->amOnPage('/admin.php?module=user&page=user-profile');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('check no Fatal error exist');
        $I->dontSee('Fatal error:');
        $I->wantTo('check no syntax error exist');
        $I->dontSee('Parse error: syntax error');
        $I->wantTo('check no Warning exist');
        $I->dontSee('Warning:');
        $I->wantTo('check no smarty error exist');
        $I->dontSee('Smarty Compiler: Syntax error in template');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Change Password
    public function ChangePassword(AcceptanceTester $I) {
        $I->wantToTest('Change Password');
        $I->wantTo('go to /admin.php?module=user&page=user-changepassword');
        $I->amOnPage('/admin.php?module=user&page=user-changepassword');
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

    // want to Check forgotpassword
    public function forgotpassword(AcceptanceTester $I) {
        $I->wantToTest('forgotpassword');
        $I->wantTo('go to /admin.php?module=user&page=user-forgotpassword');
        $I->amOnPage('/admin.php?module=user&page=user-forgotpassword');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
    }

}
