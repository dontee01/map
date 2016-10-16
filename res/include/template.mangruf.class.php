<?php

/**
 * Description of temp
 * for IKOGOSI resort
 * By MANGRUF.INC
 *
 * @author John
 */
class template {

var $host   = "localhost"; //database server
var $user     = "admin"; //database login name
var $pass     = "admin1"; //database login password
var $data = "bbn"; //database name
var $pre      = ""; //table prefix

#-#############################################
# desc: constructor
function template($host, $user, $pass, $data, $pre=''){
    $this->host=$host;
    $this->user=$user;
    $this->pass=$pass;
    $this->data=$data;
    $this->pre=$pre;
}#-#constructor()

    function title($name){
        echo "$name";
    }
    function head($param){
        
    }
    function  today($y,$m,$d){
        $format = "{$y}-{$m}-{$d}";
        $main = date($format);
        return $main;
    }
    function time(){
        $main = date('Y-m-d H:i:s');
        return $main;
    }
    function timeOnly(){
        $main = date('Y:d:H:i:s');
        return $main;
    }

        public $conn;

     function connect(){
        $host = $this->host;
        $user = $this->user;
        $pass = $this->pass;
        $data = $this->data;
                $this->conn = new mysqli($host,$user,$pass,$data);
                // if ($this->conn){
                //     $this->selct = mysql_select_db($data,$this->conn) or die(mysql_error());
                // }
                /*else {
                    return mysql_error();
                }*/
            }
            function  close(){
                $con = $this->conn;
                $con->close();
            }

            function disp_error()
            {
                $con = $this->conn;
                return $con->error;
            }


            function query($query=""){
                $con = $this->conn;
                $query = $con->query($query);
                if ($query){
                    return $query;
                } else {//*
                    return  $con->error;
                }
            }
            function rows($query=""){
                $con = $this->conn;
                $query = $query->num_rows;
                return $query;
            }
            function fetch($query=""){
                $con = $this->conn;
                $query = $query->fetch_array(MYSQLI_ASSOC);
                return $query;
            }
            function getrows($querystring=""){
                $query = $this->query($querystring);
                $result = $this->rows($query);
                $this->free($query);
                return $result;
            }
            function result($query=""){
                $query = $this->query($query);
                $result = $this->fetch($query);
                $this->free($query);
                return $result;
            }
            function free($query=""){
                $query->free();
            }
            function disconnect(){
                $con = $this->conn;
                $con->close();
            }
////////////////////////////
             function addFriend($sesus,$fus,$adpt,$ex){

                $qry = "INSERT INTO friends VALUES('0','0','$sesus','$fus','1')";
                $res = $this->ex($qry);
            }
            function showInfo($ka){
                $sql = "SELECT * FROM user WHERE name_usr = '".$_GET['un']."'";
                $res = $ka->query($sql);
                
                while ($fetch = $ka->fetch($res)){
                    extract($fetch);
                    echo $fname_usr.'<br />'
                    .$phone_usr.'<br />'
                    .$work_usr.'<br />'
                    .$hobbies_usr.'<br />';
                    if ($sex_usr == 1)
                        echo 'Male';
                    else {
                        echo 'Female';
                    }
                }
            }
            
            function checkLev($linkTo,$lev) {
                if ($lev >= 4){
                    echo '';
                }  else {
                    echo "$linkTo";
                }
            }
            
            function chkExist($tbl, $arg, $par){
                $chk = "SELECT * FROM $tbl WHERE $arg = '".$par."' ";
                $run = $this->query($chk);
                $row = $this->rows($run);
                if ($row > 0){
                    $out = 0;
                }else{
                    $out = 1;
                }
                $this->free($run);
                return $out;
            }

