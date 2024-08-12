<?php
    
    include "includes/header.php";
    ob_start();
    session_start();
    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }

    $viewdata = getDataPage4();   

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit-page4'])) {
            $_SESSION['PAGE4'] = $_POST;
            logFileInfo();
            header("Location:  mitgliedsantrag_page5.php");
            exit;
        }
    }

    function logFileInfo() {
        $info = "   Page4 =>  done..";
        file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);
                 
    }
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD</p>
    <div class="row">
        <p class="col-12 col-lg-9 text-2 color-3 l-height-26">Die Aufnahme in den Immobilienverband IVD erfolgt nach eingehender Prüfung. Mit den folgenden Erklärungen möchten wir sicherstellen, dass Sie die Zulassungsvoraussetzungen erfüllen.</p>
    </div>
    
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="prgress-bar-4 col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">4</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Erklärungen</p>
                <p class="text-2 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
        </div>
        
        <p class="heading-4 mt-5 mb-4">Ich erkläre hiermit für mich und mein Unternehmen, dass</p>
        <div class="antarg-detail4">
            <form action="" method="post" name="form-page4" id="form-page4">
                <div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="chk-all" id="chk-all" value="chk-all" <?php //echo ($viewdata['chk-all'] == 'chk-all') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-1">
                            Alles auf einmal auswählen
                        </label>
                    </div> <!-- -->
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-1" id="option-1" value="option-1" <?php echo ($viewdata['erklaerung-1'] == 'option-1') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-1">
                            die Vermögensverhältnisse geordnet sind. Der IVD behält sich vor, über den Aufnahmebewerber eine Wirtschaftsauskunft (z.B. Creditreform) einzuholen. Eine Abfrage bei der SCHUFA wird nicht durchgeführt.
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-2" id="option-2" value="option-2" <?php echo ($viewdata['erklaerung-2'] == 'option-2') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-2">
                            in den letzten zehn Jahren kein Insolvenzverfahren eröffnet worden ist, in den letzten fünf Jahren keine Vermögensauskunft abgegeben wurde, kein Haftbefehl zur Erzwingung einer solchen Versicherung erging und auch z. Zt. keine derartigen Verfahren anhängig sind,
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-3" id="option-3" value="option-3" <?php echo ($viewdata['erklaerung-3'] == 'option-3') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-3">
                            in den letzten zehn Jahren keine Verurteilung wegen eines Verbrechens und in den letzten fünf Jahren keine Verurteilung erfolgt ist und auch keine Strafverfahren oder staatsanwaltschaftlichen wegen eines Vergehens Ermittlungsverfahren anhängig sind,
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-4" id="option-4" value="option-4" <?php echo ($viewdata['erklaerung-4'] == 'option-4') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-4">
                            keine Untersagung eines Gewerbes ausgesprochen und kein solches Verfahren anhängig ist,
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-5" id="option-5" value="option-5" <?php echo ($viewdata['erklaerung-5'] == 'option-5') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-5">
                            alle in diesem Antrag gemachten Angaben der Wahrheit entsprechen,
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-6" id="option-6" value="option-6" <?php echo ($viewdata['erklaerung-6'] == 'option-6') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-6">
                            zurzeit und in Zukunft keine Mitarbeiter beschäftigt werden, denen in den letzten fünf Jahren das Gewerbe untersagt wurde,
                        </label>
                    </div><div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-7" id="option-7" value="option-7" <?php echo ($viewdata['erklaerung-7'] == 'option-7') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-7">
                            weder ich/wir, noch meine/unsere Firma, nach der Technologie von Ron L. Hubbard (Gründer der Scientologykirche) arbeiten und auch in Zukunft während meiner Zugehörigkeit zum IVD nicht arbeiten werden,
                        </label>
                    </div><div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-8" id="option-8" value="option-8" <?php echo ($viewdata['erklaerung-8'] == 'option-8') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-8">
                            weder ich noch meine Mitarbeiter nach der Technologie von Ron L. Hubbard geschult werden bzw. Kurse und/oder Seminare nach der Technologie von Ron L. Hubbard besuchen und zukünftig besuchen werden
                        </label>
                    </div><div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-9" id="option-9" value="option-9" <?php echo ($viewdata['erklaerung-9'] == 'option-9') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-9">
                            ich die Technologie von Ron L. Hubbard zur Führung eines Immobilienunternehmens ablehne,
                        </label>
                    </div><div class="form-check pb-3">
                        <input class="form-check-input" type="checkbox" name="erklaerung-10" id="option-10" value="option-10" <?php echo ($viewdata['erklaerung-10'] == 'option-10') ? "checked" : "" ?>>
                        <label class="form-check-label text-2 ps-3" for="option-10">
                            ich den Regionalverband unverzüglich selbst informieren werde, falls sich Änderungen im Hinblick auf meine Angaben ergeben sollten.
                        </label>
                    </div>
                </div>
                <div class="danger-msg-page4" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                <div class="success-msg-page4" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>
                <div class="d-flex justify-content-between  md:flex-direction mb-5 mt-5">
                    <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page3.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem;text-align:center;">Schritt zurück</a>
                    <button type="submit" class="btn-2 opacity-60" name="submit-page4" id="submit-page4" disabled>Weiter zu Schritt 5</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
    include "includes/footer.php";
?>