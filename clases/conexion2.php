<?php
class conexion2
{
    public const DBHOST = '51.222.86.251';
    public const DBUSER = 'informat_desarrollo';
    public const DBPASS = '^Kwd{PE^(L&#v';
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