<!-- 
Berlin                      IVD Berlin Brandenburg                  info@ivd.berlin
Brandenburg                 IVD Berlin Brandenburg                  info@ivd.berlin
Hessen                      IVD Mitte                               info@ivd.mitte.de
Thüringen                   IVD Mitte                               info@ivd.mitte.de
Bremen                      IVD Nord                                info@ivd-nord.de
Hamburg                     IVD Nord                                info@ivd-nord.de
Mecklenburg-Vorpommern      IVD Nord                                info@ivd-nord.de
Niedersachsen               IVD Nord                                info@ivd-nord.de
Schleswig-Holstein          IVD Nord                                info@ivd-nord.de
Nordrhein Westfalen         IVD West                                info@ivd-west.net                                
Rheinland-Pfalz             IVD West                                info@ivd-west.net
Saarland                    IVD West                                info@ivd-west.net
Sachsen                     IVD-Mitte Ost                           info@ivd-mitte-ost.net
Sachsen-Anhalt              IVD-Mitte Ost                           info@ivd-mitte-ost.net
Bayern                      IVD-Süd BA                              info@ivd-sued.net
Baden Württemberg           IVD-Süd BW                              info@ivd-sued-bw.net 
-->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
//$mail = new PHPMailer(true);

// Function for clean the text
    function cleanString($value) {
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, "UTF-8", false );
        // trim() entfernt am Anfang und am Ende eines Strings alle 
		// sog. Whitespaces (Leerzeichen, Tabulatoren, Zeilenumbrüche)
        $value = trim($value);
        if( $value === "" ) {
            $value = NULL;
        } else {
            $value = str_replace("ä","ae",$value); 
            $value = str_replace("ö","oe",$value); 
            $value = str_replace("ü","ue",$value);
            $value = str_replace("ß","ss",$value);
            
        }
        
        return $value;
    }
// Function for returning email-id
    function getEmailId($stateName){
        $emailId = "";
        if( $stateName == 'berlin' || $stateName == 'brandenburg' ){
            $emailId = 'info@ivd.berlin';
            $verband = 'IVD Berlin-Brandenburg';
            $telefon = '030 / 89735364';
            $pdfLink = 'Satzung_Berlin-Brandenburg-PDF.pdf';
            $beitragsordnung = "2014-05-06_Beitragsordnung-des-IVD-Berlin-Brandenburg-e-V-681334.pdf";
            $aufnahmeordnung = "2014-05-06_Aufnahmeordnung-des-IVD-Berlin-Brandenburg-e-V-681333.pdf";
        }elseif( $stateName == 'hessen' || $stateName == 'thueringen' ) {
            $emailId = 'info@ivd-mitte.de';
            $verband = 'IVD Mitte';           
            $telefon = '069 / 28 28 23';
            $pdfLink = 'Satzung_Mitte-PDF.pdf';
            $beitragsordnung = "Beitragsordnung-IVD-Mitte.pdf";
            $aufnahmeordnung = "Aufnahmeordnung-IVD-Mitte.pdf";
        }elseif( $stateName == 'bremen' || $stateName == 'hamburg' || $stateName == 'mecklenburg-vorpommern' || $stateName == 'niedersachsen' || $stateName == 'schleswig-holstein'){
            $emailId = 'info@ivd-nord.de';
            $verband = 'IVD Nord';
            $telefon = '040 / 3575990';
            $pdfLink = 'Satzung_Nord_2014.pdf';
            $beitragsordnung = "2023-04-13_BEITRAGSORDNUNG-IVD-Nord-e.V.-13.04.2023.pdf";
            $aufnahmeordnung = "2017-ff_Aufnahmeordnung_Nord_Stand_Maerz_2014.pdf";
        }elseif( $stateName == 'nordrhein-westfalen' || $stateName == 'rheinland-pfalz' || $stateName == 'saarland' ) {
            $emailId = 'info@ivd-west.net';
            $verband = 'IVD West';
            $telefon = '0221 / 9514970';
            $pdfLink = 'aktuelle-Satzung-IVD-West-26.10.21.pdf';
            $beitragsordnung = "aktuelle-Beitragsordnung-IVD-West-01.01.2023.pdf";
            $aufnahmeordnung = "aktuelle-Aufnahmeordnung-IVD-West-08.12.20.pdf";
        }elseif( $stateName == 'sachsen' || $stateName == 'sachsen-anhalt' ) {
            $emailId = 'info@ivd-mitte-ost.net';
            $verband = 'IVD Mitte Ost';
            $telefon = '0341 / 60194954';
            $pdfLink = 'Satzung_Mitte-Ost-PDF.pdf';
            $beitragsordnung = "Beitragsordnung-IVD-Mitte.pdf";
            $aufnahmeordnung = "Aufnahmeordnung-IVD-Mitte.pdf";
        }elseif( $stateName == 'bayern' ) {
            $emailId = 'info@ivd-sued.net';
            $verband = 'IVD Süd';
            $telefon = '089 / 290820 0';
            $pdfLink = 'IVD-Sued-Regularien-2022.pdf';
            $beitragsordnung = "Beitragsordnung-IVD-Sued-e.V.-2022.pdf";
            $aufnahmeordnung = "Aufnahmeordnung-IVD-Sued-e.V.-2022.pdf";
        }elseif( $stateName == 'baden-wuerttemberg' ) {
            $emailId = 'info@ivd-sued-bw.net';
            $verband = 'IVD Süd BW';
            $telefon = '0711 / 814738 0';
            $pdfLink = 'IVD-Sued-Regularien-2022.pdf';
            $beitragsordnung = "Beitragsordnung-IVD-Sued-e.V.-2022.pdf";
            $aufnahmeordnung = "Aufnahmeordnung-IVD-Sued-e.V.-2022.pdf";
        }
        return array('email-Id' => $emailId, 'verband' => $verband, 'telefon' => $telefon, 'pdf_link' => $pdfLink, 'beitragsordnung' => $beitragsordnung, 'aufnahmeordnung' => $aufnahmeordnung);
    }

