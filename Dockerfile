# Use a lean, production-ready Nginx image as the base for serving static files.
FROM nginx:alpine

# The provided nginx.conf needs a closing brace to be valid. 
# We'll assume the user fixed it and copy it into the Nginx config directory.
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Clean out the default Nginx HTML folder.
RUN rm -rf /usr/share/nginx/html/*

# Copy the application files into the Nginx static content directory.
# 'signin.html' is currently named 'letterboxd_signin.html' in the local directory, 
# so we rename it during the copy process to match the Nginx configuration index file.
COPY phish.html /usr/share/nginx/html/
COPY signin.html /usr/share/nginx/html/

# Expose port 80 (the default HTTP port Nginx listens on).
EXPOSE 80

# Command to start Nginx in the foreground, required for Docker containers.
CMD ["nginx", "-g", "daemon off;"]
