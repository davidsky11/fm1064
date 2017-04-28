<?php
$tmp_name=$_FILES['img']['tmp_name'];
$name=$_FILES['img']['name'];
move_uploaded_file($tmp_name, './upload/'.$name);
$img='./upload/'.$name;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0,use-scalable=no" >
<meta http-equiv="Content-type" content="text/html;charset:utf-8" >
<script type="text/javascript" src="jquery.js"></script>
</head>

<body>
<div id="pic"><?php echo $img; ?></div>
</body>
</html>