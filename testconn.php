<?php
// which db conn are we testing?
// db_abn / affinity
$db = "db_abn";

// if we're testing db_abn conn
if ($db === "db_abn") {
    // db credentials
    $host = "mobi.affinitybn.co.za";
    $user = "onlineApp";
    $pass = "onlineApp";
    $name = "db_abn";
    $port = "3306";
    // query
    $query = "SELECT type FROM paymentTypes LIMIT 1";
}

// if we're testing affinity conn
if ($db === "affinity") {
    // db credentials
    $host = "crm.affinityhealth.co.za";
    $user = "InternalOnly";
    $pass = "F=@k-Vq92!:Z";
    $name = "affinity";
    $port = "3306";
    // query
    $query = "SELECT claim_status FROM claim_status LIMIT 1";
}

// make the connection
$conn = mysqli_connect( $host, $user, $pass, $name, $port );
// run the query
$result = mysqli_query($conn, $query);
// fetch the result
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

// show the result
echo "<pre>";
print_r($result);


?>