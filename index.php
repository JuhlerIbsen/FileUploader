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

    <script src="scripts/index-js.js"></script>
    <link rel="stylesheet" href="stylesheet/index.css"/>
</head>

<body>
<form action="upload-media.php" method="post" enctype="multipart/form-data">
    <label for="title">Media Title</label>
    <input type="text" name="title" id="title"/>

    <label for="upload">Upload image or video</label>
    <input type="file" name="upload" onchange="getInfo();" id="upload"/>

    <input type="submit" name="btnSubmit" value="Upload file"/>
</form>
<pre class="restrictions">Only these formats are allowed: (*.jpg, *.jpeg, *.png, and *.gif)</pre>
<p id='name'></p>
<p id='size'></p>
<p id='type'></p>

<table>
    <tr>
        <th>Media title</th>
        <th>Link</th>
        <th>File size in megabytes</th>
        <th>Uploaded</th>
    </tr>

    <h2>5 Latest uploads</h2>
    <?php include 'config/config.php';

    // Select everything, and order by latest upload.
    $query = "SELECT * from media ORDER BY uploaded DESC LIMIT 5;";

    // Connect to database.
    $conn = connect();

    // Initialize statement.
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement.
    mysqli_stmt_prepare($stmt, $query);

    // Execute statement.
    mysqli_stmt_execute($stmt);

    // Bind columns.
    mysqli_stmt_bind_result($stmt, $id, $title, $destination, $ip, $timestamp, $fileSize);


    // Fetch data from bind_result.
    while (mysqli_stmt_fetch($stmt)) {

        // Convert bytes to megabytes.
        $fileSize = ($fileSize / 1024) / 1024;
        $fileSize = number_format($fileSize, 2, '.', '');

        // List links.
        echo "<tr>
                <td>$title</td>
                <td><a href='showImage.php?mediaId=$id' target='_blanks' class='linkInTable'>Show me image</a></td>
                <td>$fileSize</td>
                <td>$timestamp</td>
                </tr>";
    }

    ?>

</table>

</body>
</html>