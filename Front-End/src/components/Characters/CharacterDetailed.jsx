import { useParams, useLocation } from 'react-router-dom'
import Navbar from '../NavBar/Navbar'
export default function CharacterDetailed(){
    const location = useLocation()

    const character = location.state.character
    return(
        <>
            <Navbar />
            <div id="Header">
                <h1>{character.name}</h1>
                <div>
                    <p>{character.race.name}</p>
                </div>
                <div>Vida + controles</div>
                <div>XP + controles</div>
            </div>
        </>
    )
}