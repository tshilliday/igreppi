<?php
function get_video_url($videoUrl)
{
    if (strpos($videoUrl, 'youtube') > 0) {
        return 'https://youtube.com/embed/' . get_video_id($videoUrl);
    } elseif (strpos($videoUrl, 'vimeo') > 0) {
        return 'https://player.vimeo.com/video/' . get_video_id($videoUrl);
    }
    return;
}

function get_video_url_by_id($videoId, $type = 'youtube')
{
    if ($type == 'youtube') {
        return 'https://youtube.com/embed/' . $videoId;
    } elseif ($type == 'vimeo') {
        return 'https://player.vimeo.com/video/' . $videoId;
    }
    return;
}


function get_video_id($videoUrl)
{
    if (strpos($videoUrl, 'youtube') > 0) {
        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $videoQuery);
        if (!empty($videoQuery['v'])) {
            return $videoQuery['v'];
        }
    } elseif (strpos($videoUrl, 'vimeo') > 0) { // Vimeo
        return (int) substr(parse_url($videoUrl, PHP_URL_PATH), 1);
    }
}
