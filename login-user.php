<?php
// start session
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location:welcome.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // validation
    // check if username is not empty and password is not empty
    if (isset($_POST["username"]) and isset($_POST['password'])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        // Check that both field are not empty
        if (strlen($username) < 1 || strlen($password) < 1) {
            $message = "Fill all required fields";
        }
        // check that the username exist
        if (file_exists('database/users.json')) {
            $users = json_decode(file_get_contents("database/users.json"));
            $usernames = array_column($users, "username");
            $username = "opeyemi";
            if (in_array($username, $usernames)) {
                $user = $users[array_search($username, $usernames)];

                if ($password == $user->password) {
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
                $message = "User does not exist";
            }
        } else {
            echo "Database not present";
        }
    }
}
