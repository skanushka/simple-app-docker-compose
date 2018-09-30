<!--
- Created by Supun Kanushka
- Copyright (c) 2018, All Rights Reserved.
-->
<html>
<head>
    <title>Sample PHP app with docker compose</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Sample PHP app with docker compose</h1>
<?php
$host = 'mysql';
$user = 'root';
$pass = 'sample';
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS docker_compose_sample";
if ($conn->query($sql) === FALSE) {
    echo "Database creation failed : " . $conn->error;;
}

// use default database
mysqli_select_db($conn, "docker_compose_sample");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS User (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(30) NOT NULL)";
if ($conn->query($sql) === FALSE) {
    echo "Table User creation failed : " . $conn->error;
}

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $sql = "INSERT INTO User (name) VALUES ('$name')";

    if ($conn->query($sql) === FALSE) {
        echo "Unable to add user : " . $conn->error;
    }
}
?>

<div class="container">
    <h3>Add user</h3>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
    </form>
</div>

<?php
$sql = "SELECT * FROM User";
$result = $conn->query($sql);
?>
<ul class="list-group">
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <li class="list-group-item">
            <?php
            echo "id: " . $row["id"] . " - Name: " . $row["name"];
            ?>
        </li>
        <?php
    }
    $conn->close();
    ?>
</ul>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>