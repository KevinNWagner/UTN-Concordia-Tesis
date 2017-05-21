Cuando importes el codigo de github, deberas ejecutar en consola la siguiente linea
->   composer update

La base de datos esta en directorio principal ¨db_administracion_colectivos.sql¨

Para agregarla debes, crear una base de datos en Mysql llamada ¨db_administracion_colectivos¨,
luego precionar el boton de importar , y importa el archivo antes mencionado con extencion (.sql)

Despues de esto deberas configurar el archivo .env , si no posees uno deberas crearlo o 
copiar el .env.example , renombrarlo y cambiar los parametros necesarios.

Si laravel da un error de encriptacion , deberas ejecutar en la consola la siguiente linea
->    php artisan key:generate

El login general es : 
user -> kevinwagner
pass -> telefunken

  