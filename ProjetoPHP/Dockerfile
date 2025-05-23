FROM php:8.1  
WORKDIR /app  
COPY . .  
RUN composer install  
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]  
EXPOSE 8000
