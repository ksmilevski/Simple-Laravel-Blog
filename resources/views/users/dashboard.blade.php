<x-layout>
    <!-- Greeting Section -->
    <h1 class="title">Hello {{ auth()->user()->username }}</h1>

    <!-- Create Post Card -->
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        <!-- Flash Messages for Success and Deletion -->
        @if(session('success'))
            <div class="mb-2">
                <x-flashMsg msg="{{session('success')}}"/>
            </div>
        @elseif(session('delete'))
            <div class="mb-2">
                <x-flashMsg :msg="session('delete')" :bg="'bg-red-500'" />
            </div>
        @endif

        <!-- Form to Create a New Post -->
        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="input"
                       value="{{ old('title') }}">
                @error('title')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body">Post Body</label>
                <textarea name="body" rows="5" class="input">{{ old('body') }}</textarea>
                @error('body')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">
                @error('image')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Submit Button for Creating a Post -->
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Create
            </button>
        </form>
    </div>

    <!-- Display User's Posts -->
    <h2 class="font-bold mb-4">Your Latest Posts</h2>
    <div class="max-w-none w-full mx-auto">
        <div class="grid grid-cols-2 gap-6">
            @foreach($posts as $post)
                <!-- Post Card -->
                <x-postCard :post="$post">
                    <!-- Update and Delete Buttons (aligned in the same row) -->
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white text-xs rounded-md px-2 py-1 h-6">Update</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs rounded-md px-2 py-1 h-6">
                                Delete
                            </button>
                        </form>
                    </div>
                </x-postCard>
            @endforeach
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="flex items-center justify-end gap-4 mt-6">
        {{$posts->links()}}
    </div>
</x-layout>
