\hyperjiang\BankCard
-----------

## 安装

编辑 composer.json 加入如下内容：

```json
{
  "repositories": [{
    "url": "https://github.com/hyperjiang/bankcard.git",
    "type": "git"
  }],
  "require": {
    "hyperjiang/bankcard": "dev-master"
  }
}
```

## 使用方法

```php

use hyperjiang\BankCard;

$info = BankCard::info('6225700000000000');
print_r($info);

```

## 输出结果

银行卡非法时输出空数组；

银行卡正确时输出：

```php
Array
(
    [bankCode] => CEB
    [bankName] => 中国光大银行
    [cardType] => CC
    [cardTypeName] => 信用卡
)
```
