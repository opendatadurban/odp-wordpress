# ODP WordPress 

This repository is intended for the Open Data Portal website that is currently been migrated from Webflow. Updates will be made as the project progresses.


# Dockerized WordPress Setup

This repository provides a fully containerized WordPress environment using Docker Compose. The setup includes:
- WordPress with custom themes and plugins
- MySQL database
- phpMyAdmin for database management

## Prerequisites
Ensure you have the following installed:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Setup and Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-repo/docker-wordpress.git
   cd docker-wordpress
   ```

2. **Build and run the containers:**
   ```sh
   docker-compose up -d --build
   ```
   This will:
   - Build a custom WordPress image
   - Start MySQL and phpMyAdmin
   - Mount custom themes and plugins

3. **Access the services:**
   - WordPress: [http://localhost:8080](http://localhost:8080)
   - phpMyAdmin: [http://localhost:8081](http://localhost:8081)

## Project Structure
```
.
├── db
│   ├── init.sql               # MySQL initialization script
├── wordpress
│   ├── Dockerfile             # Custom WordPress build
│   ├── wp-content             # Custom themes and plugins
├── docker-compose.yml         # Service definitions
└── README.md                  # This documentation
```

## Configuration Details

### **1. `docker-compose.yml`**
- Defines three services: `wordpress`, `db` (MySQL), and `phpmyadmin`.
- Uses `volumes` to persist database and WordPress content.
- Exposes WordPress on port `8080` and phpMyAdmin on `8081`.

### **2. `wordpress/Dockerfile`**
- Builds a custom WordPress image.
- Copies custom themes and plugins into the container.
- Sets correct file permissions.

### **3. `db/init.sql`**
- Initializes the MySQL database with predefined credentials.
- Grants privileges to `wp_user`.

## Stopping and Restarting Services
To stop the containers:
```sh
docker-compose down
```
To restart:
```sh
docker-compose up -d
```

## Troubleshooting
- If WordPress does not detect custom themes/plugins, ensure they are inside `wp-content/`.
- Use `docker logs wordpress_app` to debug errors.
- Access MySQL manually:
  ```sh
  docker exec -it wordpress_db mysql -u wp_user -p
  ```

## Next Steps
- Secure MySQL credentials using environment variables.
- Add volume mounting for WordPress uploads.
- Automate plugin/theme installation via scripts.

Feel free to contribute or report issues!

