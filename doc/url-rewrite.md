用 URL 重寫規則隱藏 CGF
=======================

修改主程式檔名
--------------

改變 URL 形式最簡單的方式是修改主程式檔名。

Common Gateway Framework (CGF) 設計的所有服務 (RESTful API 或網頁) 都是透過主程式 *index.php*  轉發使用者的請求給控制項。
因此正常的 URL 根點總是 index.php，形式如下:

```text
https://your_server/api/index.php/Item
https://your_server/shop/index.php/Item/123
```

你可以按你的喜好修改 index.php 檔名，這不會影響 CGF 運作。
例如你可以改名為 router.php，或者是 main.php。此時你的服務 URL 形式就變成:

```text
https://your_server/api/router.php/Item
https://your_server/shop/main.php/Item/123
```

然而，有時候，你可能不想讓使用者看到 URL 內容中有 index.php 或 main.php，想要隱藏 CGF 主程式。
此時，你需要借助網站服務程式的 URL 重寫規則 (rewrite rule) 隱藏 CGF 主程式。

URL 重寫規則
------------

常見的網站服務程式，如 Apache, Nginx 甚至 IIS，都提供了 URL 重寫規則 (rewrite rule) 功能。
但每家的用法不一樣。底下以 Apache 2.4 為例，說明 URL 重寫規則。

舉例來說，你想將 RESTful API 的 URL 形式變成 https://your_server/api/Item。

你可以選擇將 URL 重寫規則寫在 .htaccess。.htaccess 應該放在 CGF 程式根目錄，和 index.php 在一起。
重寫規則如下:

```text
# .htaccess
RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule "(.*)" "index.php/$1" [PT,L]
```

註: 你的 *Directory* 組態至少要 *AllowOverride FileInfo* 才能使 .htaccess 生效。

基於執行效率的考量，建議將 URL 重寫規則寫在 *VirtualHost* 或 *Directory* 區段中。

```text
<Directory>
    RewriteEngine on

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule "^api/(.*)" "api/index.php/$1" [PT,L]
</Directory>
```

這個 URL 重寫規則使用 PT (Pass through) 旗標， URL 只會在伺服器內部轉換。使用者端不會改變。

若你的程式只提供 RESTful API，那你做到這一步就夠了。
但若你是用 CGF 設計網站，那你還需要在 Apache 組態中加入環境變數 *CGF_REQUEST_ROOT*，指示 URL 重寫規則的根點 (root)。

CGF_REQUEST_ROOT
----------------

當你用 CGF 設計網站時，勢必要在網頁中提供連結指向不同功能網頁(控制項)。
CGF 為此提供了函數 `\cg\html\request_url()` 產生控制項的正確 URL。
但這個函數是按正常規則產生 URL。也就是 https://your_server/api/index.php/Item 或 https://your_server/shop/main.php/Item/123 這種形式。

註: request_url() 會判斷你的 CGF 主程式檔名，所以你改變 index.php 檔名也不會影響。

當你使用 URL 重寫規則後，就會分出使用者看到的外顯 URL 和伺服器內部轉換後的真實 URL。
你必須用環境變數 *CGF_REQUEST_ROOT* 讓 `request_url()` 知道外顯 URL 的根點，它才能產生控制項的外顯 URL。
未指定 CGF_REQUEST_ROOT 時，`cg\request_url()` 將產生真實 URL，而不是你想要的。

如果你的外顯 URL 是像 https://your_server/shop/Item/123 ，則應設 CGF_REQUEST_ROOT 為 /shop 。

Apache2:

```text
SetEnv CGF_REQUEST_ROOT /shop
```

Nginx:

```text
fastcgi_param CGF_REQUEST_ROOT /shop
```
