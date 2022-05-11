<?php

namespace App\Helpers;

use App\Models\SubComments;

class Utils {
    
    public static function getSubComments($commentID){
        return SubComments::where(['parent_comment_id' => $commentID, 'user_id' => auth()->user()->id])->get();
    }

    public static function limitContent(string $text, int $id)
    {
        // strip tags to avoid breaking any html
        $string = strip_tags($text);
        if (strlen($string) > 500) {
            // truncate string
            $stringCut = substr($string, 0, 500);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= "... <a href=\"/blog/view-single/$id\">Read More</a>";
        }
        return $string;
    }
}