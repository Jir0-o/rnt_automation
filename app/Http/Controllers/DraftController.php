<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file_id' => 'required|exists:initiator_files,id',
                'note' => 'nullable|string',
                'date' => 'nullable|date',
                'files.*' => 'file|max:2048', // Adjust the validation rules as needed
                'dynamicValues*' => 'nullable',
                'dynamicValues.*.note' => 'nullable|string',
                'dynamicValues.*.date' => 'nullable',
                'dynamicValues..files.' => 'nullable|file|max:2048',
            ]);
        
            if($request->has('note') && $request->has('date') && $request->has('files') ) {
                // Create the InitiatorNote
                $initiatorNote = new Draft();
                $initiatorNote->file_id = $request->file_id;
                $initiatorNote->note = $request->note;
                $initiatorNote->date = $request->date;
                $initiatorNote->user_id = auth()->user()->id;
            
                $files = []; // Initialize an array to hold file names
            
                // Handle multiple file uploads
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(base_path('public/global_assets/initiator_notes'), $fileName);
            
                        $files[] = $fileName; // Add the file name to the array
                    }
                }
            
                $initiatorNote->attachment = implode(', ', $files); // Convert the array to a comma-separated string
                $initiatorNote->save();   
            }
        
            // Handle multiple dynamicValues
            $dynamicValues = json_decode($request->input('dynamicValues'), true);
        
            if ($dynamicValues) {
                foreach ($dynamicValues as $dynamicValue) {
                    $dynamicNote = new Draft();
                    $dynamicNote->file_id = $request->file_id;
                    $dynamicNote->note = $dynamicValue['note'];
                    $dynamicNote->date = $dynamicValue['date'];
                    $dynamicNote->user_id = auth()->user()->id;
        
                    $dynamicFiles = []; // Re-initialize the array for dynamic files
        
                    // // Handle multiple file uploads within dynamicValues
                    // if (array_key_exists('files', $dynamicValue)) {
                    //     Log::info('Files exist in dynamicValues');
                    //     foreach ($dynamicValue['files'] as $file) {
                    //         // Check if $file is an array (in case of nested structure)
                    //         if (is_array($file)) {
                    //             Log::info('File is an array');
                    //             foreach ($file as $nestedFile) {
                    //                 $fileName = time() . '_' . uniqid() . '.' . $nestedFile->getClientOriginalExtension();
                    //                 $nestedFile->move(base_path('public/global_assets/initiator_notes'), $fileName);
        
                    //                 $dynamicFiles[] = $fileName; // Add the file name to the array
                    //             }
                    //         } else {
                    //             Log::info('File is not an array');
                    //             // If $file is not an array, handle it directly
                    //             $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    //             $file->move(base_path('public/global_assets/initiator_notes'), $fileName);
        
                    //             $dynamicFiles[] = $fileName; // Add the file name to the array
                    //         }
                    //     }
        
                    //     $dynamicNote->attachment = implode(', ', $dynamicFiles); // Convert the array to a comma-separated string
                    //     $dynamicNote->save();
                    // }

                    // Handle multiple file uploads within dynamicValues
                    if (array_key_exists('files', $dynamicValue) && is_array($dynamicValue['files'])) {
                        foreach ($dynamicValue['files'] as $file) {
                            // Check if $file is an instance of UploadedFile
                            if ($file instanceof \Illuminate\Http\UploadedFile) {
                                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                $file->move(base_path('public/global_assets/initiator_notes'), $fileName);
                                $dynamicFiles[] = $fileName;
                            }
                        }
                    }

                    $dynamicNote->attachment = implode(', ', $dynamicFiles);
                    $dynamicNote->save();
                }
            }
        
            return response()->json([
                'status' => true,
                'message' => 'Note added successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create note',
                'error' => $e->getMessage()
            ], 500);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $draft = Draft::where('file_id', $id)
                ->where('user_id', auth()->user()->id)
                ->get();

            if ($draft->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Draft not found',
                ], 404);
            }
        
            return response()->json([
                'status' => true,
                'message' => 'Draft found',
                'data' => $draft,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve draft',
                'error' => $e->getMessage()
            ], 500);
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

