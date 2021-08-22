<?php
class File
{
    /**
     * 瀏覽器會嘗試直接顯示檔案內容。
     * File will be displayed inline in the browser.
     */
    function Show()
    {
        header('Content-Type: image/png; charset=utf-8');

        readfile('demo.png');
        return HttpResponse::OK;
    }

    /**
     * 瀏覽器不會直接顯示，而是下載檔案並儲存，並可由server端指定檔案名稱。
     * 如果使用者設定瀏覽器下載前要提示的話，使用者將會看到檔案下載的對話視窗。
     * File will be downloaded and saved locally.
     */
    function Download()
    {
        header('Content-Type: image/png; charset=utf-8');
        header("Content-Disposition: attachment; filename*=UTF-8''中文檔名範例.png; filename=中文檔名範例2.png");
        // RFC-5987
        // 又是 filename* 又是連續兩個單引號，這 header 雖然奇怪，
        // 但確實是 HTTP 協定的「正式」用法。
        // 然而有些瀏覽器只認後面那個 filename 。
        header('Content-Length:' . filesize('demo.png'));

        readfile('demo.png');
        return HttpResponse::OK;
    }
}
?>