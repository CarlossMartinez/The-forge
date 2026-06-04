import { useNavigate } from 'react-router-dom';
 
export default function CharacterCard({ character }) {
    const navigate = useNavigate();
    const className = character.clases?.map(c => c.name).join(' / ') || 'Sin clase';
 
    return (
        <>
            <div
                onClick={() => navigate(`/Personaje/${character.id}`, { state: { character } })}
                className="bg-stone-900 border border-stone-700 hover:border-amber-700 rounded-xl p-4 cursor-pointer transition-colors flex gap-3 items-start"
            >
                {character.image
                    ? <img src={character.image} className="w-12 h-12 rounded-full object-cover border border-stone-700 shrink-0" />
                    : <div className="w-12 h-12 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center font-bold text-stone-400 shrink-0">
                        {(character.name || '?')[0]}
                    </div>
                }
                <div className="min-w-0">
                    <h2 className="font-bold text-stone-100 truncate">{character.name}</h2>
                    <p className="text-xs text-stone-500">{className} · Lv {character.level}</p>
                    {character.description && <p className="text-xs text-stone-400 mt-1 line-clamp-2">{character.description}</p>}
                </div>
            </div>
         </>
    );
}
 