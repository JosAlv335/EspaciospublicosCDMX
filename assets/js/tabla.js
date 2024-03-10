const SUPABASE_URL = 'https://tu-proyecto.supabase.co';
const SUPABASE_KEY = 'tu-clave-api-anon';

fetch(`${SUPABASE_URL}/rest/v1/espacios_publicos`, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'apikey': SUPABASE_KEY,
        'Authorization': `Bearer ${SUPABASE_KEY}`,
    },
})
.then(response => response.json())
.then(data => {
// Una vez recibidos los datos, llamas a una función para mostrarlos en la tabla
mostrarDatosEnTabla(data);
})
.catch(error => console.error('Error:', error));

//************************************************************//
//************************************************************//
//************************************************************//
//************************************************************//
//************************************************************//

function mostrarDatosEnTabla(data) {
    const tabla = document.createElement('table');
    const encabezado = document.createElement('tr');
  
    // Crea las celdas del encabezado de la tabla
    for (const campo in data[0]) {
      const th = document.createElement('th');
      th.textContent = campo;
      encabezado.appendChild(th);
    }
    tabla.appendChild(encabezado);
  
    // Crea las filas de datos
    data.forEach(registro => {
      const fila = document.createElement('tr');
      for (const campo in registro) {
        const celda = document.createElement('td');
        celda.textContent = registro[campo];
        fila.appendChild(celda);
      }
      tabla.appendChild(fila);
    });
  
    // Agrega la tabla al DOM
    document.getElementById('tabla-container').appendChild(tabla);
  }
  