<?php


$data = $_POST;
$root = '/sharedisk/Dep_Content';
$path = "task/".date('YmdHis').'.sh';
$file = fopen($path, "w+");
$base = substr($data['filename'],0,strrpos($data['filename'],'.'));
$ext = substr($data['filename'],strrpos($data['filename'],'.'));
$source = '"'.$root.$data['filename'].'"';
$target = '"'.$root.$base.'_'.$data['type'].'_'.date('YmdHis').$ext.'"';

$codec=' ';
if (!isset($_POST['transcode'])) {
    $codec = ' -c copy ';
}

fwrite($file, "#!/bin/sh\n\n");
switch ($_POST['type']) {
    case 'cut_start' :
        fwrite($file, "ffmpeg -i ".$source." -ss ".sprintf("%02d", $data['hour']).":".sprintf("%02d", $data['minute']).":".sprintf("%02d", $data['second']).$codec.$target);
        break;
    case 'clip' :
        /*
        $start = $data['start_hour']*3600+$data['start_minute']*60+$data['start_second'];
        $end = $data['end_hour']*3600+$data['end_minute']*60+$data['end_second'];
        $length = $end-$start;
        $length_hour = $length/3600;
        $length_min = ($length%3600)/60;
        $length_sec = ($length%3600)%60;
        */
        fwrite($file, "ffmpeg -i ".$source." -ss ".sprintf("%02d", $data['start_hour']).":".sprintf("%02d", $data['start_minute']).":".sprintf("%02d", $data['start_second'])." -to ".sprintf("%02d", $data['end_hour']).":".sprintf("%02d", $data['end_minute']).":".sprintf("%02d", $data['end_second']).$codec.$target);
        break;
    case 'cut_end' :
        fwrite($file, "ffmpeg -i ".$source." -ss 00:00:00 -to ".sprintf("%02d", $data['hour']).":".sprintf("%02d", $data['minute']).":".sprintf("%02d", $data['second']).$codec.$target);
        break;
    case 'watermark' :
        $extra = '';
        $extra2 = '[end]';
        switch ($_POST['Size']) {
            case '640x360' :
                switch ($_POST['dubo']) {
                    case '秒拍-右边-大' :
                        $WW = 120;$HH = 50;$XX = 500;$YY = 20;$B = 3;
                        break;
                    case '秒拍-右边-小' :
                        $WW = 105;$HH = 30;$XX = 528;$YY = 6;$B = 3;
                        break;
                    case '新浪-右边' :
                        $WW = 100;$HH = 35;$XX = 535;$YY = 11;$B = 3;
                        break;
                    case '搜狐-右边' :
                        $WW = 100;$HH = 45;$XX = 525;$YY = 10;$B = 3;
                        break;
                    case '腾讯-右边' :
                        $WW = 100;$HH = 35;$XX = 520;$YY = 20;$B = 3;
                        break;
                    case '腾讯-独播' :
                        $WW = 115;$HH = 35;$XX = 510;$YY = 20;$B = 3;
                        break;
                    case '优酷-右边-中文' :
                        $WW = 100;$HH = 45;$XX = 530;$YY = 10;$B = 3;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':10:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=10:'.$YY.'[end]';
                        break;
                    case '优酷-右边-英文' :
                        $WW = 70;$HH = 18;$XX = 560;$YY = 12;$B = 2;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':10:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=10:'.$YY.'[end]';
                        break;
                    case '优酷-独播' :
                        $WW = 115;$HH = 20;$XX = 510;$YY = 10;$B = 3;
                        break;
                }
                break;
            case '640x480' :
                switch ($_POST['Default']) {
                    case '秒拍-右边-大' :
                        $WW = 120;$HH = 50;$XX = 500;$YY = 80;$B = 3;
                        break;
                    case '秒拍-右边-小' :
                        $WW = 105;$HH = 30;$XX = 530;$YY = 65;$B = 3;
                        break;
                    case '新浪-右边' :
                        $WW = 100;$HH = 35;$XX = 535;$YY = 70;$B = 3;
                        break;
                    case '搜狐-右边' :
                        $WW = 100;$HH = 45;$XX = 525;$YY = 70;$B = 3;
                        break;
                    case '腾讯-右边' :
                        $WW = 100;$HH = 35;$XX = 520;$YY = 80;$B = 3;
                        break;
                    case '优酷-右边-中文' :
                        $WW = 80;$HH = 45;$XX = 540;$YY = 65;$B = 3;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':20:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=20:'.$YY.'[end]';
                        break;
                    case '优酷-右边-英文' :
                        $WW = 70;$HH = 18;$XX = 560;$YY = 70;$B = 2;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':10:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=10:'.$YY.'[end]';
                        break;
                }
                break;
            case '854x480' :
                switch ($_POST['854x480']) {
                    case '腾讯-独播' :
                        $WW = 150;$HH = 35;$XX = 680;$YY = 30;$B = 3;
                        break;
                    case '优酷-独播' :
                        $WW = 150;$HH = 25;$XX = 680;$YY = 20;$B = 3;
                        break;
                }
                break;
            case '1280x720' :
                switch ($_POST['dubo']) {
                    case '秒拍-右边-大' :
                        $WW = 240;$HH = 100;$XX = 1000;$YY = 40;$B = 8;
                        break;
                    case '秒拍-右边-小' :
                        $WW = 200;$HH = 60;$XX = 1065;$YY = 10;$B = 6;
                        break;
                    case '新浪-右边' :
                        $WW = 200;$HH = 80;$XX = 1065;$YY = 15;$B = 6;
                        break;
                    case '搜狐-右边' :
                        $WW = 200;$HH = 90;$XX = 1050;$YY = 20;$B = 6;
                        break;
                    case '腾讯-右边' :
                        $WW = 210;$HH = 80;$XX = 1035;$YY = 30;$B = 6;
                        break;
                    case '腾讯-独播' :
                        $WW = 230;$HH = 80;$XX = 1015;$YY = 30;$B = 6;
                        break;
                    case '优酷-右边-中文' :
                        $WW = 200;$HH = 90;$XX = 1065;$YY = 15;$B = 6;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':10:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=10:'.$YY.'[end]';
                        break;
                    case '优酷-右边-英文' :
                        $WW = 140;$HH = 50;$XX = 1120;$YY = 10;$B = 6;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':20:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=20:'.$YY.'[end]';
                        break;
                    case '优酷-独播' :
                        $WW = 190;$HH = 50;$XX = 1065;$YY = 15;$B = 6;
                        break;
                }
                break;
            case '1920x1080' :
                switch ($_POST['dubo']) {
                    case '秒拍-右边-大' :
                        $WW = 360;$HH = 150;$XX = 1500;$YY = 60;$B = 8;
                        break;
                    case '秒拍-右边-小' :
                        $WW = 320;$HH = 90;$XX = 1580;$YY = 15;$B = 6;
                        break;
                    case '新浪-右边' :
                        $WW = 300;$HH = 115;$XX = 1600;$YY = 23;$B = 6;
                        break;
                    case '搜狐-右边' :
                        $WW = 300;$HH = 135;$XX = 1580;$YY = 30;$B = 6;
                        break;
                    case '腾讯-右边' :
                        $WW = 300;$HH = 110;$XX = 1565;$YY = 45;$B = 6;
                        break;
                    case '腾讯-独播' :
                        $WW = 345;$HH = 110;$XX = 1525;$YY = 45;$B = 6;
                        break;
                    case '优酷-右边-中文' :
                        $WW = 300;$HH = 135;$XX = 1600;$YY = 23;$B = 9;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':10:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=10:'.$YY.'[end]';
                        break;
                    case '优酷-右边-英文' :
                        $WW = 210;$HH = 75;$XX = 1680;$YY = 15;$B = 6;
                        $extra = '[0:v]crop='.$WW.':'.$HH.':25:'.$YY.',boxblur='.$B.'[b1];';
                        $extra2 = '[over0];[over0][b1]overlay=25:'.$YY.'[end]';
                        break;
                    case '优酷-独播' :
                        $WW = 270;$HH = 80;$XX = 1600;$YY = 25;$B = 9;
                        break;
                }
                break;
            case '568x320' :
                $WW = 120;$HH = 50;$XX = 440;$YY = 15;$B = 3;
                break;
            case '1024x576' :
                $WW = 165;$HH = 60;$XX = 850;$YY = 18;$B = 6;
                break;
        }
        fwrite($file, "ffmpeg -i ".$source." -filter_complex \" [0:v]crop=".$WW.":".$HH.":".$XX.":".$YY.",boxblur=".$B."[b0];".$extra."[0:v][b0]overlay=".$XX.":".$YY.$extra2."\" -map \"[end]\" -map 0:a -c:v libx264 -c:a copy ". $target);
        break;
    case 'merge' :
        $filenames = explode(',',$data['filename']);
        $base = substr($filenames[0],0,strrpos($filenames[0],'/')+1);
        $ext = substr($filenames[0],strrpos($filenames[0],'.'));
        $file_path = __DIR__."/task/list".date('YmdHis').".txt";
        $list = fopen($file_path, "w+");
        foreach ($filenames as $filename) {
            fwrite($list, "file '".$root.$filename."'\n");
        }
        fclose($list);
        fwrite($file, 'ffmpeg -f concat -safe 0 -i '.$file_path.' -c copy "'.$root.$base.$data['outputName'].$ext.'"');
        break;
    case 'transcoding':
        $fps = $data['fps'];
        $resolution = $data['resolution'];
        fwrite($file, 'ffmpeg -i '.$source.' -c:v libx264 -strict -2 -vf scale='.$resolution.' -r '.$fps.' "'.$root.$base.'_transcoding_'.date('YmdHis').'.mp4"');
        break;
    case 'addwatermark2':
        // get the value for the watermark file
        $watermark_file = '"'.$root.$data['watermark'].'"';
        // now execute the ffmpeg command
        // command is ffmpeg -i <file1> -i <watermark file> -filter_complex "[0:v][1:v] overlay[out]" -map "[out]" -map 0:a -c:v libx264 -c:a copy <output>
        fwrite($file, "ffmpeg -i ".$source." -i ".$watermark_file." -filter_complex \"[0:v][1:v] overlay[out]\" -map \"[out]\" -map 0:a -c:v libx264 -c:a copy ".$target);
        break;
    case 'download':
        // command is ffmpeg -i <file1> -i <watermark file> -filter_complex "[0:v][1:v] overlay[out]" -map "[out]" -map 0:a -c:v libx264 -c:a copy <output>
        fwrite($file, 'ffmpeg -i "'.$data['address'].'" -vf -c:v libx264 -c:a aac "'.$data['savePath'].$data['saveName'].'.mp4"');
        break;
    case 'kux':
        $filenames =explode(',', $data['filenames']);
        foreach ($filenames as $filename) {
            fwrite($file, 'dd if='.$filename.' of='.$filename.'.flv bs=14942208 skip=1');
        }
        break;
}

fwrite($file, "\n\necho $?\n\n");
fclose($file);

chmod($path,0777);

Header("location:index.php?status=success");

