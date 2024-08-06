<?php
class Validation{
    public function clean($str){
        $str =trim($str);
            $str=stripcslashes($str);
            $str=htmlspecialchars($str);
        return $str;
    }
    public function name($str){
        $pattern="/^([a-zA-Z' ]+)$/";
        if (preg_match($pattern,$str)){
            return true;
        }
        else{
            return false;
        }
}
public function username($str){
    $pattern="/[A-Za-z][A-Za-z0-9]{5,8}$/";
    if (preg_match($pattern,$str)){
        return true;
    }
    else{
        return false;
    }
}
public function email($str){
    if (filter_var($str,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
public function phonenumber($num){
    $pn="/^\d{10}$/";
    if (preg_match($pn, $num)){
        return true;
    }
    else{
        return false;
    }
}
public function password($str){
    $pass="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s:])([^\s]){8,}$/";
    if (preg_match($pass,$str)){
        return true;
    }
    else{
        return false;
    }
}
public function confirmpassword($str1,$str2){
    if ($str1==$str2){
        return true;
    }
    else{
        return false;
    }
}
// static function gender($str1){
//     if ($str1==""){ 
//         $err="Please choose your gender";
//         Errors::redirect("../register.php","error",$err);
     
//     }
//     else{
//         return true;   
//     }
// }
}
class ErrorHandler extends Validation{
    public function redirect($location,$type,$er){
        header("Location:$location?$type=$er");
        exit;
    }
}

?>