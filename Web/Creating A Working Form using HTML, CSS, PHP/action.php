<?php
$link = mysqli_connect("localhost", "root", "", "mydb");
if ($link->connect_error) {
    die("Connection Failed");
} else {
    echo "Successful";
}
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['Gender'];
$contact = $_POST['contact'];
$degree = $_POST['Degree'];
$Engineering = $_POST['Engineering'];
$Address = $_POST['Address'];
$checkbox1 = $_POST['Hobby'];
$chk = "";
foreach ($checkbox1 as $chk1) {
    $chk .= $chk1 . ",";
}
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
echo "working";
if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $insert = "INSERT into data (Name,Password, Email,Gender,Contact,Degree,Engineering,Hobbies,Address,File,UploadTime) 
            VALUES ('$name','$password','$email','$gender','$contact','$degree','$Engineering','$chk','$Address','" . $fileName . "', NOW())";
            $link->query($insert);
            if ($insert) {
                $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}
