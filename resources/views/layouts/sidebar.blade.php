<div class="layout-main">
    <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
            <div class="custom-scrollbar">
                <nav id="sidenav" class="sidenav-collapse collapse">
                    <ul class="sidenav level-1">
                        <li class="sidenav-search">
                            <form class="sidenav-form" action="">
                                <div class="form-group form-group-sm">
                                    @if(Session::get('count') == 1)
                                        <div class="input-with-icon">
                                            <input class="form-control" type="text" placeholder="Search…">
                                            <span class="icon icon-search input-icon"></span>
                                        </div>
                                    @else
                                        <select name="" id="level" class="form-control" style="color: #fff">
                                            @foreach(App\Models\ChooseRoleModel::with('role')->where('id_karyawan', Session::get('id_users'))->get() as $r)
                                                @if(!empty(Session::get('id_role')) && Session::get('id_role') == $r->id)
                                                    <option value="{{ $r->id_user_level }}"
                                                            selected>{{ $r->role->nama_level }}</option>
                                                @else
                                                    <option value="{{ $r->id_user_level }}">{{ $r->role->nama_level }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </form>
                        </li>
                        <li class="sidenav-heading">Navigation</li>
                        {{ sidebar() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- content --}}
    @yield('content')

    <div class="layout-footer">
        <div class="layout-footer-body">
            <small class="version"> Version {{ versionApp() }}</small>
            <small class="copyright">{{ \Carbon\Carbon::now()->format('Y') }} &copy; Failda Waterpark <a
                        href="https://laravel.com" target="_blank">Powered By Laravel 5.7</a></small>
        </div>
    </div>
</div>