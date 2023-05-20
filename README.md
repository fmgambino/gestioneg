[circleci-image]: https://img.shields.io/circleci/build/github/nestjs/nest/master?token=abc123def456
[circleci-url]: https://circleci.com/gh/nestjs/nest

# mi-iPhone
Sistema de Gestion p/Taller de Reparaciones Celulares/Computadoras.

![MI-iPhone](https://i.ibb.co/Vw5dvQY/logo-MI-i-Phone.png)

![version](https://img.shields.io/badge/version-1.0.0-blue.svg?longCache=true&style=flat-square)
![license](https://img.shields.io/badge/license-MIT-green.svg?longCache=true&style=flat-square)
![theme](https://img.shields.io/badge/theme-Matrix--Admin-lightgrey.svg?longCache=true&style=flat-square)


### Contacto: soporte@nexo-life.com
### [Web](https://electronicagambino.com) - NEXO-LIFE

![MI-iPhone](https://i.ibb.co/Y7hGkXn/dash-MI-i-Phone.png)

### [Instalación](Instalacao_xampp_windows.md)

1. Descargar o Clonar repositorio en LocalHost
2. Extraiga el paquete y cópielo en su servidor web.
3. Verifique que su servidor tenga PHP 7.4
4. Ubique la raiz del proyecto. Ej.
    $ ls composer  domains  public_html
    $ cd public_html/
    $ ls

4. Ejecute el comando `composer install --no-dev` desde la raíz del proyecto.
    $ composer install --no-dev
5. Si le da el siguiente error: 

    Problem 1
    - Installation request for piggly/php-pix 1.2.8 -> satisfiable by piggly/php-pix[1.2.8].
    - piggly/php-pix 1.2.8 requires php ^7.2 -> your PHP version (8.0.28) does not satisfy that requirement.
    
Verifique su version de PHP que sea 7.4 Luego intente nuevamente:
    $ composer install --no-dev

6. Accede a tu URL y comienza la instalación, es muy simple, solo completa la información en el asistente de instalación de **MI-iPhone**.

### ¡ IMPORTANTE !

En caso que utilice Git en su Hosting (Ej. Hostinger), mediante websokets, continue con los siguientes comandos:

$ cd application/
cache/       core/        helpers/     index.html   models/      vendor/
config/      database/    hooks/       language/    modules/     views/
controllers/ errors/      .htaccess    libraries/   third_party/

$ cd application/config/
$ cat database.default.php > database.php
$ nano database.php // Configuramos nuestra base de datos
$ nano config.php //

5. Configure el correo electrónico de envío en el archivo email.php.
6. Configure los trabajos cron para el envío de correo electrónico:
    ##### Enviar correos electrónicos pendientes cada 2 minutos.
    - */2 * * * * php /var/www/index.php correo electrónico/proceso
    ##### Enviar correos electrónicos fallidos cada 5 minutos.
    - */5 * * * * php /var/www/index.php correo electrónico/reintentar

    ##### Nota: La ruta a index.php (/var/www/) debe configurarse de acuerdo con su entorno

### Actualización a través del sistema

1. Primero, es necesario actualizar manualmente el sistema a la versión v1.1.0;
2. En esta versión, es posible actualizar el sistema haciendo clic en el botón "Actualizar MI-iPhone" en Sistema >> Configuración;
3. Todos los archivos excepto: `config.php`, `database.php` y `email.php` serán descargados y actualizados;

### Comandos de terminal

Para enumerar todos los comandos de terminal disponibles, simplemente ejecute el comando `php index.php tools` desde la raíz del proyecto, después de que finalice todo el proceso de instalación.
