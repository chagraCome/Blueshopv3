<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductsCest {

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

    // want to Check List Product
    public function ListProduct(AcceptanceTester $I) {
        $I->wantToTest('List Product');
        $I->wantTo('go to /index.php?module=product&page=list');
        $I->amOnPage('/index.php?module=product&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Category block exist in product list ');
        $I->see('Categories');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check List Product by Category
    public function ProductByCategory(AcceptanceTester $I) {
        $I->wantToTest('List Product by Category');
        $I->wantTo('go to /index.php?module=product&page=list&cat=18');
        $I->amOnPage('/index.php?module=product&page=list&cat=18');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check List Compare
    public function Compare(AcceptanceTester $I) {
        $I->wantToTest('List Compare');
        $I->wantTo('go to /index.php?module=product&page=compare');
        $I->amOnPage('/index.php?module=product&page=compare');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Add product to compare
    public function AddToCompare(AcceptanceTester $I) {
        $I->wantToTest('Add product to compare');
        $I->wantTo('go to /index.php?module=product&page=compare&id=88');
        $I->amOnPage('/index.php?module=product&page=compare&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Delete product rom list compare
    public function DeleteFromCompare(AcceptanceTester $I) {
        $I->wantToTest('Delete product rom list compare');
        $I->wantTo('go to /index.php?module=product&page=compare&event=delete&id=88');
        $I->amOnPage('/index.php?module=product&page=compare&event=delete&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check List whishlist
    public function Whishlist(AcceptanceTester $I) {
        $I->wantToTest('Whishlist');
        $I->wantTo('go to /index.php?module=product&page=whishlist');
        $I->amOnPage('/index.php?module=product&page=whishlist');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Add product to whishlist
    public function AddToWhishlist(AcceptanceTester $I) {
        $I->wantToTest('Add product to whishlist');
        $I->wantTo('go to /index.php?module=product&page=whishlist&id=88');
        $I->amOnPage('/index.php?module=product&page=whishlist&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Delete product from whishlist
    public function DeleteFromWhishlist(AcceptanceTester $I) {
        $I->wantToTest('Delete product from whishlist');
        $I->wantTo('go to /index.php?module=product&page=whishlist&event=delete&id=88');
        $I->amOnPage('/index.php?module=product&page=whishlist&event=delete&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Product Detail
    public function ProductDetail(AcceptanceTester $I) {
        $I->wantToTest('Product Details');
        $I->wantTo('go to /index.php?module=product&page=detail&id=88');
        $I->amOnPage('/index.php?module=product&page=detail&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
        $I->wantTo('check Description exist ');
        $I->see('Description');
        $I->wantTo('check Comment and Rating exist ');
        $I->see('Comment and Rating');
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check send to friend
    public function Sendtofriend(AcceptanceTester $I) {
        $I->wantToTest('Send to friend');
        $I->wantTo('go to /index.php?module=product&page=sendtofriend&id=88');
        $I->amOnPage('/index.php?module=product&page=sendtofriend&id=88');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check page offer
    public function ProductOffer(AcceptanceTester $I) {
        $I->wantToTest('Page offer');
        $I->wantTo('go to /index.php?module=product&page=offer');
        $I->amOnPage('/index.php?module=product&page=offer');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Item List
    public function ItemList(AcceptanceTester $I) {
        $I->wantToTest('Item List');
        $I->wantTo('go to /index.php?module=product&page=list&layout=2');
        $I->amOnPage('/index.php?module=product&page=list&layout=2');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Preview product
    public function Preview(AcceptanceTester $I) {
        $I->wantToTest('Preview product');
        $I->wantTo('go to /index.php?module=product&ajax=true&page=preview&id=495');
        $I->amOnPage('/index.php?module=product&ajax=true&page=preview&id=495');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
    }

}
