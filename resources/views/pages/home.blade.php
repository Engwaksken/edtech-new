<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#102b25">
    <title>EdTech Fellowship | Mastercard Foundation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f6f5ef] text-[#172b25] antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:text-[#172b25]">Skip to main content</a>

    <header class="border-b border-[#172b25]/10 bg-[#f6f5ef]">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-5 sm:px-8 lg:px-12">
            <a href="#main" class="max-w-xs font-semibold leading-tight tracking-tight text-[#172b25]" aria-label="Mastercard Foundation EdTech Fellowship home">
                <span class="block text-sm sm:text-base">Mastercard Foundation</span>
                <span class="mt-1 block text-xs font-medium tracking-wide text-[#52665d]">EdTech Fellowship</span>
            </a>
            <nav aria-label="Main navigation" class="flex items-center gap-5 text-sm font-medium sm:gap-8">
                <a class="hidden text-[#42574e] underline-offset-4 hover:text-[#172b25] hover:underline sm:inline" href="#about">About</a>
                <a class="text-[#42574e] underline-offset-4 hover:text-[#172b25] hover:underline" href="#phases">Programme phases</a>
            </nav>
        </div>
    </header>

    <main id="main">
        <section aria-labelledby="hero-title" class="relative isolate overflow-hidden bg-[#102b25] text-white">
            <div aria-hidden="true" class="absolute -right-28 -top-40 h-[32rem] w-[32rem] rounded-full border border-white/10 sm:right-[-5rem] sm:top-[-18rem] sm:h-[48rem] sm:w-[48rem]"></div>
            <div aria-hidden="true" class="absolute right-10 top-16 h-56 w-56 rounded-full border border-[#d8f078]/25 sm:right-36 sm:top-24 sm:h-80 sm:w-80"></div>
            <div class="relative mx-auto grid max-w-7xl gap-12 px-5 py-20 sm:px-8 sm:py-28 lg:grid-cols-[1.15fr_.85fr] lg:items-center lg:px-12 lg:py-32">
                <div class="max-w-3xl">
                    <p class="mb-6 text-xs font-semibold uppercase tracking-[0.2em] text-[#d8f078]">Learning. Opportunity. Possibility.</p>
                    <h1 id="hero-title" class="max-w-3xl text-4xl font-semibold leading-[1.08] tracking-tight sm:text-6xl lg:text-7xl">Building EdTech for a more inclusive future</h1>
                    <p class="mt-7 max-w-2xl text-lg leading-8 text-white/75 sm:text-xl">The Mastercard Foundation EdTech Fellowship is a growth-stage venture acceleration programme focused on learning impact and responsible scale.</p>
                    <a href="#about" class="mt-9 inline-flex min-h-12 items-center gap-3 rounded-full bg-[#d8f078] px-6 py-3 text-sm font-semibold text-[#102b25] transition hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#d8f078]">
                        Explore the programme <span aria-hidden="true">↓</span>
                    </a>
                </div>
                <div aria-label="Illustration of connected ideas and learning" role="img" class="relative mx-auto flex aspect-square w-full max-w-sm items-center justify-center sm:max-w-md">
                    <div class="absolute inset-5 rounded-full border border-white/20"></div>
                    <div class="absolute inset-14 rounded-full border border-white/20"></div>
                    <div class="absolute inset-24 rounded-full bg-[#d8f078]"></div>
                    <div class="relative flex h-32 w-32 items-center justify-center rounded-full bg-[#f3a47a] text-center text-sm font-semibold leading-5 text-[#172b25] shadow-xl sm:h-40 sm:w-40 sm:text-base">
                        Ideas that<br>move learning
                    </div>
                    <span class="absolute right-5 top-12 h-5 w-5 rounded-full bg-[#d8f078] sm:right-8 sm:top-16 sm:h-7 sm:w-7"></span>
                    <span class="absolute bottom-10 left-7 h-4 w-4 rounded-full bg-[#f3a47a] sm:bottom-14 sm:left-10 sm:h-6 sm:w-6"></span>
                </div>
            </div>
        </section>

        <section id="about" aria-labelledby="about-title" class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28 lg:px-12">
            <div class="grid gap-8 md:grid-cols-[.8fr_1.2fr] md:gap-16">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#527568]">The fellowship</p>
                    <h2 id="about-title" class="mt-4 text-3xl font-semibold leading-tight tracking-tight sm:text-4xl">Supporting ventures to grow with purpose.</h2>
                </div>
                <div class="max-w-2xl">
                    <p class="text-lg leading-8 text-[#52635b]">The Mastercard Foundation EdTech Fellowship is a growth-stage venture acceleration programme. Its two programme phases support inclusive design, learning impact, and responsible scale.</p>
                    <a href="#phases" class="mt-6 inline-flex items-center gap-2 font-semibold text-[#245442] underline decoration-[#a5bd86] decoration-2 underline-offset-4 hover:text-[#102b25] focus-visible:rounded-sm focus-visible:outline-2 focus-visible:outline-offset-4">Discover the two programme phases <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>

        <section id="phases" aria-labelledby="phases-title" class="bg-[#e8ece2]">
            <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28 lg:px-12">
                <div class="max-w-2xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#527568]">How it works</p>
                    <h2 id="phases-title" class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Two programme phases</h2>
                    <p class="mt-4 text-lg leading-8 text-[#52635b]">A clear progression from designing for impact to growing responsibly.</p>
                </div>
                <ol class="mt-12 grid gap-5 md:grid-cols-2">
                    <li class="rounded-2xl bg-white p-7 shadow-sm sm:p-10">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#d8f078] text-sm font-bold text-[#172b25]" aria-label="Phase 1">01</span>
                        <h3 class="mt-7 text-2xl font-semibold tracking-tight">Design for inclusion and learning impact</h3>
                        <p class="mt-4 leading-7 text-[#52635b]">A phase centered on designing with inclusion and learning impact in view.</p>
                    </li>
                    <li class="rounded-2xl bg-[#102b25] p-7 text-white shadow-sm sm:p-10">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#f3a47a] text-sm font-bold text-[#172b25]" aria-label="Phase 2">02</span>
                        <h3 class="mt-7 text-2xl font-semibold tracking-tight">Acceleration for responsible scale</h3>
                        <p class="mt-4 leading-7 text-white/75">A phase focused on acceleration for responsible scale.</p>
                    </li>
                </ol>
            </div>
        </section>
    </main>

    <footer class="border-t border-[#172b25]/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-8 text-sm text-[#52635b] sm:px-8 md:flex-row md:items-center md:justify-between lg:px-12">
            <p class="font-medium text-[#172b25]">Mastercard Foundation EdTech Fellowship</p>
            <p>Growth-stage venture acceleration for learning impact and responsible scale.</p>
        </div>
    </footer>
</body>
</html>
