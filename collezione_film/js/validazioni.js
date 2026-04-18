// Validazione email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Verifica email duplicate tramite AJAX
async function checkEmailExists(email) {
    try {
        const response = await fetch('actions/check_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'email=' + encodeURIComponent(email)
        });
        const data = await response.json();
        return data.exists;
    } catch (error) {
        console.error('Errore nel controllo email:', error);
        return false;
    }
}

// Validazione form registrazione
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('form[action="actions/register.php"]');
    if (registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const nome = document.querySelector('input[name="nome"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const password = document.querySelector('input[name="password"]').value;

            // Validazione nome
            if (!nome || nome.length < 2) {
                alert('⚠️ Inserisci un nome valido (minimo 2 caratteri)');
                return;
            }

            // Validazione email
            if (!isValidEmail(email)) {
                alert('⚠️ Inserisci un\'email valida');
                return;
            }

            // Controlla email duplicate
            const emailExists = await checkEmailExists(email);
            if (emailExists) {
                alert('⚠️ Questa email è già registrata');
                return;
            }

            // Validazione password
            if (password.length < 6) {
                alert('⚠️ La password deve avere almeno 6 caratteri');
                return;
            }

            // Se tutto è valido, invia il form
            this.submit();
        });
    }

    // Validazione form login
    const loginForm = document.querySelector('form[action="actions/login.php"]');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.querySelector('input[name="email"]').value.trim();
            const password = document.querySelector('input[name="password"]').value;

            if (!isValidEmail(email)) {
                alert('⚠️ Inserisci un\'email valida');
                return;
            }

            if (!password) {
                alert('⚠️ Inserisci la password');
                return;
            }

            this.submit();
        });
    }

    // Validazione form aggiunta film
    const filmForm = document.querySelector('form[action="actions/add_film.php"]');
    if (filmForm) {
        filmForm.addEventListener('submit', function(e) {
            const nome = document.querySelector('input[name="nome"]').value.trim();
            const anno = document.querySelector('input[name="anno"]').value;
            const regista = document.querySelector('input[name="regista"]').value.trim();
            const voto = document.querySelector('input[name="voto"]').value;

            if (!nome || nome.length < 2) {
                alert('⚠️ Inserisci un nome di film valido');
                e.preventDefault();
                return;
            }

            if (!anno || anno < 1800 || anno > new Date().getFullYear() + 1) {
                alert('⚠️ Inserisci un anno valido');
                e.preventDefault();
                return;
            }

            if (!regista || regista.length < 2) {
                alert('⚠️ Inserisci un nome di regista valido');
                e.preventDefault();
                return;
            }

            if (!voto || voto < 1 || voto > 10) {
                alert('⚠️ Inserisci un voto tra 1 e 10');
                e.preventDefault();
                return;
            }
        });
    }
});

// Pop-up errore login (gestito tramite URL parameter)
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const errorType = urlParams.get('error');

    if (errorType === 'credenziali') {
        alert('❌ Email o password non validi. Riprova!');
    } else if (errorType === 'campi') {
        alert('⚠️ Compila tutti i campi');
    } else if (errorType === 'email') {
        alert('⚠️ Questa email è già registrata');
        const emailInput = document.querySelector('input[name="email"]');
        if (emailInput) {
            emailInput.focus();
        }
    } else if (errorType === 'email_format') {
        alert('⚠️ Formato email non valido');
        const emailInput = document.querySelector('input[name="email"]');
        if (emailInput) {
            emailInput.focus();
        }
    }
});
