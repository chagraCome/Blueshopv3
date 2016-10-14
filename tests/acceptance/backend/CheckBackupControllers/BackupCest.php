<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BackupCest {

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

    // want to Generate Local Backup
    public function GenerateLocalBackup(AcceptanceTester $I) {
        $I->wantToTest('Generate Local Backup');
        $I->wantTo('go to /admin.php?module=backup&page=local');
        $I->amOnPage('/admin.php?module=backup&page=local');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Generate Remote Backup
    public function GenerateRemoteBackup(AcceptanceTester $I) {
        $I->wantToTest('Generate Remote Backup');
        $I->wantTo('go to /admin.php?module=backup&page=remote');
        $I->amOnPage('/admin.php?module=backup&page=remote');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Backups
    public function ListBackups(AcceptanceTester $I) {
        $I->wantToTest('List Backups');
        $I->wantTo('go to /admin.php?module=backup&page=list');
        $I->amOnPage('/admin.php?module=backup&page=list');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check List Remote Backups
    public function ListRemoteBackups(AcceptanceTester $I) {
        $I->wantToTest('List Remote Backups');
        $I->wantTo('go to /admin.php?module=backup&page=remotelist');
        $I->amOnPage('/admin.php?module=backup&page=remotelist');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Restore Backup
    public function RestoreBackup(AcceptanceTester $I) {
        $I->wantToTest('Restore Backup');
        $I->wantTo('go to /admin.php?module=backup&page=restore&name=2016_04_12_16_17_25.zip');
        $I->amOnPage('/admin.php?module=backup&page=restore&name=2016_04_12_16_17_25.zip');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Upload Backup
    public function UploadBackup(AcceptanceTester $I) {
        $I->wantToTest('Upload Backup');
        $I->wantTo('go to /admin.php?module=backup&page=upload');
        $I->amOnPage('/admin.php?module=backup&page=upload');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Download Backup
    public function DownloadBackup(AcceptanceTester $I) {
        $I->wantToTest('Download Backup');
        $I->wantTo('go to /admin.php?module=backup&page=download&name=2016_04_12_16_17_25.zip');
        $I->amOnPage('/admin.php?module=backup&page=download&name=2016_04_12_16_17_25.zip');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check delete Backup
    public function DeleteBackup(AcceptanceTester $I) {
        $I->wantToTest('Delete Backup');
        $I->wantTo('go to /admin.php?module=backup&page=delete&name=2016_04_11_11_39_39.zip');
        $I->amOnPage('/admin.php?module=backup&page=delete&name=2016_04_11_11_39_39.zip');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

    // want to Check Backup Settings
    public function BackupSettings(AcceptanceTester $I) {
        $I->wantToTest('Backup Settings');
        $I->wantTo('go to /admin.php?module=backup&page=setting');
        $I->amOnPage('/admin.php?module=backup&page=setting');
        $I->wantTo('check if page reachable');
        $I->seeResponseCodeIs(200);
        $I->wantTo('check notfound not exist in url');
        $I->dontSeeInCurrentUrl('notfound');
        $this->dontSeeAnyWarningsOrErrors($I);
        $I->wantTo('check Copyright exist in footer ');
        $I->see('Copyright');
    }

}
