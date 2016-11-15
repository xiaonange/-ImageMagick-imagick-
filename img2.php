<?php
    /**
     * 将秒数转换为时分秒
     */
 function changeTimeType($seconds){
        if ($seconds > 3600) {
            $hours = intval($seconds / 3600);
            $minutes = $seconds % 3600;
           // $time = $hours . ":" . gmstrftime('%M:%S', $minutes);
            $time  = explode(':',gmstrftime('%M:%S', $minutes));
            $time = ($hours*60+ $time[0]) .':'.$time[1];
        } else {
            $time = gmstrftime('%M:%S', $seconds);
        }
        return $time;
    }
header('Content-type: image/png');

/*锐化*/

/*$image = new Imagick('112.png');

$image->blurImage(5,3);
echo $image;*/


/*合并*/
/*$img1 = new Imagick( "112.png" );
$img2 = new Imagick( "tou.jpg" );

$img1->compositeImage($img2,$img2->getImageCompose(), 10, 20 );*/

/*缩放图片*/
/*$imagick = new Imagick('tou2.jpg');
$imagick->resizeImage(90,90,Imagick::FILTER_LANCZOS,1);
echo $imagick;*/

/*图像添加文字*/
/*
$image = new Imagick("118.png");
$draw = new ImagickDraw();
$draw->setFillColor('white');
$draw->setFont('simhei.ttf');
$draw->setFontSize( 15 );
$image->annotateImage($draw, 126, 310, 0, '90分');
$image->annotateImage($draw, 206, 310, 0, changeTimeType(80));
$image->setImageFormat('png');
echo $image;*/


/*画一个椭圆*/
/*$img = new Imagick();
$img->newImage(600, 200, new ImagickPixel('transparent'));    //创建一个画布,背景是透明的
$draw = new ImagickDraw();  //创建一个画图对象
$draw->setFillColor('white');  //设置画图填充颜色
$draw->roundRectangle(0, 10, 600, 200, 90, 90);
$img->drawImage($draw);  //在画布上画一个椭圆 
$draw->setFillColor('black');    //重新设置填充的颜色
$draw->setStrokeColor('white');  //设置边框的颜色值
$draw->setFont('simhei.ttf');  //设置书写字体
$draw->setFontSize(140); //设置字体大小
$draw->setGravity(Imagick::GRAVITY_CENTER);  //设置书写的位置
$img->annotateImage($draw, 0, 0, 0, '我爱罗');    //在画布中间书写英文字
$img->setImageFormat('png'); //设置图片的格式为png
$img->resizeImage(55,15,Imagick::FILTER_LANCZOS,1);
$img1 = new Imagick( "118.png" );//底图
$img1->compositeImage($img,$img->getImageCompose(), 153, 165 );
echo $img1;  //输出图片*/






/*圆角*/

$outfile = 'tou2.jpg';
$img1 = new Imagick( "118.png" );//底图
$draw = new ImagickDraw();//新建一个画布
$draw->setFillColor('white');//字体颜色
$draw->setFont('simhei.ttf');//字体文件
$draw->setFontSize( 15 );//字体大小
$img1->annotateImage($draw, 126, 310, 0, '90分');//图片上写入字体
$img1->annotateImage($draw, 206, 310, 0, changeTimeType(80));//图片上写入字体

$circle = new Imagick();//开始裁剪头像
$circle->newImage(46,46, 'none');
$circle->setimageformat('png');
$circle->setimagematte(true);
$draw = new ImagickDraw();
$draw->setfillcolor('#ffffff');
$draw->circle(46/2, 46/2, 46/2,46);
$circle->drawimage($draw);
$imagick = new Imagick($outfile);
$imagick->resizeImage(46,46,Imagick::FILTER_LANCZOS,1);
$imagick->setImageFormat( "png" );
$imagick->setimagematte(true);
$imagick->compositeimage($circle, Imagick::COMPOSITE_DSTIN, 0, 0);


$img1->compositeImage($imagick,$imagick->getImageCompose(), 158, 123 );//开始合并头像

$img = new Imagick();//开始画字体图
$img->newImage(600, 200, new ImagickPixel('transparent'));    //创建一个画布,背景是透明的
$draw = new ImagickDraw();  //创建一个画图对象
$draw->setFillColor('white');  //设置画图填充颜色
$draw->roundRectangle(0, 10, 600, 200, 90, 90);
$img->drawImage($draw);  //在画布上画一个椭圆 
$draw->setFillColor('black');    //重新设置填充的颜色
$draw->setStrokeColor('white');  //设置边框的颜色值
$draw->setFont('simhei.ttf');  //设置书写字体
$draw->setFontSize(120); //设置字体大小
$draw->setGravity(Imagick::GRAVITY_CENTER);  //设置书写的位置
$img->annotateImage($draw, 0, 0, 0, '我爱罗啦啦');    //在画布中间书写英文字
$img->setImageFormat('png'); //设置图片的格式为png
$img->resizeImage(55,15,Imagick::FILTER_LANCZOS,1);

$img1->compositeImage($img,$img->getImageCompose(), 153, 165 );//开始合并名字图

$img1->writeImages('./png/bb.png', true); //下载图片
echo $img1;
?>

