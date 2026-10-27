{{--
    Material Symbols icon font, loaded without blocking render.
    Icons are written as text ligatures (e.g. "notifications"), so until the font has loaded the raw
    words would flash on screen. They stay hidden (and at most 1em wide) until the font is ready,
    with a 6s fallback so icons still appear if the font can't be fetched.
--}}
@php
    $iconFontUrl = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,wght@0..1,100..700&display=block';
@endphp
<style>
    html:not(.icons-ready) .material-symbols-outlined {
        visibility: hidden;
        max-width: 1em;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
<script>
    (function () {
        var ready = function () { document.documentElement.classList.add('icons-ready'); };
        window.__iconFontLoaded = function () {
            if (document.fonts && document.fonts.load) {
                document.fonts.load("24px 'Material Symbols Outlined'").then(ready, ready);
            } else {
                ready();
            }
        };
        setTimeout(ready, 6000);
    })();
</script>
<link rel="preload" as="style" href="{{ $iconFontUrl }}">
<link rel="stylesheet" href="{{ $iconFontUrl }}" media="print" onload="this.media='all'; window.__iconFontLoaded();">
<noscript>
    <link rel="stylesheet" href="{{ $iconFontUrl }}">
    <style>.material-symbols-outlined { visibility: visible !important; max-width: none !important; }</style>
</noscript>
