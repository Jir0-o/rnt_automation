        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="<?php echo e(route('dashboard')); ?>" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <path
                                    d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                    id="path-1"></path>
                                <path
                                    d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                    id="path-3"></path>
                                <path
                                    d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                    id="path-4"></path>
                                <path
                                    d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                    id="path-5"></path>
                            </defs>
                            <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                    <g id="Icon" transform="translate(27.000000, 15.000000)">
                                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                                            <mask id="mask-2" fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <use fill="#696cff" xlink:href="#path-1"></use>
                                            <g id="Path-3" mask="url(#mask-2)">
                                                <use fill="#696cff" xlink:href="#path-3"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                            </g>
                                            <g id="Path-4" mask="url(#mask-2)">
                                                <use fill="#696cff" xlink:href="#path-4"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                            </g>
                                        </g>
                                        <g id="Triangle"
                                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                            <use fill="#696cff" xlink:href="#path-5"></use>
                                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2">Store</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Dashboard Section</span>
                </li>
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <!-- Layouts -->
                <?php if(Auth::user()->can('Can Access Inventory Manu')): ?>
                <li class="menu-item operation">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cart"></i>
                        <div data-i18n="Layouts">Operation</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        <?php if(Auth::user()->can('Can Access Requisitions')): ?>
                        <li class="menu-item requisitions">
                            <a href="<?php echo e(route('requisitions.create')); ?>" class="menu-link">
                                <div data-i18n="Without menu">Requisitions</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('Can Access Allocations')): ?>
                        <li class="menu-item allocations">
                            <a href="<?php echo e(route('allocations.create')); ?>" class="menu-link">
                                <div data-i18n="Without menu">Allocations</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('Can Access Purchase Invoice')): ?>
                        <li class="menu-item">
                            <a href="<?php echo e(route('purchases.create')); ?>" class="menu-link">
                                <div data-i18n="Without menu">Purchase Invoice</div>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if(Auth::user()->can('Can Access Approved List Manu')): ?>
                <li class="menu-item approved">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-check"></i>
                        <div data-i18n="Layouts">Approved List</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        <!-- <?php if(Auth::user()->can('Can Access Allocation List')): ?>
                        <li class="menu-item allocation_list">
                            <a href="<?php echo e(route('allocations.approve')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Allocations List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?> -->
                        <?php if(Auth::user()->can('Can Access Issue List')): ?>
                        <li class="menu-item issue">
                            <a href="<?php echo e(route('issue-vouchers.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Issue List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('Can Access Product List')): ?>
                        <li class="menu-item request_product">
                            <a href="<?php echo e(route('products.request.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Request Product List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if(Auth::user()->can('Can Access Category & Item Menu')): ?>
                <li class="menu-item all_item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-store"></i>
                        <div data-i18n="Layouts">Caregory & Item</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <ul class="menu-sub">
                        <?php if(Auth::user()->can('Can Access Product')): ?>
                        <li class="menu-item products">
                            <a href="<?php echo e(route('products.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Product</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('Can Access Category')): ?>
                        <li class="menu-item product_categories">
                            <a href="<?php echo e(route('product-categories.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Category</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('Can Access Sub Category')): ?>
                        <li class="menu-item product_sub_categories">
                            <a href="<?php echo e(route('product-sub-categories.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Sub Category</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        
                        <li class="menu-item unit_types">
                            <a href="<?php echo e(route('unit-types.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Unit Type</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Demand Section</span>
                </li>

                <li class="menu-item purchase_demand">

                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-check"></i>
                        <div data-i18n="Layouts">Purchase Demand</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>

                    <ul class="menu-sub">
                        <?php if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin'): ?>
                        <li class="menu-item purchase_demand_list">
                            <a href="<?php echo e(route('allCommittee')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">All Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item purchase_demand_list">
                            <a href="<?php echo e(route('defaultCommittee')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Default Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item purchase_demand_list">
                            <a href="<?php echo e(route('create.committee.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Purchase Demand List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->designation_id != 3): ?>
                        <li class="menu-item demand_committee">
                            <a href="<?php echo e(route('demand.committee.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Demand Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <li class="menu-item tech_committee">
                            <a href="<?php echo e(route('tech.committee.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Tech Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin'): ?>
                        <li class="menu-item demand_tech_committee">
                            <a href="<?php echo e(route('show.committees')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Demand & Tech Committee List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->designation_id != 3): ?>
                        <li class="menu-item oce_committee">
                            <a href="<?php echo e(route('oce.committee.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">OCE Committee</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>

                        
                        <?php if(auth()->user()->designation_id == 3): ?>
                        <li class="menu-item oce_approval">
                            <a href="<?php echo e(route('oce.approval.list')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">OCE Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>

                        <li class="menu-item oce_approval">
                            <a href="<?php echo e(route('vc.approve')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Demand and Tec Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>

                        
                        <?php if(auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin'): ?>
                        <li class="menu-item approved_oce_list">
                            <a href="<?php echo e(route('approved.oce')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Approved OCE List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Intiator Section</span>
                </li>
                <li class="menu-item intiator">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-store"></i>
                        <div data-i18n="Layouts">Intiator Activity</div>
                        <span class="badge bg-danger ms-auto"></span>
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access File Approved List')): ?>
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item">
                            <a href="<?php echo e(route('drafts.file')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">File Draft List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item">
                            <a href="<?php echo e(route('file-operation')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">File Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub initiator_files_approval">
                        <li class="menu-item">
                            <a href="<?php echo e(route('file-tracking')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">File Tracking</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <ul class="menu-sub initiator_files">
                        <li class="menu-item">
                            <a href="<?php echo e(route('initiator-notes.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">File Operation</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item initiator_notes">
                            <a href="<?php echo e(route('initiator-note-attachments.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">File Note Review</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- <ul class="menu-sub">
                        <li class="menu-item initiator_note_approval">
                            <a href="<?php echo e(route('initiator-note-reviews.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Note Approval List</div>
                                <span class="badge bg-danger ms-auto"></span>
                            </a>
                        </li>
                    </ul> -->
                    <!-- <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo e(route('final-files.create')); ?>" class="menu-link">
                                <div data-i18n="Without navbar">Final File Review</div>
                            </a>
                        </li>
                    </ul> -->
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Committee Review Section</span>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('toc.file.show')); ?>" class="menu-link">
                        <i class="menu-icon bx bxs-group"></i>
                        <div data-i18n="TOC_Committee">Opening Committee Review</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('tec.file.show')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-group"></i>
                        <div data-i18n="TEC_Committee">Evaluation Committee Review</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('receiving.file.show')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-group"></i>
                        <div data-i18n="TEC_Committee">Receiving Committee Review</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('sent.to.review.file.show')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-send"></i>
                        <div data-i18n="Sent_To"> Sent To </div>
                    </a>
                </li>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access File Approved List')): ?>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Report Section</span>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('leisure-report')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-file"></i>
                        <div data-i18n="report">Store Register</div>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->can('Can Access Setting')): ?>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Settings Section</span>
                </li>
                <!-- Settings -->
                <li class="menu-item">
                    <a href="<?php echo e(route('settings')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Settings</div>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(Auth::user()->can('Can Access Department')): ?>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Head Section</span>
                </li>
                <!-- Settings -->
                <li class="menu-item">
                    <a href="<?php echo e(route('departments.create')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Department Head</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('designations.index')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Designation List</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo e(route('department.show')); ?>" class="menu-link">
                        <i class="menu-icon bx bx-cog"></i>
                        <div data-i18n="Settings">Department List</div>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </aside>
        <!-- / Menu -->


        <!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    // Fetch notification counts periodically
    setInterval(fetchNotificationCounts, 30000); // Fetch every 30 seconds

    function fetchNotificationCounts() {
        $.ajax({
            url: "<?php echo e(route('notification.index')); ?>",
            method: 'GET',
            success: function(response) {
                updateNotificationCounts(response);
            },
            error: function(error) {
                console.error('Error fetching notification counts:', error);
            }
        });
    }

    function updateNotificationCounts(data) {
        // Update the badges with the fetched counts
        if (data.newRequisitionsCount > 0) {
            updateBadge('.requisitions .badge.bg-danger', data.newRequisitionsCount);
        } else {
            updateBadge('.requisitions .badge.bg-danger', '');
        }
        if (data.newAllocationCount > 0) {
            updateBadge('.allocations .badge.bg-danger', data.newAllocationCount);
        } else {
            updateBadge('.allocations .badge.bg-danger', '');
        }
        if (data.newRequisitionsCount || data.newAllocationCount > 0) {
            updateBadge('.operation .badge.bg-danger', data.newRequisitionsCount + data
                .newAllocationCount);
        } else {
            updateBadge('.operation .badge.bg-danger', '');
        }

        if (data.newIssueCount > 0) {
            updateBadge('.issue .badge.bg-danger', data.newIssueCount);
        } else {
            updateBadge('.issue .badge.bg-danger', '');
        }

        function updateBadge(selector, count) {
            const badge = document.querySelector(selector);
            if (badge) {
                badge.innerText = count > 0 ? count : '';
            }
        }

        if (data.newRequestProductCount !== undefined) {
            updateBadge('.request_product .badge.bg-danger', data.newRequestProductCount);
        }

        if (data.newIssueCount !== undefined || data.newRequestProductCount !== undefined) {
            const totalApprovedCount = (data.newIssueCount || 0) + (data.newRequestProductCount || 0);
            updateBadge('.approved .badge.bg-danger', totalApprovedCount);
        }

        if (data.newProductCount !== undefined) {
            updateBadge('.products .badge.bg-danger', data.newProductCount);
        }

        if (data.newProductCategoryCount !== undefined) {
            updateBadge('.product_categories .badge.bg-danger', data.newProductCategoryCount);
        }

        if (data.newProductSubCategoryCount !== undefined) {
            updateBadge('.product_sub_categories .badge.bg-danger', data.newProductSubCategoryCount);
        }

        if (data.newProductCount !== undefined || data.newProductCategoryCount !== undefined || data
            .newProductSubCategoryCount !== undefined) {
            const totalAllItemCount = (data.newProductCount || 0) + (data.newProductCategoryCount || 0) + (data
                .newProductSubCategoryCount || 0);
            updateBadge('.all_item .badge.bg-danger', totalAllItemCount);
        }


        if (data.newIntiatorFileCount !== undefined) {
            updateBadge('.initiator_files .badge.bg-danger', data.newIntiatorFileCount);
        } else {
            updateBadge('.initiator_files .badge.bg-danger', '');
        }

        if (data.notApprovedNotesCount !== undefined) {
            updateBadge('.initiator_notes .badge.bg-danger', data.notApprovedNotesCount);
        } else {
            updateBadge('.initiator_notes .badge.bg-danger', '');
        }

        if (data.newNoteApprovalCount !== undefined) {
            updateBadge('.initiator_note_approval .badge.bg-danger', data.newNoteApprovalCount);
        } else {
            updateBadge('.initiator_note_approval .badge.bg-danger', '');
        }

        // Ensure both values are numbers and then sum them
        const totalNewNotesCount = (data.newNoteApprovalCount || 0) + (data.notApprovedNotesCount || 0) + (data
            .newIntiatorFileCount || 0);

        if (totalNewNotesCount > 0) {
            updateBadge('.intiator .badge.bg-danger', totalNewNotesCount);
        } else {
            updateBadge('.intiator .badge.bg-danger', '');
        }

        if (data.newImportPurchaseCount !== undefined) {
            updateBadge('.purchase_demand_list .badge.bg-danger', data.newImportPurchaseCount);
        } else {
            updateBadge('.purchase_demand_list .badge.bg-danger', '');
        }

        if (data.newDemandCommitteeCount !== undefined) {
            updateBadge('.demand_committee .badge.bg-danger', data.newDemandCommitteeCount);
        } else {
            updateBadge('.demand_committee .badge.bg-danger', '');
        }

        if (data.newTechCommitteeCount !== undefined) {
            updateBadge('.tech_committee .badge.bg-danger', data.newTechCommitteeCount);
        } else {
            updateBadge('.tech_committee .badge.bg-danger', '');
        }

        if (data.newDemandAndTechCommitteeCount !== undefined) {
            updateBadge('.demand_tech_committee .badge.bg-danger', data.newDemandAndTechCommitteeCount);
        } else {
            updateBadge('.demand_tech_committee .badge.bg-danger', '');
        }

        if (data.newOCECommitteeCount !== undefined) {
            updateBadge('.oce_committee .badge.bg-danger', data.newOCECommitteeCount);
        } else {
            updateBadge('.oce_committee .badge.bg-danger', '');
        }

        if (data.newFileCommitteeCount !== undefined) {
            updateBadge('.approved_oce_list .badge.bg-danger', data.newFileCommitteeCount);
        } else {
            updateBadge('.approved_oce_list .badge.bg-danger', '');
        }

        if (data.newOCEApprovalCount !== undefined) {
            updateBadge('.oce_approval .badge.bg-danger', data.newOCEApprovalCount);
        } else {
            updateBadge('.oce_approval .badge.bg-danger', '');
        }

        var totalDemandCount = (data.newImportPurchaseCount || 0) + (data.newDemandCommitteeCount || 0) + (data
            .newTechCommitteeCount || 0) + (data.newDemandAndTechCommitteeCount || 0) + (data.newOCECommitteeCount ||
            0) + (data.newFileCommitteeCount || 0) + (data.newOCEApprovalCount || 0);

        if (totalDemandCount > 0) {
            updateBadge('.purchase_demand .badge.bg-danger', totalDemandCount);
        } else {
            updateBadge('.purchase_demand .badge.bg-danger', '');
        }
    }

    fetchNotificationCounts();
});
        </script> -->
<?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/includes/side-nav.blade.php ENDPATH**/ ?>