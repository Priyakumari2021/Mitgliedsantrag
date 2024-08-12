
// check input value if name has number
function checkInput() {
    var pattern = /^[a-zA-Z- ]*$/;///^[a-z]+$/i;
    let input = pattern.test(this.value);

    const parentDiv = document.getElementById("errorName");

    const span = document.createElement("span");
    span.classList.add('danger-msg-page1');
    span.setAttribute("style", "color: #842029;margin-top:0.3rem;font-size:12px;");
    span.setAttribute("role", "alert");
    span.setAttribute("id", "error");
    span.innerText = "Sonderzeichen ist nicht erlaubt";

    if(input == false) {
        this.focus();
        this.style.borderColor = 'red';
        if(parentDiv.hasChildNodes()) {
            parentDiv.removeChild(document.getElementById("error"));
        }  
        else{
            parentDiv.appendChild(span);
        }
    } else {
        this.style.borderColor = '#CCD5E0';
        if(parentDiv.hasChildNodes()) {
            parentDiv.removeChild(document.getElementById("error"));
        }
    }
}


// Form Validation for all input Form Page 2
function validateForm2(submitButton, inputs, checkBoxes, gewerbeMakler, inputs_hidden1, inputs_hidden2, msg_d, msg_s) {
    let inputval = true;
    let checked = false;
    for(let i = 0; i < inputs.length; i++){
        
        if(!inputs[i].value) {
            console.log(inputs[i].name + " " + inputs[i].value);
            inputval = false; // Validation failed
            console.log(inputval);
            //inputs[i].style.borderColor = 'red';
        } else {
            console.log(inputval);
            //inputs[i].style.borderColor = '#CCD5E0';
        }
    }
    checkBoxes.forEach(element => {
        //console.log(element.name + " " + element.checked);
        (element.checked == true) ? checked = true : unchecked = true;
        if( (element.name == 'sonstige') && (element.checked == true) ) {
             $('#sonstige_taetigkeit').prop('disabled', false);
            if(document.getElementById('sonstige_taetigkeit').value == "") {
                checked = false;
            } else {
                checked = true;
            }
        }        
    });
    /* if(sonstige_taetigkeit) {
        sonstige_taetigkeit.addEventListener('input', function(e) {
            console.log('hello');
            checked = true;
        })
    } */


    /* if(gewerbeMakler[1].checked) {
        inputs_hidden1.forEach(element => {
            //console.log(element.name + " " + element.value);
            if(!element.value) {
                inputval = false;    
            }
        })
    }
    if(gewerbeMakler[3].checked) {
        inputs_hidden2.forEach(element => {
            //console.log(element.name + " " + element.value);
            if(!element.value) {
                inputval = false; // Validation failed
            }
        })
    } */

    const isValid = inputval && checked;
    if(isValid) {
        submitButton.classList.remove('opacity-60'); 
        submitButton.classList.add('opacity-100');
        msg_d.innerHTML = "";
        msg_s.innerHTML = "Sie haben alle Felder ausgefüllt. Super!";
    } else {
        submitButton.classList.remove('opacity-100'); 
        submitButton.classList.add('opacity-60');
        msg_s.innerHTML = "";
        msg_d.innerHTML = "* Alle Felder sind Pflichtfelder!";
    }
    submitButton.disabled = !isValid;

}

// --- Form Validation for all input Form Page 5 ---
function validateForm5(inputs) {
    //console.log(inputs);
    for(let i = 0; i < inputs.length; i++){
        if(inputs[i].type == 'checkbox') {
            console.log(inputs[i].name + " " + inputs[i].checked);
            if(!inputs[i].checked) {
                return false; // Validation failed
            }
        } /* else if(inputs[i].type == 'hidden') {
            if(inputs[i].name == 'fileNameBetriebshaft' && document.getElementById('betriebshaft').checked){
                if(!inputs[i].value) {
                    return false; // Validation failed
                }
            }
            if(inputs[i].name == 'fileNameVermoegensschaden' && 
                document.getElementById('vermoegensschadenhaft').checked) {
                    if(!inputs[i].value) {
                        return false; // Validation failed
                    }
            }
            else if(inputs[i].name != 'fileNameBetriebshaft') {
                if(!inputs[i].value) {
                    return false; // Validation failed
                } 
            
            console.log(inputs[i].name + " " + inputs[i].value);
                
        } else {            
            console.log(inputs[i].name + " " + inputs[i].value);
            if(!inputs[i].value) {
                return false; // Validation failed
            }
        }*/
    }

    return true; //All validation Passed
}

