CommonGateway Framework 的類別自動載入規則 (Autoload) 範例。

CommonGateway Framework 在目錄 classes 和 libs 之中找尋要載入的類別。
檔案放置原則依循 [PSR-0: Autoloading Standard](https://www.php-fig.org/psr/psr-0/) 。

使用者自定的 autoload 規則與 Laravel 等其他框架一樣，應該寫在 vendor/autoload.php 。
CommonGateway Framework 也會引入它。

示範動作:

* autoload class Load1 from ./classes/Load1.php
* autoload class Abc\Load2 from ./libs/Abc/Load2.php
* autoload class Xyz\Abc_Load3 from ./libs/Xyz/Abc/Load3.php
* vendor autoload class Load5 from ./vendor/classes/Load5.php
