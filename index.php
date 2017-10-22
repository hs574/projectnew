<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
</head>
<body>
  <div id="ad123">
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .csv formats allowed to a max size of 5 MB.</p>
    </form>
  </div>
</body>
</html>

<?php
// Check if the form was submitted
function uploadmanager()
{
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("csv");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];



        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");



            // Check whether file exists before uploading it
            if(file_exists("upload/" . $_FILES["photo"]["name"])){
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else{
                if( move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $_FILES["photo"]["name"])
                {
                echo "Your file was uploaded successfully.";


                echo "<html><body><table border=1>\n\n";
                $name= "upload/".$filename;



                $f = fopen($name,"r");
                while (($line = fgetcsv($f)) !== false) {
                        echo "<tr>";
                        foreach ($line as $cell) {
                                echo "<td>" . htmlspecialchars($cell) . "</td>";
                        }
                        echo "</tr>\n";
                }
                fclose($f);

               echo "\n</table></body></html>";
            }
          }

    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
}
uploadmanager();
?>
