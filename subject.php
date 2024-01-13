<?php
    include("db.php");

  if(ISSET($_POST["data"])){
    $data = json_decode($_POST["data"]);
    $id = $_POST["id"];
    $year = $_POST["year"];
    $month = $_POST["month"];
    $date = $_POST["date"];
    $day = $_POST["day"];
    $userId = 0;

    if(isset($_COOKIE["id"])) {
        $userId = $_COOKIE["id"];
    }
    $subject = [
        'penggal' => $data[1],
        'year' => $year,
        'month' => $month,
        'date' => $date,
        'day' => $day,
        'penggal' => $data[1],
        'penggal' => $data[1],
        'minggu' => $data[2],
        'period' => $data[0],
        'tema' => $data[3],
        'preset' => $data[4],
        'kdg' => $data[5],
        'cstd' => $data[6],
        'op' => $data[7],
        'kk' => $data[8],
        'apm' => $data[9],
        'au' => $data[10],
        'apn' => $data[11],
        'emk' => $data[12],
        'nilai' => $data[13],
        'bbm' => $data[14],
        'pemikiran' => $data[15],
        'peta' => $data[16],
        'pbd' => $data[17],
        'tahap' => $data[18],
        'akt21' => $data[19],
        'p21' => $data[20],
        'ujian' => $data[21],
        'sub_ujian' => $data[22],
        'kemahiran' => $data[23],
        'aspirasi' => $data[24],
        'refleksi' => $data[27],
        'tsm' => $data[28]
    ];
    if ($id) {
        $sql = update($id, 'project', $subject);
    } else {
        $subject['userId'] = $userId;
        $sql = insert('project', $subject);
    }
    if($conn->query($sql)===TRUE){
        header("Location:period.php");
    }else{
        //print_r($sql);
        echo "<script>alert('Failed.')</script>";
    }
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
        /* width: 900px; */
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
    #collapsetable{
        border-collapse: collapse;
        border: 3px solid black;
        text-align: center;
        /* margin-left: 0px; */
        width: 100%;
    }
    .btn{
        padding: 10px 20px 10px 20px;
        background: #009dff;
        color: white;
        border: none;
        margin-right: 55px;
    }
    a { text-decoration: none; }

    #window_new {
        padding: 16px;
        background-color: #ededed;
        width: 800px;
        margin: auto;
        margin-top: -8%;
        margin-left: 20%;
        font-size: 15px;
        display: none;
        position: absolute;
        text-align: center;
    }

    .close{
        width: 30px;
        height: 23px;
        /* background-color: red; */
        float: right;
        cursor: default;
    }

    .group{
        display: block;
        /* float: left; */
        margin-left: 65px;
        position:relative;
        margin-bottom:30px;
    }

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

    .input:focus {
        background-color: #ddd;
        outline: none;
    }
