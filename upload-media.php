<?php include('config/config.php');
// Check if there are any file in the upload input.
if (isset($_FILES['upload'])) {
// Temporary file.
    $tmpName = $_FILES['upload']['tmp_name'];

// Original name of file.
    $fileName = $_FILES['upload']['name'];

// File type *.mp3, *.jpg etc...
    $fileType = $_FILES['upload']['type'];

    // Array of file types not allowed.
    $restrictedFileTypes = array('image/png', 'image/jpg', 'image/jpeg', 'video/mp4');

    $isFileType = false;

    // Loop through the array.
    foreach ($restrictedFileTypes as $restrict) {
        // Check if file type is allowed.
        if ($fileType === $restrict) {
            // Will only return true if it is allowed.
            $isFileType = true;
        }
    }

    // File still false? Kill this script.
    if (!$isFileType) {
        die("File Type not allowed.");
    }


// Destination to upload.
    $fileUpload = "uploads/" . $fileName;

// Check for post.
    if (!empty($_POST['title'])) {
        // Title to be shown on website.
        $webTitle = $_POST['title'];
    } else {
        $webTitle = "No title";
    }


// Counter used if file exists.
    $countUp = 0;

    while (file_exists($fileUpload)) {
        // Count one up for everytime the file already exists.
        $countUp++;

        // Name the file.
        $fileUpload = "uploads/" . $countUp . "_" . $fileName;
    }


    if (move_uploaded_file($tmpName, $fileUpload)) {

        // Query for the prepared statement, inserts information about media.
        $query = 'INSERT INTO media (title, file_dir, ipaddress) VALUES (?, ?, ?);';

        // Connect to mysql.
        $conn = connect();

        // Initialize statement.
        $stmt = mysqli_stmt_init($conn);


        // Prepare a prepared statement.
        if (mysqli_stmt_prepare($stmt, $query)) {

            // Bind values to the question marks.
            mysqli_stmt_bind_param($stmt, "sss", $webTitle, $fileUpload, $_SERVER['REMOTE_ADDR']);

            // Execute the statement.
            mysqli_stmt_execute($stmt);

            // Close connection.
            mysqli_close($conn);

            // Give message, and a link to the image/video.
            echo "Succesfully uploaded - " . "<a href='$fileUpload' target='__blank'>" . $fileName . "</a><br>";
        }

        header("location: index.php");

    } else {
        echo "Upload failed.";
    }
}




