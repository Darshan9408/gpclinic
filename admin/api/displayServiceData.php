<?php
 include('../init/init.php');

$id = $_POST['id'];

$query = select("SELECT * FROM services WHERE Id = $id");
header("Content-Type:application/json");
echo json_encode($query);