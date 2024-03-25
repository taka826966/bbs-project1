<x-app-layout>
    thread_edit
    <div>
        <!-- スレッド編集フォーム -->
        <form method="post" action="{{ route('update',  $thread) }}">
            @csrf
            @method('patch')
            <!-- ジャンル選択 -->
            <div>
                <label for="genre">ジャンル</label>
                <select class="text-black" name="genre_id">
                    <option hidden>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- スレッドタイトル入力 -->
            <div>
                <label for="title">タイトル</label>
                <input type="text" class="text-black" name="title" value="{{old('title', $thread->title)}}">
            </div>

            <x-primary-button>
                編集
            </x-primary-button>
        </form>
    </div>
</x-app-layout>