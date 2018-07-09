<?php
class Database{
    var $con;
    var $url;
    var $user;
    var $psw;

    function __construct($_url,$_user,$_psw){
        $this->con ="";
        $this->url = $_url;
        $this->user = $_user;
        $this->psw = $_psw;
        $this->con = $this->con_open($_url,$_user,$_psw);
    }

    private function con_open($_url,$_user,$_psw){
        $connection = mysqli_connect($_url,$_user,$_psw);
            if (!$connection)
            {
                die('Could not connect: ' . mysqli_error());
            }
        return $connection;
    }

    public function selectDB($param){
        $db_table=mysqli_select_db($this->con,$param);
        if (!$db_table){
            die('Could not select DB:' . mysqli_error());
        }
    
    }

    public function query($sql){
        $result = mysqli_query($this->con,$sql);
            if(!$result){

            }else{      
                    return $result;
                }
    }

    public function fetch($result){
        $row = mysqli_fetch_array($result);
        return $row;
    }

    public function con_close(){
         mysqli_close($this->con);
    }
}



?>