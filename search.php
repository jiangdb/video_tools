<?php

$root = '/home/share/Dep_Content';
$target = $root.$_POST['filename'];

$info = shell_exec('ffprobe -v error -show_entries stream=codec_name,codec_type,avg_frame_rate,width,height,display_aspect_ratio:format=format_name,bit_rate "'.$target.'"');

echo nl2br($info);

?>

