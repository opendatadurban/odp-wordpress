#!/bin/bash
set -e

# Install custom themes from the source code in the container
echo "Installing/updating custom themes from build..."

/usr/local/bin/install-themes.sh coct-theme

echo "All themes installed/updated successfully"

# Wait for EFS to be fully available (optional but can help with race conditions)
echo "Ensuring EFS mounts are ready..."
ls -la /var/www/html/wp-content/themes/
ls -la /var/www/html/wp-content/plugins/
ls -la /var/www/html/wp-content/uploads/

# Run the original entrypoint
echo "Starting WordPress..."
exec /usr/local/bin/docker-entrypoint.sh "$@"

