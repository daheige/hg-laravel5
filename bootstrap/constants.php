<?php
//路径常量定义
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__));
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . '/app');

// WEB 所在目录
defined('DOC_PATH') or define('DOC_PATH', ROOT_PATH . '/public');

//config配置目录
defined('CONF_PATH') or define('CONF_PATH', ROOT_PATH . '/config');

//助手函数目录
defined('FUNC_PATH') or define('FUNC_PATH', APP_PATH . '/functions');

// 外部库所在目录
// defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . '/vendor');

//文件日志存放目录
defined('LOG_PATH') or define('LOG_PATH', ROOT_PATH . '/storage/logs');

/**
 * 项目常量定义
 */

// 定义项目开始时间
defined('START_TIME') || define('START_TIME', microtime(true));

// 定义项目初始内存
defined('START_MEMORY') || define('START_MEMORY', memory_get_usage());

// 项目版本
define('SYS_VERSION', '1.0.0');

//定义环境变量APP_ENV (nginx配置：testing测试环境,local本地环境,production生产环境)
//fastcgi_param APP_ENV "TESTING";#TESTING;PRODUCTION;STAGING
define('APP_ENV', isset($_SERVER['APP_ENV']) ? strtolower($_SERVER['APP_ENV']) : 'production');

// 生产环境
defined('IS_PRO') or define('IS_PRO', is_file('/etc/php.env.production') || APP_ENV == 'production');
defined('PRODUCTION') or define('PRODUCTION', IS_PRO);

// 预发环境
defined('STAGING') || define('STAGING', is_file('/etc/php.env.staging'));

// 测试环境
defined('TESTING') || define('TESTING', is_file('/etc/php.env.testing'));

// 开发环境
defined('DEVELOPMENT') || define('DEVELOPMENT', !(IS_PRO || STAGING || TESTING));

//测试或本地环境打开调试模式，线上环境关闭
defined('APP_DEBUG') || define('APP_DEBUG', !IS_PRO || in_array(APP_ENV, ['testing', 'local']));

//js目录 相对于public目录
define('JS_SRC', '/' . (DEVELOPMENT || TESTING ? 'js_src' : 'js'));

/**
 * 环境常量定义
 */

// 定义是否 CLI 模式
define('IS_CLI', (PHP_SAPI === 'cli'));

// 定义是否 windows 环境
define('IS_WIN', (DIRECTORY_SEPARATOR === '\\'));

if (IS_CLI) {
    define('IS_AJAX', false);
    define('IS_CURL', false);
    define('API_MODE', false);
    define('HTTP_HOST', null);
    define('HTTP_PROTOCOL', null);
    define('HTTP_BASE', null);
    define('HTTP_URL', null);
} else {
    // 定义是否 AJAX 请求
    define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']));

    // 定义是否 cURL 请求
    define('IS_CURL', isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'], 'curl') !== false);

    // 定义当前是否为 API 模式
    define('API_MODE', isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/api/') !== false);

    // 定义主机地址
    if (isset($_SERVER['HTTP_HOST'])) {
        define('HTTP_HOST', strtolower($_SERVER['HTTP_HOST']));
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        define('HTTP_HOST', strtolower($_SERVER['HTTP_X_FORWARDED_HOST']));
    }

    // 定义 HTTP 协议
    define('HTTP_PROTOCOL', isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http');

    // 定义是否 SSL
    define('HTTP_SSL', isset($_SERVER['SERVER_PROTOCOL']) &&
        (strpos($_SERVER['SERVER_PROTOCOL'], 'HTTPS') !== false));

    // 定义当前基础域名
    define('HTTP_BASE', HTTP_PROTOCOL . '://' . HTTP_HOST . '/');

    // 定义当前页面 URL 地址
    define('HTTP_URL', rtrim(HTTP_BASE, '/') . $_SERVER['REQUEST_URI']);
}
