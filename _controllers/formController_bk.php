<?php
require_once('app.php');

class formController extends App
{
    function __construct() {

    }

    public function step_1() {
        // first, let's check if this is an ABN lead
        if (isset($_REQUEST['inoCode']) && $_REQUEST['inoCode'] != "") {
            // if this is an ABN lead
            $inoCode = $_REQUEST['inoCode'];
            $data['abnCode'] = "abn".$inoCode;
            $inoRow = $this->inoAPI($data, false);
            $inoRow = json_decode($inoRow, true);
            print_r($inoRow);
            die();
            $campaign_id = "1261";
        } else {
            // if this is not an ABN lead
            $inoCode = "";
            $inoName = "";
            $campaign_id = "1120";
        }
        // get the normal field values
        $title = $_REQUEST['title'];
        $firstnames = $_REQUEST['firstnames'];
        $surname = $_REQUEST['surname'];
        $idnumber = $_REQUEST['idnumber'];
        $DateOfBirth = $_REQUEST['DateOfBirth'];
        $Gender = $_REQUEST['Gender'];
        $language = $_REQUEST['language'];
        $email = $_REQUEST['email'];
        $cellphone = $_REQUEST['cellphone'];

        // we need to use these fields in a data array for the API
        $data['src_id'] = $inoCode;
        $data['src_reference'] = $inoName;
        $data['campaign_id'] = $campaign_id;
        $data['title'] = $title;
        $data['firstnames'] = $firstnames;
        $data['surname'] = $surname;
        $data['zaid'] = $idnumber;
        $data['DateOfBirth'] = $DateOfBirth;
        $data['Gender'] = $Gender;
        $data['language'] = $language;
        $data['email'] = $email;
        $data['cellphone'] = $cellphone;

        // now call the API (we're not sending to vici at this stage)
        $API_call = $this->callAPI($data, false);
        // we'll get a response as an array
        $API_call = json_decode($API_call, true);
        // let's check the status
        if ($API_call['status'] === "success") {
            // if the call was successful
            $lead_id = $API_call['data']['lead_id'];
            // we need to update the lead
            $sql = "UPDATE leads SET `status` = '5' WHERE id = ".$lead_id;
            $this->exec($sql);
            $sql = "INSERT INTO leads_audit (`lead_id`, `action_person`, `action_statuscode`) VALUES ('$lead_id', 1, 5)";
            $this->exec($sql);
            $response['lead_id'] = $lead_id;
            $response['success'] = true;
            $data['page'] = 'step_2';
            $data['lead_id'] = $lead_id;
            // set the session data
            $this->set_session_val($data);
        } else {
            // if the call was unsuccessful
            $response['success'] = false;
        }        
        
        // return the response to the formHandler
        return $response;
    }

    public function step_2() {
        // get the normal field values
        $coverselector = $_REQUEST['coverselector'];
        $addspouse = $_REQUEST['addspouse'];
        $addchild = $_REQUEST['addchild'];
        // we need to use these fields in a data array for the session
        $data['coverselector'] = $coverselector;
        $data['addspouse'] = $addspouse;
        $data['addchild'] = $addchild;
        $data['page'] = 'step_3';
        // set the session data
        $this->set_session_val($data);
        // create the response set
        $response['success'] = true;
        // return the response to the formHandler
        return $response;
    }

