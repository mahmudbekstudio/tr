<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='  . (defined('COMPANY_DBHOST') ? COMPANY_DBHOST : 'localhost') . ';dbname=' . (defined('COMPANY_DB') ? COMPANY_DB : 'trading-test'),
    'username' => (defined('COMPANY_DBUSER') ? COMPANY_DBUSER : 'root'),
    'password' => (defined('COMPANY_DBPASS') ? COMPANY_DBPASS : ''),
    'charset' => 'utf8',
    'tablePrefix' => (defined('COMPANY_DBTABLEPREFIX') ? COMPANY_DBTABLEPREFIX : 'trade_')
];
