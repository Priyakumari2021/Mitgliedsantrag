<?php

include "includes/header.php";
    ob_start();
    session_start();
    
    $viewdata = getDataPage1();
    //var_dump($viewdata);
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit-page1'])) {
            //var_dump($_POST);
            $_SESSION['PAGE1'] = $_POST;
            $_SESSION['PAGE1']['fachkunde-fileName'] = $_POST['fileName'];
            $_SESSION['PAGE1']['uploadOk'] = $_POST['uploadOk'];
            $_SESSION['PAGE1']['filePath'] = $_POST['filePath'];
            $_SESSION['PAGE1']['fileName'] = $_POST['fileName'];

            logFileInfo($_POST);
            
            header("Location:  mitgliedsantrag_page2.php");
            exit;
        }
    }

    function logFileInfo($postData) {
        $info = "-----------------------" . date("Y-m-d H:i:s", strtotime('+1 hour')) .         "-----------------------" . PHP_EOL .
                "   Page1 =>  " . $postData['p-firstname'] . " " . $postData['p-lastname'] . " | " 
                . $postData['p-email'] . " | " . $postData['p-telefon'] . " | " . $postData['bundesland'];
                file_put_contents('./Log/log_'.date("j.n.Y", strtotime('+1 hour')) . '.txt', $info . PHP_EOL , FILE_APPEND);    ;              
    }


?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD</p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 l-height-26">Werden Sie Mitglied im Immobilienverband Deutschland IVD und erhalten Sie wertvolle Unterstützung für Ihren beruflichen Erfolg. Bei uns bekommen Sie nicht nur Handlungsempfehlungen, sondern auch fundierten Rechtsrat sowie rechtssichere Musterverträge und Vorlagen. Unsere Experten stehen Ihnen zur Seite, um Sie bei rechtlichen Fragen und Herausforderungen bestmöglich zu unterstützen. Mit Ihrer Mitgliedschaft unterstützen Sie die politische Interessenvertretung des IVD, wovon Sie letztlich auch durch verbesserte politische Rahmenbedingungen profitieren.  <br><br>

Zudem profitieren Sie von zahlreichen exklusiven Vorteilen und wertvollen Kontakten. Nutzen Sie unseren bequemen digitalen Aufnahmeantrag, um den Prozess der Mitgliedschaft schnell und unkompliziert abzuschließen.
<br><br>
Unser Team steht Ihnen dabei jederzeit zur Seite und beantwortet gerne Ihre Fragen. 

</p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="prgress-bar col-12 col-md-12 col-lg-3 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">1</span>
            </div>
            <div class="col-12 col-md-12 col-lg-9 md:ms-3 lg:ms-3">
                <p class="heading-3">Angaben zur Person und zum Unternehmen</p>
                <p class="text-2 l-height-26 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
        </div>
        <div class="mt-5" style="position: relative;">
            <p>
                <b>Was passiert mit meinen Daten? Hier geht’s zur Datenschutzerklärung</b>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="18px" id="info-datenschutz" style="cursor: pointer;">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
