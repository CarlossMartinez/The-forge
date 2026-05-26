export default function Stat({ label, value }) {
    return (
        <div style={styles.stat}>
            <span style={styles.statValue}>{value}</span>
            <span style={styles.statLabel}>{label}</span>
        </div>
    );
}