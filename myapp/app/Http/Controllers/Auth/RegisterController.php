<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Coordinador;
use App\Models\Estudiante;
use App\Models\Publicacion;
use App\Models\Post;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function verification(Request $request)
    {
        $data = request()->except('_token');

        return view ('auth.verificacionsiiau')->with(['data' => $data]);

    }
    public function selectRole(Request $request)
    {
        include 'simple_html_dom.php';
        $coordinador_existente = false;
        
        
        $data = request()->except('_token');
        
      
        $curl = curl_init();
        $clave_c = $data; // esta variable se podra utilizar para auxiliar cualquier otra
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'siiauescolar.siiau.udg.mx/wus/gupprincipal.valida_inicio?p_codigo_c='.$data['code'].'&p_clave_c='.$data['nip'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_COOKIEJAR => 'cookie.txt',
        ));

        $response = curl_exec($curl);
        if ($response)
        {
             $error = str_get_html($response);
             if($error->find('div.error', 0) == null)
             {
                

                $html = str_get_html($response);
                $form = $html->find('form', 0);
        
                $p_bienvenida_c = str_get_html($form);
                $p_bienvenida_c = $p_bienvenida_c->find('input', 2);
                $p_bienvenida_c = substr($p_bienvenida_c, 50, -2);   
                //echo $p_bienvenida_c;
                curl_close($curl);
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'siiauescolar.siiau.udg.mx/wus/gupprincipal.FrameMenu',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array('p_pidm_n' => $p_bienvenida_c),
                  CURLOPT_COOKIEFILE =>'cookie.txt',
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                //echo $response;
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'siiauescolar.siiau.udg.mx/wus/gupmenug.menu_sistema?p_pidm_n='.$p_bienvenida_c,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_COOKIEFILE => 'cookie.txt',
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                //echo "<script>console.log('Console: " . $response . "' );</script>";
        
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://siiauescolar.siiau.udg.mx/wal/gupmenug.menu?p_sistema_c=ALUMNOS&p_sistemaid_n=3&p_menupredid_n=3&p_pidm_n='.$p_bienvenida_c,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_COOKIEFILE => 'cookie.txt',
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                //echo "<script>console.log('Console: " . $response . "' );</script>";
                $select = str_get_html($response);
                if($select->find('select', 0) != null){
                    $curl = curl_init();
        
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://siiauescolar.siiau.udg.mx/wal/gupmenug.menu?p_sistema_c=ALUMNOS&p_sistemaid_n=3&p_menupredid_n=236&p_pidm_n='.$p_bienvenida_c,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_COOKIEFILE => 'cookie.txt',
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    $html = str_get_html($response);
                    $clave_c = $html->find('option', 1);
                    
                    //$clave_c = substr($clave_c, 44, -184); 
                    $clave_c = substr($clave_c, 28, -8); 
                    
                }
                else{
                    $curl = curl_init();
        
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://siiauescolar.siiau.udg.mx/wal/gupmenug.menu?p_sistema_c=ALUMNOS&p_sistemaid_n=3&p_menupredid_n=236&p_pidm_n='.$p_bienvenida_c,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_COOKIEFILE => 'cookie.txt',
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    $html = str_get_html($response);
                    $clave_c = $html->find('a', 1);
                    
                    $clave_c = substr($clave_c, 44, -184); 
                    
                }
                
                  
                //echo "<script>console.log('Console: " . $response . "' );</script>";
        
                
        
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://siiauescolar.siiau.udg.mx/wal/sgphist.kardex?pidmp='.$p_bienvenida_c.'&majrp='.$clave_c,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_COOKIEFILE => 'cookie.txt',
                ));
        
                $response = curl_exec($curl);
                curl_close($curl);
                //echo "<script>console.log('Console: " . $response . "' );</script>";
        
                $html = str_get_html($response);
        
                $table = $html->find('table', 0);
                $table = str_get_html($table);
                //echo $table;
        
                $html = str_get_html($table);
                $status = $html->find('td', 2);
                
                
                //echo $status. "<br>";
        
                
                $carrera = $html->find('td', 6);
                $carrera = $carrera->plaintext;
                $carrera = substr($carrera, 0, -7);
                $nombre_carrera = $carrera; //esto es para manejar el nombre de la carrera
               
        
               if ($status != 'BAJA'){
        
        
                    $roles = Role::all();
                    $carreras = Carrera::all();
                    $coordinadores = Coordinador::all();


                    foreach($carreras as $aux)
                    {
                        if($aux['nombre_carrera'] == $carrera)
                        {
                            $carrera = $aux['id'];
                            $nombre_carrera = $aux['nombre_carrera'];
                        }
                        foreach($coordinadores as $coordinador)
                        {
                            if($coordinador['carrera_id'] == $aux['id'])
                            {
                                $coordinador_existente = true;
                            }
                        }
                    }
                    
                    
                    //$data = request()->except('_token');
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'code' => $data['code'],
                        'nip' => $data['nip'], 
                        'username' => $data['username'],
                        'password' => Hash::make($data['password']),
                        'major_id' => $carrera
                        
                    ]);
                    return view('auth.usertype')->with(['user' => $user, 'roles' => $roles, 
                    'carrera' => $carrera, 'nombre_carrera' => $nombre_carrera, 'coordinadores' => $coordinadores, 'coordinador_existente'=> $coordinador_existente]);
                }
                else{
        
                    echo 'No eres activo de la carrera';
                    curl_close($curl);
                }
                
            }
             else
             {
                 echo "Las credenciales no son validas";
                 curl_close($curl);
             }
             //echo "<script>console.log('Console: " . $response . "</script>";
            
        }
        else{

            echo "Las credenciales no son validas";
            curl_close($curl);
        } 

        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    public function storeRole(Request $request, User $user)
    {
        //$user = User::findOrFail($id);
        $this->guard()->login($user); 
        $user->roles()->sync($request['id_rol']);
        $post = Post::all();
        $id_carrera = $request['id_carrera'];
        $user = auth()->user();
        $user->id_carrera = $id_carrera;
        
        
        
       if($request['id_rol'] == 2)
        {
            Coordinador::insert([
                'user_id' => $user['id'],
                'carrera_id' =>  $id_carrera,
            ]);
        }
        if($request['id_rol'] == 3)
        {
            Estudiante::insert([
                'user_id' => $user['id'],
                'carrera_id' =>  $id_carrera,
            ]);
        }
        
        return redirect('/')->with(['mensaje', 'Bienvenido', 'publicaciones' => $post]);
        //return $request['carrera'];
        
        
    }
}
