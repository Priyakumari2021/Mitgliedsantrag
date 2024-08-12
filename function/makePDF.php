<?php

function makePDF($antrag_page1, $antrag_page2, $antrag_page3, $antrag_page4, $antrag_page5, $antrag_page6) {
     $kontoDetail = $kontoDetail_text = "";
     $taetigkeit= "";
     //$ivdNordHtml = $ivdNordHtml2 = $ivdNord_plainText2 = $ivdNord_plainText = "";
     $fachkunde = getFachkunde($antrag_page1['fachkunde']);
     $fachkundeDatei = $antrag_page1['fileName'] == "" ? 'Nein' : 'Ja';     
     $taetigkeit = getTatigkeit($antrag_page2);
     $gewerbeAnmeldungDatei = $antrag_page2['fileNameGewerbeanmeldung'] == "" ? 'Nein' : 'Ja';

     $gewerbeErMakler = $antrag_page2['gewerbeerlaubnisMakler'] == "1" ? 'Ja' : 'Nein';
     $gewerbeErMaklerDatei = $antrag_page2['fileNameMakler'] == "" ? 'Nein' : 'Ja';

     $gewerbeErVerwalter = $antrag_page2['gewerbeerlaubnisVerwalter'] == "1" ? 'Ja' : 'Nein';
     $gewerbeErVerwalterDatei = $antrag_page2['fileNameVerwalter'] == "" ? 'Nein' : 'Ja';

     $handelsregister = $antrag_page2['handelsregister'] == "1" ? 'Ja' : 'Nein';
     $immoWirtschaftlich = $antrag_page2['immobilienwirtschaftlich'] == "1" ? 'Ja' : 'Nein';

     $bundesland = setCorrectChar($antrag_page1['bundesland']);
     $emailIdNachBundesland = getEmailId(strtolower($bundesland));              
     $bundesland = getCityName($antrag_page1['bundesland']);

     //$mitgliedschaft_typ = getMitgliedschaftType($antrag_page3['mitgliedschaft-typ']);
     $mitgliedschaft_art = getMitgliedschaftArt($antrag_page3['mitgliedschaft-art']);

     /* $betriebshaft_filename = ($antrag_page5['fileNameBetriebshaft'] !== "") ? ($antrag_page5['fileNameBetriebshaft']) : "--";
     $vermoegensschadenhaft_filename = ($antrag_page5['fileNameVermoegensschaden'] !== "") ? ($antrag_page5['fileNameVermoegensschaden']) : "--"; */

     $betriebshaft = $antrag_page5['betriebshaft'] == '1' ? 'Ja' : 'Nein';
     $betriebshaftDatei = $antrag_page5['fileNameBetriebshaft'] !== "" ? 'Ja' : 'Nein';
     $vermoegensschadenhaft = $antrag_page5['vermoegensschadenhaft'] == '1' ? 'Ja' : 'Nein';
     $vermoegensschadenhaftDatei = $antrag_page5['fileNameVermoegensschaden'] !== "" ? 'Ja' : 'Nein';

     $kontoDetail = ($antrag_page6['zahlunsart'] == 'sepa') ? 
                         '<tr>
                              <td>Kontoinhaber:</td>
                              <td>'.$antrag_page6['kontoinhaber'].'</td>                    
                         </tr>
                         <tr>
                              <td>Kreditinstitut:</td>
                              <td>'.$antrag_page6['kreditinstitut'].'</td>                    
                         </tr>
                         <tr>
                              <td>IBAN:</td>
                              <td>'.$antrag_page6['iban'].'</td>                    
                         </tr>' : ""; 

     $kontoDetail_text = ($antrag_page6['zahlunsart'] == 'sepa') ? 
                         '\n Kontoinhaber: ' . $antrag_page6['kontoinhaber'] . 
                         '\n Kreditinstitut: ' . $antrag_page6['kreditinstitut'] .
                         '\n IBAN: ' . $antrag_page6['iban'] : ""; 
                         
     $ivdNordHtml =      ($emailIdNachBundesland['verband'] == 'IVD Nord') ?
                         '<tr>
                              <td>Referenz 1:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Referenz 2:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Foto des Antragsteller:</td>
                              <td>Ja</td>
                         </tr>' : ''; 

     $ivdNord_plainText =  ($emailIdNachBundesland['verband'] == 'IVD Nord') ?
                         '\n Referenz 1: Ja 
                          \n Referenz 2: Ja
                          \n Foto des Antragsteller: Ja' : "";  
                          
     $ivdNordHtml2 =      ($emailIdNachBundesland['verband'] == 'IVD Nord') ?
                         '<tr>
                              <td><h4>Privataddresse</h4></td>
                         </tr>
                         <tr>
                              <td>Straße & Haus-Nr.:</td>
                              <td>' . $antrag_page1['p-strasse'] . '</td>
                         </tr>
                         <tr>
                              <td>PLZ:</td>
                              <td>' . $antrag_page1['p-plz'] . '</td>
                         </tr>
                         <tr>
                              <td>Ort:</td>
                              <td>' . $antrag_page1['p-ort'] . '</td>
                         </tr>' : ""; 
 
      $ivdNord_plainText2 =  ($emailIdNachBundesland['verband'] == 'IVD Nord') ?
                          '\n Straße & Haus-Nr.: ' . $antrag_page1['p-strasse'] . 
                          '\n PLZ: ' . $antrag_page1['p-plz'] .
                          '\n Ort: ' . $antrag_page1['p-ort'] : "";;

     
     $html =   "<span style='font-size:18px;'><b>Übersicht</b></span><br>
                <table style='border:1px solid;'>
                    <tr>
                         <td><h4>Persönliche Daten</h4></td>
                         <td><h4></h4></td>
                    </tr>
                    <tr>
                         <td>Vorname: </td>
                         <td>" . $antrag_page1['p-firstname'] . "</td>
                    </tr>
                    <tr>
                         <td>Nachname</td>
                         <td>" . $antrag_page1['p-lastname'] . "</td>
                    </tr>
                    <tr>
                         <td>Geburtsdatum</td>
                         <td>" . $antrag_page1['p-birthdate'] . "</td>
                    </tr>
                    <tr>
                         <td>E-Mail</td>
                         <td>" . $antrag_page1['p-email'] . "</td>
                    </tr>
                    <tr>
                         <td>Telefon</td>
                         <td>" . $antrag_page1['p-telefon'] . "</td>
                    </tr>
                    <tr>
                         <td>Fachkunde</td>
                         <td>" . $fachkunde . "</td>
                    </tr>
                    <tr>
                         <td>Fachkunde Datei</td>
                         <td>" . $fachkundeDatei . "</td>
                    </tr>
                    <tr>
                         <td><h4>Firmendaten</h4></td>
                    </tr>
                    <tr>
                         <td>Firmenname</td>
                         <td>" . $antrag_page1['firmaname'] . "</td>
                    </tr>
                    <tr>
                         <td>Straße & Haus-Nr.</td>
                         <td>" . $antrag_page1['f-strasse'] . "</td>
                    </tr>
                    <tr>
                         <td>PLZ</td>
                         <td>" . $antrag_page1['f-plz'] . "</td>
                    </tr>
                    <tr>
                         <td>Ort</td>
                         <td>" . $antrag_page1['f-ort'] . "</td>
                    </tr>
                    <tr>
                         <td>E-Mail: </td>
                         <td>" . $antrag_page1['f-email'] . "</td>
                    </tr>
                    <tr>
                         <td>Telefon</td>
                         <td>" . $antrag_page1['f-telefon'] . "</td>
                    </tr>
                    <tr>
                         <td>Website</td>
                         <td>" . $antrag_page1['f-website'] . "</td>
                    </tr>
                    <tr>
                         <td>Jahr der Gründung</td>
                         <td>" . $antrag_page2['gruendung-jahr'] . "</td>
                    </tr>
                    <tr>
                         <td>Anzahl der Mitarbeiter:</td>
                         <td>" . $antrag_page2['mitarbeiter-anzahl'] . "</td>
                    </tr>
                    <tr>
                         <td>Anzahl weiterer Filialen:</td>
                         <td>" . $antrag_page2['filiale-anzahl'] . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeanmeldung:</td>
                         <td>" . $antrag_page2['gewerbeanmeldung-datum'] . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeanmeldung Datei:</td>
                         <td>" . $gewerbeAnmeldungDatei ."</td>
                    </tr>" 

                    . $ivdNordHtml2 . 

                    "
                    <tr>
                         <td><h4>Gewerbeerlaubnis</h4></td>
                         <td><h4></h4></td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Makler:</td>
                         <td>" . $gewerbeErMakler . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Makler Datei</td>
                         <td>" . $gewerbeErMaklerDatei . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
                         <td>" . $gewerbeErVerwalter . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Verwalter Datei</td>
                         <td>" . $gewerbeErVerwalterDatei . "</td>
                    </tr>
                    <tr>
                         <td>Eintrag ins Handelsregister:</td>
                         <td>" . $handelsregister . "</td>
                    </tr>
                    <tr>
                         <td>Bilden Sie immobilienwirtschaftlich aus?</td>
                         <td>" . $immoWirtschaftlich . "</td>
                    </tr>
                    
                    <tr>
                         <td><h4>Angaben der Schwerpunkte des Unternehmens</h4></td>
                    </tr>
                    <tr>
                         <td>Ausgeübte Tätigkeitsfelder:</td>
                         <td>" . $taetigkeit . "</td>
                    </tr>
                    <tr>
                         <td>Regionalverband:</td>
                         <td>" . $emailIdNachBundesland['verband'] . "</td>
                    </tr>
                    <tr>
                         <td>Art der Mitgliedschaft:</td>
                         <td>" . $mitgliedschaft_art . "</td>
                    </tr>
                    <tr>
                         <td>Aufnahmegebühr:</td>
                         <td>" . $antrag_page3['aufnahme-gebuehr'] . "</td>
                    </tr>
                    <tr>
                         <td>Jahresgebühr:</td>
                         <td>" . $antrag_page3['jahres-gebuehr'] . "</td>
                    </tr>
                    <tr>
                         <td>Beginn der Mitgliedschaft:</td>
                         <td>" . $antrag_page3['mitgliedschaft-beginn'] . "</td>
                    </tr>" . $ivdNordHtml . "
                    <tr>
                         <td>Erklärung:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td><h4>Regularien, Datenschutz, Versicherungen</h4></td>
                    </tr>
                    <tr>
                         <td>Kenntnissnahme Dokumente:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td>Betriebshaftpflicht:</td>
                         <td>". $betriebshaft . "</td>
                    </tr>
                    <tr>
                         <td>Betriebshaftpflicht Datei:</td>
                         <td>". $betriebshaftDatei . "</td>
                    </tr>
                    <tr>
                         <td>Vermögensschadenhaftpflicht:</td>
                         <td>" . $vermoegensschadenhaft ."</td>
                    </tr>
                    <tr>
                         <td>Vermögensschadenhaftpflicht Datei:</td>
                         <td>" . $vermoegensschadenhaftDatei . "</td>
                    </tr>
                    <tr>
                         <td><h4>Zahlung Angabe</h4></td>
                    </tr>
                    <tr>
                         <td>Zahlungsart:</td>
                         <td>" . ucfirst($antrag_page6['zahlunsart']) . "</td>
                    </tr>" . $kontoDetail . "
                </table>"            
                ;
     $plainText = 'Übersicht \n\n     
                    Vorname: ' . $antrag_page1['p-firstname'] . '\n
                    Nachname: '. $antrag_page1['p-lastname'] . '\n
                    Geburtsdatum: ' . $antrag_page1['p-birthdate'] . '\n
                    E-Mail: '  . $antrag_page1['p-email'] . '\n
                    Telefon: ' . $antrag_page1['p-telefon'] . '\n
                    Fachkunde: ' . $fachkunde . '\n
                    Fachkunde Datei: Ja \n 
                    Firmenname: ' . $antrag_page1['firmaname'] . '\n
                    Straße & Haus-Nr.: ' . $antrag_page1['f-strasse'] . '\n
                    PLZ: ' . $antrag_page1['f-plz'] . '\n
                    Ort: ' . $antrag_page1['f-ort'] . '\n
                    E-Mail: ' . $antrag_page1['f-email'] . '\n
                    Telefon: ' . $antrag_page1['f-telefon'] . '\n
                    Website: ' . $antrag_page1['f-website'] . '\n
                    Jahr der Gründung: ' . $antrag_page2['gruendung-jahr'] . '\n
                    Anzahl der Mitarbeiter: ' . $antrag_page2['mitarbeiter-anzahl'] . '\n
                    Anzahl weiterer Filialen: ' . $antrag_page2['filiale-anzahl'] . '\n
                    Gewerbeanmeldung: ' . $antrag_page2['gewerbeanmeldung-datum'] . '\n
                    Gewerbeanmeldung Datei: Ja 
                    ' . $ivdNord_plainText2 .'
                    Gewerbeerlaubnis nach §34 c Makler: ' . $gewerbeErMakler . '\n
                    Gewerbeerlaubnis nach §34 c Makler Datei: ' . $gewerbeErMaklerDatei . '\n
                    Gewerbeerlaubnis nach §34 c Verwalter: ' . $gewerbeErVerwalter . '\n
                    Gewerbeerlaubnis nach §34 c Verwalter Datei: ' . $gewerbeErVerwalterDatei . '\n
                    Eintrag ins Handelsregister: ' . $handelsregister . '\n
                    Bilden Sie immobilienwirtschaftlich aus?' . $immoWirtschaftlich . '\n\n
                     
                    Angaben der Schwerpunkte des Unternehmens \n\n

                    Ausgeübte Tätigkeitsfelder: ' . $taetigkeit . '\n
                    Bundesland: ' . $bundesland . '\n
                    Art der Mitgliedschaft: ' . $mitgliedschaft_art . '\n
                    Aufnahmegebühr: ' . $antrag_page3['aufnahme-gebuehr'] . '\n
                    Jahresgebühr: ' . $antrag_page3['jahres-gebuehr'] . '\n
                    Beginn der Mitgliedschaft: ' . $antrag_page3['mitgliedschaft-beginn'] . '\n
                    ' . $ivdNord_plainText  . '
                    Erklärung: Ja \n\n

                    Regularien, Datenschutz, Versicherungen \n\n

                    Kenntnissnahme Dokumente: Ja \n
                    Betriebshaftpflicht: ' . $betriebshaft . '\n
                    Betriebshaftpflicht Datei: ' . $betriebshaft . '\n
                    Vermögensschadenhaftpflicht: Ja \n
                    Vermögensschadenhaftpflicht Datei: Ja \n\n

                    Zahlung Angabe \n\n 

                    Zahlungsart: ' . ucfirst($antrag_page6['zahlunsart']) . '\n' . $kontoDetail_text ;

     //echo $html;
     return array('htmlInfo' => $html, 'plainTextInfo' => $plainText);
}
 
