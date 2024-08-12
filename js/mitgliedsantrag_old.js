

let fName = document.getElementById('firstname');
let lName = document.getElementById('lastname');
fName ? fName.addEventListener("blur", checkInput, true) : false;
lName ? lName.addEventListener("blur", checkInput, true) : false;

// Page 1

let p_fName = document.getElementById('p-firstname');
let p_lName = document.getElementById('p-lastname');
let submit_page1 = document.getElementById('submit-page1')
let uploadButtonPage1 = document.getElementById('uploadButton');
let fileUpload = document.getElementById('fileToUpload');
p_fName ? p_fName.addEventListener("change", checkInput, true) : false;
p_lName ? p_lName.addEventListener("change", checkInput, true): false;
const fileType = ["application/pdf","application/msword","image/jpeg","image/jpg","image/png"];
let chk;
let form_page1 = document.getElementById('form-page1');
// if(submit_page1) submit_page1.disabled = true;
var chkEmptyInput = true;
if(form_page1) 
{ 
    form_page1.addEventListener('change', function(){
        validateForm(submit_page1);
    })
}


uploadButtonPage1 ? uploadButtonPage1.addEventListener('click', function(e) {
    e.preventDefault();

    let error = $('#errorMsg');let file_info = $('#fileNameInfo');let chkOk = $('#uploadOk');
    let file_path = $('#filePath');let file_name = $('#fileName');

    fileUpload.click();
        fileUpload.onchange = function() {
        fileobj = fileUpload.files[0];
        file_upload(fileobj, 'fachkunde', error, file_info, chkOk, file_path, file_name);
    }
}) : false;

// Function for validation
function validateForm(submitBtn) {
    submitBtn.disabled = true; 
    let antrag_detail_ele = document.querySelectorAll(".antrag-detail input, .antrag-detail select");
    let chkArray = [];
    console.log(document.getElementById('uploadOk').value);
    antrag_detail_ele.forEach((ele, index) => {
        (ele.value == "" || ele.value == "0") ? chkArray[index] = 'false' : chkArray[index] = 'true';
    });
    console.log(chkArray)
        if(!chkArray.includes('false'))
        { 
            if( document.getElementById('uploadOk').value == "1")
            {
                submitBtn.disabled = false; 
                submitBtn.classList.remove('opacity-60'); 
                submitBtn.classList.add('opacity-100');
            } else {
                submitBtn.disabled = true; 
                submitBtn.classList.remove('opacity-100'); 
                submitBtn.classList.add('opacity-60');
            }
        }
}



// Page 2

let submit_page2 = document.getElementById('submit-page2')
let uploadButtonPage2 = document.querySelectorAll('#gewerbeanmeldungButton, #MaklerUpload, #VerwalterUpload');
let fileUploadPage2 = document.querySelectorAll('input[type="file"]');
console.log(fileUploadPage2);
let gewerbeMakler = document.querySelectorAll(".gewerbeerlaubnisMakler, .gewerbeerlaubnisVerwalter, .handelsregister, .immobilienwirtschaftlich");
let fileNameInfo = document.querySelectorAll('#fileNameGewerbeanmeldung, #fileName34cMakler, #fileName34cVerwalter');
let errorMsg = document.querySelectorAll('#errorGewerbeanmeldung, #error34cMakler, #error34cVerwalter');
let form_page2 = document.getElementById('form-page2');

// console.log(submit_page2);
if(form_page2) { form_page2.addEventListener('change', function(){
    let antragDetailPage2 = document.querySelectorAll('#gruendung_jahr, #mitarbeiter_anzahl, #gewerbeanmeldung_datum, #upload-gewerbeanmeldung');
    /* let makler_34c = document.querySelectorAll('input[name="gewerbeerlaubnisMakler"]');
    let verwalter_34c = document.querySelectorAll('input[name="gewerbeerlaubnisVerwalter"]');
    let handelregister = document.querySelectorAll('input[name="handelsregister"]');
    let immo_wirtschaft = document.querySelectorAll('input[name="immobilienwirtschaftlich"]'); */
    let schwerpunkte = document.querySelectorAll('input[type="checkbox"]');
    let checked = 0;    /* console.log(antragDetailPage2);console.log(makler_34c);console.log(verwalter_34c);console.log(handelregister);console.log(immo_wirtschaft); */

    let chkForm2 = [];
    antragDetailPage2.forEach((ele, i) => {
        (ele.value == "") ? chkForm2[i] = 'false' : chkForm2[i] = 'true';
    });
/* 
    chkRadioBtn(makler_34c, chkForm2, 1); 
    chkRadioBtn(verwalter_34c, chkForm2, 2); 
    chkRadioBtn(handelregister, chkForm2, 3); 
    chkRadioBtn(immo_wirtschaft, chkForm2, 4); */
    schwerpunkte.forEach((ele, i) => {
        (ele.checked == true) ? checked = 1 : unchecked = 1;
    }); 
        (checked == 1) ? chkForm2.push('true') : chkForm2.push('false');
    /* console.log(chkForm2);
    console.log(submit_page2); */
    let fileChk = chkFileUploadPage2();
    console.log(fileChk);
    if(!chkForm2.includes('false'))
    {  
            if( fileChk == '1' ) {
                submit_page2.disabled = false; 
                submit_page2.classList.remove('opacity-60'); 
                submit_page2.classList.add('opacity-100');
            } else {
                submit_page2.disabled = true; 
                submit_page2.classList.remove('opacity-100'); 
                submit_page2.classList.add('opacity-60');
            }
    }
})
}



