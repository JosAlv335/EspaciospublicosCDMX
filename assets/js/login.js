import { createClient } from '@supabase/supabase-js'

const supabase = createClient(process.env.REST_URL, process.env.REST_PUBLIC_KEY)



// Ejemplo de cómo podrías capturar el evento de submit de un formulario
document.getElementById('sign-in-form').addEventListener('submit', function(e) {
    e.preventDefault() // Evita el envío tradicional del formulario
  
    // Obtiene los valores del formulario
    const email = document.getElementById('sign-in-mail').value
    const password = document.getElementById('sign-in-password').value
  
    // Llama a la función de inicio de sesión
    signIn(email, password)
  })
  

async function signIn(email, password) {
    const { user, session, error } = await supabase.auth.signIn({
      email: email,
      password: password,
    })
  
    if (error) {
        console.error('Error en el inicio de sesión:', error.message);
        document.getElementById('sign-in-error').innerText = error.message;

    } else {
        console.log('Inicio de sesión exitoso', user, session)
        // Aquí puedes redirigir al usuario a otra página o manejar la sesión como prefieras
        window.location.href = '../../paginas/tabla.html';
    }
  }
  