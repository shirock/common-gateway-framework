<?php
spl_autoload_register(function($fqnc) {
    $fqnc = ltrim($fqnc, '\\');

    if ($sep = strrpos($fqnc, '\\')) {
        $ns_path = str_replace('\\', DIRECTORY_SEPARATOR, substr($fqnc, 0, $sep)) . DIRECTORY_SEPARATOR;
        $class_name = substr($fqnc, $sep + 1);
    }
    else {
        $ns_path = '';
        $class_name = $fqnc;
    }
    $cls_path = str_replace('_', DIRECTORY_SEPARATOR, $class_name);
    $filepath = 'vendor' . DIRECTORY_SEPARATOR . 'classes' .
        DIRECTORY_SEPARATOR . $ns_path . $cls_path . '.php';

    echo 'vendor autoload: ', $filepath, '<br>';
    if (file_exists($filepath))
        require $filepath;
});
?>