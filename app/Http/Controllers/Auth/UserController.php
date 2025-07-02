<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editProfile()
{
    return view('user.edit-profile');
}

public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'bio' => 'nullable|string|max:1000',
    ]);

    try {
        $user = auth()->user();

        // Check if any data actually changed
        $nameChanged = $user->name !== $request->name;
        $bioChanged = $user->bio !== $request->bio;
        $emailChanged = $user->email !== $request->email;

        if (!$nameChanged && !$bioChanged && !$emailChanged) {
            return response()->json([
                'success' => true,
                'unchanged' => true,
                'message' => 'لم يتم تغيير أي بيانات'
            ]);
        }

        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($emailChanged) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->is_email_verified = false;
            $user->verification_code = rand(100000, 999999);
            // Optional: Send email verification again here
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المعلومات بنجاح'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'حدث خطأ أثناء محاولة التحديث: ' . $e->getMessage()
        ]);
    }
}
public function editAvatar()
{
    return view('user.edit-avatar');
}

public function updateAvatar(Request $request)
{
    $request->validate(['avatar' => 'image|max:2048']);

    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        auth()->user()->update(['avatar' => $path]);
    }

    return back()->with('success', 'تم تحديث الصورة بنجاح');
}

public function editPassword()
{
    return view('user.edit-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
    }

    auth()->user()->update(['password' => $request->password]);

    return back()->with('success', 'تم تحديث كلمة المرور بنجاح');
}

public function savedPosts()
{
    $posts = auth()->user()->savedPosts()->latest()->paginate(9);
    return view('user.saved', compact('posts'));
}

}
