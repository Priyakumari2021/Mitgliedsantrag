<?php 
# include the library
require_once('../../Bank/php-iban.php');
//require_once('/var/www/html/wp-content/themes/ivd24/templates/includes/Bank/php-iban.php');
if(isset($_POST['type'])){
    if($_POST['type'] == "chkIban") {
        $i_ban = $_POST['iban'];
        if (!verify_iban($i_ban)) {
            $checkIban = false;
        } else {
            $checkIban = true;
        } 
        echo ($checkIban) ? 'true' : 'false';
    }
}
?>