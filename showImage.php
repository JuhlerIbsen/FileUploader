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

    <link rel="stylesheet" href="stylesheet/showimage.css"/>
</head>

<body>
<?php

if (isset($_GET['mediaId'])) {
    $mediaId = $_GET['mediaId'];
} else {
    $mediaId = 0;
}

// sql used in this session.
if ($mediaId > 0) {
    $query = 'SELECT title, file_dir, ipaddress FROM media WHERE mediaId = ?';
} else {
    $query = "SELECT title, file_dir, ipaddress FROM media;";
}

// Connect to database.
$conn = connect();

// Initialize statement.
$stmt = mysqli_stmt_init($conn);

// Prepare statement with the query provided.
mysqli_stmt_prepare($stmt, $query);

// Don't run this when there's no mediaid.
if ($mediaId > 0) {
// Bind the user input.
    mysqli_stmt_bind_param($stmt, "i", $_GET['mediaId']);
}

// Execute query.
mysqli_stmt_execute($stmt);

// Bind the chosen results.
mysqli_stmt_bind_result($stmt, $title, $fileDir, $ip);

// Go through the fields.
while (mysqli_stmt_fetch($stmt)) {
    ?>

    <div class="imgBox" align="center">

        <h1><?php echo $title; ?></h1>
        <img src="<?php echo $fileDir; ?>""/>
        <p>Posters IP: <?php echo $ip; ?></p>
        <p><a href='<?php echo $fileDir; ?>' target='_blank'>Link to original image</a></p>

    </div>

    <?php

}
?>
</body>
</html>
