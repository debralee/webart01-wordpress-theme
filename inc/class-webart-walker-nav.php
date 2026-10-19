<?php
if (! defined('ABSPATH')) {
    exit;
}

class WebArt_Walker_Nav extends Walker_Nav_Menu
{
    private $current_id = 0;

    // Submenu <ul> (the dropdown)
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul id="wa-sub-' . (int) $this->current_id . '" data-wa-dropdown
			class="hidden mt-1 ml-3 rounded-lg border border-white/10 bg-navy p-2 text-sm
			       md:absolute md:left-0 md:top-full md:m-0 md:mt-4 md:w-56 md:shadow-xl">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }

    // Each <li>
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $this->current_id = $item->ID;

        $classes      = (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes, true);
        $is_cta       = in_array('wa-cta', $classes, true);
        $is_current   = ! empty($item->current) || ! empty($item->current_item_ancestor);
        $title        = apply_filters('the_title', $item->title, $item->ID);
        $url          = ! empty($item->url) ? $item->url : '#';
        $aria         = ! empty($item->current) ? ' aria-current="page"' : '';

        // Flat mode (footer): plain links, no dropdowns or CTA styling
        if (! empty($args->wa_flat)) {
            $link_class = ! empty($args->wa_link_class) ? $args->wa_link_class : '';
            $output .= '<li><a href="' . esc_url($url) . '" class="' . esc_attr($link_class) . '"' . $aria . '>'
                . esc_html($title) . '</a>';
            return;
        }

        // Dropdown items
        if ($depth > 0) {
            $output .= '<li><a href="' . esc_url($url) . '" class="block rounded p-2 hover:bg-white/10"' . $aria . '>'
                . esc_html($title) . '</a>';
            return;
        }

        // CTA button, e.g. "Get in touch"
        if ($is_cta) {
            $output .= '<li class="mt-2 md:ml-2 md:mt-0"><a href="' . esc_url($url) . '"'
                . ' class="block rounded-lg bg-ice px-5 py-2 text-center font-semibold text-navy transition-colors hover:bg-white md:inline-block"'
                . $aria . '>' . esc_html($title) . '</a>';
            return;
        }

        // Top-level item with a dropdown
        if ($has_children) {
            $output .= '<li class="relative">'
                . '<button type="button" data-wa-dropdown-btn aria-expanded="false" aria-controls="wa-sub-' . (int) $item->ID . '"
				class="flex w-full items-center gap-1.5 rounded px-3 py-2 text-left hover:text-ice md:w-auto md:p-0'
                . ($is_current ? ' text-ice' : '') . '">'
                . esc_html($title)
                . '<svg data-wa-icon class="h-4 w-4 transition-transform" aria-hidden="true" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
			</svg></button>';
            return;
        }

        // Plain top-level item
        $output .= '<li><a href="' . esc_url($url) . '" class="block rounded px-3 py-2 hover:text-ice md:p-0'
            . ($is_current ? ' text-ice' : '') . '"' . $aria . '>'
            . esc_html($title) . '</a>';
    }
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
