const campos = document.querySelectorAll('.campo input');

campos.forEach(input => {
    input.addEventListener('blur', function() {
        const divCampo = this.parentElement;

        if (this.value !== "") {
            if (!this.checkValidity()) {
             divCampo.classList.add('campo-error');
             divCampo.classList.remove('campo-correcto');
            } else {
                divCampo.classList.remove('campo-error');
                divCampo.classList.add('campo-correcto');
            }
        }
    });

    input.addEventListener('input', function() {
        this.parentElement.classList.remove('campo-error');
    });
});