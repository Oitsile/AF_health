/*
| ================================================================================
| ../js/cd.validate.js
| This file contains the js validation functions we use
| for form validation throughout the form
| ~ C.D.
| ================================================================================
*/

/*
| check_required_fields()
| ----------------------------------------
| Expects the required input fields in an array
| It returns an array (required_fields) of
| the fields that are required, but that
| have empty value(s)
*/
function check_required_fields(compulsory_fields) {
    // count how many compulsory fields there are
    var compulsory_count = compulsory_fields.length;
    // set the required_fields to 0
    var required_fields = [];

    // now, loop through the compulsory_fields and check if they have values
    for (a = 0; a < compulsory_count; a++) {
        // define the id variable as the value of the current array key
        var field = compulsory_fields[a];
        // check if the field actually exists
        if (document.getElementById(field)) {
            // if the field actually exists, check if it is empty
            if (document.getElementById(field).value === "") {
                // if it is empty, add it to required_fields array
                required_fields.push(field);
            }
        }
    }
    // return the array of required_fields
    return required_fields;
}

/*
| check_text()
| ----------------------------------------
| Validates text fields (alpha characters) on key press
*/
function check_text(evt) {
    // identify the key being pressed
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    // check if the key passed only_letters check
    if (only_letters(key) == false) {
        // if the key failed only_letters check
        // prevent the key from being entered
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
    /* else {
        // if the key passed only_letters check
        // we want to format the entire string to title case
        var str = theEvent.target.value + key;
        var tc_str = title_case(str);
        theEvent.target.value = tc_str;
        theEvent.returnValue = false;
    }
    */
}

/*
| check_id()
| ----------------------------------------
| Prevents unwanted character entries for the id field
*/
function check_id(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    if (only_numbers(key) == false) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

/*
| verify_id()
| ----------------------------------------
| Returns true if a string is a valid id number
*/
function verify_id(j) {
    var digits = j.split("");

    if (j.length != 13) {
        // not enough digits
        return false;
    } else {
        // passed min characters test
        // some of Greg's logic...
        OddCheck = parseInt(digits[0]) + parseInt(digits[2]) + parseInt(digits[4]) + parseInt(digits[6]) + parseInt(digits[8]) + parseInt(digits[10]);
        Multiplier = parseInt(digits[1] + digits[3] + digits[5] + digits[7] + digits[9] + digits[11]) * 2;

        var month = parseInt(digits[2] + digits[3]);
        var day = parseInt(digits[4] + digits[5]);
        var birthyear = parseInt(digits[0] + digits[1]);
        var epoch = new Date();
        var thisyear = epoch.getFullYear();
        var thiscc = parseInt(thisyear.toString().substr(0, 2));
        thisyear = parseInt(thisyear.toString().substr(2, 2));
        if (thisyear < birthyear) {
            thiscc = thiscc - 1;
        }
        var dobcymd = thiscc.toString() + digits[0] + digits[1] + '-' + digits[2] + digits[3] + '-' + digits[4] + digits[5];

        // checks if the dob month and/or day value(s) make sense
        if ((month > 12) || (month < 1) || (day > 31) || (day < 1)) {
            // dob month and/or day value(s) don't make sense
            return false;
        } else {
            // dob month and day values make sense
            // some more of Greg's logic
            var EvenCheck = 0;
            while (Multiplier > 0) {
                EvenCheck += (Multiplier % 10);
                Multiplier = Multiplier - (Multiplier % 10);
                Multiplier = Multiplier / 10;
            }
            SumCheck = OddCheck + EvenCheck;
            Checksum = 10 - (SumCheck % 10);
            if (Checksum == 10) { Checksum = 0; }
            if (digits[12] == Checksum) {
                // everything is groovy
                return true;
            } else {
                // just no - this is shit
                return false;
            }
        }
    }
}

/*
| verify_cell()
| ----------------------------------------
| Returns true if a string is a valid cellphone number
*/
function verify_cell(j) {
    var digits = j.split("");

    // check the length
    if ( j.length != 10 ) {
        // failed length check
        return false;
    } else {
        // passed length check
        // check if it has a trailling zero
        if ( digits[0] != 0 ) {
            // if it doesn't have a trailling zero
            return false;
        } else {
            // if it has a trailling zero
            return true;
        }
    }
}

/*
| check_email()
| ----------------------------------------
| Returns true if a value is a valid email address
*/
function check_email(evt) {
    // identify the key being pressed
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    // get the field value
    var str = evt.target.value;

    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str)) {
        var lc_str = lower_case(str);
        evt.target.value = lc_str;
        return (true);
    } else {
        evt.target.value = "";
        theEvent.returnValue = false;
    }
}

/*
| check_cell()
| ----------------------------------------
| Validates the cell number on key press
*/
function check_cell(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    if (only_numbers(key) == false) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

/*
| check_acc_number()
| ----------------------------------------
| Validates the account number on key press
*/
function check_acc_number(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    if (only_numbers(key) == false) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

/*
| only_numbers()
| ----------------------------------------
| Returns true if a value is a number
*/
function only_numbers(val) {
    var regex = /[0-9\b]/;
    if (!regex.test(val)) {
        return false;
    } else {
        return true;
    }
}

/*
| only_letters()
| ----------------------------------------
| Returns true if a value is an alpha character
*/
function only_letters(val) {
    var regex = /^([^0-9()[\]{}*;":,.?`|<>&^%$#@!]*)$/;
    if (!regex.test(val)) {
        return false;
    } else {
        return true;
    }
}

/*
| only_email()
| ----------------------------------------
| Returns true if a value is a valid email address
*/
function only_email(val) {
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!regex.test(val)) {
        return false;
    } else {
        return true;
    }
}

/*
| lower_case()
| ----------------------------------------
| Accepts a string and returns lower case format
*/
function lower_case(str) {
    return str.toLowerCase();
}

/*
| title_case()
| ----------------------------------------
| Accepts a string and returns Title Case format
*/
function title_case(str) {
    str = str.toLowerCase().split(' ');
    for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
    }
    return str.join(' ');
}



/**
 * =====================================================================================
 */
function validate_this(array) {
    // create empty val variable
    var val;
    // set the failed_cases to empty array
    var failed_cases = [];
    
    // firstnames
    if (array.indexOf("firstnames") != -1) {
        val = document.getElementById("firstnames");
        // test for only letters
        if (only_letters(val) == false) {
            failed_cases.push("First Name");
        }
    }
    // surname
    if (array.indexOf("surname") != -1) {
        val = document.getElementById("surname");
        // test for only letters
        if (only_letters(val) == false) {
            failed_cases.push("Surname");
        }
    }
    // idnumber
    if (array.indexOf("idnumber") != -1) {
        val = document.getElementById("idnumber");
    }
    // language
    if (array.indexOf("language") != -1) {
        val = document.getElementById("language");
    }
    // email
    if (array.indexOf("email") != -1) {
        val = document.getElementById("email");
    }
    // cellphone
    if (array.indexOf("cellphone") != -1) {
        val = document.getElementById("cellphone");
    }

    alert(msg);
}