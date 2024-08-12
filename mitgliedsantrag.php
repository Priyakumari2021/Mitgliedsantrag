<?php
    include "includes/header.php";
    //include "function/function.php";  
     $checksendmail="";  
     $anhang = 0;
     $anhaengerDatei = [];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit']) || isset($_POST['submit-antrag'])) {
            //var_dump($_POST);
            $bundesland = $_POST['bundesland'];
            $emailIdNachBundesland = getEmailId($bundesland);
            //var_dump($emailIdNachBundesland);
            // Check if the honeypot field is empty
            if (!empty($_POST['honeypot'])) {
                // Handle the submission as spam, e.g., log or ignore it
                die("Spam detected. Submission ignored.");
            } 
            else 
            {
                
                    //echo $bundesland;
                $subject = 'Informationsmaterial zur IVD-Mitgliedschaft in Ihrem Regionalverband wurde angefordert';
                $message = 'Sehr geehrte Damen und Herren,<br><br> eine neue Anfrage bezüglich <b>zu Informationsmaterial</b> über die IVD-Mitgliedschaft in Ihrem Regionalverband wurde online angefordert. Bitte setzten Sie sich mit dem Interessenten in Verbindung und senden Sie Ihm weitere Informationen zum IVD zu.<br><br>Bitte beachten Sie, dass diese Anfrage über den Service des digitalen Mitgliedsantrag versendet wurde. Bei Rückfragen wenden Sie sich bitte an den Support der immobilie1 AG. <br><br>Mail: <a href="mailto:support@immobilie1.de">support@immobilie1.de</a><br>Telefon: 089 / 29 08 20-55<br><br><hr><br><b>Daten des Anfragenden</b><br><br>Name: '.$_POST['firstname'].' '.$_POST['lastname'].'<br>E-Mailadresse: '.$_POST['email'].'<br>Telefonnummer: '. $_POST['telefonnummer'] . '<br>Betreff: '.$_POST['betreff'].'<br>Nachricht: '.$_POST['nachricht'].'<br><br>Mit freundlichen Grüßen<br><br>Ihr immobilie1 Team';
                $altMessage = 'Sehr geehrte Damen und Herren, eine neue Anfrage bezüglich Informationsmaterial über die IVD-Mitgliedschaft in Ihrem Regionalverband wurde online angefordert. Bitte setzten Sie sich mit dem Interessenten in Verbindung und senden Sie Ihm weitere Informationen zum IVD zu. Bitte beachten Sie, dass diese Anfrage über den Service des digitalen Mitgliedsantrag versendet wurde. Bei Rückfragen wenden Sie sich bitte an den Support der immobilie1 AG. Mail:support@immobilie1.de Telefon: 089 / 29 08 20-55 Daten des AnfragendenName: '.$_POST['firstname'].' '.$_POST['lastname'].'E-Mailadresse: '.$_POST['email'] .'Telefonnummer: '. $_POST['telefonnummer'] . 'Betreff: '. $_POST['betreff'] .'Nachricht: '.$_POST['nachricht'].'Mit freundlichen Grüßen Ihr immobilie1 Team';
                // Sendmail in PHP using mail()
                $res = sendMail($emailIdNachBundesland['email-Id'], $subject, $message, $altMessage, $anhang, $anhaengerDatei, 'immobilie1 AG');

                /*-----------------------E-Mail an Anfragenden---------------------------*/

                $subject = 'Informationsmaterial des IVD ist auf dem Weg';
                $message = 'Sehr geehrte '.$_POST['anrede'].' '.$_POST['lastname'].', <br><br>wir haben Ihre Anfrage bezüglich der Zusendung von Informationsmaterial über die IVD-Mitgliedschaft erhalten. In Kürze wird sich ein Mitarbeiter des zuständigen Regionalverbandes mit Ihnen in Verbindung setzen. <br><br>Gerne können Sie auch persönlich mit der Geschäftsstelle über die folgende E-Mailadresse kommunizieren. <br><br>E-Mailadresse: '. $emailIdNachBundesland['email-Id'] .'<br><br>Mit freundlichen Grüßen <br><br>Ihr IVD-Team';
                
                $altMessage = 'Sehr geehrte '.$_POST['anrede'].' '.$_POST['lastname'].', \n\nwir haben Ihre Anfrage bezüglich der Zusendung von Informationsmaterial über die IVD-Mitgliedschaft erhalten. In Kürze wird sich ein Mitarbeiter des zuständigen Regionalverbandes mit Ihnen in Verbindung setzen. \n\nGerne können Sie auch persönlich mit der Geschäftsstelle über die folgende E-Mailadresse kommunizieren. \n\n E-Mailadresse: '. $emailIdNachBundesland['email-Id'] .'\n\n Mit freundlichen Grüßen \n\n Ihr IVD-Team';

                $res = sendMail($_POST['email'], $subject, $message, $altMessage, $anhang, $anhaengerDatei,'Vielen Dank für Ihr Interesse am ' . $emailIdNachBundesland['verband'], $emailIdNachBundesland['email-Id']);

                if($res == 1) {
                    $checksendmail = '<p class="body-text-1"><div class="alert alert-success">Vielen Dank für Ihre Anfrage. Wir haben Ihre Nachricht zum Erhalt von weiteren Informationsmaterial zum IVD an den entsprechenden Regionalverband weitergeleitet.  In Kürze wird sich ein Mitarbeiter des IVD bei Ihnen melden.</div></p>';
                }else{
                    $checksendmail = '<p class="body-text-1"><div class="alert alert-danger">Beim Absenden Ihrer Anfrage ist leider ein Fehler aufgetreten. Bitte wenden Sie sich direkt an <a href="mailto:info@ivd.net">info[at]ivd.net</a></div></p>';
                }
            }
        }
    }
