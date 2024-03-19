<x-app-layout>
    read
    <div class="bg-white text-black">
        <h1 class="text-lg font-semibold">{{ $thread->title }}</h1>
        <p>{{ $thread->user->name}} / {{ $thread->created_at}}</p>
        @auth
        @if(auth()->id() == $thread->user_id || auth()->user()->role == 'admin')
        <div>
            <a href="{{route('thread_edit', $thread)}}">
                <x-primary-button>
                    編集
                </x-primary-button>
            </a>
        </div>
        @endif
        @endauth
    </div>
    <div>
        @foreach($posts as $number=>$post)
        <h2 class="text-lg font-semibold">{{$number+1}}</h2>
        <p>{{$post->user->name}} / {{$post->created_at}}</p>
        <p>{{$post->comment}}</p>
        @auth
        @if(auth()->id() == $post->user_id || auth()->user()->role == 'admin')
        <form method="post" action="{{route('delete', $post)}}">
            @csrf
            @method('delete')
            <x-primary-button class="bg-red-700">
                削除
            </x-primary-button>
        </form>
        @endif
        @endauth
        @endforeach
    </div>
    <div>
        <a href="{{route('post_creation', $thread)}}">
            <x-primary-button>
                コメントを投稿
            </x-primary-button>
        </a>
    </div>
</x-app-layout>