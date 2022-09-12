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
        #canvasContainer {
            position:relative;
            top:30px;
            margin-bottom: 50px;
         }
        canvas {
            position: absolute;
            top:0px;
            left:0px;
        }
        .hide {
            display:none;
        }

        #download {
            display: none;
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
    $imagePath = "uploaded/Gaming Mouse_30.jpg";
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
    
    <div id="canvasContainer">
        <div id="imageContainer">
            <img id="image" src="<?php echo $imagePath ?>" />
        </div>
        <canvas id="mycan" width="500" height="500">HAHA</canvas>
    </div>
    <div>
        <button type="button" id="crop">CROP</button>
        <div id="download">
            <a href="#" download ><button type="button">Download</button></a>
        </div>
    </div>        
    <div>Image here<img id="cropped_image" /></div>
</section>
<script>
$(function(){
    var img_w = $("#image").width();
    var img_h = $("#image").height();
 
    // SYNCRONISE CANVAS width WITH IMAGE
    $("#canvasContainer").width(img_w);
    $("canvas").attr("width", img_w);

    // SYNCRONISE CANVAS HEIGHT WITH IMAGE
    $("#canvasContainer").height(img_h);
    $("canvas").attr("height",img_h);

    var startX=0;var startY=0;var endWidth=0;var endHeight=0;
    var started = false;
    var canvas = document.getElementById('mycan');
    var ctx = canvas.getContext("2d");
    //ctx.beginPath();
    ctx.setLineDash([3]);
    ctx.lineWidth = 1;
    ctx.strokeStyle = "#df4b26";
    ctx.lineJoin = "round";

    var con = document.getElementById("canvasContainer");
    canvas.addEventListener("mousemove", function (e) {
        if(started) { 
            // currX = e.clientX - canvas.offsetLeft;
            // currY = e.clientY - canvas.offsetTop;
            currX = e.clientX - con.offsetLeft;
            currY = e.clientY - con.offsetTop;
            endWidth = currX - startX;
            endHeight = currY - startY;
            draw(startX,startY,endWidth,endHeight);
        }
    }, false);

    //$("#canvasContainer").on("mousedown", function (e) {
    canvas.addEventListener("mousedown", function (e) {
        if(!started) {
            // HIDE DOWNLOAD BUTTON
            $("#crop").show();
            $("#download").hide();

            // CAPTURE START XY
            startX = e.clientX - con.offsetLeft;
            startY = e.clientY - con.offsetTop;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            started = true;
        }
    }, false);

    canvas.addEventListener("mouseup", function (e) {
        currX = e.clientX - con.offsetLeft;
        currY = e.clientY - con.offsetTop;

        /// GET WIDTH AND HEIGHT OF SELECTION
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
        ctx.fillStyle ="black";
        ctx.globalAlpha = 0.1;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.clearRect(xx, yy, ww, hh);
        ctx.strokeRect(xx, yy, ww, hh);
    }

    $("#crop").click(function(){
        var img = $("#image").attr('src');

        /// DISPLAY CROPPED IMAGE ON PAGE
        $("#cropped_image").show();
        $("#cropped_image").attr('src','image-crop.php?x='+startX+'&y='+startY+'&w='+endWidth+'&h='+endHeight+'&img='+img);
    
        /// SAVE CROPPED IMAGE
        $.ajax({
            url: 'image-crop-save.php',
            data: {
                x: startX,
                y:startY,
                w:endWidth,
                h:endHeight,
                img:img 
            },
            method: "get",
            dataType:"html"
        })
        .done(function(result){
            /// SHOW DOWNLOAD BUTTON
            $("#download a").attr("href", result);
            $("#crop").hide();
            $("#download").show();
        })
    
    });
});
    </script>
</body>
</html>