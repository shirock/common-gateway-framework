CommonGateway 與 CodeIgniter 的對照
===================================

CommonGateway 當初在設計時，除了 RoR 外，主要的參考對象就是 [CodeIgniter](https://codeigniter.org.tw/)。這裡列出兩者間的一些異同。

目錄規劃
--------

CI 分成 system/*, application/* 兩類。
CG 不分，只有一層。

CI:

~~~text

application/controllers
application/models
application/views
application/helpers
system/libraries

~~~

CG:

~~~text

controllers
views
helpers

~~~

Controller
----------

接在 index.php 後的路徑內容，都會被 Http server 保存在伺服器環境變數 PATH_INFO 。
PHP 可用 `$_SERVER['PATH_INFO']` 取得。

在 CI 與 CG 中，會用 PATH_INFO (`$_SERVER['PATH_INFO']`) 決定控制項、方法與參數。
我們將路徑分隔字元('/')分開的各項目稱為 segment (節)。
第一節是控制項名稱，第二節是方法名稱 (CG 還另有用法)，第三節之後的都是方法參數。

你可以把 URI 想像成命令列指令，差別在於 URI 要用 '/' 字元分隔參數。

例如: controller 是控制項名稱， say 是方法／指令， hello 是參數。

CLI:

~~~text

controller say hello

~~~

URI:

~~~text

index.php/controller/say/hello

~~~

CG 除了提供與 CI 相同的方法對應策略外，還提供 RESTful 形式的方法對應策略。
CG 首先根據客戶端送來的請求方法(REQUEST_METHOD)找尋控制項是否有對應的 get(), 
post(), put(), 或 delete() 方法。如果沒有，才根據URI路徑第二節的名稱找對應的
控制項方法。

注意，符合 RESTful 方法對應策略時，URI路徑第二節起的內容就會被視為方法參數。

舉例來說:

~~~php

class Controller1 {
    function delete($id) {
        $this->db->delete($id);
    }
}

~~~

以此 Controller1 的定義來說，下列兩個動作的結果相同，都是呼叫 `$controller1->delete('abc');` 。

1. URI是index.php/controller1/abc ，而客戶端請求方法(REQUEST_METHO)是DELETE。
   根據 REQUEST_METHOD 找到 delete() 方法，URI路徑第二節變成參數$id的內容。

2. URI是index.php/controller1/delete/abc ，而客戶端請求方法(REQUEST_METHO)是GET。
   由於控制項沒有定義 get() 方法，所以 CG 會以URI路徑第二節的內容 'delete' 搜尋控制項方法，而找到 delete() 。URI路徑第三節變成參數$id的內容。

View 與 Helper
--------------

CI 要由控制項(controller)自行載入。 CG 則用同名自動載入策略，但也允許控制項自行載入。

CG 著重在 RESTful 的內容回應，所以它可針對使用者的請求文件型態，決定回傳的文件內容。

舉例來說，如果使用者送來的 GET 請求標頭中指明要 JSON 文件 (Accept: application/json)，則 CG 會載入 views/name1/get.pjs 視圖。甚至 CG 對於 JSON 文件請求會自動呼叫 `json_encode()` ，不用準備視圖。

CG 的設計重點是 RESTful 案例。對於強調視覺樣式的網站設計案例， CG 提供的支援太少。如果你需要設計大型網站，建議用 CI 或 Laravel。

Config
------

CI 提供 Config class ，自動載入 application/config/config.php ，並可由使用者手動載入其他的組態內容。

CG 自動載入 etc/app_config.php ，並用 Auto-wire 技巧，由 index.php 往控制項中注入屬性內容。其中控制項屬性名稱符合下列關鍵字者，將被自動注入內容。詳閱 [resource-inject.md](resource-inject.md)。
