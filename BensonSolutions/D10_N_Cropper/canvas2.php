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
        #can {
            width: 500px;
            height: 300px;
            border: 1px solid red;
        }

        #container {
            position:relative;
            width: 500px;
            min-height: 300px;

        }

        #container div {
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
        }
    
    </style>
</head>
<body>
<div id="container">
<div><img id="image" src="upload-and-crop-image-using-php-and-jquery-output.jpg" /></div>
<div><canvas id="can"><img src="upload-and-crop-image-using-php-and-jquery-output.jpg" /></canvas></div>
</div>
<div style="float:right">Image here<img id="cropped_image" /><button type="button" id="crop">CROP</button></div>

    <script>
        var startX=0;var startY=0;var endWidth=0;var endHeight=0;
        var started = false;
        var canvas = document.getElementById('can');
        var ctx = canvas.getContext("2d");
        //ctx.beginPath();
        ctx.setLineDash([1]);
        ctx.lineWidth = 1;
        ctx.strokeStyle = "#df4b26";
        ctx.lineJoin = "round";
        //ctx.strokeRect(0,0,50,50);
        //ctx.stroke()


        canvas.addEventListener("mousedown", function (e) {
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
           
            console.log(currX + ":" + currY + "####" + e.clientX + ":"  + e.clientY);
        }, false);

        canvas.addEventListener("mousemove", function (e) {
            if(started) { 
                // currX = e.clientX - canvas.offsetLeft;
                // currY = e.clientY - canvas.offsetTop;

                currX = e.pageX - this.offsetLeft;
                currY = e.pageY - this.offsetTop;

                console.log(currX + ":" + currY);
                endWidth = currX - startX;
                endHeight = currY - startY;
                draw(startX,startY,endWidth,endHeight);
            }
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            if(!started) {
                // startX = e.clientX - canvas.offsetLeft;
                // startY = e.clientY - canvas.offsetTop;
                startX = e.pageX - this.offsetLeft;;
                startY = e.pageY - this.offsetTop;


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
            //ctx.rect(0, 0, 150, 100);
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.strokeRect(xx, yy, ww, hh);
            //ctx.stroke()
        }


        $("#crop").click(function(){
        var img = $("#image").attr('src');
        $("#cropped_image").show();
        
        //console.log('x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h);
        //$("#cropped_img").attr('src','image-crop.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img);
        $("#cropped_image").attr('src','image-crop.php?x='+startX+'&y='+startY+'&w='+endWidth+'&h='+endHeight+'&img='+img);
    });




    </script>
</body>
</html>