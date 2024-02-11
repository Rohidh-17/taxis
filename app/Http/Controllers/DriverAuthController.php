<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Driver;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\DriverLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class DriverAuthController extends Controller
{
    public function index()
    {
        $countSuccessful = 0;
        $pending = 0;
        $amount = 0;
        $rides = Ride::where('driver_id', auth()->user()->id)->get();
        foreach ($rides as $ride) {
            if ($ride->status == 'Accepted') {
                $countSuccessful += 1;
            }
        }
        $rides = Ride::where('driver_id', 0)->get();
        foreach ($rides as $ride) {
            if ($ride->status == 'pending') {
                $pending += 1;
            }
        }
        $count = $rides->count();
        $pay = Payment::where('driver_id', auth()->user()->id)->get();
        foreach ($pay as $pays) {
            $amount += $pays->total;
        }
        $ridenow = Ride::where('driver_id', auth()->user()->id)
            ->where('date', now()->today())
            ->get();

        return view("drivers.index", compact('rides', 'count', 'countSuccessful', 'pending', 'amount', 'ridenow'));
    }
    public function login()
    {
        return view("drivers.login");
    }
    public function handleLogin(Request $request)
    {
        if (Auth::guard('webdrivers')->attempt($request->only(['email', 'password']))) {
            return redirect()->route('drivers.index');
        }
        return redirect()->back();
    }

    public function register()
    {
        return view('drivers.register');
    }
    public function handleRegister(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:drivers,email',
            'password' => 'required|confirmed',
            'phone' => 'required'
        ]);
        $incomingFields['password'] = bcrypt($request->password);
        $driver = Driver::create($incomingFields);

        if (Auth::guard('webdrivers')->attempt(['email' => $driver->email, 'password' => $request->password])) {

            return redirect()->route('drivers.index');
        }
        return redirect()->back();
    }

    public function handleUpdate(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10|max:10'
        ]);
        $records = Driver::find($request->id);
        if (!$records) {
            return redirect('users.index')->withRohidh('Record not found');
        }

        $records->name = $request->input('name');
        $records->phone = $request->input('phone');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destination = 'uploads/profile/' . $records->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/profile/', $fileName);
            $records->image = $fileName;
        }

        $records->save();
        return redirect()->route('drivers.profile')->withRohidh('Updated Successfully');
    }

    public function profile()
    {
        $driver = Driver::where('id', auth()->user()->id)->first();
        return view('drivers.profile', compact('driver'));
    }

    public function logout()
    {
        Auth::guard('webdrivers')->logout();
        return redirect()->route('drivers.login');
    }

    public function ride()
    {
        $ride = Ride::where('driver_id', 0)->get();
        $driver = Driver::where('id', auth()->user()->id)->get();
        return view('drivers.ride', compact(['ride', 'driver']));
    }
    public function report()
    {
        $ride = Ride::where('driver_id', auth()->user()->id)->paginate(5);
        $payment = Payment::all();
        return view('drivers.report', compact(['ride', 'payment']));
    }
    // public function accept($id)
    // {
    //     $records = Ride::find($id);
    //     $records->driver_id = auth()->user()->id;
    //     $records->status = 'Accepted';

    //     $records->save();

    //     return redirect()->back();
    // }

    public function accept($request_id)
    {
        $rideRequest = Ride::find($request_id);
        $customerLatitude = $rideRequest->lat;
        $customerLongitude = $rideRequest->lon;

        $drivers = DriverLocation::all();

        $nearestDriver = null;
        $shortestDistance = 1000;

        $drivers = auth()->user()->id;
        $driver = DriverLocation::where('driver_id', $drivers)->first();
        $driverLatitude = $driver->lat;
        $driverLongitude = $driver->lon;

        $distance = $this->calculateHaversineDistance($customerLatitude, $customerLongitude, $driverLatitude, $driverLongitude);
        if ($distance < $shortestDistance) {
            $nearestDriver = $driver;
            $shortestDistance = $distance;
        }


        if ($nearestDriver) {
            $rideRequest->driver_id = $drivers;
            $rideRequest->status = 'Accepted';
            $rideRequest->save();
            $nearestDriver->save();

            return redirect()->route('drivers.report')->withRohidh('Driver assigned successfully');
        } else {
            return redirect()->route('drivers.report')->withRohidh('Not allocated');
        }
    }

    private function calculateHaversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function edit($id)
    {
        $ride = Ride::where('id', $id)->first();
        return view('drivers.edit', compact('ride'));
    }

    public function handleEdit(Request $request)
    {
        $incomingFields = $request->validate([
            'time' => 'required',
            'pickup' => 'required',
            'destination' => 'required'
        ]);
        $records = Ride::find($request->id);
        if (!$records) {
            return redirect('drivers.index')->withRohidh('Record not found');
        }

        $records->time = $request->input('time');


        $records->save();
        return redirect()->route('drivers.ride')->withRohidh('Updated Successfully');
    }
    public function locations(Request $request)
    {
        $driver = DriverLocation::firstOrNew(['driver_id' => auth()->user()->id]);
        $driver->driver_id = auth()->user()->id;
        $driver->address = $request->input('address');
        $driver->lat = $request->input('lat');
        $driver->lon = $request->input('lon');
        $driver->save();

        return redirect()->back();
    }


    public function payment($id)
    {
        $records = Ride::find($id);
        return response()->json(['records' => $records]);
    }

    public function storePayment(Request $request)
    {
        $incomingFields = $request->validate([
            'kilometer' => 'required|numeric',
            'price_per_km' => 'required|numeric',
            'total' => 'required|numeric',
            'ride_id' => 'required',
            'driver_id' => 'required',
            'user_id' => 'required'
        ]);
        Payment::create($incomingFields);
        return redirect()->route('drivers.report')->withRohidh('Payment Allocated');
    }

    public function location()
    {
        return view('drivers.location');
    }
    public function maplocation($id)
    {
        $ride = Ride::where('id', $id)->first();
        // $driver = Driver::where('id', $ride->driver_id)->first();
        // $location = DriverLocation::where('driver_id', $driver->id)->first();
        //$location->lat, $location->lon; driver
        return view('drivers.maplocation', compact(['ride']));
    }
}
