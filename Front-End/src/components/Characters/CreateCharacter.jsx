import Navbar from "../NavBar/Navbar";
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import api from '../../api';
 
const ALIGNMENTS = [
    'Legal Bueno', 'Neutral Bueno', 'Caótico Bueno',
    'Legal Neutral', 'Neutral', 'Caótico Neutral',
    'Legal Malvado', 'Neutral Malvado', 'Caótico Malvado'
];
 
function Field({ label, children }) {
    return (
        <div className="flex flex-col gap-1">
            <label className="text-xs text-stone-500 uppercase tracking-wider">{label}</label>
            {children}
        </div>
    );
}
 
const inputCls = "bg-stone-900 border border-stone-700 rounded px-3 py-2 text-sm text-stone-100 outline-none focus:border-amber-600 transition-colors";
const selectCls = `${inputCls} cursor-pointer`;
 
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
    const [statValues,   setStatValues]   = useState({});
    const [loadingOptions, setLoadingOptions] = useState(true);
 
    const level = 1;
    const xp    = 0;
 
    useEffect(() => {
        if (!clas || !classes.length) return;
        const selectedClass = classes.find(c => c.id == clas);
        if (!selectedClass) return;
        const conMod = Math.floor(((statValues[3] ?? 10) - 10) / 2);
        const hp = Math.max(1, selectedClass.hit_die + conMod);
        setHpMax(hp);
        setHpCurrent(hp);
    }, [clas, classes, statValues]);
 
    useEffect(() => {
        async function loadOptions() {
            try {
                const [optionsRes, statsRes] = await Promise.all([
                    api.get('/form-options'),
                    api.get('/stats'),
                ]);
                setRaces(optionsRes.data.races);
                setBackgrounds(optionsRes.data.backgrounds);
                setClasses(optionsRes.data.classes);
                setManuals(optionsRes.data.manuals);
                setStatsOptions(statsRes.data);
                const init = {};
                statsRes.data.forEach(s => { init[s.id] = 10; });
                setStatValues(init);
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
            await api.post('/characters', {
                name, description, alignment, image,
                user_id: user.id,
                race_id: race || null,
                subrace_id: subrace || null,
                background_id: background || null,
                clase_id: clas || null,
                subclass_id: subclass || null,
                manual_code: manual || null,
                level, experience: xp,
                hp_max: parseInt(hpMax),
                hp_current: parseInt(hpCurrent),
                hp_temp: 0,
                stats: Object.entries(statValues).map(([id, value]) => ({
                    id: parseInt(id), value: parseInt(value)
                })),
            });
            navigate('/dashboard');
        } catch (e) {
            console.error('Error al guardar el personaje:', e.response?.data);
        }
    }
    const calcMod = (v) => { const m = Math.floor((v - 10) / 2); return m >= 0 ? `+${m}` : `${m}`; };
    if (loadingOptions) return (
        <div className="min-h-screen bg-stone-950 flex flex-col items-center justify-center gap-3">
            <div className="w-8 h-8 border-2 border-stone-600 border-t-amber-500 rounded-full animate-spin" />
            <p className="text-stone-500 text-sm">Cargando opciones…</p>
        </div>
    );
    return (
        <div className="min-h-screen bg-stone-950 text-stone-200">
            <Navbar />
            <div className="max-w-2xl mx-auto px-4 py-8">
                <div className="mb-6">
                    <p className="text-xs text-stone-500 uppercase tracking-widest mb-1">Creación</p>
                    <h1 className="text-2xl font-bold text-stone-100">Nuevo Personaje</h1>
                </div>
                <form onSubmit={guardaPersonaje} className="space-y-6">
                    {/* Básicos */}
                    <section className="space-y-4">
                        <p className="text-xs text-stone-500 uppercase tracking-widest border-b border-stone-800 pb-1">General</p>
                        <Field label="Manual">
                            <select value={manual} onChange={e => setManual(e.target.value)} className={selectCls}>
                                <option value="">— Selecciona manual —</option>
                                {manuals.map(m => <option key={m.manual_code} value={m.manual_code}>{m.manual_code} — {m.name}</option>)}
                            </select>
                        </Field>
                        <Field label="Nombre *">
                            <input type="text" value={name} onChange={e => setName(e.target.value)} placeholder="Varis Thornwood" required className={inputCls} />
                        </Field>
                        <Field label="Descripción">
                            <textarea value={description} onChange={e => setDescription(e.target.value)} placeholder="Un breve trasfondo del personaje…" rows={3} className={`${inputCls} resize-none`} />
                        </Field>
                        <div className="grid grid-cols-2 gap-4">
                            <Field label="Alineamiento">
                                <select value={alignment} onChange={e => setAlignment(e.target.value)} className={selectCls}>
                                    <option value="">— Alineamiento —</option>
                                    {ALIGNMENTS.map(a => <option key={a} value={a}>{a}</option>)}
                                </select>
                            </Field>
                            <Field label="URL de imagen">
                                <input type="url" value={image} onChange={e => setImage(e.target.value)} placeholder="https://…" className={inputCls} />
                            </Field>
                        </div>
                    </section>
                    {/* Raza / Clase */}
                    <section className="space-y-4">
                        <p className="text-xs text-stone-500 uppercase tracking-widest border-b border-stone-800 pb-1">Raza y Clase</p>
                        <div className="grid grid-cols-2 gap-4">
                            <Field label="Raza">
                                <select value={race} onChange={e => setRace(e.target.value)} className={selectCls}>
                                    <option value="">— Raza —</option>
                                    {races.map(r => <option key={r.id} value={r.id}>{r.name}</option>)}
                                </select>
                            </Field>
                            <Field label="Subraza">
                                <select value={subrace} onChange={e => setSubrace(e.target.value)} disabled={!race} className={`${selectCls} disabled:opacity-40`}>
                                    <option value="">— Subraza —</option>
                                    {subraces.map(s => <option key={s.id} value={s.id}>{s.name}</option>)}
                                </select>
                            </Field>
                            <Field label="Clase">
                                <select value={clas} onChange={e => setClas(e.target.value)} className={selectCls}>
                                    <option value="">— Clase —</option>
                                    {classes.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                                </select>
                            </Field>
                            <Field label="Subclase">
                                <select value={subclass} onChange={e => setSubclass(e.target.value)} disabled={!clas} className={`${selectCls} disabled:opacity-40`}>
                                    <option value="">— Subclase —</option>
                                    {subclasses.map(s => <option key={s.id} value={s.id}>{s.name}</option>)}
                                </select>
                            </Field>
                        </div>
                        <Field label="Trasfondo">
                            <select value={background} onChange={e => setBackground(e.target.value)} className={selectCls}>
                                <option value="">— Trasfondo —</option>
                                {backgrounds.map(b => <option key={b.id} value={b.id}>{b.name}</option>)}
                            </select>
                        </Field>
                    </section>
                    {/* Stats */}
                    <section className="space-y-4">
                        <p className="text-xs text-stone-500 uppercase tracking-widest border-b border-stone-800 pb-1">Estadísticas</p>
                        <div className="grid grid-cols-3 gap-3">
                            {statsOptions.map(stat => (
                                <div key={stat.id} className="bg-stone-900 border border-stone-700 rounded-lg p-3 text-center">
                                    <p className="text-[10px] text-stone-500 uppercase tracking-wider mb-1">{stat.name}</p>
                                    <input
                                        type="number" min={1} max={99}
                                        value={statValues[stat.id] ?? 10}
                                        onChange={e => setStatValues(prev => ({ ...prev, [stat.id]: parseInt(e.target.value) || 1 }))}
                                        className="w-full bg-transparent text-center text-xl font-bold text-stone-100 outline-none border-b border-stone-700 focus:border-amber-600 transition-colors"
                                    />
                                    <p className="text-xs text-amber-500 mt-1">{calcMod(statValues[stat.id] ?? 10)}</p>
                                </div>
                            ))}
                        </div>
                    </section>
                    {/* HP */}
                    <section className="space-y-4">
                        <p className="text-xs text-stone-500 uppercase tracking-widest border-b border-stone-800 pb-1">Hit Points</p>
                        <div className="bg-stone-900 border border-stone-700 rounded-lg px-4 py-3 flex justify-between items-center">
                            <span className="text-sm text-stone-400">HP Máximo <span className="text-stone-600 text-xs">(calculado por clase y CON)</span></span>
                            <span className="font-bold text-2xl text-amber-500">{hpMax}</span>
                        </div>
                    </section>
                    {/* Submit */}
                    <button type="submit"
                        className="w-full py-2.5 border border-amber-700 text-amber-600 rounded-lg text-sm font-medium hover:bg-amber-700 hover:text-black transition-colors">
                        Crear personaje
                    </button>
                </form>
            </div>
        </div>
    );
}