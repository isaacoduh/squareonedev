<nav>
    <ul>
        <li>
            <a class="@yield('ActiveHome')" href="/">
                <i class="fa-li fa  fa-lg"></i><span>Home</span>
            </a>
        </li>
        {{-- <li>
            <a class="@yield('ActiveArchive')" href="/archive">
                <i class="fa-li fa  fa-lg"></i><span>Archive</span>
            </a>
        </li>
        <li>
            <a class="@yield('ActiveProjects')" href="/projects">
                <i class="fa-li fa  fa-lg"></i><span>Projects</span>
            </a>
        </li>
        <li>
            <a class="@yield('ActiveAbout')" href="/about">
                <i class="fa-li fa  fa-lg"></i><span>About Me</span>
            </a>
        </li> --}}
        <li>
            @auth
            @if (Auth::user()->isAdmin)
            <a class="@yield('ActiveAllPosts')" href="/admin/posts">
                <i class="fa-li fa  fa-lg"></i><span>Manage All Posts</span>
            </a>
            @else
            <a class="@yield('ActiveMyPosts')" href="/user/posts">
                <i class="fa-li fa  fa-lg"></i><span>My Posts</span>
            </a>
            @endif
            @endauth

        </li>
        {{-- <li>
            <a class="@yield('ActiveContact')" href="/contact">
                <i class="fa-li fa  fa-lg"></i><span>Contact</span>
            </a>
        </li> --}}
        @if (Auth::check())
        <li>
            <form id="logoutForm" action="{{route('logout')}}" method="POST"  value="Logout">
                {{ csrf_field() }}
                <button type="submit" class=""><i class="fa fa-power-off fa-sm" aria-hidden="true"></i></button>
            </form>
        </li>
        @else
        <li>
            <a class="" href="{{route('login')}}"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></a>
        </li>
        @endif

    </ul>
</nav>