    public function step_3() {
        // get the normal field values
        $acch               = $_REQUEST['acch'];
        $accnum             = $_REQUEST['accnum'];
        $acct               = $_REQUEST['acct'];
        $bank               = $_REQUEST['bank'];
        $brac_id            = $_REQUEST['brac_id'];
        $bran               = $_REQUEST['bran'];
        $firstdebitdate     = $_REQUEST['firstdebitdate'];
        $firstdebitdate     = date("Y-m-d", strtotime($firstdebitdate));
        $mdd                = $_REQUEST['mdd'];
        // we now need to use the session values for the policy
        $inoCode            = $_SESSION['inoCode'];
        $campaign_id        = $_SESSION['campaign_id'];
        $title              = $_SESSION['title'];
        $firstnames         = $_SESSION['firstnames'];
        $surname            = $_SESSION['surname'];
        $zaid               = $_SESSION['zaid'];
        $DateOfBirth        = $_SESSION['DateOfBirth'];
        $Gender             = $_SESSION['Gender'];
        $language           = $_SESSION['language'];
        $email              = $_SESSION['email'];
        $cellphone          = $_SESSION['cellphone'];
        $lead_id            = $_SESSION['lead_id'];
        $coverselector      = $_SESSION['coverselector'];
        $addspouse          = $_SESSION['addspouse'];
        $addchild           = $_SESSION['addchild'];
        // and create some values on the fly
        $saledate           = date('Y-m-d H:i:s');
        // we need to create the connection here because we'll have to access the insert id, instead of running $this->exec()
        $mysqli = $this->conn();
        // insert into health
        $query = "INSERT INTO health (`lead_source`, `sale_completed`, `sales_agent`, `abn_agent`, `package`, `termination`, `status`, `any_other_plan`, `any_plan_cancelled`, `cancel_reason`, `replacing`, `replacing_reason`, `language`, `first_debit`, `activation_date`, `activation_reason`, `group`, `clanguage`, `bitco`) VALUES ('$lead_id', '$saledate', 257, '$inoCode', '-1', '2099-12-31', 304, '', '', '', '', '', '$language', '', '', 0, 0, '$language', 1)";
        $mysqli->query($query);
        // get the new policy id and create the policy number
        $policy_id = $mysqli->insert_id;
        $policy_no = '286'.(3501258 + $policy_id);
        // update health with policy no
        $query = "UPDATE health SET policy_no = '$policy_no' WHERE id = $policy_id";
        $mysqli->query($query);
        // update lead status to 304 - which will push it to QA
        $query = "UPDATE leads SET status = '304' WHERE id = $lead_id";
        $mysqli->query($query);
        // insert into emails
        $query = "INSERT INTO emails (`email`, `active`) VALUES ('$email', 1)";
        $mysqli->query($query);
        // get the new email id
        $mailid = $mysqli->insert_id;
        // insert into policy_emails
        $query = "INSERT INTO policy_emails (`mailid`, `policyno`) VALUES ('$mailid', '$policy_no')";
        $mysqli->query($query);
        // update health with email id
        $query = "UPDATE health SET email = '$mailid' WHERE id = $policy_id";
        $mysqli->query($query);
        // insert into contacts
        $query = "INSERT INTO contacts (`policy`, `active`, `number`, `kind`) VALUES ('$policy_no', 1, '$cellphone', 'cell')";
        $mysqli->query($query);
        // insert into lifeline
        $query = "INSERT INTO lifeline (`source`, `row`, `agent`, `event`) VALUES ('health', '$policy_id', 257, 'New sale inserted (Affinity Health Website On-line Application')";
        $mysqli->query($query);
        // insert into financial
        $query = "INSERT INTO financial (`income_src`, `pay_period`, `pay_date`, `nett_income`, `expenses`, `holder`, `bank`, `branch`, `branch_code`, `account_number`, `account_type`, `policy`, `method`, `cantrack`) VALUES ('Salary', 'Monthly...', '', '0', '0', '', '', '', '', '', '', '$policy_no', 'DDIND', '0')";
        $mysqli->query($query);
        // get the financial id
        $financial_id = $mysqli->insert_id;
        // update health with financial id
        $query = "UPDATE health SET financial = '$financial_id' WHERE policy_no = $policy_no";
        $mysqli->query($query);
        // insert into members
        $query = "INSERT INTO members (`zaid`, `title`, `firstnames`, `surname`, `gender`, `birthdate`, `marital`, `health`, `employer`, `occupation`, `cell`, `medicalaid_name`, `medicalaid_number`, `weight`, `height`, `smokes`) VALUES ('$zaid', '$title', '$firstnames', '$surname', '$Gender', '$DateOfBirth', 0, 0, 0, 0, '$cellphone', '', '', 0, 0, 0 )";
        $mysqli->query($query);
        // get the member id
        $members_id = $mysqli->insert_id;
        // update health 'main member' with member id
        $query = "UPDATE health SET mainmember = '$members_id' WHERE id = $policy_id";
        $mysqli->query($query);
        // insert into health dependents
        $query = "INSERT INTO health_dependents (`policy`, `members_id`, `termination`, `dc`, `role`) VALUES ('$policy_no', '$members_id', '2099-12-31', '00', '1')";
        $mysqli->query($query);
        // update financial table
        $query = "UPDATE financial SET pay_date = '$firstdebitdate', holder = '$acch', bank = '$brac_id', branch = '$bran', branch_code = '$brac_id', account_number = '$accnum', account_type = '$acct' WHERE policy = $policy_no";
        $mysqli->query($query);
        // ==============================
        // SPOUSE
        // ==============================
        // check if we need to add a spouse
        if ( $addspouse > 0 ) {
            // if we need to add a spouse            
            // first chcek that this policy doesn't already have a spouse
            $query = "SELECT * FROM health_dependents WHERE policy = '$policy_no' AND dc = '01'";
            $result = $this->exec($query);
            if ( $result->num_rows < 1 ) {
                // we need to create the connection here because we'll have to access the insert id, instead of running $this->exec()
                $mysqli = $this->conn();
                // *** insert into members table
                // ------------------------------
                $query = "INSERT INTO members (`zaid`, `title`, `firstnames`, `surname`, `gender`, `birthdate`, `marital`, `health`, `employer`, `occupation`, `cell`, `medicalaid_name`, `medicalaid_number`, `weight`, `height`, `smokes`) VALUES ('', '', '', '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0 )";
                $mysqli->query($query);
                // get the spouse id
                $spouse_id = $mysqli->insert_id;
                // *** insert into health_dependents table
                // ------------------------------
                $query = "INSERT INTO health_dependents (`policy`, `members_id`, `termination`, `dc`, `role`) VALUES ('$policy_no', '$spouse_id', '2099-12-31', '01', '2')";
                $mysqli->query($query);
            }            
        }
        // ==============================
        // DEPENDENTS
        // ==============================
        // check if we need to add dependent(s)
        if ( $addchild > 0 ) {
            // if we need to add dependent(s)
            // first check that there aren't already enough dependents for this policy
            $query = "SELECT * FROM health_dependents WHERE policy = '$policy_no' AND dc = '99'";
            $result = $this->exec($query);
            $existing_dependents = $result->num_rows;
            if ( $existing_dependents < $addchild ) {
                // if there are less dependents existing than the requested dependents
                // calculate how many dependents we have to add
                $dependents_to_add = $addchild - $existing_dependents;
                $mysqli = $this->conn();
                // run an insert for each iteration
                for ($x=0; $x < $dependents_to_add; $x++) { 
                    // *** insert into members table
                    // ------------------------------
                    $query = "INSERT INTO members (`zaid`, `title`, `firstnames`, `surname`, `gender`, `birthdate`, `marital`, `health`, `employer`, `occupation`, `cell`, `medicalaid_name`, `medicalaid_number`, `weight`, `height`, `smokes`) VALUES ('', '', '', '', '', '', 0, 0, 0, 0, '', '', '', 0, 0, 0 )";
                    $mysqli->query($query);
                    // get the dependent id
                    $dependent_id = $mysqli->insert_id;
                    // *** insert into health_dependents table
                    // ------------------------------
                    // generate dc code
                    $num = $x + 2;
                    $num = strval($num);
                    $dc = "0".$num;
                    $query = "INSERT INTO health_dependents (`policy`, `members_id`, `termination`, `dc`, `role`) VALUES ('$policy_no', '$dependent_id', '2099-12-31', '$dc', '3')";
                    $mysqli->query($query);
                }
            }            
        }

        ////////////////////////////////////////////////////////
        // send sms
        $sms = 'Thank you for choosing Affinity Health, your application is being processed. Policy Number: '.$policy_no.'. We will be making contact with you shortly. For queries contact 0861110033.';
        $cellphone = str_replace("-", "", str_replace(" ", "", $cellphone));
        if ( strlen($cellphone) == 10 ) {
            $cellphone = "27".substr($cellphone, -9);
        }
        $fields = array(
            'username' => 'affinityccfpf',
            'password' => 'c969e375',
            'account' => 'affinityccfpf',
            'da' => $cellphone,
            'ud' => $sms,
            'id' => 1
        );
        if (strlen($cellphone) > 10)
        {
            if ($this->isCurlInstalled()) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://sms.connet-systems.com/submit/single/");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $resp = curl_exec ($ch);
                curl_close ($ch);
            }
        }
        // create the data set
        $data['acch'] = $acch;
        $data['accnum'] = $accnum;
        $data['acct'] = $acct;
        $data['bank'] = $bank;
        $data['brac_id'] = $brac_id;
        $data['bran'] = $bran;
        $data['firstdebitdate'] = $firstdebitdate;
        $data['mdd'] = $mdd;
        $data['policy_no'] = $policy_no;
        $data['page'] = 'success';
        $data['firstdebitdate'] = $firstdebitdate;
        // set the session data
        $this->set_session_val($data);
        // create the response set
        $response['success'] = true;
        // return the response to the formHandler
        return $response;
    }

    public function callAPI($data, $sendToVici) {
        // first check if we're sending this to vicidial
        if( $sendToVici ) {
            // if we are sending this to vicidial
            $url = 'http://api.affinityhealth.co.za/api/leads/add/sendToVici';
        } else {
            // if we are NOT sending this to vicidial
            $url = 'http://api.affinityhealth.co.za/api/leads/add/noVici';
        }

        // define option parameters
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        // create stream context from options parameters
        $context  = stream_context_create($options);
        // and call the API
        $result = file_get_contents($url, false, $context);
        // return the result
        return $result;
    }

    public function inoAPI($data) {
        $url = 'http://mobi.affinitybn.co.za/api/app';
        // define option parameters
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        // create stream context from options parameters
        $context  = stream_context_create($options);
        // and call the API
        $result = file_get_contents($url, false, $context);
        // return the result
        return $result;
    }

    /**
     * isCurlInstalled()
     */
    function isCurlInstalled() {
        if ( in_array('curl', get_loaded_extensions()) ) {
            return true;
        } else {
            return false;
        }
    }
}


?>