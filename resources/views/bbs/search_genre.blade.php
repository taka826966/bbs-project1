<x-app-layout>
    search_genre
    <div>
        <!-- ジャンル未選択で検索実行時にエラーメッセージ -->
        <div id="errorMessage" class="hidden text-red-500">ジャンルを選択してください。</div>
        <!-- ジャンル検索フォーム -->
        <form id="searchForm" method="get" action="{{ route('search.genre') }}">
            @csrf
            <div>
                <!-- ジャンル選択のセレクトボックス -->
                <select class="text-black" name="select" id="genreSelect">
                    <option value="0" hidden>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}" {{ $genre->id == request('select') ? 'selected' : '' }}>{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <x-primary-button id="searchButton">
                検索
            </x-primary-button>
        </form>
    </div>    

    <hr>

    <!-- 検索結果を表示 -->
    @if($selectedGenre)
        <h2>ジャンル：{{ $selectedGenre->name }}の検索結果</h2>
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

    <!-- エラーメッセージ -->
    <script>
        document.getElementById("searchButton").addEventListener("click", function(event) {
            event.preventDefault(); // フォームのデフォルトの動作をキャンセル
            
            var genreSelect = document.getElementById("genreSelect");
            if (genreSelect.value === "0") { // デフォルトの値が0の場合はエラーメッセージを表示
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