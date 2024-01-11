<?php

$conn = new mysqli("localhost","root","","project");

function checkEmail($conn, $email){
    $sql = "SELECT * from user WHERE email = '$email'";

    $result = $conn->query($sql);
    // var_dump($result);
    return $result->num_rows;

}
function checkEmailName($conn, $email, $name){
    $sql1 = "SELECT * from user WHERE email = '$email' AND `username` = '$name'";

    $result = $conn->query($sql1);
    // var_dump($result);
    return $result->num_rows;

}

function insert($tablename,$values){
    foreach($values as $keys=>$record){
        $key_array[] = $keys;
        $myvalue = $record;
        if($record == ''){
            $value_array[] = "'NULL'";
        }else{
            $value_array[] = "'".$myvalue."'";
        }
    }
    $keys = implode(",", $key_array);
    $values = implode(",", $value_array);
    $sql = "INSERT INTO $tablename ($keys)values($values)";
    return $sql;
}
?>
