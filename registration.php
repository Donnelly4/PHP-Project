<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link -->
    <link  rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
<!-- header section starts here -->
<section class="header">
    <a href="home.php" class="logo">FC Barcelona Women Website</a>

    <nav class="navbar">
        <a href="home.php">HOME</a>
        <a href="login.php">LOGIN</a>
        <a href="players.php">PLAYERS</a>
    </nav>

    <div class="menu-btn" class="fas fa-bars"></div>

</section>
<!-- header section ends here -->

<div id="form">
    <?php

    //include connection file
    require_once "connection.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $errors = array();

            //validate user input
            if (empty($username) || empty($email) || empty($password)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
                array_push($errors,"Password must be at least 8 characters long");
            } 

            if (count($errors) == 0) {
                // password hashing
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                //insert user data
                $sql = "INSERT INTO useraccount (username, email, password) VALUES (?, ?, ?)";
                $stmt=mysql_stmt_init($conn);
                if ($stmt) {
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    // redirect to login page after successful registration
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Error occured</div>";
                }
           }
             
            mysqli_stmt_close($stmt);
        }
    ?>  
    <form action="login.php" method="POST">
        <h1>Sign Up<h1>
        <div>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" class="form control">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" class="form control">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" class="form control">
        </div>
        <button type="submit">Register</button>
        <footer> Already a member? <a href="login.php">Login Here</a></footer>
    </form>
</div>


    <div class="credit"> CREATED BY <span>Donnelly Amaitsa<span> </div>
</section>
<!-- footer section ends here -->


</body>
</html>
