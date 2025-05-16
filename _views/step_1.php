<!-- form -->
<form class="form-field" id="form-field">
    <input type="hidden" name="inoCode" id="inoCode" value="<?= $_SESSION['inoCode'] ?>">
    <input type="hidden" name="inoName" id="inoName" value="<?= $_SESSION['inoName'] ?>">
    <div class="container">
        <div class="wrapper">
            <!-- left -->
            <div class="left">
                <h2>Hello and welcome!</h2>
                <p>Let’s get started! You are three easy steps away from creating your affordable health plan with amazing benefits!</p>
                <div class="divider-50"></div>
                <div class="input-box-33">
                    <select name="title" id="title">
                        <option selected="true" value="" disabled="disabled">Title</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Dr">Dr</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
                <div class="input-box-33">
                    <input type="text" name="firstnames" id="firstnames" placeholder="First names" required >
                </div>
                <div class="input-box-33">
                    <input type="text" name="surname" id="surname" placeholder="Surname" onkeypress="return check_text(event)" required>
                </div>
                <div class="input-box-33">
                    <input type="text" name="idnumber"  maxlength="13" placeholder="ID Number" id="idnumber" onkeypress="return check_id(event)">
                    <div id="idinfo">?</div>
                </div>
                <div class="input-box-33">
                    <select name="language" id="language" required>
                        <option selected="true" value="" disabled="disabled">Home Langauge...</option>
                        <option value="Afrikaans">Afrikaans</option>
                        <option value="English">English</option>
                        <option value="isiNdebele">isiNdebele</option>
                        <option value="isiXhosa">isiXhosa</option>
                        <option value="isiZulu">isiZulu</option>
                        <option value="Sesotho sa Leboa">Sesotho sa Leboa</option>
                        <option value="Sesotho">Sesotho</option>
                        <option value="Setswana">Setswana</option>
                        <option value="siSwati">siSwati</option>
                        <option value="Tshivenda">Tshivenda</option>
                        <option value="Xitsonga">Xitsonga</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="input-box-33">
                    <input type="text" name="email" id="email" placeholder="E-mail address" onblur="return check_email(event)" required>
                </div>
                <div class="input-box-33">
                    <input maxlength="10" type="text" name="cellphone" id="cellphone" placeholder="Cellphone number" onkeypress="return check_cell(event)" required>
                </div>
                <div class="clear">
                <p>By clicking next you agree to all <a href ="https://www.affinityhealth.co.za/popi/" target="_blank">Terms and Conditions</a></p>
                </div>
                <div class="divider-30"></div>
                <div class="nav">
                    <input type="button" class="proceed" id="proceed_button" value="NEXT >" onClick="step_1();">
                    <!--
                    <?php if( $_SESSION['inoCode'] < 0 ): ?>
                    <a class="livechat" href="livechat.html" onClick="window.open('livechat.html','Live Chat','resizable,height=480,width=320'); return false;">Chat with an agent online</a><noscript>You need Javascript to use the previous link or use <a href="yourpage.htm" target="_blank">Chat with an agent online</a></noscript>
                    <?php endif; ?>
                    -->
                </div>
            </div>
            <!-- right -->
            <div class="right intro-pic">
                <img src="_load/images/intro.jpg" width="90%" height="auto" alt="Health Plan"/>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>
<script type="text/javascript">
$(".step-1").addClass("active");
$(".step-2").addClass("pending");
$(".step-3").addClass("pending");

</script>