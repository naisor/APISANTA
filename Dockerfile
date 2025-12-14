# Usa la imagen base de PHP con Apache
FROM php:8.2-apache

# 🚨 AGREGAR INSTALACIÓN DE LA EXTENSIÓN MYSQLI 🚨
# 'docker-php-ext-install' es el comando estándar de Docker para instalar extensiones de PHP.
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-enable mysqli

# Copia todos tus archivos PHP al directorio de documentos de Apache
COPY . /var/www/html/

# Expon el puerto 80
EXPOSE 80

# Comando para iniciar el servidor (Apache)
CMD ["apache2-foreground"]