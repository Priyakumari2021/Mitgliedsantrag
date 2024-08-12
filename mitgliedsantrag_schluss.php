<?php
    include "includes/header.php";
?>
<section class="section-1">
    <p class="heading-1">IVD Mitglied werden</p>
    <p class="heading-2">Ihr digitaler Antrag zur Aufnahme in den IVD</p>
    <div class="row">
        <p class="col-12 col-lg-9 body-text-1">Vielen Dank!</p>
    </div>
</section>
<section class="bg-main">
    <div class="section-2">
        <div class="row md:justify-center">
            <div class="antrag-complete col-12 col-md-12 col-lg-4 md:me-3 lg:me-3" style="position:relative;">
                <span class="heading-4" style="position: absolute;right: 33%;bottom: 31%;color: #FFFFFF;">&#x2713;</span>
            </div>
            <div class="col-12 col-md-12 col-lg-8 md:ms-3 lg:ms-3">
                <p class="heading-3">Vielen Dank für Ihren Antrag!</p>
                <p class="text-2 l-height-26 color-3">Vielen Dank für Ihren Antrag. Der zuständige Regionalverband wird die Unterlagen nun prüfen und sich mit Ihnen in Verbindung setzen. Die Mitgliedschaft wird erst begründet, wenn der zuständige Regionalverband dem Antrag zustimmt und der Bundesverband dem Antrag nicht widerspricht.

                Sie werden in Kürze von Ihrem zuständigen IVD Regionalverband kontaktiert. Sollten Sie weiter Fragen haben, können Sie uns jederzeit über unsere Webseite https://www.ivd.net kontaktieren. 

                    <br><br>Ihr Team vom Immobilienverband Deutschland e.V.</p>
            </div>
        </div>
        
        <div class="">
            <form onload="stopBack();">
                
                <div class="flex flex-row mb-5 mt-5 antrag-schluss">
                    <a class="btn-2 md:me-3 lg:me-3 bold md:display-block" href="mitgliedsantrag_page1.php" style="text-decoration: none;font-family: 'Rubrik', sans-serif;text-align: center;border:2px solid #002D62;">Zur Startseite</a>
                    <a class="btn-2 file-upload bold md:mt-4 md:display-block" href="mitgliedsantrag.php" style="text-decoration: none;text-align: center;">Zur Kontaktanfrage</a>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    history.pushState(null, null, null);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, null);
    });
</script>

<?php
    include "includes/footer.php";
?>