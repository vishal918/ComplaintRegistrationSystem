<?php
    $tmp_name= $_FILES['image']['tmp_name'];
    $size=$_FILES['image']['size'];
    $name= $_FILES['image']['name'];
    if($size>200000){
        echo "<script>alert('Image size is more that the permitted value')</script>";
    }
    else {
        if(move_uploaded_file($tmp_name,"missing/".$name)){
            echo "<script>alert('Upload Successful')</script>";
            
            header('Location: missing.html');
        }
        else {
            echo "<script>alert('Upload Error !!!!')</script>";
        }
    }
?>