</svg>

            </p>
            <div class="border border-dark rounded p-2 hidden" id="info-text" style="position:absolute;top:35px;z-index:9;background-color:#ffffff">
                <p class="color-3" style="opacity:0.8;font-size: 0.8rem;font-weight:400;">Der Regionalverband verarbeitet meine personenbezogenen Daten zum Zwecke der Mitgliederverwaltung und Erfüllung des Verbandszwecks. Mit der Mitgliedschaft im Regionalverband wird auch eine Mitgliedschaft im IVD Bundesverband begründet. Daher werden meine personenbezogenen Daten auch vom Bundesverband verarbeitet. Als betroffene Person habe ich das Recht auf Auskunft, Berichtigung, Löschung und Einschränkung der Verarbeitung der Daten nach den Bestimmungen der Datenschutzgrundverordnung (DSGVO) und des Bundesdatenschutzgesetzes. Auf Wunsch erteilen mir/uns der Regionalverband sowie der Bundesverband weitere Auskünfte über den Datenschutz innerhalb des Vereins. Eine Weitergabe Ihrer Daten an Auftragsdatenverarbeiter erfolgt nur, sofern dies nötig ist (z.B. an externe Rechnungslegung). Eine Weitergabe an Kooperationspartner erfolgt nur, wenn Sie uns Ihre ausdrückliche Einwilligung dazu geben.  </p>
            </div>
        </div>
        <p class="heading-4 mb-4">Firmendaten</p>
        <div class="antrag-detail">
            <form action="" method="post" name="form-page1" id="form-page1" enctype="multipart/form-data">
                               
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="firmaname">Firmenname*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="firmaname" name="firmaname" class="form-control txt-box text-3" placeholder="Mustermann Immobilien GmbH" value="<?php echo $viewdata['firmaname'] ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-strasse">Straße & Haus-Nr.*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="f-strasse" name="f-strasse" class="form-control txt-box text-3" placeholder="Musterstraße 1A" value="<?php echo $viewdata['f-strasse'] ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-plz">PLZ*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="f-plz" name="f-plz" class="form-control txt-box text-3" placeholder="12345" value="<?php echo $viewdata['f-plz'] ?>" required>
                        <span class="text-danger small" id="alertPlz"></span>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-ort">Ort*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="f-ort" name="f-ort" class="form-control txt-box text-3" placeholder="Musterort" value="<?php echo $viewdata['f-ort'] ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-email">E-Mail*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="email" id="f-email" name="f-email" class="form-control txt-box text-3" placeholder="mustermann@mail.de" value="<?php echo $viewdata['f-email'] ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-telefon">Telefon*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="f-telefon" name="f-telefon" class="form-control txt-box text-3" placeholder="+49 1234 56789" value="<?php echo $viewdata['f-telefon'] ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="f-website">Website</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="f-website" name="f-website" class="form-control txt-box text-3 p-address" placeholder="www.website.de" value="<?php echo $viewdata['f-website'] ?>">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label  heading-1" for="bundesland">Bundesland*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="bundesland" name="bundesland" class="form-control txt-box text-3" placeholder="bundesland" value="<?php echo $viewdata['bundesland'] ?>" readonly>
                    </div>
