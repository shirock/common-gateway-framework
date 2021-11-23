<?php
class App1
{
    function index()
    {
        $model = [
            'title' => 'App1',
            'message' => 'Hello'
        ];

        // 這是載入默認的 views/App1/index.phtml 處理 $model
        // return $model;

        // 回傳 cg\View 實例，必要建構參數是視圖名稱。
        // 載入 views/Common/ok.phtml 視圖
        return new cg\View('Common/ok', $model);
    }
}
?>