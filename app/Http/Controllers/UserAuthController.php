<?php

namespace App\Http\Controllers;

use App\Models\DriverLocation;
use App\Models\Ride;
use App\Models\User;
use App\Models\Driver;
use App\Models\Rating;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class UserAuthController extends Controller
{
    public function index()
    {
        $countSuccessful = 0;
        $pending = 0;
        $amount = 0;
        $rides = Ride::where('user_id', auth()->user()->id)->get();
        foreach ($rides as $ride) {
            if ($ride->status == 'Accepted') {
                $countSuccessful += 1;
            } else {
                $pending += 1;
            }
        }
        $count = $rides->count();
        $pay = Payment::where('user_id', auth()->user()->id)->get();
        foreach ($pay as $pays) {
            $amount += $pays->total;
        }
        $ridenow = Ride::where('user_id', auth()->user()->id)
            ->where('date', now()->today())
            ->get();
        return view("users.index", compact('rides', 'count', 'countSuccessful', 'pending', 'amount', 'ridenow'));
    }
    public function login()
    {
        return view("users.login");
    }
    public function handleLogin(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('users.index');
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }
    public function register()
    {
        return view('users.register');
    }
    public function handleRegister(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8|max:20',
            'phone' => 'required'
        ]);
        $incomingFields['password'] = bcrypt($request->password);
        $user = User::create($incomingFields);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {

            return redirect()->route('users.index');
        }
        return redirect()->back();
    }
    public function handleUpdate(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10|max:10'
        ]);
        $records = User::find($request->id);

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
        return redirect()->route('users.profile')->withRohidh('Updated Successfully');
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('users.profile', compact('user'));
    }

    public function rides()
    {
        return view('users.rides');
    }

    public function ridesStore(Request $request)
    {
        $incomingFields = $request->validate([
            'pickup' => 'required',
            'destination' => 'required',
            'time' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'lat1' => 'required',
            'lon1' => 'required',
            'date' => 'required',
        ]);

        $incomingFields['user_id'] = auth()->user()->id;

        $inputDate = Carbon::parse($incomingFields['date']);
        if ($inputDate < Carbon::today()) {
            return back()->withRohidh('Not Booked... Please check the date and time');
        }

        Ride::create($incomingFields);

        return redirect()->route('users.report')->withRohidh('Booked Successfully...');
    }

    public function report()
    {
        $user = Ride::where('user_id', auth()->user()->id)->paginate(5);
        $payment = Payment::all();
        return view('users.report', compact('user', 'payment'));
    }


    public function delete($id)
    {
        $user = Ride::find($id);
        $user->delete();
        return redirect()->back()->withRohidh('Cancelled Successfully');
    }

    public function pay(Request $request, $id)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'cardname' => 'required',
            'cardnumber' => 'required',
            'expmonth' => 'required',
            'expyear' => 'required',
            'cvv' => 'required',

        ]);
        $pay = Payment::where('ride_id', $id)->first();
        $pay->status = 'paid';
        $pay->save();
        return redirect()->route('users.report')->withRohidh('Paid Successfully');
    }
    public function payment($id, $pay)
    {
        return view('users.payment', compact(['id', 'pay']));
    }

    public function ratings(Request $request)
    {
        $rideId = $request->input('ride_id');
        $rating = $request->input('rating');

        Rating::create(['ride_id' => $rideId, 'rating' => $rating]);

        return redirect()->back()->withRohidh('Rated Successfully');
    }

    public function maplocation($id)
    {
        $ride = Ride::where('id', $id)->first();
        // $driver = Driver::where('id', $ride->driver_id)->first();
        // $location = DriverLocation::where('driver_id', $driver->id)->first();
        //$location->lat, $location->lon; driver
        return view('users.maplocation', compact(['ride']));
    }
}
