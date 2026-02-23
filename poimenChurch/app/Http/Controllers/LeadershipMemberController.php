<?php

namespace App\Http\Controllers;

use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipMemberController extends Controller
{
    public function index(Request $request)
    {
        $members = LeadershipMember::when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            })
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('leadership.index', compact('members'));
    }

    public function create()
    {
        return view('leadership.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'title'           => 'required|string|max:255',
            'bio'             => 'nullable|string',
            'photo'           => 'nullable|image|max:2048',
            'facebook_url'    => 'nullable|url|max:255',
            'twitter_url'     => 'nullable|url|max:255',
            'is_senior_pastor' => 'boolean',
            'is_active'       => 'boolean',
            'display_order'   => 'integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('leadership', 'public');
        }

        $data['is_senior_pastor'] = $request->boolean('is_senior_pastor');
        $data['is_active'] = $request->boolean('is_active', true);

        LeadershipMember::create($data);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Le membre du leadership a été ajouté avec succès.');
    }

    public function edit(LeadershipMember $leadership)
    {
        return view('leadership.edit', compact('leadership'));
    }

    public function update(Request $request, LeadershipMember $leadership)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'title'           => 'required|string|max:255',
            'bio'             => 'nullable|string',
            'photo'           => 'nullable|image|max:2048',
            'facebook_url'    => 'nullable|url|max:255',
            'twitter_url'     => 'nullable|url|max:255',
            'is_senior_pastor' => 'boolean',
            'is_active'       => 'boolean',
            'display_order'   => 'integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            if ($leadership->photo) {
                Storage::disk('public')->delete($leadership->photo);
            }
            $data['photo'] = $request->file('photo')->store('leadership', 'public');
        }

        $data['is_senior_pastor'] = $request->boolean('is_senior_pastor');
        $data['is_active'] = $request->boolean('is_active', true);

        $leadership->update($data);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Le membre du leadership a été mis à jour avec succès.');
    }

    public function destroy(LeadershipMember $leadership)
    {
        if ($leadership->photo) {
            Storage::disk('public')->delete($leadership->photo);
        }

        $leadership->delete();

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Le membre du leadership a été supprimé avec succès.');
    }

    public function toggleActive(LeadershipMember $leadership)
    {
        $leadership->update(['is_active' => !$leadership->is_active]);

        $status = $leadership->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Le membre a été {$status} avec succès.");
    }
}
