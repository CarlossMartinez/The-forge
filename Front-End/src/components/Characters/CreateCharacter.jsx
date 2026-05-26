import Navbar from "../NavBar/Navbar"
import {useState, useEffect} from 'react';

export default function CreateCharacter(){
    const [name,setName] = useState(null);
    const [description, setDescription] = useState(null);
    const [alignment, setalignment] = useState(null);
    const [image, setImage] = useState(null);
    const [race, setRace] = useState(null);
    const [background, setBackground] = useState(null);
    const [clas, setClas] = useState(null);
    const [subclass, setSubclass] = useState(null);
    const [manual, setManual] = useState(null);

    const level = 1;
    const xp = 0;

    return(
        <>
            <Navbar />
            <h2>Nuevo Personaje</h2>
            <form onSubmit={guardaPersonaje}>
                <div>
                    <label>Manual</label>
                    <select id="selectManual" value={manual} onChange={(e)=> setManual(e.target.value)}></select>    
                </div>

                <div>
                    <label>Nombre</label>
                    <input type="text" value={name} onChange={(e) => setName(e.target.value)} placeholder="Ejemplo: Varis"/>
                </div>
                <div>
                    <label>Descripción</label>
                    <input type="text" value={description} onChange={(e) => setDescription(e.target.value)} placeholder="Ejemplo: Varis es un mago que junto a..."/>
                </div>
                <div>
                    <label>Alineamiento</label>
                    <select id="selectAlignment" value={alignment} onChange={(e)=> setalignment(e.target.value)}>
                    </select>
                </div>
                <div>
                    <label>Foto</label>
                    <input type="url" value={image} onChange={(e)=> setImage(e.target.value)}/>
                </div>
                <div>
                    <label>Raza</label>
                    <select id="selectRace" value={race} onChange={(e) => setRace(e.target.value)}>
                    </select>
                </div>
                <div>
                    <label>Subraza</label>
                    <select id="selectSubrace"></select>
                </div>
                <div>
                    <label>Transfondo</label>
                    <select id="selectBackground" value={background} onChange={(e)=> setBackground(e.target.value)}></select>
                </div>
                <div>
                    <label>Clase</label>
                    <select id="selectClass" value={clas} onChange={(e)=> setClas(e.target.value)}>
                    </select>
                </div>
                <div>
                    <label>Subclase</label>
                    <select id="selectSubclass" value={subclass} onChange={(e)=> setSubclass(e.target.value)}></select>
                </div>
            </form>
        </>
    )
}