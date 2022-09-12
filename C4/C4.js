$(function () {
    let red = $("#red");
    let green = $("#green");
    let blue = $("#blue");
    let redText = $("#redVal");
    let greenText = $("#greenVal");
    let blueText = $("#blueVal");
    let box = $("#box");

    red.val(0);
    green.val(0);
    blue.val(0);

    $(".color").on("change", (e) => {
        switch (e.target.getAttribute("name")) {
            case "red":
                redText.html(`${red.val()}`);
                box.css("background-color", `rgb(${red.val()},${green.val()},${blue.val()})`);
                break;

            case "green":
                greenText.html(`${green.val()}`);
                box.css("background-color", `rgb(${red.val()},${green.val()},${blue.val()})`);
                break;

            case "blue":
                blueText.html(`${blue.val()}`);
                box.css("background-color", `rgb(${red.val()},${green.val()},${blue.val()})`);
                break;
        }
    });
});