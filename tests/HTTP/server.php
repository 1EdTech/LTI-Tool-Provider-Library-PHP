<?php

require __DIR__ . '/TestServer.php';
use IMSGlobal\LTI\Test\HTTP\TestServer;

$status = $_GET['status'];
if ($_GET['type'] == TestServer::RETURN_INPUT) {
    $body = file_get_contents('php://input');
} elseif ($_GET['type'] == TestServer::RETURN_HEADER) {
    $body = isset($_SERVER['HTTP_' . strtoupper($_GET['value'])]) ? $_SERVER['HTTP_TEST'] : '';
} elseif ($_GET['type'] == TestServer::RETURN_VALUE) {
    $body = $_GET['value'];
} else {
    $body = '';
}

http_response_code($status);
echo $body;
