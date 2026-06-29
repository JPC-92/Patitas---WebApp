const fecha = document.getElementById('fecha_cita');
const hora = document.getElementById('hora_cita');

fecha.addEventListener('change', function() {
    const fechaElegida = new Date(this.value);
    const dia = fechaElegida.getUTCDay();
    
    // No permitimos los fines de semana
    if (dia === 0 || dia === 6) {
        alert ('Solo abrimos de Lunes a Viernes');
        this.value = '';
        reiniciarHoras();
        return;
    }

    // preparamos los datos por POST
    const datos= new FormData();
    datos.append('fecha', this.value);

    // Peticion AJAX con Fetch para consultar las horas ocupadas
    fetch('../controladores/consultar_horas.php' , {
        method: 'POST',
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(horasOcupadas => {
        reiniciarHoras();

        // Bloquamos las horas que nos devuelve PHP
        for (let i = 0; i < hora.options.length; i++) {
            let opcion = hora.options[i];

            if (horasOcupadas.includes(opcion.value)) {
                opcion.disabled = true;
                opcion.text = opcion.value + ' (Ocupado)';
            }
        }
    })
    .catch(error => console.error('Error en la peticion AJAX:', error));
});

// Funcion para resetear el desplegable
function reiniciarHoras() {
    for (let i = 0; i < hora.options.length; i++) {
        hora.options[i].disabled = false;

        if (hora.options[i].value !== "") {
            hora.options[i].text = hora.options[i].value;
        }
    }
    hora.value = "";
}