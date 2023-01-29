<?php
$letters = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890@!#$'; // алфавит

$caplen = 6;
$width = 200; $height = 80;
$font = 'times.ttf';
$fontsize = 28;


header('Content-type: image/png');

$im = imagecreatetruecolor($width, $height);
imagesavealpha($im, true);
$bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $bg);

putenv( 'GDFONTPATH=' . realpath('.') ); //проверяет путь до файла со шрифтами
$pixel_color = imagecolorallocate($im, 0,0,255);
$captcha = '';

for ($i = 0; $i < $caplen; $i++)
{
  $captcha .= $letters[rand(0, strlen($letters)-1)];
  $x = $i*32 + 5;
  $x = rand($x, $x+4);
  $y = $height - ( ($height - $fontsize) / 2 );
  $curcolor = imagecolorallocate( $im, rand(0, 100), rand(0, 100), rand(0, 100) );
  $angle = rand(-25, 25);
  imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]);
}


for($i=0;$i<300;$i++) {
  imagesetpixel($im,rand()%$width,rand()%$height,$pixel_color);
}


$line_color = imagecolorallocate($im, 64,64,64);
for($i=0;$i<6;$i++) {
  imageline($im,0,rand()%100,200,rand()%100,$line_color);
}



session_start();
$_SESSION['captcha'] = $captcha;

imagepng($im);
imagedestroy($im);
?>

