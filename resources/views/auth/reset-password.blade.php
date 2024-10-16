<x-layout>
    <h1 class="title">Reset your password</h1>

    <div class="mx-auto max-w-md card">
        <form method="post" action="{{route('password.update')}}">
            @csrf

            <input type="hidden" name="token" value="{{$token}}">

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
            <div class="mb-4">
                <label  for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="input
                @error('password') ring-red-500 @enderror">
            </div>

            <button class="primary-btn">Reset password</button>
        </form>
    </div>

</x-layout>
