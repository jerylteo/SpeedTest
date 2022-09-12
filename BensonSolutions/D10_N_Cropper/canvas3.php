<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<script src="jquery-3.4.1.min.js"></script>
    <style>
        * {
            margin:0;
            padding:0;
        }
        #mycan{
            border: 1px solid red;
        }
        #image {
            width: 500px;
            border: 2px solid blue;
        }
        #container {
            position:relative;
            top:30px;
         }

        #container div {
            position: absolute;
            top:0;
            left: 0;
        }
        #container img {
            width: 100%
        }

        .hide {
            display:none;
        }
    
    </style>
    <?php
    if (isset($_FILES["userImage"])) {
        if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            $targetPath = "uploaded/" . $_FILES['userImage']['name'];
            if (move_uploaded_file($_FILES['userImage']['tmp_name'], $targetPath)) {
                $uploadedImagePath = $targetPath;
            }
        }
    }
    ?>
</head>
<body>
<?php 
    $hide = "hide";
    $imagePath = "initial-image.jpeg";
    if (isset($uploadedImagePath)) {
        $imagePath = $uploadedImagePath;
        $hide = "";
    }
?>
<form action="" method="post" enctype="multipart/form-data" >
<input type="file" name="userImage" id="userImage"/>
<button name="upload">Upload</button>
</form>
<section id="cropContainer" class="<?php echo $hide ?>">
    <div id="container"  >
        <!-- <div><img id="image" src="upload-and-crop-image-using-php-and-jquery-output.jpg" /></div> -->
        <div><img id="image" src="<?php echo $imagePath ?>" /></div>
        <div><canvas id="mycan">HAHA</canvas></div>
    </div>

    <button type="button" id="crop">CROP</button>
    <div>Image here<img id="cropped_image" /></div>
</section>
<script>
$(function(){
    // SYNCRONISE CANVAS HEIGHT WITH IMAGE
    //$("#can").height($("#image").height());
    $("#container").height($("#image").height());

   // $("#can").width($("#image").width());
    $("#container").width($("#image").width());

    var startX=0;var startY=0;var endWidth=0;var endHeight=0;
    var started = false;
    var canvas = document.getElementById('mycan');
    var ctx = canvas.getContext("2d");
    //ctx.beginPath();
    ctx.setLineDash([1]);
    ctx.lineWidth = 1;
    ctx.strokeStyle = "#df4b26";
    ctx.lineJoin = "round";

    // canvas.addEventListener("mousedown", function (e) {
    //     currX = e.clientX - canvas.offsetLeft;
    //     currY = e.clientY - canvas.offsetTop;
        
    //     console.log(currX + ":" + currY + "####" + e.clientX + ":"  + e.clientY);
    // }, false);

    canvas.addEventListener("mousemove", function (e) {
        if(started) { 
            // currX = e.clientX - canvas.offsetLeft;
            // currY = e.clientY - canvas.offsetTop;
            currX = e.pageX - this.offsetLeft;
            currY = e.pageY - this.offsetTop;


            endWidth = currX - startX;
            endHeight = currY - startY;
            draw(startX,startY,endWidth,endHeight);
        }
    }, false);

    canvas.addEventListener("mousedown", function (e) {
        if(!started) {
            startX = e.clientX - canvas.offsetLeft;
            startY = e.clientY - canvas.offsetTop;
            // startX = e.pageX - this.offsetLeft;;
            // startY = e.pageY - this.offsetTop;
            console.log(startX + ":" + startY);
            started = true;
        }
    }, false);

    canvas.addEventListener("mouseup", function (e) {
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;
        console.log(currX + ":" + currY);
        endWidth = currX - startX;
        endHeight = currY - startY;
        started = false;
    }, false);

    canvas.addEventListener("mouseout", function (e) {
        started = false;
    }, false);

    function draw( xx,yy,ww,hh) {
        ctx.beginPath();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.strokeRect(xx, yy, ww, hh);
    }

    $("#crop").click(function(){
        var img = $("#image").attr('src');
        $("#cropped_image").show();
        $("#cropped_image").attr('src','image-crop.php?x='+startX+'&y='+startY+'&w='+endWidth+'&h='+endHeight+'&img='+img);
    });
});
    </script>
</body>
</html>