<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\BlogPost;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create();

        // === Static Pages ===
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $sitemap->add(
            Url::create('/portfolio')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create('/blog')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create('/donasi-katalog')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7)
        );

        $sitemap->add(
            Url::create('/tracking')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.5)
        );

        $sitemap->add(
            Url::create('/klaim-garansi')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.5)
        );

        // === Blog Posts ===
        if (class_exists(BlogPost::class)) {
            BlogPost::where('is_published', true)
                ->orderByDesc('created_at')
                ->get()
                ->each(function (BlogPost $post) use ($sitemap) {
                    $sitemap->add(
                        Url::create("/blog/{$post->slug}")
                            ->setLastModificationDate($post->updated_at ?? $post->created_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.7)
                    );
                });
        }

        // === Portfolio / Projects ===
        if (class_exists(Project::class)) {
            Project::where('is_active', true)
                ->orderByDesc('created_at')
                ->get()
                ->each(function (Project $project) use ($sitemap) {
                    $sitemap->add(
                        Url::create("/portfolio")
                            ->setLastModificationDate($project->updated_at ?? $project->created_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.6)
                    );
                });
        }

        return $sitemap->toResponse(request());
    }
}
