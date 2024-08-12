let fName = document.getElementById('firstname');
let lName = document.getElementById('lastname');
fName ? fName.addEventListener("blur", checkInput, true) : false;
lName ? lName.addEventListener("blur", checkInput, true) : false;

// ----  Page 1  ----
let p_fName = document.getElementById('p-firstname');
let p_lName = document.getElementById('p-lastname');
//console.log(p_fName);console.log(p_lName);
p_fName ? p_fName.addEventListener("blur", checkInput, true) : false;
p_lName ? p_fName.addEventListener("blur", checkInput, true) : false;

let submit_page1 = document.getElementById('submit-page1');
let form_page1 = document.getElementById('form-page1');
let uploadBtn_page1 = document.getElementById('uploadButton');
let fileUpload_page1 = document.getElementById('fileToUpload');
let inputs_page1 = document.querySelectorAll('.antrag-detail input[type="text"]:not(.p-address), .antrag-detail select, .antrag-detail input[type="email"]');
let error_page1 = document.getElementById('errorMsg');
let file_info_page1 = document.getElementById('fileNameInfo');
let chkOk_page1 = document.getElementById('uploadOk');
let file_path_page1 = document.getElementById('filePath');
let file_name_page1 = document.getElementById('fileName');
let danger_msg_page1 = document.querySelector('.danger-msg-page1');
let success_msg_page1 = document.querySelector('.success-msg-page1');
//console.log(inputs_page1);
const nordCity = ["Bremen", "Hamburg", "Mecklenburg-vorpommern", "Niedersachsen", "Schleswig-holstein"];

if(form_page1) { 
    form_page1.addEventListener('change', function() {
        if(nordCity.includes(document.getElementById('bundesland').value)) {
            console.log(document.getElementById('bundesland').value);
            inputs_page1 = document.querySelectorAll('.antrag-detail input[type="text"]:not(#f-website), .antrag-detail select, .antrag-detail input[type="email"]');
        }
        //console.log(inputs_page1);
        updateSubmitBtn(submit_page1, inputs_page1, danger_msg_page1, success_msg_page1);
    });
}

if(uploadBtn_page1){
    uploadBtn_page1.addEventListener('click', function(e) {
        e.preventDefault();

        fileUpload_page1.click();
        fileUpload_page1.onchange = function() {
            fileobj = fileUpload_page1.files[0];
            file_upload(fileobj, 'fachkunde', error_page1, file_info_page1, chkOk_page1, file_path_page1, file_name_page1);

            setTimeout(function() {
                if(!isValidFile(fileobj)){
                    fileUpload_page1.value = null;
                    file_name_page1.value = "";
                }
                updateSubmitBtn(submit_page1, inputs_page1, danger_msg_page1, success_msg_page1);
                
            }, 2000);
            
        }
    }) 
}


// ----  Page 2  ----

let submit_page2 = document.getElementById('submit-page2');
let form_page2 = document.getElementById('form-page2');
let uploadBtn_page2 = document.querySelectorAll('#gewerbeanmeldungButton, #MaklerUpload, #VerwalterUpload');
let fileUpload_page2 = document.querySelectorAll('.antrag-detail2 input[type="file"]');
let inputs_page2 = document.querySelectorAll('#gruendung_jahr, #gewerbeanmeldung_datum');

let inputs_hidden_makler = document.querySelectorAll('.fileDetail2 input[type="hidden"]');
let inputs_hidden_verwalter = document.querySelectorAll('.fileDetail3 input[type="hidden"]');

let schwerpunkte = document.querySelectorAll('input[type="checkbox"]');
let gewerbeMakler = document.querySelectorAll(".gewerbeerlaubnisMakler, .gewerbeerlaubnisVerwalter");
let sonstige_taetigkeit = document.querySelector("#sonstige_taetigkeit");
console.log(sonstige_taetigkeit);

let error = document.querySelectorAll('#errorGewerbeanmeldung, #error34cMakler, #error34cVerwalter');
let file_info = document.querySelectorAll('#fileNameGewerbeanmeldungInfo, #fileName34cMakler, #fileName34cVerwalter');

let chkOk = document.querySelectorAll('#uploadOkGewerbeanmeldung, #uploadOkMakler, #uploadOkVerwalter');
let file_path = document.querySelectorAll('#filePathGewerbeanmeldung, #filePathMakler, #filePathVerwalter');
let file_name = document.querySelectorAll('#fileNameGewerbeanmeldung, #fileNameMakler, #fileNameVerwalter');

