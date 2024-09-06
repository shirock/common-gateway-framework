# CommonGateway Framework

PHP version request: 7.3 ~ 8.3. 7.0 may also usable.

我測試了 PHP 8.1~8.3 的相容性，沒問題 (2022-2024年)。

## 介紹

CommanGateway Framework 是一個極小化的 PHP Web 框架。它的主程式就只有一個檔案 - [index.php](main/index.php) 。我原先甚至不將它稱為 framework ，而只是一個導入器。但解釋麻煩，還是按一般認知，當它是框架吧。

使用手冊請看 [doc目錄](doc)。

使用範例請見 [demo目錄](demo)。api 開頭的是 RESTful API 設計範例。 web 開頭的是網站設計範例。 default 開頭的是預設功能範例。

注意， demo 下的 index.php 可能是舊版本。請下載 [main/index.php](main/index.php) 。

## 概念

CommonGateway 主要設計目的是用於設計 RESTful API 或是 Single page web app 。它按照 MVC 的設計模式，將 Web 應用服務分成三個部份，即資料模型(Model)、流程控制項(Controller)與視圖(View)。 CommonGateway 替設計人員處理控制項與視圖工作。至於資料模型則不是 CommonGateway 的責任。資料模型由設計人員透過其偏好的資料庫框架處理。

CommonGateway 為設計人員完成下列工作:

* 根據 URL 路徑(PATH_INFO) 選擇 Web 應用服務的控制項。正是這「依路徑選擇目標」的行為特徵，而且又是 Common Gateway Interface (CGI) 的實作項目，故我將此項目命名為 CommonGateway 。
* 它會將客戶端送出的文件資料，預先處理成關聯式陣列結構。除了傳統的 Query string 與 Form data ，它也能處理 HTTP PUT Method 會送出的資料。它也支援 JSON 型態的資料。
* 它會根據 RESTful 的原則，調用對應的控制項方法。
* 它會根據控制項方法的回傳結果與客戶端期望的文件回應型態，處理對應的視圖樣板。
* 它會儘量透過外部注入的方式，將其他資源放入控制項 (即 IoC 模式)，減少對原有程式碼的侵入性。

更多內容請參閱: [CommonGateway 介紹](http://rocksaying.tw/archives/21318202.html) 。
