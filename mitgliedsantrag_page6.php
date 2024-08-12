<?php
    include "includes/header.php";
    ob_start();
    session_start();
    
    if($_SESSION == NULL) {
        header("Location:  mitgliedsantrag_schluss.php");
        exit;
    }
    
    $viewdata = getDataPage6();

    // var_dump($viewdata);
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['submit-page6'])) {
            //var_dump($_POST);
            $_SESSION['PAGE6'] = $_POST;
            logFileInfo($_SESSION['PAGE6']);
            header("Location:  mitgliedsantrag_uebersicht.php");
            exit;
        }
    }

    function logFileInfo($postData) {
        $info = "   Page6 =>  Zahlungsart: "  . $postData['zahlunsart'];
        file_put_contents('./Log/log_'.date("j.n.Y") . '.txt', $info . PHP_EOL , FILE_APPEND);                 
    }
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD </p><!-- 
    <div class="row">
        <p class="col-12 col-lg-9 text-2 color-3 l-height-26">Eine IVD-Mitgliedschaft kostet im Schnitt 67 Euro und beginnt ab 5 Euro pro Monat.</p>
    </div> -->
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="prgress-bar-6 col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 40%;bottom: 31%;">6</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Beitrag</p>
                <p class="text-2 color-3" style="opacity:0.6;">Alle Felder sind Pflichtfelder, wenn nicht anders angegeben.</p>
            </div>
            <p class="color-1 mt-5 h-5">Der Mitgliedsbeitrag wird pro Kalenderjahr erhoben, die Rechnungsstellung erfolgt Anfang des Jahres. Der Mitgliedsbeitrag ist innerhalb von 4 Wochen zur Zahlung fällig.
                <br><br>Mitgliedern, die am Lastschriftverfahren teilnehmen, wird der Beitrag in vier Teilen jeweils zur Quartalsmitte eingezogen.
                
                <br><br>Bei unterjährigem Beitritt wird der Mitgliedsbeitrag anteilig nach Monaten berechnet. Bei Teilnahme am Lastschriftverfahren wird die Aufnahmegebühr mit der ersten Lastschrift eingezogen..</p>
        </div>
        
        <p class="heading-4 mt-5 mb-4">Zahlungsarten</p>
        <div class="antrag-detals6">
            <form action="" method="post" name="form-page6" id="form-page6">
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="rechnung">Bitte wählen Sie eine Zahlungsart*</label>
                    <div class="col-12 col-md-8 col-lg-8"><div class="form-check">
                        <input class="form-check-input" type="radio"  name="zahlunsart" id="rechnung" value="rechnung" <?php echo ($viewdata['zahlunsart'] == 'rechnung') ? "checked" : "" ?> >
                        <label class="form-check-label text-2" for="flexRadioDefault1">
                            Ich überweise den kompletten Beitrag jährlich nach Rechnungsstellung.
                        </label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="zahlunsart" id="sepa" value="sepa" <?php echo ($viewdata['zahlunsart'] == 'sepa') ? "checked" : "" ?> >
                        <label class="form-check-label text-2" for="sepa">
                            Ich nehme am SEPA Lastschriftverfahren teil.
                        </label>
                    </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="kontoinhaber">Kontoinhaber*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="kontoinhaber" name="kontoinhaber" class="form-control txt-box text-3" placeholder="Vor- und Nachname" value="<?php echo $viewdata['kontoinhaber'] ?>" <?php echo ($viewdata['zahlunsart'] == 'rechnung') ? "disabled='true'" : "" ?> >
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="kreditinstitut">Kreditinstitut*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="kreditinstitut" name="kreditinstitut" class="form-control txt-box text-3" placeholder="Name Ihrer Bank" value="<?php echo $viewdata['kreditinstitut'] ?>" <?php echo ($viewdata['zahlunsart'] == 'rechnung') ? "disabled='true'" : "" ?> >
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-12 col-md-4 col-lg-4 col-form-label heading-1" for="iban">IBAN*</label>
                    <div class="col-12 col-md-8 col-lg-8">
                        <input type="text" id="iban" name="iban" class="form-control txt-box text-3" placeholder="DEXXXXXXXXXXXXXXXXXXXX" value="<?php echo $viewdata['iban'] ?>" <?php echo ($viewdata['zahlunsart'] == 'rechnung') ? "disabled='true'" : "" ?> >
                        <div id="ibanError" style="color:red;font-size:15px;padding-top:3px;"></div>
                        <input type="hidden" name="chkIban" id="chkIban" value="<?php echo $viewdata['chkIban'] ?>"/>
                    </div>

                </div>
                <div><span><b>Hinweis:</b> Die Mitgliedschaft kommt erst zustande, wenn der Antrag durch den Regionalverband bestätigt wurde.</span></div><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="zahlungRegeln" name="zahlungRegeln" value="1" <?php echo ($viewdata['zahlungRegeln'] == '1') ? "checked" : "" ?> <?php echo ($viewdata['zahlunsart'] == 'rechnung') ? "disabled='true'" : "" ?>>
                    <label class="form-check-label text-2 ps-3 l-height-1" for="zahlungRegeln">
                    *Ich ermächtige den IVD Regionalverband, Zahlungen von meinem Konto mittels Lastschrift einzuziehen. Zugleich weise ich mein Kreditinstitut an, die von dem IVD Regionalverband auf mein Konto gezogenen Lastschriften einzulösen.<br>
<b>Hinweis:</b> Ich kann innerhalb von 8 Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrags verlangen. Es gelten dabei die mit meinem Kreditinstitut vereinbarten Bedingungen.
                    </label>
                </div>
                <div class="danger-msg-page6" role="alert" style="color: #842029;margin-top:0.5rem;font-size:16px;"></div>
                <div class="success-msg-page6" role="alert" style="color: #1b925a;margin-top:0.5rem;font-size:16px;"></div>
                <div class="d-flex justify-content-between md:flex-direction mb-5 mt-5">
                    <a class="md:me-3 lg:me-3" href="mitgliedsantrag_page5.php" style="font-size: 20px;color:#0074C2;padding:0.6rem 0.8rem;text-align:center;">Schritt zurück</a>
                    <button type="submit" class="btn-2 opacity-60" name="submit-page6" id="submit-page6" disabled="true">Zur Übersicht</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
    include "includes/footer.php";
?>