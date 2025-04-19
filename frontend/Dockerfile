FROM node:18-alpine

WORKDIR /app

# Install dependencies
COPY package*.json ./
RUN npm ci && npm install esbuild@0.18.20 --save-dev

# Copy application files
COPY . .

# Expose Vite development server port
EXPOSE 5173

# Start Vite development server
CMD ["npm", "run", "dev", "--", "--host"]