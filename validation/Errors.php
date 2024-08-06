<?php
class Errors{
    public function redirect($location,$type,$er){
        header("Location:$location?$type=$er");
        exit;
    }
}
?>