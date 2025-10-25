// Validación en tiempo real para campos únicos
function setupRealTimeValidation() {
    const fields = ['username', 'email', 'matricula'];
    const timeouts = {};

    fields.forEach(field => {
        $('#signupform-' + field).on('input', function () {
            clearTimeout(timeouts[field]);
            timeouts[field] = setTimeout(() => validateField(field), 800);
        });
    });

    // Validación en tiempo real para contraseñas
    $('#signupform-password, #signupform-password_repeat').on('input', function () {
        validatePasswordMatch();
    });
}

function validateField(attribute) {
    const value = $('#signupform-' + attribute).val();

    // Si el campo está vacío, no validar
    if (!value || value.trim() === '') {
        return;
    }

    const data = {
        'validationAttributes[]': attribute,
        _csrf: yii.getCsrfToken()
    };
    data['SignupForm[' + attribute + ']'] = value;

    $.ajax({
        url: validateUrl,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            const input = $('#signupform-' + attribute);
            const errorContainer = $(`#signupform-${attribute}-error`);

            if (response[attribute] && response[attribute].length > 0) {
                input.addClass('is-invalid').removeClass('is-valid');
                if (errorContainer.length) {
                    errorContainer.text(response[attribute][0]);
                    errorContainer.show();
                }
            } else {
                input.addClass('is-valid').removeClass('is-invalid');
                if (errorContainer.length) {
                    errorContainer.text('');
                    errorContainer.hide();
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en validación AJAX:', error);
        }
    });
}

function validatePasswordMatch() {
    const password = $('#signupform-password').val();
    const passwordRepeat = $('#signupform-password_repeat').val();
    const passwordInput = $('#signupform-password');
    const repeatInput = $('#signupform-password_repeat');
    const errorContainer = $(`#signupform-password_repeat-error`);

    // Si ambos campos están vacíos, no mostrar error
    if (password === '' && passwordRepeat === '') {
        passwordInput.removeClass('is-invalid is-valid');
        repeatInput.removeClass('is-invalid is-valid');
        if (errorContainer.length) {
            errorContainer.text('');
            errorContainer.hide();
        }
        return;
    }

    // Validar coincidencia solo si ambos campos tienen valor
    if (passwordRepeat !== '' && password !== passwordRepeat) {
        repeatInput.addClass('is-invalid').removeClass('is-valid');
        if (errorContainer.length) {
            errorContainer.text('Las contraseñas no coinciden.');
            errorContainer.show();
        }
    } else if (passwordRepeat !== '') {
        repeatInput.addClass('is-valid').removeClass('is-invalid');
        if (errorContainer.length) {
            errorContainer.text('');
            errorContainer.hide();
        }
    }
}

// Manejar el evento de envío del formulario
function handleFormSubmit() {
    $('#form-signup').on('beforeSubmit', function (e) {
        // Validar contraseñas antes del envío
        validatePasswordMatch();

        const hasErrors = $('.is-invalid').length > 0;
        if (hasErrors) {
            return false;
        }
        return true;
    });
}

$(document).ready(function () {
    setupRealTimeValidation();
    handleFormSubmit();
});