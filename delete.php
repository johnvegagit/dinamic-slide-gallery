<?php
include '../dinamic-slide-gallery/admin.php';
$id = $_GET['id'];

$conn = new Admin;
$conn->delete_where($id);

header('Location: http://localhost/public_html/dinamic-slide-gallery/');
die();