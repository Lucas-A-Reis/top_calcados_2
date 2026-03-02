'use strict';

function sweetAlert(event) {
    event.preventDefault();

    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: data.status,
                title: data.title,
                text: data.message
            })
                .then(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        if (typeof grecaptcha !== 'undefined') {
                            grecaptcha.reset();
                        }
                    }
                })
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro na conexão com o servidor.'
            });
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        });
}