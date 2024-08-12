<?php
    include "includes/header.php";
    ob_start();
    session_start();

    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }

$viewdata = getDataPage5();

$bundesland= setCorrectChar($_SESSION['PAGE1']['bundesland']);
$pdfDatei = getEmailId(strtolower($bundesland));
//var_dump($pdfDatei);
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['submit-page5'])) {
        // var_dump($_POST);
        $_SESSION['PAGE5'] = $_POST;
        $_SESSION['PAGE5']['betriebshaft'] = isset($_POST['betriebshaft']) ? '1' : '0';
        $_SESSION['PAGE5']['betriebshaft-file'] = $_FILES['betriebshaft-file']['name'];
        $_SESSION['PAGE5']['uploadOkBetriebshaft'] = $_POST['uploadOkBetriebshaft'];
        $_SESSION['PAGE5']['filePathBetriebshaft'] = $_POST['filePathBetriebshaft'];
        $_SESSION['PAGE5']['fileNameBetriebshaft'] = $_POST['fileNameBetriebshaft'];

        $_SESSION['PAGE5']['vermoegensschadenhaft'] = isset($_POST['vermoegensschadenhaft']) ? '1' : '0';
        $_SESSION['PAGE5']['vermoegensschadenhaft-file'] = $_FILES['vermoegensschadenhaft-file']['name'];
        $_SESSION['PAGE5']['uploadOkVermoegensschaden'] = $_POST['uploadOkVermoegensschaden'];
        $_SESSION['PAGE5']['filePathVermoegensschaden'] = $_POST['filePathVermoegensschaden'];
        $_SESSION['PAGE5']['fileNameVermoegensschaden'] = $_POST['fileNameVermoegensschaden'];
       /*  echo '<pre>';
        var_dump($_SESSION['PAGE5']);
        echo '</pre>'; */
        logFileInfo();
        header("Location:  mitgliedsantrag_page6.php");
        exit;
    }
}

function logFileInfo() {
    $info = "   Page5 =>  Done..";
    file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);
             
}
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD</p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 color-3 l-height-26">Bei uns steht der Verbraucherschutz an erster Stelle. Aus diesem Grund ist es für Mitgliedsunternehmen obligatorisch, eine Vermögensschadenversicherung abzuschließen. Damit möchten wir sicherstellen, dass Sie und Ihre Kunden bestmöglich abgesichert sind. Darüber hinaus verpflichten Sie sich, unsere Satzungen, Standes- und Wettbewerbsregeln sowie weitere Regularien zu beachten. Diese Maßnahmen dienen dazu, eine vertrauensvolle und ethische Geschäftsumgebung zu schaffen. </p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="prgress-bar-5 col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">5</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Regularien, Datenschutz, Versicherungen</p>
                <p class="text-2 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
        </div>
        <!-- Info Box -->
        <form action="" method="post" name="form-page5" id="form-page5" enctype="multipart/form-data">
            <div class="mt-5">
                <p>
                    <b>Was passiert mit meinen Daten? Hier geht’s zur Datenschutzerklärung</b>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="18px" id="info-datenschutz">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>

                </p>
                <div class="border border-dark rounded p-2 hidden" id="info-text">
                    <p class="color-3" style="opacity:0.5;">Der Regionalverband verarbeitet meine personenbezogenen Daten zum Zwecke der Mitgliederverwaltung und Erfüllung des Verbandszwecks. Dies schließt die Veröffentlichung der Kontaktdaten (Name, Anschrift und weitere Kommunikationsdaten) in gedruckten und elektronischen Mitgliederverzeichnissen (inkl. Verbandszeitschrift) ein. Mit der Mitgliedschaft im Regionalverband wird auch eine Mitgliedschaft im IVD Bundesverband begründet. Daher werden meine personenbezogenen Daten auch vom Bundesverband verarbeitet. Als betroffene Person habe ich das Recht auf Auskunft, Berichtigung, Löschung und Einschränkung der Verarbeitung der Daten nach den Bestimmungen der Datenschutzgrundverordnung (DSGVO) und des Bundesdatenschutzgesetzes. Auf Wunsch erteilen mir/uns der Regionalverband sowie der Bundesverband weitere Auskünfte über den Datenschutz innerhalb des Vereins.</p>
                </div>

                <p><b>- Zutreffendes bitte ankreuzen –</b></p>
                
                    <div class="form-check pb-3">
                        <input type="checkbox" class="form-check-input" name="einwilligung" id="einwilligung" value="ja" <?php echo ($viewdata['einwilligung'] == 'ja') ? "checked" : "" ?>>
                        <div>
                            <label class="form-check-label text-2 ps-3" style="font-size: 14px;">
                            Ich/Wir bin/sind damit einverstanden, dass die Daten (insbes. E-Mailadresse) für Newsletter genutzt werden, der/die auch Werbebanner enthalten können. Die Daten werden nicht an werbetreibende Dritte weitergegeben. Ich/Wir bin/sind damit einverstanden, dass meine Kontaktdaten (Name, Anschrift und E-Mailadresse, NICHT Telefonnummer) an werbetreibende Dritte weitergegeben werden, damit mich diese über interessante Angebote informieren können. Die Weitergabe ist auf Auftragsdatenverarbeiter des IVD (zuständiger Regionalverband und Bundesverband) beschränkt. Eine Weitergabe an Kooperationspartner und werbetreibende Dritte erfolgt nur, sofern hierfür eine ausdrückliche Einwilligung vorliegt. Ich/wir bestätige/n gleichzeitig, dass ein von mir/uns eingereichtes Foto frei von Rechten Dritter ist und einer Veröffentlichung keine Urheber- oder Persönlichkeitsrechte entgegenstehen (Foto nur erforderlich beim IVD Nord). Den IVD stelle ich im Falle etwaiger Rechtsansprüche Dritter diesbezüglich frei. <br>
