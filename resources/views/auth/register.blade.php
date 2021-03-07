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
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" />
        </div>
        <div>
            <label for="email">Email: </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div>
            <label for="password">Password: </label>
            <input id="password" type="password" name="password" value="{{ old('password') }}" />
        </div>
        <div>
            <label for="password_confirmation">Password: </label>
            <input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" />
        </div>
        <div>
            <input type="submit" value="Register" />
        </div>
    </form>
</section>
