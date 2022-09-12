$(function () {
    let canvas = document.getElementById("myCanvas");
    let ctx = canvas.getContext("2d");
    let color = "black"; //the default color for fill / stroke
    let tool = "line"; //the selected tool "dot", "line" or "eraser"
    let startDraw = false; //to determine the drawing state
    let lineWidth = 3; //setting for line width

    $(".colorChoice").change((e) => {
        let input = $(e.target);
        color = input.val();
    });

    canvas.addEventListener("mousedown", (e) => {
        let mouseX = e.offsetX;
        let mouseY = e.offsetY;
        ctx.lineWidth = lineWidth;
        ctx.globalCompositeOperation = "source-over";
        startDraw = true;
        ctx.beginPath();
        ctx.moveTo(mouseX, mouseY);
    });

    canvas.addEventListener("mouseup", (e) => {
        startDraw = false;
    });

    canvas.addEventListener("mousemove", (e) => {
        let mouseX = e.offsetX;
        let mouseY = e.offsetY;

        if (startDraw) {
            ctx.lineTo(mouseX, mouseY);
            ctx.strokeStyle = color;
            ctx.stroke();
        }
    });
});