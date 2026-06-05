import CharacterCard from "./CharacterCard";

export default function CharacterGrid({ characters }) {
    return (
        <>
            <div 
                id="grid" 
                className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
            > 
                {characters.map(c => (
                    <CharacterCard key={c.id} character={c} />
                ))}
            </div>
        </>
    );
}