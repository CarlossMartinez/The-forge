import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function AuthCallback() {
    // Esto es para pdoer hacer todo el 
    const navigate      = useNavigate();
    const { fetchUser } = useAuth(); // Importamos la funcion del auth

    useEffect(() => {
        // Esto lo he usador en el parlamento, pero con razor pages, URLSearchParams los cifra mejor
        const params = new URLSearchParams(window.location.search);
        const token  = params.get('token');
        const error  = params.get('error');

        // Si hay error o no hay token
        if (error || !token) {
            navigate('/login');
            return;
        }

        // Si todo va bien, guardamos el token y llevamos a dashboard
        localStorage.setItem('token', token);
        fetchUser().then(() => navigate('/dashboard'));
    }, []);

    return (
        <div className="flex items-center justify-center h-screen">
            <p className="text-lg">Iniciando sesión...</p>
        </div>
    );
}