認證授權註記 Authorize annotation
===============================

CommonGateway 以 @authorize 註記代為處理認證授權的流程。
設計人員需要設計認證用控制項。並在
其他要求授權的控制項方法 doc 中加上 @authorize 。

Required: php 7.3.0

* authorize v.
* authorization n.

認證用控制項
----------

認證用控制項為 *Authorize* 或 *Login* 。
若同時有這兩個控制項，只會調用 *Authorize* 。

CommonGateway 不規定認證控制項必須提供哪些方法。
要按設計者的設計意圖，決定認證控制項的需要提供什麼方法。
但大部份設計者是用 HTTP POST 方法遞交身份認證資料，所以通常要提供 `post()` 方法。
若設計者想要 PUT 方法遞交資料，那就要提供 `put()` 方法。

若是 CommonGateway 用於網站設計，則認證控制項一般還要 `index()` 方法及對應的 index.phtml 視圖，提供使用者輸入認證資料的表單。
再透過表單呼叫認證控制項的 `post()` 方法。

$_SESSION['Authorization']
--------------------------

授權時，必須設定 `$_SESSION['Authorization']` 為任意值，有效值甚至包括 false 。

CommonGateway 僅憑此條件 - `isset($_SESSION['Authorization'])` - 判定是否授權。

撤消授權，必須使用 `unset($_SESSION['Authorization'])` 。

CommonGateway 不管理授權細節，由設計者決定如何處理授權細節。

例如設計人員可直接將被授權人的代號、名稱等資料以陣列方式指派給 `$_SESSION['Authorization']` 。
或者 `$_SESSION['Authorization']` 僅儲存一個授權代碼，控制項自行按此代碼取得被授權人資料。

@authorize
----------

* 若控制項 doc 註記 @authorize ，則呼叫此控制項所有方法皆需經過認證授權。
* 若控制項方法 doc 註記 @authorize ，則呼叫此控制項方法需經過認證授權。

遇到 @authorize 註記時，CommonGateway 就依條件 `isset($_SESSION['Authorization'])`  判定授權狀態。若條件成立就呼叫執行控制項方法，若不成立則視場合決定後續動作:

* 當客戶端要求的文件型態不是 html 時(非網站應用):
  CommonGateway 會回應 UNAUTHORIZED 。因為按 RESTful 慣例，在非獲授權狀態下調用受管制方法時，應回應 UNAUTHORIZED 、FORBIDDEN 或 METHOD_NOT_ALLOWED 等狀態碼，以表示此方法受到管制。
* 當客戶端要求的文件型態是 html 時(網站應用):
  CommonGateway 轉調用控制項 *Authorize* 或 *Login* (重導向客戶端拜訪認證控制項)。

例如:

~~~php

// 例1: 控制項註記
/**
 此控制項所有方法都要求授權才可用。 
 @authorize
 */
class Book 
{
    // 在 class 處已註記所有方法要求授權。
    // 此處不必註記。
    function index()
    {
    }
}

// 例2: 僅註記某些方法
class List
{
    // 沒有 @authorize ，任何人可用。
    function index()
    {
    }
    
    /**
     此控制項的 post() 方法要求授權。
     @authorize
     */
    function post()
    {
    }
}

~~~

session cookie 參數
-------------------

CommonGateway 透過 PHP Session 機制處理授權狀態，這會用到 cookie 。
設計人員若想設定 session cookie 的使用參數，例如存續期間、限制範圍等，可以將參數儲存在  $web_folder/etc/session_cookie.json 或 $web_folder/etc/session_cookie.php 。

可設置參數請看 [session_set_cookie_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) 。

若用 session_cookie.php ，則陣列名稱是 `$options` ，例如:

~~~php

$options = [
'lifetime' => '3600',
'samesite' => 'Strict'
]

~~~