            function grade($sc){
                switch ($sc){
            case $sc >= 70 && $sc <= 100:
                $grade = 'A';
                break;
            case $sc >= 60 && $sc <= 69:
                $grade = 'B';
                break;
            case $sc >= 50 && $sc <= 59:
                $grade = 'C';
                break;
            case $sc >= 45 && $sc <= 49:
                $grade = 'D';
                break;
            case $sc >= 40 && $sc <= 44:
                $grade = 'E';
                break;
            case $sc >= 0 && $sc <= 39:
                $grade = 'F';
                break;
            default :
                $grade = 'AR';
                }
                return $grade;
            }

            function crc($rmt,$em,$dy,$date) {
                $sto = "abcdefghijkmnopqrstuvwxyz1023456789";
                
                $str_em = substr($em, 1,3);
                
                srand((double)microtime()*1000000);

                $a = explode(":", $date);
                $o =  $a[0].$a[1].$a[2];
                $p = $a[1].$a[0];
                $q = $o - $p;
                $i = 1;
                $confirm = '' ;
                while ($i <= 8) {
                    $num = rand() % 33;
                    $temp = substr($sto, $num, 1);
                    $confirm = $confirm . $temp;
                    $i++;
                }
                $confirm = $rmt.$dy.$str_em.$q.$confirm;
                return $confirm;
            }
            
            function hash($em,$date) {
                $sto = "AGLRSTabcUVWXYZdefBCDEFghijkmnop
                qHIJKrstuvwxyz1023MNOPQ456789";
                $str_em = substr(md5($em), 1,8);
                srand((double)microtime()*1000000);
                $a = explode(":", $date);
                $o =  $a[0].$a[1].$a[2];
                $p = $a[1].$a[0];
                $q = $o - $p;
                $q = substr(md5($q), 1, 8);
                $i = 1;
                $confirm = '' ;
                while ($i <= 12) {
                    $num = rand() % 33;
                    $temp = substr($sto, $num, 1);
                    $confirm = $confirm . $temp;
                    $i++;

                }
                $confirm = $str_em.$q.$confirm;
                return $confirm;
            }
            
            function compAuth($stud,$date) {
                $str_em = substr($stud, 1,3);
//                no random numbers, we need static identity here
//                srand((double)microtime()*1000000);
                $a = explode("-", $date);
                $o =  $a[0].$a[1].$a[2];
                $p = $a[1].$a[0];
                $q = $o - $p;
                $q = md5($q);
                $confirm = '' ;
                $confirm = $str_em.$q;
                return $confirm;
            }
            
            function ucaseFirst($str){
                $st = strtolower($str);
                $nst = ucfirst($st);
                return $nst;
            }
            
            function ucaseWord($str){
                $st = strtolower($str);
                $nst = ucwords($st);
                return $nst;
            }
            
            function clean($str) {
                $con = $this->conn;
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return $con->real_escape_string($str);
            }
            
            function hashh($date){
                $sto = "abcdefghijkmnopqrstuvwxyz1023456789";
                
                $a = explode(":", $date);
                $o =  $a[0].$a[1].$a[2];
                $p = $a[1].$a[0];
                $q = $o - $p;
                $nw = md5($q);
//                $nn = substr($nw, 10,16);
                
                $k = 1;
                $fst = '';
                while ($k <= 10) {

                    $num = rand() % 33;

                    $temp = substr($nw, $num, 1);

                    $fst = $fst. $temp;

                    $k++;

                }
                
                $i = 1;

                $confirm = '' ;

                while ($i <= 10) {

                    $num = rand() % 33;

                    $temp = substr($sto, $num, 1);

                    $confirm = $confirm . $temp;

                    $i++;

                }
                $confirm = $fst.$confirm;
                return $confirm;
                
            }
            
