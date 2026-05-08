import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import api from '../api';
 
export default function Dashboard() {
    const { user, logout }          = useAuth();
    const [characters, setCharacters] = useState([]);
    const [loading, setLoading]       = useState(true);
    const navigate                    = useNavigate();
 
    useEffect(() => {
        fetchCharacters();
    }, []);
 
    const fetchCharacters = async () => {
    try {
        const res = await api.get('/characters');
        console.log(res.data); // Mira qué estructura devuelve tu API
        
        // Cubre los casos más comunes de respuesta
        if (Array.isArray(res.data)) {
            setCharacters(res.data);
        } else if (Array.isArray(res.data.data)) {
            setCharacters(res.data.data);
        } else {
            setCharacters([]);
        }
    } catch (e) {
        console.error('Error al cargar personajes', e);
        setCharacters([]); // importante: siempre dejar un array vacío
    } finally {
        setLoading(false);
    }
}
 
    const handleLogout = async () => {
        await logout();
        navigate('/login');
    };
 
    return (
        <div style={styles.page}>
            {/* Fondo con textura */}
            <div style={styles.bg} />
 
            {/* Navbar */}
            <nav style={styles.navbar}>
                <span style={styles.brand}>⚔ DnD Creator</span>
                <div style={styles.navRight}>
                    {user?.image && (
                        <img src={user.image} alt="avatar" style={styles.avatar} />
                    )}
                    <span style={styles.username}>{user?.username}</span>
                    <button onClick={handleLogout} style={styles.logoutBtn}>
                        Salir
                    </button>
                </div>
            </nav>
 
            {/* Contenido */}
            <main style={styles.main}>
                <div style={styles.header}>
                    <h1 style={styles.title}>Tus Personajes</h1>
                    <button
                        onClick={() => navigate('/character/create')}
                        style={styles.createBtn}
                    >
                        + Nuevo personaje
                    </button>
                </div>
 
                {loading ? (
                    <div style={styles.emptyState}>
                        <p style={styles.emptyText}>Cargando...</p>
                    </div>
                ) : characters.length === 0 ? (
                    <div style={styles.emptyState}>
                        <p style={styles.emptyIcon}>🎲</p>
                        <p style={styles.emptyText}>No tienes personajes todavía</p>
                        <button
                            onClick={() => navigate('/character/create')}
                            style={styles.createBtn}
                        >
                            Crear mi primer personaje
                        </button>
                    </div>
                ) : (
                    <div style={styles.grid}>
                        {characters.map((char) => (
                            <CharacterCard
                                key={char.id}
                                character={char}
                                onClick={() => navigate(`/character/${char.id}`)}
                            />
                        ))}
                    </div>
                )}
            </main>
        </div>
    );
}
 
function CharacterCard({ character, onClick }) {
    const [hovered, setHovered] = useState(false);
 
    return (
        <div
            onClick={onClick}
            onMouseEnter={() => setHovered(true)}
            onMouseLeave={() => setHovered(false)}
            style={{
                ...styles.card,
                transform: hovered ? 'translateY(-4px)' : 'translateY(0)',
                boxShadow: hovered
                    ? '0 12px 40px rgba(0,0,0,0.5)'
                    : '0 4px 20px rgba(0,0,0,0.3)',
            }}
        >
            {/* Imagen o placeholder */}
            <div style={styles.cardImg}>
                {character.image ? (
                    <img src={character.image} alt={character.name} style={styles.cardImgEl} />
                ) : (
                    <span style={styles.cardImgPlaceholder}>
                        {character.name?.[0]?.toUpperCase() ?? '?'}
                    </span>
                )}
            </div>
 
            <div style={styles.cardBody}>
                <h2 style={styles.cardName}>{character.name}</h2>
                <div style={styles.cardMeta}>
                    <span style={styles.badge}>{character.clase?.name ?? 'Sin clase'}</span>
                    <span style={styles.badge}>{character.race?.name ?? 'Sin raza'}</span>
                </div>
                <div style={styles.cardStats}>
                    <Stat label="Nivel" value={character.level} />
                    <Stat label="HP" value={`${character.hp_current}/${character.hp_max}`} />
                    <Stat label="XP" value={character.experience} />
                </div>
                <p style={styles.cardAlignment}>{character.alignment}</p>
            </div>
        </div>
    );
}
 
function Stat({ label, value }) {
    return (
        <div style={styles.stat}>
            <span style={styles.statValue}>{value}</span>
            <span style={styles.statLabel}>{label}</span>
        </div>
    );
}
 
// ─── Estilos ────────────────────────────────────────────────────────────────
 
