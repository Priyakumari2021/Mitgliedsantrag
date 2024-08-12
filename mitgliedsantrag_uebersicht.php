<?php
    include "includes/header.php";
    include "function/makePDF.php";
    ob_start();
    session_start();

    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }
    echo '<pre>';
    //var_dump($_SESSION['PAGE2']);
    echo '</pre>';
    $antrag_page1 = $_SESSION['PAGE1'];
    $antrag_page2 = $_SESSION['PAGE2'];
    $antrag_page3 = $_SESSION['PAGE3'];
    $antrag_page4 = $_SESSION['PAGE4'];
    $antrag_page5 = $_SESSION['PAGE5'];
    $antrag_page6 = $_SESSION['PAGE6'];
    $taetigkeit= "";
    $anhang = 1;
    echo '<pre>';
    //var_dump($antrag_page1);
    // var_dump($antrag_page2);
    //var_dump($antrag_page3);
    //var_dump($antrag_page4);
    //var_dump($antrag_page5);
    // var_dump($antrag_page6);
    echo '</pre>';
    $kontoDetail = $gewerbeErMaklerDatei = $gewerbeErVerwalterDatei = "";
    $anhaengerDatei = [$antrag_page1['filePath'], $antrag_page2['filePathGewerbeanmeldung'], $antrag_page2['filePathMakler'], $antrag_page2['filePathVerwalter'], $antrag_page5['filePathBetriebshaft'], $antrag_page5['filePathVermoegensschaden']];
    // Tätigkeit    
    $taetigkeit = getTatigkeit($antrag_page2);
    
    //Erlaubnis
    $gewerbeErMakler = $antrag_page2['gewerbeerlaubnisMakler'] == "1" ? 'Ja' : 'Nein';
    $gewerbeErVerwalter = $antrag_page2['gewerbeerlaubnisVerwalter'] == "1" ? 'Ja' : 'Nein';
    $handelsregister = $antrag_page2['handelsregister'] == "1" ? 'Ja' : 'Nein';
    $immoWirtschaftlich = $antrag_page2['immobilienwirtschaftlich'] == "1" ? 'Ja' : 'Nein';

    if($gewerbeErMakler == 'Ja') $gewerbeErMaklerDatei = 'Gewerbeerlaubnis nach §34 c Makler Datei: Ja<br>';
    if($gewerbeErVerwalter == 'Ja') $gewerbeErVerwalterDatei = 'Gewerbeerlaubnis nach §34 c Verwalter Datei: Ja<br>';

    $bundesland = setCorrectChar($antrag_page1['bundesland']);
    $emailIdNachBundesland = getEmailId(strtolower($bundesland));
    $bundesland = getCityName($antrag_page1['bundesland']);

    if($emailIdNachBundesland['verband'] == 'IVD Nord') {
        $anhaengerDatei = [$antrag_page1['filePath'], $antrag_page2['filePathGewerbeanmeldung'], $antrag_page2['filePathMakler'], $antrag_page2['filePathVerwalter'], $antrag_page3['ref_1_filepath'], $antrag_page3['ref_2_filepath'], $antrag_page3['foto_filepath'], $antrag_page5['filePathBetriebshaft'], $antrag_page5['filePathVermoegensschaden']];
    }

    $fachkunde = getFachkunde($antrag_page1['fachkunde']);
    //$mitgliedschaft_typ = getMitgliedschaftType($antrag_page3['mitgliedschaft-typ']);
    $mitgliedschaft_art = getMitgliedschaftArt($antrag_page3['mitgliedschaft-art']);

    $betriebshaft = $antrag_page5['betriebshaft'] == '1' ? 'Ja' : 'Nein';
    $kontoDetail = ($antrag_page6['zahlunsart'] == 'sepa') ? '<br>
                    Kontoinhaber: '.$antrag_page6['kontoinhaber'].'<br>
                    Kreditinstitut: '.$antrag_page6['kreditinstitut'].'<br>
                    IBAN: '.$antrag_page6['iban'] : "";
    //echo $bundesland;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit-view'])) {

            logFileInfo($emailIdNachBundesland['verband'], $emailIdNachBundesland['email-Id'], $antrag_page1['p-email']);

            $userInfo = makePDF($antrag_page1, $antrag_page2, $antrag_page3, $antrag_page4, $antrag_page5, $antrag_page6);

            $subjekt = 'Neue Registrierung zur IVD-Mitgliedschaft über den digitalen Aufnahmeantrag';
            $message = 'Sehr geehrte Damen und Herren,<br><br>ein Interessent hat sich über den digitalen Aufnahmeantrag registriert und wurde Ihrem Regionalverband zugeordnet. Anbei erhalten Sie die hinterlegten Dokumente und Informationen. Bitte setzen Sie sich mit dem Interessenten in Verbindung.<br><br>Mit freundlichen Grüßen<br><br> Ihr immobilie1 Team<br><hr><br>' . $userInfo['htmlInfo'];
     
            $altMessage = 'Sehr geehrte Damen und Herren,\n\nein Interessent hat sich über den digitalen Aufnahmeantrag registriert und wurde Ihrem Regionalverband zugeordnet. Anbei erhalten Sie die hinterlegten Dokumente und Informationen. Bitte setzen Sie sich mit dem Interessenten in Verbindung.\n\nMit freundlichen Grüßen\n\n Ihr immobilie1 Team\n\n' . $userInfo['plainTextInfo'];

            $res = sendMail($emailIdNachBundesland['verband'], $emailIdNachBundesland['email-Id'], $subjekt, $message, $altMessage, $anhang, $anhaengerDatei, 'immobilie1 AG');

            //$res = sendMail($emailIdNachBundesland['verband'], 'kumari@immobilie1.de', $subjekt, $message, $altMessage, $anhang, $anhaengerDatei, 'immobilie1 AG');

            /*-----------------------E-Mail an Anfragenden---------------------------*/

            $subjekt = 'Ihr digitaler Mitgliedsantrag ist eingegangen';
            $message = 'Sehr geehrte Damen und Herren, <br><br>wir freuen uns über Ihr Interesse am IVD. In Kürze wird sich ein Mitarbeiter des für Sie zuständigen Regionalverbands mit Ihnen in Verbindung setzen.<br><br>Der für Sie zuständige IVD Regionalverband ist der <b>' . $emailIdNachBundesland['verband']. '.</b><br><br>E-Mail: '.$emailIdNachBundesland['email-Id'].'<br>Telefon: ' . $emailIdNachBundesland['telefon'] . '<br><br>Mit freundlichen Grüßen<br><br>Ihr IVD-Team<br><hr><br>' . $userInfo['htmlInfo'];

            $altMessage1 = 'Sehr geehrte Damen und Herren, \n\nwir freuen uns über Ihr Interesse am IVD. In Kürze wird sich ein Mitarbeiter des für Sie zuständigen Regionalverbands mit Ihnen in Verbindung setzen. Der für Sie zuständige IVD Regionalverband ist der '. $emailIdNachBundesland['verband'] . '.\n\nE-Mail: '.$emailIdNachBundesland['email-Id'].'\nTelefon: ' . $emailIdNachBundesland['telefon'].'\n\n Mit freundlichen Grüßen \n\n Ihr IVD-Team' . $userInfo['plainTextInfo'];

            $res1 = sendMail($emailIdNachBundesland['verband'], $antrag_page1['p-email'], $subjekt, $message, $altMessage, $anhang, $anhaengerDatei, 'Vielen Dank für Ihr Interesse am ' . $emailIdNachBundesland['verband'], $emailIdNachBundesland['email-Id']);

            if($res == 1 && $res1 == 1) {
                file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', "Mail sent successfully.." . PHP_EOL , FILE_APPEND);
                unset($_SESSION['PAGE1']);
                unset($_SESSION['PAGE2']);
                unset($_SESSION['PAGE3']);
                unset($_SESSION['PAGE4']);
                unset($_SESSION['PAGE5']);
                session_destroy();
                header("Location:  mitgliedsantrag_schluss.php");
                exit;
            } else {
                $checksendmail = '<p class="body-text-1"><div class="alert alert-danger">Beim Absenden Ihrer Anfrage ist leider ein Fehler aufgetreten. Bitte wenden Sie sich direkt an <a href="mailto:info@ivd.net">info[at]ivd.net</a></div></p>';
                file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $checksendmail . PHP_EOL , FILE_APPEND);
            }
            
        }
    }

    function logFileInfo($verband, $verband_emailid, $kunden_emailid) {
        $info = "   Übersicht =>  Verband: "  . $verband . 
                " | Verband E-mailid: " . $verband_emailid .
                " | Antragsteller E-Mailid: " . $kunden_emailid;
        file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);                 
    }

