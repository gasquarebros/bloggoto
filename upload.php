<?php
header('Access-Control-Allow-Origin: *');
$target_path = "";

$myfile = fopen("newfileold.txt", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($_FILES)." ---- ". json_encode($_POST));
fclose($myfile);

 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else {
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}
?>