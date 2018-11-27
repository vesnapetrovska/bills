<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\UserRegisteredSuccessfully;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register new account.
     *
     * @param Request $request
     * @return User
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'sometimes'
        ],
       ['g-recaptcha-response.*' => 'Please verify that you are not a robot']
     );

     // dd($request->all());
        try {
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();

            $request->file('certificate_request')->storeAs('csrs', (array_get($validatedData, 'email')) );
            $user                             = app(User::class)->create($validatedData);

        } catch (\Exception $exception) {
            logger()->error($exception);
            dd($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }
        $user->notify(new UserRegisteredSuccessfully($user));

        return redirect()->back()->with('message', 'Successfully created a new account. Please check your email and activate your account.');

    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = app(User::class)->where('activation_code', $activationCode)->first();
            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->email_verified_at          = Carbon::now();
            $user->activation_code = 1;
            $email = $user->email;
            try{
            $csr = Storage::get('csrs/' . $email);
          }
          catch (\Exception $exception) {
              logger()->error($exception);

              return "storage:get".$exception;
          }

          try{
          $csr_params = openssl_csr_get_subject($csr);
        }
        catch (\Exception $exception) {
            logger()->error($exception);

            return "csr:params php function".$exception;
        }



          //  dd($csr_params);

          $email_from_csr = $csr_params['emailAddress'];
          // dd($email_from_csr);
          if ($email_from_csr == $email)
          {
            try{
                // dd(\Config::get('app.passphrase'));
            $private_key = array(file_get_contents('/root/ca/clientIntermediate/private/clientIntermediate.key.pem'), \Config::get('app.passphrase'));

            $cacert = file_get_contents('/root/ca/clientIntermediate/certs/clientIntermediate.cert.pem');

            $usercert = openssl_csr_sign($csr, $cacert, $private_key, 365, array('digest_alg'=>'sha256') );
            openssl_x509_export_to_file($usercert, "client.pem");
            return file_get_contents('client.pem');
            // return $certout;
          }
            catch (\Exception $exception) {
                logger()->error($exception);

                return "csr:cert err".$exception;
            }
            dd($certout);

          }
          else {
            return "error: email address in CSR does not match user email address!";
          }
            $user->save();
          //  auth()->login($user);
        } catch (\Exception $exception) {
            logger()->error($exception);

            return "Whoops! something went wrong.";
        }

        return redirect()->to('/home');
    }
}