<!-- 
                    <div class="danger-msg-page1" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                    <div class="success-msg-page1" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div> -->
                </div>
                <div id="privataddress" style="display: none;">
                    <p class="heading-4 mt-5 mb-4">Privataddresse</p>
                    <div class="form-group row mb-4 heading-1">
                        <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-strasse">Straße & Haus-Nr.*</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input type="text" id="p-strasse" name="p-strasse" class="form-control txt-box text-3 p-address" placeholder="Musterstraße 1A" value="<?php echo $viewdata['p-strasse'] ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-4 heading-1">
                        <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-plz">PLZ*</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input type="text" id="p-plz" name="p-plz" class="form-control txt-box text-3 p-address" placeholder="12345" value="<?php echo $viewdata['p-plz'] ?>">
                            <span class="text-danger small" id="alertPlz"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4 heading-1">
                        <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-ort">Ort*</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input type="text" id="p-ort" name="p-ort" class="form-control txt-box text-3 p-address" placeholder="Musterort" value="<?php echo $viewdata['p-ort'] ?>">
                        </div>
                    </div>
                </div>

                <p class="heading-4 mt-5 mb-4">Persönliche Daten</p>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-firstname">Vorname*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="p-firstname" name="p-firstname" class="form-control txt-box text-3" placeholder="Max" value="<?php echo $viewdata['p-firstname']?>" required>
                        <div id="errorName"></div>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-lastnam">Nachname*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="p-lastname" name="p-lastname" class="form-control txt-box text-3" placeholder="Mustermann" value="<?php echo $viewdata['p-lastname']?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-birthdate">Geburtsdatum*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="p-birthdate" name="p-birthdate" class="form-control txt-box text-3" placeholder="TT.MM.JJJJ" onfocus="(this.type='date')" value="<?php echo $viewdata['p-birthdate']?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-email">E-Mail*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="email" id="p-email" name="p-email" class="form-control txt-box text-3" placeholder="mustermann@mail.de" value="<?php echo $viewdata['p-email']?>" required>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="p-telefon">Telefon*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="p-telefon" name="p-telefon" class="form-control txt-box text-3" placeholder="+49 1234 56789" value="<?php echo $viewdata['p-telefon']?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="fachkunde" style="position: relative;">Berufliche Qualifikation*
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="18px" id="info-fachkunde" style="cursor: pointer;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>

                            <div class="border border-dark rounded p-2" id="fachkunde-info-text" style="width:280px;position:absolute;top:35px;z-index:99;background-color:#ffffff">
                                <p class="color-3" style="opacity:0.8;font-size: 0.8rem;font-weight:400">*Weist der Bewerber keine ausreichenden Fachkenntnisse oder keine abgeschlossene immobilienwirtschaftliche Ausbildung oder mehrjährige Berufserfahrung nach, kann der Verband ein Fachkundegespräch oder eine schriftliche Prüfung verlangen. </p>
                            </div>
                    </label>
                    
                    <div class="col-12 col-md-5 col-lg-5">
                        <select class="form-select txt-box text-3" aria-label="Default select example" id="fachkunde" name="fachkunde" required>
                            <option value=""  <?php echo ($viewdata['fachkunde'] == "") ? "selected" : "" ?> >Bitte auswählen</option>
                            <option value="1" <?php echo ($viewdata['fachkunde'] == "1") ? "selected" : "" ?> >Kaufmann/-frau der Grundstücks- und Wohnungswirtschaft</option>
                            <option value="2" <?php echo ($viewdata['fachkunde'] == "2") ? "selected" : "" ?> >Immobilienkaufmann-/frau</option>
                            <option value="3" <?php echo ($viewdata['fachkunde'] == "3") ? "selected" : "" ?> >Immobilienfachwirt/in</option>
                            <option value="4" <?php echo ($viewdata['fachkunde'] == "4") ? "selected" : "" ?> >IHK Zertifikat Immobilienmakler/Verwalter/Sachverständiger</option>
                            <option value="5" <?php echo ($viewdata['fachkunde'] == "5") ? "selected" : "" ?> >Zertifikat anderer Institute mit min. 120 Stunden Umfang</option>
                            <option value="6" <?php echo ($viewdata['fachkunde'] == "6") ? "selected" : "" ?> >Immobilienwirtschaftlicher Studiengang</option>
                            <option value="7" <?php echo ($viewdata['fachkunde'] == "7") ? "selected" : "" ?> >Anderer/gleichwertiger Abschluss</option>
                            <option value="8" <?php echo ($viewdata['fachkunde'] == "8") ? "selected" : "" ?> >langjährige Branchenzugehörigkeit</option>
                            <option value="9" <?php echo ($viewdata['fachkunde'] == "9") ? "selected" : "" ?> >Fachkunde auf andere Weise belegen</option>
                        </select>
                        <span class="text-2 l-height-26 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nachweis" name="nachweis" value="1" <?php //echo ($viewdata['nachweis'] == "1") ? "checked" : "" ?>>
                            <label class="form-check-label text-2 l-height-26 color-3" style="font-size:15px;">Ein Nachweis ist nicht Möglich</label>
                        </div> -->
                        <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <input type="file" name="fileToUpload" id="fileToUpload" style="display:none;" value="<?php echo ($viewdata['fachkunde-fileName']) ?>" onclick="this.value=null;">
                        <!-- <input type="file" id="upload-fachkunde" name="upload-fachkunde" required> -->
                        <button class="form-control file-upload bold" id="uploadButton">Datei-Upload</button>
                        <div id="errorMsg" style="color:red;font-size:15px;padding-top:3px;">
                        </div>
                        <div id="fileNameInfo" style="color:#0074C2;font-size:15px;padding-top:3px;">
                            <?php echo $viewdata['fachkunde-fileName']?>
                        </div>
                        <input type="hidden" id='uploadOk' name="uploadOk" value="<?php echo $viewdata['uploadOk'] ?>">
                        <input type="hidden" id='filePath' name="filePath" value="<?php echo $viewdata['filePath'] ?>">
                        <input type="hidden" id='fileName' name="fileName" value="<?php echo $viewdata['fileName'] ?>">
                    </div>
                    <div id='showText'><i><span></span></i></div>
                    <div class="danger-msg-page1" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                    <div class="success-msg-page1" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>
                </div>
                
                
                
                
                <div class="antrag-submit mb-5 mt-5">
                    <button type="submit" class="btn-2 opacity-60" name="submit-page1" id="submit-page1">
                    Weiter zu Schritt 2</button>
                </div>
            </form>
        </div>
            
    </div>
    
</section>

<?php
    include "includes/footer.php";
?>
