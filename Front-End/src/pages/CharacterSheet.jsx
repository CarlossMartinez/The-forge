import { useState } from "react";
import { useLocation } from 'react-router-dom';
import Navbar from '../components/NavBar/Navbar';

const STAT_ID_MAP = { 1: "STR", 2: "DEX", 3: "CON", 4: "INT", 5: "WIS", 6: "CHA" };
const SKILLS = [
  { name: "Acrobatics", stat: "DEX" }, { name: "Animal Handling", stat: "WIS" },
  { name: "Arcana", stat: "INT" },     { name: "Athletics", stat: "STR" },
  { name: "Deception", stat: "CHA" },  { name: "History", stat: "INT" },
  { name: "Insight", stat: "WIS" },    { name: "Intimidation", stat: "CHA" },
  { name: "Investigation", stat: "INT" },{ name: "Medicine", stat: "WIS" },
  { name: "Nature", stat: "INT" },     { name: "Perception", stat: "WIS" },
  { name: "Performance", stat: "CHA" },{ name: "Persuasion", stat: "CHA" },
  { name: "Religion", stat: "INT" },   { name: "Sleight of Hand", stat: "DEX" },
  { name: "Stealth", stat: "DEX" },    { name: "Survival", stat: "WIS" },
];
 
const mod = (v) => Math.floor((v - 10) / 2);
const modStr = (v) => { const m = mod(v); return (m >= 0 ? "+" : "") + m; };
 
function parseStats(arr = []) {
  const s = { STR: 10, DEX: 10, CON: 10, INT: 10, WIS: 10, CHA: 10 }; 
  arr.forEach(({ id, value }) => { if (STAT_ID_MAP[id]) s[STAT_ID_MAP[id]] = value; });
  return s;
}
 
