<!DOCTYPE html>
<html>
<head>
    <script src="scripts/index-js.js"></script>
    <link rel="stylesheet" href="stylesheet/index.css"/>
</head>

<body>
<form action="upload-media.php" method="post" enctype="multipart/form-data">
    <label for="title">Media Title</label>
    <input type="text" name="title" id="title"/>

    <label for="upload">Upload file</label>
    <input type="file" name="upload" onchange="getInfo();" id="upload"/>

    <input type="submit" name="btnSubmit" value="Upload file"/>
</form>
<p id='name'></p>
<p id='size'></p>
<p id='type'></p>

<table>
    <tr>
        <th>Media title</th>
        <th>Link</th>
        <th>Author</th>
        <th>Uploaded</th>
    </tr>

    <?php include 'config/config.php';

    // Select everything, and order by latest upload.
    $query = "SELECT * from media ORDER BY uploaded DESC;";

    // Connect to database.
    $conn = connect();

    // Initialize statement.
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement.
    mysqli_stmt_prepare($stmt, $query);

    // Execute statement.
    mysqli_stmt_execute($stmt);

    // Bind columns.
    mysqli_stmt_bind_result($stmt, $id, $title, $destination, $ip, $timestamp);

    // Fetch data from bind_result.
    while (mysqli_stmt_fetch($stmt)) {

        // List links.
        echo "<tr>
                <td>$title</td>
                <td><a href='$destination' target='_blanks' class='linkInTable'>Go to file</a></td>
                <td>$ip</td>
                <td>$timestamp</td>
                </tr>";
    }
    ?>

</table>

</body>
</html>