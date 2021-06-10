<?php
class Authorize
{
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
            return HttpResponse::OK;
        }

        // 認錯失敗，取消授權
        unset($_SESSION['Authorization']);
        return HttpResponse::FORBIDDEN;
    }

    function delete()
    {
        unset($_SESSION['Authorization']);
        return HttpResponse::OK;
    }

    private function checkPassword($username, $passwd)
    {
        // 示範用。實務取自密碼庫。
        return ($username == 'rock' and $passwd == 'hello');
    }
}
?>