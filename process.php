<?php
$processing_dir = __DIR__."/process/";
$task_dir = __DIR__."/task/";
$fail_dir = __DIR__."/fail/";
$max_process=20;

echo date("Y-m-d H:i:s").': start'."\n";
$processing = glob($processing_dir.'/*.sh');
if (count($processing) >= $max_process) {
    echo date("Y-m-d H:i:s").': too many processing'."\n";
    exit(0);
}

$file=null;
$oldest = 9999999999;
foreach (glob($task_dir.'/*.sh') as $script) {
    $mtime = filemtime($script);
    if ($mtime < $oldest) {
        $oldest = $mtime;
        $file = $script;
    }
}
if ($file == null) {
    echo date("Y-m-d H:i:s").": no task found\n";
    exit(0);
}

$filename = basename($file);
echo date("Y-m-d H:i:s").': handle '.$filename."\n";
rename($task_dir.$filename, $processing_dir.$filename);
$ret = exec($processing_dir.$filename);

if ($ret == 0) {
    //success: rm file
    echo date("Y-m-d H:i:s").': run '.$filename.' success '."\n";
    exec('rm '.$processing_dir.$filename);
    if (file_exists($task_dir.'list'.basename($filename,'.sh').'.txt')) {
        exec('rm '.$task_dir.'list'.basename($filename,'.sh').'.txt');
    }
} else {
    //fail: move file to fail director
    echo date("Y-m-d H:i:s").': run '.$filename.' fail '."\n";
    rename($processing_dir.$filename, $fail_dir.$filename);
    if (file_exists($task_dir.'list'.basename($filename,'.sh').'.txt')) {
        rename($task_dir.'list'.basename($filename,'.sh').'.txt', $fail_dir.'list'.basename($filename,'.sh').'.txt');
    }
}
exit(0);
