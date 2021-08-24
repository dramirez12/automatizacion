<?php
class conexion2
{
    private const DBHOST = '167.114.169.207';
    private const DBUSER = 'informat_desarrollo';
    private const DBPASS = '!fuRCr3XR-tzv';
    private const DBNAME = 'informat_desarrollo_automatizacion';
    private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . self::DBUSER. self::DBPASS.'';
    protected $conn = null;

    function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo 'conecta';
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }
    
    
}