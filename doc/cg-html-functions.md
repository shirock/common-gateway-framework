CommonGateway 的 HTML 公用函數
=============================

CommonGateway 在 cg\html namespace 內提供了下列用於設計 Web 網站時的公用函數。
這些函數主要用在 phtml 視圖，目的是提供正確地資源 URL 。

* request_url($controller_path = false)
  取得基於 index.php 的控制項 URL 字串。
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
  指示 HTML 網頁的定期更新週期。內容是 *<meta http-equiv="refresh" content="$seconds">*。

範例:

~~~html

<head>
<meta charset="utf-8">

<?=cg\html\refresh(30)?>

<title>cg\html functions demo</title>

<?php
cg\html\stylesheet('css/bootstrap.min.css');

cg\html\stylesheet([
  'css/theme/base.css',
  'css/theme/dark.css'
]);
?>

<body>

<p>goto: <a href="<?=cg\html\request_url()?>">home</a>.
</p>

<p>goto: <a href="<?=cg\html\request_url('profile')?>">profile</a>.
</p>

<?php
cg\html\script([
    'js/jquery-3.3.1.slim.min.js',
    'js/popper.min.js',
    'js/bootstrap.min.js'
    ]);
?>

<script>
</script>
</body>
</html>

~~~

假設 index.php 的 URL 是 http://your_host/myweb/index.php ，則上例視圖的實際顯示結果如下:

~~~html

<head>
<meta charset="utf-8">

<meta http-equiv="refresh" content="30">

<title>cg\html functions demo</title>

<link rel="stylesheet" href="/myweb/css/bootstrap.min.css">
<link rel="stylesheet" href="/myweb/css/theme/base.css">
<link rel="stylesheet" href="/myweb/css/theme/dark.css">

<body>

<p>goto: <a href="/myweb/index.php">home</a>.
</p>

<p>goto: <a href="/myweb/index.php/profile">profile</a>.
</p>

<script src="/myweb/js/jquery-3.3.1.slim.min.js"></script>
<script src="/myweb/js/popper.min.js"></script>
<script src="/myweb/js/bootstrap.min.js"></script>

<script>
</script>
</body>
</html>

~~~
