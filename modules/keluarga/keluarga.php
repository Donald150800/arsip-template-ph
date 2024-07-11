<?php
include $_SERVER["DOCUMENT_ROOT"].'/arsip-template-ph/s/config.php';

include 'model/keluarga.php';
$keluarga = new Keluarga($conn);  

$data = [];
$msg = '';
$stat = '';

// if (!isset($_GET['ids'])) {
//     header("Location: sektor_page.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'insertKeluarga') {
    // var_dump($_POST);die();
    $response = $keluarga->insertDataKeluarga($_POST['formData']); 
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'getAll') {
    $response = $keluarga->getAllkeluarga($_POST['kd_sektor']);
    echo json_encode($response);
} else if (isset($_GET['method']) && isset($_GET['method']) == 'getDetail') {
    $response = $keluarga->getDetailKeluarga($_GET['id']);
    echo json_encode($response);
    exit;
}else{
    $data = $keluarga->generateCodeKeluarga($_GET['ids']);
}

