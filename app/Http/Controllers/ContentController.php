<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class ContentController extends Controller
{
    private const FALLBACK_CONTENTS = [
        [
            'type' => 'ayet',
            'body' => 'Kalpler ancak Allah\'ı anmakla huzur bulur.',
            'source' => 'Ra\'d Suresi, 28. ayet',
        ],
        [
            'type' => 'ayet',
            'body' => 'Şüphesiz güçlükle beraber bir kolaylık vardır.',
            'source' => 'İnşirah Suresi, 5. ayet',
        ],
        [
            'type' => 'hadis',
            'body' => 'Ameller niyetlere göredir; herkes için niyet ettiği vardır.',
            'source' => 'Buhari, Bedü\'l-Vahy, 1; Müslim, İmare, 155',
        ],
        [
            'type' => 'hadis',
            'body' => 'Kolaylaştırınız, zorlaştırmayınız; müjdeleyiniz, nefret ettirmeyiniz.',
            'source' => 'Buhari, İlim, 11; Müslim, Cihad, 6',
        ],
        [
            'type' => 'soz',
            'body' => 'Kendini bilmek, bütün bilgeliğin başlangıcıdır.',
            'source' => 'Sokrates',
        ],
        [
            'type' => 'soz',
            'body' => 'İyi bir hayat, iyi düşünceler ve iyi eylemlerle örülür.',
            'source' => 'Marcus Aurelius',
        ],
    ];

    public function index()
    {
        return view('welcome');
    }

    public function getRandom(Request $request)
    {
        $content = $this->approvedContents($request->input('type'))->random();

        return response()->json([
            'success' => true,
            'data' => $content,
        ]);
    }

    public function getDaily()
    {
        $approvedContents = $this->approvedContents();

        $dateSeed = now()->format('Y-m-d');
        $selectedIndex = abs(crc32($dateSeed)) % $approvedContents->count();
        $content = $approvedContents->get($selectedIndex);

        return response()->json([
            'success' => true,
            'data' => $content,
            'daily' => true,
        ]);
    }

    /**
     * Load approved database content and fall back to the built-in catalogue
     * when the database is empty or temporarily unavailable.
     */
    private function approvedContents(?string $type = null): Collection
    {
        try {
            $query = Content::where('is_approved', true);

            if ($type !== null && $type !== '') {
                $query->where('type', $type);
            }

            $contents = $query->get();

            if ($contents->isNotEmpty()) {
                return $contents;
            }
        } catch (Throwable) {
            // Use the built-in catalogue when SQLite is unavailable or invalid.
        }

        $fallbackContents = self::FALLBACK_CONTENTS;

        if ($type !== null && $type !== '') {
            $fallbackContents = array_values(array_filter(
                $fallbackContents,
                static fn (array $content): bool => $content['type'] === $type,
            ));
        }

        return collect($fallbackContents)->values()->map(
            static fn (array $content, int $index): array => [
                'id' => 'fallback-'.$index,
                ...$content,
                'is_approved' => true,
            ],
        );
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
