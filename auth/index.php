<?php
require("../common.php");

if (isset($_POST['user']) && isset($_POST['pass']))
{
 $name=mysql_real_escape_string($_POST['user']);
 $password=mysql_real_escape_string($_POST['pass']);
 
 $sqltext="SELECT id,password_hash,salt FROM users WHERE name='$name'";
 $sqlres=mysqli_query($link,$sqltext);
 if ($row=mysqli_fetch_object($sqlres))
 {
  if (crypt($password, '$2a$10$'.$row->salt)==$row->password_hash)
  {
   //$_SESSION['id_user']=$row->id;
	
   $sqlres=false;
   while ($sqlres===false)
   {
	$session_id=get_random_string(20);
    $sqltext="UPDATE users SET session_id='$session_id' WHERE id=$row->id";
    $sqlres=mysqli_query($link,$sqltext);
   } 
	
   $data['session_id']=$session_id;
   echo json_encode($data);
   return;
  } 
  else
  {
   header("HTTP/1.0 400 Wrong login or password");
   return;
  }
 }
 else
 {
  header("HTTP/1.0 400 Wrong login or password");
  return;
 }
}
else
{
 header('HTTP/1.0 401 No login or password');
 return;
}


?>