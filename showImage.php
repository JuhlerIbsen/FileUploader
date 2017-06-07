<?php include 'config/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>

<body>
<?php

// sql used in this session.
$query = 'SELECT title, file_dir, ipaddress FROM media WHERE mediaId = ?';

// Connect to database.
$conn = connect();

// Initialize statement.
$stmt = mysqli_stmt_init($conn);

// Prepare statement with the query provided.
mysqli_stmt_prepare($stmt, $query);

// Bind the user input.
mysqli_stmt_bind_param($stmt, "i", $_GET['mediaId']);

// Execute query.
mysqli_stmt_execute($stmt);

// Bind the chosen results.
mysqli_stmt_bind_result($stmt, $title, $fileDir, $ip);

// Go through the fields.
while (mysqli_stmt_fetch($stmt)) {
    ?>
    <center>
        <div class="imgBox" style="border: solid 2px black; width: 25%; height: 25%;">
            <h1><?php echo $title; ?></h1>
            <img src="<?php echo $fileDir; ?>" style="width: 40%; height: 40%;"/>
            <p>Posters IP: <?php echo $ip; ?></p>
        </div>
    </center>
    <?php
}
?>
</body>
</html>
