
<x-layout>
    <a href="{{route('dashboard')}}" class="block mb-2 text-xs text-blue-500">
        Back</a>
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Edit post</h2>

        <!-- Form to Edit a Post -->
        <form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="input"
                       value="{{ $post->title }}">
                @error('title')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body">Post Body</label>
                <textarea name="body" rows="5" class="input">{{ $post->body }}</textarea>
                @error('body')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            @if($post->image)

            <div class="h-64 rounded-md mb-4 object-cover overflow-hidden w-1/4">
                    <label for="">Current cover photo</label>
                    <img src="{{asset('storage/' . $post->image)}}" >
            </div>
            @endif

            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">
                @error('image')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <!-- Submit Button for Creating a Post -->
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </form>
    </div>

</x-layout>
