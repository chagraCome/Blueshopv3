<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CrmFrontendCest {

    public function _before(AcceptanceTester $I) {
        $I->wantToTest('Login');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-login');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-login');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('fill email with amira.mzoughi@amhsoft.com');
        $I->fillField('email', 'amira.mzoughi@amhsoft.com');
        $I->wantTo('fill password with 123456');
        $I->fillField('password', '1234567');
        $I->wantTo('Click login');
        $I->click('//*[@id="login_form"]/button');
        //$I->click('login');
        /*  $I->submitForm('#login_form', array('user' => array(
          'email' => 'amira.mzoughi@amhsoft.com',
          'password' => '123456',
          'login' => 'Login'
          ))); */
        $I->wantToTest('Welcome messge appear');
        $I->see('Login or password incorrect!');
    }

    public function _after(AcceptanceTester $I) {
        $I->wantToTest('Logout');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-logout');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-logout');
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

// want to Check Register page
    public function Register(AcceptanceTester $I) {
        $I->wantToTest('Register page');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-register');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-register');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Forgotpassword
    public function Forgotpassword(AcceptanceTester $I) {
        $I->wantToTest('Forgotpassword');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-forgotpassword');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-forgotpassword');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check forgot password done
    public function Forgotpassworddone(AcceptanceTester $I) {
        $I->wantToTest('Forgot password done');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-forgotpassworddone');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-forgotpassworddone');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

// want to Check Crm home page
    public function HomePage(AcceptanceTester $I) {
        $I->wantToTest('Crm home page');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-home');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-home');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check My Profiles
    public function Profile(AcceptanceTester $I) {
        $I->wantToTest('Crm home page');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-account');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-account');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check changepassword
    public function ChangePassword(AcceptanceTester $I) {
        $I->wantToTest('change password');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-changepassword');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-changepassword');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Address list
    public function Addresslist(AcceptanceTester $I) {
        $I->wantToTest('Address list');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-address-list');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-address-list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Add New Address
    public function AddAddress(AcceptanceTester $I) {
        $I->wantToTest('Add New Address');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-address-add');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-address-add');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Modify Address
    public function ModifyAddress(AcceptanceTester $I) {
        $I->wantToTest('Modify Address');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-address-modify&id=104');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-address-modify&id=104');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Delete Address
    public function DeleteAddress(AcceptanceTester $I) {
        $I->wantToTest('Delete Address');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-address-delete&id=89');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-address-delete&id=89');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Newsletter Subscription
    public function NewsletterSubscription(AcceptanceTester $I) {
        $I->wantToTest('Newsletter Subscription');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-newsletter');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-newsletter');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Policy Page
    public function Policy(AcceptanceTester $I) {
        $I->wantToTest('Policy Page');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-policy');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-policy');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Contact Us Form
    public function ContactUs(AcceptanceTester $I) {
        $I->wantToTest('Contact Us Form');
        $I->wantTo('go to /index.php?module=crm&page=contact');
        $I->amOnPage('/index.php?module=crm&page=contact');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Contact Send 
    public function ContactSend(AcceptanceTester $I) {
        $I->wantToTest('Contact Send');
        $I->wantTo('go to /index.php?module=crm&page=contactsend');
        $I->amOnPage('/index.php?module=crm&page=contactsend');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

}
