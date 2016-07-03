<?php
namespace rybinden\translate;
use yii\base\Object;

 /**
 * Виджет для выбора алиаса из заголовка
 * @link http://2amigos.us
 */
class YandexTranslate extends Object
{
    const API_URL = 'https://translate.yandex.net/api/v1.5/tr.json/';

    public $key; // http://api.yandex.com/key/keyslist.xml
    public $format = 'plain'; //html или plain
public $lang = 'ru'; //На какой язык переводим по умолчанию
    private static $_curlInstance;

    public function __destruct(){
        // Если у нас открыт экземпляр curl, то нужно его закрывать
        if (!is_null(self::$_curlInstance))
            curl_close(self::$_curlInstance);
    }
// https://tech.yandex.com/translate/doc/dg/reference/translate-docpage/
    public function translate($text, $lang= false)
    {
        $method = "translate";
            $params = [
'text' => $text, //исходный текст
'lang' => $lang?$lang:$this->lang,
];
        $data =  $this->sendRequest($method, $params);
return implode('<br>', $data['text']);
    }

// Отправка  на сервер
    private function sendRequest($method, $params)
    {
        if (is_null(self::$_curlInstance))
            self::$_curlInstance = curl_init();

            $params['format'] = $this->format;
            $params['key'] = $this->key;

        $url = self::API_URL . $method . '?' . http_build_query($params);
        curl_setopt(self::$_curlInstance, CURLOPT_URL, $url);
        curl_setopt(self::$_curlInstance, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec(self::$_curlInstance), true);
        if (isset($result['code']) && $result['code'] > 200) {
            throw new \Exception($result['message'], $result['code']);
        }
        return $result;
    }
}