?>
<section class="section-1">
    <p class="heading-1">Entdecken Sie die Vorteile unserer Gemeinschaft</p>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8 lg:p-r">
            <p class="heading-2">Interesse an einer Mitgliedschaft im IVD</p>
            <?php echo  $checksendmail; ?>
            <p class="body-text-1">Sie möchten mehr über die Vorteile und Möglichkeiten einer Mitgliedschaft im Immobilienverband Deutschland IVD erfahren? Nutzen Sie jetzt unser praktisches Onlineformular, um ganz bequem alle erforderlichen Informationsmaterialien von Ihrem regionalen Verband zu erhalten.</p>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
            <div class=" box-radient p-4">
                <h4 class="text-wh">NEU: Jetzt Mitglied werden</h4>
                <h5 class="text-wh pt-3 pb-3 l-height">Sie haben die Möglichkeit Ihre IVD-Mitgliedschaft auch ganz einfach online über unsere Website zu beantragen.</h5>
                <a href="mitgliedsantrag_page1.php"><button class="btn-1">Jetzt online beantragen</button></a>
            </div>
        </div>
    </div>
    
    
</section>
<section class="bg-main">
    <div class="section-2">
        <p class="heading-3">Informationsmaterial zur IVD-Mitgliedschaft</p>
        <p class="text-2 l-height-26">Wir senden Ihnen unverbindlich weitere Informationen zur Mitgliedschaft. Bitte füllen Sie hierfür die nachstehenden Felder aus. Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
        <p class="heading-4 mt-5 mb-4">Angaben zur Person</p>
        <div class="">
            <form action="" method="post">
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="anrede">Anrede:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <select class="form-select txt-box text-3" aria-label="Default select example" id="anrede" name="anrede" required>
                            <option value="">Anrede</option>
                            <option value="Herr">Herr</option>
                            <option value="Frau">Frau</option>
                            <option value="Divers">Divers</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="firstname">Vorname:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <input type="text" id="firstname" name="firstname" class="form-control txt-box text-3" placeholder="Max" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="lastname">Nachname:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <input type="text" id="lastname" name="lastname" class="form-control txt-box text-3" placeholder="Mustermann" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="email">E-Mail:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <input type="email" id="email" name="email" class="form-control txt-box text-3" placeholder="mustermann@mail.de" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="email">Telefonnummer:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <input type="text" id="telefonnummer" name="telefonnummer" class="form-control txt-box text-3" placeholder="+49 1234 56789" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="betreff">Betreff:</label>
                    <div class="col-12 col-md-9 col-lg-9"  style="position: relative;">
                        <input type="text" id="betreff" name="betreff" class="form-control txt-box text-3" placeholder="Ihr Anliegen, Grund, o.ä.">
                        <span class="l-nachricht betreff-pos">(optional)</span>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="nachricht">Nachricht:</label>
                    <div class="col-12 col-md-9 col-lg-9" style="position: relative;">
                        <textarea id="nachricht" name="nachricht" class="form-control txt-box text-3" rows="5" placeholder="Schreiben Sie uns eine Nachricht mit mehr Details zu Ihrem Anliegen"></textarea>
                        <span class="l-nachricht nachricht-pos">(optional)</span>
                    </div>
                </div>
                <div class="form-group row mb-3 heading-1">
                    <label class="col-12 col-md-3 col-lg-3 col-form-label" for="bundesland">Bundesland:*</label>
                    <div class="col-12 col-md-9 col-lg-9">
                        <select class="form-select txt-box text-3" aria-label="Default select example" id="bundesland" name="bundesland" required>
                            <option value="" selected>Bitte wählen Sie Ihr Bundesland</option>
                            <option value="baden-wuerttemberg">Baden-Württemberg</option>
                            <option value="bayern">Bayern</option>
                            <option value="berlin">Berlin</option>
                            <option value="brandenburg">Brandenburg</option>
                            <option value="bremen">Bremen</option>
                            <option value="hamburg">Hamburg</option>
                            <option value="hessen">Hessen</option>
                            <option value="mecklenburg-vorpommern">Mecklenburg-Vorpommern</option>
                            <option value="niedersachsen">Niedersachsen</option>
                            <option value="nordrhein-westfalen">Nordrhein-Westfalen</option>
                            <option value="rheinland-pfalz">Rheinland-Pfalz</option>
                            <option value="saarland">Saarland</option>
                            <option value="sachsen">Sachsen</option>
                            <option value="sachsen-anhalt">Sachsen-Anhalt</option>
                            <option value="schleswig-holstein">Schleswig-Holstein</option>
                            <option value="thueringen">Thüringen</option>
                        </select>
                    </div>
                </div>
                <hr>
                <p class="heading-4 pb-3">Datenschutzerklärung</p>
                <div class="form-check">
                    <input class="form-check-input" id="datenschutz" type="checkbox" name="datenschutz" value="1" required>
                    <label class="form-check-label text-2 ps-3" for="datenschutz" style="line-height: normal;">
                        Ich erkläre mich damit einverstanden, dass der Regionalverband, sowie der Bundesverband meine persönlichen Daten zum Zwecke der Mitgliederverwaltung und Erfüllung des Verbandszwecks erheben und verarbeiten. Außerdem werden die Daten für verbandsbezogene Informations- und Werbezwecke genutzt. Eine Veröffentlichung der Kontaktdaten kann in gedruckten und elektronischen Mitglieder- und Teilnahmeverzeichnissen stattfinden.
                    </label>
                </div>

                <!-- reCAPTCHA widget -->
                <!-- <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div> -->

                <!-- Honeypot field -->
                <div style="display: none;">
                    <label>Leave this field blank:</label>
                    <input type="text" name="honeypot" />
                </div>

                <div class="antrag-submit mb-5 mt-5">
                    <button type="submit" class="btn-2" name="submit-antrag">Antrag absenden</button>
                </div>
            
            </form>
        </div>
    </div>
    
</section>

<?php
    include "includes/footer.php";
?>