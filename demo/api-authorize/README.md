Authorize 註記應用於 RESTful API 之範例
=======================================

* 建立一個名為 Authorize 的控制項(controller): 實作 post() 與 delete()。
* 建立 MemberList 控制項，此控制項全部方法皆要求授權。
* 建立 Address 控制項，此控制項只有 get() 方法要求授權。

此範例僅示範 JSON 文件的 API 設計。所以不準備任何視圖。
控制項方法直接回傳 model 或狀態碼。
