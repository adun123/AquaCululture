<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;



class DeviceController extends Controller
{
    use AuthorizesRequests;


    
    public function index()
    {
        
        $devices = Device::where('user_id', Auth::id())->latest()->get();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);
    
        $deviceCode = 'DEV-' . Str::upper(Str::random(8)); // Format lebih mudah dibaca
    
        $device = Device::create([
            'device_code' => $deviceCode,
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'location' => $request->location,
        ]);
    
        return redirect()->route('devices.show', $device)
                        ->with([
                            'success' => 'Device added successfully!',
                            'device_code' => $deviceCode // Kirim code ke view
                        ]);
    }

    public function show(Device $device)
    {
        $this->authorize('view', $device);
        
        $readings = $device->readings()
                          ->orderBy('reading_time', 'desc')
                          ->limit(100)
                          ->get();
        
        return view('devices.show', compact('device', 'readings'));
    }
}
