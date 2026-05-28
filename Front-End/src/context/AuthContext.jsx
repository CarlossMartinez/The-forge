import { createContext, useContext, useEffect, useState } from 'react';
import api from '../api';
// Context es para pasarle los datos que todos los componentes necesitarán
// En mi caso como necesito los users, lo hare desde aqui.

const AuthContext = createContext(null);

// El authProvider será lo que pase los datos
export function AuthProvider({ children }) {
    const [user, setUser]       = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        // Miramos si hay token o no 
        const token = localStorage.getItem('token');
        if (token) {
            fetchUser();
        } else {
            setLoading(false);
        }
    }, []);

    const fetchUser = async () => {
        try {
            const res = await api.get('/user');
            setUser(res.data);
        } catch {
            localStorage.removeItem('token');
            setUser(null);
        } finally {
            setLoading(false);
        }
    };

    const loginWithGithub = async () => {
        const res = await api.get('/auth/github');
        window.location.href = res.data.url;
    };

    const logout = async () => {
        try {
            await api.post('/logout');
        } finally {
            localStorage.removeItem('token');
            // Con esto limpiamos todos los headers
            if (api.defaults && api.defaults.headers && api.defaults.headers.Authorization) {
                delete api.defaults.headers.Authorization;
            }
            setUser(null);
        }
    };

    return (
        <AuthContext.Provider value={{ user, loading, loginWithGithub, logout, fetchUser }}>
            {children}
        </AuthContext.Provider>
    );
}

export function useAuth() {
    return useContext(AuthContext);
}