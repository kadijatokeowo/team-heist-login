<?php
// start session
session_start();

// if logged in already, redirect 
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location:welcome.php");
}

// if remeber was set before, login directly
if (isset($_COOKIE["heistuser"])) {
    if (file_exists('database/users.json')) {
        $users = json_decode(file_get_contents("database/users.json"));
        $usernames = array_column($users, "username");
        if (in_array($_COOKIE["heistuser"], $usernames)) {
            $user = $users[array_search($_COOKIE["heistuser"], $usernames)];
                // store all vars in session
                $_SESSION['loggedin'] = true;
                $_SESSION['fullname'] = $user->fullname;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                $_SESSION['phone'] = $user->phone;
                header("location:welcome.php");
        } else {
            echo "User does not exist";
        }
    } else {
        echo "Database not present";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // validation
    // check if username is not empty and password is not empty
    if (isset($_POST["username"]) and isset($_POST['password'])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        // Check that both field are not empty
        if (strlen($username) < 1 || strlen($password) < 1) {
            echo "Fill all required fields";
        }
        // check that the username exist
        if (file_exists('database/users.json')) {
            $users = json_decode(file_get_contents("database/users.json"));
            $usernames = array_column($users, "username");
            if (in_array($username, $usernames)) {
                $user = $users[array_search($username, $usernames)];

                if (md5($password) == $user->password) {
                    // if remember me isset
                    if (isset($_POST["remember_me"])) {
                        setcookie("heistuser", $_POST["username"], time() + (30 * 24 * 60 * 60));
                    } else {
                        if (isset($_COOKIE["heistuser"])) {
                            setcookie("heistuser", "");
                        }
                    }
                    
                    // store all vars in session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['fullname'] = $user->fullname;
                    $_SESSION['username'] = $user->username;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['phone'] = $user->phone;
                    header("location:welcome.php");
                } else {
                    echo "Incorrect Password";
                }
            } else {
                echo "User does not exist";
            }
        } else {
            echo "Database not present";
        }
    }
}
