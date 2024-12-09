<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Session;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register(): View
    {
        $companies = DB::table('company')->get();
        return view('auth.register', compact('companies'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
        } else {
            return redirect("login")->withError('Oppes! You have entered invalid credentials');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegister(Request $request): RedirectResponse
    {  
        $request->validate([
            'username' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        // dd($request->all());

        $data = $request->all();
        $user = $this->create($data);
            
        // Auth::login($user); 

        // Session::flush();
        
        if ($user) {
            // Store user data in session
            Session::put('user', $user);
            
            return redirect("register")->withSuccess('Great! You have Successfully registered');
        } else {
            return redirect("register")->withError('Opps! Something went wrong, please try again.');
        }

    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){

            $userId = Auth::id();
            $user = DB::table('users')
                ->join('company', 'users.role', '=', 'company.id')
                ->select('users.*', 'company.name as company_name', 'company.description as company_description')
                ->where('users.id', $userId)
                ->first();

            // Store user data in session
            Session::put('user', $user);
    
            return view('dashboard', compact('user'));
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'username' => $data['username'],
        'role' => $data['role'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();
        Session::flush();
        
        return Redirect('login');
    }
}