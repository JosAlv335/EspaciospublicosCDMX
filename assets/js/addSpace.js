document.getElementById('srchCP').addEventListener('click',function(){

    var codigoPostal = document.getElementById('codigoPostal').value;
    if(codigoPostal.length == 0){
        document.getElementById('codigoPostal').innerHTML = "Ingrese Codigo Postal..";
    }else if(codigoPostal.length <= 5){
        buscarAsentamientos();
    }

});

function buscarAsentamientos(){

    var codigoPostal = document.getElementById('codigoPostal').value;
    var xhr = new XMLHttpRequest();

    //Abre el archivo PHP con codigoPostal como parámetro
    xhr.open('GET',"/assets/php/buscarAsentamientos.php?codigoPostal=" + encodeURIComponent(codigoPostal));
    
    xhr.onreadystatechange = function(){

        if(xhr.readyState === 4 && xhr.status === 200){
            document.getElementById("resultado_cp").innerHTML = xhr.responseText;
        }

    }

    xhr.send()


}