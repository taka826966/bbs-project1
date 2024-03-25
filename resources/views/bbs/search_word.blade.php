<x-app-layout>
    search
    <div>
        <!-- 検索ワード未入力で検索実行時にエラーメッセージ -->
        <div id="errorMessage" class="hidden text-red-500">検索ワードを入力してください。</div>
        <!-- ワード検索フォーム -->
        <form id="searchForm" method="get" action="{{ route('search.word') }}">
            @csrf
            <div>
                <input type="text" class="text-black" name="word" id="searchWord" value="{{ old('word', $word) }}">
            </div>
            
            <x-primary-button id="searchButton">
                検索
            </x-primary-button>
        </form>
    </div>

    <hr>

    <!-- 検索結果を表示 -->
    @if($threads->isNotEmpty()) <!-- 検索HIT有り -->
        @if(!empty($word))
            <p>ワード：{{ $word }} の検索結果</p>
        @endif

        <!-- HITしたスレッド一覧 -->
        <table>
            @foreach($threads as $thread)
                <tr>
                    <td><a href="{{ route('read', $thread)}}">{{ $thread->title }}</a></td>
                    <td>
                        @if($thread->latestPost)
                        最終投稿日時：{{$thread->latestPost->created_at}}
                        @else
                        投稿はありません
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @else <!-- 検索HIT無し -->
        @if(!empty($word))
            <p>ワード：{{ $word }} に一致するスレッドは見つかりませんでした。</p>
        @endif
    @endif

    <!-- エラーメッセージ -->
    <script>
        document.getElementById("searchButton").addEventListener("click", function(event) {
            event.preventDefault(); // フォームのデフォルトの動作をキャンセル
            
            var searchWord = document.getElementById("searchWord").value.trim(); // 入力された値を取得し、前後の空白を削除
            if (searchWord === "") {
                document.getElementById("errorMessage").style.display = "block"; // エラーメッセージを表示
    
                // 5秒後にエラーメッセージを非表示にする
                setTimeout(function() {
                    document.getElementById("errorMessage").style.display = "none";
                }, 5000);
            } else {
                document.getElementById("errorMessage").style.display = "none"; // エラーメッセージを非表示
                document.getElementById("searchForm").submit(); // フォームを送信
            }
        });
    </script>
</x-app-layout>