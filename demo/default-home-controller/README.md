CommonGateway Framework 的第二種首頁建立範例。

* 建立一個名為 Home 的控制項(controller): 定義 Home 類別，實作 index 方法。
* 建立 Home 控制項 index 方法的視圖(view): views/home/index.phtml 。

當使用者執行 CommonGateway 但沒有指定控制項時，若有 Home 控制項就會執行這個控制項。
讓使用者不必輸入 your_site/index.php/home 這種 URL 。

當你用 CommonGateway Framework 設計一個網站時，建議用這個方式建立你的網站首頁。此途徑可以使用 CommonGateway Framework 提供的所有資源。例如 @resource 、 @authorize 。

使用 cg\html 空間內的 HTML 函數，取得正確的 URL 路徑。

* cg\html\home_url()
* cg\html\request_url()
* cg\htmn\redirect()
* cg\html\resource_url()
* cg\html\stylesheet()
* cg\html\script()
