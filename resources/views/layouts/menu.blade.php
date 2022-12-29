<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home text-orange"></i>
        <p>Home</p>
    </a>
</li>
@can('student_access')

@endcan
@can('teacher_access')

@endcan
@can('parent_access')

@endcan
@can('admin_access')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user text-lime"></i>
            <p>Users</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book text-purple"></i>
            <p>Subjects</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('groups.index') }}" class="nav-link {{ Request::is('groups*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users text-info"></i>
            <p>Groups</p>
        </a>
    </li>
@endcan
