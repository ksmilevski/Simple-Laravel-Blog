<x-layout>
    <h1 class="title">Login to your account</h1>
    @if(session('status'))
        <div class="mb-2">
            <x-flashMsg msg="{{session('status')}}"/>
        </div>
    @endif
    <div class="mx-auto max-w-md card">
        <form method="post" action="{{ route('login') }}">
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
            <div class="mb-4">
                <label  for="password">Password</label>
                <input type="password" name="password" class="input
                @error('password') ring-red-500 @enderror" >
                @error('password')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-4 flex justify-between items-center">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="inline">Remember me</label>
                </div>

                <a class="text-blue-500" href="{{ route('password.request') }}">Forgot password</a>
            </div>

            @error('failed')
            <p class="error" >{{$message}}</p>
            @enderror

            <button class="primary-btn">Log in</button>
        </form>
    </div>

</x-layout>
