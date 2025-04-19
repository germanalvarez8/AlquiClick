use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\BookingController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Buildings routes
Route::apiResource('buildings', BuildingController::class);

// Rooms routes
Route::apiResource('rooms', RoomController::class);
Route::get('buildings/{building}/rooms', [RoomController::class, 'getBuildingRooms']);

// Amenities routes
Route::apiResource('amenities', AmenityController::class);
Route::post('rooms/{room}/amenities', [RoomController::class, 'syncAmenities']);

// Bookings routes
Route::apiResource('bookings', BookingController::class);
Route::get('rooms/{room}/bookings', [BookingController::class, 'getRoomBookings']);
Route::get('users/{user}/bookings', [BookingController::class, 'getUserBookings']); 