Компонент Yii2 для перевода текста с одного языка на другой    
------
 
установка
------------
выполнить
```
php composer.phar require "rybinden/yii2-translate"
```
или добавить в секцию require  файла composer.json 
```json
"rybinden/yii2-translate" : "*"
```
и запустить команду обновления
Далее нужно добавить компонент в ваш конфигурационный файл
```php
'components' => [
'translate' => [
'class' => 'rybinden\translate\YandexTranslate',
'key' => 'ваш_ключ_приложения', // http://api.yandex.com/key/keyslist.xml
//'lang' => 'ru', установлено переводить на русский по умолчанию
],
...
]
```

использование
-------------
```php
echo Yii::$app->translate->translate('Эта строка будет переведена на английский'); // можно указать второй параметр - язык, на который нужно перевести
```
