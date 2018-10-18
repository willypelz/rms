<?php
/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-10-16
 */
?>

<!-- #Left Sidebar ==================== -->
<div class="sidebar">
    <div class="sidebar-inner">

        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">

                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="#">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    {{--
                                        <img src="assets/static/images/logo.png" alt="">
                                    --}}
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">SeamlessHR</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.elements.sidebar-menu')
    </div>
</div>
