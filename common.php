<?

function sendMail($to_email,$subject,$body)
{
  $subject="=?UTF-8?B?" . base64_encode($subject) . "?=";
  $from="=?UTF-8?B?" . base64_encode("Сервер".$_SERVER['SERVER_NAME']) . "?=<noreply@".$_SERVER['SERVER_NAME'].">";
  $headers="From: postmaster@".$_SERVER['SERVER_NAME']."\r\n".
  "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n".
  "Content-Transfer-Encoding: 8bit\r\n".
  "User-Agent: Thunderbird 2.0.0.14 (X11/20080719)\r\n";
  
  //echo "mail=$subject<br>";
  //print_r(mail($to_email,$subject,$body,$headers));
  return mail($to_email,$subject,$body,$headers);

}


function get_random_string( $length) 
{
 $source=array();
 
 
 $start=ord("0");
 $fin=ord("9");
 
 for ($i=$start;$i<=$fin;$i++)
 {
  $source[]=chr($i);
 }

 $start=ord("a");
 $fin=ord("z");
 
 for ($i=$start;$i<=$fin;$i++)
 {
  $source[]=chr($i);
 }

 $res="";
 for ($i=0;$i<$length;$i++)
 {
  $res.=$source[array_rand($source,1)];
 }
 
 return $res;
 
} 

require_once("db_config.php");


if (!$link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
 echo "can not connect to database server\n";
 echo mysql_error();
 exit;
}

error_reporting(E_ALL & ~E_NOTICE);
ini_set(display_errors, true);


session_start();


?>