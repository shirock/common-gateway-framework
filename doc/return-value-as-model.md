控制項方法回傳資料如何成為視圖的資料來源(model)
===============================================

控制項回傳資料處理規則
----------------------

CommonGateway 會先調用控制項方法，並接收方法回傳值。然後按下列規則處理回傳值，變成視圖內的 $model 變數。

* 若為 null (或無回傳值): 大部份控制項的方法不回傳內容，故這是預設行為。
  此時會將控制項的公開屬性當作資料來源(model)，將控制項的公開屬性內容展開成視圖活動範圍內的區域變數。
  例如控制項有公開屬性 title ，CommonGateway 會將此屬性指派為視圖的區域變數 $title 。
* 若為 true : 同回傳 null 的情形。
* 若為 false : 視同控制項自行處理回應工作， CommonGateway 不會繼續載入視圖。
* 若為介於 100 ~ 599 間的整數，視為控制項直接回傳 HTTP 狀態碼。
  CommonGateway 會將該狀態碼回傳給瀏覽器，而不載入任何視圖。
* 若為 array : CommonGateway 會將回傳的陣列視為資料來源，
  指派為視圖內的區域變數 $model，並將陣列內容展開成為視圖內的區域變數。
  注意，若陣列為數字索引陣列，則展開後的區域變數名稱之字首為 data_。
  例如 $model = array('a', 'b') ，則視圖內展開的區域變數內容將是
  $data_0 == 'a', $data_1 == 'b' ，餘類推。
* 若為 object : CommonGateway 會將回傳的個體視為資料來源，
  指派為視圖內的區域變數 $model。
  此時在視圖內將可以調用該個體的方法。這可以取代視圖輔助器(helper)。
* 若為 array 或 object ，則視圖內將同時分配一個和控制項名稱相同的別名(首字母小寫)。
  例如控制項 MyBook 回傳的資料為 object ，包含一個資料欄位 Title 。
  則在視圖內，可用 $model-&gt;Title 或 $myBook-&gt;Title 取得 Title 內容。
* 若為 cg\View 實體 (instance of cg\View class)，則根據 View 實體的 viewName 屬性載入指定的視圖。
  請看 [CommonGateway 的 View 類別](cg-view-class.md) 。

在視圖中調用控制項內容
----------------------

在視圖中取得資料的方法，除了透過控制項方法回傳值，還可以直接調用控制項屬性或方法。

視圖由 CommonGateway 本體調用，而非控制項。因此視圖的活動範圍處於 CommonGateway 本體內。
故視圖中的 `$this` 指向CommonGateway 本體。

CommonGateway 本體將本次活動的控制項名稱放在屬性 `$app_name`，控制項實體放在屬性 `$control`。
所以視圖透過 `$this->control` 就能調用控制項的公開屬性和公開方法。
