<div class="navbar bg-base-100">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li>
                    <a href="{{ route('pages.home') }}" class="text-lg">Homepage</a>
                </li>
                <li><a href="{{ route('booking.list') }}" class="text-lg">Booking List</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a href="{{ route('pages.home') }}" class="btn btn-ghost text-xl"><img src="{{ asset('icon/bluedoorz.png') }}"
                alt="logo" width="200"></a>
    </div>
    <div class="navbar-end">
        <div class="form-control mr-5">
            <form action="">
                <input type="text" placeholder="Search" name="search" value="{{ request('search') }}"
                    class="input input-bordered w-[400px] h-8" autocomplete="off" />
            </form>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                @if (auth()->check())
                    @if (auth()->user()->image === null)
                        <div class="w-10 rounded-full">
                            <img alt="Profile Image" src="{{ asset('icon/unknown.jpg') }}" />
                        </div>
                    @else
                        <div class="w-10 rounded-full">
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Image">
                        </div>
                    @endif
                @else
                    <div class="w-10 rounded-full">
                        <img alt="Profile Image" src="{{ asset('icon/unknown.jpg') }}" />
                    </div>
                @endif

            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                @auth
                    <li>
                        <a href="{{ route('profile.edit') }}" class="justify-between">Profile
                            <span
                                class="badge badge-netural">{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', explode(' ', auth()->user()->name)[0]))) }}</span></a>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full h-full block">
                            @csrf
                            <button type="submit" class="w-full h-full block text-left">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>
