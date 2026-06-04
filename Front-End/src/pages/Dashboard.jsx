import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import api from '../api';
import CharacterGrid from '../components/Characters/CharacterGrid';
import Navbar from '../components/NavBar/Navbar';
 
export default function Dashboard() {
    const { user, logout } = useAuth();
    const [characters, setCharacters] = useState([]);
    const [loading, setLoading] = useState(true);
    const navigate = useNavigate();
 
    useEffect(() => { fetchCharacters(); }, []);
 
    const fetchCharacters = async () => {
        try {
            const res = await api.get(`/users/characters/${user.id}`);
            setCharacters(res.data.characters);
        } catch (e) {
            console.error('Error al cargar personajes', e);
            setCharacters([]);
        } finally {
            setLoading(false);
        }
    };
 
    return (
        <div className="min-h-screen bg-stone-950 text-stone-200">
            <Navbar />
 
            <main className="max-w-5xl mx-auto px-4 py-8">
 
                {/* Header */}
                {
                    (!loading) ? (
                        <div className="mb-8">
                            <p className="text-xs text-stone-500 uppercase tracking-widest mb-1">Bienvenido de vuelta</p>
                            <h1 className="text-2xl font-bold text-stone-100">{user?.name}</h1>
                            <p className="text-stone-400 text-sm mt-1">
                                {characters.length > 0
                                    ? `Tienes ${characters.length} aventurero${characters.length !== 1 ? 's' : ''}`
                                    : 'Aún no tienes personajes'}
                            </p>
                        </div>
                    ) : ""
                        
                    
                }
                {/* <div className="mb-8">
                    <p className="text-xs text-stone-500 uppercase tracking-widest mb-1">Bienvenido de vuelta</p>
                    <h1 className="text-2xl font-bold text-stone-100">{user?.name}</h1>
                    <p className="text-stone-400 text-sm mt-1">
                        {characters.length > 0
                            ? `Tienes ${characters.length} aventurero${characters.length !== 1 ? 's' : ''}`
                            : 'Aún no tienes personajes'}
                    </p>
                </div> */}
 
                {loading ? (
                    <div className="flex flex-col items-center justify-center py-32 gap-3">
                        <div className="w-8 h-8 border-2 border-stone-600 border-t-amber-500 rounded-full animate-spin" />
                        <p className="text-stone-500 text-sm">Cargando tus aventureros…</p>
                    </div>
                ) : characters.length === 0 ? (
                    <div className="flex flex-col items-center justify-center py-32 gap-4 text-center">
                        <div className="text-5xl">⚔️</div>
                        <p className="text-stone-400 text-sm">No tienes personajes todavía.</p>
                        <button
                            onClick={() => navigate('/characters/new')}
                            className="text-xs border border-amber-700 text-amber-600 rounded px-4 py-2 hover:bg-amber-700 hover:text-black transition-colors"
                        >
                            Crear personaje
                        </button>
                    </div>
                ) : (
                    <CharacterGrid characters={characters} />
                )}
            </main>
        </div>
    );
}