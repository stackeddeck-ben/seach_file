<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="x-windows-874">
        <title></title>
    </head>
    <body>
        <?php
        $host = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "searchfileall";
        $conn = mysqli_connect($host, $username, $pass,$dbname);
        if (mysqli_connect_errno())
        {
            echo "Fail to connect MySql" . mysqli_connect_error();
        }
        ?>
        <?php
        // $sort = "D:/allpicturepackshot/TWCSHOOTING/Newfolder/WU3294/";
        // $dest = "C:/Users/Korakot/Desktop/allproduct/";
        $sort = $_POST['sort'];
        $dest = $_POST['dest'];
        $dir = new DirectoryIterator($sort);
        $count_success = 0;
        $count_fail = 0;
        $sql_style = "select * from style";
        $my_query = mysqli_query($conn,$sql_style) or die(mysql_error());

        while ($data = mysqli_fetch_array($my_query,MYSQLI_ASSOC))
        {
            $style = $data['style_name'];
            $style6 = substr($style,0,6);
            // $color = substr($style,6,8);
            $regex = "/^".$style6.".*/";
            // $check_match = false;
            $style_chk ="";

            // $sql_pass_chk = "select * from pass where style_name = '".$style."'";
            // $que_pass_chk = mysqli_query($conn,$sql_pass_chk) or die(mysql_error());
            // $row_pass_chk = mysqli_fetch_row($que_pass_chk);
            // if($row_pass_chk == 0){
                foreach ($dir as $file)
                {
                    if(preg_match($regex,$file->getFilename())){
                        $style_chk = $file->getFilename();
                        // if(preg_match('/_front/mi',$file->getFilename())){
                        //     $style_chk = $file->getFilename();
                        //     $check_match = true;
                        //     break 1;
                        // }else if (preg_match('/_1/mi',$file->getFilename())){
                        //     $style_chk = $file->getFilename();
                        //     $check_match = true;
                        //     break 1;
                        // }else{
                        //     $style_chk = $file->getFilename();
                        //     $check_match = true;
                        // }
                        // $check_match = true;
                        echo $style." match is ".$style_chk."=====>";
                        if(!copy($sort."/".$style_chk,$dest."/".$style_chk)){
                            echo "Failed to copy".$sort."<br>\n";
                            $count_fail++;
                        }else{
                            echo "Copy success.<br>\n";
                            $sql_check = "select * from pass where style_name = '".$style."'";
                            $que_check = mysqli_query($conn,$sql_check) or die(mysql_error());
                            $res = mysqli_fetch_row($que_check);
                            if($res == 0){
                                $sql = "insert into pass(style_name) values ('".$style."')";
                                mysqli_query($conn,$sql) or die(mysql_error());
                            }
                            //Check style in table 'fail' after insert style to table 'pass'
                            $sql_check_del = "select * from fail where style_name = '".$style."'";
                            $que_check_del = mysqli_query($conn,$sql_check_del) or die(mysql_error());
                            $res_del = mysqli_fetch_row($que_check_del);
                            if($res_del != 0){
                                $sql_del = "delete from fail where style_name = '".$style."'";
                                mysqli_query($conn,$sql_del) or die(mysql_error());
                            }
                            $count_success++;
                        }
                    }else{
                        $sql_check = "select * from fail where style_name = '".$style."'";
                        $que_check = mysqli_query($conn,$sql_check) or die(mysql_error());
                        $res = mysqli_fetch_row($que_check);
                        if($res == 0){
                            $sql = "insert into fail(style_name) values ('".$style."')";
                            mysqli_query($conn,$sql) or die(mysql_error());
                        }
                        $count_fail++;
                    }
                }
                // if($check_match == true){
                //     echo $style." match is ".$style_chk."=====>";
                //     if(!copy($sort.$style_chk,$dest.$style_chk)){
                //         echo "Failed to copy".$sort."<br>\n";
                //         $count_fail++;
                //     }else{
                //         echo "Copy success.<br>\n";
                //         $sql_check = "select * from pass where style_name = '".$style."'";
                //         $que_check = mysqli_query($conn,$sql_check) or die(mysql_error());
                //         $res = mysqli_fetch_row($que_check);
                //         if($res == 0){
                //             $sql = "insert into pass(style_name) values ('".$style."')";
                //             mysqli_query($conn,$sql) or die(mysql_error());
                //         }
                //         //Check style in table 'fail' after insert style to table 'pass'
                //         $sql_check_del = "select * from fail where style_name = '".$style."'";
                //         $que_check_del = mysqli_query($conn,$sql_check_del) or die(mysql_error());
                //         $res_del = mysqli_fetch_row($que_check_del);
                //         if($res_del != 0){
                //             $sql_del = "delete from fail where style_name = '".$style."'";
                //             mysqli_query($conn,$sql_del) or die(mysql_error());
                //         }
                //         $count_success++;
                //     }
                // }
                // else if($check_match == false){
                //     // echo $style." is NULL<br>\n";
                //     $sql_check = "select * from fail where style_name = '".$style."'";
                //     $que_check = mysqli_query($conn,$sql_check) or die(mysql_error());
                //     $res = mysqli_fetch_row($que_check);
                //     if($res == 0){
                //         $sql = "insert into fail(style_name) values ('".$style."')";
                //         mysqli_query($conn,$sql) or die(mysql_error());
                //     }
                //     $count_fail++;
                // }
            // }
        }
        echo "Success =>".$count_success."<br>";
        echo "Fail =>".$count_fail."<br>";
        ?>
    </body>
</html>