if(uploadButtonPage2) {
    uploadButtonPage2.forEach((btn, i) => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            fileUploadPage2[i].click();
        })
    })
}

function chkFileUploadPage2() {
    if(fileUploadPage2) {
        fileUploadPage2.forEach((file, i) => {
            
            console.log(file);
            file.addEventListener('change', function() {
                let fileDetail = fileInfo(file);
                console.log(fileDetail);
            console.log(fileDetail.fileName + " " + fileDetail.fileSize + " " + fileDetail.fileType );
                if( fileDetail.fileSize > 5242880 ) {
                    
            console.log(file);
                    fileNameInfo[i].innerHTML = "";
                    errorMsg[i].innerHTML = "Die Datei ist größe, darf maximal 5 kB betragen!";
                    chk = '0';;
                }
                else if(!fileType.includes(fileDetail.fileType)) {
                    
            console.log(file);
                    fileNameInfo[i].innerHTML = "";
                    errorMsg[i].innerHTML = "Dies ist kein erlaubter Filetyp!, Bitte wählen Sie ein PDF oder JPEG oderr JPG oder PNG file.";
                    chk = '0';;
                } else {
                    
            console.log(file);
                    errorMsg[i].innerHTML = "";
                    fileNameInfo[i].innerHTML = fileDetail.fileName;
                    chk = '1';;
                }
            })
        })
    
    }
    console.log(chk);
    return chk;
}



if(gewerbeMakler) {
    gewerbeMakler.forEach((ele, i) => {
        ele.addEventListener('change', function(e) {
            e.preventDefault();
            console.log(ele.name + " " + ele.value + " " + i)
            if(ele.value == '0') {
                if(ele.name == 'gewerbeerlaubnisMakler') {
                    document.getElementById('MaklerUpload').disabled = true;                    
                    errorMsg[1].innerHTML = "";
                }
                if(ele.name == 'gewerbeerlaubnisVerwalter') {
                    document.getElementById('VerwalterUpload').disabled = true;
                    errorMsg[2].innerHTML = "";
                }
            } else {
                if(ele.name == 'gewerbeerlaubnisMakler') document.getElementById('MaklerUpload').disabled = false;
                if(ele.name == 'gewerbeerlaubnisVerwalter') document.getElementById('VerwalterUpload').disabled = false;
            }
        })
    })
}



function chkRadioBtn(page2Radio, chkForm2, index) {
    for(const radioele of page2Radio) {
        if(radioele.checked) {
            chkForm2.push('true');
            if(radioele.value == 1) {
                if(index == 1 || index == 2)
                (fileUploadPage2[index].value == "") ? chkForm2.push('false') : chkForm2.push('true')
            }
            // console.log(radioele.value)
        }
    }
}
// File Info
function fileInfo(fileEle){
    const fileData = {
        fileName: fileEle.files[0].name,
        fileSize: fileEle.files[0].size,
        fileType: fileEle.files[0].type
    }
    
    return fileData;
}

