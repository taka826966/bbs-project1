<x-app-layout>
    <div class="my-10">
        <div class="text-center">
            <!-- 検索ワード未入力で検索実行時にエラーメッセージ -->
            <div id="errorMessage" class="hidden mb-2 text-red-500">検索ワードを入力してください。</div>
            <!-- ワード検索フォーム -->
            <form id="searchForm" method="get" action="{{ route('search.word') }}">
                @csrf
                <div class="w-4/5 sm:w-3/5 mx-auto mb-5 p-2 rounded-md bg-yellow-200">
                    <input type="text" class="w-3/5 sm:w-3/4 mr-4 text-black rounded-md" name="word" id="searchWord" value="{{ old('word', $word) }}">
                    <x-primary-button id="searchButton">
                        検索
                    </x-primary-button>
                </div>
            </form>
        </div>

        <hr>

        <!-- 検索結果を表示 -->
        @if($threads->isNotEmpty()) <!-- 検索HIT有り -->
            @if(!empty($word))
                <p class="py-3">ワード：{{ $word }} の検索結果</p>
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
            @if(!empty($word))
                <p class="py-1">ワード：{{ $word }} に一致するスレッドは見つかりませんでした。</p> 
            @endif
        @endif
    </div>

    <!-- エラーメッセージ --> 
    <script>
        document.getElementById("searchButton").addEventListener("click", function(event) {
            event.preventDefault(); // フォームのデフォルトの動作をキャンセル
            
            var searchWord = document.getElementById("searchWord").value.trim(); // 入力された値を取得し、前後の空白を削除
            if (searchWord === "") {
                document.getElementById("errorMessage").style.display = "block"; // エラーメッセージを表示
            } else {
                document.getElementById("errorMessage").style.display = "none"; // エラーメッセージを非表示
                document.getElementById("searchForm").submit(); // フォームを送信
            }
        });
    </script>
</x-app-layout>