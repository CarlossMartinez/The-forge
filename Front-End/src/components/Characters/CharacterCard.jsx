export default function CharacterCard({ character, onClick }) {
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