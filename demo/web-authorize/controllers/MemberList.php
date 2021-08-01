<?php
/**
 * @authorize
 */
class MemberList
{
    function index()
    {
        $this->list = [
            'abc',
            'rock',
            'xyz'
        ];

        // CG 將自動指派此控制項的屬性為視圖的可用變數
        // 此例就是控制項的 $this->list 變視圖的 $list 。
        return;
    }
}
?>