const styles = {
    page: {
        minHeight: '100vh',
        background: '#0e0e14',
        color: '#e8e0d0',
        fontFamily: "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        position: 'relative',
    },
    bg: {
        position: 'fixed',
        inset: 0,
        backgroundImage: `
            radial-gradient(ellipse at 20% 20%, rgba(120,60,20,0.15) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 80%, rgba(60,40,100,0.15) 0%, transparent 60%)
        `,
        pointerEvents: 'none',
        zIndex: 0,
    },
    navbar: {
        position: 'sticky',
        top: 0,
        zIndex: 100,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        padding: '0 2rem',
        height: '64px',
        background: 'rgba(14,14,20,0.85)',
        backdropFilter: 'blur(12px)',
        borderBottom: '1px solid rgba(200,160,80,0.2)',
    },
    brand: {
        fontSize: '1.2rem',
        fontWeight: 'bold',
        color: '#c8a050',
        letterSpacing: '0.05em',
    },
    navRight: {
        display: 'flex',
        alignItems: 'center',
        gap: '0.75rem',
    },
    avatar: {
        width: '34px',
        height: '34px',
        borderRadius: '50%',
        border: '2px solid rgba(200,160,80,0.4)',
    },
    username: {
        fontSize: '0.9rem',
        color: '#b0a890',
    },
    logoutBtn: {
        background: 'transparent',
        border: '1px solid rgba(200,160,80,0.3)',
        color: '#c8a050',
        padding: '0.3rem 0.9rem',
        borderRadius: '4px',
        cursor: 'pointer',
        fontSize: '0.85rem',
        transition: 'all 0.2s',
    },
    main: {
        position: 'relative',
        zIndex: 1,
        maxWidth: '1100px',
        margin: '0 auto',
        padding: '2.5rem 1.5rem',
    },
    header: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        marginBottom: '2rem',
    },
    title: {
        fontSize: '1.8rem',
        fontWeight: 'normal',
        color: '#c8a050',
        margin: 0,
        letterSpacing: '0.03em',
    },
    createBtn: {
        background: 'linear-gradient(135deg, #8b4a10, #c8a050)',
        border: 'none',
        color: '#fff',
        padding: '0.6rem 1.2rem',
        borderRadius: '6px',
        cursor: 'pointer',
        fontSize: '0.9rem',
        fontFamily: 'inherit',
        fontWeight: 'bold',
        letterSpacing: '0.03em',
        transition: 'opacity 0.2s',
    },
    grid: {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fill, minmax(280px, 1fr))',
        gap: '1.5rem',
    },
    emptyState: {
        textAlign: 'center',
        padding: '5rem 0',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        gap: '1rem',
    },
    emptyIcon: {
        fontSize: '3rem',
        margin: 0,
    },
    emptyText: {
        color: '#8a8070',
        fontSize: '1.1rem',
        margin: 0,
    },
    card: {
        background: 'rgba(255,255,255,0.03)',
        border: '1px solid rgba(200,160,80,0.15)',
        borderRadius: '10px',
        overflow: 'hidden',
        cursor: 'pointer',
        transition: 'transform 0.2s, box-shadow 0.2s',
    },
    cardImg: {
        height: '140px',
        background: 'linear-gradient(135deg, #1a1020, #2a1a10)',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        overflow: 'hidden',
    },
    cardImgEl: {
        width: '100%',
        height: '100%',
        objectFit: 'cover',
    },
    cardImgPlaceholder: {
        fontSize: '3.5rem',
        color: 'rgba(200,160,80,0.4)',
        fontWeight: 'bold',
    },
    cardBody: {
        padding: '1rem 1.2rem',
    },
    cardName: {
        margin: '0 0 0.5rem',
        fontSize: '1.15rem',
        color: '#e8e0d0',
        fontWeight: 'normal',
    },
    cardMeta: {
        display: 'flex',
        gap: '0.5rem',
        marginBottom: '0.75rem',
        flexWrap: 'wrap',
    },
    badge: {
        fontSize: '0.7rem',
        padding: '0.2rem 0.6rem',
        borderRadius: '20px',
        background: 'rgba(200,160,80,0.1)',
        border: '1px solid rgba(200,160,80,0.25)',
        color: '#c8a050',
        letterSpacing: '0.04em',
    },
    cardStats: {
        display: 'flex',
        gap: '1rem',
        marginBottom: '0.5rem',
    },
    stat: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
    },
    statValue: {
        fontSize: '1rem',
        fontWeight: 'bold',
        color: '#e8e0d0',
    },
    statLabel: {
        fontSize: '0.65rem',
        color: '#7a7060',
        textTransform: 'uppercase',
        letterSpacing: '0.08em',
    },
    cardAlignment: {
        margin: 0,
        fontSize: '0.75rem',
        color: '#7a7060',
        fontStyle: 'italic',
    },
};