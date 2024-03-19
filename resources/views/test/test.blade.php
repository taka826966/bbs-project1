<x-app-layout>
    test1212
    <div>
        <form method="get" action="{{ route('test.index') }}">
            @csrf
            <div>
                <input type="text" class="text-black" name="keyword" value="{{ old('keyword', $keyword) }}">
            </div>

            <x-primary-button name="keyword-button">
                検索
            </x-primary-button>

            <div>
                <select class="text-black" name="genreselect">
                    <option>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <x-primary-button name="genre-button">
                検索
            </x-primary-button>

            <table>
                @foreach($threads as $thread)
                    <tr>
                        <td>{{$thread->title}}</td>
                    </tr>
                @endforeach
            </table>
        </form>
    </div>
</x-app-layout>