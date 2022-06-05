export function formulario() {
  
    let formulario = document.getElementById('datos_formulario');

    formulario.addEventListener('submit', e=>{
        e.preventDefault();
        
        let removerClase = document.querySelectorAll('.remover');
        let botonEnviar = document.querySelector('.boton-enviar');
        let $loader = document.querySelector('.loader');
        let input = document.querySelectorAll(".label-input-container");

        const colocarErrores = (i) =>{
            i.forEach(element => {
                element.classList.add("padding-top-label");
            });
        }

        const limpiarErrores = (inp) =>{
            inp.forEach(element => {
              element.classList.remove("padding-top-label");
            });
        }
        
        //Activar Loader
        botonEnviar.style.display ="none";
        $loader.setAttribute("id","show");

        
        if(removerClase.length > 0){
            for(let i = 0; i< removerClase.length; i++ ){
                removerClase[i].parentNode.removeChild(removerClase[i])
            }
        }
        
        //Crear instancia de objeto para luego vincularlo.
        let datos = new FormData(formulario);

        let peticion = {
            method:'POST',
            body:datos,
        }

        fetch('php/recibir-data-formulario.php',peticion)
             //Primera promesa que contiene una respuesta, que sera recibida en formato json
            .then(respuesta => respuesta.json())
            //Segunda promesa que sera nuestra respuesta que contendra toda la info, la respuesta del servidor
            .then(respuesta =>{
                
                //Si la respuesta esta ok te envia a la pag. principal
                if(respuesta['respuesta']){
                    window.location.href = "https://asesoramientoaams.com/mensajeEnviado.html";
                
                //Si contiene algu error: popUp.
                }else{
                    console.log(respuesta);
                    for(const resultado in respuesta){
                        let padre = document.querySelector('#'+resultado);
                        padre.classList.add("resaltar");
                        colocarErrores(input);
                        let txt = document.createElement('p');
                        txt.classList.add('text-mi');
                        txt.classList.add('remover');
                        txt.innerHTML = respuesta[resultado];
                        document.querySelector('#'+resultado).insertAdjacentElement('afterend', txt);
                        swal("Alerta", "Formulario cuenta con errores", "error");
                    }

                    //Desactivar loader Loader
                    botonEnviar.style.display ="flex";
                    $loader.style.display = "none";
                 
                   
                

        
                }

            }).catch(error =>console.warn('error', error));

    });
   
	 
}