            function foto($name, $dir, $size, $rand){
//                $size = 2000;
//                $dir = "../photos/";
                if (($_FILES[$name] ["size"] > $size)){
                return 'File too large (Not more than 2MB required)';
            }else if ((($_FILES[$name] ["type"]=="image/gif") || ($_FILES[$name] ["type"] == "image/jpeg") || 
                    ($_FILES[$name] ["type"] == "image/pjpeg"))){
            if ($_FILES[$name] ["error"]>0)
            {
                echo "error: ".$_FILES[$name]['error'];
                    return $_FILES[$name]['error'];
            }
            else
            {
            //    echo "file submitted";
                
                
                if (file_exists($dir . $_FILES[$name] ["name"] ))
                {
                $out = 'error: file name exists';
                    return 'error: file name exists';
                }
                else
                {
                        $photo = $dir.$rand.$_FILES[$name] ["name"];
                    copy($_FILES[$name] ["tmp_name"] , $photo);
                    
            //      echo "stored in:" ."upload_item/" . $_FILES["file"] ["name"];
            //      $sql="INSERT INTO items'('pass') VALUES ('$try')";
                                return $photo;
            }
            }
            }else  {
                return 'File format not supported';
            }

            }


            function get_sec($date)
            {
             $a = explode(":", $date);
                            $o =  $a[0];
                            $p = $a[1];
                            $q = $a[2];
                            $h = $o * 60 * 60;
                            $m = $p * 60;
                            $sec = $h + $m + $q;
                            return $sec;
            }


            function to_min($sec)
            {
              $m = floor($sec / 60);
              $s = $sec % 60;
              return $m."mins ".$s."sec";
            }

            
            function logout($tbl, $field){
                // $ins = "UPDATE $tbl SET $field = '0' WHERE id = '".$_SESSION['id']."'";
                // $rins = $this->query($ins);
                $ins = "UPDATE $tbl SET $field = '', online = '0' WHERE id = '".$_SESSION['id']."'";
                $rins = $this->query($ins);
                $expiry = time() - 60;
                setcookie("sess", "", $expiry);
                setcookie("em", "", $expiry);
                //session_unset($_SESSION['user']);
                session_unset($_SESSION['email']);
                session_unset($_SESSION['verified']);
                session_unset($_SESSION['online']);
                // session_destroy();
                // header('location: index.php');
            }

            function redirect($url)
            {
                header('location: '.$url);
            }

            function tokenGenerator($length)
            {
                $mn = $mx = '';
                for ($i = 0; $i < $length; $i++)
                {
                    $mn .= '1';
                    $mx .= '9';
                }
        //        $min = 1111;
        //        $max = 9999;
                $min = $mn;
                $max = $mx;
                $token = rand($min, $max);
                
                return $token;
            }

            function emailAndEcho($from, $email_subject, $to, $message, $echo=""){
                // global $email_from,$email_subject;
                $headers = 'From: Sulvhub<'.$from . ">\r\n" .
                'Reply-To: '.$to . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                mail($to, $email_subject, $message, $headers);
                // echo (empty($echo))? $message : $echo;
            }

            function is_logged_in()
            {
                $logged_in = FALSE;
                if (isset($_COOKIE['sess']) && isset($_COOKIE['em']))
                {
                    $sess = $_COOKIE['sess'];
                    $em = $_COOKIE['em'];
                    $qry="SELECT * FROM users WHERE uid = '$sess' AND email = '$em' ";
                    $result=$this->query($qry);
                    $row = $this->rows($result);
                    if($row == 1)
                    {
                        $member = $this->fetch($result);
                        extract($member);
                        $_SESSION['email'] = $email;
                        $_SESSION['verified'] = $email_verified;
                        $_SESSION['id'] = $id;
                        // needs to be checked/edited
                        $_SESSION['online'] = $online;
                        $logged_in = TRUE;

                        // return ;
                    }
                }
                return $logged_in;
            }

            function shuffle_assoc($array)
            {
                $shuffled_array = array();
                $shuffled_keys = array_keys($array);
                shuffle($shuffled_keys);

            // Create same array, but in shuffled order.
                foreach ( $shuffled_keys AS $shuffled_key )
                {
                    $shuffled_array[  $shuffled_key  ] = $array[  $shuffled_key  ];
                }
                
                return $shuffled_array;
            }

}
?>
