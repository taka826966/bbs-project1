<x-app-layout>
    thread_creation
    <div>
        <form method="post" action="{{ route('thread.create') }}">
            @csrf
            <div>
                <label for="genre_id">ジャンル</label>
                <select class="text-black" name="genre_id">
                    <option hidden>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title">タイトル</label>
                <input type="text" class="text-black" name="title">
            </div>

            <x-primary-button>
                作成
            </x-primary-button>
        </form>
    </div>
</x-app-layout>