const supabase = createClient(process.env.REST_URL, process.env.REST_PUBLIC_KEY)

document.addEventListener('DOMContentLoaded',function(){
    // Ejemplo de cómo podrías capturar el evento de submit de un formulario
    document.getElementById('sign-up-form').addEventListener('submit', function(e) {
        e.preventDefault() // Evita el envío tradicional del formulario
        console.log("Evento capturado");
    
        // Obtiene los valores del formulario
        const email = document.getElementById('sign-up-mail').value
        const password = document.getElementById('sign-up-password').value
    
        // Llama a la función de inicio de sesión
        signUp(email, password)
    })
})


  

async function signUp(email, password) {
    const { user, session, error } = await supabase.auth.signUp({
      email: email,
      password: password,
    })
  
    if (error) {
        console.error('Error en el registro del usuario:', error.message);
        document.getElementById('mensaje_sign_up').innerText = error.message;

    } else {
        console.log('Registro exitoso', user, session)

        const { insertError } = await supabase
        .from('users')
        .insert({
            nombre: document.getElementById('sign-up-name').value,
            apellido1: document.getElementById('sign-up-apellido1').value,
            apellido2: document.getElementById('sign-up-apellido2').value,
            correo: email,
            contrasena: password
        })
        if(insertError){
            console.error('Error en el registro de usuario:', insertError.message);
            document.getElementById('mensaje_sign_up').innerText = insertError.message;
        }else{
            console.log('Insercion de datos exitosa')
        }

        

        // Aquí puedes redirigir al usuario a otra página o manejar la sesión como prefieras
        //window.location.href = '../../paginas/tabla.html';
    }
  }
  