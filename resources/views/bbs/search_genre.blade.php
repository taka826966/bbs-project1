<x-app-layout>
    search_genre
    <div>
        <form method="get" action="{{ route('search.genre') }}">
            @csrf
            <div>
                <select class="text-black" name="select">
                    <option hidden>選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}" {{ $genre->id == request('select') ? 'selected' : '' }}>{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <x-primary-button>
                検索
            </x-primary-button>
        </form>
    </div>    

    <hr>

    @if($selectedGenre)
        <h2>ジャンル：{{ $selectedGenre->name }}の検索結果</h2>
    @endif

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
</x-app-layout>