<?php
class App2
{
    function index()
    {
        $this->title = 'App2';
        $this->message = '另一個app的索引頁面訊息';

        // 這是載入默認的 views/App2/index.phtml 處理本控制項
        // return;

        // 回傳 cg\View 實例，必要建構參數是視圖名稱。
        // 載入 views/Common/ok.phtml 視圖，model 就是本控制項
        return new cg\View('Common/ok');
    }
}
?>