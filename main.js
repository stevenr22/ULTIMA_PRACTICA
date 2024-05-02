function validarcedula(e){
    let cedula = document.getElementById("ced").value;

    let codi_chat = e.keyCode;
    if(codi_chat == 13 || codi_chat == 8){
        return true;

    }

    let tipo = String.fromCharCode(codi_chat);
    let expresion = /\d/;
    if (expresion.test(tipo) && cedula.length<10) {
        return true;
    } else {
        e.preventDefault();
        return false;
        
    }


}


function validarletras(e){

    let codi_chat = e.keyCode;
    if(codi_chat == 13 || codi_chat == 8 || codi_chat == 32){
        return true;

    }


    let tipo = String.fromCharCode(codi_chat);
    let expresion = /^[a-zA-Z]+$/;
    if (expresion.test(tipo)) {
        return true;
    } else {
        e.preventDefault();
        return false;
        
    }


}


