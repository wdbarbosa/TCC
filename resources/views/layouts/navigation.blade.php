<nav x-data="{ open: false }" style="background-color: #9dc8ce;">
<link rel="stylesheet" href="{{ asset('stylenav.css') }}">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 lg:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex" style="width:100%;">

                <!-- Botão Hambúrguer -->
                <div class="-me-2 flex items-center lg:hidden">
                    <button @click="open = ! open" class="menu-button inline-flex items-center justify-center rounded-md text-gray-400 dark:text-gray-500 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 lg:-my-px lg:ms-10 lg:flex" style="justify-content: space-between; width: 100%;">
                    <div class="shrink-0 flex items-center">
                        <img class="w-12 h-auto" src="{{ asset('img/primeirodemaio.png') }}"> 
                    </div>
                    <!-- Bloco de Login -->
                    @if (Route::has('login'))
                        @auth
                        @else
                            <div class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                                <div class="flex lg:col-start-2">
                                    <nav class="-mx-10 flex flex-1 justify-end">
                                        <a href="{{ route('login') }}" class="bg-white text-black py-1 px-3 rounded-lg text-base font-medium hover:bg-gray-200 transition -mt-4">
                                            Login
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        @endauth
                    @endif

                    @auth
                        <div class="hidden space-x-8 lg:-my-px lg:ms-10 lg:flex">
                            @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->is('disciplinas*')" class="text-white">
                                    {{ __('Home') }}
                                </x-nav-link>
                            @endif
                            
                            @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                                <x-nav-link :href="route('forumdeduvidas')" :active="request()->routeIs('forumdeduvidas')" class="text-white">
                                    {{ __('Fórum de Dúvidas') }}
                                </x-nav-link>
                            @endif

                            @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                                <x-nav-link :href="route('questoes.index')" :active="request()->is('questoes*')" class="text-white">
                                    {{ __('Questões') }}
                                </x-nav-link>
                            @endif

                            @if(auth()->user()->nivel_acesso === 'aluno')
                                <x-nav-link :href="route('resumo.index')" :active="request()->is('resumo*')" class="text-white">
                                    {{ __('Resumos') }}
                                </x-nav-link>
                            @endif

                            @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->nivel_acesso === 'aluno' || auth()->user()->nivel_acesso === 'professor')
                                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-white">
                                    {{ __('Informações') }}
                                </x-nav-link>
                            @endif

                            @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                                <x-nav-link :href="route('comunicados')" :active="request()->routeIs('comunicados')" class="text-white">
                                    {{ __('Comunicados') }}
                                </x-nav-link>
                            @endif
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden lg:flex lg:items-center lg:ms-6">
                            <x-dropdown width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Perfil') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Sair') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Menu Responsivo -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
            <div class="pt-1 pb-3 space-y-1">
                @auth

                    @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->nivel_acesso === 'aluno' || auth()->user()->nivel_acesso === 'professor')
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                        <x-responsive-nav-link :href="route('forumdeduvidas')" :active="request()->routeIs('forumdeduvidas')">
                            {{ __('Fórum de Dúvidas') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                        <x-responsive-nav-link :href="route('questoes.index')" :active="request()->routeIs('questoes.index')">
                            {{ __('Questões') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'aluno')
                        <x-responsive-nav-link :href="route('resumo.index')" :active="request()->routeIs('resumo.index')">
                            {{ __('Resumos') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->nivel_acesso === 'aluno' || auth()->user()->nivel_acesso === 'professor')
                        <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                            {{ __('Informações') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'professor' || auth()->user()->nivel_acesso === 'aluno')
                        <x-responsive-nav-link :href="route('comunicados')" :active="request()->routeIs('comunicados')">
                            {{ __('Comunicados') }}
                        </x-responsive-nav-link>
                    @endif

                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-lg text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-responsive-nav-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                @endauth


                @guest
                <div class="flex items-center space-x-4">
                    <img class="w-12 h-auto" src="{{ asset('img/primeirodemaio.png') }}">
                    <a href="{{ route('login') }}" class="bg-white text-black py-1 px-3 rounded-lg text-base font-medium hover:bg-gray-200 transition">Login</a>
                </div>

                @endguest
            </div>
        </div>
    </div>
</nav>
