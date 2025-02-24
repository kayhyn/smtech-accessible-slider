<?php
function display_slider($atts) {
    ob_start();

?>
HELLO!

<?php
    return ob_get_clean();
}
?>