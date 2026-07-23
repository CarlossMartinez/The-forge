From node:20-alpine

WORKDIR /the-forge

COPY the-forge/package.json ./
RUN npm install

COPY the-forge/ ./

EXPOSE 5173

CMD ["npm", "run", "dev", "--", "--host"]