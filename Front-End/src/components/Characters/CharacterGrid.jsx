import { useState } from "react"
import CharacterCard from "./CharacterCard"
export default function CharacterGrid({characters}){
    return(
        <>
            <div id="grid" className="grid grid-cols-4 gap-4"> 
                {
                    characters.map(c=>(
                        <CharacterCard key={c.id} character={c}/>
                    ))
                }
            </div>
        </>
    )
}