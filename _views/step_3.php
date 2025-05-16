<script>
$(function(){
    $("#firstdebitdate").datepicker({
		minDate: 0, maxDate: "62D",
		beforeShowDay: function (date) {

        if (date.getDate() == 1 || date.getDate() == 7 || date.getDate() == 15 || date.getDate() == 20 || date.getDate() == 25) {
            return [true, ''];
        }
        return [false, ''];
		
       }
									
    });
	
});
	
  
  $( function() {
    $( "#paydate" ).datepicker({ minDate: 0, maxDate: "31D" });
  } );
	
</script>

<!-- form -->
<form>
    <div class="container">
        <div class="wrapper margin-fix">
            <!-- left -->
            <div class="left">
                <h2>The final piece to the puzzle.</h2>
                <p>To complete your Affinity Health application, we just need to setup your debit order.</p>
                <div class="divider-50"></div>
                <div class="input-box-33">
                    <label for="">Account Holder Name</label>
                    <input type="text" name="acch" id="acch" onkeypress="return check_text(event)">
                </div>
                <div class="input-box-33">
                    <label for="">Account Number</label>
                    <input type="text" name="accnum" id="accnum" onkeypress="return check_acc_number(event)">
                </div>
                
                <div class="input-box-33">
                    <label for="">Account Type</label>
                    <select name="acct" id="acct" value="<?=$acct;?>">
                        <option selected="" disabled="" value="">Select...</option>
                        <option value="1">Cheque / Current</option>
                        <option value="2">Savings</option>
                        <option value="3">Transmission</option>
                    </select>
                </div>
                <div class="input-box-33">
                    <label for="">Bank Name</label>
                    <select name="bank" id="bank">
                        <option selected="" disabled="" value="">Select...</option>
                        <optgroup label="Major Banks"><option value="632005">Absa Bank</option>
                            <option value="470010">Capitec Bank</option>
                            <option value="250655">First National Bank (South Africa)</option>
                            <option value="198765">Nedbank (South Africa)</option>
                            <option value="051001">Standard Bank (South Africa)</option>
                        </optgroup>
                        <optgroup label="Specialist Banks">
                            <option value="800000">Albaraka Bank</option>
                            <option value="999005">Bank of Athens</option>
                            <option value="462005">Bidvest Bank</option>
                            <option value="350005">Citi Bank</option>
                            <option value="589000">Finbond Mutual Bank</option>
                            <option value="584000">Grindrod Bank</option>
                            <option value="570105">HBZ Bank</option>
                            <option value="587000">HSBC Bank</option>
                            <option value="580105">Investec Bank</option>
                            <option value="756026">Ithala Bank</option>
                            <option value="432000">JP Morgan Chase Bank</option>
                            <option value="471001">Meeg Bank</option>
                            <option value="450605">Mercantile Bank</option>
                            <option value="490991">Mtn Banking</option>
                            <option value="585001">Olympus Mobile</option>
                            <option value="187405">Peoples Bank</option>
                            <option value="460005">Postbank</option>
                            <option value="588000">SASFIN</option>
                            <option value="801000">State Bank Of India</option>
                            <option value="431010">Ubank</option>
                            <option value="790005">Unibank</option>
                            <option value="588000">VBS Mutual Bank</option>
                        </optgroup>
                    </select>
                </div>
                <div class="input-box-33">
                    <label for="">Branch Code</label>
                    <input type="text" name="brac" id="brac_id" readonly>
                </div>	
                <div class="input-box-33">
                    <label for="">Branch Name</label>
                    <input type="text" name="bran" id="bran" class="valid" aria-invalid="false" onkeypress="return check_text(event)">
                </div>
                <div class="input-box-33">
                    <label for="">First Debit Date</label>
                    <input type="text" name="fdd" id="firstdebitdate" class="datepicker calicon">
                </div>
                <div class="input-box-33">
                    <label for="">Thereafter</label>
                    <select name="mdd" id="mdd">
                        <optgroup label="For the current month">
                            <option value="1">1st of each month</option>
                            <option value="7">7th of each month</option>
                        </optgroup>
                        <optgroup label="For next month">
                            <option value="15">15th of each month</option>
                            <option value="20">20th of each month</option>
                            <option value="25">25th of each month</option>
                        </optgroup>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="divider-20"></div>
                <div class="input-box-checks" id="terms">
                    <input type="checkbox" name="terms_agree" id="auth2">
                    <label for="auth2">I certify that the above details are mine.</label>
                </div>
                <div class="clear"></div>
                <div class="divider-20"></div>
                <div class="input-box-apply">
                    <input type="button" value="FINISH APPLICATION" class="app-apply" id="proceed_button" onClick="step_3();">
                </div>
                <div class="clear"></div>
                <div class="divider-20"></div>
                <div class="nav">
                    <!---  <input type="button" value="< BACK" onClick="window.location = 'step-2.php';" class="return"> -->
                    <?php if( $_SESSION['i'] < 0 ): ?>
                    <a class="livechat" href="livechat.html" onClick="window.open('livechat.html','Live Chat','resizable,height=480,width=320'); return false;">Chat with an agent online</a><noscript>You need Javascript to use the previous link or use <a href="yourpage.htm" target="_blank">Chat with an agent online</a></noscript>
                    <?php endif; ?>
                </div>                        
            </div>
            <!-- right -->
            <div class="right">
                <div class="sidebar-secure">
                    <h4>Your data is safe!</h4>
                    <div class="ssl">
                        <img src="_load/images/ssl-large.png" width="100%" height="auto" alt="SSL Secure Connection">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>

<script>
var objField = document.getElementById("bank");
objField.onchange = function () {
    BranchNumbers();
}

function BranchNumbers() {
    var branch_code = $('#bank').find('option:selected').val();
    
    $('#brac_id').val(branch_code);
    $('#bran').val("UNIVERSAL");
}
</script>
<script type="text/javascript">
$(".step-1").removeClass("active");
$(".step-1").addClass("complete");
$(".step-2").removeClass("active");
$(".step-2").addClass("complete");
$(".step-3").removeClass("pending");
$(".step-3").addClass("active");

</script>