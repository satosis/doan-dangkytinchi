<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn" id="hamburger">
        &#9776;
    </label>
    <label class="logo">MyPDP</label>
    <ul class="ul">
        <li><?php if(isset($_COOKIE["username"])) echo $_COOKIE["username"];?></li>
        <li><a href="period.php">SETTING</a></li>
        <li><a href="process.php">PROCESS</a></li>
        <li><a href="subject.php">SUBJECT</a></li>
        <li><a href="print.php">PRINT</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
    </ul>
</nav>
<br><br><br><hr><br>
