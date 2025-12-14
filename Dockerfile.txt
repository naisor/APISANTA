# Usa una imagen base de PHP oficial (ej: PHP 8.2 con Apache)
FROM php:8.2-apache

# Copia todos tus archivos PHP al directorio de documentos de Apache
COPY . /var/www/html/

# Expon el puerto 80 (el puerto HTTP estándar de Apache)
EXPOSE 80

# Comando para iniciar el servidor (Apache ya está configurado)
CMD ["apache2-foreground"]