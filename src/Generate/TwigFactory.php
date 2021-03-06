<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\SiteGenerator\Generate;

use ScriptFUSION\Steam250\SiteGenerator\Application;
use ScriptFUSION\Steam250\SiteGenerator\SteamApp\Tag;

final class TwigFactory
{
    public function create(string $ext): \Twig_Environment
    {
        $twig = new \Twig_Environment(
            new \Twig_Loader_Filesystem(Application::getAppPath('template')),
            [
                'strict_variables' => true,
            ]
        );

        $twig->addFilter(new \Twig_Filter('tag_id', [Tag::class, 'convertTagToId']));
        $twig->addFilter(new \Twig_Filter('adaptive_date', [Date::class, 'adapt']));
        $twig->addFunction(new \Twig_Function('tz', static function (): string {
            return date_default_timezone_get();
        }));
        $twig->addGlobal('ext', $ext);
        $twig->addGlobal('patreon', 'https://www.patreon.com/steam250/overview');

        return $twig;
    }
}
