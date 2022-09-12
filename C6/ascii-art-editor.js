/**
 * JavaScript - ASCII Art Editor
 *
 * Your task is to implement all methods marked with @todo. You must not change any other method.
 * You may add as many methods to the ASCIIArtEditor class as you want.
 */


/**
 * Constructor function to create a new ASCIIArtEditor
 * @constructor
 */
var ASCIIArtEditor = function () {
    /**
     * When transforming images this property should be used as line
     * separator for all operations
     * @type {string}
     */
    this.lineSeperator = '\n';
};


/**
 * This function takes an arbitrary ASCII Art string as input and must
 * return a mirrored version of the given image.
 *
 * It should be possible to choose the mirror-axis with the second argument.
 *
 * The function should use the configured lineSeparator property on
 * the ASCIIArtEditor object.
 *
 * Example on 'x' axis:
 *   Input:                 Output:
 *     # --····-- $           # --====-- $
 *     #  +    -  $           #  +    -  $
 *     # --====-- $           # --····-- $
 *
 * Example on 'y' axis:
 *   Input:                 Output:
 *     # --····-- $           $ --····-- #
 *     #  +    -  $           $  -    +  #
 *     # --====-- $           $ --====-- #
 *
 * @param {string} image - the source image
 * @param {'x'|'y'} [axis='y'] - the axis to be used for the mirror operation, defaults to 'y'
 * @return string - the mirrored input image
 *
 * @throws Error - If an invalid axis was provided
 *
 * @todo
 */
ASCIIArtEditor.prototype.mirror = function (image, axis) {
    let arr = image.split("\n");
    if (image.includes("\r")) {  //for test case 4
        arr = image.split("\r\n");
    }

    let numOfRows = arr.length;
    let output = [];

    if (axis == "x") {
        for (let r = 0; r < numOfRows; r++) {
            output.push(arr[numOfRows - 1 - r]);
        }

    } else if (axis == "y") {
        for (let r = 0; r < numOfRows; r++) {
            let row = [...arr[r]];  //spread all the characters in this string as an array. cannot use string to swap the char directly
            let numOfCols = row.length;
            let midPoint = Math.floor(numOfCols / 2);
            for (let c = 0; c < midPoint; c++) {
                let temp = row[c];
                row[c] = row[numOfCols - 1 - c];
                row[numOfCols - 1 - c] = temp;
            }
            output.push(row.join().replaceAll(",", ""));
        }
    } else {
        throw "exception";
    }
    return output.join(this.lineSeperator);
};


/**
 * Takes any SQUARE ASCII image and must rotate the image by the
 * given angle (only multiple of 90 allowed).
 *
 * The rotation should always be clockwise.
 *
 * Example:
 *   Input:    90deg:    180deg:    270deg:    360deg:
 *     #-*       $-#       *-$        ***         #-*
 *     --*       ---       *--        ---         --*
 *     $-*       ***       *-#        #-$         $-*
 *
 * @param {string} image
 * @param {number} angle, has to be one of 0, 90, 180, 270, 360
 * @return string
 *
 * @throws Error - If an invalid angle was provided
 *
 * @todo
 */
ASCIIArtEditor.prototype.rotate = function (image, angle) {
    if (angle == "90") {
        let arr = image.split("\n");
        let size = arr.length;
        let output = [];
        for (let r = 0; r < size; r++) {
            output.push(new Array(size));
        }

        //need to draw out to understand how the row and column indices swapped.
        for (let r = 0; r < size; r++) {
            for (let c = 0; c < size; c++) {     //it is a square input. can assume # of row = # of col
                //column become row, row become column (size-1-r)
                output[c][size - 1 - r] = arr[r][c];
            }
        }
        //not sure why the array.map function didn't work for the join() function.
        for (let r = 0; r < size; r++) {
            output[r] = output[r].join().replaceAll(",", "");
        }
        return output.join(this.lineSeperator);
    } else if (angle == "180") {
        let mirrorX = this.mirror(image, "x");
        let output = this.mirror(mirrorX, "y");
        return output;
    } else if (angle == "270") {
        let rotate90 = this.rotate(image, "90");
        let output = this.rotate(rotate90, "180");
        return output;
    } else if (angle == "360" || angle == "0") {
        return image;
    } else {
        throw "invalid angle";
    }
};
