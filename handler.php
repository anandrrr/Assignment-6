<?php
header("Content-Type: application/json; charset=UTF-8");
require 'db.php';
require 'user.php';

$req = $_GET['req'] ?? null;
$db=new database();
$usert = new usertable($db->connect());

switch($req)
{
    case 'add':
        $obj=$_GET['object'];
        $temp=json_decode($obj);
        echo $usert->addrow($temp);
        break;

    case 'retrieve':
        echo $usert->getdetails();
        break;
    
    case 'delete':
        $obj=$_GET['id'] ?? null;
        echo $usert->deldata($obj);
        break;

    case 'update':
        $obj=$_GET['object'];
        $temp=json_decode($obj);
        echo $usert->updata($temp);
        break;

    case 'getsingle':
        $obj=$_GET['id'] ?? null;
        echo $usert->retsingle($obj);
        break;

    case 'search':
        $obj=$_GET['query'] ?? null;
        echo $usert->SearchQy($obj);
        break;

    default:
        echo json_encode(["Invalid request"]);
        break;
}

?>