<?php
namespace App\Helpers;

use Illuminate\Support\HtmlString;

class ReCaptchaEngine
{
    protected static $version = "v3";
    protected static $api_key;
    protected static $api_secret;
    protected static $is_init;
    protected static $is_enable = false;
     protected static $actions = [];

    public static function scripts()
    {
        if (!self::isEnable()) return false;
        ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(self::$api_key); ?>" async defer></script>
        <script>
            function executeReCaptcha(action) {
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?php echo e(self::$api_key); ?>', { action: action }).then(function(token) {
                        document.querySelector('input[name="g-recaptcha-response"]').value = token;
                    });
                });
            }

            document.addEventListener("DOMContentLoaded", function () {
                executeReCaptcha('contact_form');
            });
        </script>
        <?php
    }

    // public static function captcha($action = 'default')
    // {
    //     if (!self::isEnable()) return false;
    //     return new HtmlString('<input type="hidden" name="g-recaptcha-response" value="">');
    // }
    
    public static function captcha($action = 'default')
    {   
        // dd($action);
        if (!self::isEnable()) return false;
        
        // Generate unique action ID to prevent duplicates
        static::$actions[$action] = $action . '_' . uniqid();
    
        return new HtmlString('<input type="hidden" name="g-recaptcha-response" id="'.e(static::$actions[$action]).'" value="">');
    }

    public static function isEnable()
    {
        self::maybeInit();
        return self::$api_key && self::$api_secret && self::$is_enable;
    }

    public static function maybeInit()
    {
        if (self::$is_init) return;
        self::$api_key = setting_item('recaptcha_api_key');
        self::$api_secret = setting_item('recaptcha_api_secret');
        self::$is_enable = setting_item('recaptcha_enable');
        self::$is_init = true;
    }

    public static function verify($response)
    {
        if (!self::isEnable()) return true;

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret'   => self::$api_secret,
            'response' => $response
        ];
        $verify = static::file_get_contents_curl($url, true, $data);
        $captchaVerify = json_decode($verify, true);

        return $captchaVerify['success'] == true && $captchaVerify['score'] >= 0.5;
    }

    public static function file_get_contents_curl($url, $isPost = false, $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        if ($isPost) {
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
