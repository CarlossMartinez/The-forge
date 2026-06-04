import { useState } from "react";
import { NavLink } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";
 
const links = [
    { to: "/dashboard",       label: "Inicio" },
    { to: "/nuevoPersonaje",  label: "Nuevo personaje" },
];
 
export default function Navbar() {
    const { user, logout } = useAuth();
    const [open, setOpen] = useState(false);
 
    const handleLogout = async () => {
        await logout();
        window.location.href = '/login';
    };
 
    const link = ({ isActive }) =>
        `text-sm transition-colors ${isActive ? "text-amber-500" : "text-stone-400 hover:text-stone-100"}`;
 
    return (
        <header className="w-full bg-stone-900 border-b border-stone-700">
            <div className="px-4 py-3 flex items-center justify-between">
                {/* Logo */}
                <span className="font-bold text-stone-100">⚔️ Logo</span>
 
                {/* En pc*/}
                <nav className="hidden md:flex gap-6">
                    {links.map(l => <NavLink key={l.to} to={l.to} className={link}>{l.label}</NavLink>)}
                </nav>
 
                {/* Usuario + hamburger */}
                <div className="flex items-center gap-3">
                    {user.image && (
                        <img src={user.image} alt="Avatar" className="w-8 h-8 rounded-full object-cover border border-stone-700" />
                    )}
                    <span className="hidden md:block text-sm text-stone-300">{user.username}</span>
                    <button onClick={handleLogout} className="hidden md:block text-xs text-stone-500 hover:text-red-400 transition-colors">
                        Salir
                    </button>
 
                    {/* Hamburger */}
                    <button onClick={() => setOpen(o => !o)} className="md:hidden flex flex-col gap-1.5 p-1">
                        <span className={`block w-5 h-0.5 bg-stone-400 transition-transform ${open ? "rotate-45 translate-y-2" : ""}`} />
                        <span className={`block w-5 h-0.5 bg-stone-400 transition-opacity ${open ? "opacity-0" : ""}`} />
                        <span className={`block w-5 h-0.5 bg-stone-400 transition-transform ${open ? "-rotate-45 -translate-y-2" : ""}`} />
                    </button>
                </div>
            </div>
 
            {open && (
                <div className="md:hidden border-t border-stone-700 px-4 py-3 flex flex-col gap-3">
                    {links.map(l => (
                        <NavLink key={l.to} to={l.to} className={link} onClick={() => setOpen(false)}>
                            {l.label}
                        </NavLink>
                    ))}
                    <div className="flex items-center justify-between pt-2 border-t border-stone-800">
                        <span className="text-sm text-stone-300">{user.username}</span>
                        <button onClick={handleLogout} className="text-xs text-stone-500 hover:text-red-400 transition-colors">
                            Salir
                        </button>
                    </div>
                </div>
            )}
        </header>
    );
}