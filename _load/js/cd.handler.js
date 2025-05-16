$(document).ready(
    function() { }
);

function step_1() {
    // new Validator() instance
    var validator = new Validator();
    // the rules
    validator.rules = {
        title: {
            id: 'title',
            label: 'Title',
            required: true
        },
        firstnames: {
            id: 'firstnames',
            label: 'First name',
            required: true,
            alpha: true,
            min: 2
        },
        surname: {
            id: 'surname',
            label: 'Surname',
            required: true,
            alpha: true,
            min: 2
        },
        idnumber: {
            id: 'idnumber',
            label: 'ID Number',
            required: true,
            max: 13,
            min: 13
        },
        language: {
            id: 'language',
            label: 'Language',
            required: true
        },
        email: {
            id: 'email',
            label: 'Email Address',
            required: true,
            email: true
        },
        cellphone: {
            id: 'cellphone',
            label: 'Cellphone Number',
            required: true,
            cell: true
        }
    };
    // the results
    var results = validator.validate();
    // let's check the results
    if (results.okay) {
        // if the results are okay
        // disable the proceed button
        $("#proceed_button").val("PLEASE WAIT...");
        $("#proceed_button").prop("disabled", true);
        // determine the date of birth (dob) and gender
        var zaid = $('#idnumber').val();
        var dob = decode_id(zaid, 1);
        var gender = decode_id(zaid, 2);
        var inoCode = $('#inoCode').val();
        var inoName = $('#inoName').val();
        // hand things over to our curl_bridge script
        jQuery.ajax({
            url: "./_handlers/formHandler.php",
            type: 'POST',
            data: {
                step: 'step_1',
                title: $('#title').val(),
                firstnames: $('#firstnames').val(),
                surname: $('#surname').val(),
                idnumber: zaid,
                DateOfBirth: dob,
                Gender: gender,
                language: $('#language').val(),
                email: $('#email').val(),
                cellphone: $('#cellphone').val(),
                inoCode: inoCode,
                inoName: inoName
            }, 
            dataType: 'json',
            success: function (response) {
                /*
                // check if the response status is true (successful)
                if ( response.status ) {
                    // if the response status is true (successful)
                    console.log('Lead: '+response.lead_id);
                    console.log(response);
                    window.location.replace('<?= BASE_URL ?>'+response.next_step);
                } else {
                    // if the response status is false (failed)
                    alert('Something went wrong. Please try again...');
                }			
                */
               if ( response.success ) {
                   window.location.reload();
               } else {
               console.log(response);
                    alert('Something went wrong. Please try again [public_ssl - Step 1]...');
               }
               console.log(response);
               console.log("Code: "+inoCode+" Name: "+inoName);
            }
        });
    } else {
        // if the results are not okay
        // create an empty notify string 
        var notify = "";
        // loop through the id's of the failed results
        for (var failed_id in results) {
            // grab the error
            var error = results[failed_id].message;
            // we don't need the '.okay' object element
            if (failed_id !== 'okay') {
                // add the error to the notify string
                notify = notify + "- " + error + "\n";
            }
        }
        // show the formatted errors
        alert(notify);
    }
}

function step_2() {
    // new Validator() instance
    var validator = new Validator();
    // the rules
    validator.rules = {
        coverselector: {
            id: 'cover-selector',
            label: 'Cover Options',
            required: true
        },
        addspouse: {
            id: 'addspouse',
            label: 'Spouse selection',
            required: true
        },
        addchild: {
            id: 'addchild',
            label: 'Child selection',
            required: true
        }
    };
    // the results
    var results = validator.validate();
    // let's check the results
    if (results.okay) {
        // if the results are okay
        // disable the proceed button
        $("#proceed_button").val("PLEASE WAIT...");
        $("#proceed_button").prop("disabled", true);
        // hand things over to our curl_bridge script
        jQuery.ajax({
            url: "./_handlers/formHandler.php",
            type: 'POST',
            data: {
                step: 'step_2',
                coverselector: $('#cover-selector').val(),
                addspouse: $('#addspouse').val(),
                addchild: $('#addchild').val()
            },
            dataType: 'json',
            success: function (response) {
               if ( response.success ) {
                   window.location.reload();
               } else {
                    alert('Something went wrong. Please try again [public_ssl - Step 3]...');
               }
               console.log(response);
            }
        });
    } else {
        // if the results are not okay
        // create an empty notify string 
        var notify = "";
        // loop through the id's of the failed results
        for (var failed_id in results) {
            // grab the error
            var error = results[failed_id].message;
            // we don't need the '.okay' object element
            if (failed_id !== 'okay') {
                // add the error to the notify string
                notify = notify + "- " + error + "\n";
            }
        }
        // show the formatted errors
        alert(notify);
    }
}

function step_3() {
    // new Validator() instance
    var validator = new Validator();
    // the rules
    validator.rules = {
        acch: {
            id: 'acch',
            label: 'Account Holder Name',
            required: true
        },
        accnum: {
            id: 'accnum',
            label: 'Account Number',
            required: true
        },
        acct: {
            id: 'acct',
            label: 'Account Type',
            required: true
        },
        bank: {
            id: 'bank',
            label: 'Bank Name',
            required: true
        },
        firstdebitdate: {
            id: 'firstdebitdate',
            label: 'First Debit Date',
            required: true
        },
        mdd: {
            id: 'mdd',
            label: 'Thereafter Date',
            required: true
        },
        auth2: {
            id: 'auth2',
            label: 'Agree checkbox',
            required: true
        }
    };
    // the results
    var results = validator.validate();
    // let's check the results
    if (results.okay) {
        // if the results are okay
        // disable the proceed button
        $("#proceed_button").val("PLEASE WAIT...");
        $("#proceed_button").prop("disabled", true);
        // hand things over to our curl_bridge script
        jQuery.ajax({
            url: "./_handlers/formHandler.php",
            type: 'POST',
            data: {
                step: 'step_3',
                acch: $('#acch').val(),
                accnum: $('#accnum').val(),
                acct: $('#acct').val(),
                bank: $('#bank').val(),
                brac_id: $('#brac_id').val(),
                bran: $('#bran').val(),
                firstdebitdate: $('#firstdebitdate').val(),
                mdd: $('#mdd').val()
            },
            dataType: 'json',
            success: function (response) {
               if ( response.success ) {
                   window.location.reload();
               } else {
                    alert('Something went wrong. Please try again [public_ssl - Step 3]...');
               }
               console.log(response);
            }
        });
    } else {
        // if the results are not okay
        // create an empty notify string 
        var notify = "";
        // loop through the id's of the failed results
        for (var failed_id in results) {
            // grab the error
            var error = results[failed_id].message;
            // we don't need the '.okay' object element
            if (failed_id !== 'okay') {
                // add the error to the notify string
                notify = notify + "- " + error + "\n";
            }
        }
        // show the formatted errors
        alert(notify);
    }
}