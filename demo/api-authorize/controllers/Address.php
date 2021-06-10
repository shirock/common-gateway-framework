<?php
class Address
{
    function index()
    {
    }

    /**
     * @authorize
     */
    function get($addr)
    {
        $result = [
            'address' => $addr,
            'owner' => 'xyz',
            'pcode' => '987'
        ];
        return $result;
    }
}
?>