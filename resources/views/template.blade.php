@include('includes.head')

    <body class="sb-nav-fixed">

        @include('includes.topbar')

        <div id="layoutSidenav">

            @include('includes.sidenav')


            <div id="layoutSidenav_content">

                <main>

                    <div class="container-fluid px-4">


                        @yield('content')


                    </div>

                </main>

            </div>
        </div>

@include('includes.scripts')
