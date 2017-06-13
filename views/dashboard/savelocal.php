<?php
$_POST['d'] = str_replace(" ", "+", $_POST['d']);
list($type, $data) = explode(';', $_POST['d']);
list(, $data)      = explode(',', $_POST['d']);
$data = base64_decode($data);

file_put_contents("result.png", $data);
file_put_contents("a.txt", $data);