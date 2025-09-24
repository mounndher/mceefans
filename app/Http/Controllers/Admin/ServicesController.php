<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
class ServicesController extends Controller
{
    //
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('backend.services.index', compact('services'));
    }

    // فورم إنشاء خدمة جديدة
    public function create()
    {
        return view('backend.services.create');
    }

    // حفظ خدمة جديدة
 public function store(Request $request)
{
    $request->validate([
        'title'    => 'required|string|max:255',
        'subtitle' => 'required|string',
        'image'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/hero/'), $imageName);
        $path = 'uploads/hero/' . $imageName;
    }

    Service::create([
        'title'    => $request->title,
        'subtitle' => $request->subtitle,
        'iamge'    => $path,
    ]);

    return redirect()->route('services.index')->with('success', 'Service created successfully');
}


    // عرض خدمة واحدة
    public function show(Service $service)
    {

    }

    // فورم التعديل
    public function edit(Service $service)
    {
        return view('backend.services.edit', compact('service'));
    }

    // تحديث خدمة
   public function update(Request $request, Service $service)
{
    $request->validate([
        'title'    => 'required|string|max:255',
        'subtitle' => 'required|string',
        'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'subtitle']);

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة لو موجودة
        if ($service->iamge && file_exists(public_path($service->iamge))) {
            unlink(public_path($service->iamge));
        }

        // رفع الصورة الجديدة
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/hero/'), $imageName);

        $data['iamge'] = 'uploads/hero/' . $imageName;
    }

    $service->update($data);

    return redirect()->route('services.index')->with('success', 'Service updated successfully');
}


    // حذف خدمة
   public function destroy(Service $service)
{
    if ($service->iamge && file_exists(public_path($service->iamge))) {
        unlink(public_path($service->iamge));
    }

    $service->delete();

    return redirect()->route('services.index')->with('success', 'Service deleted successfully');
}
}
