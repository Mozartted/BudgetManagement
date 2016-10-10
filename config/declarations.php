<?php
$ip = ( $_SERVER['REMOTE_ADDR'] == '::1' ) ?
    '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
define( 'IP', $ip );