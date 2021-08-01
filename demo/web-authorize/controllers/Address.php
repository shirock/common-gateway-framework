<?php
class Address
{
    function index()
    {
        echo '此頁面不需認證。';
        return HttpResponse::OK;
    }

    /**
     * @authorize
     */
    function get($username)
    {
        // 實際是用 $username 自資料庫查出地址
        $result = [
            'owner' => $username,
            'address' => $username . ' address',
            'pcode' => '987'
        ];

        // 這是 RESTful API 與 Web 兩用的作法。
        // 如果 client 的 Accept 標頭要求是 application/json ，CG 就會回傳 JSON 內容。
        // 否則，CG 就會 extract($result) ，變成視圖中的 $owner, $address, $pcode 變數。
        return $result;
    }
}
?>