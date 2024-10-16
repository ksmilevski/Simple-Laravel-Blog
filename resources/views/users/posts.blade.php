
<x-layout>
    <h1 class="title">{{$user->username}}'s posts ({{$posts->total()}})</h1>
    <div class="max-w-none w-full mx-auto">
        <div class="grid grid-cols-2 gap-6">
            @foreach($posts as $post)
                <x-postCard :post="$post"/>
            @endforeach
        </div>
    </div>
    <div>
        {{$posts->links()}}
    </div>


</x-layout>
