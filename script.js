let menuVisible = false;
//Función que oculta o muestra el menu
function mostrarOcultarMenu(){
    if(menuVisible){
        document.getElementById("nav").classList ="";
        menuVisible = false;
    }else{
        document.getElementById("nav").classList ="responsive";
        menuVisible = true;
    }
}

  function descargarArchivo() {
  const link = document.createElement('a');
  link.href = "pdf/CV Hector Hernandez .pdf";
  link.download = "Curriculum"; // Opcional: Nombre de descarga
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link); // Limpiar el enlace
}


function seleccionar(){
    //oculto el menu una vez que selecciono una opcion
    document.getElementById("nav").classList = "";
    menuVisible = false;
}
//Funcion que aplica las animaciones de las habilidades
function efectoHabilidades(){
    var skills = document.getElementById("skills");
    var distancia_skills = window.innerHeight - skills.getBoundingClientRect().top;
    if(distancia_skills >= 300){
        let habilidades = document.getElementsByClassName("progreso");
        habilidades[0].classList.add("javascript");
        habilidades[1].classList.add("htmlcss");
        habilidades[2].classList.add("photoshop");
        habilidades[3].classList.add("wordpress");
        habilidades[4].classList.add("drupal");
        habilidades[5].classList.add("comunicacion");
        habilidades[6].classList.add("trabajo");
        habilidades[7].classList.add("creatividad");
        habilidades[8].classList.add("dedicacion");
        habilidades[9].classList.add("proyect");
    }
}


//detecto el scrolling para aplicar la animacion de la barra de habilidades
window.onscroll = function(){
    efectoHabilidades();
} 

//alertas del index
      const urlParams = new URLSearchParams(window.location.search);
      const mensaje = urlParams.get('mensaje');

      if (mensaje === '1') {
        Swal.fire({
          title: 'Mensaje enviado con exito',
          icon: 'success', // 'warning', 'error', 'info', 'question', 'sucess'
          timer: 5000, // Cerrar automáticamente después de 3 segundos (en milisegundos)
          timerProgressBar: true, // Mostrar una barra de progreso del tiempo
          confirmButtonText: 'Aceptar'
        });
        // Limpia el parámetro de la URL para que no se muestre la alerta al recargar
        window.history.replaceState({}, document.title, window.location.pathname);
      } else if (mensaje === 'error') {
        Swal.fire({
          title: 'Error',
          text: 'Hubo un error al enviar el mensaje.',
          icon: 'error', // 'warning', 'error', 'info', 'question', 'sucess'
          timer: 3000,
          timerProgressBar: true,
          confirmButtonText: 'Aceptar'
        });
        window.history.replaceState({}, document.title, window.location.pathname);
      }