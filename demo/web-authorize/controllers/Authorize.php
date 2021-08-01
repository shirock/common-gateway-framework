<?php
class Authorize
{
    function index()
    {
        // 只是為了讓 CGF 知道這個控制項提供 index 方法，以載入 index.phtml 
        // index.phtml 會顯示登入表單
    }

    function post()
    {
        if (isset($_POST['username']) and 
            isset($_POST['password']) and 
            $this->checkPassword($_POST['username'], $_POST['password']))
        {
            // 示範用。實務取自資料庫。
            $member_data = [
                'name' => 'rock',
                'address' => 'rocksaying',
                'level' => 99
            ];

            // 給予授權書
            $_SESSION['Authorization'] = $member_data;
        }
        else {
            // 認錯失敗，取消授權
            unset($_SESSION['Authorization']);
        }
    }

    function delete()
    {
        unset($_SESSION['Authorization']);
        cg\html\redirect('Authorize');
    }

    private function checkPassword($username, $passwd)
    {
        // 示範用。實務取自密碼庫。
        return ($username == 'rock' and $passwd == 'hello');
    }
}
?>