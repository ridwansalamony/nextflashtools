<?php

class Flasher
{
    public static function setFlash($message, $action, $style)
    {
        $_SESSION['flash'] = array(
            'message' => $message,
            'action' => $action,
            'style' => $style,
        );
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '
            <div class="p-4 mb-4 text-' . $_SESSION['flash']['style'] . '-800 rounded-lg bg-' . $_SESSION['flash']['style'] . '-100" role="alert">Data Toko! <span class="font-medium">' . $_SESSION['flash']['message'] . '</span> ' . $_SESSION['flash']['action'] . '
            </div>
            ';

            unset($_SESSION['flash']);
        }
    }
}
