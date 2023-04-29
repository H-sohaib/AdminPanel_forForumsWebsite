var tab1 = document.getElementById("tab-1");
var tab2 = document.getElementById("tab-2");
var headers = document.getElementsByClassName("headers");
if(tab1){
    headers[0].getElementsByTagName("h1")[0].onclick=function(){
        headers[0].getElementsByTagName("h1")[0].classList.remove("header-inactive");
        headers[0].getElementsByTagName("h1")[1].classList.add("header-inactive");
        tab1.style.transform="translateX(0)";
        tab2.style.transform="translateX(0)";
        tab2.style.opacity="0";
    };
    headers[0].getElementsByTagName("h1")[1].onclick=function(){
        //headers[0].getElementsByTagName("h1")[0].classList.add("header-inactive");
        //headers[0].getElementsByTagName("h1")[1].classList.remove("header-inactive");
        //tab1.style.transform="translateX(-100%)";
        //tab2.style.transform="translateX(-100%)";
        //tab2.style.opacity="1";
        window.location="inscription.html";
    };
}
var popup = document.getElementsByClassName("selection")[0];
if(popup){
    var ecole = document.getElementById("ecole");
    var spec = document.getElementById("spec");
    var grade = document.getElementById("grade");
    var les_ecoles = "Centrale Lyon-Centrale Mareille-CentraleSupélec-Centrale Nantes-CPE Lyon-ECAM-EL Cesi-EM Lyon-ENAC-ENIT-ENSE Grenoble-ENSIMAG-ESIGELEC-ESISAR-IAE Lyon-INP Grenoble-INSA CVL-INSA Strasbourg-INSA Toulouse-INSA Rennes-INSA Valenciennes-ITECH Lyon-Mines Saint Etienne-Polytech Lyon-Polytech Tours-Télécom Saint Etienne-Université Grenoble Alpes-Université Jean Monnet-Université Lyon 1-Université Toulouse-Université Aix MArseille-Université Polyetchnique Hauts de France-Autre";
    var les_spec="Agronomie-Biochimie-Bioinformatique-Biologie & Pharamaceutique-Chimie-Commercial & Marketing-Finance & Banque-Génie Civil-Génie Electrique-Génie Energétique-Génie Mécanique-Informatique-Matériaux-Réseaux & Télécommunications-Autre";
    var les_niveaux="Bac+1-Bac+2-Bac+3-Bac+4-Bac+5-Bac+6-Bac+8";
    var go1 = false;
    function Select(index){
        popup.getElementsByClassName("inner")[0].innerHTML="";
        if(index==0){
            for(var i=0;i<les_ecoles.split("-").length;i++){
                var option = les_ecoles.split("-")[i];
                var div = document.createElement("div");
                div.innerHTML = option;
                div.classList.add("option")
                popup.getElementsByClassName("inner")[0].appendChild(div);
                RenderOption(div, option, ecole);
            }
        }
        else if(index==1){
            for(var i=0;i<les_spec.split("-").length;i++){
                var option = les_spec.split("-")[i];
                var div = document.createElement("div");
                div.innerHTML = option;
                div.classList.add("option")
                popup.getElementsByClassName("inner")[0].appendChild(div);
                RenderOption(div, option, spec);
            }
        }
        else if(index==2){
            for(var i=0;i<les_niveaux.split("-").length;i++){
                var option = les_niveaux.split("-")[i];
                var div = document.createElement("div");
                div.innerHTML = option;
                div.classList.add("option")
                popup.getElementsByClassName("inner")[0].appendChild(div);
                RenderOption(div, option, grade);
            }
        }
        popup.style.visibility="visible";
        popup.style.opacity="1";
            setTimeout(function(){
                popup.getElementsByClassName("inner")[0].style.opacity="1";
                popup.getElementsByClassName("inner")[0].style.top="0";
                popup.getElementsByClassName("inner")[0].style.visibility="visible";
                setTimeout(function(){
                    go1 = true;
                }, 500);
            }, 250);
    }
    function RenderOption(div, text, el){
            div.onclick=function(){
                if(go1){
                    go1 = false;
                el.innerHTML=text;
                HidePopup();
                }
            };
    }
    function HidePopup(){
        popup.getElementsByClassName("inner")[0].style.visibility="hidden";
        popup.getElementsByClassName("inner")[0].style.opacity="0";
                popup.getElementsByClassName("inner")[0].style.top="100px";
                setTimeout(function(){
                    popup.style.opacity="0";
                    popup.style.visibility="hidden";
                }, 500);
    }
}
var forgotpassword = document.getElementById("forgot-password");
forgotpassword.getElementsByClassName("inner")[0].getElementsByTagName("img")[0].onclick=function(){
    HideForgotPassword();
};
if(forgotpassword){
    function ForgotPassword(){
        forgotpassword.style.visibility="visible";
        forgotpassword.style.opacity="1";
            setTimeout(function(){
                forgotpassword.getElementsByClassName("inner")[0].style.opacity="1";
                forgotpassword.getElementsByClassName("inner")[0].style.top="0";
                forgotpassword.getElementsByClassName("inner")[0].style.visibility="visible";
            }, 250);
    }
    function HideForgotPassword(){
        forgotpassword.getElementsByClassName("inner")[0].style.visibility="hidden";
        forgotpassword.getElementsByClassName("inner")[0].style.opacity="0";
        forgotpassword.getElementsByClassName("inner")[0].style.top="100px";
                setTimeout(function(){
                    forgotpassword.style.opacity="0";
                    forgotpassword.style.visibility="hidden";
                }, 500);
    }
}
var activer = document.getElementById("activer");
if(activer){
    function SubmitForm(){
        var email = document.getElementsByName("email")[0].value;
        var password = document.getElementsByName("password")[0].value;
        var password2 = document.getElementsByName("password2")[0].value;
        var firstname = document.getElementsByName("firstname")[0].value;
        var lastname = document.getElementsByName("lastname")[0].value;
        var tel = document.getElementsByName("tel")[0].value;
        if(password == password2 && password.length >= 8){
            document.cookie="ecole="+ecole;
            document.cookie="spec="+spec;
            document.cookie="grade="+grade;
            activer.click();
        }
    }
}