let danger_msg_page2 = document.querySelector('.danger-msg-page2');
let success_msg_page2 = document.querySelector('.success-msg-page2');
   
//console.log(inputs_page2); 
if(schwerpunkte) {
    schwerpunkte.forEach( (ele, i) => {
        ele.addEventListener('change', function(e) {
            e.preventDefault();
            if( (ele.name == 'sonstige') && (ele.checked == true) ) {
                $('#sonstige_taetigkeit').prop('disabled', false);
            } else {
                $('#sonstige_taetigkeit').prop('disabled', true);
                $('#sonstige_taetigkeit').val("");
            }
        })
    } )
}

/* if(sonstige_taetigkeit) {
    sonstige_taetigkeit.addEventListener('input', function(e) {
        console.log('hello')
    })
} */

if(gewerbeMakler) {
    gewerbeMakler.forEach((ele, i) => {
        ele.addEventListener('change', function(e) {
            e.preventDefault();
            // console.log(ele.name + " " + ele.value + " " + i)
            if(ele.value == '0') {
                if(ele.name == 'gewerbeerlaubnisMakler') {
                    document.getElementById('MaklerUpload').disabled = true;
                    document.getElementById('MaklerUpload').innerHTML = 'Datei-Upload'; 
                    /* $('#makler').prop('disabled', true);  
                    $('#makler').prop('checked', false); */                 
                    error[1].innerHTML = "";
                    file_info[1].innerHTML = "";
                    chkOk[1].value = "";
                    file_path[1].value = "";
                    file_name[1].value = "";
                }
                if(ele.name == 'gewerbeerlaubnisVerwalter') {
                    document.getElementById('VerwalterUpload').disabled = true;
                    document.getElementById('VerwalterUpload').innerHTML = 'Datei-Upload';
                    /* $('#verwalter').prop('disabled', true);
                    $('#verwalter').prop('checked', false); */
                    error[2].innerHTML = "";
                    file_info[2].innerHTML = "";
                    chkOk[2].value = "";
                    file_path[2].value = "";
                    file_name[2].value = "";
                }
            } else {
                if(ele.name == 'gewerbeerlaubnisMakler') {
                    document.getElementById('MaklerUpload').disabled = false;
                    document.getElementById('MaklerUpload').innerHTML = 'Datei-Upload';
                    //$('#makler').prop('disabled', false);
                    //$('#makler').prop('checked', true);
                }
                if(ele.name == 'gewerbeerlaubnisVerwalter') {
                    document.getElementById('VerwalterUpload').disabled = false;
                    document.getElementById('VerwalterUpload').innerHTML = 'Datei-Upload';
                    //$('#verwalter').prop('disabled', false);
                    //$('#verwalter').prop('checked', true);
                }
            }
        })
    })
}


    if(form_page2) { 
        form_page2.addEventListener('change', function() {
            validateForm2(submit_page2, inputs_page2, schwerpunkte, gewerbeMakler, inputs_hidden_makler, inputs_hidden_verwalter, danger_msg_page2, success_msg_page2);
        })
    }
    
if(uploadBtn_page2) {
    let chkOk = document.querySelectorAll('#uploadOkGewerbeanmeldung, #uploadOkMakler, #uploadOkVerwalter');
    let file_path = document.querySelectorAll('#filePathGewerbeanmeldung, #filePathMakler, #filePathVerwalter');
    let file_name = document.querySelectorAll('#fileNameGewerbeanmeldung, #fileNameMakler, #fileNameVerwalter');
    let filePrefix = ['gewerbeanmeldung', 'makler34c', 'verwalter34c'];
    var checked = 0;

    uploadBtn_page2.forEach((btn, i) => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();            

            fileUpload_page2[i].click();
            fileUpload_page2[i].onchange = function() {
                fileobj = fileUpload_page2[i].files[0];
                file_upload(fileobj, filePrefix[i], error[i], file_info[i], chkOk[i], file_path[i], file_name[i]);
            
                setTimeout(function() {
                    validateForm2(submit_page2, inputs_page2, schwerpunkte, gewerbeMakler, inputs_hidden_makler, inputs_hidden_verwalter, danger_msg_page2, success_msg_page2);
                    // if(!isValidFile(fileobj)){
                    //     fileUpload_page1.value = null;
                    //     file_name_page1.value = "";
                    // }
                }, 2000)
            }
        });
    });
    
}

