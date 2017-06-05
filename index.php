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

    <input type="submit" name="btnSubmit" value="Upload file!" />
</form>

</body>
</html>