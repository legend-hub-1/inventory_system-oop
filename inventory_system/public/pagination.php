<?php
function paginate($page, $totalPages) {
    $html = '<nav><ul class="pagination">';
    if ($page > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        $html .= '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
    if ($page < $totalPages) {
        $html .= '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
    }
    $html .= '</ul></nav>';

    return $html;
}
?>