// Function for validation
function validateForm(submitBtn) {
    submitBtn.disabled = true; 
    let antrag_detail_ele = document.querySelectorAll(".antrag-detail input, .antrag-detail select");
    let chkArray = [];
    console.log(document.getElementById('uploadOk').value);
    antrag_detail_ele.forEach((ele, index) => {
        (ele.value == "" || ele.value == "0") ? chkArray[index] = 'false' : chkArray[index] = 'true';
    });
    console.log(chkArray)
        if(!chkArray.includes('false'))
        { 
            if( document.getElementById('uploadOk').value == "1")
            {
                submitBtn.disabled = false; 
                submitBtn.classList.remove('opacity-60'); 
                submitBtn.classList.add('opacity-100');
            } else {
                submitBtn.disabled = true; 
                submitBtn.classList.remove('opacity-100'); 
                submitBtn.classList.add('opacity-60');
            }
        }
}


function checkInput() {
    var pattern = /^[a-z]+$/i;
    let input = pattern.test(this.value);
    if(input == false) {
        this.focus();
        this.style.borderColor = 'red';
    } else {
        this.style.borderColor = '#CCD5E0';
    }
}



//Page 3
let submit_page3 = document.getElementById('submit-page3')
let form_page3 = document.getElementById('form-page3');

// console.log(submit_page2);
if(form_page3) { 
        let antragDetailPage3 = document.querySelectorAll('#bundesland_page, #mitgliedschaft_begin');
        formValidate(form_page3, antragDetailPage3, submit_page3);
}

function formValidate(form, antragDetail, submitBtn) {
    form.addEventListener('change', function(){
        let chkForm = [];
        antragDetail.forEach((ele, i) => {
            console.log(ele);
            (ele.value == "") ? chkForm[i] = 'false' : chkForm[i] = 'true';
        });
        console.log(chkForm);
        let chkval = !chkForm.includes('false');
        console.log(chkval);
        checkForm(chkval, submitBtn);
    
    })
}

const checkForm = (chkval, btn) => {
    if(chkval == true)
    {  
        btn.disabled = false; 
        btn.classList.remove('opacity-60'); 
        btn.classList.add('opacity-100');
    } else {
        btn.disabled = true; 
        btn.classList.remove('opacity-100'); 
        btn.classList.add('opacity-60');
    }
}

// Page 4
let submit_page4 = document.getElementById('submit-page4')
let form_page4 = document.getElementById('form-page4');

if(form_page4) { 
    let antragDetailPage4 = document.querySelectorAll('input[type="checkbox"]');
    let chkForm = [];
    console.log(antragDetailPage4);
    form_page4.addEventListener('change', function(){
        antragDetailPage4.forEach((ele, i) => { 
            (ele.checked) ? chkForm[i] = 'true' : chkForm[i] = 'false';
        });
        console.log(chkForm);

        let chkval = !chkForm.includes('false');
        checkForm(chkval, submit_page4);
    });
}

// Page 5
let submit_page5 = document.getElementById('submit-page5')
let form_page5 = document.getElementById('form-page5');
let fileUploadPage5 = document.querySelectorAll('#betriebshaft-file, #vermoegensschadenhaft-file');
let fileNameInfoPage5 = document.querySelectorAll('#fileNameBetriebshaftpflicht, #fileNameVermoegensschadenhaft');
console.log(fileNameInfoPage5);
let errorMsgPage5 = document.querySelectorAll('#errorBetriebshaftpflicht, #errorVermoegensschadenhaft');
let uploadButtonPage5 = document.querySelectorAll('#betriebshaftButton, #vermoegensschadenhaftButton');

