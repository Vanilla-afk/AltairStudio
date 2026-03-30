<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('welcome', [
            'brandName' => 'Altair Studio',
            'heroTitleStart' => 'Embrace Your Journey at',
            'heroTitleAccent' => 'Altair Studio',
            'heroDescription' => 'Discover a stellar sanctuary for your mind, body, and soul in the heart of La Trinidad. Reach for the stars with our premium wellness experiences.',
            'heroPrimaryCta' => 'Explore Classes',
            'heroSecondaryCta' => 'Meet Instructors',
            'bookTrialCta' => 'Book Trial',
            'navLinks' => [
                ['label' => 'Classes', 'href' => '#classes'],
                ['label' => 'Instructors', 'href' => '#instructors'],
                ['label' => 'Contact', 'href' => '#contact'],
            ],
            'classFilters' => ['All', 'Gentle', 'Moderate', 'Challenging', 'Mindfulness'],
            'classes' => [
                [
                    'visual' => 'wood',
                    'category' => 'Dynamic',
                    'title' => 'Vinyasa Flow',
                    'schedule' => 'Mon, Wed • 08:00 AM',
                    'instructor' => 'Elara Moon',
                ],
                [
                    'visual' => '',
                    'category' => 'Traditional',
                    'title' => 'Morning Hatha',
                    'schedule' => 'Tue, Thu • 07:00 AM',
                    'instructor' => 'Kai Rivers',
                ],
                [
                    'visual' => 'sea',
                    'category' => 'Calming',
                    'title' => 'Restorative Bliss',
                    'schedule' => 'Fri, Sun • 06:00 PM',
                    'instructor' => 'Seraphina Sun',
                ],
            ],
            'instructors' => [
                [
                    'name' => 'Elara Moon',
                    'role' => 'Studio Director & Lead Instructor',
                    'bio' => 'With over 15 years of experience, Elara specializes in Vinyasa and Power yoga.',
                    'tags' => ['Vinyasa Flow', 'Power Yoga', 'Pranayama'],
                ],
                [
                    'name' => 'Kai Rivers',
                    'role' => 'Senior Hatha Instructor',
                    'bio' => 'Kai brings a calm, grounded approach with a focus on alignment and accessibility.',
                    'tags' => ['Hatha Yoga', 'Yoga for Athletes', 'Alignment'],
                ],
                [
                    'name' => 'Seraphina Sun',
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
            'footerLine' => 'Altair Studio • Crafted with Laravel',
        ]);
    }
}
