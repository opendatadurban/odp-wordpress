#!/bin/bash
set -e

THEME_NAME=$1
THEMES_DIR="/var/www/html/wp-content/themes"
CUSTOM_THEME_DIR="${THEMES_DIR}/${THEME_NAME}"

# Install custom theme from the source code in the container
if [ -d "/usr/src/${THEME_NAME}" ]; then
    echo "Installing/updating custom theme ${THEME_NAME} from build..."
    
    # Always force update the custom theme
    if [ -d "$CUSTOM_THEME_DIR" ]; then
        echo "Removing existing custom theme..."
        rm -rf "$CUSTOM_THEME_DIR"
    fi
    
    # Copy the custom theme to the WordPress themes directory
    mkdir -p "$CUSTOM_THEME_DIR"
    cp -r "/usr/src/${THEME_NAME}/*" "$CUSTOM_THEME_DIR/"
    
    # Set proper permissions
    chown -R www-data:www-data "$CUSTOM_THEME_DIR"
    chmod -R 755 "$CUSTOM_THEME_DIR"
    
    echo "Custom theme installed/updated successfully"
fi