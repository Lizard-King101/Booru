<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1 style="text-transform: capitalize"><?php $letters = array("g","r","o","n","w","d","i","t","h","l","e"," "); $numbers = array(8,6,7,9,10,1,11,5,6,5,11,3,2,7,8,6,3,0,11,4,1,2,3,0); for($i = 0; $i < count($numbers); $i++ ){ echo $letters[$numbers[$i]]; } ?></h1>
</body>
</html>