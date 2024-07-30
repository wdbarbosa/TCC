
<nav x-data="{ open: false }"  style="background-color: #9dc8ce;">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 lg:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex" style="width:100%;">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 lg:-my-px lg:ms-10 lg:flex" style="justify-content: space-between; width: 100%;">
                    <div class="shrink-0 flex items-center" >
                        <a href="{{ route('dashboard') }}" class="pr-2">
                            <x-application-logo/>
                        </a>
                    </div>
                    <div class="hidden space-x-8 lg:-my-px lg:ms-10 lg:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                            {{ __('Home') }}
                        </x-nav-link>

                        <x-nav-link :href="route('forumdeduvidas')" :active="request()->routeIs('forumdeduvidas')" class="text-white">
                            {{ __('Fórum de Dúvidas') }}
                        </x-nav-link>

                        @if(auth()->user()->nivel_acesso === 'admin')
                            <x-nav-link :href="route('materias')" :active="request()->routeIs('materias')" class="text-white">
                                {{ __('Disciplinas') }}
                            </x-nav-link>
                        @endif
                        
                        <x-nav-link :href="route('questoes.index')" :active="request()->routeIs('questoes.index')" class="text-white">
                            {{ __('Questões') }}
                        </x-nav-link>
         
                        @if(auth()->user()->nivel_acesso === 'aluno')
                        <x-nav-link :href="route('resumo.index')" :active="request()->routeIs('resumo.index')" class="text-white">
                            {{ __('Resumos') }}
                        </x-nav-link>
                        @endif

                        <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-white">
                             {{ __('Informações') }}
                         </x-nav-link>

                         
                        <x-nav-link :href="route('comunicados')" :active="request()->routeIs('comunicados')" class="text-white">
                             {{ __('Comunicados') }}
                         </x-nav-link>
                    </div>


            <!-- Settings Dropdown -->
            <div class="hidden lg:flex lg:items-center lg:ms-6">
                <x-dropdown  width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover: #9dc8ce hover:#9dc8ce focus:outline-none transition ease-in-out duration-150">
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

                        <!-- Authentication -->
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
        </div>
    </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBoxho="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('forumdeduvidas')" :active="request()->routeIs('forumdeduvidas')">
                {{ __('Fórum de Dúvidas') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('materias')" :active="request()->routeIs('materias')">
                {{ __('Disciplinas') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('questoes.index')" :active="request()->routeIs('questoes.index')">
                {{ __('Questões') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('resumo.index')" :active="request()->routeIs('resumo.index')">
                {{ __('Resumos') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('Informações') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-1 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('comunicados')" :active="request()->routeIs('comunicados')">
                {{ __('Comunicados') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-lg text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
