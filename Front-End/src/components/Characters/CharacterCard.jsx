import { useNavigate } from 'react-router-dom'


export default function CharacterCard({character}){
    const navigate = useNavigate()

    return (
        <>
            <div className="card bg-base-100 w-96 shadow-sm">
                <div className="card-body">
                    <h2 className="card-title">{character.name}</h2>
                    <p>{character.description}</p>
                    <div className="card-actions justify-end">
                        <button className="btn btn-primary" onClick={() => navigate(`/Personaje/${character.id}`, {state: { character }})}>Navega al character</button>
                    </div>
                </div>
            </div>
        </>
    )
}