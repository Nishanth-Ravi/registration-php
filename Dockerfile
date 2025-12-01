cat > Dockerfile <<'EOF'
FROM php:8.1-apache

# Copy project files to Apache directory
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional but useful)
RUN a2enmod rewrite

EXPOSE 80
EOF
