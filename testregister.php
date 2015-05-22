<?

 require("common.php");

 $name=$_GET['name'];
 $password=$_GET['password'];
 
 $salt=get_random_string(20);
 $password_hash=crypt($password, '$2a$10$'.$salt);
 
 $sqltext="INSERT INTO users (name, password_hash, salt) VALUES ('$name', '$password_hash', '$salt')";
 $sqlres=mysqli_query($link,$sqltext);

 echo "registered";
?>
