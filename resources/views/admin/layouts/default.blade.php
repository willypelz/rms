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
    @include('admin.elements.head-content')
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
    
    @include('admin.elements.page-loader')
    
    <!-- @App Content -->
    <!-- =================================================== -->
    <div>
    @include('admin.elements.sidebar')
    
    <!-- #Main ============================ -->
        <div class="page-container">
        
        @include('admin.elements.topbar')
        
            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="full-container">
                        
                        @yield('content')
                    
                    </div>
                </div>
            </main>
            
            @include('admin.elements.footer')
        </div>
    </div>
    <script src="{{ secure_asset('admin/vendor.js') }}"></script>
    <script src="{{ secure_asset('admin/bundle.js') }}"></script>
</body>
</html>