// ---- Page 3 ----
let submit_page3 = document.getElementById('submit-page3');
let form_page3 = document.getElementById('form-page3');
let reg_verband = document.getElementById('reg-verband');
let inputs_page3 = document.querySelectorAll('#bundesland_page, #mitgliedschaft_begin');
//File Upload Detail
let uploadBtn_page3 = document.querySelectorAll('#ref_btn_1, #ref_btn_2, #foto_upload_btn');
let fileUpload_page3 = document.querySelectorAll('.antrag-detals3 input[type="file"]');
let errorMsg = document.querySelectorAll('#error_ref_1, #error_ref_2, #error_foto');
let success_info = document.querySelectorAll('#success_ref_1, #success_ref_2, #success_foto');

let chkOk_page3 = document.querySelectorAll('#ref_1_ok, #ref_2_ok, #foto_ok');
let file_path_page3 = document.querySelectorAll('#ref_1_filepath, #ref_2_filepath, #foto_filepath');
let file_name_page3 = document.querySelectorAll('#ref_1_filename, #ref_2_filename, #foto_filename');

let danger_msg_page3 = document.querySelector('.danger-msg-page3');
let success_msg_page3 = document.querySelector('.success-msg-page3');
//console.log(file_name_page3);

/* if(form_page3) {    
    inputs_page3 = (reg_verband.value !== 'IVD Nord') ? document.querySelectorAll('#bundesland_page, #mitgliedschaft_begin') : document.querySelectorAll('#bundesland_page, #mitgliedschaft_begin');
} */
console.log(inputs_page3);
if(inputs_page3)
{
    for (let i = 0; i < inputs_page3.length; i++) {
        inputs_page3[i].addEventListener('input', function() {
            updateSubmitBtn(submit_page3, inputs_page3, danger_msg_page3, success_msg_page3);
        });
    }

}

if(uploadBtn_page3) {
    if(reg_verband) {

        if(reg_verband.value == 'IVD Nord') {
            let filePrefix = ['ref_1', 'ref_2', 'antragsteller_foto'];
            uploadBtn_page3.forEach((btn, i) => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();                    
                    let fileIndex = 0;
                    fileUpload_page3[i].click();
                    fileUpload_page3[i].onchange = function() {
                        fileobj = fileUpload_page3[i].files[0];
                        if(i == 2) fileIndex = 1;
                        file_upload(fileobj, filePrefix[i], errorMsg[i], success_info[i], chkOk_page3[i], file_path_page3[i], file_name_page3[i], fileIndex);

                        setTimeout(function() {
                            if(!isValidFile(fileobj, fileIndex)){
                                file_name_page3[i].value = "";
                            }
                            console.log(inputs_page3);
                            updateSubmitBtn(submit_page3, inputs_page3, danger_msg_page3, success_msg_page3);
                        }, 2000)
                        
                    }
                })
            })
        }
    }
}

// ---- Page 4 ----
let submit_page4 = document.getElementById('submit-page4')
let form_page4 = document.getElementById('form-page4');
let inputs_page4 = document.querySelectorAll('.antarg-detail4 input[type="checkbox"]:not(#chk-all)');

let danger_msg_page4 = document.querySelector('.danger-msg-page4');
let success_msg_page4 = document.querySelector('.success-msg-page4');

$("#chk-all").click(function(){
    $(".antarg-detail4 input[type=checkbox]").prop('checked', $(this).prop('checked'));
    updateSubmitBtn(submit_page4, inputs_page4, danger_msg_page4, success_msg_page4);
}); /* */
//console.log(inputs_page4);

if(inputs_page4)
{
    for (let i = 0; i < inputs_page4.length; i++) {
        inputs_page4[i].addEventListener('change', function() {
            updateSubmitBtn(submit_page4, inputs_page4, danger_msg_page4, success_msg_page4);
        });
    }

}


