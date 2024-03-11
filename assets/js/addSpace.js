document.getElementById('codigoPostal').addEventListener('input', function() {
    var codigoPostal = this.value;
    if (codigoPostal.length <= 5) { // Verificar si el código postal tiene la longitud adecuada
        buscarAsentamientos(codigoPostal);
    }
});

function buscarAsentamientos(codigoPostal) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'buscar_asentamientos.php?codigoPostal=' + encodeURIComponent(codigoPostal), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            actualizarAsentamientos(response);
        }
    };
    xhr.send();
}

function actualizarAsentamientos(asentamientos) {
    var selectAsentamiento = document.getElementById('asentamiento');
    selectAsentamiento.innerHTML = '<option value="" selected>Selecciona un asentamiento</option>';
    asentamientos.forEach(function(asentamiento) {
        var option = document.createElement('option');
        option.value = asentamiento;
        option.textContent = asentamiento;
        selectAsentamiento.appendChild(option);
    });
    selectAsentamiento.disabled = false;
}
