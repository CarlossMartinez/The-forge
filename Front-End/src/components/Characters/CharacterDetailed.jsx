import { useParams, useLocation, useNavigate } from 'react-router-dom'
import Navbar from '../NavBar/Navbar'
import api from '../../api'
export default function CharacterDetailed(){
    const location = useLocation()
    const navigate = useNavigate();
    const character = location.state.character

    async function deleteCharacter(){
        console.log(character)
      await api.patch(`/characters/${character.id}`);
        navigate('/dashboard')
    }
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

            <button onClick={deleteCharacter}>
                Borra el personaje
            </button>
        </>
    )
}