<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">TAXI</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
      
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                @if (auth()->check() && auth()->guard('web')->check())
                    <div class="menu-title">Customer</div>
                @else
                    <div class="menu-title">Driver</div>
                @endif
            </a>
            <ul>
                {{-- @role('Admin')
                <li> <a href="{{route('admin.create.roles')}}"><i class='bx bx-radio-circle'></i>Create Roles</a></li>
                <li> <a href="{{route('admin.index')}}"><i class='bx bx-radio-circle'></i>All Roles</a></li>
                    <li> <a href="{{route('admin.create')}}"><i class='bx bx-radio-circle'></i>Create User</a></li>
                @else
                @endrole --}}
            </ul>
            <ul>
                {{-- @role("User")
                @can('create')
                    <li> <a href="{{route('user.create')}}"><i class='bx bx-radio-circle'></i>Create Post</a></li>
                @endcan
                @can('Update')
                    <li> <a href="{{route('user.index')}}"><i class='bx bx-radio-circle'></i>All Posts</a></li>
                @endcan
                @can('Delete')
                    <li> <a href="{{route('user.restores')}}"><i class='bx bx-radio-circle'></i>Restore Post</a></li>
                @endcan
                @endrole --}}
                @if (auth()->check() && auth()->guard('web')->check())
                    <li> <a href="{{route('users.index')}}"><i class='bx bx-radio-circle'></i>Dashboard</a></li>
                    <li> <a href="{{route('users.profile')}}"><i class='bx bx-radio-circle'></i>Profile Update</a></li>
                    <li> <a href="{{route('users.rides')}}"><i class='bx bx-radio-circle'></i>Make Rides</a></li>
                    <li> <a href="{{route('users.report')}}"><i class='bx bx-radio-circle'></i>Reports</a></li>
                
                @else
                    <li> <a href="{{route('drivers.index')}}"><i class='bx bx-radio-circle'></i>Dashboard</a></li>
                    <li> <a href="{{route('drivers.profile')}}"><i class='bx bx-radio-circle'></i>Profile Update</a></li>
                    <li> <a href="{{route('drivers.ride')}}"><i class='bx bx-radio-circle'></i>Rides </a></li>
                    <li> <a href="{{route('drivers.report')}}"><i class='bx bx-radio-circle'></i>Reports</a></li>
                @endif

            </ul>
        </li>
    </ul>
</div>