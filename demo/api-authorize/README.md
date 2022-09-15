Authorize 註記應用於 RESTful API 之範例
=======================================

實作說明請看 [Authorize 認證註記功能教學](https://www.rocksaying.tw/archives/2021/CommonGateway_authorize.html)。

* 建立一個名為 Authorize 的控制項(controller): 實作 post() 與 delete()。
* 建立 MemberList 控制項，此控制項全部方法皆要求授權。
* 建立 Address 控制項，此控制項只有 get() 方法要求授權。

此範例僅示範 JSON 文件的 API 設計。所以不準備任何視圖。
控制項方法直接回傳 model 或狀態碼。

試用本範例，請使用你的 RESTful client 工具。

Headers 一律設置:

* Accept: application/json
* Content-Type: application/json

登入操作
-------

URL: demo/api-authorize/index.php/Authorize

Method: POST

Body: `{"username": "rock", "password": "hello"}`

帳密相符時回應 200 OK。若不符合則回應 403 Forbidden。

登出操作
--------

URL: demo/api-authorize/index.php/Authorize

Method: DELETE

查看 MemberList
--------------

URL: demo/api-authorize/index.php/MemberList

Method: GET

已登入則回應 200 OK ，Body:

```
{
  "name": "rock",
  "address": "rocksaying",
  "level": 99
}
```

未登入則回應 401 Unauthorized 。