// --- Form Validation for Page 1, 3, 4 ---
function validateForm(inputs) {
    //console.log(inputs);
    for(let i = 0; i < inputs.length; i++){
        if(inputs[i].type == 'checkbox') {
            //console.log(inputs[i].name + " " + inputs[i].checked);
            if(!inputs[i].checked) {
                return false; // Validation failed
            }
        } else if(inputs[i].type == 'hidden') {
            console.log(inputs[i].name + " " + inputs[i].value);
            if(!inputs[i].value) {
                return false; // Validation failed
            }
        } else {            
            console.log(inputs[i].name + " " + inputs[i].value);
            if(inputs[i].name == 'bundesland') continue;
            if(!inputs[i].value) {
                return false; // Validation failed
            }
        }
    }

    return true; //All validation Passed
}

// --- Form Validation for all input Form Page 6 ---
function validateForm6(inputs, zahlungsRegln, zahlungsart) {
    //console.log(inputs);
    for(let i = 0; i < inputs.length; i++){
        if(zahlungsart[1].checked) {
            //console.log(inputs[i].name + " " + inputs[i].value);
            if(!inputs[i].value) {
                return false; // Validation failed
            }
        }
    }
    if(!zahlungsRegln.checked && !zahlungsart[1].checked) {
        return true; // Validation failed
    } else if(!zahlungsRegln.checked && !zahlungsart[0].checked){
        return false;
    }

    return true; //All validation Passed
} /* */


// Check uploaded file is valid or not client side
let fileType = ["application/pdf","application/msword","image/jpeg","image/jpg","image/png"];
function isValidFile(file, fileIndex = 0) {
    if(fileIndex == 1) { fileType = ["image/jpeg","image/jpg","image/png"]; }
    if(file.size > 5242880 || !fileType.includes(file.type)) {
        return false;
    }
    return true;
}


// Enable/disable submit button based on validation status
function updateSubmitBtn(submitBtn, inputs, msg_d, msg_s) {

    let chkForm = validateForm(inputs);
    console.log(chkForm);
    if(chkForm) {
        submitBtn.classList.remove('opacity-60'); 
        submitBtn.classList.add('opacity-100');
        msg_d.innerHTML = "";
        msg_s.innerHTML = "Sie haben alle Felder ausgefüllt. Super!";
    } else {
        submitBtn.classList.remove('opacity-100'); 
        submitBtn.classList.add('opacity-60');
        msg_s.innerHTML = "";
        msg_d.innerHTML = "* Alle Felder sind Pflichtfelder!";
    }
    submitBtn.disabled = !validateForm(inputs);
}

// Enable/disable submit button based on validation status
function updateSubmitBtn5(submitBtn, inputs, msg_d, msg_s) {

    let chkForm = validateForm5(inputs);
    console.log(chkForm);
    if(chkForm) {
        submitBtn.classList.remove('opacity-60'); 
        submitBtn.classList.add('opacity-100');
        msg_d.innerHTML = "";
        msg_s.innerHTML = "Sie haben alle Felder ausgefüllt. Super!";
    } else {
        submitBtn.classList.remove('opacity-100'); 
        submitBtn.classList.add('opacity-60');
        msg_s.innerHTML = "";
        msg_d.innerHTML = "* Alle Felder sind Pflichtfelder!";
    }
    submitBtn.disabled = !validateForm5(inputs);
}

