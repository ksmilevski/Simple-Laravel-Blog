<h1>You successfully posted a post!</h1>

<div>
    <h2>Title: {{$post->title}}</h2>
    <p>{{ $post->body }}</p>
    @if($post->image)
        <img width="300" src="{{$message->embed('storage/' . $post->image)}}" alt="">
    @endif
</div>
