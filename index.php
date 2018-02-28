<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<link href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="text-center">
		<h1>视频工具</h1>
	</div>
	<div class="choice">
		<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/watermark.html"}'>去水印</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/title.html"}'>切片头</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/ending.html"}'>切片尾</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/clips.html"}'>切片段</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/merge.html"}'>合并</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/search.html"}'>查询</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/transcoding.html"}'>转码</button>
	</div>
	<!--<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/addwatermark.html"}'>加水印</button>
	</div>-->
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/addwatermark-2.html"}'>加水印2</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/download.html"}'>下载</button>
	</div>
	<div>
		<button class="btn btn-primary" type="button" onclick='{location.href="pages/kux.html"}'>KUX转换</button>
	</div>
	</div>

<?php
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo '<div class="text-center">';
    echo '<h3 style="color: orangered">操作成功！</h3>';
    echo '</div>';
}
?>




</body>
<style>
.choice {
    padding-left: 600px;
}
 .choice button {
	margin-top: 20px;
 }
</style>

</html>