</style>
</head>

    <body style="margin:50px 50px 0 50px;">

        <b style="font-size:35px">MyPDP</b>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="./logout.php">LOGOUT</a></span>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="./admin/user.php">ADMIN</a></span>
        <span style="font-size:20px; float: right; margin-right: 80px"><a href="./subject.php">SUBJECT</a></span>
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
        <h2 style="float: left; margin-left:5px">LIST SUBJECT</h2>
        <div class="btn" style="float: right" id="bulk"><span>ADD SUBJECT</span></div>
        </div>

        <br>
        <div id="window_add" style="text-align:center">
        <div class="close" id="close">&nbsp; &#10006;</div>
        <h1>ADD NEW PERIOD</h1>
        <?php
        //   echo $_SESSION['id'];
        if(ISSET($_POST["insert"])){
            $std = $_POST["std"];
            $class = $_POST["class"];
            $noStu = $_POST["noStu"];
            $sub = $_POST["sub"];
            $start = $_POST["start"];
            $end = $_POST["end"];
            $day = $_COOKIE["day"];
            $id = $_COOKIE["id"];

            $sql = "INSERT INTO `period`(`userid`, `day`, `std`, `sub`, `class`, `start`, `end`, `noStu`)
            VALUES ('$id','$day','$std','$sub','$class','$start','$end','$noStu')";

                if($conn->query($sql)===TRUE){
                    // echo "<span class='succWrap' style='color:green; margin-left:8px;'>SUCCESS TO ADD NEW PERIOD!</span>";
                    // print_r($sql);
                    echo "<script>window.location.replace('period.php');</script>";
                }else{
                    //print_r($sql);
                    echo "<span class='errorWrap' style='color:red; margin-left:8px;'>FAIL TO ADD NEW PERIOD!</span>";
                }
            }

        ?>

        <form action="" method="POST">
            <table>
                <tr>
                <td>
                    <div class="group">
                    <h3 style="margin-top: 25px">STANDARD:</h3>
                </td>
                <td class="fill">
                    <select style="width:200px; height:25px" name="std">
                        <?php
                            for($a=1;$a<=12;$a++){
                                echo"<option value='$a'>$a</option>";
                            }
                        ?>
                    </select><br>
                    </div>
                </td>

                <td class="break">
                    <div class="group">
                    <h3 style="margin-top: 25px">CLASS:</h3>
                </td>
                <td class="fill">
                    <input style="height:28px" type="text" id="class" name="class" value="" required><br>
                    </div>
                </td>
                </tr>

                <tr>
                <td class="break">
                    <div class="group">
                    <h3>STUDENT NUMBER:</h3>
                </td>
                <td class="fill">
                    <input style="height:28px" type="text" id="noStu" name="noStu" value="" required><br>
                    </div>
                </td>

                <td class="break">
                    <div class="group">
                    <h3 style="margin-top: 25px">SUBJECT:</h3>
                </td>
                <td class="fill">
                    <select style="width:200px; height:28px" name="sub">
                        <option value='BAHASA MELAYU'>BAHASA MELAYU</option>
                        <option value='ENGLISH'>ENGLISH</option>
                        <option value='华文'>华文</option>
                        <option value='SCIENCE'>SCIENCE</option>
                        <option value='MATHEMATICS'>MATHEMATICS</option>
                        <option value='音乐'>音乐</option>
                        <option value='MORAL'>MORAL</option>
                    </select><br>
                    </div>
                </td>
                </tr>

                <tr>
                <td class="break">
                    <div class="group">
                    <h3 style="margin-top: 25px">START:</h3>
                </td>
                <td class="fill">
                    <input style="height:28px" step="60" type="time" id="start" name="start" value="" required><br>
                    </div>
                </td>

                <td class="break">
                    <div class="group">
                    <h3 style="margin-top: 25px">END:</h3>
                </td>
                <td class="fill">
                    <input style="height:28px" step="60" type="time" id="end" name="end" value="" required><br>
                    </div>
                </td>
                </tr>
            </table>

                <div>
                <button type="submit" class="btn" name="insert">SUBMIT</button>
                </div>

            </form>
        </div>

        </div>

        <br>

    <div class="table-content">
        <table class="collapsetable" border="1">
            <thead>
                <tr class="table-header">
                    <td>NO</td>
                    <td>NAME</td>
                    <td>ACTION</td>
                </tr>
            </thead>
            <?php
                $count = 1;
                $sql = "SELECT * FROM `project`";
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
                <td><?php echo $row["period"];?></td>
                <td><a href="pmain.php?id=<?php echo $row["id"];?>">EDIT</a> ||

                    <a href="del.php?id=<?php echo $row["id"];?>"
                    onclick="return confirm('Are you sure to delete subject?')">DELETE</a>
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
        let bulk = document.getElementById('bulk');
        let window_add = document.getElementById('window_add');
        bulk.onclick = function(){
            window_add.style.display = 'block';
        }
        let close = document.getElementById('close');
        close.onclick = function(){
            window_add.style.display = 'none';
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
