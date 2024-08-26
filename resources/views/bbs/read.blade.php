<x-app-layout>
    <div class="my-10">
        <!-- スレッドタイトル -->
        <div class="w-full sm:w-4/5 mx-auto my-10 p-3 bg-yellow-100 text-black sm:rounded-md">
            <h1 class="mb-3 text-lg font-semibold">{{ $thread->title }}</h1>
            <div class="flex justify-end">
                <p class="mr-3">{{ $thread->user->name}} / {{ $thread->created_at}}</p>
                <!-- 管理者か作成ユーザーのみスレッド編集ボタンを表示 -->
                @auth
                @if(auth()->id() == $thread->user_id || auth()->user()->role == 'admin')
                <a href="{{route('thread_edit', $thread)}}">
                    <x-primary-button>
                        編集
                    </x-primary-button>
                </a>
                @endif
                @endauth
            </div>
        </div>
        <!-- コメント一覧 -->
        <div>
            @foreach($posts as $post)
            <div class="w-9/10 sm:w-4/5 mx-auto mb-4 p-3 bg-white text-black sm:rounded-lg">
                <div class="mb-3 flex">
                    <!-- 表示番号を計算 -->
                    @php
                    $index = ($posts->currentPage() - 1) * $posts->perPage() + $loop->index + 1;
                    @endphp
                    <h2 class="mr-3 text-lg font-semibold">{{ $index }}</h2>
                    <p>{{$post->user->name}} / {{$post->created_at}}</p>
                </div>
                <p class=" mb-3 whitespace-pre-wrap">{{$post->comment}}</p>
                <!-- 管理者か作成ユーザーのみコメント削除ボタンを表示 -->
                @auth
                @if(auth()->id() == $post->user_id || auth()->user()->role == 'admin')
                <div class="text-right">
                    <form method="post" action="{{route('delete', ['thread' => $thread->id, 'post' => $post->id])}}">
                        @csrf
                        @method('delete')
                        <x-primary-button class="bg-red-700" id="delete-button">
                            削除
                        </x-primary-button>
                    </form>
                </div>
                @endif
                @endauth
            </div>
            @endforeach
        </div>
        <!-- コメント作成ページへのリンク -->
        <div class="w-32 mx-auto mb-2 p-2 bg-white rounded-md">
            <a href="{{route('post_creation', $thread)}}">
                <x-primary-button>
                    コメントを投稿
                </x-primary-button>
            </a>
        </div>
        <div class="mb-4">
            {{$posts->links()}}
        </div>
    </div>
    <!-- コメント削除の確認ダイアログ表示 -->
    <script>
        // 削除ボタンを取得
        var deleteButtons = document.querySelectorAll('#delete-button');
        
        // 各削除ボタンにクリックイベントリスナーを追加
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // 確認ダイアログを表示
                var confirmDelete = confirm('このコメントを削除しますか？');
                // キャンセルされた場合、フォームの送信をキャンセル
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
    </script>
    <!-- コメント作成成功時のダイアログ表示 -->
    @if(session('success'))
    <div id="flash-message" class="fixed top-0 left-0 w-full h-full flex items-center justify-center">
        <!-- 半透明なオーバーレイ -->
        <div class="fixed top-0 left-0 w-full h-full bg-black opacity-50"></div>
        <!-- フラッシュメッセージ -->
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative z-10">
            <strong class="font-bold">成功!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    <script>
        // 3秒後にフラッシュメッセージを非表示にする
        setTimeout(function() {
            var flashMessage = document.getElementById('flash-message');
            flashMessage.style.display = 'none';
        }, 3000); // 3000ミリ秒 = 3秒
    </script>
    <script>
        window.onload = function() {
            window.scrollTo(0, document.body.scrollHeight);
        };
    </script>
    @endif
</x-app-layout>