<a href="{{ route('users.show', $user->id) }}">
    {{--<img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/>--}}
    <img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=1817437008,358954507&fm=26&gp=0.jpg" alt="{{ $user->name }}" class="gravatar"/>
</a>
<h1>{{ $user->name }}
<br />
    {{--{{$user->hyh("44444")}}--}}

</h1>