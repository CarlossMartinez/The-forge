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
    var filteredCharacters;

    useEffect(() => {
        fetchCharacters();
    },[]);
 
        const fetchCharacters = async () => {
        try {
            const res = await api.get(`/users/characters/${user.id}`);
            console.log("API:", res.data);

            // Aquí extraemos el array correcto
            setCharacters(res.data.characters);

        } catch (e) {
            console.error('Error al cargar personajes', e);
            setCharacters([]);
        } finally {
            setLoading(false);
        }
    }
    

    return(
        <>
            <Navbar />
            {loading 
            ? <p>Cargando personajes...</p>  // o un spinner
            : <CharacterGrid characters={characters} />
            }
        </>
    )
} 