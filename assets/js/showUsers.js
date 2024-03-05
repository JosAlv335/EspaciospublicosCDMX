const supabaseUrl = "https://zrwtmvescjmkdenhdaqh.supabase.co";
const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Inpyd3RtdmVzY2pta2RlbmhkYXFoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MDk2MDA2ODEsImV4cCI6MjAyNTE3NjY4MX0.nWS7r3cCN_xhpTehJk71wQ19C7JsBuhF66MamPHpNWs";

// Función para obtener y mostrar los usuarios en una tabla
async function showUsers() {
    const url = `${supabaseUrl}/rest/v1/usuarios`;
    const method = 'GET';
    const data = {};

    try {
        const response = await makeRequest(url, method, data);
        const users = response.data; // Extraer los datos de la respuesta

        // Generar la tabla HTML
        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');

        // Crear la fila de encabezado de la tabla
        const headerRow = document.createElement('tr');
        const headers = Object.keys(users[0]); // Obtener los nombres de las columnas

        headers.forEach(header => {
            const th = document.createElement('th');
            th.textContent = header;
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);
        table.appendChild(thead);

        // Crear filas para cada usuario
        users.forEach(user => {
            const tr = document.createElement('tr');

            Object.values(user).forEach(value => {
                const td = document.createElement('td');
                td.textContent = value;
                tr.appendChild(td);
            });

            tbody.appendChild(tr);
        });

        table.appendChild(tbody);

        // Agregar la tabla al DOM
        const container = document.getElementById('user-table-container');
        container.innerHTML = '';
        container.appendChild(table);
    } catch (error) {
        console.error('Error al obtener usuarios:', error);
    }
}