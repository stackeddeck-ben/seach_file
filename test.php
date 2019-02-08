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
        // mysql_select_db($dbname);
        if (mysqli_connect_errno())
        {
            echo "Fail to connect MySql" . mysqli_connect_error();
        }
        ?>
        <?php

        // print_r(file_get_contents("php://input"));

        $sort = $_POST['sort'];
        $dest = $_POST['dest'];
        // $sort = "C:/Users/Korakot/Desktop/ProductMW/";
        // $dest = "C:/Users/Korakot/Desktop/success/";
        $dir = new DirectoryIterator($sort);
        $count_success = 0;
        $count_fail = 0;
        $count_test = 0;
        $sql_style = "select * from style";
        $my_query = mysqli_query($conn,$sql_style) or die(mysql_error());
        
        while ($data = mysqli_fetch_array($my_query,MYSQLI_ASSOC))
        {
            $style = $data['style_name'];
            $style6 = substr($style,0,6);
            $regex = "/^".$style6.".*/";
            $regex_chk_color = "/[a-zA-Z]{1}[0-9]{1}/";
            $check_match = false;
            $style_chk ="";
            $color_file = "";
            $color_chk = "";
            $chk_last = false;
            
            foreach ($dir as $file)
            {
                
                if(preg_match($regex,$file->getFilename())){
                    $style_chk = $file->getFilename();
                    $str1_chk = substr($style_chk,6,1);
                    $str2_chk = substr($style_chk,6,2);
                    if($str1_chk == "_" || $str1_chk == " "){
                        $color_file = substr($style_chk,7,2);
                    }else if(preg_match($regex_chk_color,$str2_chk)){
                        $color_file = substr($style_chk,8,2);
                    }else{
                        $color_file = substr($style_chk,6,2);
                    }
                    // $style_chk = $file->getFilename();
                    if($color_file != $color_chk){
                        if(preg_match('/_fron/mi',$file->getFilename())){
                            $style_chk = $file->getFilename();
                            $check_match = true;
                            $chk_last = false;
                            $color_chk = $color_file;
                            // break 1;
                            // echo $style_chk."========>color : ".$color_file."<br>";
                            // $count_success++;
                        }else if (preg_match('/_1/mi',$file->getFilename())){
                            $style_chk = $file->getFilename();
                            $check_match = true;
                            $chk_last = false;
                            $color_chk = $color_file;
                            // break 1;
                            // echo $style_chk."========>color : ".$color_file."<br>";
                            // $count_success++;
                        }else if (preg_match('/[a-zA-Z0-9]{8}.jpg/',$file->getFilename())){
                            $style_chk = $file->getFilename();
                            $check_match = true;
                            $chk_last = false;
                            $color_chk = $color_file;
                            // break 1;
                            // echo $style_chk."========>color : ".$color_file."<br>";
                            // $count_success++;
                        }else{
                            $style_chk = $file->getFilename();
                            $check_match = true;
                            $chk_last = true;
                        }

                        if($check_match == true && $chk_last == false){
                            echo $style_chk."========>color : ".$color_file."<br>";
                            $count_success++;
                        }
                        
                    }
                    
                    // echo $style_chk."========>color : ".$color_file."<br>";
                    // $count_test++;
                }
                
            }
            // echo $style_chk."========>color : ".$color_file."<br>";
            if($check_match == true && $chk_last == true){
                echo $style_chk."========>color : ". $color_file ."=====>". $chk_last ."<br>";
                $chk_last = false;
                $count_success++;
                // echo $style." is NULL<br>\n";
                // $count_fail++;
            }else if($check_match == false){
                $count_fail++;
            }
            // else{
            //     echo $style_chk."<br>";
            //     echo $style." match is ".$style_chk."=====><br>";
            //     // $count_success++;
            // }
        }
        echo "Success : ".$count_success."<br>";
        echo "Fail : ".$count_fail."<br>";
        echo "Test : ".$count_test."<br>";
        // echo $dest."<br>";
        ?>
    </body>
</html>
