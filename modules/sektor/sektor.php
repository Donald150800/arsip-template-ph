<?php
include $_SERVER["DOCUMENT_ROOT"].'/arsip-template-ph/s/config.php';

include 'model/sektor.php';
$sektor = new Sektor($conn);  

$data = [];
$msg = '';
$stat = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = $sektor->insertSektor($_POST); 
    echo json_encode($response);
    // $msg = $result['message'];
    // $stat = $result['status']; 
} elseif (isset($_GET['type']) && isset($_GET['id'])) {
    $response = $sektor->getDetailSektor($_GET['id']);
    echo json_encode($response);
    exit;
} elseif (isset($_GET['method']) && $_GET['method'] == 'hapus' && isset($_GET['id'])) {
    $response = $sektor->deleteSektor($_GET['id']);
    $msg = $response['message'];
    $stat = $response['status']; 
    exit;
} else {
    $data = $sektor->getAllSektor();
}

// GET ALL SEKTOR
// echo json_encode($data);
// include $_SERVER["DOCUMENT_ROOT"] . "/arsip-template-ph/index.php";
?>
