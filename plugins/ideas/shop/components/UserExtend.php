<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\IdeasShop;
use October\Rain\Support\Facades\Flash;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use Mail;
use Redirect;

class UserExtend extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'User extend',
            'description' => 'extend user plugin'
        ];
    }

    public function onRun()
    {
        $user = Auth::getUser();
        $userExtendData = [];
        if (!empty($user)) {
            $userId = $user->id;
            $userExtendData = \Ideas\Shop\Models\UserExtend::getUserExtendData($userId);
        }
        $this->page['userExtends'] = $userExtendData;
        $this->addCss('/plugins/ideas/shop/assets/vendor/alertable/jquery.alertable.css');
        $this->addJs('/plugins/ideas/shop/assets/vendor/alertable/jquery.alertable.js');
        $this->addJs('/plugins/ideas/shop/assets/components/js/user.js');
    }

    /**
     * Add or update address
     */
    public function onAddOrUpdateAddress()
    {
        $post = post();
        unset($post['_handler']);
        unset($post['_token']);
        unset($post['_session_key']);
        $user = Auth::getUser();
        $post['user_id'] = $user->id;
        if ($post['id'] != 0) {//update
            \Ideas\Shop\Models\UserExtend::where('id', $post['id'])->update($post);
        } else {//insert
            \Ideas\Shop\Models\UserExtend::insert($post);
        }
    }

    /**
     * Edit address
     */
    public function onEditUserAddress()
    {
        $post = post();
        $id = $post['id'];
        $data = \Ideas\Shop\Models\UserExtend::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * generate code to reset password
     */
    public function onGenerateCode()
    {
        $post = post();
        $email = $post['email'];
        $randomString = IdeasShop::generateRandomString(10);
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            $code = $user->id.'!'.$randomString;//code = user_id + random string
            User::where('email', $email)->update(['reset_password_code'=>$randomString]);//save random string to db
            $mailData = [
                'code' => $code,//send code to user
                'url' => url('/forgot-password')
            ];
            $params = [
                'email' => $email,
                'name' => '',
                'subject' => 'ideas.shop::lang.subject.forgot_password',
                'data' => $mailData,
                'template' => 'ideas.shop::mail.forgotPassword'
            ];
            IdeasShop::sendMail($params);
            return Redirect::to('/forgot-password');
        } else {
            return Redirect::to('/forgot-password-fail');
        }
    }

    /**
     * Delete user address
     */
    public function onDeleteUserAddress()
    {
        $post = post();
        $id = $post['id'];
        \Ideas\Shop\Models\UserExtend::where('id', $id)->delete();
        Flash::success(trans('ideas.shop::lang.component.delete_success'));//save flash in next refresh
    }
}
