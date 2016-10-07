<?php

class Photo extends Controller {

    public function img($hash) {

        $this->load->model('media_model','media');

        $img = $this->media->getImage($hash);

        switch( $img['media_ext'] ) {
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpeg"; break;
            default:
        }

        header('Content-type: ' . $ctype);
        echo file_get_contents(SITE_DOMAIN.'/'.UPLOAD_URL.'/'.$img["media_hash"].'.'.$img["media_ext"]);

    }

}