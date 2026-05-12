$(document).ready(function(){

    cargarImagenes();

    $("#formImagen").submit(function(e){

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({

            url:"ajax/subir_imagen.php",

            type:"POST",

            data:formData,

            contentType:false,

            processData:false,

            success:function(respuesta){

                alert(respuesta);

                cargarImagenes();

                $("#formImagen")[0].reset();

            }

        });

    });

});


//
function cargarImagenes() {
    $.ajax({
        url: "ajax/obtener_imagenes.php",
        type: "GET",
        success: function(respuesta) {
            try {
                let datos = JSON.parse(respuesta);
                let carrusel = '';
                let galeria = '';

                // Definimos la base exacta según tu servidor
                const baseUrl = "http://localhost:8012/GaleriaAjax/";

                datos.forEach((img, index) => {
                    // 1. Limpiamos la ruta que viene de la DB por si tiene basura
                    let rutaLimpia = img.ruta.trim();
                    
                    // 2. Si la ruta de la DB no incluye "uploads/", se lo ponemos
                    // (Esto depende de cómo guardes en la DB, normalmente ya lo trae)
                    if (!rutaLimpia.startsWith('uploads/')) {
                        rutaLimpia = 'uploads/' + rutaLimpia;
                    }

                    // 3. Construimos la URL final absoluta
                    let urlFinal = baseUrl + rutaLimpia;

                    // Carrusel
                    carrusel += `
                    <div class="carousel-item ${index == 0 ? 'active' : ''}">
                        <img src="${urlFinal}" class="d-block w-100 carrusel-img" style="height:500px; object-fit:cover;">
                    </div>`;

                    // Galería
                    galeria += `
                    <div class="col-md-3 mb-4">
                        <div class="card shadow">
                            <img src="${urlFinal}" class="card-img-top" style="height:200px; object-fit:cover;">
                            <div class="card-body text-center">
                                <button class="btn btn-danger" onclick="eliminarImagen(${img.id})">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>`;
                });

                $("#contenedorCarrusel").html(carrusel);
                $("#galeria").html(galeria);

            } catch (e) {
                console.error("Error al procesar JSON:", e);
                console.log("Respuesta recibida:", respuesta);
            }
        }
    });
}

function eliminarImagen(id){

    if(confirm("¿Eliminar imagen?")){

        $.ajax({

            url:"ajax/eliminar_imagen.php",

            type:"POST",

            data:{id:id},

            success:function(respuesta){

                alert(respuesta);

                cargarImagenes();

            }

        });

    }

}