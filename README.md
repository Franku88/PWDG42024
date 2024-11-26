# [PWDG42024]

## Integrantes:
- [FAI-3169] Benitez, Franco Fabian
- [FAI-4594] Pesce, Matías Nicolás
- [FAI-3220] Reyes Castelló, José Vicente



## Requisitos

Asegurarse de tener instalados los siguientes programas:
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)

## Instalación

Para instalar el proyecto, seguir los siguientes pasos:

1. Clonar el repositorio en htdocs:

    ```bash
    git clone https://github.com/Franku88/PWDG42024.git
    ```

2. Acceder al directorio del proyecto:

    ```bash
    cd TPF
    ```

3. Instalar las dependencias con Composer:

    ```bash
    composer install
    ```
    
4. Instalar las clases utilizadas con Composer:
    ```bash
    composer require nesbot/carbon
    composer require phpmailer/phpmailer
    composer require tecnickcom/tcpdf
    ```

## Aclaración
- La funcion cambiarEstado() del archivo /Controller/ABMCompra.php usa PHPMailer
- Esto implica que si no estableces las variables $emailOrigen y $passOrigen (Correo y contraseña del Emisor), no funcionara como corresponde
- Una forma segura, es utilizando una Contraseña de Aplicacion, la misma se puede generar con tu cuenta de Gmail (Tu Gmail debe tener verificaion de dos pasos, Googlea al respecto)
- Valores predeterminados $emailOrigen='' y $passOrigen='',
