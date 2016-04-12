<?php
session_start();
$id=session_id();
$base64_url = $_POST['picData'];

$base64_body = substr(strstr($base64_url,','),1);

$data= base64_decode($base64_body);

file_put_contents("user_pic\\".$id.".jpeg",$data);
