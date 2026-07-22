<?php
if (! function_exists('formatDateFr')) {
    /** Formate une date en français lisible (ex: "3 janvier 2026"). */
    function formatDateFr(?string $date): string
    {
        if (! $date) {
            return '';
        }

        $mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        $ts   = strtotime($date);

        return (int) date('j', $ts) . ' ' . $mois[(int) date('n', $ts) - 1] . ' ' . date('Y', $ts);
    }
}

if (! function_exists('navActive')) {
    /** Retourne 'active' si l'URI courante correspond au segment donné (ou y commence, si $prefix). */
    function navActive(string $segment, bool $prefix = false): string
    {
        $uri = trim(uri_string(), '/');

        $match = $prefix ? str_starts_with($uri, $segment) : $uri === $segment;

        return $match ? 'active' : '';
    }
}

if (! function_exists('lelTriLien')) {
    /** Lien de tri pour un en-tête de tableau admin : bascule asc/desc, affiche une flèche sur la colonne active. */
    function lelTriLien(string $route, string $colonne, string $label, string $triActuel, string $direction): string
    {
        $dirLien = ($triActuel === $colonne && $direction === 'asc') ? 'desc' : 'asc';
        $fleche  = $triActuel === $colonne ? ($direction === 'asc' ? ' ▲' : ' ▼') : '';
        $url     = site_url($route) . '?tri=' . urlencode($colonne) . '&dir=' . $dirLien;

        return '<a href="' . esc($url) . '" style="color:inherit; text-decoration:none;">' . esc($label) . $fleche . '</a>';
    }
}

