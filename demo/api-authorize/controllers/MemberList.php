<?php
/**
 * @authorize
 */
class MemberList
{
    function index()
    {
        $member_data = $_SESSION['Authorization'];
        return $member_data;
    }
}
?>