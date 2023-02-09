function login() {
    let errors = $('.errors')
    let msg = ''

    $(errors).empty()
    $(errors).css('color', 'red')

    if ($('#email').val() === "") {
        msg  = document.createTextNode('Veuillez saisir l\'email!')
        $(errors).append(msg)
    } else if ($('#password') === "") {
        msg  = document.createTextNode('Veuillez saisir le password!')
        $(errors).append(msg)
    } else {
        $.ajax(
            {
                method: 'POST',
                url: "./utils.php",
                data: $('.form').serialize(),
                success: (data) => {
                    let response = JSON.parse(data)
                    if (!response['success']) {
                        let errorsMsgs = response['errors']

                        for (const key in errorsMsgs) {
                            $(errors).append(errorsMsgs[key] +  '\n')
                            $(errors).css('color', 'red')
                        }
                    } else {
                        alert(response['message'])
                    }
                },
                errors: () => {
                    alert("Erreur lors de la connexion")
                },
            }
        )
    }
}

/**
 * Permet de faire quelque vérif en front
 * et renvoyer les erreurs du back
 */
function register() {
    let p = document.createElement('p')
    let errors = $('.errors')
    $(errors).css('color', 'red')
    $(errors).empty()

    if ($('#name').val() === "") {
        let text = document.createTextNode('Veuillez saisir le nom!')
        p.appendChild(text)
        $(errors).append(p)
    } else if($('#firstname').val() === "") {
        let text = document.createTextNode('Veuillez saisir le prénom!')
        p.appendChild(text)
        $(errors).append(p)
    } else if($('#email').val() === "") {
        let text = document.createTextNode('Veuillez saisir l\'email!')
        p.appendChild(text)
        $(errors).append(p)
    } else if ($('#password').val() === "") {
        let text = document.createTextNode('Veuillez saisir le password!')
        p.appendChild(text)
        $(errors).append(p)
    } else if ($('#confirm-password').val() === "") {
        let text = document.createTextNode('Veuillez confirmer le password!')
        p.appendChild(text)
        $(errors).append(p)
    } else {
        $.ajax(
            {
                method:'POST',
                url: "./formRegistration.php",
                data: $('.form').serialize(),
                success: (data) => {
                    console.log(data);
                    let response = JSON.parse(data)
                    if (!response['success']) {
                        let errorsMsgs = response['errors']

                        for (const key in errorsMsgs) {
                            $(errors).append(errorsMsgs[key] + '\n')
                            $(errors).css('color', 'red')
                        }
                    } else {
                        alert(response['message'])
                        window.location.href = '../index.php'
                    }
                },
                errors: () => {
                    alert("Erreur lors de la connexion")
                },
            }
        )
    }
}