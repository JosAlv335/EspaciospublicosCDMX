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
    .then(response => {
        if (!response.ok) {
            throw new Error('Hubo un problema con la solicitud: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Hola");
        
        // Obtener referencias a los elementos select
        var estadoSelect = document.getElementById('estado');
        var municipioSelect = document.getElementById('ciudad_municipio');
        var asentamientoSelect = document.getElementById('asentamiento');

        


        // Llenar las listas desplegables con las opciones recibidas en data
        data.estados.forEach(function(estado) {
            var option = document.createElement('option'); 
            option.text = estado;console.log(option.text);
            option.value = estado;console.log(option.value);
            estadoSelect.appendChild(option);
        });

        // Agregar las nuevas opciones de municipios
        data.municipios.forEach(function(municipio) {
            var option = document.createElement('option');
            option.text = municipio;
            option.value = municipio;
            municipioSelect.appendChild(option);
        });

        // Agregar las nuevas opciones de asentamientos
        data.asentamientos.forEach(function(asentamiento) {
            var option = document.createElement('option');
            option.text = asentamiento;
            option.value = asentamiento;
            asentamientoSelect.appendChild(option);
        })
        

    }).catch(error => {
        console.error('Error en la solicitud AJAX:', error);
        // Mostrar un mensaje de error al usuario o realizar otras acciones apropiadas
    });
    
    

}