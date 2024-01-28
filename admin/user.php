<?php
    include '../db.php';
    function readcsv($file){
    //     $test = file($file);
    //     $final = [];
    //     $target_dir = "file/";
    //     $target_file = $target_dir . basename($_FILES["file"]["name"]);
    //     $uploadOk = 1;
    //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //     if($imageFileType != "csv"){
    //         echo '<script>alert("Sorry, only CSV files are allowed.")</script>';
    //         $uploadOk = 0;
    //         error_reporting(0);
    //     }
    //     $_SESSION["uploadOk"] = $uploadOk;
    //     // echo $_SESSION["uploadOk"];
    //     for($i = 0; $i<count($test);$i++){
    //         $str ='';
    //         $subans = [];
    //         for($j=0;$j<strlen($test[$i]);$j++){
    //             if($test[$i][$j] == ',' || $j == strlen($test[$i])-1){
    //                 array_push($subans,$str);
    //                 $str = '';
    //                 continue;
    //             }
    //             $str.=$test[$i][$j];
    //         }
    //         array_push($final,$subans);
    //     }
    //     return $final;
    }
?>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
<title>MyPDP</title>
<style>
    .table-content {
        width: 1000px;
        text-align: center;
    }
    .table-header {
        text-align: center;
        font-weight: bold;
        background-color: white;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    td{
        width:80px;
        height: 40px;
    }
    .center{
        text-align: center;
    }
    .collapsetable{
        border-collapse: collapse;
        border: 3px solid black;
        text-align: center;
        /* margin-left: 30px; */
        width: 140%;
    }
    .btn{
        padding: 10px 20px 10px 20px;
        background: #009dff;
        color: white;
        border: none;
        margin-top: 10px;
        margin-right: 55px;
        cursor: default;
        text-align: center;
    }

    /* .btn:hover {
        background: rgb(137, 207, 240);
        background: linear-gradient(0deg, rgba(137, 207, 240, 1) 0%, rgba(0, 150, 255, 1) 100%);
    } */
    a { text-decoration: none; }

    #window_add {
        padding: 16px;
        background-color: #ededed;
        width: 800px;
        margin-top: -7%;
        margin-left: 20%;
        font-size: 15px;
        display: none;
        position: absolute;
        /* text-align: center; */
    }
    #window_bulk{
        padding: 16px;
        width: 40%;
        height: 60%;
        background-color: #ededed;
        position: absolute;
        margin-top: -5%;
        margin-left: 25%;
        text-align: center;
        display: none;
    }
    .show{
        width: 60%;
        height: 50%;
        border: 1.5px solid black;
        margin: auto;
        margin-top: 15px;
    }
    .close{
        width: 30px;
        height: 23px;
        /* background-color: red; */
        float: right;
        cursor: default;
    }

    .input, select {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px -100px;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        float: right;
    }

    .input:focus {
        background-color: #ddd;
        outline: none;
    }
