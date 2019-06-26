<?php
$base_namespace = "sinri\\aliyun\\sls";
$base_path = __DIR__;
$extension = ".php";

spl_autoload_register(function ($class_name) use ($base_namespace, $base_path, $extension) {
    if (strpos($class_name, $base_namespace) === 0) {
        $class_file = str_replace($base_namespace, $base_path, $class_name);
        $class_file .= $extension;
        $class_file = str_replace('\\', '/', $class_file);
        require_once $class_file;
    }
});