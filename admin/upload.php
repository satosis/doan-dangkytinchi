
<?php
    include '../db.php';
    if(isset($_POST["data_excel"])){
        $data = json_decode($_POST["data_excel"]);
        foreach ($data as $key => $value) {
            $email = $value->EMAIL;
            $username = $value->USERNAME;
            $hp = $value->NOTEL;
            $credit = $value->CREDIT;
            $status = $value->STATUS == 'ACTIVE' ? 1 : 2 ;
            $text = 'Added user successfully !!';
            if(!preg_match("/[[:alnum:]]@(.+\.)+[[:alpha:]]/", $email)){
                $text = 'Please enter a valid email address !!';
            }else{

                if(checkEmail($conn, $email)>0){
                    $text = 'This email is already registered !!';
                }else{
                $sql = "INSERT INTO `user`(`email`, `username`, `password`,`hp`,`credit`,`status`)
                VALUES ('$email','$username',PASSWORD('0000'),'$hp','$credit','$status')";

                // echo ($sql);
                // echo $conn->query($sql)
                if($conn->query($sql)===TRUE){
                }else{
                    // echo $sql;
                    $text = 'Something went wrong !!';
                }
                }
            }
        }
        echo $text;
      }
  ?>
