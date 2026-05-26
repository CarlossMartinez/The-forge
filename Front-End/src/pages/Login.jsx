import { useAuth } from '../context/AuthContext';

export default function Login() {
    const { loginWithGithub } = useAuth();

    return (
        <div className="flex items-center justify-center h-screen">
            <div className="text-center">
                <h1 className="text-3xl font-bold mb-6">DnD Character Creator</h1>
                <button
                    onClick={loginWithGithub}
                    className="flex items-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-700"
                >
                    Continuar con GitHub
                </button>
            </div>
        </div>
    );
}