<nav class="pl-4 pt-4 md:pl-12 md:pt-12 lg:pl-28 lg:pt-16">
    <ul class="flex flex-col items-center xs:flex-row xs:items-start">
        @guest
            <li class="pb-3 xs:pb-0 xs:pr-6 xl:pr-12 text-gray-200 font-dmsans text-lg transition duration-300 hover:text-white hover:underline"><a href="{{ route('login') }}">Se connecter</a></li>
            <li class="text-gray-200 font-dmsans text-lg transition duration-300 hover:text-white hover:underline"><a href="{{ route('register') }}">S'inscrire</a></li>
        @endguest

        @auth
            <li class="pb-3 xs:pb-0 xs:pr-6 xl:pr-12 text-gray-200 hover:text-white hover:underline font-dmsans text-lg transition duration-300"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
            <li class="text-gray-200 hover:text-white hover:underline font-dmsans text-lg transition duration-300">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>
