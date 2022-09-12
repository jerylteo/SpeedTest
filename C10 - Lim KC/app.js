let currImg = new Image();
$(document).ready(() => {
    let canvas = document.getElementById("canvas");
    let context = canvas.getContext("2d");


    $(".imgSelection").change(() => {
        canvas.width = canvas.width;
        let imgSrc = $(".imgSelection").val();

        currImg.onload = function () {
            context.drawImage(currImg, 10, 10, 200, 300);
        }
        currImg.src = imgSrc;
    })

    $(".filterSelection").change(() => {
        let filterSel = $(".filterSelection").val();
        if (filterSel == "lighten") {
            context.filter = "brightness(1.4)";
        } else if (filterSel == "darken") {
            context.filter = "brightness(0.5)";
        }
        context.drawImage(currImg, 220, 10, 200, 300);
    })
})