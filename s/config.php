<?php
// error_reporting(0);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $request_uri);
$base_path = '/';
if (isset($parts[1])) {
    $base_path .= $parts[1] . '/';
}
$base_url = $protocol . $host . $base_path;


//URI GET
// $uri_part = explode('/', $request_uri);
// $uri = $uri_part[2];

include 'koneksi.php';

$qryKel = "SELECT COUNT(*) AS keluarga FROM tbl_keluarga;";
$qryAng = "SELECT COUNT(*) AS jemaat FROM tbl_anggota_keluarga;";
$qrySek = "SELECT COUNT(*) AS sektor FROM tbl_sektor;";

$resultKel = $conn->query($qryKel);
$kel = $resultKel->fetch_assoc();
$resultAng = $conn->query($qryAng);
$ang = $resultAng->fetch_assoc();
$resultSek = $conn->query($qrySek);
$sek = $resultSek->fetch_assoc();

// echo $kel['keluarga'];
// echo $ang['jemaat'];
// echo $sek['sektor'];
// exit;


?>