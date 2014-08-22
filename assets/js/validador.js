/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//busca caràcters que no siguin espai en blanc en una cadena
function vacio(q) {
    //alert ("ha entrat");
    for (i = 0; i < q.length; i++) {
        if (q.charAt(i) != " ") {
            return true;
        }
    }
    return false
}

//valida que el camp no estigui buit i no tingui només espais en blanc
function valida(F) {

    //alert("valida");
    if (vacio(F.login.value) == false || vacio(F.nom.value) == false || vacio(F.password.value) == false) {
        alert("T'has deixat camps per omplir.");
        return false;
    } else {
        return true;
    }
}
function validaProducte(F) {

    //alert("valida");
    if (vacio(F.nomProducte.value) == false || vacio(F.preu.value) == false) {
        alert("T'has deixat camps per omplir.");
        return false;
    } else {
        return true;
    }
}



