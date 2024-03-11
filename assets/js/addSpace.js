document.getElementById('codigoPostal').addEventListener('input', function() {
    var codigoPostal = this.value;
    if(codigoPostal.length == 0){
        document.getElementById("codigoPostal").innerHTML = "Ingrese Codigo Postal..";
    }else if (codigoPostal.length <= 5) { // Verificar si el código postal tiene la longitud adecuada
        buscarAsentamientos();
    }
});

function buscarAsentamientos() {
    
    var codigoPostal = document.getElementById('codigoPostal').value;
    var url = '../assets/php/buscarAsentamientos.php?codigoPostal=' + encodeURIComponent(codigoPostal);

    fetch(url)
    .then(response => response.json())
    .then(data => {
        // Limpiar las opciones existentes en las listas desplegables
        document.getElementById("estado").innerHTML = '';
        document.getElementById("ciudad_municipio").innerHTML = '';
        document.getElementById("asentamiento").innerHTML = '';

        // Llenar las listas desplegables con las opciones recibidas en data
        data.estados.forEach(function(estado) {
            var option = document.createElement('option');
            option.value = estado;
            option.text = estado;
            estadoSelect.appendChild(option);
        });

        // Agregar las nuevas opciones de municipios
        data.municipios.forEach(function(municipio) {
            var option = document.createElement('option');
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });

        // Agregar las nuevas opciones de asentamientos
        data.asentamientos.forEach(function(asentamiento) {
            var option = document.createElement('option');
            option.value = asentamiento;
            option.text = asentamiento;
            asentamientoSelect.appendChild(option);
        })
        .catch(error => console.error('Error:', error));

    })
    
    

}