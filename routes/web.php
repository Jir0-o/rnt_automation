<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CostTypeController;
use App\Http\Controllers\TransactionController;
use App\Models\ReceivedProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseControlle;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\IssueVoucherController;
use App\Http\Controllers\FileCommitteeController;
use App\Http\Controllers\InitiatorFileController;
use App\Http\Controllers\InitiatorNoteController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ReceivedProductController;
use App\Http\Controllers\AllocatedProductController;
use App\Http\Controllers\AuthorizedPersonController;
use App\Http\Controllers\DailyCostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ForwardBackwardController;
use App\Http\Controllers\ProductStatisticsController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\RecieveInformationController;
use App\Http\Controllers\RequisitionProductController;
use App\Http\Controllers\InitiatorNoteReviewController;
use App\Http\Controllers\RecievedInformationController;
use App\Http\Controllers\TempReceivedProductController;
use App\Http\Controllers\TempAllocatedProductController;
use App\Http\Controllers\TempRequestedProductController;
use App\Http\Controllers\InitiatorNoteAttachmentController;
use App\Http\Controllers\NotificationController;
use App\Mail\ForgotPassword;
use App\Models\FileCommittee;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('forgot-password', ForgotPasswordController::class);

Route::get('/otp-verification-page', [ForgotPasswordController::class, 'otpVerificationPage'])->name('otp-verification-page');

Route::post('/otp-verification', [ForgotPasswordController::class, 'otpVerification'])->name('otp-verification');

Route::get('/reset-password-page/{token}/{email}', [ForgotPasswordController::class, 'resetPasswordPage'])->name('reset-password-page');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');

