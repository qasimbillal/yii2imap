yii2 Imap
==========
This library can be used to read mails from IMAP server using PHP and Yii2.

Installation by composer
------------
```composer
{
    "require": {
       "qbilal/yii2-imap": "dev-master"
    }
}

Or

$ composer require qbilal/yii2-imap "dev-master"
```

### Config example

```php
'imap' => [
    'class' => '',
    'connection' => [
        'imapPath' => '',
        'imapLogin' => '',
        'imapPassword' => '',
        'serverEncoding' => 'utf-8',
        'searchEncoding' => 'US-ASCII',//MIME character set to use when searching strings. Not mandatory
        'attachmentsDir' => '/tmp',
        'decodeMimeStr' => false
    ]
]
```
