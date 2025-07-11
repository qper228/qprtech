<?php
namespace app\modules\admin\utils;

class Components {

    public static function navLi($icon, $label, $url, $badgeCount = 0) {

        if ($badgeCount) $label = $label.'<span class="badge badge-info right">'.$badgeCount.'</span>';
        $icon = '<i class="nav-icon fas fa-'.$icon.'"></i>';
        return (
            '<li class="nav-item">
                <a href="'.$url.'" class="nav-link">
                    '.$icon.'
                    <p>'.$label.'</p>
                </a>
            </li>'
        );
    }
}
