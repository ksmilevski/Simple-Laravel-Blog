@props(['post', 'full' => false])
<div class="card w-full mb-6 p-8 bg-white rounded-lg shadow-lg">
    <div>
        @if($post->image)
            <img src="{{asset('storage/' . $post->image)}}" >
        @else
            <img src="{{asset('storage/posts_images/default.jpg')}}">
        @endif
    </div>

    <h2 class="font-bold text-xl">{{ $post->title }}</h2>

    <div class="text-xs font-light mb-4">
        <span>Posted {{$post->created_at->diffForHumans()}} by</span>
        <a href="{{route('posts.user',@$post->user)}}" class="text-blue-500 font-medium">
            {{ $post->user->username }}
        </a>
    </div>

    <div class="text-sm">
        @if($full)
            <span>{{$post->body}}</span>
        @else
            <span>{{ Str::words($post->body, 15) }}</span>
            <a href="{{route('posts.show',@$post->user)}}" class="text-blue-500 font-medium">
                Read more
            </a>
        @endif
    </div>

    <div>
        {{$slot}}
    </div>
</div>
