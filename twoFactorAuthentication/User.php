<?php

define(HARDCODED_USER, "user");
define(HARDCODED_PASSWORD, "pwd");

class User {

    private function loginFormWithUsernameAndPassword() {


        echo <<<EOT

<h1> Login </h1>

<form action="oppgave5.php" method="post">

    <label for="input-username">Username</label>
    <input type="text" 
           name="username" 
           id="input-username" 
           placeholder="John"
           autofocus
           required/> <br/>

    <label for="input-password"">Password</label>
    <input type="password" 
           name="password" 
           id="input-password" 
           placeholder="******" 
           required/> <br/>


    <input id="btn-submit-credentials"
           type="submit"
           value="Log in"/> <br/>

</form>
EOT;
    
    }

    private function loginFormWithVerificationToken($token) {
    

        echo <<<EOT

<h1> Login - Confirm Verification code </h1>


<form action="oppgave5.php" method="post">

    <label for="input-verification-code">Verification Code</label>
    <input type="text"
           name="verification-token"
           id="input-verification-code" 
           placeholder="ex: f45A"
           autofocus
           required/> <br/>

    <input id="btn-submit-verification-code"
           type="submit"
           value="Confirm code"/> <br/>

           <p>(Psst, the code is $token)</p> <br/>
</form>
EOT;

    }


    private function logoutForm() {
        echo <<<EOT

<h1> You are logged in! </h1>

<form action="oppgave5.php" method="post">
    
    <input id="btn-submit-logout"
           name="logout"
           type="submit"
           value="Logout"/> <br/>
</form>
EOT;

    }

    private function generateVertificationToken($byteCount = 4) {
        $bytes = random_bytes($byteCount);
        return bin2hex($bytes);
    }


    private function loginUserPart1($username, $password) {

        if ($username == HARDCODED_USER
        &&  $password == HARDCODED_PASSWORD) {
            return $this->generateVertificationToken();
        }
        return null;
    }

    private function loginUserPart2($token) {
        if ($token === $_SESSION['VERIFICATION_TOKEN']) {
            return true;
        }
        return null;
    }

    public function loginForm() { 

        // Case 0: User is trying to log out
        if ($_SESSION['LOGGED_IN']
        &&  $_POST['logout']) {

            $_SESSION['LOGGED_IN']          = null;
            $_SESSION['VERIFICATION_TOKEN'] = null;
            $this->loginFormWithUsernameAndPassword();
            return;
        }

        // Case 1: User is already logged in
        if ($_SESSION['LOGGED_IN']) {
            $this->logoutForm();
            return;
        }

        // Case 2: User is trying to verify verification code
        if ($_SESSION['VERIFICATION_TOKEN']
        &&  $_POST["verification-token"]) {
                
            $_SESSION['LOGGED_IN'] = $this->loginUserPart2($_POST["verification-token"]);

            // Case 2.1: User failed to verify verification code, roll back to login with username password.
            if (!$_SESSION['LOGGED_IN']) {
                echo "Failed to verify verification code. Please try again...<br>";
                $_SESSION['VERIFICATION_TOKEN'] = null;
                $this->loginFormWithUsernameAndPassword();
                return;
            }

            // Case 2.2: User successfully logged in with two factors
            $_SESSION['LOGGED_IN'] = true;
            $this->logoutForm();
            return;
        }

        // Case 3: User is trying to log in, verify credentials
        if ($_POST["username"]
        &&  $_POST["password"]) {

            $_SESSION['VERIFICATION_TOKEN'] = $this->loginUserPart1($_POST["username"], $_POST["password"]);

            // Case 3.1: User failed to log in, redirects back to login page again
            if (!$_SESSION['VERIFICATION_TOKEN']) {
                echo "Failed to login user with username and password. Please try again...<br>";
                $this->loginFormWithUsernameAndPassword();
                return;
            }

            // Case 3.2: User success log in, and is now presented with verification code
            $this->loginFormWithVerificationToken($_SESSION['VERIFICATION_TOKEN']);
            return;
        }


        // Case 4: In all other case, just show login with username and password.
        $this->loginFormWithUsernameAndPassword();
    }
};