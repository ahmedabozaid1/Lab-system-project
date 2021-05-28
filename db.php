<?php

class db
{
  private $IP ="localhost";
  private $USER='root';
  private $PASSWORD='';
  private $DATABASE='OOSE';
  private $conn ;
  private static $instance; //single database objec
  
 	function  __construct()
    {
        $this->conn=$this->db_connction($this->IP,$this->USER,$this->PASSWORD,$this->DATABASE);
    }

    public static function getInstance()
    {
        if(self::$instance==null)
        {
            self::$instance=new db();
            ///echo "new object <br>";
        }else{
           // echo "object is here <br>";
        }
        return self::$instance->conn;
        # code...
    }
    function  db_connction($IP,$USER,$PASSWORD,$DATABASE) {
        if( $connection = mysqli_connect($IP,$USER,$PASSWORD,$DATABASE))
        {
            return $connection;
        }else{
            die("database connection error");
        }
    }
   public function closeConnction()
    {
        //$this->conn->close();
        //echo "Connected closed successfully";
    }
    ///public function __destruct ( )
   /// {
   ///     $this->closeConnction();
  ///  }
    //$mysqli = new mysqli("localhost","my_user","my_password","my_db");
}
///for($i=0;$i<100;$i++)
///{
  ///  $db=db::getInstance();

//}