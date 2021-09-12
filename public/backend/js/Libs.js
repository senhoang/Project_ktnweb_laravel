/**
 * Format number according to the format option in formatNum format of the library
 * By default #, ###. ## separated by commas, spread after decimal 2 digits
 *
 * @param {String} val
 * @param {String} pattern default #,###.##
 * @param {int} round default 0: Default rounding -1: rounding down, 1: rounding up
 * @author:  MinhPham 2018-11-18 11:16:34
 */
var formatNum = function (val, pattern = "#,###.##", round = 0) {
    if (Libs.isBlank(val) || isNaN(val)) {
        return "";
    }
    val = val * 1;
    let comma = ",";
    let decimal = ".";
    let afterDecimalNum = 0; //After the decimal point take some numbers
    if (Libs.isBlank(pattern)) {
        pattern = "#,###.##";
    }
    const regex = new RegExp("[,.]+", "ig");
    let myArray;
    let index = 0;
    let afterDecimal = "";
    while ((myArray = regex.exec(pattern)) !== null) {
        //The first time is the comma
        if (index === 0) {
            comma = myArray[0];
        } else if (comma !== myArray[0]) {
            //The last time is the decimal separator
            afterDecimal = myArray[0];
        }
        index++;
    }
    if (afterDecimal !== "") {
        decimal = afterDecimal;
        afterDecimalNum = pattern.length - (pattern.lastIndexOf(decimal) + 1);
    }

    var opts = {
        negativeType: "left",
        prefix: "",
        suffix: "",
        integerSeparator: comma,
        decimalsSeparator: "",
        decimal: decimal,
        padLeft: -1,
        round: afterDecimalNum,
    };
    if (round === 1) {
        val = roundTo.up(val, afterDecimalNum);
    } else if (round === 0) {
        val = roundTo(val, afterDecimalNum);
    } else {
        val = roundTo.down(val, afterDecimalNum);
    }

    return formatNum(opts)(val);
};

var convertStringToNumber = function (value) {
    try {
        var val = value;
        if (typeof val === "undefined" || val == null) return null;
        if (typeof val === "number") {
            val = val.toString();
        }
        return Number(val.replace(/[^0-9]+/g, ""));
    } catch (err) {
        return null;
    }
};

