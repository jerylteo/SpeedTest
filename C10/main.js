const canvas = document.getElementById("my-canvas");
const context = canvas.getContext("2d");

const canvas2 = document.getElementById("my-canvas2");
const context2 = canvas2.getContext("2d");



const img = new Image()
//Load Athena.jpg by default
img.src = "./athena.jpg"
img.onload = () => {
  context.drawImage(img, 0, 0)
}

//Add a onchange event to the select
document.getElementById("image").addEventListener("change", function() {
    //Get value of the image select option
    var imageVal = document.getElementById('image').value;
    console.log(imageVal);
    if( imageVal != "Image:" ) { //If select isnt the default option
        //Clear the canvas
        context.clearRect(0, 0, canvas.width, canvas.height);
        //Change canvas and draw the new image
        img.src = "./" + imageVal;
        context.drawImage(img, 0, 0);
    }else {
        img.src = "./athena.jpg"
        context.drawImage(img, 0, 0)
    }

    document.getElementById("filter").value = "Filter:";
    context2.clearRect(0, 0, canvas.width, canvas.height);
})

document.getElementById("filter").addEventListener("change", function() {
    var filterVal = document.getElementById("filter").value;
    var imageVal = document.getElementById('image').value;
    console.log(filterVal);
    if( imageVal != "Image:" && filterVal == "Darken") { //If select isnt the default option
        //Clear the canvas
        context.clearRect(0, 0, canvas.width, canvas.height);
        //Change canvas and draw the new image
        var imgFilter = new Image();
        img.src = "./" + imageVal;
        context.drawImage(img, 0, 0);

        imgFilter.src = "./" + imageVal;
        context2.filter = "brightness(40%)";
        context2.drawImage(imgFilter, 0, 0);
    }else if( imageVal == "Image:" && filterVal == "Darken") {
        var imgFilter = new Image();
        imgFilter.src = "./athena.jpg"  ;
        context2.filter = "brightness(40%)";
        context2.drawImage(imgFilter, 0, 0);
    }

    if(imageVal != "Image:" && filterVal == "Lighten") {
        context.clearRect(0, 0, canvas.width, canvas.height);
        //Change canvas and draw the new image
        var imgFilter = new Image();
        img.src = "./" + imageVal;
        context.drawImage(img, 0, 0);

        imgFilter.src = "./" + imageVal;
        context2.filter = "brightness(150%)";
        context2.drawImage(imgFilter, 0, 0);
    }else if( imageVal == "Image:" && filterVal == "Darken") {
        var imgFilter = new Image();
        imgFilter.src = "./athena.jpg"  ;
        context2.filter = "brightness(150%)";
        context2.drawImage(imgFilter, 0, 0);
    }
})

