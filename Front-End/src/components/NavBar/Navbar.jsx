import { NavLink, useNavigate } from "react-router-dom";    
import { useAuth } from "../../context/AuthContext";
import api from '../../api';
import "./navbar.css";
import "../../index.css"
export default function Navbar(){
    const { user, logout } = useAuth();
    const navigate = useNavigate(); 
    const handleLogout = async () => {
        await logout();
        window.location.href = '/login';
    };
    
    return (
        <>
            <header className="w-full bg-gray-900 text-white px-6 py-4 flex items-center justify-between">

                {/* Logo */}
                <div className="text-xl font-bold">
                    Logo
                </div>

                {/* Links */}
                <nav className="hidden md:flex gap-6">
                    <NavLink to="/dashboard" className="hover:text-gray-300">
                        Menu inicial
                    </NavLink>

                    <NavLink to="/nuevoPersonaje" className="hover:text-gray-300">
                        Crear un nuevo personaje
                    </NavLink>
                </nav>

                {/* Usuario */}
                <div className="flex items-center gap-3">
                    <span className="font-semibold">{user.username}</span>
                    <img 
                        src={user.image} 
                        alt="Avatar" 
                        className="w-10 h-10 rounded-full object-cover border border-gray-700"
                    />
                    <button
                    onClick={handleLogout}> LogOut </button>
                </div>
            </header>
        </>
        
    );
}