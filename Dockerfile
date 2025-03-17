FROM --platform=linux/arm64 wordpress:latest

# Create directory for custom theme
RUN mkdir -p /usr/src/coct-theme

# Copy custom theme files from the repository
COPY html/wp-content/themes/coct-theme /usr/src/coct-theme/

# Copy the themes installation script
COPY install-themes.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/install-themes.sh

# Set up entrypoint wrapper
COPY docker-entrypoint-custom.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh

ENTRYPOINT ["/bin/bash", "-c","docker-entrypoint-custom.sh \"$@\"", "--"]
CMD ["apache2-foreground"]