<?php
switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $check = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
        if ($check == 'application/pdf') {
            if (file_exists($target_file)) {
                ex();
            }
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
        ex();
        break;
    case "GET":
        $file = "uploads/" . $_GET['download'];
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=' . $_GET['download']);
        // readfile($file);
        break;
}

function ex(): void
{
    echo "<script> location.href='filePage.php'; </script>";
    exit;
}