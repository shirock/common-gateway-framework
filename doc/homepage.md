CommonGateway 的預設首頁
=====================

CommonGateway 有兩種方式建立預設首頁。

1. 建立 views/index.phtml 。範例 [default-index-page](../demo/default-index-page)。
2. 建立一個名為 Home 的控制項(controller): 定義 Home 類別，實作 index 方法。範例 [default-home-controller](../demo/default-home-controller);

當使用者執行 CommonGateway 但沒有指定控制項時，若有 views/index.phtml 或 Home 控制項就會執行它。讓使用者不必輸入 your_site/index.php/home 這種 URL 。

如果你正利用 CommonGateway Framework 設計一組 RESTful API 服務，可以用第一種方式作 API 服務的索引頁。

當你用 CommonGateway Framework 設計一個網站時，建議用第二種方式建立你的網站首頁。此途徑可以使用 CommonGateway Framework 提供的所有資源。例如 @resource 、 @authorize 。
