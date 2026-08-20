import { useNavigate } from 'react-router-dom';
import Navbar from '../Components/NavBar/Navbar';

export default function Dashboard() {
    const navigate = useNavigate();
  return (
    <>
      <Navbar />
      <div>
        <h1>Dashboard</h1>
      </div>
    </>
   )
}