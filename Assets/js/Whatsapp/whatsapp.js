

const $form = document.querySelector('#form');
const buttonSubmit = document.querySelector('#submit');
const urlDesktop = 'https://web.whatsapp.com/';
const urlMobile = 'whatsapp://';
const phone = '75881611';


$form.addEventListener('submit', (event) => {
    event.preventDefault()
    buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
    buttonSubmit.disabled = true

    setTimeout(() => {
        let name = document.querySelector('#name').value
        let lastname = document.querySelector('#lastname').value
        let email = document.querySelector('#email').value
        let message = 'send?phone=' + phone + '&text=*" Bienvenid@ a Romeo y Julieta, estamos para servirte, llena los siguientes campos para que un operador se ponga en contacto contigo.*%0A¿Cual es tu nombre?*%0A' + name + '%0A*¿Cuál es tu apellido?*%0A' + lastname + '%0A*¿Cuál es tu correo?*%0A' + email + '%0A*¿Cuál es su problema?*%0A'


        if (isMobile()) {
            window.open(urlMobile + message, '_blank')
        } else {
            window.open(urlDesktop + message, '_blank')
        }

        buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
        buttonSubmit.disabled = false

    }, 4000);

});
