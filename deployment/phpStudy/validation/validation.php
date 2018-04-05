<?php
$num=4;
$str=getContents($num,0);//获取验证码北内容
$width=$num*20;
$height=30;
//1. 创建画布
$im=imagecreatetruecolor($width,$height);
$bg=imagecolorallocate($im,240,240,240);//分配背景
$color=array(imagecolorallocate($im,111,0,55),imagecolorallocate($im,44,100,55),imagecolorallocate($im,111,55,55),imagecolorallocate($im,11,70,55),imagecolorallocate($im,11,100,222));//字体颜色[其实就是画笔]

//2  开始绘画
imagefill($im,0,0,$bg);
imagerectangle($im,0,0,$width-1,$height-1,$color[rand(0,4)]);

for ($i=0; $i <200 ; $i++) { 
	$c=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	imagesetpixel($im,rand(0,$width),rand(0,$height),$c);
}
for ($i=0; $i <5; $i++) { 
	$c=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	imageline($im,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$c);
}
for ($i=0; $i <$num; $i++) { 
	imagettftext($im,18,rand(-40,40),8+18*$i,24,$color[rand(0,4)],"STLITI.TTF",$str[$i]);//画出数字，并指定位置,左上角是00，底部是24，左边从8+18*$i开始
}
//3  输出图像
header("Content-Type:image/png");//此函数执行前不可以有输出
imagepng($im);
//4  销毁图像
imagedestroy($im);

function getContents($m=4,$type=0){
	$str="0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	$t=array(9,35,strlen($str-1));
	$c='';
	for($i=0;$i<$m;$i++){
       $c.=$str[rand(0,$t[$type])];
	}
	return $c;
}
echo getContents(6,1);
?>
<!-- GD库函数
imagecreatetruecolor(int x_size,int y_size)//创建一个基于真彩的画布
imagecolorallocate(resource image,int red,int green,int bule)//基于int值和三基色分配一个颜色
imagefill(resource image,int x,int y,int color)//区域填充
imagerectangle(reaource image,int x1,int y1,int x2,int y2,int col)//矩形框
imageline(resource image,int x1,int y1,int x2,int y2,int color)//画一条线段
imagesetpixel(resource image,int x,int y,int color)//画一个像素点
imagegettftext（resource image,float size,float angle,int x,int y,int color,

imagepng(resource image[,string filename])//以png格式输出到浏览器或文件。
imagedestroy(resource image)//销毁一个图像 
绘图过程：
	1. 创建画布
	imagecreatetruecolor()
	imagecolorallocate()
	2. 开始绘画

	3. 输出图像
	imagepng(resource image[,string filename])//以png格式输出到浏览器或文件。
	imagejpeg();
	4. 销毁图像
	imagedestroy();输出图像本质上是进行复制
绘制验证码的步骤
1 选择字体文件
   选择字体的风格
2 自定义函数，
   随机生成验证码内容,传入参数（验证码的个数【默认为4】和验证码类型0纯数字 1数字和小写字母 2数字和大小写字母）
-->
