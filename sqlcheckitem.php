<?php
$host = "localhost";
$username = "root";
$pass = "";
$dbname = "searchfileall";
$conn = mysqli_connect($host, $username, $pass, $dbname);
if (mysqli_connect_errno()) {
    echo "Fail to connect MySql" . mysqli_connect_error();
}

$sql_pass_chk = "select * from pass";
$que_pass_chk = mysqli_query($conn, $sql_pass_chk) or die(mysql_error());
while ($data = mysqli_fetch_array($que_pass_chk, MYSQLI_ASSOC)) {
    $style = $data['style_name'];


    $sql_check_del = "select * from fail where style_name = '" . $style . "'";
    $que_check_del = mysqli_query($conn, $sql_check_del) or die(mysql_error());
    $res_del = mysqli_fetch_row($que_check_del);
    if ($res_del != 0) {
        $sql_del = "delete from fail where style_name = '" . $style . "'";
        mysqli_query($conn, $sql_del) or die(mysql_error());
    }
}


header('Location:index.php');

?>