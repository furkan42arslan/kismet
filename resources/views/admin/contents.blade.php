<!DOCTYPE html>
<html lang="tr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Yönetimi — Kısmet</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.045);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid rgba(255, 255, 255, 0.09);
        }

        .field {
            background: rgba(15, 23, 42, 0.62);
            border: 1px solid rgba(148, 163, 184, 0.18);
        }

        .field:focus {
            border-color: rgba(217, 70, 239, 0.8);
            outline: 2px solid rgba(217, 70, 239, 0.16);
            outline-offset: 0;
        }

        .page-enter {
            animation: pageEnter 0.5s ease-out both;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="relative min-h-screen overflow-x-hidden bg-slate-950 font-sans text-slate-100 selection:bg-pink-500 selection:text-white">
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(circle_at_top_left,rgba(126,34,206,0.22),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(219,39,119,0.16),transparent_30%)]"></div>

    <header class="relative z-10 border-b border-white/10">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-purple-600 via-pink-500 to-amber-400 text-xl font-bold text-white shadow-lg shadow-purple-500/25">K</span>
                <span>
                    <span class="block text-sm font-extrabold tracking-wide">Kısmet</span>
                    <span class="block text-xs text-slate-400">İçerik yönetimi</span>
                </span>
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-3.5 py-2 text-xs font-semibold text-slate-300 transition hover:border-pink-400/40 hover:text-white">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                Siteyi görüntüle
            </a>
        </div>
    </header>

    <main class="relative z-10 mx-auto max-w-7xl px-5 py-10 sm:px-8 lg:py-14">
        <div class="page-enter mb-10 max-w-2xl">
            <p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-pink-400">Yönetim alanı</p>
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">İçeriklerini besle.</h1>
            <p class="mt-3 text-sm leading-6 text-slate-400">Kısmet akışına yeni ayetler, hadisler ve ilham veren fikirler ekle.</p>
        </div>

        @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-200" role="status">
            <i class="fa-solid fa-circle-check text-emerald-300"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-sm text-rose-200" role="alert">
            <div class="flex items-center gap-3 font-semibold">
                <i class="fa-solid fa-circle-exclamation text-rose-300"></i>
                <span>Formu kontrol et.</span>
            </div>
            <ul class="mt-2 list-inside list-disc text-rose-200/80">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-[minmax(280px,0.72fr)_minmax(0,1.28fr)] lg:items-start">
            <section class="glass-card rounded-3xl p-6 shadow-2xl shadow-purple-950/20 sm:p-8">
                <div class="mb-7 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-white">Yeni içerik</h2>
                        <p class="mt-1 text-xs leading-5 text-slate-400">Formu doldur, akışa hemen ekle.</p>
                    </div>
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-pink-500/10 text-pink-300">
                        <i class="fa-solid fa-feather-pointed"></i>
                    </span>
                </div>

                <form action="{{ route('admin.contents.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="type" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Tür</label>
                        <select id="type" name="type" required class="field w-full rounded-xl px-4 py-3 text-sm text-slate-100 transition">
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Bir tür seç</option>
                            <option value="ayet" @selected(old('type')==='ayet' )>Ayet</option>
                            <option value="hadis" @selected(old('type')==='hadis' )>Hadis</option>
                            <option value="soz" @selected(old('type')==='soz' )>Hikmetli Söz</option>
                            <option value="kitap" @selected(old('type')==='kitap' )>Kitap</option>
                            <option value="gorev" @selected(old('type')==='gorev' )>Fikir & Görev</option>
                        </select>
                    </div>

                    <div>
                        <label for="body" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">İçerik metni</label>
                        <textarea id="body" name="body" rows="7" required placeholder="İçeriğin metnini buraya yaz..." class="field w-full resize-y rounded-xl px-4 py-3 text-sm leading-6 text-slate-100 placeholder:text-slate-600 transition">{{ old('body') }}</textarea>
                    </div>

                    <div>
                        <label for="source" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Kaynak <span class="normal-case tracking-normal text-slate-600">(isteğe bağlı)</span></label>
                        <input id="source" name="source" type="text" value="{{ old('source') }}" placeholder="Örn. Bakara Suresi, 286" class="field w-full rounded-xl px-4 py-3 text-sm text-slate-100 placeholder:text-slate-600 transition">
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 via-pink-600 to-amber-500 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-purple-900/30 transition hover:brightness-110 active:scale-[0.99]">
                        <i class="fa-solid fa-plus"></i>
                        İçeriği ekle
                    </button>
                </form>
            </section>

            <section class="min-w-0">
                <div class="mb-4 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-white">Eklenen içerikler</h2>
                        <p class="mt-1 text-xs text-slate-500">{{ $contents->count() }} kayıt, en yeniden eskiye</p>
                    </div>
                    <span class="hidden rounded-full border border-purple-400/20 bg-purple-400/10 px-3 py-1.5 text-xs font-semibold text-purple-200 sm:inline-flex">{{ $contents->count() }} içerik</span>
                </div>

                <div class="glass-card overflow-hidden rounded-3xl shadow-2xl shadow-purple-950/20">
                    @forelse ($contents as $content)
                    <article class="group border-b border-white/10 p-5 last:border-0 sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="mb-3 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-purple-400/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-purple-200">{{ $content->type }}</span>
                                    <time class="text-[11px] text-slate-500">{{ $content->created_at?->format('d.m.Y H:i') }}</time>
                                </div>
                                <p class="whitespace-pre-line text-sm leading-6 text-slate-200">{{ $content->body }}</p>
                                @if ($content->source)
                                <p class="mt-3 text-xs font-semibold text-pink-300">{{ $content->source }}</p>
                                @endif
                            </div>
                            <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Bu içerik silinsin mi?');" class="shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="İçeriği sil" class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 text-slate-500 transition hover:border-rose-400/30 hover:bg-rose-400/10 hover:text-rose-300">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                    @empty
                    <div class="px-6 py-16 text-center">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-400/10 text-xl text-purple-300">
                            <i class="fa-solid fa-inbox"></i>
                        </span>
                        <h3 class="mt-5 text-sm font-bold text-slate-200">Henüz içerik yok</h3>
                        <p class="mt-2 text-xs text-slate-500">İlk içeriği eklediğinde burada görünecek.</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</body>

</html>