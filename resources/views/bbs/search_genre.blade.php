<x-app-layout>
    <div class="my-10">
        <div class="text-center">
            <!-- ジャンル未選択で検索実行時にエラーメッセージ -->
            <div id="errorMessage" class="hidden mb-2 text-red-500">ジャンルを選択してください。</div>
            <!-- ジャンル検索フォーム -->
            <form id="searchForm" method="get" action="{{ route('search.genre') }}">
                @csrf
                <div class="w-72 mx-auto mb-5 p-2 rounded-md bg-yellow-200">
                    <!-- ジャンル選択のセレクトボックス -->
                    <select class="w-40 mr-4 sm:mr-6 text-black rounded-md" name="select" id="genreSelect">
                        <option value="0" hidden>選択してください</option>
                        @foreach($genres as $genre)
                        <option value="{{$genre->id}}" {{ $genre->id == request('select') ? 'selected' : '' }}>{{$genre->name}}</option>
                        @endforeach
                    </select>
                    <x-primary-button id="searchButton">
                        検索
                    </x-primary-button>
                </div>
            </form>
        </div>    

        <hr>

        <!-- 検索結果を表示 -->
        @if($threads->isNotEmpty()) <!-- 検索HIT有り -->
            @if($selectedGenre)
                <p  class="py-1">ジャンル：{{ $selectedGenre->name }}の検索結果</p>
            @endif

            <!-- HITしたスレッド一覧 -->
            <table class="w-full mb-5">
                <tr class="text-yellow-100">
                    <th class="py-3">タイトル</th>
                    <th>最終投稿日時</th>
                </tr>
                @foreach($threads as $thread)
                    <tr>
                        <td class="py-1 border-b-2 border-transparent hover:border-white">
                            <a href="{{ route('read', $thread)}}">{{ $thread->title }}</a>
                        </td>
                        <td class="pl-1 w-40">
                            @if($thread->latestPost)
                            {{$thread->latestPost->created_at}}
                            @else
                            投稿はありません
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <!-- ペジネーションリンク -->
            <div class="mb-5">
                {{ $threads->links() }}
            </div>
        @else <!-- 検索HIT無し -->
            @if($selectedGenre)
                <p class="py-1">ジャンル：{{ $selectedGenre->name }}に一致するスレッドは見つかりませんでした。</p>
            @endif
        @endif
    </div>

    <!-- エラーメッセージ -->
    <script>
        document.getElementById("searchButton").addEventListener("click", function(event) {
            event.preventDefault(); // フォームのデフォルトの動作をキャンセル
            
            var genreSelect = document.getElementById("genreSelect");
            if (genreSelect.value === "0") { // デフォルトの値が0の場合は常にエラーメッセージを表示
                document.getElementById("errorMessage").style.display = "block"; // エラーメッセージを表示
            } else {
                document.getElementById("errorMessage").style.display = "none"; // エラーメッセージを非表示
                document.getElementById("searchForm").submit(); // フォームを送信
            }
        });
    </script>
</x-app-layout>