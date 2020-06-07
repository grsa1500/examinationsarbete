<?php

namespace Horizon\Theme;

/** Sidtitlar */
function title()
{
    if (is_home()) {
        if (get_option('page_for_posts', true)) {
            return get_the_title(get_option('page_for_posts', true));
        } else {
            return __('Senaste inlägg', 'horizon');
        }
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        /* translators: %s: search term */
        return sprintf(__('Sökresultat för %s', 'horizon'), get_search_query());
    } elseif (is_404()) {
        return __('Error 404 - Sidan hittades inte', 'horizon');
    }
    
    return get_the_title();
}

/**
 * Lägg till en ändelse efter de retunerade orden på the_excerpt
 *
 * @param int $limit Antal ord.
 */
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(' ', $excerpt) . '...';
    } else {
        $excerpt = implode(' ', $excerpt);
    }

    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

/**
 * Ange vilka sidor sidebaren SKA visas på
 *
 * @link https://codex.wordpress.org/Conditional_Tags
 */
function display_sidebar()
{
    static $display;
    if (!isset($display) && !is_front_page()) {
        $pages = [
            // is_404(),
            is_singular('post_type'),
            // is_page(),
            is_search(),
            
            // is_home(),
        ];

        $display = in_array(true, $pages, true);
    }
    return apply_filters('horizon/display_sidebar', $display);
}

/** Pagination */
function pagination()
{
    global $wp_query;
    $big = PHP_INT_MAX;
    echo wp_kses_post(paginate_links([
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
    ]));
}

/** Breadcrumbs */
function breadcrumbs()
{
    // Avdelare mellan brödsmuleobjekt
    $avdelare = '<span class="delimiter">&raquo;</span> ';
    
    // Hem-text
    $hem_label = __('Start', 'horizon');

    // Kod före brödsmula
    $before = '<span>';

    // Kod efter brödsmula
    $after = '</span>';

    global $post;
    $home = home_url();

    echo '<div class="breadcrumbs">';
    echo '<a href="' . esc_url($home) . '">' . esc_html($hem_label) . '</a> ' . wp_kses_post($avdelare);

    if (is_category()) {
        // Skriv ut följande om det är en kategorisida
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $category = $cat_obj->term_id;
        $category = get_category($category);
        $parent_category = get_category($category->parent);

        if ($category->parent !== 0) {
            echo wp_kses_post(get_category_parents($parent_category, true, ' ' . $avdelare . ' '));
        }

        echo wp_kses_post($before . 'Arkiv för: ' . single_cat_title('', false) . $after);
    } elseif (is_day()) {
        // Skriv ut följande om det är arkivsida för en dag
        echo wp_kses_post(
            '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' .
            $avdelare . ' ' .
            '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' .
            $avdelare . ' ' .
            $before . 'Arkiv för datum: ' . get_the_time('d') . $after
        );
    } elseif (is_month()) {
        // Skriv ut följande om det är arkivsida för en månad
        echo wp_kses_post(
            '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' .
            $avdelare . ' ' .
            $before . 'Arkiv för månad: ' . get_the_time('F') . $after
        );
    } elseif (is_year()) {
        // Skriv ut följande om det är arkivsida för ett år
        echo wp_kses_post($before . 'Arkiv för år: ' . get_the_time('Y') . $after);
    } elseif (is_single() && !is_attachment()) {
        // Skriv ut följande om det är en singelsida men INTE en singelsida för en bilaga
        if (get_post_type() !== 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo wp_kses_post(
                '<a href="' . $home . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' .
                $avdelare . ' ' .
                $before . get_the_title() . $after
            );
        } else {
            $cat = current(get_the_category());
            echo wp_kses_post(' ' . get_category_parents($cat, true, ' ' . $avdelare . ' ') . ' ');
            // echo $before . 'Du läser: "' . get_the_title() . '"' . $after;
            echo wp_kses_post($before . get_the_title() . $after);
        }
    } elseif (!is_single() && !is_page() && get_post_type() !== 'post' && !is_404()) {
        // Skriv ut följande om det är en CPT men INTE singel
        $post_type = get_post_type_object(get_post_type());
        echo wp_kses_post($before . $post_type->labels->singular_name . $after);
    } elseif (is_attachment()) {
        // Skriv ut följande om det är en bilaga
        $parent_id  = $post->post_parent;
        $breadcrumbs = [];
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) {
            echo wp_kses_post(' ' . $crumb . ' ' . $avdelare . ' ');
        }
        // echo $before . 'Du läser: "' . get_the_title() . '"' . $after;
        echo wp_kses_post($before . ' ' . get_the_title() . $after);
    } elseif (is_page()) {
        // Skriv ut följande om det är en sida med en/flera föräldrar
        if ($post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = [];
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo wp_kses_post(' ' . $crumb . ' ' . $avdelare . ' ');
            }
        }
        // echo $before . 'Du läser: "' . get_the_title() . '"' . $after;
        echo wp_kses_post($before . get_the_title() . $after);
    } elseif (is_search()) {
        // Skriv ut följande om det är sida för Sökresultat
        echo wp_kses_post($before . 'Sökning: ' . get_search_query() . $after);
    } elseif (is_tag()) {
        // Skriv ut följande om det är arkivsida för en Tagg
        echo wp_kses_post($before . 'Tagg: ' . single_tag_title('', false) . $after);
    } elseif (is_author()) {
        // Skriv ut följande om det är en profilsida
        global $author;
        $userdata = get_userdata($author);
        echo wp_kses_post($before . 'Artiklar av: ' . $userdata->display_name . $after);
    } elseif (is_404()) {
        // Skriv ut följande om det är 404
        // echo $before . 'Sidan kan inte hittas: "' . '404' . '"&nbsp;' . $after;
        echo wp_kses_post($before . '404' . $after);
    }

    if (get_query_var('paged')) {
        // Skriv ut följande om det är ett paginerat flöde
        $print_parens = is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author();
        if ($print_parens) {
            echo ' (';
        }

        echo esc_html(__('Page ', 'horizon') . get_query_var('paged'));

        if ($print_parens) {
            echo ')';
        }
    }

    echo '</div>';
}