let antragDetailPage5 = document.querySelectorAll('input[type="checkbox"]');
let chkForm = [];
if(form_page5){
    form_page5.addEventListener('change', function(){
        antragDetailPage5.forEach((ele, i) => { 
            (ele.checked) ? chkForm[i] = 'true' : chkForm[i] = 'false';
        });
        console.log(chkForm);

        let fileChk = chkFileUploadPage5();
        console.log(fileChk);
        if(!chkForm.includes('false')) {
            if( fileChk == '1' ) {
                submit_page5.disabled = false; 
                submit_page5.classList.remove('opacity-60'); 
                submit_page5.classList.add('opacity-100');
            } else {
                submit_page5.disabled = true; 
                submit_page5.classList.remove('opacity-100'); 
                submit_page5.classList.add('opacity-60');
            }
        }

    });
}

    if(uploadButtonPage5) {
        uploadButtonPage5.forEach((btn, i) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                fileUploadPage5[i].click();
            })
        })
    }

    function chkFileUploadPage5() {
        if(fileUploadPage5) {
            fileUploadPage5.forEach((file, i) => {
                
                console.log(file + ' ' + i);
                file.addEventListener('change', function() {
                    let fileDetail = fileInfo(file);
                    if( fileDetail.fileSize > 5242880 ) {
                        fileNameInfoPage5[i].innerHTML = "";
                        errorMsgPage5[i].innerHTML = "Die Datei ist größe, darf maximal 5 kB betragen!";
                        chk = '0';;
                    }
                    else if(!fileType.includes(fileDetail.fileType)) {
                        fileNameInfoPage5[i].innerHTML = "";
                        errorMsgPage5[i].innerHTML = "Dies ist kein erlaubter Filetyp!, Bitte wählen Sie ein PDF oder JPEG oderr JPG oder PNG file.";
                        chk = '0';;
                    } else {
                        errorMsgPage5[i].innerHTML = "";
                        fileNameInfoPage5[i].innerHTML = fileDetail.fileName;
                        chk = '1';;
                    }
                })
            })
        
        }
        console.log(chk);
        return chk;
    }

    // Page 6
    let submit_page6 = document.getElementById('submit-page6')
    let form_page6 = document.getElementById('form-page6');
    let zahlungsart = document.getElementsByName('zahlunsart');
    let zahlungsFelder = document.querySelectorAll('input[type="text"]')
    let zahlungsRegln = document.getElementById('zahlungRegeln')
    console.log(zahlungsart);
    let chkzahlungsart = 1;
    zahlungsart.forEach((ele, i) =>  {
        ele.addEventListener("click", () => {
            if(ele.checked == true) {
                console.log(i);
                if(i == 0) {
                    zahlungsFelder.forEach((txtEle) =>{
                        txtEle.disabled = true;
                    });
                    chkzahlungsart = 0
                } else {
                    zahlungsFelder.forEach((txtEle) =>{
                        txtEle.disabled = false;
                    });
                    chkzahlungsart = 1
                }
            } 
        })
    })

let iban = document.getElementById('iban')

if(iban) {
    iban.addEventListener('input', function(e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;
    
        target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
    });

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
                            console.log("Falsche Iban..");
                            document.getElementById('ibanError').innerHTML ="Falsche Iban..";
                        }else {
                            document.getElementById('ibanError').innerHTML ="";
                        }
                    }
                })
     })
}



    if(form_page6) {
        let checked = 0; 
        form_page6.addEventListener('change', function() {
            
            if(chkzahlungsart == 1) {
                zahlungsFelder.forEach( (ele, i) => {
                    (ele.value == "") ? chkForm[i] = 'false' : chkForm[i] = 'true';
                })
            }

            // zahlungsRegln.addEventListener('change', () => {
                if(zahlungsRegln.checked == true) {
                    zahlungsRegln.value = 1;
                    checked = 1;
                    (chkzahlungsart == 1) ? chkForm[3] = 'true' : chkForm[0] = 'true';
                } else {
                    zahlungsRegln.value = 0;
                    checked = 0;
                    (chkzahlungsart == 1) ? chkForm[3] = 'false' : chkForm[0] = 'false';
                }

            console.log(chkForm);
            if(!chkForm.includes('false') && (chkForm.length !=0 )) {
                submit_page6.disabled = false; 
                submit_page6.classList.remove('opacity-60'); 
                submit_page6.classList.add('opacity-100');
            } else {
                submit_page6.disabled = true; 
                submit_page6.classList.remove('opacity-100'); 
                submit_page6.classList.add('opacity-60');
            }
        })
    }




// get Data using Ajax
function file_upload(fileObj, fileTyp, error, file_info, chkOk, file_path, file_name) {
    if(fileObj != undefined) {
        var form_data = new FormData();
        form_data.append('file', fileObj);
        form_data.append('fileTyp', fileTyp)

        $.ajax({
            type: 'POST',
            url:  "js/ajax/ajax.php",
            fileTyp: "fachkunde",
            contentType: false,
            processData: false,
            data: form_data,
            error: function(ts) {
                alert('Es gibt etwas Problem: ' + ts.responseText);
            },
            success: function(response){
                console.log(response);
                var fileInfo = JSON.parse(response);
                if(fileInfo[0].errorImageUpload != ""){
                    chkOk.val("0");
                    error.text(fileInfo[0].errorImageUpload);
                    file_info.text("");
                }else {
                    chkOk.val("1");
                    file_info.text(fileInfo[0].fileName);
                    error.text("");
                }
                file_path.val(fileInfo[0].filePath);
                file_name.val(fileInfo[0].fileName);
                

                console.log(fileInfo);
            }
        });
    } else {
        console.log('please select file..')
    }
}

    
    
