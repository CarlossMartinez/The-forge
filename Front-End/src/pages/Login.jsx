import { useAuth } from '../context/AuthContext';

export default function Login() {
    const { loginWithGithub } = useAuth();

    return (
        <div className="flex items-center justify-center min-h-screen bg-stone-950 text-stone-200 px-4 antialiased">
            {/* Contenedor tipo pergamino/tarjeta mística */}
            <div className="w-full max-w-sm text-center bg-stone-900 border border-stone-800 rounded-xl p-8 shadow-2xl relative overflow-hidden">
                <h1 className="text-xl sm:text-2xl font-bold text-stone-100 tracking-wide uppercase font-serif">
                    Bienvenido a Dados de Nesus
                </h1>
                <p className="text-stone-500 text-xs mt-2 mb-8 max-w-[250px] mx-auto balance leading-relaxed">
                    Crea a tu proximo aventurero
                </p>

                <button
                    onClick={loginWithGithub}
                    className="w-full flex items-center justify-center gap-3 bg-stone-950 border border-amber-700/60 hover:border-amber-500 text-amber-500 hover:text-amber-400 font-medium text-xs uppercase tracking-wider px-5 py-3.5 rounded-lg hover:bg-amber-950/20 transition-all duration-300 shadow-lg active:scale-[0.98]"
                >
                    {/* Icono de GitHub SVG */}
                    <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path fillRule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.0.608.069.608 1.003 1.187 1.003 1.187 1.518.851 2.507 1.493 1.784 1.855 1.364.091-.65.351-1.1.639-1.353-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
                    </svg>
                    <span>Continuar con GitHub</span>
                </button>
            </div>
        </div>
    );
}