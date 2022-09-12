<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin:0;
            padding:0;
        }
        #can {
            width: 500px;
            height: 300px;
            border: 2px solid red;
        }
    
    </style>
</head>
<body>

<canvas id="can"></canvas>


<script>

var x = "black";
// var y = 2;
// var flag = false;

//         prevX = 0,
//         currX = 0,
//         prevY = 0,
//         currY = 0,
//         dot_flag = false;
        
    var startX=0,startY=0,endWidth=0,endHeight=0

    canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;
    
        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);

        //  draw(20, 20, 50, 50);

    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            
            startX = currX;
            startY = currY;
            
            console.log(startX + ":" + startY + "####" + e.clientX + ":"  + e.clientY);

            flag = true;
            // dot_flag = true;
            // if (dot_flag) {
            //     ctx.beginPath();
            //     ctx.fillStyle = x;
            //     ctx.fillRect(currX, currY, 2, 2);
            //     ctx.closePath();
            //     dot_flag = false;
            // }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                console.log(currX + ":" + currY);
                endWidth = currX - startX;
                endHeight = currY - startY;

                draw(startX,startY,endWidth,endHeight);
            }
        }
    }

    function draw( xx,yy,ww,hh) {

        
        //ctx.beginPath();
        //ctx.rect(0, 0, 150, 100);
        ctx.strokeRect(xx, yy, ww, hh);
        //ctx.stroke()




        // ctx.beginPath();
        // ctx.moveTo(prevX, prevY);
        // ctx.lineTo(currX, currY);
        // ctx.strokeStyle = x;
        // ctx.lineWidth = y;
        // ctx.stroke();
        // ctx.closePath();
    }

</script>


</body>
</html>