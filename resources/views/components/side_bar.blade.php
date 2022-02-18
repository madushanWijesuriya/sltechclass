<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column sidebar" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item tree">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Class
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('class.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create New Class</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('class.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Classes</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                {{--                <a href="" class="nav-link">--}}
                <a href="{{route('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('class.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        View Rentals
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/ssssssss" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        Add Rentals
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/aaaaaaaaaa" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Customers
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/asas" class="nav-link">
                    <i class="nav-icon fas fa-tshirt"></i>
                    <p>
                        Coats
                    </p>
                </a>
            </li>

        </ul>
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

    console.log(tag)
</script>

<style>
    [class*=sidebar-light-] .nav-treeview > .nav-item > .nav-link.active, [class*=sidebar-light-] .nav-treeview > .nav-item > .nav-link.active:hover {
        background-color: #ff7700;
        color: #212529;
    }
</style>
