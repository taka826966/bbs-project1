<x-app-layout>
    <div class="w-full sm:max-w-lg mx-auto my-10 p-5 bg-white text-black sm:rounded-lg">
        <!-- スレッド作成フォーム -->
        <form method="post" action="{{ route('thread.create') }}">
            @csrf
            <!-- ジャンル選択 -->
            <div class="flex flex-col mb-4">
                <label for="genre_id" class="font-medium">ジャンル</label>
                <x-input-error :messages="$errors->get('genre_id')"/>
                <select class="w-40 rounded-md" name="genre_id">
                    <option hidden>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- スレッドタイトル入力 -->
            <div class="flex flex-col mb-4">
                <label for="title" class="font-medium">タイトル</label>
                <x-input-error :messages="$errors->get('title')"/>
                <textarea class="rounded-md" name="title" id="title" cols="50" rows="3">{{ old('title') }}</textarea>
                <div id="charCount">文字数: 0</div>
            </div>

            <div>
                <x-primary-button>
                    作成
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        // インプットの要素を取得
        const input = document.getElementById('title');
        // 文字数表示用の要素を取得
        const charCount = document.getElementById('charCount');

        // 文字数を更新する関数
        function updateCharCount() {
            const textLength = input.value.length;
            charCount.textContent = '文字数: ' + textLength;
        }

        // ページロード時に文字数を表示
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount();
        });
    
        // インプットの入力を監視
        input.addEventListener('input', updateCharCount);
    </script>
</x-app-layout>