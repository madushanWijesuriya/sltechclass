<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        @if(\Illuminate\Support\Facades\Auth::user()->type === "admin")
        <ul class="nav nav-pills nav-sidebar flex-column sidebar" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Class
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('class.create')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Create New Class</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('class.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All Classes</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-alt"></i>
                    <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('group.create')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Create User Group</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('student.create')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Create New User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('student.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('group.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All User Groups</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-percentage"></i>
                    <p>
                        Coupon
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('coupon.create')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Create New Coupon</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('coupon.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All Coupons</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-message"></i>
                    <p>
                        Announcements
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('announcement.create')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Create New Announcements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('announcement.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All Announcements</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-dollar-sign"></i>
                    <p>
                        Payments
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('payment.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Pending Payments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('announcement.index')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>All Announcements</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Settings
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('class.getClassSetting')}}" class="nav-link">
                            <i class="far fa nav-icon"></i>
                            <p>Class Access</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        @else
            <ul class="nav nav-pills nav-sidebar flex-column sidebar" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item tree">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            My Class
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>Create New Class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('class.index')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>All Classes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item tree">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Payments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('group.create')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>Create User Group</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.create')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>Create New User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.index')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('group.index')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>All User Groups</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item tree">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>
                            Announcement
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('coupon.create')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>Create New Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('coupon.index')}}" class="nav-link">
                                <i class="far fa nav-icon"></i>
                                <p>All Coupons</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

<script>
    /** add active class and stay opened when selected */
    var url = window.location;
    var i = 0;
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar li.nav-item a').filter(function () {
        return this.href === url.href;
    }).addClass('active');
    // for treeview
    var tag =$('ul.sidebar li.nav-item ul.nav-treeview a').filter(function() {
        return this.href === url.href;
    }).parentsUntil().addClass('active');

</script>

<style>
    [class*=sidebar-light-] .nav-treeview > .nav-item > .nav-link.active, [class*=sidebar-light-] .nav-treeview > .nav-item > .nav-link.active:hover {
        background-color: #ff7700;
        color: #212529;
    }
</style>
