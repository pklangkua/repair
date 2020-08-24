<?php
ob_start();
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
            }else{
                    return $ok=1;
            }
            mysqli_close($this->mysqli);
    }
}

class checkLogin
{
        public function chk_login()
        {
                if(isset($_SESSION['user'])=='') {
                        // user is not logged in, do something like redirect to login.php
                        header("Location: ../repair/login");
                }
        }
}

class CheckInternet  
{
        public function Chk_net()
        {
                if(!$sock = @fsockopen('www.google.com', 80))
                {
                        echo 'Not Connected';
                }
                else
                {
                        echo 'Connected';
                }
        }
}

class status  
{
        public function status()
        {
                        if(isset($_SESSION['user']) && isset($_SESSION['fullname'][0]))
                {
                        $username = $_SESSION['user'];
                        $fullname = $_SESSION['fullname'][0];
                }
                $conn = new connectDB;
                $sSql = "SELECT status_id,OfficeID FROM r_user WHERE username = '$username'";
		$arrData = $conn->return_sql($sSql);
		$recCount = $conn->record_count($sSql);
                if($recCount>0){
                        for ($sLoop=0;$sLoop<$recCount;$sLoop++){
                                $status = $arrData[$sLoop][0] ;
                                $OfficeID = $arrData[$sLoop][1] ;
                        }
                }
                return $status;
        }
        public function OfficeID()
        {
                        if(isset($_SESSION['user']) && isset($_SESSION['fullname'][0]))
                {
                        $username = $_SESSION['user'];
                        $fullname = $_SESSION['fullname'][0];
                }
                $conn = new connectDB;
                $sSql = "SELECT OfficeID FROM r_user WHERE username = '$username'";
		$arrData = $conn->return_sql($sSql);
		$recCount = $conn->record_count($sSql);
                if($recCount>0){
                        for ($sLoop=0;$sLoop<$recCount;$sLoop++){
                                $OfficeID = $arrData[$sLoop][0] ;
                        }
                }
                return $OfficeID;
        }
}

class category
{
        public function cat_chk($data)
        {
                if($data==1)
                {
                        echo "<span class='badge badge-danger' >แจ้งซ่อม<span>";
                }else if($data==2)
                {
                        echo "<span class='badge badge-warning' >กำลังดำเนินการ<span>";
                }else if($data==3)
                {
                        echo "<span class='badge badge-info' >รออะไหล่<span>";
                }else if($data==4)
                {
                        echo "<span class='badge badge-success' >ซ่อมสำเร็จ<span>";
                }else if($data==5)
                {
                        echo "<span class='badge badge-warning' >ซ่อมไม่สำเร็จ<span>";
                }else if($data==6)
                {
                        echo "<span class='badge badge-dark' >ยกเลิกการซ่อม<span>";
                }else if($data==7)
                {
                        echo "<span class='badge badge-success' >ส่งมอบเรียบร้อย<span>";
                }else if($data==8)
                {
                        echo "<span class='badge badge-danger' >ส่งต่อสำนักเทคฯ<span>";
                }else if($data==9)
                {
                        echo "<span class='badge badge-primary' >ส่งหน่วยงานภายนอก<span>";
                }else if($data==10)
                {
                        echo "<span class='badge badge-warning' >ซื้อใหม่ทดแทน<span>";
                } 
        }
}

class Line  
{
        public function LineNotify($message)
        {
                echo $message,"<br>";
                $url        = 'https://notify-api.line.me/api/notify';
                $token      = '1Uklyv5lv7ZSXfFBXiUq091FAVUV5Xnw08Gvl9KMppO';
                $headers    = [
                                'Content-Type: application/x-www-form-urlencoded',
                                'Authorization: Bearer '.$token
                            ];
                $fields     = 'message='.$message;
                 
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL, $url);
                curl_setopt( $ch, CURLOPT_POST, 1);
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec( $ch );
                curl_close( $ch );
                 
                var_dump($result);
                $result = json_decode($result,TRUE);
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