?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD </p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 color-3 l-height-26">Fast geschafft!</p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="uebersicht col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 26%;bottom: 28%;"><img src="img/icons8-seitenübersicht-4-32.png" alt=""></span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3 md:align-c">Übersicht</p>
                <b>Fast geschafft – Bitte Angabe überprüfen und Antrag senden</b><br>
                <span>Bitte überprüfen Sie Ihre Angaben auf Richtigkeit und senden Sie Ihren Antrag über den Button unten ab.</span>
            </div>
        </div>

        <p class="heading-4 mt-5 mb-4">Persönliche Daten</p>
        <div class="antrag-uebersicht">
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Vorname:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-firstname'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Nachname:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-lastname'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Geburtsdatum:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-birthdate'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">E-Mail:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-email'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Telefon:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-telefon'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Fachkunde:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label wrap"><?php echo $fachkunde ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Fachkunde Datei:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page1['fileName'] !== "") ? 'Ja' : 'Nein'  ?></label>
                </div>
            </div>
            <p class="heading-4 mt-5 mb-4">Firmendaten</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Firmenname:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['firmaname'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Straße & Haus-Nr.:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['f-strasse'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">PLZ:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['f-plz'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Ort:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['f-ort'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">E-Mail:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['f-email'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Telefon:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['f-telefon'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Website:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page1['f-website']) ? $antrag_page1['f-website'] : '--' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Bundesland:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $bundesland ?></label>
                </div>
            </div>

            <!-- Privataddresse -->
            <?php if($emailIdNachBundesland['verband'] == 'IVD Nord') { ?>
            <p class="heading-4 mt-5 mb-4">Privatadresse Daten</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Straße & Haus-Nr.:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-strasse'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">PLZ:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-plz'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Ort:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page1['p-ort'] ?></label>
                </div>
            </div>
            <?php } ?>
            
            <!-- Page 2 -->
            <p class="heading-4 mt-5 mb-4">Ergänzende Daten</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label ">Jahr der Gründung:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page2['gruendung-jahr'] ?></label>
                </div>
            </div>

            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Anzahl der Mitarbeiter:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page2['mitarbeiter-anzahl']) ? $antrag_page2['mitarbeiter-anzahl'] : '--' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Anzahl weiterer Filialen:</label>
                <div class="col-6 col-md-8 col-lg-8" style="position:relative;">
                    <label class="col-form-label"><?php echo ($antrag_page2['filiale-anzahl']) ? $antrag_page2['filiale-anzahl'] : '--' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Gewerbeanmeldung:</label>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo $antrag_page2['gewerbeanmeldung-datum'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Gewerbeanmeldung Datei:</label>
                <div class="col-12 col-md-8 col-lg-6">
                    <label class="col-form-label"><?php echo ($antrag_page2['fileNameGewerbeanmeldung'] == "") ? 'Nein' : 'Ja' ?></label>
                </div>
            </div>
            <p class="heading-4 mt-5 mb-4">Geschäfts-Informationen</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label wrap">Gewerbeerlaubnis nach §34 c Makler:</label>
                <div class="col-6 col-md-8 col-lg-8" style="position:relative;">
                    <label class="col-form-label"><?php echo $gewerbeErMakler ?></label>
                    <!-- <label class="col-form-label"><?php //echo $makler34c ?> ?> </label> -->
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label wrap">Gewerbeerlaubnis nach §34 c Makler Datei:</label>
                <div class="col-6 col-md-8 col-lg-8" style="position:relative;">
                    <label class="col-form-label"><?php echo ($antrag_page2['fileNameMakler'] == "") ? 'Nein' : 'Ja' ?></label>
                    <!-- <label class="col-form-label"><?php //echo $makler34c ?> ?> </label> -->
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label wrap">Gewerbeerlaubnis nach §34 c Verwalter:</label>
                <div class="col-6 col-md-8 col-lg-6">
                    <label class="col-form-label"><?php echo $gewerbeErVerwalter ?></label>
                    <!-- <label class="col-form-label"><?php //echo $verwalter34c ?> ?></label> -->
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label wrap">Gewerbeerlaubnis nach §34 c Verwalter Datei:</label>
                <div class="col-6 col-md-8 col-lg-6">
                    <label class="col-form-label"><?php echo ($antrag_page2['fileNameVerwalter'] == "") ? 'Nein' : 'Ja' ?></label>
                    <!-- <label class="col-form-label"><?php //echo $verwalter34c ?> ?></label> -->
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Eintrag ins Handelsregister:</label>
                <div class="col-6 col-md-8 col-lg-6">
                    <label class="col-form-label"><?php echo $handelsregister ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-labe">Bilden Sie immobilienwirtschaftlich aus?</label>
                <div class="col-6 col-md-8 col-lg-6">
                    <label class="col-form-label"><?php echo $immoWirtschaftlich ?></label>
                </div>
            </div>
            <p class="heading-4 mt-5 mb-4">Angaben der Schwerpunkte des Unternehmens </p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-8 col-lg-4 col-form-label">Ausgeübte Tätigkeitsfelder:</label>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo $taetigkeit ?></label>
                </div>
            </div>

            <!-- Page 3 -->

            <p class="heading-4 mt-5 mb-4">Details zur Mitgliedschaft</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Regionalverband:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $emailIdNachBundesland['verband'] ?></label>
                </div>
            </div>
            <!-- <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Typ der Mitgliedschaft:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label wrap"><?php echo $mitgliedschaft_typ ?></label>
                </div>
            </div> -->
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Art der Mitgliedschaft:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label wrap"><?php echo $mitgliedschaft_art ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Aufnahmegebühr:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label wrap"><?php echo $antrag_page3['aufnahme-gebuehr'] ?> €</label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Jahresgebühr:</label>
                <div class="col-12 col-md-8 col-lg-8">
                    <label class="col-form-label wrap"><?php echo $antrag_page3['jahres-gebuehr'] ?> €</label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Beginn der Mitgliedschaft:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo $antrag_page3['mitgliedschaft-beginn'] ?></label>
                </div>
            </div>
            <?php if($emailIdNachBundesland['verband'] == 'IVD Nord') { ?>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Referenz 1:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page3['ref_1_filename'] !== "") ? 'Ja' : 'Nein' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Referenz 2:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page3['ref_2_filename'] !== "") ? 'Ja' : 'Nein' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Foto des Antragsteller:</label>
                <div class="col-6 col-md-8 col-lg-8">
                    <label class="col-form-label"><?php echo ($antrag_page3['foto_filename'] !== "") ? 'Ja' : 'Nein' ?></label>
                </div>
            </div>
            <?php } ?>
            <!-- Page 4 -->
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Erklärung:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label">&#x2713;</label>
                </div>
            </div>
            <!-- Page 5 -->
            <p class="heading-4 mt-5">Regularien, Datenschutz, Versicherungen</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Kenntnissnahme Dokumente:</label>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label">&#x2713;</label>
                </div>
            </div>
            
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Betriebshaftpflicht:</label>
                <div class="col-12 col-md-6 col-lg-6">
                    <?php 
                     if( $betriebshaft == 'Ja') {
                        echo "<label class='col-form-label'>&#x2713;</label>";
                     } else {
                        echo "<label class='col-form-label'>&#x2715;</label>";
                     }
                    ?>
                    
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label">Betriebshaftpflicht Datei:</label>
                <div class="col-12 col-md-6 col-lg-6">
                <label class='col-form-label'><?php echo ($antrag_page5['fileNameBetriebshaft'] !== "") ? 'Ja': 'Nein' ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label wrap">Vermögensschadenhaftpflicht:</label>
                <div class="col-12 col-md-6 col-lg-6">
                <?php 
                    if($antrag_page5['vermoegensschadenhaft'] == '1') {                    
                        echo "<label class='col-form-label'>&#x2713;</label>";
                    } else {
                        echo "<label class='col-form-label'>&#x2715;</label>";
                    }
                ?>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label wrap">Vermögensschadenhaftpflicht Datei</label>
                <div class="col-12 col-md-6 col-lg-6">
                <?php 
                    if($antrag_page5['fileNameVermoegensschaden'] !== "") {                    
                        echo "<label class='col-form-label'>Ja</label>";
                    } else {
                        echo "<label class='col-form-label'>Nein</label>";
                    }
                ?>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-12 col-md-4 col-lg-4 col-form-label wrap">Einwilligung</label>
                <div class="col-12 col-md-6 col-lg-6">
                    <label class="col-form-label">&#x2713;</label>
                </div>
            </div>

            
            <!-- Page 6 -->
            <p class="heading-4 mt-5">Beitrag</p>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-label">Zahlungsart:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo ucfirst($antrag_page6['zahlunsart']) ?></label>
                </div>
            </div>
            <?php if( $antrag_page6['zahlunsart'] == "sepa" ) { ?>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-labe">Kontoinhaber:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo $antrag_page6['kontoinhaber'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-labe">Kreditinstitut:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo $antrag_page6['kreditinstitut'] ?></label>
                </div>
            </div>
            <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-labe">IBAN:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label"><?php echo $antrag_page6['iban'] ?></label>
                </div>
            </div>
            <?php } ?>
            <!-- <div class="form-group row mb-4 heading-1">
                <label class="col-6 col-md-4 col-lg-4 col-form-labe">zahlungRegeln:</label>
                <div class="col-6 col-md-6 col-lg-6">
                    <label class="col-form-label">&#x2713;</label>
                </div>
            </div> -->

            <form action="" method="post" name="form-view" id="form-view">
                <div class="d-flex lg:justify-between md:justify-center md:flex-direction mb-5 mt-5">
                    <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page6.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem;text-align:center;">Schritt zurück</a>
                    <button type="submit" class="btn-2" name="submit-view" id="submit-view">Antrag absenden</button>
                </div>
            </form>
        </div>
    </div>
</section>

    <?php
        include "includes/footer.php";
    ?>