<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=' . (defined('COMPANY_DB') ? COMPANY_DB : 'trading-test'),
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 'trade_'
];
