<?php

namespace Horizon\Assets;

/**
 * Get paths for assets
 */
class JsonManifest
{
    /** @var array */
    private $manifest;

    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            // phpcs:ignore
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = [];
        }
    }

    public function get()
    {
        return $this->manifest;
    }

    public function getPath($key = '', $default = null)
    {
        $collection = $this->manifest;
        if (is_null($key)) {
            return $collection;
        }
        if (isset($collection[$key])) {
            return $collection[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!isset($collection[$segment])) {
                return $default;
            } else {
                $collection = $collection[$segment];
            }
        }
        return $collection;
    }
}

function actual_asset_path($filename, $directory, $uri = true)
{
    $template_dir = get_template_directory();
    if ($uri) {
        $template_uri = get_template_directory_uri();
    } else {
        return $template_dir . "/$directory/$filename";
    }

    $directory_uri = "$template_uri/$directory";
    $file = '/' . $filename;

    static $manifest;
    if (empty($manifest)) {
        $manifest_path = "$template_dir/$directory/mix-manifest.json";
        $manifest = new JsonManifest($manifest_path);
    }

    if (array_key_exists($file, $manifest->get())) {
        return $directory_uri . $manifest->get()[$file];
    } else {
        return $directory_uri . $file;
    }
}

function asset_path($filename)
{
    return actual_asset_path($filename, 'assets');
}

function dist_path($filename)
{
    return actual_asset_path($filename, 'dist');
}
