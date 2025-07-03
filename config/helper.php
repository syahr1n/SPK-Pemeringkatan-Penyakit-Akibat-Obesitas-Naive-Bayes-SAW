<?php
function formatIdBmi($id) {
    return 'P' . str_pad($id, 3, '0', STR_PAD_LEFT);
}
?>
