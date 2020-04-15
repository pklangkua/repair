<?php
class connectDB{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";	
    private $db = "repair";  
    public $mysqli;

    public function __construct() {
            $this->db_connect();
    }
    
    private function db_connect(){
            $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
                    if (mysqli_connect_errno()){
                            $message  = 'DB CONNECT ERROR : ' . mysqli_connect_errno();
                            die($message);
                    }
            mysqli_set_charset($this->mysqli,"utf8");
            return $this->mysqli;
    }
    
    public function return_sql($sql){
            $result = $this->mysqli->query($sql);
                    if ($result){
                            $arrData   = array();
                            while ($rows = mysqli_fetch_array($result)) {$arrData[] = $rows;}
                    }else{ 
                            $message  = 'ชุดคำสั่งของ : ' . $sql . " ไม่ถูกต้อง";
                            die($message);
                    } 
            return $arrData;
            mysqli_close($this->mysqli);
    }
    
    
    public function record_count($sql){
            $result = $this->mysqli->query($sql);
            $num_rows = mysqli_num_rows($result);
            return $num_rows;
            mysqli_close($this->mysqli);
    }
    
    
    public function exe($sql){
            $result = $this->mysqli->query($sql);
            if (!$result) {
                    $message  = 'ชุดคำสั่งของ : ' . $sql . " ไม่ถูกต้อง";
                    die($message);
            }
            mysqli_close($this->mysqli);
    }
}


/*--------------------

$conn = new connectDB;
$sSql = "INSERT table_po (po_name) VALUES ('รับทำเว็บ')";
$conn->exe($sSql);

$conn = new connectDB;
$sSql = "UPDATE table_po SET po_name = 'สยามโฟกัส' WHERE po_id=2";
$conn->exe($sSql);

$conn = new connectDB;
$sSql = "DELETE FROM table_po WHERE po_id=3";
$conn->exe($sSql);

$conn = new connectDB;
$sSql = "SELECT * FROM table_po";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);
if($recCount>0){
	for ($sLoop=0;$sLoop<$recCount;$sLoop++){
		print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "
";
	}
}

-------------------*/