// get Data using Ajax
function file_upload(fileObj, fileTyp, error, file_info, chkOk, file_path, file_name, extension_typ = 0) {
    if(fileObj != undefined) {
        var form_data = new FormData();
        form_data.append('file', fileObj);
        form_data.append('fileTyp', fileTyp)
        form_data.append('extensionTyp', extension_typ);

        $.ajax({
            type: 'POST',
            url:  "js/ajax/ajax.php",
            fileTyp: fileTyp,
            extensionTyp: extension_typ,
            contentType: false,
            processData: false,
            data: form_data,
            error: function(ts) {
                alert('Es gibt etwas Problem: ' + ts.responseText);
            },
            success: function(response){
                console.log(response);
                if(!response) {
                    console.log('error');
                    error.innerHTML= 'File ist nicht in der richtige Format';
                } else {
                    var fileInfo = JSON.parse(response);                
                    //console.log(fileInfo);
                    if(fileInfo[0].errorImageUpload != ""){
                        chkOk.value = "0";
                        error.innerHTML= fileInfo[0].errorImageUpload;
                        file_info.innerHTML = "";
                    }else {
                        chkOk.value = "1";
                        file_info.innerHTML = fileInfo[0].fileName;
                        error.innerHTML = "";
                    }
                    file_path.value = fileInfo[0].filePath;
                    file_name.value = fileInfo[0].fileName;                    

                    console.log(fileInfo);
                }
                
            }
        });
    } else {
        console.log('please select file..')
    }
}


// get Preis according to verband and MitgliedschaftArt
function getNettoPreis(verband, mitgliedshaf_art, plz) {
    let netto_preis = {};
    let rhein_main_plz = [35, 60, 61, 63, 64, 65, 68, 69, 55252, 55246];
    let getPlz = gettwoDigitFromPlz(plz);
    //console.log(getPlz);
    let isPlzExist = rhein_main_plz.includes(getPlz);
    let aufnahmegebuehr, jahresgebuehr=0;
    if(mitgliedshaf_art == "ordentlich-mitglied") {
        switch(verband) {
            case "IVD Berlin-Brandenburg":
                aufnahmegebuehr = '250,00';
                jahresgebuehr = '1.000,00';
                break;
            case 'IVD Mitte': 
                if(isPlzExist == false) {
                    aufnahmegebuehr = '500,00';
                    jahresgebuehr = '990,00';
                } else {
                    aufnahmegebuehr = '500,00';
                    jahresgebuehr = '1.090,00';
                }                
                break;
            case 'IVD Nord': 
                aufnahmegebuehr = '500,00';
                jahresgebuehr = '1.000,00';
                break;
            case "IVD West":
                aufnahmegebuehr = '810,00';
                jahresgebuehr = '850,00';
                break;
            case 'IVD Mitte Ost': 
                aufnahmegebuehr = '350,00';
                jahresgebuehr = '1.080,00';
                break;
            case 'IVD Süd':
            case 'IVD Süd BW': 
                aufnahmegebuehr = '250,00';
                jahresgebuehr = '1.080,00';
                break;
        }
    }
    else if(mitgliedshaf_art == "erstes-Jahr") {
        switch(verband) {
            case "IVD Berlin-Brandenburg":
                aufnahmegebuehr = '150,00';
                jahresgebuehr = '500,00';
                break;
            case 'IVD Mitte': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '570,00';
                break;
            case 'IVD Nord': 
                aufnahmegebuehr = '500,00';
                jahresgebuehr = '500,00';
                break;
            case "IVD West":
                aufnahmegebuehr = '405,00';
                jahresgebuehr = '425,00';
                break;
            case 'IVD Mitte Ost': 
                aufnahmegebuehr = '150,00';
                jahresgebuehr = '720,00';
                break;
            case 'IVD Süd':
            case 'IVD Süd BW': 
                aufnahmegebuehr = '250,00';
                jahresgebuehr = '540,00';
                break;
        }

    }
    else if(mitgliedshaf_art == "zweites-Jahr") {
        switch(verband) {
            case "IVD Berlin-Brandenburg":
                aufnahmegebuehr = '150,00';
                jahresgebuehr = '750,00';
                break;
            case 'IVD Mitte': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '570,00';
                break;
            case 'IVD Nord': 
                aufnahmegebuehr = '500,00';
                jahresgebuehr = '750,00';
                break;
            case "IVD West":
                aufnahmegebuehr = '405,00';
                jahresgebuehr = '637,50';
                break;
            case 'IVD Mitte Ost': 
                aufnahmegebuehr = '150,00';
                jahresgebuehr = '810,00';
                break;
            case 'IVD Süd':
            case 'IVD Süd BW': 
                aufnahmegebuehr = '250,00';
                jahresgebuehr = '800,00';
                break;
        }
        
    }
    else if(mitgliedshaf_art == "Juniorenmitgliedschaft") {
        switch(verband) {
            case "IVD Berlin-Brandenburg":
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '60,00';
                break;
            case 'IVD Mitte': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '146,00';
                break;
            case 'IVD Nord': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '60,00';
                break;
            case "IVD West":
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '60,00';
                break;
            case 'IVD Mitte Ost': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '60,00';
                break;
            case 'IVD Süd':
            case 'IVD Süd BW': 
                aufnahmegebuehr = '0,00';
                jahresgebuehr = '68,00';
                break;
        }
        
    }
    netto_preis = {
        'aufnahme_gebuehr': aufnahmegebuehr,
        'jahres_gebuehr': jahresgebuehr
    };
    
    return netto_preis;
}


