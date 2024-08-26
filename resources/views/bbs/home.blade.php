<x-app-layout>
    <div class="my-10">
        <div class="mb-5">
            <img src="{{asset('img/big_logo.png')}}" alt="" class="m-auto">
            <img src="{{asset('img/title.png')}}" alt="" class="w-60 m-auto">
        </div>
        <div class="w-36 sm:h-16 sm:w-96 mx-auto mb-10 rounded-md bg-yellow-100 flex flex-col sm:flex-row justify-center items-center">
            @auth <!-- ログインユーザー用 -->
            <div class="m-3">
                <a href="{{ route('search.word') }}">
                    <x-primary-button>
                        ワード検索
                    </x-primary-button>
                </a>
            </div>
            <div class="m-3">
                <a href="{{ route('search.genre') }}">
                    <x-primary-button>
                        ジャンル検索
                    </x-primary-button>
                </a>
            </div>
            <div class="m-3">
                <a href="{{ route('thread_creation') }}">
                    <x-primary-button>
                        スレッド作成
                    </x-primary-button>
                </a>
            </div>
            @else <!-- ゲストユーザー用 -->
            <div class="m-3 sm:m-8">
                <a href="{{ route('search.word') }}">
                    <x-primary-button>
                        ワード検索
                    </x-primary-button>
                </a>
            </div>
            <div class="m-3 sm:m-8">
                <a href="{{ route('search.genre') }}">
                    <x-primary-button>
                        ジャンル検索
                    </x-primary-button>
                </a>
            </div>
            @endauth
        </div>
        <div class="w-full sm:w-4/5 lg:w-3/5 sm:rounded-lg bg-gray-500 mx-auto">
            <ul class="px-8 py-2">
                <li type="disc">ゲストユーザーは閲覧のみとなります</li>
                <li type="disc">ログインユーザーはコメント投稿やスレッド作成が可能となります</li>
                <li type="disc">スレッド編集やコメント削除は作成者本人のみ可能です</li>
                <li type="disc">管理者権限によりスレッドの編集や削除、コメント削除、アカウント削除を行う場合があります</li>
                <li></li>
            </ul>
        </div>
    </div>
</x-app-layout>