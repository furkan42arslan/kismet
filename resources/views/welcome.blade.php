<!DOCTYPE html>
<html lang="tr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kısmet — Bir Tık İlham, Bir Tık Hikmet</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#9333ea">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(error => {
                    console.error('Service worker kaydedilemedi.', error);
                });
            });
        }
    </script>
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
        /* Dark Mode Cam Efekti */
        .dark .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Light Mode Cam Efekti ve Kontrast Düzeltmesi */
        .light .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.07);
        }

        .fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .daily-btn {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.25), rgba(236, 72, 153, 0.22));
            border: 1px solid rgba(216, 180, 254, 0.5);
            box-shadow: 0 0 0 1px rgba(196, 181, 253, 0.15), 0 10px 30px -12px rgba(216, 180, 254, 0.9);
        }

        .daily-btn:hover {
            box-shadow: 0 0 0 1px rgba(216, 180, 254, 0.35), 0 18px 30px -14px rgba(236, 72, 153, 0.8);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .install-banner {
            animation: slideUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translate(-50%, 24px);
            }

            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body class="bg-slate-950 dark:bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between font-sans transition-colors duration-300 relative overflow-x-hidden selection:bg-purple-500 selection:text-white">

    <!-- Arka Plan Atmosfer Işıkları -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-600/20 dark:bg-purple-600/20 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-[350px] h-[350px] bg-pink-600/15 dark:bg-pink-600/15 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Üst Bar (Header) -->
    <header class="max-w-4xl mx-auto w-full px-6 py-6 flex justify-between items-center z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-purple-600 via-pink-500 to-amber-400 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-purple-500/25">
                K
            </div>
            <div>
                <h1 class="font-bold text-lg leading-tight tracking-wide text-slate-800 dark:text-slate-100">Kısmet</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Neye niyet, neye kısmet</p>
            </div>
        </div>

        <!-- Tema Değiştirme Butonu -->
        <button id="themeToggle" onclick="toggleTheme()" class="p-2.5 rounded-xl glass-card text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-400 transition-all">
            <i class="fa-solid fa-moon text-lg" id="themeIcon"></i>
        </button>
    </header>

    <!-- Ana İçerik Alanı -->
    <main class="max-w-2xl mx-auto w-full px-6 my-auto py-8 z-10 flex flex-col items-center">

        <!-- Kategori Seçim Butonları -->
        <div class="relative mb-8 w-full">
            <div class="pointer-events-none absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-slate-950/90 to-transparent z-10"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-slate-950/90 to-transparent z-10"></div>

            <div id="categoryBar" class="no-scrollbar flex touch-pan-x select-none cursor-grab items-center gap-2 overflow-x-auto scroll-smooth whitespace-nowrap px-2 py-1.5 glass-card rounded-2xl">
                <button id="dailyBtn" onclick="showDailyContent()" class="daily-btn flex-shrink-0 whitespace-nowrap px-3.5 py-2 rounded-xl text-xs font-semibold text-purple-100 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-sparkles text-amber-300"></i> ✨ Günün Nasibi
                </button>
                <button onclick="setCategory('all')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold transition-all bg-gradient-to-r from-purple-600 to-pink-500 text-white shadow-md shadow-purple-500/20" data-cat="all">
                    <i class="fa-solid fa-sparkles mr-1.5"></i> Hepsi
                </button>
                <button onclick="setCategory('ayet')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="ayet">
                    <i class="fa-solid fa-book-quran mr-1.5"></i> Ayet
                </button>
                <button onclick="setCategory('hadis')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="hadis">
                    <i class="fa-solid fa-kaaba mr-1.5"></i> Hadis
                </button>
                <button onclick="setCategory('soz')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="soz">
                    <i class="fa-solid fa-quote-left mr-1.5"></i> Hikmetli Söz
                </button>
                <button onclick="setCategory('kitap')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="kitap">
                    <i class="fa-solid fa-book mr-1.5"></i> Kitap
                </button>
                <button onclick="setCategory('gorev')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="gorev">
                    <i class="fa-solid fa-compass mr-1.5"></i> Fikir & Görev
                </button>
                <button onclick="setCategory('dua')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="dua">
                    <i class="fa-solid fa-hands-praying mr-1.5"></i> Dua
                </button>
                <button onclick="setCategory('motive')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="motive">
                    <i class="fa-solid fa-bolt mr-1.5"></i> Motivasyon
                </button>
                <button onclick="setCategory('teselli')" class="cat-btn flex-shrink-0 whitespace-nowrap px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all" data-cat="teselli">
                    <i class="fa-solid fa-heart-circle-check mr-1.5"></i> Teselli
                </button>
            </div>
        </div>

        <button type="button" onclick="openFavoritesModal()" class="mb-5 inline-flex items-center gap-2 rounded-full border border-pink-300/30 bg-pink-500/10 px-4 py-2 text-xs font-semibold text-pink-200 transition-all hover:-translate-y-0.5 hover:bg-pink-500/20">
            <i class="fa-solid fa-heart text-pink-400"></i>
            Favorilerim
            <span id="favoritesCount" class="rounded-full bg-pink-500/20 px-1.5 py-0.5 text-[10px] text-pink-100">0</span>
        </button>

        <!-- Kart Alanı -->
        <div id="cardContainer" class="w-full glass-card rounded-3xl p-8 md:p-10 text-center min-h-[260px] flex flex-col justify-center items-center relative transition-all duration-300 shadow-2xl">
            <div id="placeholderState" class="space-y-3">
                <div class="w-16 h-16 rounded-2xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl mx-auto mb-4 animate-bounce">
                    <i class="fa-solid fa-clover"></i>
                </div>
                <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-200">Nasibinde Ne Var?</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 max-w-sm mx-auto">Butona basarak nasibine düşen ayet, hadis, hikmetli söz veya ilham verici fikri keşfet.</p>
            </div>

            <!-- Doldurulacak İçerik -->
            <div id="contentState" class="hidden w-full fade-in space-y-6">
                <!-- Kategori Rozeti -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-700 dark:text-purple-300 text-xs font-semibold tracking-wider uppercase" id="cardBadge">
                    <i class="fa-solid fa-quote-left" id="cardBadgeIcon"></i>
                    <span id="cardCategoryName">Ayet</span>
                </div>

                <!-- Ana Metin -->
                <blockquote id="cardBody" class="text-lg md:text-xl font-medium leading-relaxed text-slate-800 dark:text-slate-100 max-w-xl mx-auto">
                    ...
                </blockquote>

                <!-- Kaynak / Yazar -->
                <div id="cardSource" class="text-sm font-semibold text-purple-600 dark:text-pink-400 tracking-wide">
                    ...
                </div>

                <!-- Aksiyon Butonları -->
                <div id="cardActions" class="pt-4 border-t border-slate-200 dark:border-slate-800/80 flex flex-wrap justify-center gap-2.5">
                    <button title="Favorilere ekle" id="favoriteBtn" onclick="toggleFavorite()" aria-label="Favorilere ekle" aria-pressed="false" class="h-11 w-11 rounded-xl bg-pink-50/90 dark:bg-pink-950/30 hover:bg-pink-100 dark:hover:bg-pink-900/40 text-pink-500 transition-all flex items-center justify-center border border-pink-200/80 dark:border-pink-800/60 shadow-sm shadow-pink-900/10 hover:-translate-y-0.5">
                        <i class="fa-regular fa-heart text-base" id="favoriteIcon"></i>
                    </button>
                    <button title="Kopyala" onclick="copyContent()" class="h-11 w-11 rounded-xl bg-slate-100/90 dark:bg-slate-900/70 hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all flex items-center justify-center border border-slate-200/80 dark:border-slate-700/80 shadow-sm shadow-slate-900/10 hover:-translate-y-0.5">
                        <i class="fa-regular fa-copy text-base"></i>
                    </button>
                    <button title="WhatsApp ile paylaş" onclick="shareWhatsApp()" class="h-11 w-11 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white transition-all flex items-center justify-center shadow-lg shadow-emerald-500/20 border border-emerald-300/50 hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </button>
                    <button title="X ile paylaş" onclick="shareTwitter()" class="h-11 w-11 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-white transition-all flex items-center justify-center border border-slate-700 shadow-lg shadow-slate-950/20 hover:-translate-y-0.5">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" aria-hidden="true" fill="currentColor">
                            <path d="M18.901 2h3.68l-8.04 9.19L24 22h-7.406l-5.8-8.5L4.75 22H1.07l8.6-9.83L0 2h7.594l5.243 7.77L18.901 2Zm-1.29 18h2.04L7.08 3.89H4.93L17.611 20Z" />
                        </svg>
                    </button>
                    <button title="Instagram ile paylaş" onclick="shareInstagram()" class="h-11 w-11 rounded-xl bg-gradient-to-br from-pink-500 via-purple-500 to-orange-400 hover:from-pink-400 hover:via-purple-400 hover:to-orange-300 text-white transition-all flex items-center justify-center shadow-lg shadow-pink-500/20 border border-pink-300/40 hover:-translate-y-0.5">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </button>
                    <button title="Görsel indir" id="downloadCardBtn" onclick="downloadCardImage()" class="h-11 w-11 rounded-xl bg-gradient-to-br from-purple-600 to-pink-500 hover:from-purple-500 hover:to-pink-400 text-white transition-all flex items-center justify-center shadow-lg shadow-purple-500/20 border border-purple-400/40 hover:-translate-y-0.5">
                        <i class="fa-solid fa-download text-base"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- ANA BUTON -->
        <button id="nasipBtn" onclick="nasipCek()" class="mt-8 px-10 py-4 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-amber-500 hover:from-purple-500 hover:to-amber-400 text-white font-bold text-lg shadow-xl shadow-purple-500/25 hover:shadow-purple-500/40 hover:scale-105 active:scale-95 transition-all duration-200 flex items-center gap-3 group">
            <i class="fa-solid fa-dice-five text-xl group-hover:rotate-180 transition-transform duration-500"></i>
            <span>Yeni Söz Getir</span>
        </button>

    </main>

    <!-- Bildirim (Toast) -->
    <div id="toast" class="fixed bottom-6 right-6 px-4 py-3 rounded-xl bg-purple-600 text-white font-medium text-sm shadow-xl flex items-center gap-2 transition-all transform translate-y-20 opacity-0 z-50">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastMsg">Kopyalandı!</span>
    </div>

    <div id="favoritesModal" class="fixed inset-0 z-40 hidden items-center justify-center bg-slate-950/70 px-4 py-6 backdrop-blur-sm" onclick="handleFavoritesBackdrop(event)">
        <section class="glass-card max-h-[80vh] w-full max-w-lg overflow-hidden rounded-3xl p-5 shadow-2xl" role="dialog" aria-modal="true" aria-labelledby="favoritesTitle">
            <div class="mb-4 flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-pink-300">Kişisel koleksiyon</p>
                    <h2 id="favoritesTitle" class="mt-1 text-xl font-bold text-slate-100">Favorilerim</h2>
                </div>
                <button type="button" onclick="closeFavoritesModal()" aria-label="Favoriler penceresini kapat" class="h-10 w-10 rounded-xl bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div id="favoritesList" class="no-scrollbar max-h-[60vh] space-y-3 overflow-y-auto pr-1"></div>
        </section>
    </div>

    <div id="installBanner" class="install-banner fixed bottom-5 left-1/2 z-30 hidden w-[calc(100%-2rem)] max-w-md items-center gap-3 rounded-2xl border border-purple-300/30 bg-slate-900/90 px-4 py-3 text-white shadow-2xl shadow-purple-950/40 backdrop-blur-xl">
        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-purple-600 to-pink-500 shadow-lg shadow-purple-500/30">
            <i class="fa-solid fa-mobile-screen-button"></i>
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-semibold">Kısmet'i Ana Ekrana Yükle</p>
            <p class="mt-0.5 text-xs text-slate-400">İlhamına her an daha hızlı ulaş.</p>
        </div>
        <button type="button" onclick="installApp()" class="flex-shrink-0 rounded-xl bg-gradient-to-r from-purple-600 to-pink-500 px-3 py-2 text-xs font-bold text-white transition hover:from-purple-500 hover:to-pink-400">Yükle</button>
        <button type="button" onclick="dismissInstallBanner()" aria-label="Yükleme bildirimini kapat" class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-white/10 hover:text-white">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Footer -->
    <footer class="max-w-4xl mx-auto w-full px-6 py-6 text-center text-xs text-slate-500 z-10">
        <p>© {{ date('Y') }} Kısmet — Küçük adımlarla başlayan büyük hayırlar için.</p>
    </footer>

    <!-- JS Mantığı -->
    <script>
        let currentCategory = 'all';
        let currentContent = null;
        let deferredInstallPrompt = null;
        const favoritesStorageKey = 'kismetFavorites';
        const randomContentUrl = "{{ route('content.random') }}";
        const dailyContentUrl = "{{ route('content.daily') }}";

        function setCategory(cat) {
            currentCategory = cat;
            document.querySelectorAll('.cat-btn').forEach(btn => {
                if (btn.dataset.cat === cat) {
                    btn.className = 'cat-btn active px-4 py-2 rounded-xl text-xs font-semibold transition-all bg-gradient-to-r from-purple-600 to-pink-500 text-white shadow-md shadow-purple-500/20';
                } else {
                    btn.className = 'cat-btn px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-white transition-all';
                }
            });

            nasipCek();
        }

        function renderCardData(data, badgeOverride = null) {
            currentContent = data;
            document.getElementById('placeholderState').classList.add('hidden');
            const contentState = document.getElementById('contentState');

            contentState.classList.remove('fade-in');
            void contentState.offsetWidth;
            contentState.classList.add('fade-in');
            contentState.classList.remove('hidden');

            document.getElementById('cardBody').innerText = `“${data.body}”`;
            document.getElementById('cardSource').innerText = data.source ? `— ${data.source}` : '';

            const badgeInfo = badgeOverride ? {
                name: badgeOverride,
                icon: 'fa-solid fa-sparkles'
            } : getBadgeInfo(data.type);

            document.getElementById('cardCategoryName').innerText = badgeInfo.name;
            document.getElementById('cardBadgeIcon').className = badgeInfo.icon;
            updateFavoriteButton();
        }

        function getFavorites() {
            try {
                const storedFavorites = JSON.parse(localStorage.getItem(favoritesStorageKey) || '[]');

                return Array.isArray(storedFavorites) ? storedFavorites : [];
            } catch (error) {
                return [];
            }
        }

        function saveFavorites(favorites) {
            localStorage.setItem(favoritesStorageKey, JSON.stringify(favorites));
            updateFavoritesCount();
        }

        function isFavorite(contentId) {
            return getFavorites().some(favorite => String(favorite.id) === String(contentId));
        }

        function updateFavoriteButton() {
            const button = document.getElementById('favoriteBtn');
            const icon = document.getElementById('favoriteIcon');

            if (!button || !icon || !currentContent?.id) {
                return;
            }

            const active = isFavorite(currentContent.id);
            icon.className = active ? 'fa-solid fa-heart text-base' : 'fa-regular fa-heart text-base';
            button.classList.toggle('text-pink-500', !active);
            button.classList.toggle('text-rose-500', active);
            button.setAttribute('aria-pressed', String(active));
            button.setAttribute('title', active ? 'Favorilerden çıkar' : 'Favorilere ekle');
            button.setAttribute('aria-label', active ? 'Favorilerden çıkar' : 'Favorilere ekle');
        }

        function updateFavoritesCount() {
            const count = document.getElementById('favoritesCount');

            if (count) {
                count.innerText = getFavorites().length;
            }
        }

        function toggleFavorite() {
            if (!currentContent?.id) {
                showToast('Önce bir içerik seçmelisin.');
                return;
            }

            const favorites = getFavorites();
            const existingIndex = favorites.findIndex(favorite => String(favorite.id) === String(currentContent.id));

            if (existingIndex >= 0) {
                favorites.splice(existingIndex, 1);
                showToast('Favorilerden çıkarıldı.');
            } else {
                favorites.unshift({
                    id: currentContent.id,
                    type: currentContent.type,
                    body: currentContent.body,
                    source: currentContent.source,
                });
                showToast('Favorilere eklendi.');
            }

            saveFavorites(favorites);
            updateFavoriteButton();
        }

        function openFavoritesModal() {
            renderFavoritesList();

            const modal = document.getElementById('favoritesModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeFavoritesModal() {
            const modal = document.getElementById('favoritesModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function handleFavoritesBackdrop(event) {
            if (event.target.id === 'favoritesModal') {
                closeFavoritesModal();
            }
        }

        function renderFavoritesList() {
            const list = document.getElementById('favoritesList');
            const favorites = getFavorites();

            if (!favorites.length) {
                list.innerHTML = `
                    <div class="rounded-2xl border border-dashed border-white/10 px-5 py-10 text-center">
                        <i class="fa-regular fa-heart mb-3 text-3xl text-pink-400/70"></i>
                        <p class="text-sm font-semibold text-slate-200">Henüz favorin yok.</p>
                        <p class="mt-1 text-xs text-slate-400">Beğendiğin bir sözü kalbine dokunarak burada saklayabilirsin.</p>
                    </div>`;
                return;
            }

            list.innerHTML = favorites.map(favorite => `
                <article class="rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                    <div class="mb-2 flex items-start justify-between gap-3">
                        <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-pink-300">${getBadgeInfo(favorite.type).name}</span>
                        <button type="button" onclick="removeFavorite('${favorite.id}')" aria-label="Favoriyi kaldır" class="text-slate-500 transition hover:text-pink-400">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-200">“${escapeHtml(favorite.body)}”</p>
                    ${favorite.source ? `<p class="mt-3 text-xs font-semibold text-purple-300">— ${escapeHtml(favorite.source)}</p>` : ''}
                </article>`).join('');
        }

        function removeFavorite(contentId) {
            saveFavorites(getFavorites().filter(favorite => String(favorite.id) !== String(contentId)));
            renderFavoritesList();
            updateFavoriteButton();
            showToast('Favorilerden çıkarıldı.');
        }

        function escapeHtml(value) {
            return String(value || '').replace(/[&<>'"]/g, character => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#039;',
                '"': '&quot;'
            })[character]);
        }

        function nasipCek() {
            const btn = document.getElementById('nasipBtn');
            btn.disabled = true;
            btn.classList.add('opacity-80');

            const type = currentCategory === 'all' ? '' : currentCategory;
            fetch(`${randomContentUrl}?type=${encodeURIComponent(type)}`)
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        renderCardData(res.data);
                    } else {
                        showToast(res.message || 'Bir sorun oluştu.');
                    }
                })
                .catch(err => {
                    showToast('Veri alınırken hata oluştu.');
                    console.error(err);
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.classList.remove('opacity-80');
                });
        }

        function showDailyContent() {
            const btn = document.getElementById('dailyBtn');
            const mainBtn = document.getElementById('nasipBtn');

            if (btn) {
                btn.disabled = true;
                btn.classList.add('opacity-80');
            }

            if (mainBtn) {
                mainBtn.disabled = true;
                mainBtn.classList.add('opacity-80');
            }

            fetch(dailyContentUrl)
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        renderCardData(res.data, 'Günün Nasibi');
                    } else {
                        showToast(res.message || 'Günün nasibi bulunamadı.');
                    }
                })
                .catch(err => {
                    showToast('Günün nasibi alınırken hata oluştu.');
                    console.error(err);
                })
                .finally(() => {
                    if (btn) {
                        btn.disabled = false;
                        btn.classList.remove('opacity-80');
                    }

                    if (mainBtn) {
                        mainBtn.disabled = false;
                        mainBtn.classList.remove('opacity-80');
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            nasipCek();
            setupCategoryBarInteractions();
            updateFavoritesCount();

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    closeFavoritesModal();
                }
            });

            window.addEventListener('beforeinstallprompt', event => {
                event.preventDefault();
                deferredInstallPrompt = event;

                if (localStorage.getItem('kismetInstallDismissed') !== 'true') {
                    showInstallBanner();
                }
            });

            if (isMobileDevice() && !isStandaloneApp() && localStorage.getItem('kismetInstallDismissed') !== 'true') {
                window.setTimeout(showInstallBanner, 1200);
            }

            window.addEventListener('appinstalled', () => {
                deferredInstallPrompt = null;
                dismissInstallBanner();
                showToast('Kısmet ana ekrana eklendi.');
            });
        });

        function setupCategoryBarInteractions() {
            const categoryBar = document.getElementById('categoryBar');

            if (!categoryBar) {
                return;
            }

            let isDragging = false;
            let startX = 0;
            let startScrollLeft = 0;
            let dragged = false;

            categoryBar.addEventListener('wheel', event => {
                if (categoryBar.scrollWidth <= categoryBar.clientWidth) {
                    return;
                }

                event.preventDefault();
                categoryBar.scrollLeft += event.deltaY;
            }, {
                passive: false
            });

            categoryBar.addEventListener('mousedown', event => {
                isDragging = true;
                dragged = false;
                startX = event.pageX - categoryBar.offsetLeft;
                startScrollLeft = categoryBar.scrollLeft;
                categoryBar.classList.remove('cursor-grab');
                categoryBar.classList.add('cursor-grabbing');
            });

            categoryBar.addEventListener('mousemove', event => {
                if (!isDragging) {
                    return;
                }

                const currentX = event.pageX - categoryBar.offsetLeft;
                const distance = currentX - startX;

                if (Math.abs(distance) > 6) {
                    dragged = true;
                }

                categoryBar.scrollLeft = startScrollLeft - distance;
            });

            const stopDragging = () => {
                isDragging = false;
                categoryBar.classList.remove('cursor-grabbing');
                categoryBar.classList.add('cursor-grab');
            };

            categoryBar.addEventListener('mouseleave', stopDragging);
            categoryBar.addEventListener('mouseup', stopDragging);

            categoryBar.addEventListener('click', event => {
                if (!dragged) {
                    return;
                }

                event.preventDefault();
                event.stopPropagation();
                dragged = false;
            }, true);
        }

        function getBadgeInfo(type) {
            switch (type) {
                case 'ayet':
                    return {
                        name: 'Ayet-i Kerime', icon: 'fa-solid fa-book-quran'
                    };
                case 'hadis':
                    return {
                        name: 'Hadis-i Şerif', icon: 'fa-solid fa-kaaba'
                    };
                case 'soz':
                    return {
                        name: 'Hikmetli Söz', icon: 'fa-solid fa-quote-left'
                    };
                case 'kitap':
                    return {
                        name: 'Kitap Önerisi', icon: 'fa-solid fa-book'
                    };
                case 'gorev':
                    return {
                        name: 'Günün Fikri', icon: 'fa-solid fa-compass'
                    };
                case 'dua':
                    return {
                        name: 'Dua', icon: 'fa-solid fa-hands-praying'
                    };
                case 'motive':
                    return {
                        name: 'Motivasyon', icon: 'fa-solid fa-bolt'
                    };
                case 'teselli':
                    return {
                        name: 'Teselli', icon: 'fa-solid fa-heart-circle-check'
                    };
                case 'daily':
                    return {
                        name: 'Günün Nasibi', icon: 'fa-solid fa-sparkles'
                    };
                default:
                    return {
                        name: 'Nasip', icon: 'fa-solid fa-sparkles'
                    };
            }
        }

        function copyContent() {
            const body = document.getElementById('cardBody').innerText;
            const source = document.getElementById('cardSource').innerText;
            navigator.clipboard.writeText(`${body} ${source}`);
            showToast('Söz panoya kopyalandı!');
        }

        function downloadCardImage() {
            const card = document.getElementById('cardContainer');
            const button = document.getElementById('downloadCardBtn');
            const actions = document.getElementById('cardActions');

            if (!card || typeof html2canvas === 'undefined') {
                showToast('Görsel indirilemedi.');
                return;
            }

            const originalText = button.innerHTML;
            const originalActionsDisplay = actions ? actions.style.display : null;

            button.disabled = true;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>İndiriliyor...</span>';

            if (actions) {
                actions.style.display = 'none';
            }

            html2canvas(card, {
                scale: 2,
                backgroundColor: null,
                useCORS: true,
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'kismet-nasip.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                showToast('Görsel indirildi.');
            }).catch(() => {
                showToast('Görsel oluşturulurken hata oluştu.');
            }).finally(() => {
                if (actions) {
                    actions.style.display = originalActionsDisplay;
                }

                button.disabled = false;
                button.innerHTML = originalText;
            });
        }

        function getCurrentShareText() {
            const body = document.getElementById('cardBody')?.innerText?.trim() || '';
            const source = document.getElementById('cardSource')?.innerText?.replace(/^—\s*/, '').trim() || '';
            const shareText = source ? `${body}\n— ${source}` : body;

            return shareText
                .replace(/\s+/g, ' ')
                .trim();
        }

        function shareWhatsApp() {
            const text = getCurrentShareText();
            const shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(`${text}\n\nKısmet ile çekildi: https://kismet.app`)}`;
            window.open(shareUrl, '_blank', 'noopener,noreferrer');
        }

        function shareTwitter() {
            const text = getCurrentShareText();
            const shareUrl = `https://x.com/intent/tweet?text=${encodeURIComponent(`${text}\n\nKısmet ile çekildi: https://kismet.app`)}`;
            window.open(shareUrl, '_blank', 'noopener,noreferrer');
        }

        function shareInstagram() {
            const bodyText = document.getElementById('cardBody')?.innerText?.trim() || '';
            const sourceText = document.getElementById('cardSource')?.innerText?.replace(/^—\s*/, '').trim() || '';
            const sharePayload = `${bodyText}${sourceText ? ` — ${sourceText}` : ''}`;
            const currentUrl = window.location.href;

            if (navigator.share && /Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                navigator.share({
                    title: 'Kısmet',
                    text: `${sharePayload}`.trim(),
                    url: currentUrl,
                }).catch(() => {
                    showToast('Paylaşım iptal edildi.');
                });

                return;
            }

            downloadCardImage();

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(`${sharePayload}\n\nKısmet ile çekildi: ${currentUrl}`)
                    .catch(() => {
                        // no-op: görsel indirmenin ardından kullanıcıya toast yeterli
                    });
            }

            showToast('Görsel indirildi ve metin kopyalandı! Instagram Story\'de paylaşabilirsiniz.', 5000);

            setTimeout(() => {
                window.open('https://www.instagram.com', '_blank', 'noopener,noreferrer');
            }, 4000);
        }

        function showToast(msg, duration = 3000) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMsg');

            if (toast.dataset.timeoutId) {
                clearTimeout(Number(toast.dataset.timeoutId));
            }

            toastMsg.innerText = msg;
            toast.classList.remove('translate-y-20', 'opacity-0');

            const timeoutId = setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, duration);

            toast.dataset.timeoutId = String(timeoutId);
        }

        function installApp() {
            if (!deferredInstallPrompt) {
                showToast('Tarayıcı menüsünden "Ana Ekrana Ekle" seçeneğini kullanabilirsin.', 5000);
                return;
            }

            deferredInstallPrompt.prompt();
            deferredInstallPrompt.userChoice.finally(() => {
                deferredInstallPrompt = null;
                dismissInstallBanner();
            });
        }

        function showInstallBanner() {
            const installBanner = document.getElementById('installBanner');

            if (installBanner) {
                installBanner.classList.remove('hidden');
                installBanner.classList.add('flex');
            }
        }

        function isMobileDevice() {
            return /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
        }

        function isStandaloneApp() {
            return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
        }

        function dismissInstallBanner() {
            const installBanner = document.getElementById('installBanner');

            if (installBanner) {
                installBanner.classList.add('hidden');
                installBanner.classList.remove('flex');
            }

            localStorage.setItem('kismetInstallDismissed', 'true');
        }

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                html.classList.add('light');
                document.body.classList.remove('bg-slate-950', 'text-slate-100');
                document.body.classList.add('bg-slate-200', 'text-slate-800');
                icon.className = 'fa-solid fa-sun text-lg text-amber-500';
            } else {
                html.classList.remove('light');
                html.classList.add('dark');
                document.body.classList.remove('bg-slate-200', 'text-slate-800');
                document.body.classList.add('bg-slate-950', 'text-slate-100');
                icon.className = 'fa-solid fa-moon text-lg text-slate-400';
            }
        }
    </script>
</body>

</html>