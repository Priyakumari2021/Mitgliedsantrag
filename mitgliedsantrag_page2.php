<?php
    include "includes/header.php";
    ob_start();
    session_start();    
    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }
    //$alert = $fileName = "";
    //var_dump($_SESSION['PAGE1']);
    //var_dump($_POST);
    $viewdata = getDataPage2();

    //if($viewdata['gewerbeerlaubnisMakler'] !== "1") { $disableM = 'disabled';}
    //if($viewdata['gewerbeerlaubnisVerwalter'] !== "1") { $disableV = 'disabled';}

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit-page2'])) {
            //var_dump($_POST);
            $_SESSION['PAGE2'] = $_POST;
            if(!isset($_POST['makler'])) $_SESSION['PAGE2']['makler'] = "";
            if(!isset($_POST['verwalter'])) $_SESSION['PAGE2']['verwalter'] = "";
            if(!isset($_POST['sachverstaendig'])) $_SESSION['PAGE2']['sachverstaendig'] = "";
            if(!isset($_POST['bautraeger'])) $_SESSION['PAGE2']['bautraeger'] = "";
            if(!isset($_POST['projektentwicklung'])) $_SESSION['PAGE2']['projektentwicklung'] = "";
            if(!isset($_POST['sonstige'])) $_SESSION['PAGE2']['sonstige'] = "";

            $_SESSION['PAGE2']['gewerbeanmeldung-fileName'] = $_POST['fileNameGewerbeanmeldung'];
            $_SESSION['PAGE2']['uploadOkGewerbeanmeldung'] = $_POST['uploadOkGewerbeanmeldung'];
            $_SESSION['PAGE2']['filePathGewerbeanmeldung'] = $_POST['filePathGewerbeanmeldung'];
            $_SESSION['PAGE2']['fileNameGewerbeanmeldung'] = $_POST['fileNameGewerbeanmeldung'];

            $_SESSION['PAGE2']['upload-34c-makler'] = $_POST['fileNameMakler'];
            $_SESSION['PAGE2']['uploadOkMakler'] = $_POST['uploadOkMakler'];
            $_SESSION['PAGE2']['filePathMakler'] = $_POST['filePathMakler'];
            $_SESSION['PAGE2']['fileNameMakler'] = $_POST['fileNameMakler'];

            $_SESSION['PAGE2']['upload-34c-verwalter'] = $_POST['fileNameVerwalter'];
            $_SESSION['PAGE2']['uploadOkVerwalter'] = $_POST['uploadOkVerwalter'];
            $_SESSION['PAGE2']['filePathVerwalter'] = $_POST['filePathVerwalter'];
            $_SESSION['PAGE2']['fileNameVerwalter'] = $_POST['fileNameVerwalter'];

            /*echo '<pre>';
            var_dump($_SESSION['PAGE2']);
            echo '</pre>'; */
            logFileInfo($_SESSION['PAGE2']);
            header("Location:  mitgliedsantrag_page3.php");
            exit;
            
        }
    }

    function logFileInfo($postData) {
        $info = "   Page2 =>  Jahr der Gründung: " . $postData['gruendung-jahr'] . " | Tätigkeits: "  . getTatigkeit($postData);
        file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);                 
    }
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD </p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 l-height-26">Erzählen Sie uns mehr über Ihr Unternehmen. Ihre Informationen werden selbstverständlich vertraulich behandelt.</p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="prgress-bar-2 col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">2</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Ergänzende Angaben zum Unternehmen</p>
                <p class="text-2 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
        </div>
        
        <p class="heading-4 mt-5 mb-4">Ergänzende Daten</p>
        <div class="antrag-detail2">
            <form action="" method="post" name="form-page2" id="form-page2" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="gruendung_jahr">Jahr der Gründung*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" name="gruendung-jahr" id="gruendung_jahr" class="form-control txt-box text-3" value="<?php echo $viewdata['gruendung-jahr'] ?> " placeholder="JJJJ" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="mitarbeiter_anzahl">Anzahl der Mitarbeiter</label>
                    <div class="col-12 col-md-8 col-lg-8" style="position:relative;">
                        <input type="text" name="mitarbeiter-anzahl" id="mitarbeiter_anzahl" class="form-control txt-box text-3" placeholder="14" value="<?php echo $viewdata['mitarbeiter-anzahl'] ?>">
                        <span class="l-nachricht" style="position: absolute;right: 1.8rem;top:0.8rem;">(optional)</span>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="filiale_anzahl">Anzahl weiterer Filialen</label>
                    <div class="col-12 col-md-8 col-lg-8" style="position:relative;">
                        <input type="text" name="filiale-anzahl" id="filiale_anzahl" class="form-control txt-box text-3" placeholder="2" value="<?php echo $viewdata['filiale-anzahl'] ?>" >
                        <span class="l-nachricht" style="position: absolute;right: 1.8rem;top:0.8rem;">(optional)</span>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="gewerbeanmeldung_datum">Gewerbeanmeldung*</label>
                    <div class="col-12 col-md-6 col-lg-6">
                        <input type="text" name="gewerbeanmeldung-datum" id="gewerbeanmeldung_datum" class="form-control txt-box text-3" placeholder="TT.MM.JJJJ" onfocus="(this.type='date')" value="<?php echo $viewdata['gewerbeanmeldung-datum'] ?>" required>
                        <span class="text-3 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                        <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 md:pt-4 fileDetail1 heading-1" for="upload-gewerbeanmeldung">
                        <input type="file" class="uploadFilePage2" name="upload-gewerbeanmeldung" id="upload-gewerbeanmeldung" style="display: none;" value="<?php echo ($viewdata['gewerbeanmeldung-fileName']) ?>">
                        <button class="form-control file-upload bold" id="gewerbeanmeldungButton">Datei-Upload</button>
                        <div id="errorGewerbeanmeldung" class="text-2 l-height-26" style="color:red;font-size:16px;padding-top:3px;">
                        </div>
                        <div id="fileNameGewerbeanmeldungInfo" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;padding-top:3px;">
                            <?php echo ($viewdata['gewerbeanmeldung-fileName']) ?>
                        </div>
                        <input type="hidden" id='uploadOkGewerbeanmeldung' name="uploadOkGewerbeanmeldung" value="<?php echo $viewdata['uploadOkGewerbeanmeldung'] ?>">
                        <input type="hidden" id='filePathGewerbeanmeldung' name="filePathGewerbeanmeldung" value="<?php echo $viewdata['filePathGewerbeanmeldung'] ?>">
                        <input type="hidden" id='fileNameGewerbeanmeldung' name="fileNameGewerbeanmeldung" value="<?php echo $viewdata['fileNameGewerbeanmeldung'] ?>">
                    </div>
                </div>
                <p class="heading-4 mt-5 mb-4">Geschäfts-Informationen</p>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="gewerbeerlaubnisMakler">Gewerbeerlaubnis nach §34 c Makler</label>
                    <div class="col-12 col-md-8 col-lg-8 pt-2 pb-2">
                        <div class="form-check">
                            <input class="form-check-input gewerbeerlaubnisMakler" type="radio" name="gewerbeerlaubnisMakler" id="gewerbeerlaubnisMakler" value="0" <?php echo ($viewdata['gewerbeerlaubnisMakler'] == '0') ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="gewerbeerlaubnisMakler">
                                <b>Nein</b>, ich habe keine Gewerbeerlaubnis nach §34 c Makler.
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input gewerbeerlaubnisMakler" type="radio" name="gewerbeerlaubnisMakler" id="gewerbeerlaubnisMakler" value="1" <?php echo ($viewdata['gewerbeerlaubnisMakler'] == '1') ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="flexRadioDefault2">
                                <b>Ja</b>, ich habe eine Gewerbeerlaubnis nach §34 c Makler.
                            </label>
                        </div>
                        <div class="mt-3 fileDetail2">
                            <span class="text-3 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                            <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                            <input type="file" class="uploadFilePage2" name="upload-34c-makler" id="upload-34c-makler" style="display: none;" value="<?php echo ($viewdata['upload-34c-makler']) ?>">
                            <button  id="MaklerUpload" class="form-control file-upload bold width-40 md:width-40" <?php echo ($viewdata['gewerbeerlaubnisMakler'] == '0') ? "disabled" : "" ?> >Datei-Upload</button>
                            <div id="error34cMakler" class="text-2 l-height-26" style="color:red;font-size:16px;padding-top:3px;">
                            </div>
                            <div id="fileName34cMakler" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;padding-top:3px;">
                                <?php echo ($viewdata['upload-34c-makler']) ?>
                            </div>
                            <input type="hidden" id='uploadOkMakler' name="uploadOkMakler" value="<?php echo $viewdata['uploadOkMakler'] ?>">
                            <input type="hidden" id='filePathMakler' name="filePathMakler" value="<?php echo $viewdata['filePathMakler'] ?>">
                            <input type="hidden" id='fileNameMakler' name="fileNameMakler" value="<?php echo $viewdata['fileNameMakler'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="">Gewerbeerlaubnis nach §34 c Verwalter</label>
                    <div class="col-12 col-md-8 col-lg-8 pt-2 pb-2">
                        <div class="form-check">
                            <input class="form-check-input gewerbeerlaubnisVerwalter" type="radio" name="gewerbeerlaubnisVerwalter"  value="0" <?php echo ($viewdata['gewerbeerlaubnisVerwalter'] == '0') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                <b>Nein</b>, ich habe keine Gewerbeerlaubnis nach §34 c Verwalter.
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input gewerbeerlaubnisVerwalter" type="radio" name="gewerbeerlaubnisVerwalter" value="1" <?php echo ($viewdata['gewerbeerlaubnisVerwalter'] == '1') ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="flexRadioDefault2">
                                <b>Ja</b>, ich habe eine Gewerbeerlaubnis nach §34 c Verwalter.
                            </label>
                        </div>
                        <div class="mt-3 fileDetail3">                            
                            <span class="text-3 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                            <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                            <input type="file" class="uploadFilePage2" name="upload-34c-verwalter" id="upload-34c-verwalter" style="display: none;" value="<?php echo ($viewdata['upload-34c-verwalter']) ?>">
                            <button class="form-control file-upload bold width-40 md:width-40" id="VerwalterUpload" <?php echo ($viewdata['gewerbeerlaubnisVerwalter'] == '0') ? "disabled" : "" ?> >Datei-Upload</button>
                            <div id="error34cVerwalter" class="text-2 l-height-26" style="color:red;font-size:16px;">
                            </div>
                            <div id="fileName34cVerwalter" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;">                            
                                <?php echo ($viewdata['upload-34c-verwalter']) ?>
                            </div>
                            <input type="hidden" id='uploadOkVerwalter' name="uploadOkVerwalter" value="<?php echo $viewdata['uploadOkVerwalter'] ?>">
                            <input type="hidden" id='filePathVerwalter' name="filePathVerwalter" value="<?php echo $viewdata['filePathVerwalter'] ?>">
                            <input type="hidden" id='fileNameVerwalter' name="fileNameVerwalter" value="<?php echo $viewdata['fileNameVerwalter'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label">Eintrag ins Handelsregister</label>
                    <div class="col-12 col-md-8 col-lg-8 pt-2 pb-2">
                        <div class="form-check">
                            <input class="form-check-input handelsregister" type="radio" name="handelsregister" value="0" <?php echo ($viewdata['handelsregister'] == '0') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                <b>Nein</b>, es gibt kein Handelsregistereintrag.
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input handelsregister" type="radio" name="handelsregister" value="1" <?php echo ($viewdata['handelsregister'] == '1') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                <b>Ja</b>, es gibt einen Handelsregistereintrag.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label">Bilden Sie immobilienwirtschaftlich aus?</label>
                    <div class="col-12 col-md-8 col-lg-8 pt-2 pb-2">
                        <div class="form-check">
                            <input class="form-check-input immobilienwirtschaftlich" type="radio" name="immobilienwirtschaftlich" value="0" <?php echo ($viewdata['immobilienwirtschaftlich'] == '0') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                <b>Nein</b>, ich bilde nicht aus.
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input immobilienwirtschaftlich" type="radio" name="immobilienwirtschaftlich" value="1" <?php echo ($viewdata['immobilienwirtschaftlich'] == '1') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                <b>Ja</b>, ich bilde aus.
                            </label>
                        </div>
                    </div>
                </div>
                <p class="heading-4 mt-5 mb-4">Angaben der Schwerpunkte des Unternehmens </p>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1">Ausgeübte Tätigkeitsfelder*<br><span class="text-3 color-3" style="opacity:60%;font-size:14px;">(Wer als Makler oder Verwalter tätig ist, muss eine Gewerbeerlaubnis nach §34 c besitzen)</span></label>
                    
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="makler" id="makler" value="makler" <?php echo ($viewdata['makler'] == 'makler') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                Makler
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="verwalter" id="verwalter" value="verwalter" <?php echo ($viewdata['verwalter'] == 'verwalter') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                Verwalter
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="sachverstaendig" value="sachverstaendig" <?php echo ($viewdata['sachverstaendig'] == 'sachverstaendig') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                Sachverständige
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="bautraeger" value="bautraeger" <?php echo ($viewdata['bautraeger'] == 'bautraeger') ? "checked" : "" ?> >
                            <label class="form-check-label text-2">
                                Bauträger / Baubetreuung
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="projektentwicklung" value="projektentwicklung" <?php echo ($viewdata['projektentwicklung'] == 'projektentwicklung') ? "checked" : "" ?> >

                            <label class="form-check-label text-2">
                                Projektentwicklung
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input me-3" type="checkbox" name="sonstige" value="sonstige" <?php echo ($viewdata['sonstige'] == 'sonstige') ? "checked" : "" ?> >

                            <label class="form-check-label text-2">
                                sonstige Tätigkeiten
                            </label>

                            
                        </div>
                        <div>
                            <input type="text" name="sonstige_taetigkeit" id="sonstige_taetigkeit" class="txt-box text-3" value="<?php echo $viewdata['sonstige_taetigkeit'] ?>" placeholder="sonstige Tätigkeiten" disabled="true">
                        </div>
                    </div>
                    <div class="danger-msg-page2" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                    <div class="success-msg-page2" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>
                </div>
                <div class="d-flex justify-content-between md:flex-direction mb-5 mt-5">
                    <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page1.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem; text-align:center;">Schritt zurück</a>
                    <button type="submit" class="btn-2 opacity-60" name="submit-page2" id="submit-page2">Weiter zu Schritt 3</button>
                </div>
            </form>
        </div>
            
    </div>
    
</section>

<?php
    include "includes/footer.php";
?>