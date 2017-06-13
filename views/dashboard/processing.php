<?php
base64_to_jpeg(str_replace(" ", "+", $_POST['d']), "temp.png");
file_put_contents("a.txt", $_POST['d']);
ft_copy_to_center($_POST['q'], "temp.png", "result.png");
echo "http://localhost/Camagru/views/dashboard/result.png?a=".time();

function base64_to_jpeg($data, $output_file) {
    // open the output file for writin
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    file_put_contents($output_file, $data);
    file_put_contents("a.txt", $output_file);

}

function ft_copy_to_center($src, $dst, $result) {
    list($src_w, $src_h) = getimagesize($src);

    $image = imagecreatefrompng($dst);
    $frame = imagecreatefrompng($src);

    imagecopyresized($image, $frame, 0, 0, 0, 0, $src_w, $src_h, $src_w, $src_h);

    imagepng($image, $result);
}