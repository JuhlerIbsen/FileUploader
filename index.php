<!DOCTYPE html>
<html>
<head>
    <script>
        /**
         * Set information about the file in the paragraphs.
         */
        function getInfo() {
            var upload = document.getElementById("upload").files[0];
            var nameText = document.getElementById("name");
            var sizeText = document.getElementById("size");
            var typeText = document.getElementById("type");

            nameText.innerHTML = upload.name;
            sizeText.innerHTML = upload.size + " bytes";
            typeText.innerHTML = upload.type;
        }
    </script>

    <!--- Style for table -->
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

<form action="upload-media.php" method="post" enctype="multipart/form-data">
    <label for="title">Media Title</label>
    <input type="text" name="title" id="title"/>

    <label for="upload">Upload file</label>
    <input type="file" name="upload" onchange="getInfo();" id="upload"/>

    <input type="submit" name="btnSubmit" value="Upload file!"/>
</form>
<p id='name'></p>
<p id='size'></p>
<p id='type'></p>
<br>


<table>
    <tr>
        <th>File Title</th>
        <th>Link</th>
        <th>Author</th>
        <th>Uploaded</th>
    </tr>

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
    mysqli_stmt_bind_result($stmt, $id, $title, $destination, $ip, $timestamp);

    // Fetch data from bind_result.
    while (mysqli_stmt_fetch($stmt)) {
        // List links.
        echo "<tr>
                <td>$title</td>
                <td><a href='$destination'>Go to file</a></td>
                <td>$ip</td>
                <td>$timestamp</td>
                </tr>";
    }
    ?>

</table>

</body>
</html>