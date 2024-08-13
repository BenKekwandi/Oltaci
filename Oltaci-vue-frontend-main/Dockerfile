FROM node:18

# Set the working directory in the container
WORKDIR /usr/src/app

# Copy package.json and package-lock.json (or yarn.lock) first
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application code
COPY . .

# Build the Vue.js application
RUN npm run build

# Install a lightweight web server to serve the static files
RUN npm install -g serve

# Expose port 5000 for the web server
EXPOSE 5174

# Serve the built application
CMD ["serve", "-s", "dist", "-l", "5174"]