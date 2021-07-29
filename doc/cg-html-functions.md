CommonGateway 的 HTML 公用函數
=============================

CommonGateway 在 cg\html namespace 內提供了下列用於設計 Web 網站時的公用函數。
這些函數主要用在 phtml 視圖，目的是提供正確的資源 URL 。

* request_url($controller_path = false)
  取得基於 index.php 的控制項 URL 字串。
* home_url()
  取得首頁的URL。
* redirect($controller_path = false)
  導向到指定的控制項。若省略控制項就是回到首頁(index.php)。
  實際上就是執行 *header('Location: ' . request_url($controller_path));* 。
* resource_url($path = false)
  取得網站指定資源的 URL (URL中不會包含 index.php)。
* stylesheet($srcs)
  顯示 CSS 文件的 HTML 載入代碼。可接受多個 css 檔案路徑。
* script($srcs)
  顯示 JavaScript 文件的 HTML 載入代碼。可接受多個 js 檔案路徑。
* refresh($seconds)
  指示 HTML 網頁的定期更新週期。內容是 `<meta http-equiv="refresh" content="$seconds">`。

範例:

~~~html

<head>
<meta charset="utf-8">

<?=cg\html\refresh(30)?>

<title>cg\html functions demo</title>

<!-- 示範 cg\html\stylesheet() -->
<?php
cg\html\stylesheet('css/bootstrap.min.css');

cg\html\stylesheet([
  'css/theme/base.css',
  'css/theme/dark.css'
]);
?>
</head>

<body>

<div>
<!-- 示範 cg\html\resource_url('images/logo.png') -->
<img src="<?=cg\html\resource_url('images/logo.png')?>">
</div>

<!-- 示範 cg\html\home_url() -->
<p>goto: <a href="<?=cg\html\home_url()?>">home</a>.
</p>

<!-- 示範 cg\html\request_url('profile') -->
<p>goto: <a href="<?=cg\html\request_url('profile')?>">profile</a>.
</p>

<!-- 示範 cg\html\script() -->
<?php
cg\html\script([
    'js/jquery-3.3.1.slim.min.js',
    'js/popper.min.js',
    'js/bootstrap.min.js'
    ]);
?>

</body>
</html>

~~~

假設 index.php 的 URL 是 http://your_host/myweb/index.php ，則上例視圖的實際產出內容如下:

~~~html

<head>
<meta charset="utf-8">

<meta http-equiv="refresh" content="30">

<title>cg\html functions demo</title>

<!-- 示範 cg\html\stylesheet() -->
<link rel="stylesheet" href="//your_host/myweb/css/bootstrap.min.css">
<link rel="stylesheet" href="//your_host/myweb/css/theme/base.css">
<link rel="stylesheet" href="//your_host/myweb/css/theme/dark.css">

</head>

<body>

<div>
<!-- 示範 cg\html\resource_url('images/logo.png') -->
<img src="//your_host/myweb/images/logo.png">
</div>

<!-- 示範 cg\html\home_url() -->
<p>goto: <a href="//your_host/myweb/index.php">home</a>.
</p>

<!-- 示範 cg\html\request_url('profile') -->
<p>goto: <a href="//your_host/myweb/index.php/profile">profile</a>.
</p>

<!-- 示範 cg\html\script() -->
<script src="//your_host/myweb/js/jquery-3.3.1.slim.min.js"></script>
<script src="//your_host/myweb/js/popper.min.js"></script>
<script src="//your_host/myweb/js/bootstrap.min.js"></script>

</body>
</html>

~~~
