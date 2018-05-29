<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use Behat\Mink\Element\DocumentElement;
use Behat\Mink\Element\NodeElement;


/*
* Contains all three functional tests
*/
class Oppgave7_UserClassTests extends TestCase { 

    protected $session;

    private function printPage() {
        echo $this->session->getPage()->getHtml();
    }


    protected function setup() {

        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();

        $this->session->visit("http://localhost:4000/oppgave5-loginuser.php");
    }


    public function testIfPageExist() {

        $this->assertEquals(
            $this->session->getResponseHeaders()['Content-type'][0], 'text/html; charset=UTF-8');

        $this->assertNotNull($this->session->getPage());
    }



    public function testIfNotLoggedInInitially() {

        $formid = "loginform-with-usernameandpassword";
        $form = $this->session->getPage()->findById('loginform-with-usernameandpassword');
        $this->assertNotNull($form);
    }

    public function testIfWeGetVerificationFormAfterLoggedIn() {


        $form = $this->session->getPage()->findById('loginform-with-usernameandpassword');

        $inputUsername = $form->findById('input-username');
        $inputPassword = $form->findById('input-password');

        $inputUsername->setValue('user');
        $inputPassword->setValue('pwd');

        $this->assertNotNull($inputUsername);
        $this->assertNotNull($inputPassword);

        $form->submit();

        $form = $this->session->getPage()->findById('loginform-with-verificationcode');
        $this->assertNotNull($form);
    }

    public function testIfVerificationCodeWorks() {

        $form = $this->session->getPage()->findById('loginform-with-usernameandpassword');

        $inputUsername = $form->findById('input-username');
        $inputPassword = $form->findById('input-password');

        $inputUsername->setValue('user');
        $inputPassword->setValue('pwd');

        $form->submit();

        $form = $this->session->getPage()->findById('loginform-with-verificationcode');
        
        $verificationCodeHint = $form->findById('verification-code-hint');
        $inputVerificationCode = $form->findById('input-verification-code');

        $this->assertNotNull($form);
        $this->assertNotNull($verificationCodeHint);
        $this->assertNotNull($inputVerificationCode);


        $inputVerificationCode->setValue($verificationCodeHint->getHtml());

        $form->submit();

        $form = $this->session->getPage()->findById("logoutform");

        $this->assertNotNull($form);
    }
}