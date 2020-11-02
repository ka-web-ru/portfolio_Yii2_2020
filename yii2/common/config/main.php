<?php

use \kartik\datecontrol\Module;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['debug'],
    'language' => 'ru',
    'modules' => [
        //тут могут подключаться и другие модули
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '::1']
        ],
        // форматирование даты и времени
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:d.m.Y',
                Module::FORMAT_TIME => 'php:H:i',
                Module::FORMAT_DATETIME => 'php:d.m.Y H:i',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'yyyy-M-dd', // saves as unix timestamp
                Module::FORMAT_TIME => 'H:i:s',
                Module::FORMAT_DATETIME => 'yyyy-M-dd H:i:s',
            ],

            // set your display timezone
            // 'displayTimezone' => 'Asia/Kolkata',
            'displayTimezone' => 'UTC',

            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
        ],
        // построение древовидного меню
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ]
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // расширение для манипуляции картинками
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
            'dateFormat' => 'php: d.m.Y',
            'datetimeFormat' => 'php: d.m.Y H:i',
        ],
    ],
];