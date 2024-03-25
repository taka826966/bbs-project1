<x-app-layout>
    post_creation
    <div>
        <!-- コメント作成フォーム -->
        <form method="post" action="{{ route('post.create', $thread) }}">
            @csrf
            <!-- コメント内容入力 -->
            <div>
                <label for="comment">コメント</label>
                <textarea name="comment" class="text-black" id="comment" cols="30" rows="10"></textarea>
            </div>

            <x-primary-button>
                投稿
            </x-primary-button>
        </form>
    </div>
</x-app-layout>