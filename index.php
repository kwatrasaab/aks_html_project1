<?php
$id_type = $_POST ['selectBox1'];

$id_aadhar = "aadhar";
$id_voter = "voter";
$id_passport = "passport";

$file = $_FILES ['doc'];

$type_ack = check_type ("pdf", $file);
$size_ack = check_size (102400, $file);

echo "Type: " . $type_ack . "<br>Size: ". $size_ack . "<br>";

if ($type_ack == false) {
    echo "Kindly enter the file in PDF format <br>";
}

if ($size_ack == false) {
    echo "Size of the ID proof must be less than 100kb <br>";
}

if ($type_ack == true and $size_ack == true) {
    if ($id_type == $id_aadhar) {
        $tmp = $file ['tmp_name'];
        $actual_path = "docs/aadhar/" . $file ['name'];
        move_uploaded_file($tmp, $actual_path);
    } else if ($id_type == $id_voter) {
        $tmp = $file ['tmp_name'];
        $actual_path = "docs/voter/" . $file ['name'];
        move_uploaded_file($tmp, $actual_path);
    } else if ($id_type == $id_passport) {
        $tmp = $file ['tmp_name'];
        $actual_path = "docs/passport/" . $file ['name'];
        move_uploaded_file($tmp, $actual_path);
    } else {
        echo "Kindly enter the type of the ID that you want upload :( <br>";
    }
}

$file = $_FILES ['image'];

$type_ack = check_type (false, $file);
$size_ack = check_size (204800, $file);

echo "Type: " . $type_ack . "<br>Size: ". $size_ack . "<br>";

if ($type_ack == false) {
    echo "Kindly enter the image in JPG, JPEG, or PNG format <br>";
}

if ($size_ack == false) {
    echo "Size of the image must be less than 200kb <br>";
}

if ($type_ack == true and $size_ack == true) {
    $tmp = $file ['tmp_name'];
    $actual_path = "images/" . $file ['name'];
    move_uploaded_file($tmp, $actual_path);
}



function check_type ($type, $file) {
    if ($type == false) {
        if (pathinfo ($file ['name'], PATHINFO_EXTENSION) == "jpeg" or $file ['name'] == "jpg" or $file ['name'] == "png") {
            return true;
        } else {
            return false;
        }
    } else {
        if (pathinfo ($file ['name'], PATHINFO_EXTENSION) == $type) {
            return true;
        } else {
            return false;
        }
    }
}

function check_size ($size, $file) {
    if ($file ['size'] <= $size) {
        return true;
    } else {
        return false;
    }
}


?>