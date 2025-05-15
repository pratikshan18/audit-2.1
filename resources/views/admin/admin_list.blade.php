<div>Admin List</div>
@if(session()->has('user'))
    <h2>Welcome, {{ session('user')->user_name }}</h2>
    <a href="{{ route('logout') }}">Logout</a>
@endif
