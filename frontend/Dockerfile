FROM node:20-alpine

# Habilitar Yarn
RUN corepack enable && corepack prepare yarn@stable --activate

# Crear directorio de trabajo
WORKDIR /app

# Copiar archivos de dependencias
COPY package.json yarn.lock* package-lock.json* ./

# Instalar dependencias
RUN if [ -f yarn.lock ]; then yarn install; \
    elif [ -f package-lock.json ]; then npm ci; \
    else npm install; fi

# Copiar código fuente
COPY . .

# Exponer puerto de Vite
EXPOSE 5173

# Comando de desarrollo con hot-reload
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
