<x-layout>
    <h1 class="title">Register a new account</h1>

    <div class="mx-auto max-w-md card">
        <form method="post" action="{{ route('register') }}"  x-data="formSubmit" @submit.prevent="submit">
            @csrf
            <div class="mb-4">
                <label  for="username">Username</label>
                <input type="text" name="username" class="input
                @error('username') ring-red-500 @enderror"
                value="{{ old('username') }}">
                @error('username')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
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
            <div class="mb-4">
                <input type="checkbox" name="subscribe" id="subscribe">
                <label for="subscribe" class="inline">Subscribe</label>
            </div>
            <button  x-ref="btn" class="primary-btn">Register</button>
        </form>
    </div>

</x-layout>
