CommonGateway 的 View 類別
==========================

CommonGateway 在 cg namespace 內定義了一個 View 類別 (cg\View)。

CommonGateway Framework 預設規則是按照控制項方法名稱載入同名視圖。
例如調用 App1.index() 控制項方法之後，默認載入 views/App1/index 視圖。

若想讓控制項方法自行指定視圖，則控制項方法要回傳 cg\View 實例。
此方式讓不同的控制項方法共用同一個視圖，減少重複的視圖文件。
例如不同的控制項共用同一個錯誤訊息視圖。

cg\View 的建構方法有兩個參數:

* string $view_name
  必要參數。指定視圖名稱。注意，視圖名稱不包含副檔名。
* var $model
  選擇性參數。傳給視圖的 Model 內容。若省略時，表示用控制項本身就是 Model 。

使用範例: [讓控制項自己指定要用的視圖](../demo/web-cg-view)。

範例:

~~~php

<?php
class App1
{
    function index()
    {
        $model = [
            'title' => 'App1',
            'message' => 'Hello'
        ];

        // 載入默認的 views/App1/index 處理 $model
        // return $model;

        // 回傳 cg\View 實例，載入 views/Common/ok 視圖
        return new cg\View('Common/ok', $model);
    }
}
?>

~~~
