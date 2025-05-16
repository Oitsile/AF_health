<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/apply/_controllers/app.php');
$app = new App;
require_once(CONTROLLER_URL.'formController.php');
$form = new formController;

if (isset($_REQUEST['step']) && $_REQUEST['step'] != "") {
    call_user_func($_REQUEST['step']);
}

/**
 * step_1()
 * ----------
 * handles everything step 1 related
 */
function step_1() {
    $form = new formController;
    // send the response array back to ajax caller
    echo json_encode($form->step_1());
}

/**
 * step_2()
 * ----------
 * handles everything step 2 related
 */
function step_2() {
    $form = new formController;
    // send the response array back to ajax caller
    echo json_encode($form->step_2());
}

/**
 * step_3()
 * ----------
 * handles everything step 3 related
 */
function step_3() {
    $form = new formController;
    // send the response array back to ajax caller
    echo json_encode($form->step_3());
}


?>