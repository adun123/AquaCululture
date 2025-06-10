<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StoreDeviceRequest;


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

    

public function show(Device $device, Request $request)
{
    $this->authorize('view', $device);

    $query = $device->readings()->orderBy('reading_time', 'desc');

    if ($request->has('filter')) {
        $now = Carbon::now();

        switch ($request->filter) {
            case 'daily':
                $query->whereDate('reading_time', $now->toDateString());
                break;
            case 'weekly':
                $query->whereBetween('reading_time', [$now->startOfWeek(), $now->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('reading_time', $now->month)
                      ->whereYear('reading_time', $now->year);
                break;
            case 'yearly':
                $query->whereYear('reading_time', $now->year);
                break;
        }
    }

    $readings = $query->limit(100)->get();

    return view('devices.show', compact('device', 'readings'));
}

    public function edit(Device $device)
{
    $this->authorize('update', $device);
    return view('devices.edit', compact('device'));
}

public function update(Request $request, Device $device)
{
    $this->authorize('update', $device);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'nullable|string|max:255',
    ]);

    $device->update([
        'name' => $request->name,
        'description' => $request->description,
        'location' => $request->location,
    ]);

    return redirect()->route('devices.show', $device)
                    ->with('success', 'Device updated successfully!');
}

public function destroy(Device $device)
{
    $this->authorize('delete', $device);

    $device->delete();

    return redirect()->route('user.dashboard')
                    ->with('success', 'Device deleted successfully!');
}

}
