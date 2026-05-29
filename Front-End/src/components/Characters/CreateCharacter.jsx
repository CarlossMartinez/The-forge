import Navbar from "../NavBar/Navbar";
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import api from '../../api';
import "./CreateCharacters.css";

const ALIGNMENTS = [
    'Legal Bueno', 'Neutral Bueno', 'Caótico Bueno',
    'Legal Neutral', 'Neutral', 'Caótico Neutral',
    'Legal Malvado', 'Neutral Malvado', 'Caótico Malvado'
];

export default function CreateCharacter() {
    const { user }  = useAuth();
    const navigate  = useNavigate();

    const [name,        setName]        = useState('');
    const [description, setDescription] = useState('');
    const [alignment,   setAlignment]   = useState('');
    const [image,       setImage]       = useState('');
    const [race,        setRace]        = useState('');
    const [subrace,     setSubrace]     = useState('');
    const [background,  setBackground]  = useState('');
    const [clas,        setClas]        = useState('');
    const [subclass,    setSubclass]    = useState('');
    const [manual,      setManual]      = useState('');

    const [races,       setRaces]       = useState([]);
    const [subraces,    setSubraces]    = useState([]);
    const [backgrounds, setBackgrounds] = useState([]);
    const [classes,     setClasses]     = useState([]);
    const [subclasses,  setSubclasses]  = useState([]);
    const [manuals,     setManuals]     = useState([]);

    const [hpMax,     setHpMax]     = useState(1);
    const [hpCurrent, setHpCurrent] = useState(1);

    const [statsOptions, setStatsOptions] = useState([]);
    const [statValues, setStatValues] = useState({});

    const [loadingOptions, setLoadingOptions] = useState(true);

    const level = 1;
    const xp    = 0;

    useEffect(() => {
        async function loadOptions() {
            try {
                const [racesRes, backgroundsRes, classesRes, manualsRes, statsRes] = await Promise.all([
                    api.get('/races'),
                    api.get('/backgrounds'),
                    api.get('/classes'),
                    api.get('/manuals'),
                    api.get('/stats')
                ]);
                setRaces(racesRes.data);
                setBackgrounds(backgroundsRes.data);
                setClasses(classesRes.data);
                setManuals(manualsRes.data);
                setStatsOptions(statsRes.data);
                const initialStats = {};
                console.log('manuals:', manualsRes.data);
                statsRes.data.forEach(s => { initialStats[s.id] = 10; });
                setStatValues(initialStats);
            } catch (e) {
                console.error('Error cargando opciones:', e);
            } finally {
                setLoadingOptions(false);
            }
        }
        loadOptions();
    }, []);

    useEffect(() => {
        if (!race) { setSubraces([]); setSubrace(''); return; }
        api.get('/subraces')
            .then(res => setSubraces(res.data.filter(s => s.race_id == race)))
            .catch(() => setSubraces([]));
        setSubrace('');
    }, [race]);

    useEffect(() => {
        if (!clas) { setSubclasses([]); setSubclass(''); return; }
        api.get('/subclasses')
            .then(res => setSubclasses(res.data.filter(s => s.class_id == clas)))
            .catch(() => setSubclasses([]));
        setSubclass('');
    }, [clas]);

    async function guardaPersonaje(e) {
        e.preventDefault();
        try {
            const res = await api.post('/characters', {
                name,
                description,
                alignment,
                image,
                user_id:       user.id,
                race_id:       race       || null,
                subrace_id:    subrace    || null,
                background_id: background || null,
                clase_id:      clas       || null,
                subclass_id:   subclass   || null,
                manual_code:   manual     || null,
                level,
                experience:    xp,
                hp_max:     parseInt(hpMax),
                hp_current: parseInt(hpCurrent),
                hp_temp:    0,
                stats: Object.entries(statValues).map(([id, value]) => ({
                    id:    parseInt(id),
                    value: parseInt(value)
                })),
            });
            console.log("Personaje creado:", res.data);
            navigate('/dashboard');
        } catch (e) {
            console.error('Error al guardar el personaje:', e.response?.data);
        }
    }

    if (loadingOptions) return <p>Cargando opciones...</p>;
    function calcMod(value) {
        const mod = Math.floor((value - 10) / 2);
        return mod >= 0 ? `+${mod}` : `${mod}`;
    }
    return (
        <>
            <Navbar />
            <div className="page-container">
                <h2>Nuevo Personaje</h2>
                <form onSubmit={guardaPersonaje}>

                    <div>
                        <label>Manual</label>
                        <select value={manual} onChange={e => setManual(e.target.value)}>
                            <option value="">-- Selecciona manual --</option>
                        {manuals.map(m => (
                                <option key={m.manual_code} value={m.manual_code}>{m.manual_code} — {m.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Nombre</label>
                        <input type="text" value={name} onChange={e => setName(e.target.value)} placeholder="Ejemplo: Varis" required />
                    </div>

                    <div>
                        <label>Descripción</label>
                        <input type="text" value={description} onChange={e => setDescription(e.target.value)} placeholder="Ejemplo: Varis es un mago que junto a..."/>
                    </div>

                    <div>
                        <label>Alineamiento</label>
                        <select value={alignment} onChange={e => setAlignment(e.target.value)}>
                            <option value="">-- Selecciona alineamiento --</option>
                            {ALIGNMENTS.map(a => (
                                <option key={a} value={a}>{a}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Foto</label>
                        <input type="url" value={image} onChange={e => setImage(e.target.value)}/>
                    </div>

                    <div>
                        <label>Raza</label>
                        <select value={race} onChange={e => setRace(e.target.value)}>
                            <option value="">-- Selecciona raza --</option>
                            {races.map(r => (
                                <option key={r.id} value={r.id}>{r.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Subraza</label>
                        <select value={subrace} onChange={e => setSubrace(e.target.value)} disabled={!race}>
                            <option value="">-- Selecciona subraza --</option>
                            {subraces.map(s => (
                                <option key={s.id} value={s.id}>{s.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Transfondo</label>
                        <select value={background} onChange={e => setBackground(e.target.value)}>
                            <option value="">-- Selecciona transfondo --</option>
                            {backgrounds.map(b => (
                                <option key={b.id} value={b.id}>{b.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Clase</label>
                        <select value={clas} onChange={e => setClas(e.target.value)}>
                            <option value="">-- Selecciona clase --</option>
                            {classes.map(c => (
                                <option key={c.id} value={c.id}>{c.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label>Subclase</label>
                        <select value={subclass} onChange={e => setSubclass(e.target.value)} disabled={!clas}>
                            <option value="">-- Selecciona subclase --</option>
                            {subclasses.map(s => (
                                <option key={s.id} value={s.id}>{s.name}</option>
                            ))}
                        </select>
                    </div>
                    <div>
                        <label>HP Máximo</label>
                        <input type="number" value={hpMax} min={1} onChange={e => setHpMax(e.target.value)} required />
                    </div>
                    <div>
                        <label>HP Actual</label>
                        <input type="number" value={hpCurrent} min={0} onChange={e => setHpCurrent(e.target.value)} required />
                    </div>
                    <div className="dnd-section">
                        <p className="dnd-section-title">Estadísticas</p>
                            <div className="dnd-grid-3">
                            {statsOptions.map(stat => (
                                <div key={stat.id} className="dnd-field" style={{ alignItems: 'center' }}>
                                    <label className="dnd-label">{stat.name}</label>
                                    <input
                                        type="number"
                                        min={1}
                                        max={99}
                                        value={statValues[stat.id] ?? 10}
                                        onChange={e => setStatValues(prev => ({
                                            ...prev,
                                            [stat.id]: parseInt(e.target.value) || 1
                                        }))}
                                        style={{ textAlign: 'center' }}
                                    />
                                    <span>
                                        {calcMod(statValues[stat.id] ?? 10)}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>
                    <button type="submit">Crear personaje</button>
                </form>
            </div>
           
        </>
    );
}