Route::get('/auth-authorisations/{id}', [InitiatorFileController::class, 'authNoteIndex'])->name('auth.authorisations');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //liveware routes
    Route::get('/livewire/{file}', function ($file) {
        $path = base_path("vendor/livewire/livewire/dist/{$file}");
    
        if (!File::exists($path)) {
            abort(404);
        }
    
        return Response::file($path);
    })->where('file', '.*');
    

    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::get('/profile/show',[UserController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/password',[UserController::class, 'changePassword'])->name('profile.password');
    Route::post('/settings/{id}', [SettingsController::class, 'updateSetting'])->name('settings.update');
    Route::get('/settings',[SettingsController::class, 'index'])->name('settings');
    Route::post('/settings',[SettingsController::class, 'store'])->name('settings.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    //category routes
    Route::get('/product/category/sub-categories/{id}', [ProductCategoryController::class, 'getSubCategories'])->name('product.category.sub-categories');
    Route::get('/product/{id}/', [ProductCategoryController::class, 'getProducts'])->name('product.category.products');

    //product routes
    Route::get('/product/request/list', [ProductController::class, 'getProductswithrequestQuantityNotNull'])->name('products.request.list');
    Route::post('/product/missing', [ProductController::class, 'productsMissing'])->name('products.missing');
    Route::get('/product/approve/{id}', [ProductController::class, 'productApprove'])->name('products.approve');
    Route::get('/product/reject/{id}', [ProductController::class, 'productReject'])->name('products.reject');

   //requisition routes
   Route::get('/generate-requisition', [RequisitionController::class, 'generateRequisition'])->name('requisitions.generate');
   Route::get('/requisition/create', [RequisitionController::class, 'createRequisition'])->name('requisitions.add');
   Route::POST('/requisition/noAuth', [RequisitionController::class, 'noAuthRequisition'])->name('requisitions.noAuth');
   Route::get('/requisition/reject/{id}', [RequisitionController::class, 'rejectRequisition'])->name('requisitions.reject');
   Route::get('/requisition/approve/{id}', [RequisitionController::class, 'acceptRequisition'])->name('requisitions.accept');
   Route::get('/requisition/loan/{id}', [RequisitionController::class, 'loanRequisition'])->name('requisitions.loan');
   Route::get('/requisition/auth/{id}', [RequisitionController::class, 'acceptAuthRequisition'])->name('auth.requisitions.accept');
   Route::post('/no/requisition/create', [RequisitionController::class, 'noRequisition'])->name('no.requisitions.add');
   Route::post('/no/requisition/edit', [RequisitionController::class, 'editNoRequisition'])->name('edit.no.requisitions.add');
   Route::post('requisition/draft', [RequisitionController::class, 'saveDraft'])->name('requisitions_draft.save');
   Route::post('requisitions/sent/{id}', [RequisitionController::class, 'sendDraft'])->name('requisitions.sent');
   Route::post('requisitions/auth/sent/{id}', [RequisitionController::class, 'sendNoAuthDraft'])->name('requisitions.noAuth.sent');
   Route::post('/requisitions/return/{id}', [RequisitionController::class, 'returnRequisition'])->name('requisitions.return');
   Route::get('/requisitions/edit/{id}', [RequisitionController::class, 'editRequisition'])->name('requisitionedit.show');
   Route::get('/requisitions/view/{id}', [RequisitionController::class, 'returnEditRequisition'])->name('requisition.return');
   Route::get('/requisition/new/return', [RequisitionController::class, 'tempreturnRequisition'])->name('temprequisitions.add');
   Route::post('/requisition/new/store', [RequisitionController::class, 'tempStore'])->name('temprequisitions.store');
   Route::get('/requisition/edit/return', [RequisitionController::class, 'tempreturnRequisition'])->name('requisition.returnEdit');
   Route::put('/requisitions/edit/update/{id}', [RequisitionController::class, 'editRequisitionUpdate'])->name('editReturnRequisition.Submit');
   Route::put('/requisitions/auth/update/{id}', [RequisitionController::class, 'editRequisitionNoAuth'])->name('editReturnRequisition.noAuth');
   Route::put('/requisitions/edit/save/{id}', [RequisitionController::class, 'saveRequisitionUpdate'])->name('saveReturnRequisition.Submit');
   Route::get('/requisitions/delete/{id}', [RequisitionController::class, 'sendDeleteRequisition'])->name('senddelete.requisition');
   Route::get('/invoice/{id}', [RequisitionController::class, 'invoiceShow'])->name('invoice.show');
   Route::get('/invoice/check-invoice-date/{id}', [RequisitionController::class, 'checkInvoiceDate'])->name('invoice.checkInvoiceDate');


    //product statics
    Route::get('statistics/today/allocations', [ProductStatisticsController::class, 'getTodaysAllocationQuantity'])->name('statistics.today.allocations');
    Route::get('statistics/today/sales', [ProductStatisticsController::class, 'getTodaysSales'])->name('statistics.today.sales');
    Route::get('statistics/month/allocations', [ProductStatisticsController::class, 'getMonthlyAllocationQuantity'])->name('statistics.month.allocations');
    Route::get('statistics/month/sales', [ProductStatisticsController::class, 'getMonthlySales'])->name('statistics.month.sales');
    Route::get('statistics/monthly', [ProductStatisticsController::class, 'getMonthlyReport'])->name('statistics.monthly');
    Route::get('statistics/yearly', [ProductStatisticsController::class, 'getYearlyReport'])->name('statistics.yearly');
    Route::get('statistics/monthly/cost', [ProductStatisticsController::class, 'getMonthlyCost'])->name('statistics.monthly.cost');
    Route::get('statistics/yearly/cost', [ProductStatisticsController::class, 'getYearlyCost'])->name('statistics.yearly.cost');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('user-records', UserController::class);
    Route::resource('requisitions', RequisitionController::class);
    Route::resource('allocations', AllocationController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('temp-requisition-products', TempRequestedProductController::class);
    Route::resource('temp-allocation-products', TempAllocatedProductController::class);
    Route::resource('requisition-products', RequisitionProductController::class);
    Route::resource('issue-vouchers', IssueVoucherController::class);
    Route::resource('products', ProductController::class);
    Route::resource('unit-types', UnitTypeController::class);
    Route::resource('product-sub-categories', ProductSubCategoryController::class);
    Route::resource('purchases', PurchaseControlle::class);
    Route::resource('temp-received-products', TempReceivedProductController::class);
    Route::resource('received-products', ReceivedProductController::class);
    Route::resource('allocated-products', AllocatedProductController::class);
    Route::resource('note-show', FileCommitteeController::class);
    Route::resource('notification', NotificationController::class);
    Route::resource('forward-backward', ForwardBackwardController::class);
    Route::resource('drafts', DraftController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('daily-costs', DailyCostController::class);
    Route::resource('cost-types', CostTypeController::class);
    Route::resource('transactions', TransactionController::class);

    //cost management
    Route::get('/get-cost-types', [DailyCostController::class, 'getCostTypes'])->name('get-cost-types');

    //company routes
    Route::get('/companies-record', [CompanyController::class, 'companyRecords'])->name('company.records');

    Route::post('/department/update', [DepartmentController::class, 'storeDeparment'])->name('department.update');


    Route::post('user-records/{id}/update', [UserController::class, 'updateUser'])->name('user-records.updateData');

    Route::get('received-products-reject/{id}', [ReceivedProductController::class, 'productReject'])->name('product-reject.reject');
    Route::get('received-products-accept/{id}', [ReceivedProductController::class, 'productApprove'])->name('product-accept.accept');

    Route::post('user-records/{id}/profile/update', [UserController::class, 'userProfileUpdate'])->name('user-records.update.profile');

    Route::get('products/createBarcode/{id}', [ProductController::class, 'createBarcode'])->name('products.createBarcode');
    Route::get('products/print-barcode/{id}', [ProductController::class, 'printBarcode'])->name('print.barcode');

    Route::get('/requisition/print/{id}', [RequisitionController::class, 'requisitionPrint'])->name('requisitions.print');
    Route::get('/invoice/print/{id}', [RequisitionController::class, 'invoicePrint'])->name('invoice.print');


    //file tracking
    Route::get('file-tracking', [ForwardBackwardController::class, 'fileTracking'])->name('file-tracking');

    //back forward
    Route::post('backward', [ForwardBackwardController::class, 'backward'])->name('backward');



    // =============================================
            // demand and tech committee
// ===========================
    Route::get('/createCommittee', [CommitteeController::class, 'createCommittee'])->name('create.committee.list');
    Route::get('/requisition/create-committee', [CommitteeController::class, 'index'])->name('requisitions.committee');
    Route::get('/requisition/create-committee-tech', [CommitteeController::class, 'indexTech'])->name('requisitions.tech.committee');
    Route::post('/committees/store', [CommitteeController::class, 'store'])->name('committees.store');
    Route::get('/allCommittee', [CommitteeController::class, 'allCommittee'])->name('allCommittee');
    Route::get('/demandCommittee', [CommitteeController::class, 'demandCommittee'])->name('demand.committee.list');
    Route::get('/techCommittee', [CommitteeController::class, 'techCommittee'])->name('tech.committee.list');

    Route::get('/demand-details/{id}', [CommitteeController::class,'getDemandDetails'])->name('demand.details');
    Route::put('/update-quantity', [CommitteeController::class, 'updateQuantity'])->name('update.quantity');
    Route::put('/update-quantity/tech', [CommitteeController::class, 'updateQuantitytech'])->name('update.quantity.tech');

    Route::get('demand-tech-committee', [CommitteeController::class, 'showDemanTechList'])->name('demand.tech.committee');
    Route::get('show-tech-committee', [CommitteeController::class, 'showTechCommittee'])->name('show.tech.committee');

    Route::post('committees/storeDemand', [CommitteeController::class,'storeDemand'])->name('committees.storeDemand');
    Route::post('committees/storeTech', [CommitteeController::class,'storeTech'])->name('committees.storeTech');


    Route::get('/pending/note', [AuthorizedPersonController::class, 'pendingNote'])->name('pending.note');
    Route::get('/pending/committee', [AuthorizedPersonController::class, 'pendingCommittee'])->name('pending.committee');


    // ==========================
    //     dpn and oce
    // ========================

    // dpm and oce committe
    Route::get('dpm-oce/{id}', [CommitteeController::class, 'oceIndex'])->name('dpm.oce');
    Route::post('create-oce-committee', [CommitteeController::class, 'createOceCommittee'])->name('create.oce.committee');


    // oce committee list
    Route::get('oce-committee-list', [CommitteeController::class, 'showOceList'])->name('oce.committee.list');
    Route::get('oce-add-product-values/{id}', [CommitteeController::class, 'oceProductValue'])->name('oce.add.product.values');

    Route::post('update-product-values/{rq_id}', [CommitteeController::class, 'updateProductValue'])->name('update.product.values');
    Route::get('oce-approval-list', [CommitteeController::class, 'oceApprovalList'])->name('oce.approval.list');

    Route::get('oce-product-list', [CommitteeController::class, 'oceProductList'])->name('oce.product.list');

    Route::get('approve-oce/{req_id}', [CommitteeController::class, 'approveOce'])->name('approve.oce');

    Route::post('reject-oce', [CommitteeController::class, 'rejectOce'])->name('reject.oce');

    Route::get('approved-oce', [CommitteeController::class, 'oceApprovedData'])->name('approved.oce');

    // is dpm
    Route::get('is-dpm/{id}', [CommitteeController::class, 'isDpm'])->name('isDpm');

    // create initiator
    Route::get('create-initiator/{id}', [InitiatorFileController::class, 'index'])->name('create.initiator');
    Route::post('add-initiator-file/{id}', [InitiatorFileController::class, 'create'])->name('add.initiator.file');
    Route::get('initiator-file', [InitiatorFileController::class, 'showInitiator'])->name('initiator.file');

    // show report
    Route::get('show-report/{id}', [CommitteeController::class, 'showReport'])->name('show.report');

    Route::get('show-committees', [CommitteeController::class, 'showcommittees'])->name('show.committees');

    Route::resource('initiator-notes', InitiatorNoteController::class);
    Route::resource('initiator-note-attachments', InitiatorNoteAttachmentController::class);
    Route::resource('initiator-note-reviews', InitiatorNoteReviewController::class);
    Route::resource('final-files', AuthorizedPersonController::class);
    Route::resource('initiator-files', InitiatorFileController::class);

    Route::get('/create-note/{id}', [CommitteeController::class, 'createNote'])->name('notes.create');
    Route::get('initiator-file/{id}/edit', [CommitteeController::class, 'initiatorFileEdit'])->name('initiator-file.edit');
    Route::put('/initiator-file/{id}', [CommitteeController::class, 'initiatorFileupdate'])->name('initiator-file.update');
    Route::get('file/operation', [CommitteeController::class, 'fileOperation'])->name('file-operation');

    Route::get('initiator-files/committee/{id}', [InitiatorFileController::class, 'committee'])->name('initiator-files.committee');
    Route::get('initiator-files/evaluation/committee/{id}', [InitiatorFileController::class, 'EvaluationCommittee'])->name('initiator-files.evaluation.committee');
    Route::post('initiator-files/accept', [InitiatorFileController::class, 'accept'])->name('initiator-files.accept');
    Route::post('committee-store', [InitiatorFileController::class, 'committeeStore'])->name('committee.store');
    Route::post('initiator-files/reject', [InitiatorFileController::class, 'reject'])->name('initiator-files.reject');
    Route::get('committee-check/{id}', [InitiatorFileController::class, 'checkTOCAndTECCommitteeExist'])->name('committee.check');


    // purches demand
    Route::post('purchases-demand', [CommitteeController::class, 'purchasesStore'])->name('purchases.demand');

    // note review
    Route::get('show-review/{id}', [InitiatorNoteAttachmentController::class, 'reviewShow'])->name('show.review');

    //toc committee review
    Route::get('toc/show-review/{id}', [InitiatorNoteAttachmentController::class, 'toc_review_show'])->name('toc.show.review');
    Route::get('show-file', [InitiatorNoteAttachmentController::class, 'toc_committee_file'])->name('toc.file.show');
    Route::post('toc-forward', [ForwardBackwardController::class, 'toc_forward'])->name('toc.forward');
    Route::post('toc-backward', [ForwardBackwardController::class, 'toc_backward'])->name('toc.backward');

    //tec committee review
    Route::get('tec/show-review/{id}', [InitiatorNoteAttachmentController::class, 'tec_review_show'])->name('tec.show.review');
    Route::get('show-tec-file', [InitiatorNoteAttachmentController::class, 'tec_committee_file'])->name('tec.file.show');
    Route::post('tec-forward', [ForwardBackwardController::class, 'tec_forward'])->name('tec.forward');
    Route::post('tec-backward', [ForwardBackwardController::class, 'tec_backward'])->name('tec.backward');

    //receiving committee review
    Route::get('receiving/show-review/{id}', [InitiatorNoteAttachmentController::class, 'receiving_review_show'])->name('receiving.show.review');
    Route::get('show-receiving-file', [InitiatorNoteAttachmentController::class, 'receiving_committee_file'])->name('receiving.file.show');
    Route::post('receiving-forward', [ForwardBackwardController::class, 'receiving_forward'])->name('receiving.forward');
    Route::post('receiving-backward', [ForwardBackwardController::class, 'receiving_backward'])->name('receiving.backward');

    //sent to review
    Route::get('sent-to-review/{id}', [InitiatorNoteAttachmentController::class, 'sent_to_review_show'])->name('sent.to.review');
    Route::get('show-sent-to-review-file', [InitiatorNoteAttachmentController::class, 'sent_to_file'])->name('sent.to.review.file.show');
    Route::post('sent-to-review-forward', [ForwardBackwardController::class, 'sent_to_review_forward'])->name('sent.to.review.forward');
    Route::post('/sent-to', [InitiatorNoteAttachmentController::class, 'sentTo'])->name('sent.to');
    Route::post('sent-to-committee/{file_id}/committee/{committee_id}', [InitiatorNoteAttachmentController::class, 'sentToCommittee'])->name('sent.to.committee');

    // committ update
    Route::get('/option/{id}', [CommitteeController::class, 'option'])->name('option');
    Route::get('/update-committee-page/{id}', [CommitteeController::class, 'updateCommitteePage'])->name('update-committee-page');
    Route::put('/update-committee/{id}', [CommitteeController::class, 'updateCommittee'])->name('update-committee');


    // leisure report
    Route::get('/leisure-report', [CommitteeController::class, 'leisureReport'])->name('leisure-report');
    Route::get('/audit-report', [CommitteeController::class, 'auditReport'])->name('audit-report');

    Route::get('/print-pass-approve/{id}', [CommitteeController::class, 'printPassApprove'])->name('print.pass.approve');
    Route::get('/print-product/{product_id}', [CommitteeController::class, 'printAuditReport'])->name('product.print');

    //requisition update
    Route::put('/requisitions/update-number/{id}', [RequisitionController::class, 'updateRequisitionNumber'])->name('requisitions.number.update');

    //invoice Update
    Route::put('/invoice/update-number/{id}', [RequisitionController::class, 'updateInvoiceNumber'])->name('invoice.number.update');

    //order Update
    Route::put('/order/update-number/{id}', [RequisitionController::class, 'updateOrderNumber'])->name('order.number.update');

        //return report
    Route::get('/return-report', [CommitteeController::class, 'returnReport'])->name('return.report');
    Route::post('/get-products-by-requisition', [CommitteeController::class, 'getProductsByRequisition'])->name('get.products.by.requisition');
    Route::post('/update-product-return', [CommitteeController::class, 'updateProductReturn'])->name('update.product.return');


    Route::get('/product-sub-categories/category/{categoryId}', [ProductCategoryController::class, 'getByCategory'])->name('product-sub-categories.by-category');
    Route::get('/fetch-product-categories', [ProductCategoryController::class, 'catagory'])->name('product-categories.catagory');
    Route::get('/vc-approve', [CommitteeController::class, 'vcApprove'])->name('vc.approve');
    Route::post('/vc/approved/{id}', [CommitteeController::class, 'vcApproved'])->name('vc.approved');
    Route::get('/tech-details/{id}', [CommitteeController::class,'getTechDetails'])->name('tech.details');
    Route::get('oce-send-product-values/{id}', [CommitteeController::class, 'oceSendValue'])->name('oce.send');
    Route::post('/vc-approved/tech/{id}', [CommitteeController::class, 'vcApprovedTech'])->name('vc.approved.tech');

    Route::get('/committee/report/{id}/{requisition_id}', [CommitteeController::class, 'generateReport'])->name('committee.report');
    Route::get('/committee/demand-report/{id}/{requisition_id}', [CommitteeController::class, 'generateDemandReport'])->name('committee.demandReport');

    Route::get('/demand-details/demand/{id}', [CommitteeController::class,'getDemandDetailsShow'])->name('demand.details.show');
    Route::get('/demand-details/tech/{id}', [CommitteeController::class,'getTechDetailsShow'])->name('demand.tech.show');

    //last update commitee report Route
    Route::put('/demand-details/send', [CommitteeController::class,'demandSend'])->name('send.demand');
    Route::put('/tech-details/send', [CommitteeController::class,'techSend'])->name('send.tech');
    Route::get('/defaultCommittee', [CommitteeController::class,'defaultCommittee'])->name('defaultCommittee');
    Route::get('/defaultCommittee/create', [CommitteeController::class,'defaultCommitteeCreate'])->name('create.default.committee');
    Route::post('/store-default-committee', [CommitteeController::class, 'defaultStore'])->name('store.default.committee');
    Route::get('/committee/send/{id}', [CommitteeController::class, 'send'])->name('send.committee');
    Route::get('/oce/committee/report/{id}/{requisition_id}', [CommitteeController::class, 'OCEgenerateReport'])->name('oce.committee.report');
    Route::post('/committee/send/{committee_id}/{signature_id}', [CommitteeController::class, 'Reportsend'])->name('committee.send');
    Route::post('/committee/send/{id}', [CommitteeController::class, 'DemandReportsend'])->name('committee.send.demand');
    Route::post('/committee/tech/send/{id}', [CommitteeController::class, 'techReportsend'])->name('committee.send.tech');

    //vc reject
    Route::post('/vc/reject-tech/{id}', [CommitteeController::class, 'rejectTech'])->name('vc.reject.tech');
    Route::post('/committee/reject-tech-chairman/{id}', [CommitteeController::class, 'rejectTechChairman'])->name('reject.tech.chairman');
    Route::post('/vc/reject-demand/{id}', [CommitteeController::class, 'rejectDemand'])->name('vc.reject.demand');
    Route::post('/committee/reject-demand-chairman/{id}', [CommitteeController::class, 'rejectDemandChairman'])->name('reject.demand.chairman');
    Route::post('/vc/reject-oce/{id}', [CommitteeController::class, 'rejectoceVc'])->name('vc.reject.oce');
    Route::post('/committee/reject-oce-chairman/{id}', [CommitteeController::class, 'rejectOceChairman'])->name('reject.oce.chairman');

    //note print
    Route::get('/note-print', function () {
        return view('backend.initiator_file.print_note');
    })->name('note-print');

    //Draft
    Route::get('/files/drafts', [FileCommitteeController::class, 'fileDraft'])->name('drafts.file');
    Route::get('/drafts/file/edit/{id}', [InitiatorFileController::class, 'editDraft'])->name('drafts.edit');
    Route::post('/draft/file/save/{id}', [InitiatorFileController::class, 'savefileDraft'])->name('file.draft.save');
    Route::post('/draft/file/update/{id}', [InitiatorFileController::class, 'updateFileDraft'])->name('updateDraft');
    Route::get('/draft/file/send/{id}', [InitiatorFileController::class, 'sendFileDraft'])->name('send.File.Draft');

    //designations routes
    Route::get('/designations', [CommitteeController::class, 'designationsIndex'])->name('designations.index');
    Route::post('/designations/update', [CommitteeController::class, 'designationsUpdate'])->name('designations.update');
    Route::post('/designations/delete', [CommitteeController::class, 'designationsDelete'])->name('designations.delete');
    Route::post('/designations/store', [CommitteeController::class, 'designationsStore'])->name('designations.store');

    // department routes
    Route::get('department/show', [DepartmentController::class, 'departmentShow'])->name('department.show');
    Route::post('/department/add', [DepartmentController::class, 'departmentStore'])->name('department.new.store');
    Route::get('department/show/{id}', [DepartmentController::class, 'departmentEditShow'])->name('department.edit.show');
    Route::put('department/show/edit/{id}', [DepartmentController::class, 'departmentUpdate'])->name('department.edit.update');
    Route::get('department/delete/{id}', [DepartmentController::class, 'departmentDestroy'])->name('department.delete');

    // save Draft routes
    Route::put('/requisitions/draft/edit/save/{id}', [RequisitionController::class, 'saveDraft_submit'])->name('saveDraftRequisition');
    Route::get('/requisitions/draft/delete/{id}', [RequisitionController::class, 'deleteDraft_submit'])->name('requisitions.delete');

    //draft note send
    Route::post('/draft/file/send/draft', [InitiatorFileController::class, 'draftSendFileDraft'])->name('draft.send.File.Draft');


    //Debit Authorisations routes
    Route::get('/debit-authorisations/{id}', [InitiatorFileController::class, 'debitAuthorisationIndex'])->name('debit.authorisations.index');
    Route::PUT('/debit-authorisations/update/{id}', [InitiatorFileController::class, 'debitAuthorisationUpdate'])->name('debit.authorisations.update');
    Route::post('/debit-authorisations/store/{id}', [InitiatorFileController::class, 'debitAuthorisationStore'])->name('debit.authorisations.store');
    Route::post('/debit-authorisations/accept/{id}', [InitiatorFileController::class, 'debitAuthorisationAccept'])->name('debit.authorisations.Accept');
    Route::post('/debit-authorisations/reject/{id}', [InitiatorFileController::class, 'debitAuthorisationReject'])->name('debit.authorisations.Reject');
    Route::post('/debit-authorisations/return/{id}', [InitiatorFileController::class, 'debitAuthorisationReturn'])->name('debit.authorisations.return');
    Route::get('/debit-authorisations/edit/{id}', [InitiatorFileController::class, 'debitAuthorisationEdit'])->name('debit.authorisations.edit');
    Route::get('/print-data/{id}', [InitiatorFileController::class, 'getPrintData'])->name('debit.authorisations.print');

});
