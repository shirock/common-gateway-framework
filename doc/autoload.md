CommonGateway Autoload 規則
========================

CommonGateway Framework 在目錄 classes, libs 和 controllers 之中找尋要載入的類別。
檔案放置原則依循 [PSR-0: Autoloading Standard](https://www.php-fig.org/psr/psr-0/) 。

使用者自定的 autoload 規則與 Laravel 等其他框架一樣，應該寫在 vendor/autoload.php 。
CommonGateway Framework 也會引入它。

使用範例: [default-autoload](../demo/default-autoload)。
