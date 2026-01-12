<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourPackage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $bookings = Booking::with('package') 
        ->latest()
        ->paginate(10);

    // Return as JSON for your Next.js frontend
    return response()->json($bookings);
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
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'travel_date'=> 'required|date|after:today',
            'adults'     => 'required|integer|min:1',
            'youth'      => 'integer|min:0',
            'children'   => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Fetch the package to get official prices
        $package = TourPackage::findOrFail($request->package_id);

        // 3. Re-calculate total price on the server (Security best practice)
        $adultPrice = $package->price;
        $youthPrice = $adultPrice * 0.8;
        $childPrice = $adultPrice * 0.5;

        $calculatedTotal = ($request->adults * $adultPrice) + 
                           ($request->youth * $youthPrice) + 
                           ($request->children * $childPrice) + 15; // + Service Fee

        // 4. Create the Booking
        try {
            $booking = DB::transaction(function () use ($request, $calculatedTotal) {
                return Booking::create([
                    'package_id'   => $request->package_id,
                    'first_name'   => $request->first_name,
                    'last_name'    => $request->last_name,
                    'email'        => $request->email,
                    'travel_date'  => $request->travel_date,
                    'total_price'  => $calculatedTotal,
                    'status'       => 'pending',
                    'guest_counts' => [
                        'adults'   => $request->adults,
                        'youth'    => $request->youth,
                        'children' => $request->children,
                    ],
                ]);
            });

            return response()->json([
                'message' => 'Booking initiated successfully',
                'booking_id' => $booking->id,
                'total' => $booking->total_price
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    // Eager load the package to show the name/title
    $booking = Booking::with('package')->findOrFail($id);

    return response()->json($booking);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   // app/Http/Controllers/BookingController.php

public function update(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    // Validate the incoming status
    $validated = $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled'
    ]);

    $booking->update([
        'status' => $validated['status']
    ]);

    return response()->json([
        'message' => 'Booking updated successfully',
        'booking' => $booking
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            
        ]);

        // Find booking where BOTH reference and email match
        $booking = Booking::with('package:id,name') // Assuming relationship exists
            ->where('booking_reference', $request->reference)
            ->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }
}