// Sending mail function
    function sendMail($verband, $emailId, $sub, $msg, $altMsg, $anhang, $anhaengerDatei,  $betreff, $email_verband = 'info@immobilie1.de') {
            $fileName = [];
            if(!empty($anhaengerDatei)) {
                $i=0;
                foreach($anhaengerDatei as $path) {
                    $pos = strrpos($path, '/');
                    $fileName[$i] = $pos === false ? $path : substr($path, $pos + 1);
                    $i = $i+1;
                }
            }
        try {
            $mail = new PHPMailer(true);

            // Versuch, eine neue Instanz der Klasse PHPMailer zu erstellen
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth   = true; 

            // Persönliche Angaben                        
            $mail->Host       = 'smtp-relay.sendinblue.com';
            $mail->Username   = 'info@immobilie1.de'; 
            $mail->Password   = 'xsmtpsib-23ad9ec015a540223a5805aac28012cc84369e7288a91499bf957c02ce127f37-D6sKaZcFqfd4CxGB';            
            $mail->Port       = "587";            
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            //$mail->SMTPSecure = 'tls';
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            
        
            /*--------------------------- E-Mail an Regionalverband----------------------------*/  
            //Recipients
            //$mail->ClearAllRecipients();
            $mail->setFrom($email_verband, $betreff);

            //Epfänger = E-Mailadresse des jeweiligen Regionalverbandes
            $mail->addAddress($emailId);     //Add a recipient
            //$mail->addAddress('kumari@immobilie1.de');
            //$mail->addCC('kumari@ivd24.de');
            $mail->addBCC('kumari@immobilie1.de');
        
            //Content
            $mail->isHTML(true);     
            $mail->Subject = $sub;
            $mail->Body    = $msg;
            $mail->AltBody = $altMsg;

            // Anhang hinzufügen
            //$mail->addAttachment("/var/www/html/img/ebayk/logo_immobilie1_ebayk.jpg", "immobilie1.jpg");
            if($anhang == 1){
                if($anhaengerDatei[0] != "") $mail->addAttachment("$anhaengerDatei[0]", $fileName[0]);
                if($anhaengerDatei[1] != "") $mail->addAttachment("$anhaengerDatei[1]", $fileName[1]);
                if($anhaengerDatei[2] != "") $mail->addAttachment("$anhaengerDatei[2]", $fileName[2]);
                if($anhaengerDatei[3] != "") $mail->addAttachment("$anhaengerDatei[3]", $fileName[3]);
                if($anhaengerDatei[4] != "") $mail->addAttachment("$anhaengerDatei[4]", $fileName[4]);
                if($anhaengerDatei[5] != "") $mail->addAttachment("$anhaengerDatei[5]", $fileName[5]);
                if($verband == 'IVD Nord') {
                    if($anhaengerDatei[6] != "") $mail->addAttachment("$anhaengerDatei[6]", $fileName[6]);
                    if($anhaengerDatei[7] != "") $mail->addAttachment("$anhaengerDatei[7]", $fileName[7]);
                    if($anhaengerDatei[8] != "") $mail->addAttachment("$anhaengerDatei[8]", $fileName[8]);
                }
                
            } 
            //date_default_timezone_set('DST');        
            $info = "   -----------------" .PHP_EOL." 1. E-Mail sent from: " . $email_verband . PHP_EOL. "2. Betreff: " . $betreff . PHP_EOL . "3. E-Mail sent to: " . $emailId . PHP_EOL . "4. Verband: " . $verband . PHP_EOL. "5. Subjekt: " . $sub . PHP_EOL;

            file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info , FILE_APPEND);

            if($mail->send()) {
                $res = 1;
                file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', "6. Response: " . $res . PHP_EOL . "-------------------------------" . PHP_EOL , FILE_APPEND);
                //echo 'Message has been sent';
            }
            //echo 'Message has been sent';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
            $res = $mail->ErrorInfo;
            file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', "6. Response: " . $res . PHP_EOL , FILE_APPEND);
        }
        return $res;
    }


