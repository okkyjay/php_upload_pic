<?php
$hostname_db_con = "localhost";
$database_db_con = "picture";
$username_db_con = "root";
$password_db_con = "";
$db_con = mysql_connect($hostname_db_con, $username_db_con, $password_db_con) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_db_con, $db_con);

if (isset($_REQUEST['submit']))
{
		$userfile_name = $_FILES['pic']['name'];
		$userfile_tmp = $_FILES['pic']['tmp_name'];
		$userfile_size = $_FILES['pic']['size'];
		$userfile_name = rand(20, 50)."abc.jpg";
		$imagepath= "uploads/".$userfile_name;
		if(move_uploaded_file($userfile_tmp, $imagepath))
		{
		$insert = "INSERT INTO pic (photo) VALUES('$userfile_name')";
		if (mysql_query($insert, $db_con))
		{
			echo "sucessful";}
			else { echo "error";}
		}
		else
		"file error";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Picture upload</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="pic"></label>
  <input type="file" name="pic" id="pic" />
  <input type="submit" name="submit" id="id" value="Submit" />
</form>
<?php
  $select =mysql_query(("SELECT * FROM pic"),$db_con);
   while($row_rec = mysql_fetch_array($select))
   {
?>
<img src="uploads/<?php echo $row_rec['photo']; ?>" style="height:150px" />
<?php } ?>
</body>
</html>