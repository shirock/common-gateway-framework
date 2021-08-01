Authorize 註記應用於 網站設計 之範例
=======================================

* 建立一個名為 Authorize 的控制項(controller): 實作 index(), post() 與 delete()。
* Authorize 建立視圖 index.phtml 顯示登入表單，視圖 post.phtml 顯示登入認證結果。
* 建立 MemberList 控制項，此控制項全部方法皆要求授權。
* MemberList 建立視圖 index.phtml 顯示會員列表。
* 建立 Address 控制項，此控制項只有 get() 方法要求授權。
* Address 建立視圖 get.phtml 顯示指定會員的地址。
