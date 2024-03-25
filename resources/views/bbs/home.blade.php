<x-app-layout>
    <div class="text-center">
        home
        <img src="{{asset('img/big_logo.png')}}" alt="">
        <img src="{{asset('img/title.png')}}" alt="" width="20%">
        @auth <!-- ユーザー用 -->
            <p>
                ようこそ、{{ Auth::user()->name }}さん
            </p>
            <div>
                <a href="{{ route('search.word') }}">
                    <x-primary-button>
                        ワード検索
                    </x-primary-button>
                </a>
                <a href="{{ route('search.genre') }}">
                    <x-primary-button>
                        ジャンル検索
                    </x-primary-button>
                <a href="{{ route('thread_creation') }}">
                    <x-primary-button>
                        スレッド作成
                    </x-primary-button>
                </a>
            </div>
        @else <!-- ゲスト用 -->
            <p>
                ようこそ
            </p>
            <div>
                <a href="{{ route('search.word') }}">
                    <x-primary-button>
                        ワード検索
                    </x-primary-button>
                </a>
                <a href="{{ route('search.genre') }}">
                    <x-primary-button>
                        ジャンル検索
                    </x-primary-button>
                </a>
            </div>
        @endauth
    </div>
</x-app-layout>