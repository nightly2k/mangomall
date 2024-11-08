<?php
if (!defined('_GNUBOARD_')) exit;

// SHH css/js 캐시방지 hook 시작 (24.11.08)
add_replace('html_process_css_files', 'html_process_css_files_version', 10, 5);
function html_process_css_files_version($links) {
    $files = array();
 
    foreach ($links as $link) {
        if (!trim($link[1])) {
            continue;
        }
 
        preg_match('#'.G5_URL.'.*\.css#', $link[1], $tmp);
        $tmp = preg_replace('%'.G5_URL.'%', G5_PATH, $tmp[0]);
        $ver = is_file($tmp) ? filemtime($tmp) : 'latest'; // G5_CSS_VER
        $link[1] = empty($ver) ? $link[1] : preg_replace('#\.css([\'\"]?>)$#i', '.css?ver='.$ver.'$1', $link[1]);
 
        $files[] = $link;
    }
 
    return $files;
}
 
add_replace('html_process_script_files', 'html_process_script_files_version', 10, 5);
function html_process_script_files_version($scripts) {
    $files = array();
 
    foreach($scripts as $js) {
        if (!trim($js[1])) {
            continue;
        }
 
        preg_match('#'.G5_URL.'.*\.js#', $js[1], $tmp);
        $tmp = preg_replace('%'.G5_URL.'%', G5_PATH, $tmp[0]);
        $ver = is_file($tmp) ? filemtime($tmp) : 'latest'; // G5_JS_VER
        // $add_version_str = (stripos($js[1], $http_host) !== false) ? '?ver='.$ver : '';
        $add_version_str = empty($ver) ? '' : '?ver='.$ver;
        $js[1] = preg_replace('#\.js([\'\"]?>)<\/script>$#i', '.js'.$add_version_str.'$1</script>', $js[1]);
 
        $files[] = $js;
    }
 
    return $files;
}
// SHH css/js 캐시방지 hook 끝
?>