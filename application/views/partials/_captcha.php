<?php
header("Content-Type: image/png");
$im = imagecreate(90, 19) or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 0, 0, 0);
imagestring($im, 10, 0, 0,  $_SESSION['captcha'], $text_color);
imagepng($im);
imagedestroy($im);
?>