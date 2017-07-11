<?php
    if($_FILES['userfile']['type']=='image/jpeg'
    ||$_FILES['userfile']['type']=='image/tif'
    ||$_FILES['userfile']['type']=='image/png'
    ||$_FILES['userfile']['type']=='image/pjpeg'){
        if(!file_exists('../files/'.$_FILES['userfile']['name'])){
            move_uploaded_file($_FILES['userfile']['tmp_name'],'../files/'.$_FILES['userfile']['name']);
        }
        echo 'files/'.$_FILES['userfile']['name'];
    }
    print_r($_FILES['userfile']);
?>+