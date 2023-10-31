<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                @if (get_setting('system_logo_white') != null)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}"
                        class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else
                    <img class="mw-100" src="{{ static_asset('assets/img/logo-white.png') }}"
                        class="brand-icon" alt="{{ get_setting('site_name') }}">
                @endif
            </a>
        </div>

        
        <div class="aiz-side-nav-wrap">
            <ul class="aiz-side-nav-list" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path id="Path_18917" data-name="Path 18917"
                                d="M3.889,11.889H9.222A.892.892,0,0,0,10.111,11V3.889A.892.892,0,0,0,9.222,3H3.889A.892.892,0,0,0,3,3.889V11A.892.892,0,0,0,3.889,11.889Zm0,7.111H9.222a.892.892,0,0,0,.889-.889V14.556a.892.892,0,0,0-.889-.889H3.889A.892.892,0,0,0,3,14.556v3.556A.892.892,0,0,0,3.889,19Zm8.889,0h5.333A.892.892,0,0,0,19,18.111V11a.892.892,0,0,0-.889-.889H12.778a.892.892,0,0,0-.889.889v7.111A.892.892,0,0,0,12.778,19ZM11.889,3.889V7.444a.892.892,0,0,0,.889.889h5.333A.892.892,0,0,0,19,7.444V3.889A.892.892,0,0,0,18.111,3H12.778A.892.892,0,0,0,11.889,3.889Z"
                                transform="translate(-3 -3)" fill="#707070" />
                        </svg>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>
                @canany(['pos_manager','pos_configuration'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg id="Group_22661" data-name="Group 22661" xmlns="http://www.w3.org/2000/svg" width="16" height="18.563" viewBox="0 0 16 18.563">
                                <path id="Path_10" data-name="Path 10" d="M12.041,7H3.42A1.189,1.189,0,0,0,2.26,8.16V20.285A1.2,1.2,0,0,0,3.42,21.5h8.621a1.2,1.2,0,0,0,1.2-1.2V8.16A1.189,1.189,0,0,0,12.041,7ZM5.369,19.6h-1.1V18.5h1.1Zm0-2.732h-1.1v-1.1h1.1Zm0-2.732h-1.1v-1.1h1.1ZM8.27,19.6H7.179V18.5H8.287Zm0-2.732H7.179v-1.1H8.287Zm0-2.732H7.179v-1.1H8.287Zm2.9,5.465h-1.1V18.5h1.1Zm0-2.732h-1.1v-1.1h1.1Zm0-2.732h-1.1v-1.1h1.1Zm.377-3.481a.2.2,0,0,1-.191.2H4.087a.2.2,0,0,1-.191-.2V9.083a.191.191,0,0,1,.191-.191h7.3a.191.191,0,0,1,.191.191Zm5.906-1.682h-.261V19.519h.29a.777.777,0,0,0,.777-.777V9.756a.777.777,0,0,0-.806-.783Z" transform="translate(-2.26 -2.939)" fill="#707070"/>
                                <rect id="Rectangle_10" data-name="Rectangle 10" width="1.7" height="10.552" transform="translate(11.516 6.033)" fill="#707070"/>
                                <rect id="Rectangle_11" data-name="Rectangle 11" width="0.731" height="10.552" transform="translate(13.691 6.033)" fill="#707070"/>
                                <path id="Path_11" data-name="Path 11" d="M14.971,1.038a1.033,1.033,0,0,0-.3-.737,1.056,1.056,0,0,0-.737-.3,1.038,1.038,0,0,0-1.056,1.038v.615h2.077Zm-2.553,0a.882.882,0,0,1,0-.168.789.789,0,0,1,0-.122h.012A.58.58,0,0,1,12.488.58a.5.5,0,0,1,.041-.116,1.387,1.387,0,0,1,.168-.3A.58.58,0,0,1,12.743.1l.081-.1h-4.7A.946.946,0,0,0,7.18.94V3.515H12.4Z" transform="translate(-4.326 0)" fill="#707070"/>
                            </svg>
                            <span class="aiz-side-nav-text">{{translate('POS System')}}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('pos_manager')
                                <li class="aiz-side-nav-item">
                                    <a href="{{route('point-of-sales.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['point-of-sales.index', 'point-of-sales.create'])}}">
                                        <span class="aiz-side-nav-text">{{translate('POS Manager')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @if (addon_is_activated('multi_vendor'))
                                @can('pos_configuration')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{route('point-of-sales.activation')}}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{translate('POS Configuration')}}</span>
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </li>
                @endcan

                <!-- Product -->
                @canany(['show_products','show_seller_products','show_categories','show_brands','show_attributes','show_reviews','product_bulk_import','product_bulk_export'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g id="Group_23" data-name="Group 23" transform="translate(-126 -590)">
                                    <path id="Subtraction_31" data-name="Subtraction 31"
                                        d="M15,16H1a1,1,0,0,1-1-1V1A1,1,0,0,1,1,0H4.8V4.4a2,2,0,0,0,2,2H9.2a2,2,0,0,0,2-2V0H15a1,1,0,0,1,1,1V15A1,1,0,0,1,15,16Z"
                                        transform="translate(126 590)" fill="#707070" />
                                    <path id="Rectangle_93" data-name="Rectangle 93"
                                        d="M0,0H4A0,0,0,0,1,4,0V4A1,1,0,0,1,3,5H1A1,1,0,0,1,0,4V0A0,0,0,0,1,0,0Z"
                                        transform="translate(132 590)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Product') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            @can('show_products')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('product.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['product.index', 'product.create', 'product.edit', 'product_bulk_upload.index']) }}">
                                        <span class="aiz-side-nav-text">
                                            {{ addon_is_activated('multi_vendor') ? translate('Inhouse Products') : translate('Products') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @if (addon_is_activated('multi_vendor'))
                                @can('show_seller_products')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.seller_products.index') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Seller Products') }}</span>
                                            @if (env('DEMO_MODE') == 'On')
                                                <span class="badge badge-inline badge-danger">Addon</span>
                                            @endif
                                        </a>
                                    </li>
                                @endcan
                            @endif
                            @can('show_digital_products')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('digitalproducts.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['digitalproducts.index', 'digitalproducts.create', 'digitalproducts.edit']) }}">
                                        <span class="aiz-side-nav-text">
                                            {{  translate('Digital Products') }}
                                        </span>
                                    </a>
                                </li>                                    
                            @endcan
                            @can('show_categories')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('categories.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['categories.index', 'categories.create', 'categories.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Category') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_brands')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('brands.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['brands.index', 'brands.create', 'brands.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Brand') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_attributes')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('attributes.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['attributes.index', 'attributes.edit', 'attributes.show', 'attribute_values.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Attributes') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_reviews')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('reviews.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Reviews') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('product_bulk_import')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('product_bulk_upload.index') }}" class="aiz-side-nav-link" >
                                        <span class="aiz-side-nav-text">{{ translate('Bulk Import') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('product_bulk_export')
                                <li class="aiz-side-nav-item">
                                    <a href="{{route('product_bulk_export.index')}}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{translate('Bulk Export')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Order -->
                @if (addon_is_activated('multi_vendor') && (auth()->user()->can('show_orders') || auth()->user()->can('show_seller_orders')))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path id="Subtraction_32" data-name="Subtraction 32"
                                    d="M15,16H1a1,1,0,0,1-1-1V1A1,1,0,0,1,1,0H15a1,1,0,0,1,1,1V15A1,1,0,0,1,15,16ZM7,11a1,1,0,1,0,0,2h6a1,1,0,0,0,0-2ZM3,11a1,1,0,1,0,1,1A1,1,0,0,0,3,11ZM7,7A1,1,0,1,0,7,9h6a1,1,0,0,0,0-2ZM3,7A1,1,0,1,0,4,8,1,1,0,0,0,3,7ZM7,3A1,1,0,1,0,7,5h6a1,1,0,0,0,0-2ZM3,3A1,1,0,1,0,4,4,1,1,0,0,0,3,3Z"
                                    fill="#707070" />
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Orders') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('show_orders')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('orders.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['orders.index', 'orders.show']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Inhouse Orders') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_seller_orders')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('admin.seller_orders.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Seller Orders') }}</span>
                                        @if (env('DEMO_MODE') == 'On')
                                            <span class="badge badge-inline badge-danger">Addon</span>
                                        @endif
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @elseif(auth()->user()->can('show_orders'))
                    @can('show_orders')
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('orders.index') }}"
                                class="aiz-side-nav-link {{ areActiveRoutes(['orders.index', 'orders.show']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path id="Subtraction_32" data-name="Subtraction 32"
                                        d="M15,16H1a1,1,0,0,1-1-1V1A1,1,0,0,1,1,0H15a1,1,0,0,1,1,1V15A1,1,0,0,1,15,16ZM7,11a1,1,0,1,0,0,2h6a1,1,0,0,0,0-2ZM3,11a1,1,0,1,0,1,1A1,1,0,0,0,3,11ZM7,7A1,1,0,1,0,7,9h6a1,1,0,0,0,0-2ZM3,7A1,1,0,1,0,4,8,1,1,0,0,0,3,7ZM7,3A1,1,0,1,0,7,5h6a1,1,0,0,0,0-2ZM3,3A1,1,0,1,0,4,4,1,1,0,0,0,3,3Z"
                                        fill="#707070" />
                                </svg>
                                <span class="aiz-side-nav-text">{{ translate('Orders') }}</span>
                            </a>
                        </li>
                    @endcan
                @endif

                <!-- Customers -->
                @can('show_customers')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('customers.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['customers.index', 'customers.show']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14">
                                <g id="Group_8860" data-name="Group 8860" transform="translate(30 -252)">
                                    <path id="Rectangle_16218" data-name="Rectangle 16218"
                                        d="M4,0H6a4,4,0,0,1,4,4V7a0,0,0,0,1,0,0H1A1,1,0,0,1,0,6V4A4,4,0,0,1,4,0Z"
                                        transform="translate(-30 259)" fill="#707070" />
                                    <circle id="Ellipse_612" data-name="Ellipse 612" cx="3" cy="3" r="3"
                                        transform="translate(-28 252)" fill="#707070" />
                                    <path id="Subtraction_33" data-name="Subtraction 33"
                                        d="M16,8H12V5a4.98,4.98,0,0,0-1.875-3.9A4.021,4.021,0,0,1,11,1h2a4.005,4.005,0,0,1,4,4V7A1,1,0,0,1,16,8Z"
                                        transform="translate(-31 258)" fill="#707070" />
                                    <path id="Subtraction_34" data-name="Subtraction 34"
                                        d="M10,7A3.013,3.013,0,0,1,7.584,5.778a4.008,4.008,0,0,0,0-3.557A3,3,0,1,1,10,7Z"
                                        transform="translate(-29 251)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Customers') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Seller -->
                @if (addon_is_activated('multi_vendor'))
                    @canany(['show_sellers','show_payouts','show_payout_requests','show_commission_log','show_seller_packages','show_seller_package_payments','seller_verification_form'])
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12.444" viewBox="0 0 14 12.444">
                                    <path id="Path_25490" data-name="Path 25490"
                                        d="M4.985,6.083,5.6,2H2.4L1.063,5.5A1.227,1.227,0,0,0,1,5.889,1.82,1.82,0,0,0,3,7.444,1.9,1.9,0,0,0,4.985,6.083ZM8,7.444a1.82,1.82,0,0,0,2-1.556c0-.032,0-.064,0-.094L9.6,2H6.4L6,5.792c0,.032,0,.064,0,.1A1.82,1.82,0,0,0,8,7.444Zm3.889.814v3.075H4.111V8.263A3.273,3.273,0,0,1,3,8.456a3.206,3.206,0,0,1-.444-.038v4.938a1.091,1.091,0,0,0,1.087,1.089h8.713a1.093,1.093,0,0,0,1.089-1.089V8.418A3.342,3.342,0,0,1,13,8.456,3.232,3.232,0,0,1,11.889,8.258ZM14.938,5.5,13.6,2H10.4l.614,4.077A1.893,1.893,0,0,0,13,7.444a1.82,1.82,0,0,0,2-1.556A1.249,1.249,0,0,0,14.938,5.5Z"
                                        transform="translate(-1 -2)" fill="#707070" />
                                </svg>
                                <span class="aiz-side-nav-text">{{ translate('Seller') }}</span>
                                @if (env('DEMO_MODE') == 'On')
                                    <span class="badge badge-inline badge-danger">Addon</span>
                                @endif
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                    @php
                                        $sellers = \App\Models\Shop::where('verification_status', 0)->where('verification_info', '!=', null)->count();
                                    @endphp
                                @can('show_sellers')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.all_sellers') }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['admin.seller.create', 'admin.seller.edit']) }}">
                                            <span class="aiz-side-nav-text">{{ translate('Sellers') }}</span>
                                            @if($sellers > 0)<span class="badge badge-info">{{ $sellers }}</span> @endif
                                        </a>
                                    </li>
                                @endcan
                                @can('show_payouts')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.seller_payments_history') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Payouts') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('show_payout_requests')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.all_payout_requests') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Payout Requests') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('show_commission_log')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.commission_log.index') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Earning History') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('show_seller_packages')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.seller_packages.index') }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['admin.seller_packages.create', 'admin.seller_packages.edit']) }}">
                                            <span class="aiz-side-nav-text">{{ translate('Seller Packages') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('show_seller_package_payments')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.package_purchase_history') }}" class="aiz-side-nav-link ">
                                            <span class="aiz-side-nav-text">{{ translate('Package Payments') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('seller_verification_form')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.seller_verification_form') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Seller Verification Form') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                @endif


                <!-- Refund -->
                @if (addon_is_activated('refund') && (auth()->user()->can('show_refund_requests') || auth()->user()->can('show_refund_settings')))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg id="Group_8930" data-name="Group 8930" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                                <defs>
                                    <clipPath id="clip-path">
                                        <rect id="Rectangle_17178" data-name="Rectangle 17178" width="16" height="16"
                                            fill="#707070" />
                                    </clipPath>
                                </defs>
                                <g id="Group_23708" data-name="Group 23708" clip-path="url(#clip-path)">
                                    <path id="Subtraction_80" data-name="Subtraction 80"
                                        d="M-30-647a5.006,5.006,0,0,1-5-5,5.006,5.006,0,0,1,5-5,5.006,5.006,0,0,1,5,5A5.005,5.005,0,0,1-30-647Zm-1.637-3.979v.409a1.025,1.025,0,0,0,1.023,1.024h.191v.614h.819v-.614h.219a1.025,1.025,0,0,0,1.023-1.024v-.819a1.024,1.024,0,0,0-1.023-1.023h-1.229a.2.2,0,0,1-.2-.205v-.819a.2.2,0,0,1,.2-.2h1.229a.2.2,0,0,1,.205.2v.41h.818v-.41a1.024,1.024,0,0,0-1.023-1.023H-29.6v-.615h-.819v.615h-.191a1.024,1.024,0,0,0-1.023,1.023v.819a1.025,1.025,0,0,0,1.023,1.024h1.229a.205.205,0,0,1,.205.2v.819a.205.205,0,0,1-.205.205h-1.229a.2.2,0,0,1-.2-.205v-.409Z"
                                        transform="translate(38 660)" fill="#707070" />
                                    <path id="Path_26789" data-name="Path 26789"
                                        d="M14.378,3.171H16V1.891H12.18V4.732h1.28V4.085a6.718,6.718,0,1,1-2.691-2.206L11.3.713a8,8,0,1,0,3.082,2.459"
                                        transform="translate(0 0)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Refund') }}</span>
                            @if (env('DEMO_MODE') == 'On')
                                <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('show_refund_requests')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('admin.refund_requests') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Refund Requests') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_refund_settings')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('admin.refund_settings') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Refund Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                <!-- marketing -->
                @canany(['show_offers','send_newsletters','show_subscribers','show_coupons'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14">
                                <g id="Group_8862" data-name="Group 8862" transform="translate(30 -303)">
                                    <path id="Rectangle_16222" data-name="Rectangle 16222"
                                        d="M0,0H2A0,0,0,0,1,2,0V3A1,1,0,0,1,1,4H1A1,1,0,0,1,0,3V0A0,0,0,0,1,0,0Z"
                                        transform="translate(-28 313)" fill="#707070" />
                                    <path id="Rectangle_16223" data-name="Rectangle 16223"
                                        d="M1,0H4A0,0,0,0,1,4,0V6A0,0,0,0,1,4,6H1A1,1,0,0,1,0,5V1A1,1,0,0,1,1,0Z"
                                        transform="translate(-30 306)" fill="#707070" />
                                    <path id="Path_18923" data-name="Path 18923" d="M0,0,5-2.044V7.97L0,6Z"
                                        transform="translate(-25 306)" fill="#707070" />
                                    <path id="Rectangle_16225" data-name="Rectangle 16225"
                                        d="M0,0H0A2,2,0,0,1,2,2V2A2,2,0,0,1,0,4H0A0,0,0,0,1,0,4V0A0,0,0,0,1,0,0Z"
                                        transform="translate(-16 307)" fill="#707070" />
                                    <rect id="Rectangle_16224" data-name="Rectangle 16224" width="2" height="12" rx="1"
                                        transform="translate(-19 303)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Marketing') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('show_offers')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('offers.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['offers.index', 'offers.create', 'offers.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Offers') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('send_newsletters')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('newsletters.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Newsletters') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_subscribers')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('subscribers.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Subscribers') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_coupons')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('coupon.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['coupon.index', 'coupon.create', 'coupon.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Coupon') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- Blog --}}
                @canany(['view_all_blogs','view_blog_categories'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg id="Group_23438" data-name="Group 23438" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="14.282" viewBox="0 0 16 14.282">
                                <defs>
                                    <clipPath id="clip-path">
                                    <rect id="Rectangle_17256" data-name="Rectangle 17256" width="16" height="14.282" fill="#707070"/>
                                    </clipPath>
                                </defs>
                                <g id="Group_23436" data-name="Group 23436" clip-path="url(#clip-path)">
                                    <path id="Path_28779" data-name="Path 28779" d="M13.746,85.891v.233q0,3.012,0,6.024a1.588,1.588,0,0,1-1.691,1.687H1.813a1.591,1.591,0,0,1-1.7-1.7q0-3.9,0-7.809v-.214H9.994c-.064.069-.111.122-.161.172Q8.055,86.064,6.275,87.84a2,2,0,0,0-.569,1.027c-.17.785-.359,1.566-.54,2.348-.1.414.074.586.486.491.789-.182,1.577-.371,2.368-.544A1.985,1.985,0,0,0,9.029,90.6q2.26-2.272,4.53-4.534c.051-.051.1-.1.187-.176" transform="translate(-0.109 -79.554)" fill="#707070"/>
                                    <path id="Path_28780" data-name="Path 28780" d="M.013,3.884c0-.83-.035-1.648.01-2.462A1.537,1.537,0,0,1,1.577,0Q6.83,0,12.082,0a1.522,1.522,0,0,1,1.335.787.2.2,0,0,1-.042.293c-.907.9-1.808,1.806-2.715,2.705a.357.357,0,0,1-.224.1Q5.265,3.9.094,3.895a.805.805,0,0,1-.081-.011M1.953,2.6c.115,0,.23.008.345,0a.319.319,0,0,0,.3-.321.314.314,0,0,0-.3-.32c-.229-.011-.46-.011-.689,0a.313.313,0,0,0-.3.32.319.319,0,0,0,.3.321c.114.01.23,0,.345,0m1.954,0c.108,0,.217.006.324,0a.321.321,0,0,0,.317-.329.316.316,0,0,0-.309-.314c-.223-.01-.446-.009-.669,0a.316.316,0,0,0-.316.328.32.32,0,0,0,.309.315c.114.009.23,0,.345,0m1.934,0c.115,0,.23.007.345,0A.32.32,0,0,0,6.5,2.28a.317.317,0,0,0-.316-.328c-.223-.009-.446-.009-.669,0a.315.315,0,0,0-.31.313.321.321,0,0,0,.316.329c.108.008.216,0,.324,0" transform="translate(0 0)" fill="#707070"/>
                                    <path id="Path_28781" data-name="Path 28781" d="M106.691,54.778c.114-.5.216-.963.327-1.427.26-1.087.1-.821.92-1.644q2.864-2.869,5.733-5.734c.047-.047.1-.091.133-.125l1.829,1.829c-.038.04-.087.095-.139.146q-3.053,3.053-6.1,6.108a1.461,1.461,0,0,1-.746.417c-.586.128-1.17.268-1.755.4-.051.012-.1.014-.2.027" transform="translate(-100.909 -43.363)" fill="#707070"/>
                                    <path id="Path_28782" data-name="Path 28782" d="M247.2,23.2c.217-.215.44-.449.676-.668a.317.317,0,0,1,.457.015q.686.674,1.36,1.359a.3.3,0,0,1,.014.453c-.182.2-.378.385-.569.576-.037.037-.078.072-.106.1L247.2,23.2" transform="translate(-233.799 -21.222)" fill="#707070"/>
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Blog') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('view_all_blogs')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('blog.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['blog.create','blog.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('All Blogs') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view_blog_categories')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('blog-category.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['blog-category.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Blog Categories') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                
                <!-- product query -->
                @if (addon_is_activated('multi_vendor') && get_setting('conversation_system') == 1 && auth()->user()->can('product_query'))
                    @php
                        $conversation = \App\Models\Conversation::where('receiver_id', Auth::user()->id)
                            ->where('receiver_viewed', 0)
                            ->get();
                    @endphp
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('querries.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['querries.index', 'querries.show']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16.499" height="15.527" viewBox="0 0 16.499 15.527">
                                <g id="Group_23439" data-name="Group 23439" transform="translate(12740.499 6159.76)">
                                    <path id="Path_28783" data-name="Path 28783" d="M208.917.891a.859.859,0,0,0-.207-.585A.956.956,0,0,0,207.937,0q-2.627,0-5.254,0a.9.9,0,0,0-1,1q0,1.2,0,2.408c0,.407-.006.814,0,1.22a.88.88,0,0,0,.858.9c.124.01.249,0,.4,0,0,.283-.009.543.005.8,0,.077.06.2.116.213a.277.277,0,0,0,.219-.108c.2-.256.389-.521.574-.788a.242.242,0,0,1,.228-.115c.569,0,1.139,0,1.708,0,.721,0,1.442,0,2.163,0a.9.9,0,0,0,.952-.932c0-1.236,0-2.473,0-3.709m-5.361,2.374a.633.633,0,1,1,0-1.267.609.609,0,0,1,.628.639.609.609,0,0,1-.624.627m1.721,0A.633.633,0,0,1,205.285,2a.637.637,0,0,1,.632.633.619.619,0,0,1-.64.634m1.759,0A.633.633,0,0,1,207.058,2a.618.618,0,0,1,.626.632.639.639,0,0,1-.648.634" transform="translate(-12932.919 -6159.76)" fill="#707070"/>
                                    <rect id="Rectangle_17258" data-name="Rectangle 17258" width="2.48" height="2.875" transform="translate(-12734.919 -6156.351)" fill="#707070"/>
                                    <path id="Union_63" data-name="Union 63" d="M1.375,11.628A1.3,1.3,0,0,1,0,10.25Q0,5.817,0,1.384A1.308,1.308,0,0,1,1.39,0H4.737V3.222H7.863V.009H8.43c0,.365,0,.721,0,1.078a1.7,1.7,0,0,0,.043.418,1.189,1.189,0,0,0,.994.909c.069.013.139.02.227.033,0,.154,0,.31,0,.466a.506.506,0,0,0,.932.314c.178-.232.351-.469.533-.7a.238.238,0,0,1,.154-.089c.417-.007.834,0,1.271,0,0,.064.008.121.008.177q0,3.815,0,7.63a1.292,1.292,0,0,1-1.379,1.385H1.375Zm4.448-1.449V6.942h0v3.237a.309.309,0,0,1-.083.016A.309.309,0,0,0,5.824,10.179Zm-4.377.009h0V6.946h0Zm5.594,0V6.943h0Zm-.384,0V6.94h0v3.246Zm-2.781,0V6.942h0Zm4.231,0V6.94h0Zm-4.895,0h0V6.941h0Zm1.4,0V6.942h0Zm-2.4,0h0V6.938h0Zm3.452-.08q0-.009,0-.02Q5.664,10.093,5.664,10.1ZM5.666,7q0,1.543,0,3.085,0-1.543,0-3.085Z" transform="translate(-12740 -6156.362)" fill="#707070" stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1"/>
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Product Querries') }}</span>
                            @if (count($conversation) > 0)
                                <span
                                    class="badge badge-inline badge-danger p-2">({{ count($conversation) }})</span>
                            @endif
                        </a>
                    </li>
                @endif
                <!-- product query -->
                

                <!-- Uploaded Files -->
                @can('show_uploaded_files')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('uploaded-files.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['uploaded-files.create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16">
                                <path id="Path_18924" data-name="Path 18924"
                                    d="M4.4,4.78v8.553A3.407,3.407,0,0,0,7.67,16.66l.23.007h6.18A2.1,2.1,0,0,1,12.1,18H7.2A4.1,4.1,0,0,1,3,14V6.667A2.01,2.01,0,0,1,4.4,4.78ZM14.9,2A2.052,2.052,0,0,1,17,4v9.333a2.052,2.052,0,0,1-2.1,2h-7a2.052,2.052,0,0,1-2.1-2V4A2.052,2.052,0,0,1,7.9,2Z"
                                    transform="translate(-3 -2)" fill="#707070" />
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Uploaded Files') }}</span>
                        </a>
                    </li>
                @endcan
                <!-- Support -->
                @can('show_chats')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('chats.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['chats.index', 'chats.show']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g id="Group_8863" data-name="Group 8863" transform="translate(-4 -4)">
                                    <path id="Path_18925" data-name="Path 18925"
                                        d="M18.4,4H5.6A1.593,1.593,0,0,0,4.008,5.6L4,20l3.2-3.2H18.4A1.6,1.6,0,0,0,20,15.2V5.6A1.6,1.6,0,0,0,18.4,4ZM7.2,9.6h9.6v1.6H7.2Zm6.4,4H7.2V12h6.4Zm3.2-4.8H7.2V7.2h9.6Z"
                                        fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Support chat') }}</span>
                        </a>
                    </li>
                @endcan
                    
                 <!-- Offline Payment System -->
                @if (get_setting('affiliate_system')==1)
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg id="Group_23794" data-name="Group 23794" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.774" height="16" viewBox="0 0 15.774 16">
                                <defs>
                                    <clipPath id="clip-path">
                                    <rect id="Rectangle_17810" data-name="Rectangle 17810" width="15.774" height="16" fill="#707070"/>
                                    </clipPath>
                                </defs>
                                <g id="Group_23782" data-name="Group 23782" clip-path="url(#clip-path)">
                                    <path id="Path_27903" data-name="Path 27903" d="M135.768,0a9.26,9.26,0,0,1,.939.215,3.942,3.942,0,1,1-1.838-.176c.071-.011.141-.026.211-.039Zm.143,6.3a3.566,3.566,0,0,0,.361-.161,1.24,1.24,0,0,0,.072-2.1c-.416-.312-.837-.619-1.255-.928a.307.307,0,0,1,.181-.575c.109,0,.219,0,.328,0a.314.314,0,0,1,.351.316.473.473,0,0,0,.511.453.484.484,0,0,0,.417-.575,1.236,1.236,0,0,0-.868-1.079.183.183,0,0,1-.1-.121c-.039-.295-.2-.471-.46-.475a.476.476,0,0,0-.484.47.183.183,0,0,1-.1.125A1.211,1.211,0,0,0,134,2.683a1.209,1.209,0,0,0,.535,1.189l1.217.9c.175.129.226.244.175.392s-.159.208-.377.209h-.266a.313.313,0,0,1-.361-.319.465.465,0,0,0-.506-.44.472.472,0,0,0-.429.519,1.23,1.23,0,0,0,.815,1.1.206.206,0,0,1,.172.209.453.453,0,0,0,.464.417.467.707070,0,0,0,.459-.443c0-.041.006-.082.009-.118" transform="translate(-126.005)" fill="#707070"/>
                                    <path id="Path_27904" data-name="Path 27904" d="M2.575,244.87a.79.79,0,0,1-.341-.346q-1.057-1.84-2.121-3.677a.465.465,0,0,1,.2-.75l2.04-1.178a.45.45,0,0,1,.706.188q1.089,1.885,2.177,3.771a.448.448,0,0,1-.182.7q-1.127.651-2.258,1.3Z" transform="translate(0 -228.87)" fill="#707070"/>
                                    <path id="Path_27905" data-name="Path 27905" d="M103.993,209.048c-.62,0-1.239,0-1.859,0a.193.193,0,0,1-.2-.111q-.889-1.55-1.788-3.095a.207.207,0,0,1,0-.241,3.232,3.232,0,0,1,2.387-1.585,2.919,2.919,0,0,1,2.53.836.307.307,0,0,0,.192.068c.562.005,1.125,0,1.687,0a.622.622,0,1,1-.006,1.243c-.781,0-1.562,0-2.343,0a.465.465,0,0,0-.453.643.444.444,0,0,0,.425.291c.781,0,1.562.008,2.343,0a1.584,1.584,0,0,0,.914-.322q1.4-1.011,2.8-2.022a.678.678,0,0,1,.616-.129.613.613,0,0,1,.455.488.639.639,0,0,1-.269.685q-.63.461-1.262.919c-.722.521-1.441,1.046-2.169,1.558a4.14,4.14,0,0,1-2.538.772c-.489-.011-.979,0-1.469,0" transform="translate(-95.942 -195.483)" fill="#707070"/>
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Affiliate System') }}</span>
                            @if (env("DEMO_MODE") == "On")
                                <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            {{-- <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.registration_form') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Affiliate Registration Form')}}</span>
                                </a>
                            </li> --}}
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.configs') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Affiliate Configurations')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.users') }}" class="aiz-side-nav-link {{ areActiveRoutes(['affiliate_users.show_verification_info']) }}">
                                    <span class="aiz-side-nav-text">{{translate('Affiliate Users')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('refferal.users') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Referral Users')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('affiliate.withdraw_requests') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Affiliate Withdraw Requests')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('affiliate.logs')}}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Affiliate Logs')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- club points System -->
                @if(get_setting('club_point'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg id="Group_22520" data-name="Group 22520" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16.99" height="16" viewBox="0 0 16.99 16">
                            <defs>
                                <clipPath id="clip-path">
                                <rect id="Rectangle_1413" data-name="Rectangle 1413" width="16.991" height="16" fill="#707070"/>
                                </clipPath>
                            </defs>
                            <g id="Group_22519" data-name="Group 22519" clip-path="url(#clip-path)">
                                <path id="Path_27921" data-name="Path 27921" d="M10.3,117.626a5.152,5.152,0,1,1-4.917-5.279,5.154,5.154,0,0,1,4.917,5.279m-4.844-2.388c0-.071,0-.152,0-.234s0-.165,0-.246a.3.3,0,0,0-.307-.3.3.3,0,0,0-.3.307,3.5,3.5,0,0,0,0,.36c.005.1-.03.134-.125.17a2.422,2.422,0,0,0-.606.3,1.135,1.135,0,0,0,.034,1.884,1.669,1.669,0,0,0,.993.319,1.049,1.049,0,0,1,.684.233.53.53,0,0,1-.014.887,1.077,1.077,0,0,1-1.179.1.639.639,0,0,1-.4-.555.3.3,0,1,0-.6.041,1.133,1.133,0,0,0,.777,1.068c.356.127.5.289.441.66a.276.276,0,0,0,.3.3.3.3,0,0,0,.3-.286.943.943,0,0,0,0-.227c-.028-.2.02-.329.251-.362a.963.963,0,0,0,.342-.155,1.162,1.162,0,0,0,.007-2.05,2,2,0,0,0-.879-.262,1.59,1.59,0,0,1-.624-.177.543.543,0,0,1,0-.982A1.088,1.088,0,0,1,5.717,116a.639.639,0,0,1,.35.529.3.3,0,0,0,.437.255.327.327,0,0,0,.161-.372,1.238,1.238,0,0,0-.689-.961,5.239,5.239,0,0,0-.519-.212" transform="translate(0 -106.65)" fill="#707070"/>
                                <path id="Path_27922" data-name="Path 27922" d="M153.3,53.949c0,.54.005,1.081-.007,1.622,0,.065-.088.146-.155.188a4.946,4.946,0,0,1-1.6.6,13.584,13.584,0,0,1-5.454.138.311.311,0,0,0-.4.217.3.3,0,0,0,.276.374,12.975,12.975,0,0,0,3.131.209,12.576,12.576,0,0,0,3.225-.52c.329-.1.646-.243.989-.373v.2c0,1.232-.006,2.464.006,3.7a.43.43,0,0,1-.257.456,10.081,10.081,0,0,1-1.317.512,13.242,13.242,0,0,1-4.4.34.508.508,0,0,1-.068-.01l-.481-1.9c.192.015.42.033.647.049a13.885,13.885,0,0,0,3.454-.171c.237-.043.345-.156.333-.338s-.165-.292-.4-.268c-.671.071-1.342.18-2.015.191-.749.012-1.5-.069-2.249-.109a.36.36,0,0,1-.3-.184,5.643,5.643,0,0,0-2.5-2.1c-.086-.037-.164-.06-.162-.193.008-.859,0-1.719,0-2.578a.331.331,0,0,1,.012-.059,5.839,5.839,0,0,0,3.279,1.12,13.6,13.6,0,0,0,4.076-.139,5.737,5.737,0,0,0,1.687-.545c.224-.121.427-.28.653-.431m-8.1,2.982a1.151,1.151,0,0,0,.247-.256.248.248,0,0,0-.121-.34,2.272,2.272,0,0,0-.477-.176.271.271,0,0,0-.32.177.251.251,0,0,0,.081.338,5.5,5.5,0,0,0,.589.258m7.19,1.99a.3.3,0,0,0-.385-.279,2.355,2.355,0,0,0-.408.146.292.292,0,0,0-.107.46c.168.2.356.088.538.026s.354-.121.362-.354" transform="translate(-136.315 -51.21)" fill="#707070"/>
                                <path id="Path_27923" data-name="Path 27923" d="M153.954,9.585a9.754,9.754,0,0,1-3.219-.5,3.168,3.168,0,0,1-.809-.44.776.776,0,0,1,0-1.326,3.408,3.408,0,0,1,1.448-.624,11.861,11.861,0,0,1,5.774.089,3.7,3.7,0,0,1,1.088.508.791.791,0,0,1,0,1.406,4.18,4.18,0,0,1-1.7.657,12.532,12.532,0,0,1-2.583.232" transform="translate(-141.977 -6.057)" fill="#707070"/>
                                <path id="Path_27924" data-name="Path 27924" d="M169.215,252.617c.234-.21.451-.393.654-.591a5.326,5.326,0,0,0,1.008-1.366.175.175,0,0,1,.2-.116,14.607,14.607,0,0,0,3.2.038,10.142,10.142,0,0,0,2.828-.573c.169-.066.331-.15.513-.234,0,.063.01.116.01.169,0,.442-.012.885,0,1.326a.948.948,0,0,1-.473.91,5.278,5.278,0,0,1-1.108.515,11.772,11.772,0,0,1-3.975.409,10.789,10.789,0,0,1-2.467-.363c-.127-.036-.252-.079-.394-.123" transform="translate(-160.643 -237.121)" fill="#707070"/>
                                <path id="Path_27925" data-name="Path 27925" d="M209.464,202.985l.344-1.815a12.908,12.908,0,0,0,6.029-.87c0,.54.007,1.081-.007,1.622a.328.328,0,0,1-.162.232,6.555,6.555,0,0,1-1.119.491,14.108,14.108,0,0,1-5.054.351.063.063,0,0,1-.03-.011" transform="translate(-198.853 -190.153)" fill="#707070"/>
                                <path id="Path_27926" data-name="Path 27926" d="M58.35,2.409q0,1,0,2.007c0,.242-.109.38-.3.382s-.308-.14-.309-.375q0-2.026,0-4.052c0-.233.125-.375.311-.372s.293.137.294.365c0,.682,0,1.363,0,2.045" transform="translate(-54.818 0)" fill="#707070"/>
                                <path id="Path_27927" data-name="Path 27927" d="M14.531,57.949c0,.4,0,.809,0,1.213,0,.211-.1.332-.27.353-.192.023-.332-.113-.333-.342,0-.594,0-1.188,0-1.782,0-.221,0-.442,0-.663s.113-.363.295-.367.308.138.31.374c0,.4,0,.809,0,1.213" transform="translate(-13.218 -53.507)" fill="#707070"/>
                                <path id="Path_27928" data-name="Path 27928" d="M101.74,42.721c0-.328,0-.655,0-.983,0-.218.125-.357.307-.353a.312.312,0,0,1,.3.345q0,1,0,2a.313.313,0,0,1-.309.352c-.182,0-.295-.14-.3-.364,0-.334,0-.668,0-1" transform="translate(-96.586 -39.289)" fill="#707070"/>
                                <path id="Path_27929" data-name="Path 27929" d="M13.934,11.365c0-.176-.006-.353,0-.528a.3.3,0,1,1,.6-.008q.015.547,0,1.094a.3.3,0,1,1-.6-.011c-.007-.182,0-.365,0-.547" transform="translate(-13.226 -9.997)" fill="#707070"/>
                                <path id="Path_27930" data-name="Path 27930" d="M101.687,19.024c0-.229.083-.355.251-.382a.3.3,0,0,1,.344.226.428.428,0,0,1-.162.516.312.312,0,0,1-.433-.36" transform="translate(-96.533 -17.693)" fill="#707070"/>
                            </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{translate('Club Point System')}}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('club_points.configs') }}" class="aiz-side-nav-link {{ areActiveRoutes(['product_club_point.edit'])}}">
                                    <span class="aiz-side-nav-text">{{translate('Club Point Configurations')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('club_points.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['club_points.index', 'club_point.details'])}}">
                                    <span class="aiz-side-nav-text">{{translate('User Points')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Offline Payment System -->
                @if (get_setting('offline_payment'))
                    @canany(['view_all_manual_payment_methods','view_all_offline_wallet_recharges','view_all_offline_seller_package_payments'])
                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <svg id="Group_23794" data-name="Group 23794" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.774" height="16" viewBox="0 0 15.774 16">
                                    <defs>
                                        <clipPath id="clip-path">
                                        <rect id="Rectangle_17810" data-name="Rectangle 17810" width="15.774" height="16" fill="#707070"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_23782" data-name="Group 23782" clip-path="url(#clip-path)">
                                        <path id="Path_27903" data-name="Path 27903" d="M135.768,0a9.26,9.26,0,0,1,.939.215,3.942,3.942,0,1,1-1.838-.176c.071-.011.141-.026.211-.039Zm.143,6.3a3.566,3.566,0,0,0,.361-.161,1.24,1.24,0,0,0,.072-2.1c-.416-.312-.837-.619-1.255-.928a.307.307,0,0,1,.181-.575c.109,0,.219,0,.328,0a.314.314,0,0,1,.351.316.473.473,0,0,0,.511.453.484.484,0,0,0,.417-.575,1.236,1.236,0,0,0-.868-1.079.183.183,0,0,1-.1-.121c-.039-.295-.2-.471-.46-.475a.476.476,0,0,0-.484.47.183.183,0,0,1-.1.125A1.211,1.211,0,0,0,134,2.683a1.209,1.209,0,0,0,.535,1.189l1.217.9c.175.129.226.244.175.392s-.159.208-.377.209h-.266a.313.313,0,0,1-.361-.319.465.465,0,0,0-.506-.44.472.472,0,0,0-.429.519,1.23,1.23,0,0,0,.815,1.1.206.206,0,0,1,.172.209.453.453,0,0,0,.464.417.467.707070,0,0,0,.459-.443c0-.041.006-.082.009-.118" transform="translate(-126.005)" fill="#707070"/>
                                        <path id="Path_27904" data-name="Path 27904" d="M2.575,244.87a.79.79,0,0,1-.341-.346q-1.057-1.84-2.121-3.677a.465.465,0,0,1,.2-.75l2.04-1.178a.45.45,0,0,1,.706.188q1.089,1.885,2.177,3.771a.448.448,0,0,1-.182.7q-1.127.651-2.258,1.3Z" transform="translate(0 -228.87)" fill="#707070"/>
                                        <path id="Path_27905" data-name="Path 27905" d="M103.993,209.048c-.62,0-1.239,0-1.859,0a.193.193,0,0,1-.2-.111q-.889-1.55-1.788-3.095a.207.207,0,0,1,0-.241,3.232,3.232,0,0,1,2.387-1.585,2.919,2.919,0,0,1,2.53.836.307.307,0,0,0,.192.068c.562.005,1.125,0,1.687,0a.622.622,0,1,1-.006,1.243c-.781,0-1.562,0-2.343,0a.465.465,0,0,0-.453.643.444.444,0,0,0,.425.291c.781,0,1.562.008,2.343,0a1.584,1.584,0,0,0,.914-.322q1.4-1.011,2.8-2.022a.678.678,0,0,1,.616-.129.613.613,0,0,1,.455.488.639.639,0,0,1-.269.685q-.63.461-1.262.919c-.722.521-1.441,1.046-2.169,1.558a4.14,4.14,0,0,1-2.538.772c-.489-.011-.979,0-1.469,0" transform="translate(-95.942 -195.483)" fill="#707070"/>
                                    </g>
                                </svg>
                                <span class="aiz-side-nav-text">{{ translate('Offline Payment System') }}</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                @can('view_all_manual_payment_methods')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('manual_payment_methods.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['manual_payment_methods.index', 'manual_payment_methods.create', 'manual_payment_methods.edit'])}}">
                                            <span class="aiz-side-nav-text">{{translate('Manual Payment Methods')}}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('view_all_offline_wallet_recharges')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('offline_wallet_recharge_request.index') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{translate('Offline Wallet Recharge')}}</span>
                                        </a>
                                    </li>
                                @endcan
                                @if (addon_is_activated('multi_vendor') && auth()->user()->can('view_all_offline_seller_package_payments'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('offline_seller_package_payment_request.index') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{translate('Offline Seller Package Payments')}}</span>
                                            @if (env("DEMO_MODE") == "On")
                                                <span class="badge badge-inline badge-danger">Addon</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endcan
                @endif

                <!-- Website Setup -->
                @can('website_setup')
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14">
                                <g id="Group_8864" data-name="Group 8864" transform="translate(-24 -40)">
                                    <rect id="Rectangle_16227" data-name="Rectangle 16227" width="16" height="11" rx="1"
                                        transform="translate(24 40)" fill="#707070" />
                                    <rect id="Rectangle_16228" data-name="Rectangle 16228" width="6" height="1" rx="0.5"
                                        transform="translate(29 53)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Website Setup') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.header') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Header') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.footer') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Footer') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.banners') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Banners') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.pages') }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['website.pages', 'custom-pages.create', 'custom-pages.edit']) }}">
                                    <span class="aiz-side-nav-text">{{ translate('Pages') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.appearance') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Appearance') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <!-- Setup & Configurations -->
                @canany(['show_shop_setting', 'show_general_setting','sms_settings','show_languages','show_currencies','smtp_setting','payment_method','file_system','social_media_login','third_party_setting','shipping_configuration','show_taxes'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g id="Group_8866" data-name="Group 8866" transform="translate(-3.185 -7)">
                                    <path id="Path_18928" data-name="Path 18928"
                                        d="M13.688,20.6a6.064,6.064,0,0,0,1.331-.768l-.033.048,1.68.624a.826.826,0,0,0,1.015-.352l1.4-2.336a.79.79,0,0,0-.2-1.024L17.464,15.7l-.033.048a6.021,6.021,0,0,0,.083-.768,6.021,6.021,0,0,0-.083-.768l.033.048,1.414-1.088a.79.79,0,0,0,.2-1.024l-1.4-2.336a.845.845,0,0,0-1.015-.352l-1.68.624.033.048A7.559,7.559,0,0,0,13.688,9.4l-.283-1.728A.8.8,0,0,0,12.591,7H9.8a.8.8,0,0,0-.815.672L8.7,9.4a6.064,6.064,0,0,0-1.331.768L7.4,10.12,5.7,9.5a.826.826,0,0,0-1.015.352l-1.4,2.336a.79.79,0,0,0,.2,1.024L4.906,14.3l.033-.048A5.485,5.485,0,0,0,4.856,15a6.021,6.021,0,0,0,.083.768l-.033-.048L3.493,16.808a.79.79,0,0,0-.2,1.024l1.4,2.336A.845.845,0,0,0,5.7,20.52l1.68-.624-.017-.064A6.065,6.065,0,0,0,8.7,20.6l.283,1.712A.8.8,0,0,0,9.8,23h2.794a.8.8,0,0,0,.815-.672ZM7.867,15a3.329,3.329,0,1,1,3.326,3.2A3.275,3.275,0,0,1,7.867,15Z"
                                        transform="translate(0)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Settings') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (addon_is_activated('multi_vendor'))
                                @can('show_shop_setting')
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('admin.shop_setting.index') }}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Shop Settings') }}</span>
                                            @if (env('DEMO_MODE') == 'On')
                                                <span class="badge badge-inline badge-danger">Addon</span>
                                            @endif
                                        </a>
                                    </li>
                                @endcan
                            @endif
                            @can('show_general_setting')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('general_setting.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('General Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('sms_settings')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('settings.otp') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('OTP Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_languages')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('languages.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Languages') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_currencies')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('currency.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Currency') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('smtp_setting')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('smtp_settings.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('SMTP Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_method')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('payment_method.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Payment Methods') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('file_system')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('file_system.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('File System Configuration') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('social_media_login')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('social_login.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Social media Logins') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('third_party_setting')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('third_party_settings.index') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Third Party Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('shipping_configuration')
                                <li class="aiz-side-nav-item">
                                    <a href="javascript:void(0);" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Shipping') }}</span>
                                        <span class="aiz-side-nav-arrow"></span>
                                    </a>

                                    <ul class="aiz-side-nav-list level-3">
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('countries.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['countries.index', 'countries.edit', 'countries.update']) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Shipping Countries') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('states.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['states.index', 'states.edit', 'states.update']) }}">
                                                <span class="aiz-side-nav-text">{{ translate('Shipping States') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('cities.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['cities.index', 'cities.edit', 'cities.update']) }}">
                                                <span class="aiz-side-nav-text">{{ translate('Shipping Cities') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('zones.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['zones.index', 'zones.create', 'zones.edit', 'zones.update']) }}">
                                                <span class="aiz-side-nav-text">{{ translate('Shipping Zones') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            @can('show_taxes')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('taxes.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['taxes.index', 'taxes.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Tax') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!-- Staffs -->
                @canany(['show_staffs', 'show_staff_roles'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16.001" viewBox="0 0 14 16.001">
                                <g id="Group_8868" data-name="Group 8868" transform="translate(30 -384)">
                                    <rect id="Rectangle_16229" data-name="Rectangle 16229" width="8" height="8" rx="4"
                                        transform="translate(-27 384)" fill="#707070" />
                                    <path id="Subtraction_35" data-name="Subtraction 35"
                                        d="M6,7H1A1,1,0,0,1,0,6,6.007,6.007,0,0,1,6,0H8a6.007,6.007,0,0,1,6,6,1,1,0,0,1-1,1H8V3A1,1,0,1,0,6,3V7Z"
                                        transform="translate(-30 393)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Staffs') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('show_staffs')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('staffs.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('All Staffs') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('show_staff_roles')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('roles.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Roles') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['system_update', 'server_status'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14">
                                <g id="Group_8869" data-name="Group 8869" transform="translate(-24 -40)">
                                    <path id="Subtraction_36" data-name="Subtraction 36"
                                        d="M5-525H-9a1,1,0,0,1-1-1v-9a1,1,0,0,1,1-1H5a1,1,0,0,1,1,1v9A1,1,0,0,1,5-525Zm-5.476-9.5a2.5,2.5,0,0,0-1.76.725,2.5,2.5,0,0,0-.651,2.339L-5.624-528.7a1.3,1.3,0,0,0,0,1.825,1.291,1.291,0,0,0,.913.376,1.292,1.292,0,0,0,.912-.376l2.736-2.74a2.489,2.489,0,0,0,.585.07,2.5,2.5,0,0,0,1.754-.719,2.508,2.508,0,0,0,.6-2.541l-.653.653-.408.405a1.1,1.1,0,0,1-.783.325,1.1,1.1,0,0,1-.783-.325,1.1,1.1,0,0,1-.325-.785,1.1,1.1,0,0,1,.325-.782l.4-.408.653-.653a2.481,2.481,0,0,0-.78-.125Z"
                                        transform="translate(34 576)" fill="#707070" />
                                    <rect id="Rectangle_16228" data-name="Rectangle 16228" width="6" height="1" rx="0.5"
                                        transform="translate(29 53)" fill="#707070" />
                                </g>
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('System') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @can('system_update')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('system_update') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Update') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('server_status')
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('server_status') }}" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Server status') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- Addon Manager -->
                @can('show_addons')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('addons.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['addons.index', 'addons.create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16.003" viewBox="0 0 16 16.003">
                                <path id="Path_18944" data-name="Path 18944"
                                    d="M2,17.112V13.556H3.778A1.779,1.779,0,0,0,5.532,11.48,1.844,1.844,0,0,0,3.68,10H2V6.445a.889.889,0,0,1,.889-.89H6.445V3.777a1.779,1.779,0,0,1,2.08-1.754A1.844,1.844,0,0,1,10,3.873v1.68h3.556a.89.89,0,0,1,.89.89V10h1.68a1.844,1.844,0,0,1,1.849,1.479,1.779,1.779,0,0,1-1.754,2.076H14.446v3.556a.889.889,0,0,1-.89.889H10.89V16.223a1.779,1.779,0,0,0-2.08-1.754,1.844,1.844,0,0,0-1.475,1.851V18H2.889A.888.888,0,0,1,2,17.112Z"
                                    transform="translate(-2 -1.998)" fill="#707070" />
                            </svg>
                            <span class="aiz-side-nav-text">{{ translate('Addon Manager') }}</span>
                        </a>
                    </li>
                @endcan
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
