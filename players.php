<!DOCTYPE html>
<html>
<head>
    <title> Player profiles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // include database connection
        require_once "connection.php";

        //retrieve player data from the database
        $sql = "SELECT * FROM players";
        $result = mysqli_query($conn, $sql);

 
        if (mysqli_num_rows($result) > 0) {
            //display player information
            while ($player = mysqli_fetch_assoc($result)) {
                echo '<img src="' . $player['image'] . '" alt="' . $player['name'] . '">';
                echo '<div class="player-info">';
                echo '<h2>' . $player['name'] . '</h2>';
                echo '<p><strong>Position:</strong> ' . $player['position'] . '</p>';
                echo '<p><strong>Date of Birth:</strong> ' . $player['dateOfBirth'] . '</p>';
                echo '<p><strong>Nationality:</strong> ' . $player['nationality'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No players found";
        }

        //close database connection
        mysqli_close($conn);
    ?>
    <div class="players-container">
        <?php foreach ($players as $player): ?>
            <img src="<?php echo $player['image']; ?>" alt="<?php echo $player['name']; ?>">
            <div class="player-info">
                <h2><?php echo $player['name']; ?></h2>
                <p><strong>Position:</strong> <?php echo $player['position']; ?></p>
                <p><strong>Date Of Birth:</strong> <?php echo $player['dateOfBirth']; ?></p>
                <p><strong>Nationality:</strong> <?php echo $player['nationality']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