/* function testPdf() {
     $testInfo =  "<div style='font-size:28px;text-align:center;'><span><b>Übersicht</b></span></div><br>
                    <table style='border-style:solid;margin-left:auto;margin-right:auto;'>
                         <tr>
                              <td>Vorname: </td>
                              <td>p-firstname</td>
                         </tr>
                         <tr>
                              <td>Nachname</td>
                              <td>p-lastname</td>
                         </tr>
                         <tr>
                              <td>Geburtsdatum</td>
                              <td>p-birthdate']</td>
                         </tr>
                         <tr>
                              <td>E-Mail</td>
                              <td>p-email</td>
                         </tr>
                         <tr>
                              <td>Telefon</td>
                              <td>p-telefon</td>
                         </tr>
                         <tr>
                              <td>Fachkunde</td>
                              <td>fachkunde</td>
                         </tr>
                         <tr>
                              <td>Fachkunde Datei</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Firmenname</td>
                              <td>firmaname</td>
                         </tr>
                         <tr>
                              <td>Straße & Haus-Nr.</td>
                              <td>f-strasse</td>
                         </tr>
                         <tr>
                              <td>PLZ</td>
                              <td>f-plz</td>
                         </tr>
                         <tr>
                              <td>Ort</td>
                              <td>f-ort</td>
                         </tr>
                         <tr>
                              <td>E-Mail: </td>
                              <td>f-email</td>
                         </tr>
                         <tr>
                              <td>Telefon</td>
                              <td>f-telefon</td>
                         </tr>
                         <tr>
                              <td>Website</td>
                              <td>f-website</td>
                         </tr>
                         <tr>
                              <td>Jahr der Gründung</td>
                              <td>gruendung-jahr</td>
                         </tr>
                         <tr>
                              <td>Anzahl der Mitarbeiter:</td>
                              <td>mitarbeiter-anzahl</td>
                         </tr>
                         <tr>
                              <td>Anzahl weiterer Filialen:</td>
                              <td>filiale-anzahl</td>
                         </tr>
                         <tr>
                              <td>Gewerbeanmeldung:</td>
                              <td>gewerbeanmeldung-datum</td>
                         </tr>
                         <tr>
                              <td>Gewerbeanmeldung Datei:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Gewerbeerlaubnis nach §34 c Makler:</td>
                              <td>gewerbeErMakler</td>
                         </tr>
                         <tr>
                              <td>Gewerbeerlaubnis nach §34 c Makler Datei</td>
                              <td>gewerbeErMaklerDatei</td>
                         </tr>
                         <tr>
                              <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
                              <td>gewerbeErVerwalter</td>
                         </tr>
                         <tr>
                              <td>Gewerbeerlaubnis nach §34 c Verwalter Datei</td>
                              <td>gewerbeErVerwalterDatei</td>
                         </tr>
                         <tr>
                              <td>Eintrag ins Handelsregister:</td>
                              <td>handelsregister</td>
                         </tr>
                         <tr>
                              <td>Bilden Sie immobilienwirtschaftlich aus?</td>
                              <td>immoWirtschaftlich</td>
                         </tr>
                         <tr>
                              <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
                              <td>gewerbeErVerwalter</td>
                         </tr>
                    </table>
                    <br>
                    <table style='border-style:solid;margin-left:auto;margin-right:auto;'>
                         <th>Angaben der Schwerpunkte des Unternehmens</th>
                         <tr>
                              <td>Ausgeübte Tätigkeitsfelder:</td>
                              <td>taetigkeit</td>
                         </tr>
                         <tr>
                              <td>Bundesland:</td>
                              <td>bundesland</td>
                         </tr>
                         <tr>
                              <td>Typ der Mitgliedschaft:</td>
                              <td>mitgliedschaft_typ</td>
                         </tr>
                         <tr>
                              <td>Art der Mitgliedschaft:</td>
                              <td>mitgliedschaft_art</td>
                         </tr>
                         <tr>
                              <td>Beginn der Mitgliedschaft:</td>
                              <td>antrag_page3['mitgliedschaft-beginn</td>
                         </tr>
                         <tr>
                              <td>Erklärung:</td>
                              <td>Ja</td>
                         </tr>
                              <th>Regularien, Datenschutz, Versicherungen</th>
                         
                         <tr>
                              <td>Kenntnissnahme Dokumente:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Betriebshaftpflicht:</td>
                              <td>betriebshaft</td>
                         </tr>
                         <tr>
                              <td>Betriebshaftpflicht Datei:</td>
                              <td>betriebshaft</td>
                         </tr>
                         <tr>
                              <td>Vermögensschadenhaftpflicht:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Vermögensschadenhaftpflicht Datei:</td>
                              <td>Ja</td>
                         </tr>

                         <tr>
                         </tr>

                         <tr>
                              <td>Zahlungsart:</td>
                              <td>zahlunsart</td>
                         </tr>
                    </table>";
                    echo $testInfo;
}
testPdf(); */
     





?>

<style>
     table {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          font-weight: 600;
     }
     td{
          padding-top: 10px;
          padding-bottom: 20px;
          padding-left: 30px;
          padding-right: 40px;
          font-size:1.5rem; 
     }
</style>