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

        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
    
            // Llenar el campo de selección de estados
            var estadoSelect = document.getElementById('estado');
            response.estados.forEach(function(estado) {
                var option = document.createElement('option');
                option.value = estado;
                option.text = estado;
                estadoSelect.appendChild(option);
            });
    
            // Llenar el campo de selección de municipios
            var municipioSelect = document.getElementById('ciudad_municipio');
            response.municipios.forEach(function(municipio) {
                var option = document.createElement('option');
                option.value = municipio;
                option.text = municipio;
                municipioSelect.appendChild(option);
            });
    
            // Llenar el campo de selección de asentamientos
            var asentamientoSelect = document.getElementById('asentamiento');
            response.asentamientos.forEach(function(asentamiento) {
                var option = document.createElement('option');
                option.value = asentamiento;
                option.text = asentamiento;
                asentamientoSelect.appendChild(option);
            });
        }

    }

    xhr.send()


}