export default function CharacterSheet() {
  const [lastRoll, setLastRoll] = useState(null);
  const location = useLocation();
  const character = location.state?.character || {};
  const stats = parseStats(character.stats);

  // --- NUEVOS ESTADOS MODIFICABLES ---
  const [hpCurrent, setHpCurrent] = useState(Number(character.hp_current ?? 10));
  const [ac, setAc] = useState(Number(character.ac ?? 10));
  const [xp, setXp] = useState(Number(character.experience ?? 0));
  const hpMax = Number(character.hp_max ?? 10);

  const roll = (name, bonus) => {
    const d = Math.ceil(Math.random() * 20);
    const total = d + bonus;
    const crit = d === 20, fail = d === 1;
    setLastRoll({ name, d, bonus, total, crit, fail });
  };
 
  const passives = character.passives       ?? [];
  const feats = character.feats          ?? [];
  const proefs = character.proeficiencies ?? [];
  const spells = character.spells         ?? [];
  const items = character.items          ?? [];
  const clases = character.clases         ?? [];

 const updateCharacterField = async (attributeName, value) => {
  try {
    // Construye la URL exacta: /characters/5?hp_current=14
    await api.patch(`/characters/${character.id}?${attributeName}=${value}`);
    console.log(`Guardado con éxito en servidor: ${attributeName} = ${value}`);
  } catch (e) {
    console.error(`Error al sincronizar ${attributeName} en el servidor`, e);
  }
};
  return (
    <div className="min-h-screen bg-stone-950 text-stone-200 antialiased">
      <Navbar />
      <main className="max-w-xl mx-auto p-4 space-y-5 pb-12">
  
        {/* Header */}

        <div className="flex items-center gap-4 border-b border-stone-800 pb-4">
          {character.image ? (
            <img src={character.image} className="w-14 h-14 sm:w-16 sm:h-16 rounded-full object-cover border border-stone-700" alt={character.name} />
          ) : (
            <div className="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-stone-900 border border-stone-700 flex items-center justify-center text-xl font-bold text-stone-400">
              {(character.name || "?")[0]}
            </div>
          )}
          <div className="min-w-0 flex-1">
            <h1 className="text-lg sm:text-xl font-bold text-stone-100 truncate">{character.name}</h1>
            <p className="text-stone-400 text-xs mt-0.5 break-words">
              {clases.map(c => c.name).join(" / ")} · {character.race?.name}{character.subrace_name ? ` (${character.subrace_name})` : ""} · Lv {character.level}
            </p>
            {character.background && (
              <p className="text-stone-500 text-[11px] mt-0.5">
                {character.background.name}{character.alignment ? ` · ${character.alignment}` : ""}
              </p>
            )}
          </div>
        </div>
  
        {/* Stats */}
        <div>
          <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Ability Scores</p>
          <div className="grid grid-cols-3 sm:grid-cols-6 gap-1.5 text-center">
            {Object.entries(stats).map(([k, v]) => (
              <div key={k} className="bg-stone-900 rounded p-2 border border-stone-800">
                <div className="text-[10px] text-stone-500 font-semibold">{k}</div>
                <div className="text-base font-bold text-stone-100 my-0.5">{v}</div>
                <div className="text-xs text-amber-500 font-medium">{modStr(v)}</div>
              </div>
            ))}
          </div>
        </div>
  
        {/* NUEVA SECCIÓN: Atributos Dinámicos (HP, AC, XP Modificables) */}
        <div>
          <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Atributos de Combate</p>
          <div className="grid grid-cols-1 sm:grid-cols-3 gap-2">
            
            {/* Control de Vida (HP) */}
<div className="bg-stone-900 border border-stone-800 rounded p-3 flex flex-col justify-between gap-2">
  <div className="flex justify-between items-center">
    <span className="text-stone-500 text-xs font-semibold uppercase">Puntos de Vida</span>
    <span className="text-stone-400 text-xs font-medium">Max {hpMax}</span>
  </div>
  <div className="flex items-center justify-between bg-stone-950 border border-stone-800 rounded p-1">
    <button 
      onClick={() => {
        const newValue = Math.max(0, hpCurrent - 1);
        setHpCurrent(newValue);
        updateCharacterField("hp_current", newValue); // <-- LLAMADA API EXTRA
      }}
      className="w-8 h-8 rounded bg-stone-900 hover:bg-red-950 border border-stone-800 text-stone-300 font-bold text-sm transition-colors"
    >
      -
    </button>
    <div className="text-center flex-1">
      <span className={`text-base font-bold ${hpCurrent === 0 ? "text-red-500" : hpCurrent <= hpMax * 0.3 ? "text-orange-400" : "text-stone-100"}`}>
        {hpCurrent}
      </span>
      <span className="text-stone-500 text-xs"> / {hpMax}</span>
    </div>
    <button 
      onClick={() => {
        const newValue = Math.min(hpMax, hpCurrent + 1);
        setHpCurrent(newValue);
        updateCharacterField("hp_current", newValue); // <-- LLAMADA API EXTRA
      }}
      className="w-8 h-8 rounded bg-stone-900 hover:bg-emerald-950 border border-stone-800 text-stone-300 font-bold text-sm transition-colors"
    >
      +
    </button>
  </div>
</div>

{/* Control de Armadura (AC) */}
<div className="bg-stone-900 border border-stone-800 rounded p-3 flex flex-col justify-between gap-2">
  <span className="text-stone-500 text-xs font-semibold uppercase">Clase de Armadura (AC)</span>
  <div className="flex items-center justify-between bg-stone-950 border border-stone-800 rounded p-1">
    <button 
      onClick={() => {
        const newValue = Math.max(0, ac - 1);
        setAc(newValue);
        updateCharacterField("ac", newValue); // <-- LLAMADA API EXTRA
      }}
      className="w-8 h-8 rounded bg-stone-900 hover:bg-stone-800 border border-stone-800 text-stone-300 font-bold text-sm transition-colors"
    >
      -
    </button>
    <input 
      type="number" 
      value={ac} 
      onChange={(e) => setAc(Math.max(0, Number(e.target.value)))}
      onBlur={(e) => updateCharacterField("ac", Number(e.target.value))} // <-- GUARDA AL QUITAR EL FOCO
      className="w-12 bg-transparent text-center text-base font-bold text-amber-500 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
    />
    <button 
      onClick={() => {
        const newValue = ac + 1;
        setAc(newValue);
        updateCharacterField("ac", newValue); // <-- LLAMADA API EXTRA
      }}
      className="w-8 h-8 rounded bg-stone-900 hover:bg-stone-800 border border-stone-800 text-stone-300 font-bold text-sm transition-colors"
    >
      +
    </button>
  </div>
</div>

{/* Control de Experiencia (XP) */}
<div className="bg-stone-900 border border-stone-800 rounded p-3 flex flex-col justify-between gap-2">
  <span className="text-stone-500 text-xs font-semibold uppercase">Experiencia (XP)</span>
  <div className="flex items-center bg-stone-950 border border-stone-800 rounded px-2 py-1 h-10">
    <input 
      type="number" 
      value={xp} 
      onChange={(e) => setXp(Math.max(0, Number(e.target.value)))}
      onBlur={(e) => updateCharacterField("experience", Number(e.target.value))} // <-- GUARDA AL QUITAR EL FOCO
      className="w-full bg-transparent text-left font-bold text-stone-100 text-sm focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
      placeholder="0"
    />
    <span className="text-stone-600 text-xs font-mono select-none">XP</span>
  </div>
</div>

          </div>
        </div>
  
        {/* Info complementaria estática */}
        <div className="flex flex-wrap gap-1.5">
          {[
            ["Velocidad", character.subrace_name?.toLowerCase().includes("wood") ? "35ft" : "30ft"],
            ["Código Manual", character.manual_code],
          ].filter(([, v]) => v !== undefined && v !== null && v !== "").map(([k, v]) => (
            <span key={k} className="bg-stone-900 border border-stone-800 rounded px-2.5 py-1 text-xs">
              <span className="text-stone-500">{k} </span><span className="text-stone-100 font-medium">{v}</span>
            </span>
          ))}
        </div>
  
        {/* Roll result */}
        {lastRoll && (
          <div className={`rounded-lg p-3 border text-center ${lastRoll.crit ? "bg-green-950/40 border-green-700/60" : lastRoll.fail ? "bg-red-950/40 border-red-700/60" : "bg-stone-900 border-stone-800"}`}>
            <span className="text-stone-400 text-xs">{lastRoll.name} · d20({lastRoll.d}) {lastRoll.bonus >= 0 ? "+" : ""}{lastRoll.bonus}</span>
            <div className={`text-2xl font-bold mt-0.5 ${lastRoll.crit ? "text-green-400" : lastRoll.fail ? "text-red-400" : "text-amber-400"}`}>
              {lastRoll.total} {lastRoll.crit ? "¡Crítico!" : lastRoll.fail ? "¡Pifia!" : ""}
            </div>
          </div>
        )}
  
        {/* Skills */}
        <div>
          <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Skills</p>
          <div className="grid grid-cols-1 min-[480px]:grid-cols-2 gap-1.5">
            {SKILLS.map((sk) => {
              const bonus = mod(stats[sk.stat]);
              return (
                <button key={sk.name} onClick={() => roll(sk.name, bonus)}
                  className="flex justify-between items-center bg-stone-900 hover:bg-stone-800/80 border border-stone-800 hover:border-amber-700/50 rounded px-3 py-2 transition-colors text-left active:scale-[0.99]">
                  <span className="text-stone-300 text-xs">{sk.name} <span className="text-stone-500 text-[10px]">({sk.stat})</span></span>
                  <span className="text-amber-500 text-xs font-bold ml-2 shrink-0">{bonus >= 0 ? "+" : ""}{bonus}</span>
                </button>
              );
            })}
          </div>
        </div>
  
        {/* Listas Adicionales */}
        {passives.length > 0 && <Section title={`Pasivas (${passives.length})`} items={passives} />}
        {feats.length > 0 && <Section title={`Feats (${feats.length})`} items={feats} />}
        
        {proefs.length > 0 && (
          <div>
            <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Proficiencias ({proefs.length})</p>
            <div className="flex flex-wrap gap-1">
              {proefs.map((p, idx) => (
                <span key={p.id || idx} className="bg-stone-900 border border-stone-800 rounded px-2 py-0.5 text-xs text-stone-300">{p.name}</span>
              ))}
            </div>
          </div>
        )}
        
        {spells.length > 0 && <Section title={`Hechizos (${spells.length})`} items={spells} />}
        
        {items.length > 0 && (
          <div>
            <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Inventario ({items.length})</p>
            <div className="space-y-1.5">
              {items.map((item, idx) => (
                <div key={item.id || idx} className="flex justify-between items-start bg-stone-900 border border-stone-800 rounded px-3 py-2">
                  <div className="min-w-0 flex-1">
                    <span className="text-stone-200 text-xs font-medium block">{item.name}</span>
                    {item.description && <p className="text-stone-500 text-xs mt-0.5 leading-relaxed">{item.description}</p>}
                  </div>
                  {item.pivot?.quantity && <span className="text-amber-500 text-xs font-bold ml-3 shrink-0 bg-stone-950/60 px-1.5 py-0.5 rounded border border-stone-800">×{item.pivot.quantity}</span>}
                </div>
              ))}
            </div>
          </div>
        )}
  
        {(character.race?.description || character.subrace?.description) && (
          <div className="space-y-2 pt-2">
            {character.race?.description && (
              <div className="bg-stone-900/60 border border-stone-800 rounded p-3">
                <p className="text-xs text-stone-500 font-medium mb-1">{character.race.name}</p>
                <p className="text-xs text-stone-400 italic leading-relaxed">{character.race.description}</p>
              </div>
            )}
            {character.subrace?.description && (
              <div className="bg-stone-900/60 border border-stone-800 rounded p-3">
                <p className="text-xs text-stone-500 font-medium mb-1">{character.subrace_name}</p>
                <p className="text-xs text-stone-400 italic leading-relaxed">{character.subrace.description}</p>
              </div>
            )}
          </div>
        )}
      </main>
    </div>
  );
}
 
function Section({ title, items }) {
  return (
    <div>
      <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">{title}</p>
      <div className="space-y-1.5">
        {items.map((item, idx) => (
          <div key={item.id || idx} className="bg-stone-900 border border-stone-800 rounded px-3 py-2">
            <span className="text-stone-200 text-xs font-medium block">{item.name}</span>
            {item.description && <p className="text-stone-500 text-xs mt-1 leading-relaxed">{item.description}</p>}
          </div>
        ))}
      </div>
    </div>
  );
}