<?php
include 'MyManageDataStub.php';

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
// if ((($_FILES["file"]["type"] == "image/gif")
// || ($_FILES["file"]["type"] == "image/jpeg")
// || ($_FILES["file"]["type"] == "image/jpg")
// || ($_FILES["file"]["type"] == "image/pjpeg")
// || ($_FILES["file"]["type"] == "image/x-png")
// || ($_FILES["file"]["type"] == "image/png"))
// && ($_FILES["file"]["size"] < 20000)
// && in_array($extension, $allowedExts))
  // {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	header("Location: MyManage.php");
    }
  else
    {
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
	  header("Location: MyManage.php");
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	  header("Location: MyManage.php?picture=". $_FILES["file"]["name"]);
      }
    }
  //}
//else
  // {
  // echo "Invalid file";
  //header("Location: MyManage.php");
  // }
?>