// attachment




// Function for upload File
function fileUpload( $uploadedFile, $docName ) {
    $errorMessage = $erfolgMessage = "";

    // Dateigröße
    $fileSize = $uploadedFile['size'];
    // temporärer Pfad auf dem Server
    $fileTemp = $uploadedFile['tmp_name'];
    // Type
    $fileType = $uploadedFile['type'];

    // Dateiname
    $fileName = cleanString( $uploadedFile['name'] );

    // ggf. vorhandene Leerzeichen durch _ ersetzen
    $fileName = str_replace(" ", "-", $fileName);
					
    // Dateinamen in Kleinbuchstaben umwandeln
    $fileName = mb_strtolower($fileName);
    // Umlaute ersetzen
    $fileName = str_replace( array("ä","ö","ü","ß"), array("ae","oe","ue","ss"), $fileName );

    $startPosFileExt = strrpos($fileName, ".");
    $fileExt = substr($fileName, $startPosFileExt);
    $fileNamePrefix = str_replace($fileExt, "", $fileName);
    $fileNamePrefix = preg_replace('/[^a-z0-9_-]/', "", $fileNamePrefix);
    $fileName = $fileNamePrefix . $fileExt;

    $randomPrefix = $docName . '_' . round(microtime(true)) .  '_';
    $fileTarget = "/var/www/html/ivdreg/upload/" . $randomPrefix . $fileName;

    $extensions= array("application/pdf","application/msword","image/jpeg","image/jpg","image/png");

    if(in_array($fileType, $extensions)=== false){
        $errorMessage ="Dies ist kein erlaubter Filetyp!, Bitte wählen Sie ein PDF oder JPEG oderr JPG oder PNG file.";
    }
    elseif($fileSize > 5242880) {
        $errorMessage ='Die Datei ist größe darf maximal 5 kB betragen!';
    }
    else {
        $errorMessage = NULL;
    }

    #********** FINAL File VALIDATION **********#
    if( $errorMessage ) {
        $fileTarget = NULL;
    } 
    else {
        if( !@move_uploaded_file($fileTemp, $fileTarget) ) {
            // Fehlerfall
            $errorMessage = "Beim Speichern des Bildes auf den Server ist ein Fehler aufgetreten!<br>Bitte versuchen Sie es später noch einmal.";
            $fileTarget = NULL;
            
        } else {
            // Erfolgsfall
            $erfolgMessage = "Datei hat erfolgreich geladen..";
            
        } 
    }

    return array('fileType' => $fileType, 'fileSize' => $fileSize, 'fileTemp' => $fileTemp, 'filePath' => $fileTarget, 'FileError' => $errorMessage, 'fileSuccess' => $erfolgMessage, 'fileName' => $fileName);

}


function getDataPage1() {
    $dataPage1 = [
        'p-firstname'               => "",
        'p-lastname'                => "",
        'p-birthdate'               => "",
        'p-email'                   => "",
        'p-telefon'                 => "",
        'fachkunde'                 => "",
        //'nachweis'                  => "0",

        'fachkunde-fileName'        => "",
        'uploadOk'                  => "",
        'filePath'                  => "",
        'fileName'                  => "",

        'firmaname'                 => "",
        'f-strasse'                 => "",
        'f-plz'                     => "",
        'f-ort'                     => "",
        'f-email'                   => "",
        'f-telefon'                 => "",
        'f-website'                 => "",        
        'bundesland'                => "",

        'p-strasse'                 => "",
        'p-plz'                     => "",
        'p-ort'                     => ""

    ];
    
    if(isset($_SESSION['PAGE1'])) {
        foreach ($_SESSION['PAGE1'] as $key => $value) {
            if ($key == 'submit-page2') continue;
            $dataPage1["$key"] = $value;
        }
    }
    return $dataPage1;
}

