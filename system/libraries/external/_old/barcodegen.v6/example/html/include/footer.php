<?php
if (!defined('IN_CB')) {
    die('You are not allowed to access to this page.');
}
?>

            <div class="output">
                <section class="output">
                    <h3>Output</h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen((string) $finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput">
                        <?php if ($imageKeys['text'] !== '') {
                        ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php
                    } else {
                        ?>Fill the form to generate a barcode.<?php
                    } ?>
                    </div>
                </section>
            </div>
        </form>

        <div class="footer">
            <footer>
            All Rights Reserved &copy; <?php date_default_timezone_set('UTC'); echo date('Y'); ?> <a href="http://www.barcodebakery.com" target="_blank">Barcode Bakery</a>
            <br /><?php echo $code; ?> PHP-v<?php echo $codeVersion; ?>
            </footer>
        </div>
    </body>
</html>
