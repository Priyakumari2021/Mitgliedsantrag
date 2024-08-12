<?php
    include "includes/header.php";
    ob_start();
    session_start();
    

    $mitgliedschaft_art = $disabled_art = $art_hinweis = "";
    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }
    if(isset($_SESSION['PAGE3'])) {
        $mitgliedschaft_art = $_SESSION['PAGE3']['mitgliedschaft-art'];
    }
    $firmaOrt = $_SESSION['PAGE1']['f-ort'];
    $firmaPlz = $_SESSION['PAGE1']['f-plz'];
    $bundesland= setCorrectChar($_SESSION['PAGE1']['bundesland']);
    $bundes_verband = getEmailId(strtolower($bundesland));

    $viewdata = getDataPage3();

    if(($_SESSION['PAGE2']['gewerbeerlaubnisMakler'] == '0') 
        && ($_SESSION['PAGE2']['gewerbeerlaubnisVerwalter'] == '0') && ( ($_SESSION['PAGE2']['makler'] == 'makler') || ($_SESSION['PAGE2']['verwalter'] == 'verwalter') ) ) {
        $viewdata['mitgliedschaft-art'] = "Juniorenmitgliedschaft";
        $mitgliedschaft_art = "Juniorenmitgliedschaft";
        $disabled_art = "disabled";
        $art_hinweis = "(Wenn keine Gewerbeerlaubnis vorliegt, ist ggf. nur eine Juniorenmitgliedschaft möglich.)";
    } /* */

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit-page3'])) {
            //var_dump($_POST);
            $_SESSION['PAGE3'] = $_POST;
            //var_dump($_SESSION['PAGE3']);
            
            echo '<pre>';
            //var_dump($_SESSION['PAGE3']);
            echo '</pre>';
            logFileInfo($_SESSION['PAGE3']);
            header("Location:  mitgliedsantrag_page4.php");
            exit;
        }
    }

    function logFileInfo($postData) {
        $info = "   Page3 =>  Art: "  . $postData['mitgliedschaft-art'];
        file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);
                 
    }
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD</p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 color-3 l-height-26">Bei uns kann jede Person ab 18 Jahren, sei es als Einzelperson oder als Unternehmen, die in der Immobilienbranche tätig ist, eine ordentliche Mitgliedschaft erwerben. Es ist wichtig, dass Sie über das notwendige Fachwissen für Ihre Tätigkeit verfügen und eine angemessene Berufshaftpflichtversicherung abschließen, die während Ihrer Mitgliedschaft beim Verband kontinuierlich aufrechterhalten wird. Wir freuen uns darauf, Sie als Teil unserer Gemeinschaft willkommen zu heißen!</p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center mb-5">
            <div class="prgress-bar-3 col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">3</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Regionalverband und Mitgliedsart</p>
                <p class="text-1 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-9 lg:pe-4">
                <p class="heading-4 mb-4">Mitgliedsantrag zur Aufnahme in den</p>
                <p class="text-2 color-1 l-height-26">- Immobilienverband Deutschland IVD Bundesverband der Immobilienberater, Makler, Verwalter und Sachverständigen e.V. Littenstraße 10, 10179 Berlin - nachfolgend „Bundesverband“ genannt.
                    <br><br>und zugleich in den in den für Sie örtlich zuständigen Regionalverband
                    
                    <br><br>- Immobilienverband Deutschland IVD Verband der Immobilienberater, Makler, Verwalter und Sachverständigen (Region wird anhand Ihrer Adresse automatisch gewählt) - nachfolgend „Regionalverband“ genannt.</p>
            </div>
            <!-- <div class="col-12 col-md-12 col-lg-3">
                <img class="img-map" src="img/map.png" alt="map"/>
                <div class="c-align img-caption">Beispiel:</div><div class="c-align img-caption">Berlin-Brandenburg</div>
            </div> -->
        </div>
        
        
        <div class="antrag-detals3">
            <form action="" method="post" name="form-page3" id="form-page3">
                <p class="heading-4 mt-5 mb-4">Details zur Mitgliedschaft</p>
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="bundesland">Ihr zuständiger Regionalverband</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="reg-verband" name="reg-verband" class="form-control txt-box text-3" value="<?php echo $bundes_verband['verband'] ?>" disabled>
                    </div>
                </div>
                <!-- <div class="form-group row mb-5 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="">Typ der Mitgliedschaft</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-typ" id="persoenlich" value="persoenlich" <?php echo ($viewdata['mitgliedschaft-typ'] == "persoenlich") ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="persoenlich">
                                Persönliche Mitgliedschaft
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-typ" id="firmen" value="firmen" <?php echo ($viewdata['mitgliedschaft-typ'] == "firmen") ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="firmen">
                                Firmenmitgliedschaft
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label">Art der Mitgliedschaft</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <?php //if(($_SESSION['PAGE2']['gewerbeerlaubnisMakler'] !== '0') && ($_SESSION['PAGE2']['gewerbeerlaubnisVerwalter'] !== '0')) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="ordentlich-mitglied" value="ordentlich-mitglied" <?php echo ($viewdata['mitgliedschaft-art'] == "ordentlich-mitglied") ? "checked" : "" ?> <?php echo $disabled_art ?> >
                            <label class="form-check-label text-2" for="ordentlich-mitglied">
                                Ordentliches Mitglied
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="erstes-Jahr" value="erstes-Jahr" <?php echo ($viewdata['mitgliedschaft-art'] == "erstes-Jahr") ? "checked" : "" ?> <?php echo $disabled_art ?> >
                            <label class="form-check-label text-2" for="erstes-Jahr">
                                Existenzgründer Mitgliedschaft erstes Jahr
                            </label>
                        </div>
                        <?php if($bundes_verband['verband'] !== 'IVD West') { ?>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="zweites-Jahr" value="zweites-Jahr" <?php echo ($viewdata['mitgliedschaft-art'] == "zweites-Jahr") ? "checked" : "" ?> <?php echo $disabled_art ?> >
                            <label class="form-check-label text-2" for="zweites-Jahr">
                                Existenzgründer Mitgliedschaft zweites Jahr
                            </label>
                        </div>
                        <?php } ?>
                        <?php //} ?>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="juniorenmitgliedschaft" value="Juniorenmitgliedschaft" <?php echo ($viewdata['mitgliedschaft-art'] == "Juniorenmitgliedschaft") ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="juniorenmitgliedschaft">
                                Juniorenmitgliedschaft
                            </label><br><span style="opacity:0.6;font-size:0.9rem;font-weight:400;"><?php echo $art_hinweis ?></span>
                        </div>
                        <?php if(($viewdata['mitgliedschaft-art'] !== "Juniorenmitgliedschaft") && 
                                    ($bundes_verband['verband'] == 'IVD Nord')) 
                        { ?>
                            <div id="marketing_price_info" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;">
                                Hinzu kommt eine Werbeumlage in Höhe von 200,00 Euro pro Jahr. 
                            </div>
                        <?php } ?>
                        <!-- <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="angestelltenmitgliedschaft" value="Angestelltenmitgliedschaft" <?php echo ($viewdata['mitgliedschaft-art'] == "Angestelltenmitgliedschaft") ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="angestelltenmitgliedschaft">
                                Angestelltenmitgliedschaft
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="mitgliedschaft-art" id="zweitmitgliedschaft" value="Zweitmitgliedschaft" <?php echo ($viewdata['mitgliedschaft-art'] == "Zweitmitgliedschaft") ? "checked" : "" ?> >
                            <label class="form-check-label text-2" for="zweitmitgliedschaft">
                                Zweitmitgliedschaft
                            </label>
                        </div> -->
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1">Preis (Alle Preise in netto)</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="row text-2">
                            <div class="col-7 col-md-4">Aufnahmegebühr: </div>
                            <div class="col-5 col-md-8">
                                <span id="aufnahme_gebuehr">810,00</span> €
                                <input type="hidden" id="hid_aufnahme_gebuehr" name="aufnahme-gebuehr" value=<?php echo $viewdata['aufnahme-gebuehr'] ?>>
                            </div>
                        </div>
                        <div class="row text-2">
                            <div class="col-7 col-md-4">Jahresgebühr: </div>
                            <div class="col-5 col-md-8">
                                <span id="jahres_gebuehr">500,00</span> €
                                <input type="hidden" id="hid_jahres_gebuehr" name="jahres-gebuehr" value=<?php $viewdata['jahres-gebuehr'] ?>>
                            </div>
                        </div> 
                        <div class=""><small style="opacity:0.6;">* ggf. andere Preise ab dem 2. Jahr. Bitte schauen Sie in die Beitragsordnung des jeweiligen Regionalverbandes <a href="https://ivd.net/ivd-satzungen-und-regularien/">(https://ivd.net/ivd-satzungen-und-regularien/)</a></small></div>                       
                    </div>
                </div>

                <div class="form-group row mb-4 heading-1">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label" for="mitgliedschaft_begin">Beginn der Mitgliedschaft (Wunschtermin) </label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="mitgliedschaft_begin" name="mitgliedschaft-beginn" id="mitgliedschaft-beginn" class="form-control txt-box text-3" placeholder="TT.MM.JJJJ" onfocus="(this.type='date')" value="<?php echo $viewdata['mitgliedschaft-beginn'] ?>" required>
                    </div>
                </div>
                <div id="show-ivd-nord">
                    <div class="form-group row mb-4 heading-1" style="position: relative;">
                        <label class="col-12 col-md-4 col-lg-4 col-form-label" for="">Referenzen
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="18px" id="ref-info-bubble" style="cursor: pointer;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </label>
                        <!-- Info Msg for Referenz -->
                        <div class="border border-dark rounded p-2" style="width:300px;position:absolute;top:35px;z-index:99;background-color:#ffffff" id="ref-info-txt">
                            <p class="color-3" style="opacity:0.5;font-size:12px;margin:0">Bitte fügen Sie dem Antrag zwei Referenzschreiben von Personen oder Firmen bei, mit denen Sie als Makler in der letzten Zeit in Geschäftsverbindung gestanden haben (Google-Bewertungen erkennen wir nicht an)</p>
                        </div>
                        <!-- Info Msg for Referenz end -->
                        <div class="col-12 col-md-8 col-lg-8">                    
                            <div class="col-12">
                                <span style="font-size: 16px;">(Ref.1)</span>
                                <span class="text-3 color-3" style="opacity:60%;font-size:14px;"> Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                                <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                                <input type="file" class="" name="ref_1" id="ref_1" style="display: none;" value="<?php echo ($viewdata['ref_1']) ?>">
                                <button  id="ref_btn_1" class="form-control file-upload bold  width-50 md:width-40">Datei-Upload</button>
                                

                                <div id="error_ref_1" class="text-2 l-height-26" style="color:red;font-size:16px;padding-top:3px;">
                                </div>
                                <div id="success_ref_1" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;padding-top:3px;">
                                    <?php echo ($viewdata['ref_1_filename']) ?>
                                </div>
                                <input type="hidden" id='ref_1_ok' name="ref_1_ok" value="<?php echo $viewdata['ref_1_ok'] ?>">
                                <input type="hidden" id='ref_1_filepath' name="ref_1_filepath" value="<?php echo $viewdata['ref_1_filepath'] ?>">
                                <input type="hidden" id='ref_1_filename' name="ref_1_filename" value="<?php echo $viewdata['ref_1_filename'] ?>">
                            </div>
                            <div class="col-12"> 
                                <span style="font-size: 16px;">(Ref.2)</span>
                                <span class="text-3 color-3" style="opacity:60%;font-size:14px;"> Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                                <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                                <input type="file" class="" name="ref_2" id="ref_2" style="display: none;" value="<?php echo ($viewdata['ref_2']) ?>">
                                <button  id="ref_btn_2" class="form-control file-upload bold width-50 md:width-40">Datei-Upload</button>
                                

                                <div id="error_ref_2" class="text-2 l-height-26" style="color:red;font-size:16px;padding-top:3px;">
                                </div>
                                <div id="success_ref_2" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;padding-top:3px;">
                                    <?php echo ($viewdata['ref_2_filename']) ?>
                                </div>
                                <input type="hidden" id='ref_2_ok' name="ref_2_ok" value="<?php echo $viewdata['ref_2_ok'] ?>">
                                <input type="hidden" id='ref_2_filepath' name="ref_2_filepath" value="<?php echo $viewdata['ref_2_filepath'] ?>">
                                <input type="hidden" id='ref_2_filename' name="ref_2_filename" value="<?php echo $viewdata['ref_2_filename'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4 heading-1">
                        <label class="col-12 col-md-4 col-lg-4 col-form-label" for="">Foto des Antragstellers</label>
                        <div class="col-12 col-md-8 col-lg-8">                    
                            <div class="">
                                <span class="text-3 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG | max. Dateigröße: 5MB</span>
                                <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                                <input type="file" class="" name="antragsteller-foto" id="antragsteller-foto" style="display: none;" value="<?php echo ($viewdata['antragsteller-foto']) ?>">
                                <button  name ="foto_upload_btn" id="foto_upload_btn" class="form-control file-upload bold width-50 md:width-40">Datei-Upload</button>                           
                                
                                <div id="error_foto" class="text-2 l-height-26" style="color:red;font-size:16px;padding-top:3px;">
                                </div>
                                <div id="success_foto" class="text-2 l-height-26" style="color:#0074C2;font-size:16px;padding-top:3px;">
                                    <?php echo ($viewdata['foto_filename']) ?>
                                </div>
                                <input type="hidden" id='foto_ok' name="foto_ok" value="<?php echo $viewdata['foto_ok'] ?>">
                                <input type="hidden" id='foto_filepath' name="foto_filepath" value="<?php echo $viewdata['foto_filepath'] ?>">
                                <input type="hidden" id='foto_filename' name="foto_filename" value="<?php echo $viewdata['foto_filename'] ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="danger-msg-page3" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                <div class="success-msg-page3" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>

                <div class="d-flex justify-content-between md:flex-direction mb-5 mt-5">
                    <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page2.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem;text-align:center;">Schritt zurück</a>
                    <button type="submit" class="btn-2 opacity-60" name="submit-page3" id="submit-page3" disabled="true" >Weiter zu Schritt 4</button>
                </div>
            </form>
        </div>
            
    </div>
    
</section>

<?php
    include "includes/footer.php";
?>

<script>
    let bundesverbands = '<?php echo $bundes_verband['verband'] ?>';  
    //console.log('<?php echo $firmaOrt ?>')
    let plz = <?php echo $firmaPlz ?>;
    let art = '<?php echo ($mitgliedschaft_art !== "") ? $mitgliedschaft_art : 'ordentlich-mitglied' ?>';
    let mitgliedschaft_art = document.querySelectorAll('input[name="mitgliedschaft-art"]') 
    let marketing_price_info = document.getElementById('marketing_price_info');    
    console.log(bundesverbands + "  " + art + " " + plz)
    let gebuehr = getNettoPreis(bundesverbands, art, plz);

    document.getElementById("aufnahme_gebuehr").innerText = gebuehr ? gebuehr['aufnahme_gebuehr'] : "";
    document.getElementById("jahres_gebuehr").innerText = gebuehr ? gebuehr['jahres_gebuehr'] : "";
    document.getElementById("hid_aufnahme_gebuehr").value = gebuehr ? gebuehr['aufnahme_gebuehr'] : "";
    document.getElementById("hid_jahres_gebuehr").value = gebuehr ? gebuehr['jahres_gebuehr'] : "";

    mitgliedschaft_art.forEach(element => {
        element.addEventListener("change", function(event) {
            art = event.target.value;
            if(art == 'Juniorenmitgliedschaft') {
                if(marketing_price_info) marketing_price_info.style.display = "none"
            } else {
                if(marketing_price_info) marketing_price_info.style.display = "block"
            }
            let gebuehr = getNettoPreis(bundesverbands, art, plz);
            document.getElementById("aufnahme_gebuehr").innerText = gebuehr['aufnahme_gebuehr'];
            document.getElementById("jahres_gebuehr").innerText = gebuehr['jahres_gebuehr'];
            document.getElementById("hid_aufnahme_gebuehr").value = gebuehr ? gebuehr['aufnahme_gebuehr'] : "";
            document.getElementById("hid_jahres_gebuehr").value = gebuehr ? gebuehr['jahres_gebuehr'] : "";
        })
    });
</script>