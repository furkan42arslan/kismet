<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getRandom(Request $request)
    {
        $query = Content::where('is_approved', true);

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $content = $query->inRandomOrder()->first();

        if ($content === null) {
            return response()->json([
                'success' => false,
                'message' => 'Uygun içerik bulunamadı.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $content,
        ]);
    }

    public function getDaily()
    {
        $approvedContents = Content::where('is_approved', true)->get();

        if ($approvedContents->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Uygun içerik bulunamadı.',
            ]);
        }

        $dateSeed = now()->format('Y-m-d');
        $selectedIndex = abs(crc32($dateSeed)) % $approvedContents->count();
        $content = $approvedContents->get($selectedIndex);

        return response()->json([
            'success' => true,
            'data' => $content,
            'daily' => true,
        ]);
    }

    public function adminIndex(): View
    {
        $contents = Content::latest()->get();

        return view('admin.contents', compact('contents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:ayet,hadis,soz,kitap,gorev,dua,motive,teselli'],
            'body' => ['required', 'string'],
            'source' => ['nullable', 'string'],
        ]);

        Content::create([
            ...$validated,
            'is_approved' => true,
        ]);

        return redirect()
            ->route('admin.contents')
            ->with('success', 'İçerik başarıyla eklendi.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Content::findOrFail($id)->delete();

        return redirect()
            ->route('admin.contents')
            ->with('success', 'İçerik silindi.');
    }
}