- Die Einwilligung(en) kann ich/können wir jederzeit widerrufen – 

                            </label>
                                
                        </div>
                    </div>
            </div>
            <!-- Info Box end -->
            <p class="heading-4">Kenntnissnahme folgender Dokumente</p>
            <p class="h-5 mb-4">Ich erkläre hiermit für mich und mein Unternehmen folgende Dokumente zur Kenntnis genommen und anerkannt zu haben:</p>
            <div class="antrag-detals5">
                <!-- <form action="" method="post" name="form-page5" id="form-page5" enctype="multipart/form-data"> -->
                    <div class="Kenntnis-docs">
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="bundesverbands" id="IVD-Bundesverbands" value="IVD-Bundesverbands" <?php echo ($viewdata['bundesverbands'] == 'IVD-Bundesverbands') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="IVD-Bundesverbands">
                                <a href="./PDF/Satzung_Bundesverband-PDF.pdf" target="_blank" class="color-2">Satzung des IVD Bundesverbands</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="regionalverbands" id="IVD-Regionalverbands" value="IVD-Regionalverbands" <?php echo ($viewdata['regionalverbands'] == 'IVD-Regionalverbands') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="IVD-Regionalverbands">
                                <a href="./PDF/Regionalverband/<?php echo $pdfDatei['pdf_link'] ?>" target="_blank" class="color-2">Satzung des IVD Regionalverbands</a>
                            </label></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="standesregeln" id="IVD-Standesregeln" value="IVD-Standesregeln" <?php echo ($viewdata['standesregeln'] == 'IVD-Standesregeln') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="IVD-Standesregeln">
                                <a href="./PDF/2016-06-10_IVD-Standesregeln.pdf" target="_blank" class="color-2">IVD Standesregeln</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="geschaeftsgebraeuche" id="IVD-Geschaeftsgebraeuche" value="IVD Geschäftsgebräuche" <?php echo ($viewdata['geschaeftsgebraeuche'] == 'IVD Geschäftsgebräuche') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="IVD-Geschaeftsgebraeuche">
                                <a href="./PDF/2010-06-11_IVD-GfG.pdf" target="_blank" class="color-2">IVD Geschäftsgebräuche für Gemeinschaftsgeschäfte</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="wettbewerbsregeln" id="IVD-Wettbewerbsregeln" value="IVD-Wettbewerbsregeln" <?php echo ($viewdata['wettbewerbsregeln'] == 'IVD-Wettbewerbsregeln') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="IVD-Wettbewerbsregeln">
                                <a href="./PDF/2008-05-20_IVD-Wettbewerbsregeln.pdf" target="_blank" class="color-2">IVD Wettbewerbsregeln</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="aufnahmeordnung" id="aufnahmeordnung" value="Aufnahmeordnung" <?php echo ($viewdata['aufnahmeordnung'] == 'Aufnahmeordnung') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="aufnahmeordnung">
                                <a href="./PDF/Aufnahmeordnung/<?php echo $pdfDatei['aufnahmeordnung'] ?>" target="_blank" class="color-2">Aufnahmeordnung</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="beitragsordnung" id="beitragsordnung" value="Beitragsordnung" <?php echo ($viewdata['beitragsordnung'] == 'Beitragsordnung') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="beitragsordnung">
                                <a href="./PDF/Beitragsordnung/<?php echo $pdfDatei['beitragsordnung'] ?>" target="_blank" class="color-2">Beitragsordnung</a>
                            </label>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="datenschutzerklaerung" id="datenschutzerklaerung" value="Datenschutzerklärung" <?php echo ($viewdata['datenschutzerklaerung'] == 'Datenschutzerklärung') ? "checked" : "" ?> >
                            <label class="form-check-label text-2 ps-3" for="datenschutzerklaerung">
                                <a href="https://ivd.net/Datenschutz/" target="_blank" class="color-2">Datenschutzerklärung</a>
                            </label>
                        </div>
                    </div>
                    <p class="heading-4 mt-5">Versicherungen</p>
                    <p class="h-5 mb-4">
                        <!-- Ich erkläre hiermit für mich und mein Unternehmen folgende Dokumente zur Kenntnis genommen und anerkannt zu haben: -->
                    Bitte laden Sie folgende Dokumente hoch:
                    </p>
                    <div>
                        <div class="form-check pb-4">
                            <input class="form-check-input" type="checkbox" name="betriebshaft" id="betriebshaft" value="betriebshaft" <?php echo ($viewdata['betriebshaft'] == '1') ? "checked" : "" ?> >
                            <div>
                                <label class="form-check-label text-2 ps-3" for="betriebshaft">
                                    Betriebshaftpflicht
                                </label>
                                
                                <div class="versicherung ps-3 pt-3">
                                    <input type="file" id="betriebshaft-file" name="betriebshaft-file" style="display: none;" value="<?php echo $viewdata['betriebshaft-file'] ?>">
                                    <button class="form-control file-upload bold width-25 md:width-25" id="betriebshaftButton">Datei-Upload</button>
                                    <span class="text-2 l-height-26 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span>
                                    <div class="text-2 l-height-26" id="errorBetriebshaftpflicht" style="color:red;font-size:16px; padding-top:3px;"></div>
                                    <div class="text-2 l-height-26" id="fileNameBetriebshaftpflicht" style="color:#0074C2;font-size:16px;padding-top:3px;"><?php echo ($viewdata['betriebshaft'] == '1') ? $viewdata['fileNameBetriebshaft'] : "" ?></div>
                                    
                                    <input type="hidden" id='uploadOkBetriebshaft' name="uploadOkBetriebshaft" value="<?php echo $viewdata['uploadOkBetriebshaft'] ?>" >
                                    <input type="hidden" id='filePathBetriebshaft' name="filePathBetriebshaft" value="<?php echo $viewdata['filePathBetriebshaft'] ?>" >
                                    <input type="hidden" id='fileNameBetriebshaft' name="fileNameBetriebshaft" value="<?php echo $viewdata['fileNameBetriebshaft'] ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" name="vermoegensschadenhaft" id="vermoegensschadenhaft" value="vermoegensschadenhaft" <?php echo ($viewdata['vermoegensschadenhaft'] == 'vermoegensschadenhaft') ? "checked" : "" ?> >
                            <div>
                                <label class="form-check-label text-2 ps-3" for="vermoegensschadenhaft">
                                Vermögensschadenhaftpflicht
                                </label>
                                <div class="versicherung ps-3 pt-3">                                
                                    <input type="file" id="vermoegensschadenhaft-file" name="vermoegensschadenhaft-file" style="display: none;" value="<?php echo $viewdata['vermoegensschadenhaft-file'] ?>">
                                    <button class="form-control file-upload bold width-25 md:width-25" id="vermoegensschadenhaftButton">Datei-Upload</button>
                                    <span class="text-2 l-height-26 color-3" style="opacity:60%;font-size:14px;">Dateiformat: JPG, PNG oder PDF | max. Dateigröße: 5MB</span><br>
                                    <span class="text-2 l-height-26 color-3" style="opacity:80%;font-size:14px;">(Dieser Nachweis kann nachgereicht werden, ist aber für den Abschluss einer Mitgliedschaft Voraussetzung.)</span>
                                    <!-- <div id="errorVermoegensschadenhaft" style="color:red;font-size:15px;padding-top:3px;">
                                    </div>
                                    <div id="fileNameVermoegensschadenhaft" style="color:#0074C2;font-size:15px;padding-top:3px;">
                                    </div> -->
                                    <div class="text-2 l-height-26" id="errorVermoegensschadenhaft" style="color:red;font-size:16px;padding-top:3px;"></div>
                                    <div class="text-2 l-height-26" id="fileNameVermoegensschadenhaft" style="color:#0074C2;font-size:16px;padding-top:3px;"><?php echo $viewdata['fileNameVermoegensschaden'] ?></div>
                                    
                                    <input type="hidden" id='uploadOkVermoegensschaden' name="uploadOkVermoegensschaden" value="<?php echo $viewdata['uploadOkVermoegensschaden'] ?>">
                                    <input type="hidden" id='filePathVermoegensschaden' name="filePathVermoegensschaden" value="<?php echo $viewdata['filePathVermoegensschaden'] ?>">
                                    <input type="hidden" id='fileNameVermoegensschaden' name="fileNameVermoegensschaden" value="<?php echo $viewdata['fileNameVermoegensschaden'] ?>">
                                </div>
                            </div>                       
                            
                        </div>
                        <!-- <p><b>- Zutreffendes bitte ankreuzen –</b></p>
                        <div class="form-check pb-3">
                            <input type="checkbox" class="form-check-input" name="einwilligung" id="einwilligung" value="ja" <?php echo ($viewdata['einwilligung'] == 'ja') ? "checked" : "" ?>>
                            <div>
                                <label class="form-check-label text-2 ps-3" style="font-size: 14px;">
                                    Ich/Wir bin/sind damit einverstanden, dass die Daten (insbes. E-Mailadresse) für Newsletter genutzt werden, der/die auch Werbebanner enthalten können. Die Daten werden nicht an werbetreibende Dritte weitergegeben. Ich/Wir bin/sind damit einverstanden, dass meine Kontaktdaten (Name, Anschrift und E-Mailadresse, NICHT Telefonnummer) an werbetreibende Dritte weitergegeben werden, damit mich diese über interessante Angebote informieren können. Die Weitergabe ist auf Kooperationspartner des IVD (zuständiger Regionalverband und Bundesverband) beschränkt. Ich/wir bestätige/n gleichzeitig, dass ein von mir/uns eingereichtes Foto frei von Rechten Dritter ist und einer Veröffentlichung keine Urheber- oder Persönlichkeitsrechte entgegenstehen. Den IVD stelle ich im Falle etwaiger Rechtsansprüche Dritter diesbezüglich frei.<br>
                                    - Die Einwilligung(en) kann ich/können wir jederzeit widerrufen -
                                </label>
                                
                            </div>
                        </div> -->
                    </div>
                    <div><b>Hinweis:</b> Falls Sie noch keine Versicherung haben, wenden Sie sich gerne an Ihren Regionalverband </div>
                    <div class="danger-msg-page5" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                    <div class="success-msg-page5" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>
                    <div class="d-flex justify-content-between md:flex-direction mb-5 mt-5">
                        <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page4.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem;text-align:center;">Schritt zurück</a>
                        <button type="submit" class="btn-2 opacity-60" name="submit-page5" id="submit-page5">Weiter zu Schritt 6</button>
                    </div>
                <!-- </form> -->
            </div>
        </form>
    </div>
</section>

<?php
    include "includes/footer.php";
?>