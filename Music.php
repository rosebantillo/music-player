<?php

include('connection.php');
include('cors.php');
include('Controller.php');


$xml = file_get_contents('php://input');
$decode = json_decode($xml);


if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$music = new Music();

switch($decode->choice)
{
    case 'store':
        $music->store($con,$decode);
        break;
    case 'update':
        $music->update($con,$decode);
        break;
    case 'delete':
        $music->delete($con,$decode);
        break;
    case 'index':
        $music->index($con);
        break;
}

?>
