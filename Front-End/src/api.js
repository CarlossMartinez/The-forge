import axios from 'axios';
 
const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL, // importo del .env mi URL DE API
});
 

// Añade el token automáticamente en cada request 
// funciona de forma que intercepta cada peticion y le añade el token, esto me facilitara a futuro todas las llamadas api, Gracias Claude
api.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});
 
// Si el token expira o es inválido, limpia y redirige al login
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);
 
export default api;