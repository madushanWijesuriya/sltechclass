<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column sidebar" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
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
                <a href="/" class="nav-link">
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
    var tag = $('ul.sidebar li.nav-item a').filter(function () {
        return this.href === url.href;
    }).addClass('active');
    // for treeview
    // $('ul.treeview-menu a').filter(function() {
    //     return this.href == url.href;
    // }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>
