<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $brandName ?? 'Altair Studio' }} | Yoga Landing Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,600;0,700;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.css') }}">
</head>

<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="#home" aria-label="{{ $brandName ?? 'Altair Studio' }} home">
                <span class="brand-mark" aria-hidden="true">
                    <img src="{{ asset('images/LogoAltair.png') }}" alt="">
                </span>
                <span>{{ $brandName ?? 'Altair Studio' }}</span>
            </a>

            <nav class="nav-links" aria-label="Main menu">
                @foreach ($navLinks ?? [] as $navLink)
                    <a href="{{ $navLink['href'] }}">{{ $navLink['label'] }}</a>
                @endforeach
            </nav>

            <a class="book-btn" href="#contact">{{ $bookTrialCta ?? 'Book Trial' }}</a>
        </div>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="hero-orb a" aria-hidden="true"></div>
            <div class="hero-orb b" aria-hidden="true"></div>
            <div class="container hero-content">
                <h1>
                    {{ $heroTitleStart ?? 'Embrace Your Journey at' }}
                    <em>{{ $heroTitleAccent ?? 'Altair Studio' }}</em>
                </h1>
                <p>{{ $heroDescription ?? '' }}</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="#classes">{{ $heroPrimaryCta ?? 'Explore Classes' }}</a>
                    <a class="btn btn-secondary" href="#instructors">{{ $heroSecondaryCta ?? 'Meet Instructors' }}</a>
                </div>
            </div>
        </section>

        <section class="classes" id="classes">
            <div class="container">
                <div class="section-header reveal" data-delay="0.05">
                    <div>
                        <h2>Schedule for {{ $scheduleMonth ?? 'March' }}</h2>
                        <p>
                            {{ $scheduleNotice ?? 'Please book your classes a day ahead.' }}
                        </p>
                    </div>
                </div>

                <div class="schedule-grid scroll-stage schedule-stage">
                    @foreach ($weeklySchedule ?? [] as $daySchedule)
                        <article class="schedule-day scroll-item" style="--stagger: {{ $loop->index }};">
                            <h3>{{ $daySchedule['day'] }}</h3>
                            <div class="slot-list">
                                @foreach ($daySchedule['slots'] ?? [] as $slot)
                                    <div class="slot-row">
                                        <div class="slot-time">{{ $slot['time'] }}</div>
                                        <div class="slot-class">
                                            {{ $slot['class'] }}
                                            @if (!empty($slot['isNew']))
                                                <span class="slot-badge">New</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="instructors" id="instructors">
            <div class="container">
                <div class="section-header reveal" data-delay="0.06">
                    <div>
                        <h2>Guided by Masters</h2>
                        <p>
                            Our certified instructors bring passion, wisdom, and diverse perspectives to help
                            you grow your practice.
                        </p>
                    </div>
                </div>

                <div class="coach-grid scroll-stage coach-stage">
                    @foreach ($instructors ?? [] as $coach)
                        <article class="coach scroll-item" style="--stagger: {{ $loop->index }};">
                            <div class="coach-photo"></div>
                            <h3>{{ $coach['name'] }}</h3>
                            <div class="coach-role">{{ $coach['role'] }}</div>
                            <p>{{ $coach['bio'] }}</p>
                            <div class="tag-list">
                                @foreach ($coach['tags'] ?? [] as $tag)
                                    <span class="tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="yoga-gallery" id="gallery">
            <div class="container">
                <div class="section-header reveal" data-delay="0.05">
                    <div>
                        <h2>Yoga Moments</h2>
                        <p>
                            A glimpse of our shared practice through real moments captured in class.
                        </p>
                    </div>
                </div>

                <div class="gallery-carousel reveal" data-delay="0.12" aria-label="Yoga class photo carousel">
                    @php
                        $galleryPlaceholders = [
                            ['id' => '01', 'src' => asset('images/pic1.jpg')],
                            ['id' => '02', 'src' => asset('images/pic2.jpg')],
                            ['id' => '03', 'src' => asset('images/pic3.JPG')],
                            ['id' => '04', 'src' => asset('images/pic4.JPG')],
                            ['id' => '05', 'src' => asset('images/pic5.jpg')],
                        ];
                        $gallerySlides = array_merge($galleryPlaceholders, $galleryPlaceholders);
                    @endphp

                    <div class="gallery-track" role="list">
                        @foreach ($gallerySlides as $slide)
                            <article class="gallery-slide" role="listitem" tabindex="0">
                                <img src="{{ $slide['src'] }}" alt="Yoga gallery photo {{ $slide['id'] }}"
                                    loading="lazy">
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="container">
                <div class="section-header reveal" data-delay="0.05">
                    <div>
                        <h2>Connect With Us</h2>
                        <p>
                            Ready to start your journey? Reach out through any of our channels or visit us in
                            La Trinidad.
                        </p>
                    </div>
                </div>

                <div class="contacts-grid">
                    @foreach ($contactCards ?? [] as $contact)
                        <article class="contact-card reveal" data-delay="{{ 0.1 + $loop->index * 0.06 }}">
                            <div class="icon-pill">{{ $contact['icon'] }}</div>
                            <h4>{{ $contact['title'] }}</h4>
                            @php
                                $contactHref = $contact['href'] ?? '#';
                                $isExternal =
                                    str_starts_with($contactHref, 'http://') ||
                                    str_starts_with($contactHref, 'https://');
                            @endphp
                            <a class="contact-main" href="{{ $contactHref }}"
                                @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif>{{ $contact['value'] }}</a>
                            <p>{{ $contact['description'] }}</p>
                        </article>
                    @endforeach
                </div>

                <p class="address reveal" data-delay="0.2">{{ $addressLine ?? '' }}</p>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">{{ $footerLine ?? '' }}</div>
    </footer>

    <button class="back-to-top" type="button" aria-label="Back to top" title="Back to top">
        ↑
    </button>

    <script src="{{ asset('assets/landing/js/landing.js') }}" defer></script>
</body>

</html>
