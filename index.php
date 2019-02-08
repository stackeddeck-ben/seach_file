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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <form id="myform" action="searchfile_mapping_color.php" onsubmit="return validateForm()" method="post">
        <div>
            <div style="margin-left:50px;color:#ff8297;"><h1>Search Image</h1></div>
            <div>
                <br/>
                <h4>Sort : </h4>
                <input type="text" id="sort" name="sort" class="form-control"/>
            </div>
            <div>
                <h4>Destination : </h4>
                <input type="text" id="dest" name="dest" class="form-control"/>
            </div>
            <br/>
            <button class="btn btn-success btn-block" type="submit" name="submit" id="submit">SUBMIT
                <!-- <a href="javascript: submitform()">SUBMIT</a> -->
            </button>
        </div>
        <div>
            <br/><br/>
            <button class="btn btn-info btn-block" id="chack" name="check" value="CHECK SQL">
                <a style="text-decoration:none;color:#ffffff;" href="sqlcheckitem.php">CHECK! SQL</a>
            </button>

                <!-- <a href="javascript: submitform()">Search</a> -->
            
        </div>
        </form>

        <script type="text/javascript">
            function validateForm(){
                if($('#sort').val() == ""){
                    $('#sort').focus();
                    alert("กรอกข้อมูลให้ครบ");
                    return false;
                }else if ($('#dest').val() == ""){
                    $('#dest').focus();
                    alert("กรอกข้อมูลให้ครบ");
                    return false;
                }
            }

            // function submitform()
            // {
            //     if($('#sort').val() == ""){
            //         $('#sort').focus();
            //         alert("กรอกข้อมูลให้ครบ");
            //     }else if ($('#dest').val() == ""){
            //         $('#dest').focus();
            //         alert("กรอกข้อมูลให้ครบ");
            //     }else{
            //         document.getElementById('myform').submit();
            //     }
            //     // document.myform.submit();
                
            // }

            // $(function(){
                // $('#submit').click(function(){
                //     window.location = "test.php?";
                    // $.get("test.php",{
                    //     sort: $('#sort').val(),
                    //     dest: $('#dest').val()
                    // },function(data) {
                    //     console.log(data);

                    //     window.location = "test.php?";
                    //     // alert("123");
                    // });
                // });
            // });
        </script>
    </body>
</html>
