<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css file link -->
    <link  rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<!-- header section starts here -->
<section class="header">
    <a href="home.php" class="logo">OFFICIAL LOGIN PAGE</a>

    <nav class="navbar">
        <a href="home.php">HOME</a>
        <a href="players.php">PLAYERS</a>
    </nav>

    <div class="menu-btn" class="fas fa-bars"></div>

</section>
<!-- header section ends here -->

<div id="form">
    <?php
    
        require_once "connection.php";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // check user credentials
            $sql = "SELECT * FROM useraccount WHERE username = '$username' AND password = $password";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = "yes";
                    header("Location: players.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Invalid username or password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>User NOT found</div>";
            }       
        }
    ?>
    <form action = "players.php" method="POST">
        <h1>Login</h1>
        <div>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" class="form-control">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
            <button type="submit">Login</button>
    </form>
</div>



</body>
</html>
