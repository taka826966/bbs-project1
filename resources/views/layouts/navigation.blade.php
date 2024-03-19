<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:block" >
            <div class="flex lg:justify-between">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    <p>@auth ようこそ {{ Auth::user()->name }}さん @endauth</p>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 lg:-my-px lg:ms-10 lg:flex">
                    @auth
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        ホーム
                    </x-nav-link>
                    <x-nav-link :href="route('search.word')" :active="request()->routeIs('search.word')">
                        ワード検索
                    </x-nav-link>
                    <x-nav-link :href="route('search.genre')" :active="request()->routeIs('search.genre')">
                        ジャンル検索
                    </x-nav-link>
                    <x-nav-link :href="route('thread_creation')" :active="request()->routeIs('thread_creation')">
                        スレッド作成
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        アカウント情報
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}" class="sm:-my-px sm:ms-10 sm:flex">
                        @csrf
                        <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            ログアウト
                        </x-nav-link>
                    </form>
                    @else
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        ホーム
                    </x-nav-link>
                    <x-nav-link :href="route('search.word')" :active="request()->routeIs('search.word')">
                        ワード検索
                    </x-nav-link>
                    <x-nav-link :href="route('search.genre')" :active="request()->routeIs('search.genre')">
                        ジャンル検索
                    </x-nav-link>
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        ログイン
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                ホーム
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.word')" :active="request()->routeIs('search.word')">
                ワード検索
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.genre')" :active="request()->routeIs('search.genre')">
                ジャンル検索
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('thread_creation')" :active="request()->routeIs('thread_creation')">
                スレッド作成
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                アカウント情報
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
            @else
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                ホーム
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.word')" :active="request()->routeIs('search.word')">
                ワード検索
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.genre')" :active="request()->routeIs('search.genre')">
                ジャンル検索
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                ログイン
            </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