if (! function_exists('icon')) {
    /**
     * Rend une icône SVG inline (trait, 1.5px, currentColor) à partir d'une clé courte.
     * Remplace les emojis stockés en base (categories.icone, cta_modeles.icone) et les
     * icônes statiques du back-office. Clé inconnue -> cercle générique (jamais de vide/casse).
     */
    function icon(?string $name, string $class = ''): string
    {
        $paths = [
            'home'     => '<path d="M4 11.5 12 4l8 7.5" /><path d="M6 10v9a1 1 0 0 0 1 1h4v-6h2v6h4a1 1 0 0 0 1-1v-9" />',
            'leaf'     => '<path d="M5 20c8 0 14-6 14-14V4h-2C9 4 5 10 5 18v2Z" /><path d="M5 20c0-4 3-8 7-10" />',
            'book'     => '<path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5A1.5 1.5 0 0 1 4 18.5v-13Z" /><path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5a1.5 1.5 0 0 0 1.5-1.5v-13Z" />',
            'map'      => '<path d="M12 21s7-6.1 7-11.5a7 7 0 1 0-14 0C5 14.9 12 21 12 21Z" /><circle cx="12" cy="9.5" r="2.3" />',
            'link'     => '<path d="M9 15 15 9" /><path d="M10 6.5 11.5 5a3.5 3.5 0 0 1 5 5L15 11.5" /><path d="M14 17.5 12.5 19a3.5 3.5 0 0 1-5-5L9 12.5" />',
            'school'   => '<path d="M3 21h18" /><path d="M5 21V9l7-4 7 4v12" /><path d="M10 21v-6h4v6" /><path d="M9 12h.01M15 12h.01M9 9h.01M15 9h.01" />',
            'heart'    => '<path d="M12 20.2C7 16.9 3.5 13.7 3.5 9.9 3.5 7.2 5.6 5 8.3 5c1.5 0 3 .7 3.7 1.9C12.7 5.7 14.2 5 15.7 5c2.7 0 4.8 2.2 4.8 4.9 0 3.8-3.5 7-8.5 10.3Z" />',
            'userplus' => '<circle cx="9" cy="8" r="3.2" /><path d="M3.5 20c.7-3.4 3-5.3 5.5-5.3s4.8 1.9 5.5 5.3" /><path d="M18 8.5v5M20.5 11h-5" />',
            'users'    => '<circle cx="8.5" cy="8" r="3" /><circle cx="16" cy="9" r="2.4" /><path d="M3 20c.6-3.2 2.7-5 5.5-5s4.9 1.8 5.5 5" /><path d="M14.5 15.2c2.1.4 3.6 1.9 4 4.8" />',
            'mega'     => '<path d="M4 10.5v3a1.5 1.5 0 0 0 1.5 1.5H7l5 4V5l-5 4H5.5A1.5 1.5 0 0 0 4 10.5Z" /><path d="M14 9.5a3.5 3.5 0 0 1 0 5M17 7a7 7 0 0 1 0 10" />',
            'mail'     => '<rect x="3.5" y="5.5" width="17" height="13" rx="1.8" /><path d="m4.5 7 7.5 6 7.5-6" />',
            'chart'    => '<path d="M4 20V10M10 20V4M16 20v-7M4 20h16" />',
            'news'     => '<rect x="4" y="5" width="16" height="15" rx="1.5" /><path d="M8 9h8M8 12.5h8M8 16h5" />',
            'plus'     => '<circle cx="12" cy="12" r="8.5" /><path d="M12 8.5v7M8.5 12h7" />',
            'globe'    => '<circle cx="12" cy="12" r="8.5" /><path d="M3.5 12h17M12 3.5c2.5 2.3 3.8 5.3 3.8 8.5s-1.3 6.2-3.8 8.5c-2.5-2.3-3.8-5.3-3.8-8.5S9.5 5.8 12 3.5Z" />',
            'logout'   => '<path d="M9 20H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h3" /><path d="M15 16l4-4-4-4" /><path d="M19 12H9" />',
            'eye'      => '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z" /><circle cx="12" cy="12" r="2.8" />',
            'trash'    => '<path d="M4.5 7h15M9.5 7V5a1.5 1.5 0 0 1 1.5-1.5h2A1.5 1.5 0 0 1 14.5 5v2M6.5 7l.8 12a1.5 1.5 0 0 0 1.5 1.4h6.4a1.5 1.5 0 0 0 1.5-1.4L17.5 7" />',
            'save'     => '<path d="M5 4.5h11L20 8.5V19a.5.5 0 0 1-.5.5h-13A.5.5 0 0 1 6 19V5a.5.5 0 0 1-.5-.5Z" /><path d="M8 4.5V9h7V4.5M8 14h8v5.5H8Z" />',
            'menu'     => '<path d="M4 7h16M4 12h16M4 17h16" />',
            'graduation'  => '<path d="M2 9 12 4l10 5-10 5L2 9Z" /><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5" /><path d="M21 9v6" />',
            'person'      => '<circle cx="12" cy="8" r="3.3" /><path d="M5 20c.8-3.8 3.3-5.8 7-5.8s6.2 2 7 5.8" />',
            'briefcase'   => '<rect x="3.5" y="8" width="17" height="11" rx="1.8" /><path d="M9 8V6.3A1.8 1.8 0 0 1 10.8 4.5h2.4A1.8 1.8 0 0 1 15 6.3V8" /><path d="M3.5 13.5h17" />',
            'rocket'      => '<path d="M12 2.5c3 2.2 5 6.3 5 10 0 2.2-1 4.3-2.2 5.6l-.8-3.1h-4l-.8 3.1C7.9 16.8 7 14.7 7 12.5c0-3.7 2-7.8 5-10Z" /><circle cx="12" cy="10.5" r="1.6" /><path d="M8.5 16.5l-2 3.5M15.5 16.5l2 3.5" />',
            'star'        => '<path d="M12 3.3l2.5 5.2 5.7.6-4.2 3.9 1.2 5.6L12 15.9l-5.2 2.7 1.2-5.6-4.2-3.9 5.7-.6L12 3.3Z" />',
            'bulb'        => '<path d="M9.3 18h5.4M10 21h4" /><path d="M7 10.2a5 5 0 1 1 8.6 3.5c-.9 1-1.4 1.7-1.7 2.6H9.1c-.3-.9-.8-1.6-1.7-2.6A5 5 0 0 1 7 10.2Z" />',
            'construction' => '<path d="M4 21V9l6-4v16" /><path d="M10 21V5.5l8 3.5v12" /><path d="M3 21h18" /><path d="M13.5 10.5h4M13.5 14.5h4" />',
            'target'      => '<circle cx="12" cy="12" r="8.2" /><circle cx="12" cy="12" r="4.6" /><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none" />',
            'dice'        => '<rect x="4.5" y="4.5" width="15" height="15" rx="3.2" /><circle cx="8.7" cy="8.7" r="1.1" fill="currentColor" stroke="none" /><circle cx="15.3" cy="8.7" r="1.1" fill="currentColor" stroke="none" /><circle cx="12" cy="12" r="1.1" fill="currentColor" stroke="none" /><circle cx="8.7" cy="15.3" r="1.1" fill="currentColor" stroke="none" /><circle cx="15.3" cy="15.3" r="1.1" fill="currentColor" stroke="none" />',
            'ruler'       => '<path d="M4 15.5 15.5 4l4.5 4.5L8.5 20 4 15.5Z" /><path d="M13 6.5l2 2M10 9.5l2 2M7 12.5l2 2" />',
        ];

        $inner = $paths[$name] ?? '<circle cx="12" cy="12" r="8.5" />';
        $cls   = $class !== '' ? ' class="' . esc($class, 'attr') . '"' : '';

        return '<svg' . $cls . ' viewBox="0 0 24 24" width="1em" height="1em" fill="none" stroke="currentColor" '
            . 'stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
            . $inner . '</svg>';
    }
}
