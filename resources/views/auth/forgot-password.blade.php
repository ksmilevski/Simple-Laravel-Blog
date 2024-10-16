<x-layout>
    <h1 class="title">Reset your password</h1>
    @if(session('status'))
        <div class="mb-2">
            <x-flashMsg msg="{{session('status')}}"/>
        </div>
    @endif
    <div class="mx-auto max-w-md card">
        <form method="post" action="{{route('password.request')}}">
            @csrf
            <div class="mb-4">
                <label  for="email">Email</label>
                <input type="text" name="email" class="input
                @error('email') ring-red-500 @enderror"
                       value="{{ old('email') }}">
                @error('email')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <button class="primary-btn">Send reset mail</button>
        </form>
    </div>

</x-layout>
