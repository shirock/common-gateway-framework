<?php
// default home controller
class Home
{
    function index()
    {
        $o = new Load1();
        echo $o->hi(), '<br>';

        $o = new Abc\Load2();
        echo $o->hi(), '<br>';

        $o = new Xyz\Abc_Load3();
        echo $o->hi(), '<br>';

        $o = new Load5();
        echo $o->hi(), '<br>';

        return HttpResponse::OK;
    }
}
?>