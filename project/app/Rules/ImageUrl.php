<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageUrl implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Remove port from url
        $url = preg_replace('/(\/\/\w+):.+/', '$1', url('/'));
        // Convert / into \/ for the pattern to be valid
        $url = preg_replace('/\//', '\/', $url);
        // Add delimiters
        $pattern = '/'.$url.'/';
        // This precaution is needed, because to invoke getimagesize on a local url
        // will cause the request to be infinitly pending.
        // So we consider that if we are trying to make an update on
        // an url containing the app path, it's because
        // we didn't change it, or because we are just
        // trying to do something "malicious".
        // In this case, we will simply not update the link, so we can let it go here.
        // 
        // EDIT: I think it's the port number in url which cause this issue.
        // By precaution, I will try it also.
        // This is not perfect, but better than nothing.
        $pattern2 = '/https?:\/\/\w+:\d+/';

        if (preg_match($pattern, $value) || preg_match($pattern2, $value))
            return true;
        // try {
        //     getimagesize($value);
        // } catch (Exception $iDontCareItsTooLate) {
        //     return false;
        // }
        return !!@getimagesize($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Url must point to a valid image.';
    }
}