function getDataPage2() {
    $dataPage2 = [
        'gruendung-jahr'                    => "",
        'mitarbeiter-anzahl'                => "",
        'filiale-anzahl'                    => "",
        'gewerbeanmeldung-datum'            => "",
        'gewerbeanmeldung-fileName'         => "",        
        'uploadOkGewerbeanmeldung'          => "",
        'filePathGewerbeanmeldung'          => "",
        'fileNameGewerbeanmeldung'          => "",

        'gewerbeerlaubnisMakler'            => "1",
        'upload-34c-makler'                 => "",
        'uploadOkMakler'                    => "",
        'filePathMakler'                    => "",
        'fileNameMakler'                    => "",

        'gewerbeerlaubnisVerwalter'         => "1",
        'upload-34c-verwalter'              => "",
        'uploadOkVerwalter'                 => "",
        'filePathVerwalter'                 => "",
        'fileNameVerwalter'                 => "",

        'handelsregister'                   => "1",
        'immobilienwirtschaftlich'          => "1",

        'makler'                            => "",
        'verwalter'                         => "",
        'sachverstaendig'                   => "",
        'bautraeger'                        => "",
        'projektentwicklung'                => "",
        'sonstige'                          => "",
        'sonstige_taetigkeit'               => ""
    ];

    if(isset($_SESSION['PAGE2'])) {
        foreach ($_SESSION['PAGE2'] as $key => $value) {
            if ($key == 'submit-page2') continue;
            $dataPage2["$key"] = $value;
        }
    }
    return $dataPage2;
}

function getDataPage3() {
    $dataPage3 = [
        
        'mitgliedschaft-typ'                => "persoenlich",
        'mitgliedschaft-art'                => "ordentlich-mitglied",
        'aufnahme-gebuehr'                  => "810,00",
        'jahres-gebuehr'                    => "500,00",
        'mitgliedschaft-beginn'             => "",

        'ref_1'                         => "",
        'ref_1_ok'                          => "",
        'ref_1_filepath'                    => "",
        'ref_1_filename'                    => "",

        'ref_2'                         => "",
        'ref_2_ok'                          => "",
        'ref_2_filepath'                    => "",
        'ref_2_filename'                    => "",

        'antragsteller-foto'                => "",
        'foto_ok'                           => "",
        'foto_filepath'                     => "",
        'foto_filename'                     => "",
        
    ];

    if(isset($_SESSION['PAGE3'])) {
        foreach ($_SESSION['PAGE3'] as $key => $value) {
            if ($key == 'submit-page3') continue;
            $dataPage3["$key"] = $value;
        }
    }
    return $dataPage3;
}

function getDataPage4() {
    $dataPage4 = [
        'chk-all'                  => "",
        'erklaerung-1'             => "",
        'erklaerung-2'             => "",
        'erklaerung-3'             => "",
        'erklaerung-4'             => "",
        'erklaerung-5'             => "",
        'erklaerung-6'             => "",
        'erklaerung-7'             => "",
        'erklaerung-8'             => "",
        'erklaerung-9'             => "",
        'erklaerung-10'            => ""
    ];

    if(isset($_SESSION['PAGE4'])) {
        foreach ($_SESSION['PAGE4'] as $key => $value) {
            if ($key == 'submit-page4') continue;
            $dataPage4["$key"] = $value;
        }
    }
    return $dataPage4;
}

function getDataPage5() {
    $dataPage5 = [
        'einwilligung'               => "",
        'bundesverbands'             => "",
        'regionalverbands'           => "",
        'standesregeln'              => "",
        'geschaeftsgebraeuche'       => "",
        'wettbewerbsregeln'          => "",
        'aufnahmeordnung'            => "",
        'beitragsordnung'            => "",
        'datenschutzerklaerung'      => "",

        'betriebshaft'               => "",
        'betriebshaft-file'           => "",

        'uploadOkBetriebshaft'       =>  "",
        'filePathBetriebshaft'      =>  "",
        'fileNameBetriebshaft'       =>  "",

        'vermoegensschadenhaft'      => "",
        'vermoegensschadenhaft-file'  => "",

        'uploadOkVermoegensschaden'  =>  "",
        'filePathVermoegensschaden'  =>  "",
        'fileNameVermoegensschaden'  =>  ""
    ];

    if(isset($_SESSION['PAGE5'])) {
        foreach ($_SESSION['PAGE5'] as $key => $value) {
            if ($key == 'submit-page5') continue;
            $dataPage5["$key"] = $value;
        }
    }
    return $dataPage5;
}

