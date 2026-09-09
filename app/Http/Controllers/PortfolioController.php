<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * GET /
     *
     * This method currently returns the same data the original front-end
     * mockData object held, structured identically, so the Blade
     * components need zero changes when this is swapped for real
     * Eloquent queries (settings, portfolio_sections, portfolio_elements,
     * projects, skills, experiences, testimonials, navigation,
     * social_links tables). See the "Future data source" notes inline
     * below for where each block would come from.
     */
    public function index(): View
    {
        $data = [

            // future: Settings::pluck('value', 'key') or a Settings model
            'settings' => [
                'site_name' => 'Aman Uniyal',
                'logo_text' => 'AU',
            ],

            // future: Navigation::where('is_enabled', true)->orderBy('sort_order')->get()
            'navigation' => [
                ['label' => 'Home', 'section_key' => 'hero', 'is_enabled' => true, 'sort_order' => 1],
                ['label' => 'About', 'section_key' => 'about', 'is_enabled' => true, 'sort_order' => 2],
                ['label' => 'Skills', 'section_key' => 'skills', 'is_enabled' => true, 'sort_order' => 3],
                ['label' => 'Projects', 'section_key' => 'projects', 'is_enabled' => true, 'sort_order' => 4],
                ['label' => 'Experience', 'section_key' => 'experience', 'is_enabled' => true, 'sort_order' => 5],
                ['label' => 'Contact', 'section_key' => 'contact', 'is_enabled' => true, 'sort_order' => 6],
            ],

            // future: PortfolioSection::where('is_enabled', true)->orderBy('sort_order')->get()
            //
            // NOTE (preserved from source, not a refactor change): the original
            // mockData.sections array never included a "skills" entry, even
            // though renderSkills()/#skills existed and the nav links to it.
            // That means the live site's Skills section was never actually
            // rendered — a pre-existing quirk in the source, not something
            // introduced here. This list is kept identical for visual/
            // functional parity. To turn the Skills section on, add:
            //   ['key' => 'skills', 'is_enabled' => true, 'sort_order' => 4],
            // and renumber the following sort_order values.
            'sections' => [
                ['key' => 'hero', 'is_enabled' => true, 'sort_order' => 1],
                ['key' => 'worked_with', 'is_enabled' => true, 'sort_order' => 2],
                ['key' => 'expanding', 'is_enabled' => true, 'sort_order' => 3],
                ['key' => 'about', 'is_enabled' => true, 'sort_order' => 4],
                ['key' => 'projects', 'is_enabled' => true, 'sort_order' => 5],
                ['key' => 'experience', 'is_enabled' => true, 'sort_order' => 6],
                ['key' => 'testimonials', 'is_enabled' => true, 'sort_order' => 7],
                ['key' => 'contact', 'is_enabled' => true, 'sort_order' => 8],
                ['key' => 'footer', 'is_enabled' => true, 'sort_order' => 9],
            ],

            // future: PortfolioElement::where('section', 'hero')->pluck('is_enabled', 'key')
            'heroElements' => [
                'greeting' => true, 'name' => true, 'role' => true, 'headline' => true, 'description' => true,
                'technology_badges' => true, 'profile_image' => true, 'floating_icons' => true,
                'code_card' => true, 'social_links' => true, 'primary_cta' => true, 'secondary_cta' => true,
                'background_glow' => true, 'particles' => false, 'orbit' => true, 'scroll_indicator' => true,
            ],

            // future: Hero::first() / a HeroContent model
            'hero' => [
                'greeting' => "Hi, I'm Aman Uniyal \u{1F44B}",
                'name' => 'Aman Uniyal',
                'role' => 'Backend Developer',
                'headline_line1' => 'BACKEND',
                'headline_line2' => 'DEVELOPER',
                'description_pre' => 'I build',
                'description_hl1' => 'scalable',
                'description_mid' => '&',
                'description_hl2' => 'secure',
                'description_post' => 'web solutions',
                'profile_image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=600&q=80',
                'cta_primary' => ['label' => 'View My Work', 'url' => '#projects', 'is_enabled' => true],
                'cta_secondary' => ['label' => 'Download CV', 'url' => '#', 'is_enabled' => true],
                'badges' => [
                    ['label' => 'PHP', 'is_enabled' => true, 'sort_order' => 1],
                    ['label' => 'Laravel', 'is_enabled' => true, 'sort_order' => 2],
                    ['label' => 'Node.js', 'is_enabled' => true, 'sort_order' => 3],
                    ['label' => 'MySQL', 'is_enabled' => true, 'sort_order' => 4],
                    ['label' => 'APIs', 'is_enabled' => true, 'sort_order' => 5],
                ],
                'floating_icons' => [
                    ['key' => 'php', 'label' => 'PHP', 'is_enabled' => true, 'top' => '8%', 'left' => '6%', 'bg' => '#777bb4'],
                    ['key' => 'laravel', 'label' => 'Laravel', 'is_enabled' => true, 'top' => '38%', 'left' => '0%', 'bg' => '#ff2d20'],
                    ['key' => 'javascript', 'label' => 'JavaScript', 'is_enabled' => true, 'top' => '68%', 'left' => '8%', 'bg' => '#f7df1e'],
                    ['key' => 'mysql', 'label' => 'MySQL', 'is_enabled' => true, 'top' => '10%', 'right' => '2%', 'bg' => '#00758f'],
                    ['key' => 'nodejs', 'label' => 'Node.js', 'is_enabled' => true, 'top' => '44%', 'right' => '-4%', 'bg' => '#3c873a'],
                ],
                'code_card_lines' => ['// code', '// build', '// deploy', '// repeat'],
            ],

            // future: SocialLink::where('is_enabled', true)->orderBy('sort_order')->get()
            'socialLinks' => [
                ['platform' => 'github', 'label' => 'GitHub', 'url' => 'https://github.com', 'is_enabled' => true, 'sort_order' => 1],
                ['platform' => 'linkedin', 'label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'is_enabled' => true, 'sort_order' => 2],
                ['platform' => 'email', 'label' => 'Email', 'url' => 'mailto:amanuniyal.dev@gmail.com', 'is_enabled' => true, 'sort_order' => 3],
                ['platform' => 'twitter', 'label' => 'X/Twitter', 'url' => 'https://x.com', 'is_enabled' => false, 'sort_order' => 4],
            ],

            // future: TechnologyGroup::with('technologies')->get()
            'technologyGroups' => [
                [
                    'key' => 'worked_with', 'title' => 'TECHNOLOGIES', 'subtitle' => 'I HAVE WORKED WITH', 'is_enabled' => true, 'speed' => 40,
                    'technologies' => [
                        ['name' => 'PHP', 'is_enabled' => true, 'bg' => '#4f5b93'],
                        ['name' => 'Laravel', 'is_enabled' => true, 'bg' => '#ff2d20'],
                        ['name' => 'MySQL', 'is_enabled' => true, 'bg' => '#00758f'],
                        ['name' => 'JavaScript', 'is_enabled' => true, 'bg' => '#f7df1e'],
                        ['name' => 'Node.js', 'is_enabled' => true, 'bg' => '#3c873a'],
                        ['name' => 'Next.js', 'is_enabled' => true, 'bg' => '#ffffff'],
                        ['name' => 'Git', 'is_enabled' => true, 'bg' => '#f05032'],
                        ['name' => 'jQuery', 'is_enabled' => true, 'bg' => '#0769ad'],
                    ],
                ],
                [
                    'key' => 'expanding', 'title' => 'TECHNOLOGIES', 'subtitle' => 'I AM EXPANDING IN', 'is_enabled' => true, 'speed' => 34, 'reverse' => true,
                    'technologies' => [
                        ['name' => 'Docker', 'is_enabled' => true, 'bg' => '#2496ed'],
                        ['name' => 'AWS', 'is_enabled' => true, 'bg' => '#ff9900'],
                        ['name' => 'TypeScript', 'is_enabled' => true, 'bg' => '#3178c6'],
                        ['name' => 'Redis', 'is_enabled' => true, 'bg' => '#dc382d'],
                        ['name' => 'GraphQL', 'is_enabled' => true, 'bg' => '#e10098'],
                        ['name' => 'Supabase', 'is_enabled' => true, 'bg' => '#3ecf8e'],
                        ['name' => 'CI/CD', 'is_enabled' => true, 'bg' => '#8a2be2'],
                        ['name' => 'Kubernetes', 'is_enabled' => true, 'bg' => '#326ce5'],
                    ],
                ],
            ],

            // future: About::first()
            'about' => [
                'eyebrow' => 'About Me',
                'heading_pre' => 'Passionate Developer',
                'heading_mid' => 'Problem Solver',
                'heading_hl' => 'Tech Enthusiast.',
                'description' => "I'm a backend developer with 2+ years of experience building secure, efficient and scalable web applications using modern technologies.",
                'code_lines' => [
                    ['key' => 'name', 'value' => '"Aman Uniyal"'],
                    ['key' => 'role', 'value' => '"Backend Developer"'],
                    ['key' => 'experience', 'value' => '"2+ years"'],
                    ['key' => 'skills', 'value' => '["PHP", "Laravel", "Node.js", "MySQL"]'],
                    ['key' => 'passion', 'value' => '"Building scalable solutions"'],
                    ['key' => 'goal', 'value' => '"Make an impact through code"'],
                ],
            ],

            // future: Skill::where('is_enabled', true)->orderBy('sort_order')->get()
            'skills' => [
                ['name' => 'PHP', 'level' => 90, 'is_enabled' => true, 'sort_order' => 1],
                ['name' => 'Laravel', 'level' => 85, 'is_enabled' => true, 'sort_order' => 2],
                ['name' => 'MySQL', 'level' => 88, 'is_enabled' => true, 'sort_order' => 3],
                ['name' => 'JavaScript', 'level' => 80, 'is_enabled' => true, 'sort_order' => 4],
                ['name' => 'Node.js', 'level' => 75, 'is_enabled' => true, 'sort_order' => 5],
                ['name' => 'Next.js', 'level' => 70, 'is_enabled' => true, 'sort_order' => 6],
            ],

            // future: Stat::where('is_enabled', true)->orderBy('sort_order')->get()
            'stats' => [
                ['value' => '2+', 'label' => 'Years Experience', 'is_enabled' => true, 'sort_order' => 1],
                ['value' => '15+', 'label' => 'Projects Completed', 'is_enabled' => true, 'sort_order' => 2],
                ['value' => '100%', 'label' => 'Client Satisfaction', 'is_enabled' => true, 'sort_order' => 3],
            ],

            // future: Project::where('is_enabled', true)->orderBy('sort_order')->get()
            'projects' => [
                [
                    'title' => 'NEET Universe', 'is_enabled' => true, 'sort_order' => 1,
                    'short_description' => 'Platform that predicts NEET rank & recommends colleges based on score. Integrated payments & Zoho meeting.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&q=80',
                    'technologies' => ['Laravel', 'MySQL', 'REST API'],
                    'live_url' => 'https://example.com', 'github_url' => null, 'case_study_url' => null,
                ],
                [
                    'title' => 'CRM System', 'is_enabled' => true, 'sort_order' => 2,
                    'short_description' => 'Customer relationship management system with role-based access, lead management and analytics.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&q=80',
                    'technologies' => ['Laravel', 'MySQL', 'JavaScript'],
                    'live_url' => 'https://example.com', 'github_url' => 'https://github.com', 'case_study_url' => null,
                ],
                [
                    'title' => 'SaaS Starter Kit', 'is_enabled' => true, 'sort_order' => 3,
                    'short_description' => 'Multi-tenant SaaS starter kit with authentication, subscription and payment integration.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80',
                    'technologies' => ['Next.js', 'Stripe', 'MySQL'],
                    'live_url' => null, 'github_url' => 'https://github.com', 'case_study_url' => 'https://example.com',
                ],
                [
                    'title' => 'E-Commerce Platform', 'is_enabled' => true, 'sort_order' => 4,
                    'short_description' => 'Modern e-commerce platform with secure payments and an admin dashboard.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=500&q=80',
                    'technologies' => ['Next.js', 'Stripe', 'Node.js'],
                    'live_url' => 'https://example.com', 'github_url' => 'https://github.com', 'case_study_url' => null,
                ],
            ],

            // future: Experience::where('is_enabled', true)->orderBy('sort_order')->get()
            'experiences' => [
                ['year' => '2023', 'position' => 'Backend Developer', 'is_enabled' => true, 'sort_order' => 1, 'is_active' => true,
                    'description' => 'Built and deployed multiple web applications using PHP, Laravel and MySQL.'],
                ['year' => '2024', 'position' => 'Full Stack Developer', 'is_enabled' => true, 'sort_order' => 2, 'is_active' => true,
                    'description' => 'Expanded skills with Node.js, Next.js and frontend technologies.'],
                ['year' => '2025', 'position' => 'Senior Developer', 'is_enabled' => true, 'sort_order' => 3, 'is_active' => true,
                    'description' => 'Working on scalable systems, APIs and cloud deployments (AWS).'],
                ['year' => '2026+', 'position' => 'Building the Future', 'is_enabled' => true, 'sort_order' => 4, 'is_active' => false,
                    'description' => 'Continuously learning, contributing to open source and solving real problems.'],
            ],

            // future: Testimonial::where('is_enabled', true)->orderBy('sort_order')->get()
            'testimonials' => [
                ['name' => 'Rahul Sharma', 'designation' => 'CEO', 'company' => 'NEET Universe', 'is_enabled' => true, 'sort_order' => 1,
                    'testimonial' => 'Aman delivered exactly what we needed. Great communication and excellent work quality.',
                    'avatar' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=100&q=80'],
                ['name' => 'Priya Mehta', 'designation' => 'CTO', 'company' => 'CRM System', 'is_enabled' => true, 'sort_order' => 2,
                    'testimonial' => 'Superb developer! He understood our requirements and built a robust solution on time.',
                    'avatar' => 'https://images.unsplash.com/photo-1607746882042-944635dfe10e?w=100&q=80'],
                ['name' => 'Karan Verma', 'designation' => 'Founder', 'company' => 'SaaS Starter Kit', 'is_enabled' => true, 'sort_order' => 3,
                    'testimonial' => 'Very professional and skilled in modern technologies. Highly recommended!',
                    'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&q=80'],
            ],

            // future: Contact::first()
            'contact' => [
                'heading_pre' => "Let's Build Something",
                'heading_hl' => 'Amazing',
                'heading_post' => 'Together',
                'email' => 'amanuniyal.dev@gmail.com',
                'location' => 'Dehradun, India',
                'phone' => '+91 98765 43210',
            ],

            // future: Footer::first() with FooterColumn/FooterLink relations
            'footer' => [
                'brand' => 'AU',
                'description' => 'Building scalable backend systems and clean web experiences, one project at a time.',
                'columns' => [
                    ['title' => 'Navigation', 'is_enabled' => true, 'sort_order' => 1, 'links' => [
                        ['label' => 'Home', 'url' => '#hero', 'is_enabled' => true],
                        ['label' => 'About', 'url' => '#about', 'is_enabled' => true],
                        ['label' => 'Skills', 'url' => '#worked_with', 'is_enabled' => true],
                        ['label' => 'Projects', 'url' => '#projects', 'is_enabled' => true],
                        ['label' => 'Experience', 'url' => '#experience', 'is_enabled' => true],
                        ['label' => 'Contact', 'url' => '#contact', 'is_enabled' => true],
                    ]],
                    ['title' => 'Services', 'is_enabled' => true, 'sort_order' => 2, 'links' => [
                        ['label' => 'Backend Development', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'API Development', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Web Application', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Database Design', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Code Optimization', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Maintenance', 'url' => '#', 'is_enabled' => true],
                    ]],
                    ['title' => 'Resources', 'is_enabled' => true, 'sort_order' => 3, 'links' => [
                        ['label' => 'GitHub', 'url' => 'https://github.com', 'is_enabled' => true],
                        ['label' => 'Resume / CV', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Blog (Coming Soon)', 'url' => '#', 'is_enabled' => true],
                        ['label' => 'Projects', 'url' => '#projects', 'is_enabled' => true],
                        ['label' => 'Achievements', 'url' => '#', 'is_enabled' => true],
                    ]],
                ],
                'copyright' => "\u{00A9} 2026 Aman Uniyal. All rights reserved.",
            ],
        ];

        return view('portfolio.index', $data);
    }
}
