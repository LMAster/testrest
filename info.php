<?php
require("common.php");

 if (!isset($_GET['session_id'])||$_GET['session_id']=='')
{
  header("HTTP/1.0 400 Session_id not set");
  return;
}

$session_id=mysql_real_escape_string($_GET['session_id']);



$sqltext="SELECT id,NOW()-auth_time AS time_after_auth FROM users WHERE session_id='$session_id' LIMIT 1";
$sqlres=mysqli_query($link,$sqltext);
if ($row=mysqli_fetch_object($sqlres))
{
 $id=$row->id;
$time_after_auth=$row->time_after_auth;

}
else
{
  header("HTTP/1.0 400 Wrong session_id");
  return;

}
if (isset($id))
{
 if ($time_after_auth<=60)
 {
  $data['info']="Very important information 2 - auth";
  echo json_encode($data);
  return;
 }
 else
 {
  header("HTTP/1.0 408 Session timeout");
  return;
 }
}
else
{
 header("HTTP/1.0 401 Wrong access code");
 return;
}


?>