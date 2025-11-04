<form method="POST" action="{{ $route }}">
    @csrf
    @method("DELETE")
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="underline">
        {{ $text }}
    </a>
</form>