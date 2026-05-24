import { useParams, useLocation } from 'react-router-dom'

export default function CharacterDetailed(){
    const location = useLocation()

    const character = location.state.character
    return(
        <>
            <div id="Header">
                <h1>{character.name}</h1>
                <div>
                    <p>{character.race.name}</p>
                    <p>{character.subrace.name}</p>
                </div>
                <div>Vida + controles</div>
                <div>XP + controles</div>
            </div>
        </>
    )
}