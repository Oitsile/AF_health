<?php 
require_once("app/app.php"); 
new App;
/*
| ================================================================================
| ../js/cd.popdrop.php
| This function provides an easy way to populate input fields with
| existing session values (ie. when user goes back a step and
| we need to remember his selection - especially handy
| when dealing with dropdown selections, radios etc.)
| ~ C.D.
| ================================================================================
*/
?>

<script type="text/javascript">

    /*
    | popdrop()
    | ----------------------------------------
    | Expects the input fields in an array
    */
    function popdrop(array) {
        // let's loop through each array item
        for ( i = 0; i < array.length; i++ ) { 
            // define the id variable as the value of the current array key
            var id = array[i];
            // get the session_value from get_session_value function
            var session_value = get_session_value(id);
            // check if the session value isn't blank - there's no need
            // to do anything if it is blank anyway
            if ( session_value !== '' ) {
                // if the value isn't blank, then set the input field to this value
                document.getElementById(id).value = session_value;
            }
        }
    }

    /*
    | get_session_value()
    | ----------------------------------------
    | Expects the name as set in session array
    */
    function get_session_value( id ) {
        // define session_value variable
        var session_value;
        /* 
        | we'll have to handle each id individually.
        | admittedly, this is a cockup and can
        | probably be done better
        | ----------------------------------------
        */
        switch ( id ) 
        {
            // step_1 fields
            // ----------------------------------------
            // 'title', 'firstnames', 'surname', 'idnumber', 'language', 'email', 'cellphone'
            case 'title':
                session_value = '<?php echo $_SESSION['title']; ?>';
                break;
            case 'firstnames':
                session_value = '<?php echo $_SESSION['firstnames'] ?>';
                break;
            case 'surname':
                session_value = '<?php echo $_SESSION['surname'] ?>';
                break;
            case 'idnumber':
                session_value = '<?php echo $_SESSION['idnumber'] ?>';
                break;
            case 'language':
                session_value = '<?php echo $_SESSION['language']; ?>';
                break;
            case 'email':
                session_value = '<?php echo $_SESSION['email']; ?>';
                break;
            case 'cellphone':
                session_value = '<?php echo $_SESSION['cellphone']; ?>';
                break;
            // step_2 fields
            // ----------------------------------------
            case 'cover-selector':
                session_value = '<?php echo $_SESSION['cover-selector']; ?>';
                break;
            case 'addspouse':
                session_value = '<?php echo $_SESSION['addspouse']; ?>';
                break;
            case 'addchild':
                session_value = '<?php echo $_SESSION['addchild']; ?>';
                break;
            // step_3 fields
            // ----------------------------------------
            case 'acch':
                session_value = '<?php echo $_SESSION['acch']; ?>';
                break;
            case 'accnum':
                session_value = '<?php echo $_SESSION['accnum']; ?>';
                break;
            case 'acct':
                session_value = '<?php echo $_SESSION['acct']; ?>';
                break;
            case 'bank':
                session_value = '<?php echo $_SESSION['bank']; ?>';
                break;
            case 'brac_id':
                session_value = '<?php echo $_SESSION['brac_id']; ?>';
                break;
            case 'bran':
                session_value = '<?php echo $_SESSION['bran']; ?>';
                break;
            case 'firstdebitdate':
                session_value = '<?php echo $_SESSION['firstdebitdate']; ?>';
                break;
            case 'mdd':
                session_value = '<?php echo $_SESSION['mdd']; ?>';
                break;
        }
        
        // return the session value
        return session_value;
        
    }
</script>