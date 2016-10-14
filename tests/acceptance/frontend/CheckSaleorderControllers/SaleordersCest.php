<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SaleordersCest {

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
        $I->click('//*[@id="login_form"]/button');
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

// want to Check Open Orders List
    public function OpenSalesOrders(AcceptanceTester $I) {
        $I->wantToTest('Open Orders List');
        $I->wantTo('go to /index.php?module=saleorder&page=list&event=open');
        $I->amOnPage('/index.php?module=saleorder&page=list&event=open');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Paid Sales order
    public function PaidSalesOrder(AcceptanceTester $I) {
        $I->wantToTest('Paid Sales order');
        $I->wantTo('go to /index.php?module=saleorder&page=list&event=paid');
        $I->amOnPage('/index.php?module=saleorder&page=list&event=paid');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Shipped Sales Order
    public function ShippedSalesOrder(AcceptanceTester $I) {
        $I->wantToTest('Shipped Sales Order');
        $I->wantTo('go to /index.php?module=saleorder&page=list&event=shipped');
        $I->amOnPage('/index.php?module=saleorder&page=list&event=shipped');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Order list
    public function Orderlist(AcceptanceTester $I) {
        $I->wantToTest('Order list');
        $I->wantTo('go to /index.php?module=saleorder&page=list');
        $I->amOnPage('/index.php?module=saleorder&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Order Details
    public function OrderDetails(AcceptanceTester $I) {
        $I->wantToTest('Order Details');
        $I->wantTo('go to /index.php?module=saleorder&page=details&id=128');
        $I->amOnPage('/index.php?module=saleorder&page=details&id=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Confirmpayment
    public function Confirmpayment(AcceptanceTester $I) {
        $I->wantToTest('Confirmpayment');
        $I->wantTo('go to /index.php?module=crm&page=intern-shop-confirmpayment&sale_order_id=128');
        $I->amOnPage('/index.php?module=crm&page=intern-shop-confirmpayment&sale_order_id=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Cancel Sales Order
    public function CancelSalesOrder(AcceptanceTester $I) {
        $I->wantToTest('Cancel Sales Order');
        $I->wantTo('go to /index.php?module=saleorder&page=cancel&id=128');
        $I->amOnPage('/index.php?module=saleorder&page=cancel&id=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Pay Now Sales Order
    public function PayNow(AcceptanceTester $I) {
        $I->wantToTest('Newsletter Subscription');
        $I->wantTo('go to /index.php?module=cart&page=paynow&id=128&type=so');
        $I->amOnPage('/index.php?module=cart&page=paynow&id=128&type=so');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Print Sales Order
    public function PrintSalesOrder(AcceptanceTester $I) {
        $I->wantToTest('Print Sales Order');
        $I->wantTo('go to /index.php?module=saleorder&page=details&id=128&event=print');
        $I->amOnPage('/index.php?module=saleorder&page=details&id=128&event=print');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Add Comment
    public function AddComment(AcceptanceTester $I) {
        $I->wantToTest('Add Comment');
        $I->wantTo('go to /index.php?module=saleorder&page=comment-add&entity=Saleorder_Model&entityid=128');
        $I->amOnPage('/index.php?module=saleorder&page=comment-add&entity=Saleorder_Model&entityid=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Comment Details
    public function CommentDetails(AcceptanceTester $I) {
        $I->wantToTest('Comment Details');
        $I->wantTo('go to /index.php?module=saleorder&page=comment-details&id=12&saleorder=128');
        $I->amOnPage('/index.php?module=saleorder&page=comment-details&id=12&saleorder=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check Download Document
    public function DownloadDocument(AcceptanceTester $I) {
        $I->wantToTest('Download Document');
        $I->wantTo('go to /index.php?module=saleorder&page=document-detail&id=37&saleorder=128');
        $I->amOnPage('/index.php?module=saleorder&page=document-detail&id=37&saleorder=128');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

    // want to Check thankyou page
    public function ThankyouPage(AcceptanceTester $I) {
        $I->wantToTest('Thankyou page');
        $I->wantTo('go to /index.php?module=saleorder&page=thankyou');
        $I->amOnPage('/index.php?module=saleorder&page=thankyou');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('All Rights Reserved');
    }

}
