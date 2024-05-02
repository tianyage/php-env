<?php

namespace Tianyage\PhpEnv;

class EnvLoader
{
    /**
     * @var array
     */
    private static array $env = [];
    
    /**
     * @param string $envFile .env文件路径
     */
    public function __construct(private readonly string $envFile = '')
    {
        if (empty(self::$env)) {
            self::$env = $this->loadEnv($envFile);
        }
    }
    
    /**
     * 获取当前加载的.env文件路径
     *
     * @return string
     */
    public function getEnvPath(): string
    {
        return $this->envFile;
    }
    
    
    /**
     * 读取.env文件配置
     *
     * @param string     $key     支持.字符获取二级内容 例：app.ver，传入空字符串将获取全部
     * @param mixed|null $default 设置默认值
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        // 未传入key时获取全部内容
        if ($key === '') {
            return static::$env;
        } else {
            if (str_contains($key, '.')) {
                [
                    $one,
                    $two,
                ] = explode('.', $key);
                $config = static::$env[$one][$two] ?? $default;
            } else {
                $config = static::$env[$key] ?? $default;
            }
            return $config;
        }
    }
    
    /**
     * @param string $envFile .env文件路径
     *
     * @return array
     */
    protected function loadEnv(string $envFile = ''): array
    {
        // 未传入env文件路径时，默认认为是composer引入的路径，向上跳2级来获取web根目录
        if (!$envFile) {
            $envFile = dirname(__DIR__, 2);
        }
        
        $env = [];
        if (is_file($envFile)) {
            $env = parse_ini_file($envFile, true);
        }
        return $env;
    }
}