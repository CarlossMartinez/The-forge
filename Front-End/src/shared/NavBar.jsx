import {NavLink} from 'react-router-dom'

export default function NavBar(){
    return(
        <>
            <div className="navBar">
                <Navlink
                to="/dashboard"
                >
                    Dashboard
                </Navlink>
                <NavLink>
                    Mis personajes
                </NavLink>
            </div>
        </>
       );
}