@include('dashboard.layout.head')
<!-- Navbar-->
@include('dashboard.layout.nav')
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
@include('dashboard.layout.sidebar')

<!-- app-content-->
<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="bi bi-speedometer"></i> @yield('title','Dashboard')</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            @yield('breadcrumb')
        </ul>
    </div>

    @yield('content')
</main>


<!-- Essential javascripts for application to work-->
@include('dashboard.layout.footer')