// ---- Page 5 ----
let submit_page5 = document.getElementById('submit-page5')
let form_page5 = document.getElementById('form-page5');
let inputs_page5 = document.querySelectorAll('#einwilligung, .Kenntnis-docs input[type="checkbox"], #einwilligung, #fileNameBetriebshaft, #fileNameVermoegensschaden');
let chk_versicherungs = document.querySelectorAll('#betriebshaft, #vermoegensschadenhaft');
let uploadBtn_page5 = document.querySelectorAll('#betriebshaftButton, #vermoegensschadenhaftButton');
let fileUpload_page5 = document.querySelectorAll('.antrag-detals5 input[type="file"]');

let error_page5 = document.querySelectorAll('#errorBetriebshaftpflicht, #errorVermoegensschadenhaft');
let file_info_page5 = document.querySelectorAll('#fileNameBetriebshaftpflicht, #fileNameVermoegensschadenhaft');
//console.log(fileUpload_page5);
let chkOk_page5 = document.querySelectorAll('#uploadOkBetriebshaft, #uploadOkVermoegensschaden');
let file_path_page5 = document.querySelectorAll('#filePathBetriebshaft, #filePathVermoegensschaden');
let file_name_page5 = document.querySelectorAll('#fileNameBetriebshaft, #fileNameVermoegensschaden');

let danger_msg_page5 = document.querySelector('.danger-msg-page5');
let success_msg_page5 = document.querySelector('.success-msg-page5');
//console.log(inputs_page5);

if(form_page5){
    
    uploadBtn_page5[0].disabled = true;
    uploadBtn_page5[1].disabled = true;
    chk_versicherungs.forEach((ele, i) => {
        ele.addEventListener('change', function() {
            if(ele.checked) {
                uploadBtn_page5[i].disabled = false
            }
            else uploadBtn_page5[i].disabled = true;
            updateSubmitBtn5(submit_page5, inputs_page5, danger_msg_page5, success_msg_page5);
        });
    });

    form_page5.addEventListener('change', function() {
        updateSubmitBtn5(submit_page5, inputs_page5, danger_msg_page5, success_msg_page5);
    })
}

if(uploadBtn_page5) {
    let filePrefix = ['betriebshaftpflicht', 'vermoegensschadenhaftpflicht'];
    var checked = 0;

    uploadBtn_page5.forEach((btn, i) => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            fileUpload_page5[i].click();
            fileUpload_page5[i].onchange = function() {
                fileobj = fileUpload_page5[i].files[0];
                file_upload(fileobj, filePrefix[i], error_page5[i], file_info_page5[i], chkOk_page5[i], file_path_page5[i], file_name_page5[i]);
                
                setTimeout(function() {
                    updateSubmitBtn5(submit_page5, inputs_page5, danger_msg_page5, success_msg_page5);
                    if(!isValidFile(fileobj)){
                        fileUpload_page5[i].value = null;
                        file_name_page5[i].value = "";
                    }
                }, 2000);
                
            }
        });
    });
    
}

// ---- Page 6 ----
let submit_page6 = document.getElementById('submit-page6')
let form_page6 = document.getElementById('form-page6');
let zahlungsart = document.getElementsByName('zahlunsart');
let inputs_page6 = document.querySelectorAll('.antrag-detals6 input[type="text"], .antrag-detals6 input[type="hidden"]');
let zahlungsRegln = document.getElementById('zahlungRegeln');

let danger_msg_page6 = document.querySelector('.danger-msg-page6');
let success_msg_page6 = document.querySelector('.success-msg-page6');
//console.log(inputs_page6);
// console.log(zahlungsart);
//let isValid = "false";

let chkzahlungsart = 1;
zahlungsart.forEach((ele, i) =>  {
    ele.addEventListener("change", () => {
        if(ele.checked) {
            console.log(i);
            if(i == 0) {
                inputs_page6.forEach((txtEle) =>{                    
                    txtEle.disabled = true;
                    txtEle.value = "";
                });
                
                zahlungsRegln.checked = false;
                zahlungsRegln.disabled = true;
                chkzahlungsart = 0
            } else {
                inputs_page6.forEach((txtEle) =>{
                    txtEle.disabled = false;
                });
                zahlungsRegln.checked = true;
                zahlungsRegln.disabled = false;
                chkzahlungsart = 1
            }
        } 
    })
})

if(form_page6){
    form_page6.addEventListener('change', function() {
        updateSubmitBtn6(submit_page6, inputs_page6, danger_msg_page6, success_msg_page6);
    })
}

