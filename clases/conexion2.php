<?php
class conexion2
{
    public const DBHOST = '167.114.169.207';
    public const DBUSER = 'informat_desarrollo';
    public const DBPASS = '!fuRCr3XR-tzv';
    public const DBNAME = 'informat_desarrollo_automatizacion';
    public $dsn = ('mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME);
    protected $conn = null;

    function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo 'conecta';
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }
    
    
}