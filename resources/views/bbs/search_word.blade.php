<x-app-layout>
    search
    <div>
        <form method="get" action="{{ route('search.word') }}">
            @csrf
            <div>
                <input type="text" class="text-black" name="word" value="{{ old('word', $word) }}">
            </div>
            
            <x-primary-button>
                検索
            </x-primary-button>
        </form>
    </div>

    <hr>

    @if($threads->isNotEmpty())
        @if(!empty($word))
            <p>ワード：{{ $word }} の検索結果</p>
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
    @else
        @if(!empty($word))
            <p>ワード：{{ $word }} に一致するスレッドは見つかりませんでした。</p>
        @endif
    @endif
</x-app-layout>