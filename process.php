<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="nav.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPDP</title>
    <style>
        .outbox{
            width: 90%;
            height: calc(100vh - 70px);
            margin: auto;
            margin-top: 50px;
        }
        .cal{
            width: 100%;
            height: 75%;
            background-color: gray;
            margin: auto;
        }

        a { text-decoration: none; }

    </style>
</head>
<body style="margin:20px 50px 0 50px;">
    <?php include ("nav.php");?>
    <div class="outbox">
        <h2>PROCESS</h2>
        <div class="cal" id='cal'>
            <?php
                include('calendar.php');
            ?>
        </div>
    </div>
    <script>
    let calendar = document.getElementById("cal");
    let checkbtn1 = document.getElementById("hamburger");
    function a(){
        if(calendar.style.display == "none"){
            calendar.style.display = "block";
        }else{
            calendar.style.display = "none";
        }
    }

</script>
</body>

</html>
