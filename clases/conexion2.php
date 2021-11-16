<?php
class conexion2
{
    public const DBHOST = '51.222.86.251';
    public const DBUSER = 'informat_informaticaunah2';
    public const DBPASS = 'WAc$W]74{Qo-v';
    public const DBNAME = 'informat_automatizacion';
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