<?php

$supported_extensions = ['png', 'jpg', 'jpeg', 'gif', 'webpp'];

// check if form has been submitted
if (isset($_POST["submit"])) {
    // check if file was uploaded with the same name as file's original name
    if (!empty($_FILES['upload']['name'])) {
        print_r($_FILES);
        // name correspond to the file name
        $file_name = $_FILES['upload']['name'];
        $file_size = $_FILES['upload']['size'];
        $file_tempname = $_FILES['upload']['tmp_name'];
        $target_dir = "uploads/images/$file_name";


        // get file extension from filename
        $file_extension = explode('.', $file_name);
        $file_extension = strtolower(end($file_extension));

        // validate file extension/type with the array above
        if (in_array($file_extension, $supported_extensions)) {
            if ($file_size <= 5000000) {
                move_uploaded_file($file_tempname, $target_dir);
                echo "file uploaded";
            } else {
                echo 'file size too large!';
            }
        } else {
            echo 'file not supported';
        }
    } else {
        echo "please select file";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<body>
    <h1>File Upload</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="upload">Select file to upload : </label>
            <input type="file" name="upload" />
        </div>
        <button type="submit" name="submit">Upload File</button>
    </form>
</body>

</html>
