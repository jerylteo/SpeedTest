let leftColor = "red";
let rightColor = "blue";
let letters = "1234567890ABCDEF";

$(document).ready(() => {

    generateButtons($(".leftRandButtons"));
    generateButtons($(".rightRandButtons"));

    $(".leftRandButtons .randBtn").click((e) => {
        let color = $(e.target).attr("id")
        $("#leftHexVal").val(color);
        leftColor = color;

        $(".square").css("background", "linear-gradient(to right, " + leftColor + "," + rightColor + " )");
    })
    $(".rightRandButtons .randBtn").click((e) => {
        let color = $(e.target).attr("id")
        $("#rightHexVal").val(color);
        rightColor = color;

        $(".square").css("background", "linear-gradient(to right, " + leftColor + "," + rightColor + " )");
    })

    $("#leftHexVal").keyup(() => {
        let val = $("#leftHexVal").val();
        if (val.length == 7) {
            leftColor = val;
            $(".square").css("background", "linear-gradient(to right, " + leftColor + "," + rightColor + " )");
        }
    })
    $("#rightHexVal").keyup(() => {
        let val = $("#rightHexVal").val();
        if (val.length == 7) {
            rightColor = val;
            $(".square").css("background", "linear-gradient(to right, " + leftColor + "," + rightColor + " )");
        }
    })
})

function generateButtons(element) {
    for (let i = 0; i < 10; i++) {
        let color = "";

        for (let j = 0; j < 6; j++) {
            let rand = Math.floor(Math.random() * 16);
            color += letters[rand];
        }
        $(element).append(`<button id='#${color}' class='randBtn' style='background-color: #${color}'>&nbsp;</button>`);
    }
}