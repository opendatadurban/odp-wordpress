FROM wordpress:latest

# Copy custom themes and plugins
COPY wp-content/themes /var/www/html/wp-content/themes
COPY wp-content/plugins /var/www/html/wp-content/plugins

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/wp-content

CMD ["apache2-foreground"]
