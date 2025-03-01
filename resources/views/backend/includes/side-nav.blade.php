       <style>
        .logo-round {
            max-width: 70px; /* Reduced size to fit well */
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .logo-round:hover {
            transform: scale(1.1);
        }

        .brand-text-left,
        .brand-text-right {
            font-size: 15px; /* Smaller font to fit sidebar */
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
            background: linear-gradient(90deg, #0a0601, #dbaaa8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            white-space: nowrap; /* Prevents text from breaking into multiple lines */
        }

        .brand-text-left {
            margin-right: 10px;
        }

        .brand-text-right {
            margin-left: 10px;
        }

        /* Ensure the whole logo container stays within the sidebar */
        .side-logo {
            max-width: 100%;
            padding: 5px;
            overflow: hidden; /* Prevents overflow issues */
            display: flex;
            justify-content: center;
            align-items: center;
        }
       </style>
       
       
       <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo side-logo d-flex align-items-center justify-content-center flex-wrap text-center">
                <a href="{{route('dashboard')}}" class="app-brand-link d-flex align-items-center">
                    <span class="brand-text-left">RNT</span>
                    <img class="img-fluid logo-round mx-1" src="{{ asset('RNT-Logo.png') }}" alt="RNT logo" loading="lazy">
                    <span class="brand-text-right">Automation</span>
                </a>
            </div>
            
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Dashboard">Home</div>
                    </a>
                </li>
                <!-- Layouts -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Requisition Section</span>
                </li>
                @if (Auth::user()->can('Can Access Inventory Manu'))
                <li class="menu-item operation {{ request()->is('requisitions/create') || request()->is('allocations/create') || request()->is('purchases/create') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cart"></i>
                        <div data-i18n="Layouts">Operation</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        @if (Auth::user()->can('Can Access Requisitions'))
                        <li class="menu-item requisitions {{ request()->is('requisitions/create') ? 'active' : '' }}">
                            <a href="{{ route('requisitions.create') }}" class="menu-link">
                                <div data-i18n="Without menu">Requisitions</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        <!-- @if (Auth::user()->can('Can Access Allocations'))
                        <li class="menu-item allocations {{ request()->is('allocations/create') ? 'active' : '' }}">
                            <a href="{{ route('allocations.create') }}" class="menu-link">
                                <div data-i18n="Without menu">Allocations</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif -->
                        @if (Auth::user()->can('Can Access Purchase Invoice'))
                        <li class="menu-item {{ request()->is('purchases/create') ? 'active' : '' }}">
                            <a href="{{ route('purchases.create') }}" class="menu-link">
                                <div data-i18n="Without menu">Purchase Invoice</div>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- @if (Auth::user()->can('Can Access Approved List Manu'))
                <li class="menu-item approved {{ request()->is('issue-vouchers/create') || request()->is('leisure-report') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-check"></i>
                        <div data-i18n="Layouts">Store Management</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                    
                    
                        @if (Auth::user()->can('Can Access Allocation List'))
                        <li class="menu-item allocation_list">
                            <a href="{{ route('allocations.approve') }}" class="menu-link">
                                <div data-i18n="Without navbar">Allocations List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        
                        
                        
                        @if (Auth::user()->can('Can Access Issue List'))
                        <li class="menu-item issue {{ request()->is('issue-vouchers/create') ? 'active' : '' }}">
                            <a href="{{ route('issue-vouchers.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Allocation</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @can('Can Access Report')
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Report Section</span>
                        </li>

                        <li class="menu-item {{ request()->is('leisure-report') ? 'active' : '' }}">
                            <a href="{{route('leisure-report')}}" class="menu-link">
                                <i class="menu-icon bx bx-file"></i>
                                <div data-i18n="report">Stock Register</div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif -->

                @if (Auth::user()->can('Can Access Category & Item Menu'))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Store Management</span>
                </li>
                
                <li class="menu-item all_item {{ request()->is('product/request/list') || request()->is('unit-types/create') || request()->is('product-sub-categories/create') || request()->is('product-categories/create') || request()->is('products/create') || request()->is('companies') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-store"></i>
                        <div data-i18n="Layouts">Stock Entry Management</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        @if (Auth::user()->can('Can Access Product List'))
                        <li class="menu-item request_product {{ request()->is('product/request/list') ? 'active' : '' }}">
                            <a href="{{ route('products.request.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">Product Entry Authorization</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('Can Access Product'))
                        <li class="menu-item products {{ request()->is('products/create') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Product</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('Can Access Category'))
                        <li class="menu-item product_categories {{ request()->is('product-categories/create') ? 'active' : '' }}">
                            <a href="{{ route('product-categories.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Category</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->can('Can Access Sub Category'))
                        <li class="menu-item product_sub_categories {{ request()->is('product-sub-categories/create') ? 'active' : '' }}">
                            <a href="{{ route('product-sub-categories.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Sub Category</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        
                        <li class="menu-item unit_types {{ request()->is('unit-types/create') ? 'active' : '' }}">
                            <a href="{{ route('unit-types.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Unit Type</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <li class="menu-item companies {{ request()->is('companies') ? 'active' : '' }}">
                            <a href="{{ route('companies.index') }}" class="menu-link">
                                <div data-i18n="Without navbar">Company</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                <!-- <li class="menu-item purchase_demand {{ request()->is('createCommittee') || request()->is('allCommittee') || request()->is('approved-oce') || request()->is('show-committees') || request()->is('oce-approval-list') || request()->is('oce-committee-list') || request()->is('show-committees') || request()->is('techCommittee') || request()->is('demandCommittee') || request()->is('defaultCommittee') ? 'open' : '' }}">

                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-check"></i>
                        <div data-i18n="Layouts">Purchase Demand</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>

                    <ul class="menu-sub">
                        @if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin')
                        <li class="menu-item purchase_demand_list {{ request()->is('allCommittee') ? 'active' : '' }}">
                            <a href="{{ route('allCommittee') }}" class="menu-link">
                                <div data-i18n="Without navbar">All Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item purchase_demand_list {{ request()->is('defaultCommittee') ? 'active' : '' }}">
                            <a href="{{ route('defaultCommittee') }}" class="menu-link">
                                <div data-i18n="Without navbar">Default Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        
                        <li class="menu-item purchase_demand_list {{ request()->is('createCommittee') ? 'active' : '' }}">
                            <a href="{{ route('create.committee.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">Purchase Demand List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->designation_id != 3)
                        <li class="menu-item demand_committee {{ request()->is('demandCommittee') ? 'active' : '' }}">
                            <a href="{{ route('demand.committee.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">Demand Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <li class="menu-item tech_committee {{ request()->is('techCommittee') ? 'active' : '' }}">
                            <a href="{{ route('tech.committee.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">Tech Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin')
                        <li class="menu-item demand_tech_committee {{ request()->is('show-committees') ? 'active' : '' }}">
                            <a href="{{ route('show.committees') }}" class="menu-link">
                                <div data-i18n="Without navbar">Demand & Tech Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif

                        @if (auth()->user()->designation_id != 3)
                        <li class="menu-item oce_committee {{ request()->is('oce-committee-list') ? 'active' : '' }}">
                            <a href="{{ route('oce.committee.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">OCE Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif

                        {{-- vc view approval list  --}}
                        @if (auth()->user()->designation_id == 3)
                        <li class="menu-item oce_approval {{ request()->is('oce-approval-list') ? 'active' : '' }}">
                            <a href="{{ route('oce.approval.list') }}" class="menu-link">
                                <div data-i18n="Without navbar">OCE Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item oce_approval {{ request()->is('show-committees') ? 'active' : '' }}">
                            <a href="{{ route('vc.approve') }}" class="menu-link">
                                <div data-i18n="Without navbar">Demand and Tech Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif

                        {{-- admin view approval list  --}}
                        @if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin')
                        <li class="menu-item approved_oce_list {{ request()->is('approved-oce') ? 'active' : '' }}">
                            <a href="{{ route('approved.oce') }}" class="menu-link">
                                <div data-i18n="Without navbar">Approved OCE List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">File Management</span>
                </li>
                <li class="menu-item intiator {{ request()->is('files/drafts') || request()->is('file/operation') || request()->is('initiator-notes/create') || request()->is('file-tracking') || request()->is('initiator-note-attachments/create') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-store"></i>
                        <div data-i18n="Layouts">File Initiation</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    @can('Can Access File Approved List')
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item {{ request()->is('files/drafts') ? 'active' : '' }}">
                            <a href="{{ route('drafts.file') }}" class="menu-link">
                                <div data-i18n="Without navbar">File Draft List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item {{ request()->is('file/operation') ? 'active' : '' }}">
                            <a href="{{ route('file-operation') }}" class="menu-link">
                                <div data-i18n="Without navbar">File Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item {{ request()->is('file-tracking') ? 'active' : '' }}">
                            <a href="{{ route('file-tracking') }}" class="menu-link">
                                <div data-i18n="Without navbar">File Tracking</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    @endcan

                    <ul class="menu-sub initiator_files">
                        <li class="menu-item {{ request()->is('initiator-notes/create') ? 'active' : '' }}">
                            <a href="{{ route('initiator-notes.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">File Operation</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item initiator_notes {{ request()->is('initiator-note-attachments/create') ? 'active' : '' }}">
                            <a href="{{ route('initiator-note-attachments.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">File Review</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <li class="menu-item {{ request()->is('show-sent-to-review-file') ? 'active' : '' }}">
                        <a href="{{route('sent.to.review.file.show')}}" class="menu-link">
                            <i class="menu-icon bx bx-send"></i>
                            <div data-i18n="Sent_To"> Pending Activities </div>
                        </a>
                    </li>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Committee Activities</span>
                </li>
                <li class="menu-item {{ request()->is('show-file') ? 'active' : '' }}">
                    <a href="{{route('toc.file.show')}}" class="menu-link">
                        <i class="menu-icon bx bxs-group"></i>
                        <div data-i18n="TOC_Committee">Opening Committee Review</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('show-tec-file') ? 'active' : '' }}">
                    <a href="{{route('tec.file.show')}}" class="menu-link">
                        <i class="menu-icon bx bx-group"></i>
                        <div data-i18n="TEC_Committee">Evaluation Committee Review</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('show-receiving-file') ? 'active' : '' }}">
                    <a href="{{route('receiving.file.show')}}" class="menu-link">
                        <i class="menu-icon bx bx-group"></i>
                        <div data-i18n="TEC_Committee">Receiving Committee Review</div>
                    </a>
                </li> -->

                
                @can('Can Access Cost Management')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Cost Management</span>
                </li>
                
                <li class="menu-item all_item {{ request()->is('daily-costs') || request()->is('cost-types') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-wallet"></i>
                        <div data-i18n="Layouts">Cost Entry Management</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('daily-costs') ? 'active' : '' }}">
                            <a href="{{route('daily-costs.index')}}" class="menu-link">
                                <div data-i18n="report">
                                    Daily Cost
                                </div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('cost-types') ? 'active' : '' }}">
                            <a href="{{route('cost-types.index')}}" class="menu-link">
                                <!-- <i class="menu-icon bx bx-file"></i> -->
                                <div data-i18n="report">
                                    Cost Type
                                </div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Order Section</span>
                </li>
                
                <li class="menu-item all_item {{ request()->is('orders') || request()->is('orders') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-wallet"></i>
                        <div data-i18n="Layouts">Order Details</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('orders') ? 'active' : '' }}">
                            <a href="{{route('orders.index')}}" class="menu-link">
                                <div data-i18n="report">
                                    All Orders
                                </div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('Can Access Report')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Report Section</span>
                </li>
                <li class="menu-item intiator {{ request()->is('leisure-report') || request()->is('transactions') || request()->is('companies-record') ? 'open' : '' }}">
                        <li class="menu-item {{ request()->is('leisure-report') ? 'active' : '' }}">
                            <a href="{{route('leisure-report')}}" class="menu-link">
                                <!-- <i class="menu-icon bx bx-file"></i> -->
                                <div data-i18n="report">
                                    <i class="menu-icon bx bxs-report"></i>
                                    Leisure Report
                                </div>
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('transactions') ? 'active' : '' }}">
                            <a href="{{route('transactions.index')}}" class="menu-link">
                                <!-- <i class="menu-icon bx bx-file"></i> -->
                                <div data-i18n="report">
                                    <i class="menu-icon bx bx-file"></i>
                                    Transaction List
                                </div>
                            </a>
                        </li>
                        
                        <li class="menu-item {{ request()->is('companies-record') ? 'active' : '' }}">
                            <a href="{{route('company.records')}}" class="menu-link">
                                <!-- <i class="menu-icon bx bx-file"></i> -->
                                <div data-i18n="report">
                                    <i class="menu-icon bx bx-file"></i>
                                    Company Challan</div>
                            </a>
                        </li>
                </li>
                @endcan

                <!-- @if (Auth::user()->can('Can Access Setting'))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Settings Section</span>
                </li>

                <li class="menu-item {{ request()->is('settings') ? 'active' : '' }}">
                    <a href="{{route('settings')}}" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Settings</div>
                    </a>
                </li>

                @if (Auth::user()->can('Can Access Department'))
                <li class="menu-item {{ request()->is('departments/create') ? 'active' : '' }}">
                    <a href="{{route('departments.create')}}" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Department Head</div>
                    </a>
                </li>                
                @endif
                <li class="menu-item {{ request()->is('designations/index') ? 'active' : '' }}">
                    <a href="{{route('designations.index')}}" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Designation List</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('department/show') ? 'active' : '' }}">
                    <a href="{{route('department.show')}}" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Department List</div>
                    </a>
                </li>
                @endif -->

                <!-- @if (Auth::user()->can('Can Access Department'))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Head Section</span>
                </li>
                <li class="menu-item {{ request()->is('departments/create') ? 'active' : '' }}">
                    <a href="{{route('departments.create')}}" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Department Head</div>
                    </a>
                </li>
                @endif -->
            </ul>
        </aside>
        <!-- / Menu -->
