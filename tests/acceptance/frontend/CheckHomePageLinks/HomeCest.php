<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeCest {

    public function _before(AcceptanceTester $I) {
        /* $I->wantToTest('Login');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-login');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-login');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $I->wantTo('fill email with amira.mzoughi@amhsoft.com');
        $I->fillField('email', 'amira.mzoughi@amhsoft.com');
        $I->wantTo('fill password with 123456');
        $I->fillField('password', '123456');
        $I->wantTo('Click login');
        $I->click('login');
        $I->wantToTest('Welcome message exist');
        $I->see('Welcome amira.mzoughi@amhsoft.com'); */
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

    // want to change lang
    public function ChangLang(AcceptanceTester $I) {
        $I->wantToTest('Change Lang');
        $I->wantTo('go to /index.php');
        $I->amOnPage('/index.php');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('Click to icon arabic');
        $I->click('العربية');
        $I->see('مرحبا بك');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Header Link 
    public function HeaderLink(AcceptanceTester $I) {
        $I->wantToTest('Header Link');
        $I->wantTo('go to /index.php');
        $I->amOnPage('/index.php');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check My Account Link in header');
        $I->click('Create an Account');
        $I->canSeeInCurrentUrl('index.php?module=crm&page=intern-shop-register');
        $I->wantTo('check My Account Link in header');
        $I->click('My Account');
        $I->canSeeInCurrentUrl('index.php?module=crm&page=intern-shop-home');
        $I->wantTo('check My Orders List in header');
        $I->click('Orders List');
        $I->canSeeInCurrentUrl('index.php?module=saleorder&page=list');
        $I->wantTo('check Wishlist Link in header');
        $I->click('Wishlist');
        $I->canSeeInCurrentUrl('index.php?module=product&page=whishlist');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Home page 
    public function HomePage(AcceptanceTester $I) {
        $I->wantToTest('Home page');
        $I->wantTo('go to /index.php');
        $I->amOnPage('/index.php');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check header exist in home page');
        $I->seeElement('header');
        $I->wantTo('check page content');
        $I->seeElement('.page_content_offset');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Footer Link 
    public function FooterLink(AcceptanceTester $I) {
        $I->wantToTest('Footer Link');
        $I->wantTo('go to /index.php');
        $I->amOnPage('/index.php');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check newsletter exist in footer');
        $I->see('Newsletter');
        $I->wantTo('check My Account Link in footer');
        $I->click('My account');
        $I->canSeeInCurrentUrl('index.php?module=crm&page=intern-shop-account');
        $I->wantTo('check Order History Link in footer');
        $I->click('Order History');
        $I->canSeeInCurrentUrl('index.php?module=saleorder&page=list');
        $I->wantTo('check Wishlist link in footer');
        $I->click('Wishlist');
        $I->canSeeInCurrentUrl('index.php?module=product&page=whishlist');
        $I->wantTo('check Contact Us Link in footer');
        $I->click('Contact Us');
        $I->canSeeInCurrentUrl('index.php?module=crm&page=contact');
        $I->wantTo('check Homepage Link in footer');
        $I->click('Homepage');
        $I->canSeeInCurrentUrl('index.php');
        $I->wantTo('check All products Link in footer');
        $I->click('All products');
        $I->canSeeInCurrentUrl('index.php?module=product&page=list');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

}
