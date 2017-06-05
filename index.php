<!DOCTYPE html>
<html>
<head>
</head>

<body>

<form action="upload-media.php" method="post" enctype="multipart/form-data">
    <label for="title">Media Title</label>
    <input type="text" name="title" id="title"/>

    <label for="upload">Upload file</label>
    <input type="file" name="upload" id="upload"/>

    <input type="submit" name="btnSubmit" value="Upload file!"/>
</form>

<br>

<?php include 'config/config.php';

$query = "SELECT * FROM media;";

// Connect to database.
$conn = connect();

// Initialize statement.
$stmt = mysqli_stmt_init($conn);

// Prepare statement.
mysqli_stmt_prepare($stmt, $query);

// Execute statement.
mysqli_stmt_execute($stmt);

// Bind columns.
mysqli_stmt_bind_result($stmt, $id, $title, $destination, $ip);

// Fetch data from bind_result.
while (mysqli_stmt_fetch($stmt)) {
    echo "<a href='" . $destination . "' target='_blank'>$title</a> - uploaded by " . $ip . "<br>";
}


?>

</body>
</html>