<x-layout>
    <p>Please verify your email</p>

    <form action="{{route('verification.send')}}" method="post" >
        @csrf
        <button class="btn" type="submit">Send again</button>

    </form>
</x-layout>
