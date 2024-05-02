<?php

use Tianyage\PhpEnv\EnvLoader;

if (!function_exists('env')) {
    /**
     * 获取.env变量
     *
     * @param string     $key     支持.字符获取二级内容 例：app.ver，传入空字符串将获取全部
     * @param mixed|null $default 设置默认值
     *
     * @return mixed
     */
    function env(string $key, mixed $default = null): mixed
    {
        $loader = new EnvLoader();
        return $loader->get($key, $default);
    }
}