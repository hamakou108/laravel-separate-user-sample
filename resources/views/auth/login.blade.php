<section>
    @if ($errors->any())
        <div>
            <div class="font-medium text-red-600">
                {{ __('Whoops! Something went wrong.') }}
            </div>

            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">Email: </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div>
            <label for="password">Password: </label>
            <input id="password" type="password" name="password" value="{{ old('password') }}" />
        </div>
        <div>
            <input type="submit" value="Login" />
        </div>
    </form>
</section>
