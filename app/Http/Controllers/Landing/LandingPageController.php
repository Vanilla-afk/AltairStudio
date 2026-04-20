<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        return view('landing.index', [
            'brandName' => 'Altair Studio',
            'heroTitleStart' => 'Embrace Your Journey at',
            'heroTitleAccent' => 'Altair Studio',
            'heroDescription' => 'Discover a stellar sanctuary for your mind, body, and soul in the heart of La Trinidad. Experience premium yoga, pilates, and wellness to reach for the stars.',
            'heroPrimaryCta' => 'Explore Classes',
            'heroSecondaryCta' => 'Meet Instructors',
            'bookTrialCta' => 'Book Trial',
            'navLinks' => [
                ['label' => 'Classes', 'href' => '#classes'],
                ['label' => 'Instructors', 'href' => '#instructors'],
                ['label' => 'Contact', 'href' => '#contact'],
            ],
            'scheduleMonth' => 'March',
            'scheduleNotice' => 'Please book your classes a day ahead.',
            'classesOffered' => [
                [
                    'name' => 'Aerial Yoga',
                    'description' => 'Float and find balance. Our Aerial Yoga classes combine traditional yoga poses with suspended support, building strength and flexibility.',
                ],
                [
                    'name' => 'Aerial Foundation',
                    'description' => 'Perfect for those new to aerial practice. Learn the fundamentals and build confidence with our certified instructors.',
                ],
                [
                    'name' => 'Aerial Power',
                    'description' => 'Take your aerial practice to the next level. Build advanced strength and master challenging techniques.',
                ],
                [
                    'name' => 'Hatha Yoga',
                    'description' => 'A grounded approach to yoga focusing on alignment and breath. Ideal for building a strong foundation.',
                ],
                [
                    'name' => 'Vinyasa',
                    'description' => 'Dynamic and energizing. Vinyasa flows synchronize breath with movement for a full-body workout.',
                ],
                [
                    'name' => 'Reformer Pilates',
                    'description' => 'Sculpt and strengthen with precision. Our Reformer Pilates sessions enhance posture, core stability, and total-body conditioning.',
                ],
            ],
            'weeklySchedule' => [
                [
                    'day' => 'Monday',
                    'slots' => [
                        ['time' => '10:00 AM', 'class' => 'Aerial Foundation'],
                        ['time' => '11:00 AM', 'class' => 'Aerial Power'],
                        ['time' => '4:00 PM', 'class' => 'Reformer Pilates', 'isNew' => true],
                        ['time' => '5:00 PM', 'class' => 'Reformer Pilates'],
                    ],
                ],
                [
                    'day' => 'Tuesday',
                    'slots' => [
                        ['time' => '9:00 AM', 'class' => 'Reformer Pilates', 'isNew' => true],
                        ['time' => '11:00 AM', 'class' => 'Reformer Pilates'],
                        ['time' => '1:00 PM', 'class' => 'Aerial Foundation'],
                        ['time' => '5:00 PM', 'class' => 'Aerial Foundation'],
                    ],
                ],
                [
                    'day' => 'Thursday',
                    'slots' => [
                        ['time' => '9:00 AM', 'class' => 'Reformer Pilates'],
                        ['time' => '11:00 AM', 'class' => 'Reformer Pilates'],
                        ['time' => '1:00 PM', 'class' => 'Reformer Pilates', 'isNew' => true],
                        ['time' => '5:00 PM', 'class' => 'Reformer Pilates'],
                    ],
                ],
                [
                    'day' => 'Friday',
                    'slots' => [
                        ['time' => '8:00 AM', 'class' => 'Aerial Foundation'],
                        ['time' => '9:00 AM', 'class' => 'Aerial Power'],
                        ['time' => '10:00 AM', 'class' => 'Vinyasa'],
                    ],
                ],
                [
                    'day' => 'Saturday',
                    'slots' => [
                        ['time' => '9:00 AM', 'class' => 'Hatha Yoga'],
                        ['time' => '10:00 AM', 'class' => 'Aerial Yoga'],
                    ],
                ],
                [
                    'day' => 'Sunday',
                    'slots' => [
                        ['time' => '9:00 AM', 'class' => 'Hatha Yoga'],
                        ['time' => '11:00 AM', 'class' => 'Aerial Yoga'],
                    ],
                ],
            ],
            'instructors' => [
                [
                    'name' => 'Arvin Pogi',
                    'role' => 'Studio Director & Lead Instructor',
                    'bio' => 'With over 15 years of experience, Elara specializes in Vinyasa and Power yoga.',
                    'tags' => ['Vinyasa Flow', 'Power Yoga', 'Pranayama'],
                ],
                [
                    'name' => 'Arvin Pogi',
                    'role' => 'Senior Hatha Instructor',
                    'bio' => 'Kai brings a calm, grounded approach with a focus on alignment and accessibility.',
                    'tags' => ['Hatha Yoga', 'Yoga for Athletes', 'Alignment'],
                ],
                [
                    'name' => 'Arvin Pogi',
                    'role' => 'Meditation & Yin Expert',
                    'bio' => 'Seraphina specializes in mindful classes designed for deep release and relaxation.',
                    'tags' => ['Yin Yoga', 'Restorative', 'Mindfulness'],
                ],
            ],
            'contactCards' => [
                [
                    'icon' => '◉',
                    'title' => 'Instagram',
                    'value' => '@alt.airfitness',
                    'href' => 'https://www.instagram.com/alt.airfitness/',
                    'description' => 'Follow us for studio highlights and updates.',
                ],
                [
                    'icon' => '♪',
                    'title' => 'TikTok',
                    'value' => '@alt.airfit',
                    'href' => 'https://www.tiktok.com/@alt.airfit',
                    'description' => 'Check out our latest workout reels and tips.',
                ],
                [
                    'icon' => 'f',
                    'title' => 'Facebook',
                    'value' => 'Altair Studio',
                    'href' => 'https://www.facebook.com/profile.php?id=61579397218613',
                    'description' => 'Visit our official Facebook page for updates and announcements.',
                ],
                [
                    'icon' => '✉',
                    'title' => 'Email',
                    'value' => 'altairfitness.studio@gmail.com',
                    'href' => 'mailto:altairfitness.studio@gmail.com',
                    'description' => 'Get in touch for membership and schedule inquiries.',
                ],
                [
                    'icon' => '☎',
                    'title' => 'Phone',
                    'value' => '0992 685 2720',
                    'href' => 'tel:+639926852720',
                    'description' => 'Call or text us for direct assistance.',
                ],
            ],
            'addressLine' => '4th floor, AE-69-A, Askay-Akien Elevens Bldg., Western Buyagan, La Trinidad, Philippines, 2601',
            'footerLine' => '© 2026 Altair Studio. All rights reserved.',
        ]);
    }
}
