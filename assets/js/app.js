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

function cargarImagenes(){

    $.ajax({

        url:"ajax/obtener_imagenes.php",
        type:"GET",

        success:function(respuesta){

            let datos = JSON.parse(respuesta);

            let carrusel = '';
            let galeria = '';

            datos.forEach((img,index)=>{

                carrusel += `

                <div class="carousel-item ${index==0 ? 'active':''}">

                    <img 
                        src="${img.ruta}"
                        class="d-block w-100 carrusel-img"
                    >

                </div>

                `;

                galeria += `

                <div class="col-md-3 mb-4">

                    <div class="card shadow">

                        <img 
                            src="${img.ruta}"
                            class="card-img-top"
                            style="height:200px;object-fit:cover;"
                        >

                        <div class="card-body text-center">

                            <button 
                                class="btn btn-danger"
                                onclick="eliminarImagen(${img.id})"
                            >
                                Eliminar
                            </button>

                        </div>

                    </div>

                </div>

                `;
            });

            $("#contenedorCarrusel").html(carrusel);

            $("#galeria").html(galeria);

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