// Función para hacer una solicitud GET a la API de Supabase y buscar resultados en la tabla "parques"
async function buscarParques(caracter) {
    try {
        // Obtener el enlace de la API de Supabase de la variable de entorno pasada por PHP
        const apiUrl = 'https://zrwtmvescjmkdenhdaqh.supabase.co';
        
        // Realizar la solicitud GET a la API de Supabase
        const response = await fetch(`${apiUrl}/parques?nombre=ilike.${caracter}%`);
        
        // Verificar si la solicitud fue exitosa (código de estado 200)
        if (!response.ok) {
            throw new Error('Error al buscar parques');
        }

        // Obtener los datos de la respuesta
        const data = await response.json();
        
        // Limpiar la tabla de resultados y los encabezados
        const tablaResultados = document.getElementById('tabla-resultados');
        const tbody = tablaResultados.querySelector('tbody');
        const encabezados = document.getElementById('encabezados');
        tbody.innerHTML = '';
        encabezados.innerHTML = '';

        // Agregar los encabezados de la tabla
        const columnas = Object.keys(data[0]);
        const encabezadosHTML = columnas.map(columna => `<th>${columna}</th>`).join('');
        encabezados.innerHTML = `<tr>${encabezadosHTML}</tr>`;

        // Agregar los resultados a la tabla
        data.forEach(registro => {
            const fila = columnas.map(columna => `<td>${registro[columna]}</td>`).join('');
            tbody.innerHTML += `<tr>${fila}</tr>`;
        });
    } catch (error) {
        console.error('Error:', error);
    }
}

// Obtener el cuadro de texto de búsqueda
const busquedaInput = document.getElementById('campoBusqueda');

// Escuchar el evento "input" en el cuadro de texto de búsqueda
busquedaInput.addEventListener('input', function() {
    // Obtener el valor del cuadro de texto
    const caracter = this.value.trim();

    // Llamar a la función buscarParques con el carácter ingresado
    buscarParques(caracter);
});