function getDataPage6() {
    $dataPage6 = [
        'zahlunsart'             => "sepa",
        'kontoinhaber'           => "",
        'kreditinstitut'         => "",
        'iban'                   => "",
        'chkIban'                => "",
        'zahlungRegeln'          => ""
    ];

    if(isset($_SESSION['PAGE6'])) {
        foreach ($_SESSION['PAGE6'] as $key => $value) {
            if ($key == 'submit-page6') continue;
            $dataPage6["$key"] = $value;
        }
    }
    return $dataPage6;
}

// Get Mitgliedschaft Type
// function getMitgliedschaftType($type) {
//     if($type == 'persoenlich') {
//         $val = "Persönliche Mitgliedschaft";
//     } elseif($type == "firmen") {
//         $val = "Firmenmitgliedschaft";
//     }

//     return $val;
// }

function getMitgliedschaftArt($art) {
    switch($art) {
        case 'ordentlich-mitglied':
            $val = 'Ordentliches Mitglied';
            break;
        case 'erstes-Jahr':
            $val = 'Existenzgründer Mitgliedschaft erstes Jahr';
            break;
        case 'zweites-Jahr':
            $val = 'Existenzgründer Mitgliedschaft zweites Jahr';
            break;
        case 'Juniorenmitgliedschaft':
            $val = 'Juniorenmitgliedschaft';
            break;
        case 'Angestelltenmitgliedschaft':
            $val = 'Angestelltenmitgliedschaft';
            break;
        case 'Zweitmitgliedschaft':
            $val = 'Zweitmitgliedschaft';
            break;
        default;
            $val = 'Ordentliches Mitglied';
    }

    return $val;
}

function getFachkunde($fachkunde) {
    switch($fachkunde) {
        case "1":
            $val = 'Kaufmann/-frau der Grundstücks- und Wohnungswirtschaft';
            break;
        case "2":
            $val = 'Immobilienkaufmann-/frau';
            break;
        case "3":
            $val = 'Immobilienfachwirt/in';
            break;
        case "4":
            $val = 'IHK Zertifikat Immobilienmakler/Verwalter/Sachverständiger';
            break;
        case "5":
            $val = 'Zertifikat anderer Institute mit min. 120 Stunden Umfang';
            break;
        case "6":
            $val = 'Immobilienwirtschaftlicher Studiengang';
            break;
        case "7":
            $val = 'Anderer/gleichwertiger Abschluss';
            break;
        case "8":
            $val = 'langjährige Branchenzugehörigkeit';
            break;
        case "9":
            $val = 'Fachkunde auf andere Weise belegen';
            break;
        default:
            $val = '';
    }
    return $val;
}

function getCityName($cityname) {
    if($cityname == 'baden-wuerttemberg')
        $bundesland = 'Baden-Württemberg';
    elseif($cityname == 'thueringen') 
        $bundesland = 'Thüringen';
    else
        $bundesland = ucfirst($cityname);

    return $bundesland;
}

function getTatigkeit($antragDetail) {
    $taetigkeits = [];
    if($antragDetail['makler'] != "") { array_push($taetigkeits,'Makler');} 
    if($antragDetail['verwalter'] != "") { array_push($taetigkeits, ' ' . 'Verwalter');}
    if($antragDetail['sachverstaendig'] != "") { array_push($taetigkeits, ' ' . 'Sachverständige');} 
    if($antragDetail['bautraeger'] != "") { array_push($taetigkeits, ' ' . 'Bauträger / Baubetreuung');} 
    if($antragDetail['projektentwicklung'] != "") { array_push($taetigkeits, ' ' . 'Projektentwicklung');}
    if($antragDetail['sonstige'] != "") { array_push($taetigkeits, ' ' . $antragDetail['sonstige_taetigkeit']);}

    
    if(count($taetigkeits) == 1) $taetigkeit = implode($taetigkeits);
    else $taetigkeit = implode(', ', $taetigkeits);

    return $taetigkeit;

}


function setCorrectChar($bundesland) {
    if($bundesland == 'Thüringen') {
        $bland = 'Thueringen';
    }
    else if($bundesland == 'Baden-Württemberg') {
        $bland = 'Baden-wuerttemberg';
    }
    else {
        $bland = $bundesland;
    }
    return $bland;
}
    
    
?>

