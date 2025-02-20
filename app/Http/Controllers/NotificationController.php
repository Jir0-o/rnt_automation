<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Committee;
use App\Models\ImportantPurchase;
use App\Models\InitiatorFile;
use App\Models\InitiatorNote;
use App\Models\IssueVoucher;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCommittee;
use App\Models\ProductSubCategory;
use App\Models\RecievedInformation;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $newRequisitionsCount = Requisition::where('status', 1)
        //     ->count();

        // $newAllocationCount = Allocation::where('is_active', 1)
        //     ->count();
        
        // $newIssueCount = IssueVoucher::where('status', 0)
        //     ->count();

        // $newRequestProductCount = RecievedInformation::where('status', 0)
        //     ->count();
        
        // $newProductCount = Product::where('is_active', 1)
        //     ->count();
        
        // $newCategoriesCount = ProductCategory::where('is_active', 1)
        //     ->count();
        
        // $newSubCategoriesCount = ProductSubCategory::where('is_active', 1)
        //     ->count();
        
        // $newIntiatorFileCount = InitiatorFile::where('initiator_id', Auth::user()->id)->where('status', 0)
        //     ->count();
        
        // $file = InitiatorFile::where(function ($query) {
        //     $query->where('is_complete', 0);
        // })->where('status', 1)
        // ->where('initiator_id', Auth::user()->id)
        // ->with('initiatorNotes.initiator')
        // ->first();
        
        // $currentUserId = auth()->user()->id;

        // if($file){
        //     if($file->initiatorNotes){
        //         $notApprovedNotesCount = $file->initiatorNotes->filter(function ($note) use ($currentUserId) {
        //             $reviewStatus = json_decode($note->review_status, true);
        //             return !isset($reviewStatus[$currentUserId]) || $reviewStatus[$currentUserId] !== 'approved';
        //         })->count();
        //     } else {
        //         $notApprovedNotesCount = 0;
        //     }
        // } else {
        //     $notApprovedNotesCount = 0;
        // }

        // $newNoteApplovalCount = InitiatorNote::where('status', 1)
        //     ->where('review_status', !null)
        //     ->count();

        // $newImportPurchaseCount = ImportantPurchase::where('status', 0)
        //     ->count();

        // $DemandCommittee = Committee::where('committee_type', 'Demand')->get();

        // $newDemandCommitteeCount = $DemandCommittee->filter(function ($committee) {
        //     return ($committee->secretary == Auth::user()->id || $committee->chairman_id == Auth::user()->id) && ($committee->status == 1 || $committee->status == 11);
        // })->count();

        // $TecCommittee = Committee::where('committee_type', 'Tech')->get();

        // $newTechCommitteeCount = $TecCommittee->filter(function ($committee) {
        //     return ($committee->secretary == Auth::user()->id || $committee->chairman_id == Auth::user()->id) && ($committee->status == 1 || $committee->status == 13);
        // })->count();

        // $newDemandAndTechCommitteeCount = ProductCommittee::where('is_dpm', 0)
        // ->distinct('requisition_id') // Ensure we're counting unique requisition_ids
        // ->count('requisition_id'); // Count the distinct requisition_ids

        // $newOCESecretaryCommittee = Committee::where('committee_type', 'OCE')->get();

        // $newOCECommitteeCount = $newOCESecretaryCommittee->filter(function ($committee) {
        //     return ($committee->secretary == Auth::user()->id || $committee->chairman_id == Auth::user()->id) && ($committee->status == 3 || $committee->status == 4 || $committee->status == 7);
        // })->count();

        // $newFileCommittee = Committee::where('committee_type', 'OCE')->get();

        // $newFileCommitteeCount = $newFileCommittee->filter(function ($committee) {
        //     return $committee->status == 6;
        // })->count();
        

        // $newOCEApprovalCount =  $newFileCommittee->filter(function ($committee) {
        //     return $committee->status == 5;
        // })->count();

        // return response()->json([
        //     'newRequisitionsCount' => $newRequisitionsCount,
        //     'newAllocationCount' => $newAllocationCount,
        //     'newIssueCount' => $newIssueCount,
        //     'newRequestProductCount' => $newRequestProductCount,
        //     'newProductCount' => $newProductCount,
        //     'newProductCategoryCount' => $newCategoriesCount,
        //     'newProductSubCategoryCount' => $newSubCategoriesCount,
        //     'newIntiatorFileCount' => $newIntiatorFileCount,
        //     'notApprovedNotesCount' => $notApprovedNotesCount,
        //     'newNoteApprovalCount' => $newNoteApplovalCount,
        //     'newImportPurchaseCount' => $newImportPurchaseCount,
        //     'newDemandCommitteeCount' => $newDemandCommitteeCount,
        //     'newTechCommitteeCount' => $newTechCommitteeCount,
        //     'newDemandAndTechCommitteeCount' => $newDemandAndTechCommitteeCount,
        //     'newOCECommitteeCount' => $newOCECommitteeCount,
        //     'newFileCommitteeCount' => $newFileCommitteeCount,
        //     'newOCEApprovalCount' => $newOCEApprovalCount,
        // ]);

        try {
            $notifications = Notification::where('to_user_id', Auth::user()->id)
                ->orderBy('is_active', 'desc')  // This ensures active notifications (1) come first
                ->orderBy('created_at', 'desc')  // Then, order by creation date for each set
                ->with(['fromUserNotification' => function ($query) {
                    $query->select('id', 'profile_photo_path'); // Ensure profile_photo_path is selected
                }, 'toUserNotification'])
                ->take(50)  // Limit to the last 50 notifications
                ->get();

                if($notifications->isEmpty()){
                    return response()->json([
                        'status' => false,
                        'message' => 'No notifications found',
                        'data' => []
                    ]);
                }

                $notificationActive = Notification::where('to_user_id', Auth::user()->id)
                    ->where('is_active', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();

            return response()->json([
                'status' => true,
                'message' => 'Notifications fetched successfully',
                'data' => $notifications,
                'active' => $notificationActive
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch notifications',
                'data' => []
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $notifications = Notification::where('to_user_id', Auth::user()->id)
                ->get();
                
            if($notifications->isNotEmpty()){
                foreach ($notifications as $notification) {
                    $notification->update([
                        'is_active' => 0
                    ]);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Notifications updated successfully',
                    'data' => $notifications
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'No notifications found',
                'data' => []
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update notifications',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $notification = Notification::where('id', $id)
                ->with(['fromUserNotification' => function ($query) {
                    $query->select('id', 'profile_photo_path'); // Ensure profile_photo_path is selected
                }, 'toUserNotification'])
                ->first();

            if(!$notification){
                return response()->json([
                    'status' => false,
                    'message' => 'Notification not found',
                    'data' => []
                ]);
            }

            $notification->update([
                'is_active' => 0
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Notification fetched successfully',
                'data' => $notification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch notification',
                'data' => []
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
