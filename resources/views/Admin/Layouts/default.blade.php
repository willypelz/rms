<?php
/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-10-04
 */
?>
        <!DOCTYPE html>
<html>
<head>
    @include('Admin.Elements.headContent')
</head>
<body class="app">
    <!-- @TOC -->
    <!-- =================================================== -->
    <!--
      + @Page Loader
      + @App Content
          - #Left Sidebar
              > $Sidebar Header
              > $Sidebar Menu

          - #Main
              > $Topbar
              > $App Screen Content
    -->
    
    @include('Admin.Elements.pageLoader')
    
    <!-- @App Content -->
    <!-- =================================================== -->
    <div>
    @include('Admin.Elements.sidebar')
    
    <!-- #Main ============================ -->
        <div class="page-container">
        
        @include('Admin.Elements.topbar')
        
            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="full-container">
                        
                        @yield('content')
                    
                    </div>
                </div>
            </main>
            
            @include('Admin.Elements.footer')
        </div>
    </div>
    <script src="{{ secure_asset('admin/vendor.js') }}"></script>
    <script src="{{ secure_asset('admin/bundle.js') }}"></script>
</body>
</html>
