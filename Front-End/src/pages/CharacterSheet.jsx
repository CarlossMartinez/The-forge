import { useState } from "react";
import { useParams, useLocation, useNavigate } from 'react-router-dom';
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
  const s = { STR: 10, DEX: 10, CON: 10, INT: 10, WIS: 10, CHA: 10 }; // Si no hay stats -> ponerlo a 10 
  arr.forEach(({ id, value }) => { if (STAT_ID_MAP[id]) s[STAT_ID_MAP[id]] = value; });
  return s;
}
 
export default function CharacterSheet() {

  const [lastRoll, setLastRoll] = useState(null);
    const location = useLocation();
    const character = location.state.character;
      const stats = parseStats(character.stats);
  const roll = (name, bonus) => {
    const d = Math.ceil(Math.random() * 20);
    const total = d + bonus;
    const crit = d === 20, fail = d === 1;
    setLastRoll({ name, d, bonus, total, crit, fail });
  };
 
  const passives   = character.passives       ?? [];
  const feats      = character.feats          ?? [];
  const proefs     = character.proeficiencies ?? [];
  const spells     = character.spells         ?? [];
  const items      = character.items          ?? [];
  const clases     = character.clases         ?? [];
 
  return (
    <div className="max-w-xl mx-auto p-4 space-y-4 text-sm text-stone-200 bg-stone-950 min-h-screen">
 
      {/* Header */}
      <div className="flex items-center gap-3 border-b border-stone-700 pb-3">
        {character.image
          ? <img src={character.image} className="w-14 h-14 rounded-full object-cover border border-stone-600" />
          : <div className="w-14 h-14 rounded-full bg-stone-800 border border-stone-600 flex items-center justify-center text-xl font-bold text-stone-300">
              {(character.name || "?")[0]}
            </div>
        }
        <div>
          <h1 className="text-lg font-bold text-stone-100">{character.name}</h1>
          <p className="text-stone-400 text-xs">
            {clases.map(c => c.name).join(" / ")} · {character.race?.name}{character.subrace_name ? ` (${character.subrace_name})` : ""} · Lv {character.level}
          </p>
          {character.background && <p className="text-stone-500 text-xs">{character.background.name}{character.alignment ? ` · ${character.alignment}` : ""}</p>}
        </div>
      </div>
 
      {/* Stats */}
      <div>
        <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Ability Scores</p>
        <div className="grid grid-cols-6 gap-1 text-center">
          {Object.entries(stats).map(([k, v]) => (
            <div key={k} className="bg-stone-900 rounded p-2 border border-stone-700">
              <div className="text-[10px] text-stone-500">{k}</div>
              <div className="font-bold text-stone-100">{v}</div>
              <div className="text-xs text-amber-500">{modStr(v)}</div>
            </div>
          ))}
        </div>
      </div>
 
      {/* Quick info */}
      <div className="flex flex-wrap gap-2">
        {[
          ["HP", `${character.hp_current ?? "—"}/${character.hp_max ?? "—"}`],
          ["AC", character.ac ?? "—"],
          ["Speed", character.subrace_name?.toLowerCase().includes("wood") ? "35ft" : "30ft"],
          ["XP", character.experience ?? 0],
          ["Manual", character.manual_code],
        ].filter(([, v]) => v !== undefined && v !== null && v !== "").map(([k, v]) => (
          <span key={k} className="bg-stone-900 border border-stone-700 rounded px-2 py-1 text-xs">
            <span className="text-stone-500">{k} </span><span className="text-stone-100 font-medium">{v}</span>
          </span>
        ))}
      </div>
 
      {/* Roll result */}
      {lastRoll && (
        <div className={`rounded-lg p-3 border text-center ${lastRoll.crit ? "bg-green-950 border-green-700" : lastRoll.fail ? "bg-red-950 border-red-700" : "bg-stone-900 border-stone-700"}`}>
          <span className="text-stone-400 text-xs">{lastRoll.name} · d20({lastRoll.d}) {lastRoll.bonus >= 0 ? "+" : ""}{lastRoll.bonus}</span>
          <div className={`text-3xl font-bold ${lastRoll.crit ? "text-green-400" : lastRoll.fail ? "text-red-400" : "text-amber-400"}`}>
            {lastRoll.total} {lastRoll.crit ? "Crítico!!!" : lastRoll.fail ? "Pifia..." : ""}
          </div>
        </div>
      )}
 
      {/* Skills */}
      <div>
        <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Skills</p>
        <div className="grid grid-cols-2 gap-1">
          {SKILLS.map((sk) => {
            const bonus = mod(stats[sk.stat]);
            return (
              <button key={sk.name} onClick={() => roll(sk.name, bonus)}
                className="flex justify-between items-center bg-stone-900 hover:bg-stone-800 border border-stone-700 hover:border-amber-700 rounded px-2 py-1.5 transition-colors text-left">
                <span className="text-stone-200 text-xs">{sk.name} <span className="text-stone-500">({sk.stat})</span></span>
                <span className="text-amber-500 text-xs font-bold ml-2 shrink-0">{bonus >= 0 ? "+" : ""}{bonus}</span>
              </button>
            );
          })}
        </div>
      </div>
 
      {/* Passives / features */}
      {passives.length > 0 && (
        <Section title={`Pasivas (${passives.length})`} items={passives} />
      )}
      {feats.length > 0 && (
        <Section title={`Feats (${feats.length})`} items={feats} />
      )}
      {proefs.length > 0 && (
        <div>
          <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Proficiencias ({proefs.length})</p>
          <div className="flex flex-wrap gap-1">
            {proefs.map((p) => (
              <span key={p.id} className="bg-stone-900 border border-stone-700 rounded px-2 py-0.5 text-xs text-stone-300">{p.name}</span>
            ))}
          </div>
        </div>
      )}
      {spells.length > 0 && (
        <Section title={`Hechizos (${spells.length})`} items={spells} />
      )}
      {items.length > 0 && (
        <div>
          <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">Inventario ({items.length})</p>
          <div className="space-y-1">
            {items.map((item) => (
              <div key={item.id} className="flex justify-between items-start bg-stone-900 border border-stone-700 rounded px-2 py-1.5">
                <div>
                  <span className="text-stone-200 text-xs font-medium">{item.name}</span>
                  {item.description && <p className="text-stone-500 text-xs">{item.description}</p>}
                </div>
                {item.pivot?.quantity && <span className="text-amber-500 text-xs ml-2">×{item.pivot.quantity}</span>}
              </div>
            ))}
          </div>
        </div>
      )}
 
      {/* Race / subrace descriptions */}
      {(character.race?.description || character.subrace?.description) && (
        <div className="space-y-2">
          {character.race?.description && (
            <div className="bg-stone-900 border border-stone-700 rounded p-3">
              <p className="text-xs text-stone-500 mb-1">{character.race.name}</p>
              <p className="text-xs text-stone-400 italic">{character.race.description}</p>
            </div>
          )}
          {character.subrace?.description && (
            <div className="bg-stone-900 border border-stone-700 rounded p-3">
              <p className="text-xs text-stone-500 mb-1">{character.subrace_name}</p>
              <p className="text-xs text-stone-400 italic">{character.subrace.description}</p>
            </div>
          )}
        </div>
      )}
    </div>
  );
}
 
function Section({ title, items }) {
  return (
    <div>
      <p className="text-xs text-stone-500 uppercase tracking-wider mb-2">{title}</p>
      <div className="space-y-1">
        {items.map((item) => (
          <div key={item.id} className="bg-stone-900 border border-stone-700 rounded px-2 py-1.5">
            <span className="text-stone-200 text-xs font-medium">{item.name}</span>
            {item.description && <p className="text-stone-500 text-xs mt-0.5">{item.description}</p>}
          </div>
        ))}
      </div>
    </div>
  );
}