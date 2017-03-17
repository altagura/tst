<?php
header ("Content-Type: text/html; charset=utf-8");
setlocale(LC_CTYPE, "ru_RU.UTF8");


ini_set('display_errors',1);
error_reporting(E_ALL);


require_once dirname(__FILE__).'/config/connect.php';
require_once dirname(__FILE__).'/funs.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{


$link = mysqli_connect (DB_LOCATION, DB_USER, DB_PASSWORD, DB_NAME, 3306);
/*@mysql_query( 'SET NAMES utf8' );
@mysql_select_db ( DB_NAME ) or die( 'В настоящий момент база данных не доступна' ); $_SERVER['DOCUMENT_ROOT'].
*/

if (mysqli_connect_errno())
{
    echo json_encode(array(
        'status' => 0,
        'error' => array(
            'code' => 2,
            'message' => "Не удалось подключиться: ".mysqli_connect_error()
        )
    ));
    exit();
}
//mysqli_select_db($link, $db);
//session_start();

  $name = mysqli_real_escape_string($link, $_POST['name']);
  $date = Funs::chkdate(mysqli_real_escape_string($link, $_POST['date']));
  $fema = mysqli_real_escape_string($link, $_POST['fema']);

  $query="INSERT INTO ussers(name, date, fema)VALUES('$name', '$date', '$fema')";
  //$query="select 1 from ussers";

  /* Посылаем запрос серверу  or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR)*/
  try {
    $try = mysqli_query($link, $query);
  }catch (Exception $e) {
    echo json_encode(array(
        'status' => 0,
        'error' => array(
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        )
    ));
  }

  if($try === false)
  {
    echo json_encode(array
    (
        'status' => 0,
        'error' => array
        (
            'code' => 200,
            'message' => mysqli_error($link)
        )
    ));
  }else{
    //header("Location: http://".$_SERVER['HTTP_HOST']."/tst/form.php");
    echo json_encode(array('status' => 1,'message' => 'пользователь добавлен под номером '.$link->insert_id));
  }

  /* Закрываем соединение */
  mysqli_close($link);
}
?>
