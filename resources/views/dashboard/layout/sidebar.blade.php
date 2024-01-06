<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">John Doe</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">

        <li>
            <a class="app-menu__item {{request()->is("*roles*") ?'active':''}}"
               href="{{route('admin.roles.index')}}">
                <i class="app-menu__icon bi bi-lock"></i>
                <span class="app-menu__label">
                    Roles
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item  {{request()->is("*admins*") ?'active':''}}"
               href="{{route('admin.admins.index')}}">
                <i class="app-menu__icon bi bi-person-gear"></i>
                <span class="app-menu__label">
                    Admins
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item  {{request()->is("*users*") ?'active':''}}"
               href="{{route('admin.users.index')}}">
                <i class="app-menu__icon bi bi-person"></i>
                <span class="app-menu__label">
                    Users
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item  {{request()->is("*genres*") ?'active':''}}"
               href="{{route('admin.genres.index')}}">
                <i class="app-menu__icon bi bi-list"></i>
                <span class="app-menu__label">
                    Genres
                </span>
            </a>
        </li>
            {{-- Settings  --}}
        <li class="treeview">
            <a class="app-menu__item {{request()->is("*settings*") ?'active':''}}" href="#" data-toggle="treeview">
                <i class="app-menu__icon bi bi-gear"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item  {{request()->is("*general*") ?'active':''}}"
                       href="{{route('admin.settings.general')}}">
                        <i class="app-menu__icon bi bi-circle"></i>
                        <span class="app-menu__label">
                        General
                </span>
                    </a>
                </li>

            </ul>
        </li>

        {{-- Profile  --}}
        <li class="treeview">
            <a class="app-menu__item {{request()->is("*profile*") ?'active':''}}" href="#" data-toggle="treeview">
                <i class="app-menu__icon bi bi-person-circle"></i><span class="app-menu__label">Profile</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item"
                       href="{{route('admin.profile.edit')}}">
                        <i class="app-menu__icon bi bi-circle"></i>
                        <span class="app-menu__label">
                            Update Profile
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item "
                       href="{{route('admin.password.edit')}}">
                        <i class="app-menu__icon bi bi-circle"></i>
                        <span class="app-menu__label">
                            Change Password
                        </span>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</aside>
