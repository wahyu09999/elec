<h1>HALLOOO</h1>

<a href={{ route('logout') }}"
onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
{{ __('Logout') }}</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>