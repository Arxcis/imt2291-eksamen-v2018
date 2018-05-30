<?php

require_once "./vendor/autoload.php";
require_once "./User.php";

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase {

    private $user;
    public function setup() {
        @session_start();
        $this->user = new User();
    }

    public function testLoginPart1() {

        $verificationToken = $this->user->loginUserPart1('user', 'pwd');
        $this->assertNotNull($verificationToken);
    }

    public function testLoginPart2() {

        $_SESSION['VERIFICATION_TOKEN'] = $this->user->loginUserPart1('user', 'pwd');
        $this->assertNotNull($_SESSION['VERIFICATION_TOKEN']);

        $_SESSION['LOGGED_IN'] = $this->user->loginUserPart2($_SESSION['VERIFICATION_TOKEN']);
        $this->assertNotNull($_SESSION['LOGGED_IN']);
    }

    public function testNotLoggedInByDefault() {

        $this->assertNull($_SESSION['LOGGED_IN']);
        $this->assertNull($_SESSION['VERIFICATION_TOKEN']);
    }
}

?>
