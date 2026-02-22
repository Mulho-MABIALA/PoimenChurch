<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($subject = $request->get('subject')) {
            $query->where('subject', $subject);
        }

        $messages = $query->paginate(15)->withQueryString();
        $newCount  = ContactMessage::nouveau()->count();

        return view('contact-messages.index', compact('messages', 'newCount'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if ($contactMessage->status === 'nouveau') {
            $contactMessage->update(['status' => 'lu']);
        }

        return view('contact-messages.show', compact('contactMessage'));
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:nouveau,lu,repondu,archive',
        ]);

        $contactMessage->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis a jour avec succes.');
    }

    public function updateNotes(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $contactMessage->update(['admin_notes' => $request->admin_notes]);

        return back()->with('success', 'Notes mises a jour avec succes.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message supprime avec succes.');
    }
}
