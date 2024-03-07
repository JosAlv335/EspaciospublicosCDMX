const SUPABASE_REST_URL = process.env.REST_URL;
const SUPABASE_REST_KEY = process.env.REST_PUBLIC_KEY;

async function showSearchResults(busqueda){


    try {

        const main_url = SUPABASE_REST_KEY + "/rest/v1"

        const request_url = main_url + "/parques?nombre=ilike.${busqueda}%";

        const response = await fetch(request_url);

        if(!response.ok){
            throw new Error('No matches found...');
        }

        //Obtener los datos de la respuesta
        const data = await response.json();

        //Limpiar la tabla de resultados
        const tablaResultados = document.getElementById('resultado-busqueda');
        const tbody = tablaResultados.querySelector('tbody');
        tbody.innerHTML = "";

        // Agregar los resultados a la tabla
        data.forEach(parque => {
            const fila = `
                <tr>
                    <td>${parque.id}</td>
                    <td>${parque.nombre}</td>
                    <td>${parque.direccion}</td>
                    <td>${parque.ciudad}</td>
                </tr>
            `;
            tbody.innerHTML += fila;
        });
    } catch (error) {
        console.error('Error:', error);
    }

}
