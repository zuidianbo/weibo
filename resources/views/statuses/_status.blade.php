<li class="media mt-4 mb-4">
    <a href="{{ route('users.show', $user->id )}}">
        {{--<img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar"/> --}}
        <img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=1817437008,358954507&fm=26&gp=0.jpg" alt="{{ $user->name }}" class="mr-3 gravatar"/>
    </a>
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $user->name }} <small> / {{ $status->created_at->diffForHumans() }}</small></h5>
        {{ $status->content }}
    </div>


    {{--删除按钮--}}

    @can('destroy1', $status)
        <form action="{{ route('statuses.destroy1', $status->id) }}" method="POST"  onsubmit="return confirm('您确定要删除本条微博吗？');">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger">删除</button>
        </form>
    @endcan


</li>