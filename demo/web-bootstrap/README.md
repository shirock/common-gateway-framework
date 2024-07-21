使用 bootstrap 建立網站視圖之範例
============================

* 取得 BootStrap 和 jQuery 檔案，放置在你習慣的子目錄下。
* 在 html 視圖中，使用 CGF HTML 公用函數 cg\html\stylesheet(), cg\html\script() 產生載入 BootStrap 和 jQuery 檔案的 HTML 內容。
* 執行過程中，工作目錄都是 index.php 所在目錄，也就是網站的根目錄。因此在 html 視圖中引入其他檔案時，起始目錄一律是網站根目錄。 

使用 cg\html 空間內的 HTML 函數，取得正確的 URL 路徑。

* cg\html\home_url()
* cg\html\request_url()
* cg\htmn\redirect()
* cg\html\resource_url()
* cg\html\stylesheet()
* cg\html\script()
