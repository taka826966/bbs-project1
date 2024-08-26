<x-app-layout>
    <div class="w-full sm:w-4/5 mx-auto my-10 p-5 bg-white text-black sm:rounded-lg">
        <!-- コメント作成フォーム -->
        <form method="post" action="{{ route('post.create', $thread) }}">
            @csrf
            <!-- コメント内容入力 -->
            <div class="flex flex-col mb-4">
                <label for="comment" class="font-medium">コメント</label>
                <x-input-error :messages="$errors->get('comment')"/>
                <textarea class="rounded-md" name="comment" id="comment" cols="100" rows="5">{{ old('comment') }}</textarea>
                <div id="charCount">文字数: 0</div>
            </div>

            <x-primary-button>
                投稿
            </x-primary-button>
        </form>
    </div>
    
    <script>
        // テキストエリアの要素を取得
        const textarea = document.getElementById('comment');
        // 文字数表示用の要素を取得
        const charCount = document.getElementById('charCount');

        // 文字数を更新する関数
        function updateCharCount() {
            const textLength = textarea.value.length;
            charCount.textContent = '文字数: ' + textLength;
        }

        // ページロード時に文字数を表示
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount();
        });
    
        // テキストエリアの入力を監視
        textarea.addEventListener('input', updateCharCount);
    </script>
</x-app-layout>