

// Hacer la solicitud HTTP al archivo PHP que maneja la comunicación con Supabase
fetch('../assets/php/tabla.php')
  .then(response => response.json())
  .then(data => {
    // Verificar si data es un array y tiene elementos
    if (Array.isArray(data) && data.length > 0) {
      // Una vez recibidos los datos, llamar a una función para mostrarlos en la tabla
      mostrarDatosEnTabla(data);
    } else {
      console.error('Error: No se encontraron datos');
    }
  })
  .catch(error => console.error('Error:', error));

// Función para mostrar los datos en una tabla
function mostrarDatosEnTabla(data) {
  const tabla = document.createElement('table');
  const encabezado = document.createElement('tr');

  // Crear las celdas del encabezado de la tabla
  for (const campo in data[0]) {
    const th = document.createElement('th');
    th.textContent = campo;
    encabezado.appendChild(th);
  }
  tabla.appendChild(encabezado);

  // Crear las filas de datos
  data.forEach(registro => {
    const fila = document.createElement('tr');
    for (const campo in registro) {
      const celda = document.createElement('td');
      celda.textContent = registro[campo];
      fila.appendChild(celda);
    }
    tabla.appendChild(fila);
  });

  // Agregar la tabla al DOM
  document.getElementById('tabla-parques').appendChild(tabla);
}
