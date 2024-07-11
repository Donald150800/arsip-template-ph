<?php
include $_SERVER["DOCUMENT_ROOT"].'/arsip-template-ph/s/config.php';

include 'model/sektor.php';
$sektor = new Sektor($conn);  

$data = [];
$msg = '';
$stat = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'insertSektor') {
    // var_dump($_POST);die();
    $response = $sektor->insertSektor($_POST['formData']); 
    echo json_encode($response);
    exit;
} else if (isset($_GET['method']) && isset($_GET['method']) == 'editDataSektor') {
    $response = $sektor->getDetailSektor($_GET['id']);
    echo json_encode($response);
    exit;
} else if (isset($_POST['method']) && $_POST['method'] == 'deleteSektor') {
    $response = $sektor->deleteSektor($_POST['id']);
    echo json_encode($response);
    exit;
}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'getAll') {
    $response = $sektor->getAllSektor();
    echo json_encode($response);
} else{
    $res = $sektor->getSektorPage();
}
?>
