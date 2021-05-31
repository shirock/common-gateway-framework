CommonGateway 的 HTTP 狀態碼與方法
==============================

CommonGateway 定義了一個 HttpResponse 類別，其中包含靜態方法和常數，讓控制項回應 [HTTP 狀態碼 (HTTP status code)](http://en.wikipedia.org/wiki/List_of_HTTP_status_codes) 。

基本方法
-------

* HttpResponse::status($statusCode, $message = false, $exit_program = true)
* HttpResponse::exception($statusCode, $message = false)

status() 和 exception() 差別在其對應的 HTTP 狀態碼語意。

HTTP 狀態碼不是 2xx 的，就是錯誤狀態，應該用 exception() 。呼叫它後就會結束程式。

HTTP 狀態碼是 2xx 的，代表正常狀態，只是回傳內容給客戶端的方式不同。一般狀況呼叫 status() 時， $exit_program 參數應為 false 。因為後續需要回傳其他內容。

HTTP 協定允許狀態碼後加上說明狀態碼的訊息文字，雖然很少用。參數 $message 就是使用者自訂的訊息文字。若省略就使用預設訊息。例如 404 狀態碼的預設訊息是 "Not Found" 。

範例:

~~~php

// code number
HttpResponse::exception(400);

// const symbolic
HttpResponse::exception(HttpResponse::BAD_REQUEST);

// equal
header("HTTP/1.0 400 Bad Request");
exit;

~~~

特定狀態碼方法及列表
----------------

為了縮短程式碼，也提供了特定狀態碼方法。範例:

~~~php

// formal
HttpResponse::exception(HttpResponse::BAD_REQUEST);

// short
HttpResponse::badRequest();

~~~

有些狀態碼方法會有兩種名稱，一種用底線分隔形式，另一種則是符合 [PHP 程式碼風格指南 PSR-1](https://www.php-fig.org/psr/psr-1/) 的命名形式。這些方法內部呼叫 HttpResponse::exception() ，故回報 HTTP 狀態碼後就會結束程式。

CommonGateway 常用 HTTP 狀態碼方法列表:

* HttpResponse::bad_request($msg=false)
* HttpResponse::badRequest($msg=false)
* HttpResponse::unauthorized($msg=false)
* HttpResponse::payment_required($msg=false)
* HttpResponse::paymentRequired($msg=false)
* HttpResponse::forbidden($msg=false)
* HttpResponse::not_found($msg=false)
* HttpResponse::notFound($msg=false)
* HttpResponse::method_not_allowed($msg=false)
* HttpResponse::methodNotAllowed($msg=false)
* HttpResponse::not_acceptable($msg=false)
* HttpResponse::notAcceptable($msg=false)
* HttpResponse::request_timeout($msg=false)
* HttpResponse::requestTimeout($msg=false)
* HttpResponse::conflict($msg=false)
* HttpResponse::gone($msg=false)
* HttpResponse::internal_server_error($msg=false)
* HttpResponse::internalServerError($msg=false)
* HttpResponse::not_implemented($msg=false)
* HttpResponse::notImplemented($msg=false)
* HttpResponse::bad_gateway($msg=false) 
* HttpResponse::badGateway($msg=false) 
* HttpResponse::service_unavailable($msg=false)
* HttpResponse::serviceUnavailable($msg=false)

狀態碼常數列表
-----------

HttpResponse 類別定義的狀態碼常數列表:

* HttpResponse::SWITCHING_PROTOCOLS = 101;
* HttpResponse::PROCESSING = 102;
* HttpResponse::CHECKPOINT = 103;
* HttpResponse::OK = 200;
* HttpResponse::CREATED = 201;
* HttpResponse::ACCEPTED = 202;
* HttpResponse::NON_AUTHORITATIVE_INFORMATION = 203;
* HttpResponse::NO_CONTENT = 204;
* HttpResponse::RESET_CONTENT = 205;
* HttpResponse::PARTIAL_CONTENT = 206;
* HttpResponse::MULTIPLE_CHOICES = 300;
* HttpResponse::MOVED_PERMANENTLY = 301;
* HttpResponse::FOUND = 302;
* HttpResponse::SEE_OTHER = 303;
* HttpResponse::NOT_MODIFIED = 304;
* HttpResponse::USE_PROXY = 305;
* HttpResponse::SWITCH_PROXY = 306;
* HttpResponse::TEMPORARY_REDIRECT = 307;
* HttpResponse::RESUME_INCOMPLETE = 308;
* HttpResponse::BAD_REQUEST = 400;
* HttpResponse::UNAUTHORIZED = 401;
* HttpResponse::PAYMENT_REQUIRED = 402;
* HttpResponse::FORBIDDEN = 403;
* HttpResponse::NOT_FOUND = 404;
* HttpResponse::METHOD_NOT_ALLOWED = 405;
* HttpResponse::NOT_ACCEPTABLE = 406;
* HttpResponse::PROXY_AUTHENTICATION_REQUIRED = 407;
* HttpResponse::REQUEST_TIMEOUT = 408;
* HttpResponse::CONFLICT = 409;
* HttpResponse::GONE = 410;
* HttpResponse::LENGTH_REQUIRED = 411;
* HttpResponse::PRECONDITION_FAILED = 412;
* HttpResponse::REQUEST_ENTITY_TOO_LARGE = 413;
* HttpResponse::REQUEST_URI_TOO_LONG = 414;
* HttpResponse::UNSUPPORTED_MEDIA_TYPE = 415;
* HttpResponse::REQUESTED_RANGE_NOT_SATISFIABLE = 416;
* HttpResponse::EXPECTATION_FAILED = 417;
* HttpResponse::UNPROCESSABLE_ENTITY = 422;
* HttpResponse::LOCKED = 423;
* HttpResponse::FAILED_DEPENDENCY = 424;
* HttpResponse::UNORDERED_COLLECTION = 425;
* HttpResponse::UPGRADE_REQUIRED = 426;
* HttpResponse::UNAVAILABLE_FOR_LEGAL_REASONS = 451;
* HttpResponse::INTERNAL_SERVER_ERROR = 500;
* HttpResponse::NOT_IMPLEMENTED = 501;
* HttpResponse::BAD_GATEWAY = 502;
* HttpResponse::SERVICE_UNAVAILABLE = 503;
* HttpResponse::GATEWAY_TIMEOUT = 504;
* HttpResponse::HTTP_VERSION_NOT_SUPPORTED = 505;
* HttpResponse::VARIANT_ALSO_NEGOTIATES = 506;
* HttpResponse::INSUFFICIENT_STORAGE = 507;
* HttpResponse::BANDWIDTH_LIMIT_EXCEEDED = 509;
