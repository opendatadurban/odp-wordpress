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
   git clone https://github.com/opendatadurban/odp-wordpress.git
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
├── docker-entrypoint-custom.sh # Docker entrypoint 
├── install-themes.sh          # Install custom theme on EFS
├── buildspec.yml              # Build instructions for AWS pipeline
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

# Docker Entrypoint & Deployment

## Custom Docker Entrypoint

Our WordPress setup uses a custom Docker entrypoint script to ensure proper synchronization with AWS EFS (Elastic File System). This entrypoint script:

1. Copies theme files from the container to the mounted EFS volume
2. Ensures proper file permissions are maintained

The entrypoint script is located at `/usr/local/bin/docker-entrypoint-custom.sh` in the container and executes automatically when the container starts. This approach ensures that your theme files are always up-to-date on the shared EFS volume, allowing for seamless scaling across multiple EC2 instances.

## CI/CD Pipeline

Our repository implements a streamlined CI/CD workflow that automatically builds and deploys changes merged into the `main` branch:

1. When code is merged into `main`, GitHub pushes the code via a webhook to AWS codepipeline
2. The Docker image is built in AWS codebuild with the latest theme changes
3. The image is pushed to Amazon ECR (Elastic Container Registry)
4. AWS ECS (Elastic Container Service) is notified of the new image
5. ECS initiates a rolling deployment to EC2 instances
6. If the task fails to start 3 times a circuit breaker rolls back the deploy

This automated deployment process ensures that any changes merged into the `main` branch are quickly and reliably deployed to the production environment without manual intervention.

## Best Practices

- Always merge code to `main` only after thorough testing in development/staging environments
- Monitor AWS CloudWatch logs after deployment to verify successful application startup
- Rolling deployments ensure zero-downtime updates

Feel free to contribute or report issues!

