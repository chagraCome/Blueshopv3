<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CartFrontendCest {

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
        $I->fillField('password', '123456');
        $I->wantTo('Click login');
        $I->click('login');
        $I->wantToTest('Welcome message exist');
        $I->see('Welcome amira.mzoughi@amhsoft.com');
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

    // want to Check Cart List 
    public function ListCart(AcceptanceTester $I) {
        $I->wantToTest('Cart List');
        $I->wantTo('go to /index.php?module=cart&page=list');
        $I->amOnPage('/index.php?module=cart&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Shopping Cart Title exist');
        $I->see('Shopping Cart');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Add Product To Cart
    public function AddToCart(AcceptanceTester $I) {
        $I->wantToTest('Add Product To Cart');
        $I->wantTo('go to /index.php?module=product&page=detail&id=88&event=cart&qnt=1');
        $I->amOnPage('/index.php?module=product&page=detail&id=88&event=cart&qnt=1');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Action was successfully done');
        $I->see('Action was successfully done');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check checkout address
    public function CheckoutAddress(AcceptanceTester $I) {
        $I->wantToTest('Checkout address page');
        $I->wantTo('go to /index.php?module=cart&page=checkout-address');
        $I->amOnPage('/index.php?module=cart&page=checkout-address');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check checkout shipping page
    public function CheckoutShipping(AcceptanceTester $I) {
        $I->wantToTest('Checkout Shipping');
        $I->wantTo('go to /index.php?module=cart&page=checkout-shipping');
        $I->amOnPage('/index.php?module=cart&page=checkout-shipping');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check checkout payment
    public function CheckoutPayment(AcceptanceTester $I) {
        $I->wantToTest('Checkout payment');
        $I->wantTo('go to /index.php?module=cart&page=checkout-payment');
        $I->amOnPage('/index.php?module=cart&page=checkout-payment');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Quickpay Page
    public function Quickpay(AcceptanceTester $I) {
        $I->wantToTest('Quickpay Page');
        $I->wantTo('go to /index.php?module=cart&page=checkout-quickpay');
        $I->amOnPage('/index.php?module=cart&page=checkout-quickpay');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check preview Page
    public function Preview(AcceptanceTester $I) {
        $I->wantToTest('Preview Page');
        $I->wantTo('go to /index.php?module=cart&page=checkout-preview');
        $I->amOnPage('/index.php?module=cart&page=checkout-preview');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Thankyou Page
    public function Thankyou(AcceptanceTester $I) {
        $I->wantToTest('Thankyou Page');
        $I->wantTo('go to /index.php?module=cart&page=checkout-thankyou');
        $I->amOnPage('/index.php?module=cart&page=checkout-thankyou');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Delete Product from shopping cart
    public function DeleteFomCart(AcceptanceTester $I) {
        $I->wantToTest('Delete Product from shopping cart');
        $I->wantTo('go to /index.php?module=cart&page=delete&id=88');
        $I->amOnPage('/index.php?module=cart&page=delete&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer');
        $I->see('All Rights Reserved');
    }

}
