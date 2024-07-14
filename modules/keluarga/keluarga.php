<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$base_url}login.php");// Redirect ke halaman login jika belum login
    exit();
}
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
    $response = $keluarga->insertDataKeluarga($_POST, $_FILES); 
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['method'] == 'getAll') {
    $response = $keluarga->getAllkeluarga($_POST['kd_sektor']);
    echo json_encode($response);
} else if (isset($_GET['method']) && $_GET['method'] == 'getDetail') {
    $response = $keluarga->getDetailKeluarga($_GET['id']);
    echo json_encode($response);
    exit;
} else if (isset($_GET['method']) && $_GET['method'] == 'getDataFile') {
    $response = $keluarga->getDocument($_GET['kd_keluarga']);
    echo json_encode($response);
    exit;
} else if (isset($_POST['method']) && $_POST['method'] == 'deleteKeluarga') {
    $response = $keluarga->deleteKeluarga($_POST['id']);
    echo json_encode($response);
    exit;
} else{
    $data = $keluarga->generateCodeKeluarga($_GET['ids']);
}

