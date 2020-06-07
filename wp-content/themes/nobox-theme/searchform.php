<form class="form form--search" role="search" action="<?= wp_kses_post(site_url()) ?>">
    <label>
        <span class="screen-reader-only">Sök efter:</span>
        <input
            class="search-form__input"
            type="search"
            placeholder="Sök..."
            value="<?php the_search_query(); ?>"
            name="s"
        >
    </label>
    <button type="submit" class="button--primary search__submit">Sök</button>
</form>