</style>
</head>

    <body style="margin:50px 50px 0 50px;">

        <b style="font-size:35px">MyPDP</b>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="../logout.php">LOGOUT</a></span>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="../admin/user.php">ADMIN</a></span>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="../subject.php">SUBJECT</a></span>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="./process.php">PROCESS</a></span>
        <br><hr>
        <br>
        <form action="" method="POST">
        <div style="margin: 0px 80px 0 0; float:right">
            <input style="width:250px; height:30px; border-radius: 10px" type="text" name="search">
            <button style="width:65px; height:30px; border-radius: 10px" name="searchbtn" ><i class="fa-solid fa-magnifying-glass fa-lg"></i></button><br>
        </div>
        </form>
        <br><br>
        <div>
        <h2 style="float: left; margin-left:5px">USER</h2>
        <div class="btn" style="float: right" id="bulk"><span>ADD BULK USER</span></div>
        <div class="btn" style="float: right" id="add"><span>ADD NEW USER</span></div>
        <input type="file" id="upload" style="display:none">
        </div>

        <br>
        <div id="window_add">
        <div class="close" id="out">&nbsp; &#10006;</div>
        <form action="" method="POST">
            <?php
            if(ISSET($_POST["add"])){
                $email = $_POST["email"];
                $username = $_POST["username"];
                $hp = $_POST["hp"];
                $credit = $_POST["credit"];
                $status = $_POST["status"];

                if($status == 0){
                echo '<script>alert("Please select the status !!");</script>';
                }else{

                if(!preg_match("/[[:alnum:]]@(.+\.)+[[:alpha:]]/", $email)){
                    echo '<script>alert("Please enter a valid email address !!");</script>';
                }else{

                    if(checkEmail($conn, $email)>0){
                    echo '<script>alert("This email is already registered !!");</script>';
                    }else{
                    $sql = "INSERT INTO `user`(`email`, `username`, `password`,`hp`,`credit`,`status`)
                    VALUES ('$email','$username',PASSWORD('0000'),'$hp','$credit','$status')";

                    // echo ($sql);
                    // echo $conn->query($sql)
                    if($conn->query($sql)===TRUE){
                        echo '<script>alert("Added user successfully !!");</script>';
                        header('Refresh:2;URL=user.php');
                    }else{
                        // echo $sql;
                        echo '<script>alert("Something went wrong")</script>';
                    }
                    }
                }
            }
            }
            ?>

                <h1 style="text-align:center">ADD NEW USER</h1>
                <hr>
                <table style="width:100%; margin: 0 10px;">
                    <tr>
                        <td style="width: 15%;">
                            <label for="email"><b>EMAIL</b></label>
                        </td>
                        <td>
                            <input class="input" type="text" placeholder="Enter Email" name="email" id="email" required><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="username"><b>USERNAME</b></label>
                        </td>
                        <td>
                            <input class="input" type="text" placeholder="Enter Username" name="username" id="username" required><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="hp"><b>NO TEL</b></label>
                        </td>
                        <td>
                            <input class="input" type="text" placeholder="Enter No Tel" name="hp" id="hp" required><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="credit"><b>CREDIT</b></label>
                        </td>
                        <td>
                            <input class="input" type="text" placeholder="Enter Credit" name="credit" id="credit" required><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="status"><b>STATUS</b></label><br>
                        </td>
                        <td>
                            <select style="" name="status">
                                <option value=0>-- SELECT STATUS --</option>
                                <option value=1>ACTIVE</option>
                                <option value=2>INACTIVE</option>
                            </select><br>
                        </td>
                    </tr>
                </table>
                <button style="margin: 0 345px" type="submit" class="btn" name="add">SUBMIT</button>

            </form>

        </div>

        <br>
    <div id="window_bulk">
        <div class="close" id="close"> &#10006;</div>
        <h1>ADD BULK USER</h1>
        <form enctype="multipart/form-data" action="" method="POST">
            <label for="add_file">Choose File :</label>
            <input type="file" name="file" id="file" multiple><br><br>
            <span style="color:red"><em>Just Allow CSV File</em></span>
        </form>
        <div class="show" style="overflow-y:auto;">
        </div>
        <br>
        <button type="submit" style="margin-top: 0px;" class="btn" name="bulk_submit" id="submit">SUBMIT</button>
    </div>

    <?php
        if(!empty($_FILES)){
            // $file = $_FILES["file"]["name"];

            // $target_dir = "file/";
            // $target_file = $target_dir . basename($_FILES["file"]["name"]);
            // // echo $file;
            // move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            // echo'<script>
            //     let window_bulk = document.getElementById("window_bulk");
            //     window_bulk.style.display = "block";
            //     let close = document.getElementById("close");
            //     close.onclick = function(){
            //         window_bulk.style.display = "none";
            //     }
            //     let bulk = document.getElementById("bulk");
            //     bulk.onclick = function(){
            //         window_bulk.style.display = "block";
            //     }
            //     let submit = document.getElementById("submit");
            //     submit.onclick = function(){
            //         location.href = "submit.php"
            //     }
            // </script>';
        }
    ?>

    <div class="table-content">
        <table class="collapsetable" border="1">
            <thead>
                <tr class="table-header">
                    <td>NO</td>
                    <td>EMAIL</td>
                    <td>USERNAME</td>
                    <td>NO TEL</td>
                    <td>CREDIT</td>
                    <td>STATUS</td>
                    <td>ACTION</td>
                </tr>
            </thead>
            <?php
                $count = 1;
                $sql = "SELECT * FROM `user`";

                if(ISSET($_POST["searchbtn"])){
                    $search = $_POST["search"];
                    // $id = $_SESSION["id"];
                    $sql = "SELECT * FROM `user`
                    WHERE `email` LIKE '%$search%' OR `username` LIKE '%$search%' OR `hp` LIKE '%$search%' OR `credit` LIKE '%$search%' ";
                    $pattern = "/^$search$/i";
                    if(preg_match($pattern, "active")){
                        $sql = "SELECT * FROM `user` WHERE `status`='1' ";
                    }elseif(preg_match($pattern, "inactive")){
                        $sql = "SELECT * FROM `user` WHERE `status`='2' ";
                    }
                    if($search==NULL || $search==" "){
                        $sql = "SELECT * FROM `user`";
                    }
                    $result = $conn->query($sql);
                    if($result->num_rows==0){
                        echo "<script>alert('The user does not exist.')</script>";
                    }
                }

                $result = $conn->query($sql);
                // if($result->num_rows==0){
                //     echo "<script>alert('The user does not exist.')</script>";
                //     // header("Refresh:0; URL=user.php");
                // }
                while($row = $result->fetch_assoc()){
                    // echo $sql;
                    // echo "<br>";
                    // print_r($row) ;


            ?>
            <tr class="center">
                <?php //print_r($result)?>
                <!-- <td><?php //echo $row["date"]."-".$row["month"]."-".date('Y'); ?></td> -->
                <td><?php echo $count++; ?></td>
                <td><?php echo $row["email"];?></td>
                <td style="text-transform:uppercase"><?php echo $row["username"];?></td>
                <td><?php echo $row["hp"];?></td>
                <td><?php echo $row["credit"];?></td>
                <td>
                    <?php
                    if($row["status"] == 1){
                        echo "ACTIVE";
                    }else{
                        echo "INACTIVE";
                    }
                ?>
                </td>
                <td><a href="edit.php?id=<?php echo $row["id"];?>">EDIT</a> ||

                    <a href="del.php?id=<?php echo $row["id"];?>"
                    onclick="return confirm('Are you sure to delete the user?')">DELETE</a>
                </td>

                <?php
                    }
                ?>
            <tbody>

            </tbody>
        </table>
        </div>
        <br>




    </body>
    <script>
        let add = document.getElementById('add');
        let window_add = document.getElementById('window_add');
        add.onclick = function(){
            window_add.style.display = 'block';
        }
        let out = document.getElementById('out');
        out.onclick = function(){
            window_add.style.display = 'none';
        }
        let bulk = document.getElementById('bulk');
        let window_bulk = document.getElementById('window_bulk');
        bulk.onclick = function(){
            window_bulk.style.display = 'block';
        }
        let close = document.getElementById('close');
        close.onclick = function(){
            window_bulk.style.display = 'none';
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#file').change(function(){
                var selectedFile = $('#file')[0].files[0];
                var reader = new FileReader();
                reader.onload = function(event) {
                    var data = event.target.result;
                    var workbook = XLSX.read(data, {
                        type: 'binary'
                });
                workbook.SheetNames.forEach(function(sheetName) {
                    var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                    console.log(XL_row_object);
                    $('.show').empty();
                    $('.show').append(`<table style="margin-left:20%">`);
                    $('.show').append(`<tr>`);
                    $('.show').append(`<td>STT</td>`);
                    $('.show').append(`<td>EMAIL</td>`);
                    $('.show').append(`<td>USERNAME</td>`);
                    $('.show').append(`<td>NOTEL</td>`);
                    $('.show').append(`<td>CREDIT</td>`);
                    $('.show').append(`<td>STATUS</td>`);
                    $('.show').append(`</tr>`);
                    XL_row_object.forEach((element, key) => {
                        $('.show').append(`<tr>`);
                        $('.show').append(`<td>${key+1}</td>`);
                        $('.show').append(`<td>${element['EMAIL']}</td>`);
                        $('.show').append(`<td>${element['USERNAME']}</td>`);
                        $('.show').append(`<td>${element['NOTEL']}</td>`);
                        $('.show').append(`<td>${element['CREDIT']}</td>`);
                        $('.show').append(`<td>${element['STATUS']}</td>`);
                        $('.show').append(`</tr>`);
                    });

                    $('.show').append(`</table>`);
                })
                };
                reader.onerror = function(event) {
                    console.error("File could not be read! Code " + event.target.error.code);
                };
                    reader.readAsBinaryString(selectedFile);
            });

            $('#submit').click(function(){
            var selectedFile = $('#file')[0].files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var data = event.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
            });
            workbook.SheetNames.forEach(function(sheetName) {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: 'data_excel=' + json_object,
                success:function(data) {
                    console.log(data);
                    alert(data);
                    window.location.reload();
                },
                error: function (e) {
                    console.log(e);
                    alert("Added user failed !!");
                    window.location.reload();
                }
                });
            })
            };
            reader.onerror = function(event) {
                console.error("File could not be read! Code " + event.target.error.code);
            };
                reader.readAsBinaryString(selectedFile);
            });
        });
    </script>
</html>
