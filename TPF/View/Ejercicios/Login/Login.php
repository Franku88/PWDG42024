<?php
include_once '../../../configuracion.php';
include STRUCTURE_PATH . '/Head.php';
$session = new Session();
if ($session->validar()) {
    header('Location: ../../Ejercicios/Tienda/Tienda.php');
}
?>

<div class="container py-4">
    <div class="text-center p-2 bg-steam-lightgreen bdr-steam-nofocus mx-auto rounded-4" style="margin-top: 200px; max-width: 400px;">
        <h2 class="m-4">Login</h2>
        <form id="loginForm" class="bg-steam-darkgreen bdr-steam-focus rounded-4 m-4 d-flex flex-column justify-content-center align-items-center p-5 gap-5">
            <input
                type="text"
                name="user"
                id="user"
                placeholder="Usuario"
                class="border-0 border-bottom p-2 bg-transparent text-white"
                style="outline: none; box-shadow: none;"
                required>
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Contraseña"
                class="border-0 border-bottom p-2 bg-transparent text-white"
                style="outline: none; box-shadow: none;"
                required>
            <button type="submit" class="btn btn-primary btn-steam">Ingresar</button>
        </form>
        <div id="messageContainer" class="text-center mt-3 p-2 rounded-3 w-100 mx-auto text-white d-none"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                const formData = {
                    user: $('#user').val(),
                    password: $('#password').val()
                };

                const messageContainer = $('#messageContainer');
                messageContainer.removeClass('d-none bg-danger bg-success').text('');

                $.ajax({
                    url: 'LoginAction.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            messageContainer
                                .addClass('bg-success')
                                .text('Inicio de sesión exitoso. Redirigiendo...');
                            setTimeout(function() {
                                window.location.href = '../../Ejercicios/Tienda/Tienda.php';
                            }, 2000);
                        } else {
                            messageContainer
                                .addClass('bg-danger')
                                .text(response);
                        }
                    },
                    error: function() {
                        messageContainer
                            .addClass('bg-danger')
                            .text('Ocurrió un error al procesar la solicitud.');
                    }
                });
            });
        });
    </script>
</div>

<?php include STRUCTURE_PATH . '/Foot.php'; ?>
