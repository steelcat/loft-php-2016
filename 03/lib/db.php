<?php
/**
 * @param string $db_host
 * @param string $db_name
 * @param string $db_username
 * @param string $db_password
 * @return array|PDO
 */
function db_connect($db_host, $db_name, $db_username = 'root', $db_password = '')
{
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    try {
        $connection = new PDO($dsn, $db_username, $db_password, $opt);
        return $connection;
    } catch (PDOException $e) {
        return [false, 'Database Error: ' . $e->getMessage()];
    }
}