// Get first two digit from PLZ
function gettwoDigitFromPlz(plz) {
    let getPlz = 0;
    if((plz == 55252 || plz == 55246)) {
        getPlz = plz;    
    } else {
        const firstTwoNumbers = String(plz).slice(0, 2);
        getPlz = Number(firstTwoNumbers);
    }
    return getPlz;    
}

// Get bundesland name according to plz
// get Data using Ajax
function getBundesland(plz) {   

        $.ajax({
            type: 'GET',
            url:  "https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/georef-germany-postleitzahl/records?select=name%20as%20plz%2C%20plz_name%2C%20plz_code%2C%20lan_name%20as%20bundesland&where=plz_code%20%3D%20'" + plz + "'&order_by=bundesland&limit=1",
            error: function(ts) {
                alert('Es gibt etwas Problem: ' + ts.responseText);
            },
            success: function(data){
                //console.log(data['total_count']);
                if(data['total_count'] == 0) {
                    $('#alertPlz').text("Bitte geben Sie eine richtige PLZ ein!");                    
                }else{
                    $('#alertPlz').text("");
                    let bundesland = data['results'][0]['bundesland'];
                    let stadtname = data['results'][0]['plz_name'];
                    $('#bundesland').val(bundesland);
                    $('#f-ort').val(stadtname);
                    chkBundeslandIvdNord(bundesland); 
                }
                
            }
        });
    
}
let postleitzahl = document.getElementById('f-plz');
//console.log(postleitzahl);
if(postleitzahl) {
        postleitzahl.addEventListener('change', function(event) {
        let plz= postleitzahl.value;
        getBundesland(plz);
    });
}


function chkBundeslandIvdNord(bundesland) {
    if( bundesland == 'Bremen' || bundesland == 'Hamburg' || bundesland == 'Mecklenburg-vorpommern' || bundesland == 'Niedersachsen' || bundesland == 'Schleswig-holstein') {
        $('#privataddress').css("display", "block");
        $('#fachkunde-info-text p').text("* Weist der Bewerber keine ausreichenden Fachkenntnisse oder keine abgeschlossene immobilienwirtschaftliche Ausbildung oder mehrjährige Berufserfahrung nach, kann der Verband ein Fachkundegespräch oder eine schriftliche Prüfung verlangen. Der IVD Nord führt mit jedem Antragssteller ein Aufnahmegespräch. ");
    } else {
        $('#privataddress').css("display", "none");
    }
    return true;
}