// Enable/disable submit button based on validation status
function updateSubmitBtn6(submitBtn, inputs, msg_d, msg_s) {
    
    let chkForm = validateForm6(inputs, zahlungsRegln, zahlungsart);
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
    submitBtn.disabled = !validateForm6(inputs, zahlungsRegln, zahlungsart);
}





let iban = document.getElementById('iban')

if(iban) {
    /* iban.addEventListener('input', function(e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;
    
        target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
    }); */

    iban.addEventListener('change', function(e) {
        var target = e.target.value.replaceAll(" ", "");
            $.post("js/ajax/iban.php", {
                iban: target,
                type:"chkIban",
            },
                function(data, status) {
                    if(status == "success") {
                        if(data == 'false') {
                            iban.value = "";
                            //console.log("Falsche Iban..");
                            document.getElementById('ibanError').innerHTML ="Falsche Iban..";
                            // document.getElementById('chkIban').value = "";
                            updateSubmitBtn6(submit_page6, inputs_page6, danger_msg_page6, success_msg_page6);
                        }else {
                            document.getElementById('ibanError').innerHTML ="";
                            document.getElementById('chkIban').value = 1;
                            updateSubmitBtn6(submit_page6, inputs_page6, danger_msg_page6, success_msg_page6);
                        }
                    }
                })
     })
}

// Check validation status on page load
window.addEventListener('load', function() {
    console.log('window loaded..')
    if(form_page1) {
        if(nordCity.includes(document.getElementById('bundesland').value)){
            $('#privataddress').css("display", "block");
            inputs_page1 = document.querySelectorAll('.antrag-detail input[type="text"]:not(#f-website), .antrag-detail select, .antrag-detail input[type="email"]');
        } else {
            $('#privataddress').css("display", "none");
        }
        //inputs_page1 = document.querySelectorAll('.antrag-detail input[type="text"]:not(#f-website), .antrag-detail select, .antrag-detail input[type="email"]');
        updateSubmitBtn(submit_page1, inputs_page1, danger_msg_page1, success_msg_page1);
    } 
    if(form_page2) validateForm2(submit_page2, inputs_page2, schwerpunkte, gewerbeMakler, inputs_hidden_makler, inputs_hidden_verwalter, danger_msg_page2, success_msg_page2);
    if(form_page3) {
        updateSubmitBtn(submit_page3, inputs_page3, danger_msg_page3, success_msg_page3);
        if(document.getElementById('reg-verband').value !== 'IVD Nord') {
            this.document.getElementById('show-ivd-nord').style.display = 'none'; 
        }
    }
    if(form_page4) updateSubmitBtn(submit_page4, inputs_page4, danger_msg_page4, success_msg_page4);
    if(form_page5) updateSubmitBtn5(submit_page5, inputs_page5, danger_msg_page5, success_msg_page5);
    if(form_page6) updateSubmitBtn6(submit_page6, inputs_page6, danger_msg_page6, success_msg_page6);
  });

  function stopBack() {
    window.history.go(1);
 }


 // Info box Script Page 1
const infoBox = document.querySelector("#info-datenschutz");
const infoText = document.querySelector("#info-text");
if(infoText) {
    infoText.style.display = "none";
    infoBox.addEventListener('mouseover', function() {
        infoText.style.display = "block";        
    })
    infoBox.addEventListener('mouseout', function() {
        infoText.style.display = "none";        
    })
}

// Fachkunde info text Page 1
const infoBoxFachkunde = document.querySelector("#info-fachkunde");
const fachkundeInfoText = document.querySelector("#fachkunde-info-text");
if(fachkundeInfoText) {
    fachkundeInfoText.style.display = "none";
    infoBoxFachkunde.addEventListener('mouseover', function() {
            fachkundeInfoText.style.display = "block";        
    })
    infoBoxFachkunde.addEventListener('mouseout', function() {
        fachkundeInfoText.style.display = "none";    
    })
}

// Ref Info box Script Page 3
const refInfoBox = document.querySelector("#ref-info-bubble");
const refInfoText = document.querySelector("#ref-info-txt");
if(refInfoText) {
    refInfoText.style.display = "none";
    refInfoBox.addEventListener('mouseover', function() {
            refInfoText.style.display = "block";
    })

    refInfoBox.addEventListener('mouseout', function() {
        refInfoText.style.display = "none";
    })
}


