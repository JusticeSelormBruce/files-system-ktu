<?php

namespace App\Http\Controllers;

use App\Departments;
use App\Dispatch;
use App\Incoming;
use App\Leter;
use App\Memo;
use App\Offices;
use App\Role;
use App\Roles;
use App\Routes;
use App\User;
use App\UserRoles;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use SebastianBergmann\Type\TypeName;

use function MongoDB\BSON\toJSON;

class AdminController extends Controller
{

    public function dashboard()
    {

        // Auth::logout();

        if (Auth::user()->role->routes_ids != null) {
            $role_ids = json_decode('[' . Auth::user()->role->routes_ids . ']', true);

            for ($x = 0; $x <= sizeof($role_ids[0]) - 1; $x++) {
                $links[] = Routes::whereId($role_ids[0][$x])->first();
            }
            if (sizeof($role_ids[0]) == null) {
                $rolessize = 0;
                Session::put('admin', $rolessize);
            } else {
                $rolessize = sizeof($role_ids[0]);
                Session::put('admin', $rolessize);
            }
        } else {
            $links = null;
        }

        Session::put('routes', $links);
        $incomingCount = Incoming::orderByDesc('id')->where('user_id', Auth::user()->id)->count();
        $countDispatch = Dispatch::orderByDesc('id')->where('user_id', Auth::user()->id)->count();
        return view('dashboard', compact('incomingCount', 'countDispatch'));
    }

    public function RoleIndex()
    {
        $roles = Roles::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function AddRole(Request $request)
    {
        Roles::create(['role' => $request->role]);
        return back()->with('msg', 'Role added successfully');
    }

    public function EditRole(Request $request)
    {
        Roles::whereId($request->id)->update(['role' => $request->role]);
        return back()->with('msg', 'Role Updated successfully');
    }

    public function DepartmentIndex()
    {
        $departments = Departments::all();
        return view('admin.department.index', compact('departments'));
    }

    public function AddDepartment(Request $request)
    {
        Departments::create(['long_name' => $request->long_name, 'short_name' => $request->short_name]);
        return back()->with('msg', 'Department added successfully');
    }

    public function EditDepartment(Request $request)
    {
        Departments::whereId($request->id)->update(['long_name' => $request->long_name, 'short_name' => $request->short_name]);
        return back()->with('msg', 'Department Updated successfully');
    }


    public function AssignPrivilegeIndex()
    {

        return view('admin.privilege.index');
    }

    public function AssignPrivilegeForm()
    {

        $privileges = Routes::all();
        $users = User::get()->all();
        if (Session::get('user_id') == null) {
            $data = null;
            $userRoles = null;
        } else {
            $data = $this->getSelectedRolesLogic();
            $userRoles = $data[0];
        }
        $me = Session::get('id');
        return view('admin.privilege.form', compact('privileges', 'users', 'data', 'me', 'userRoles'));
    }
    public function getUserRoles(Request $request)
    {
        Session::put('id', $request->user_id);
        $result = Role::where('user_id', $request->user_id)->first();
        Session::put('user_id', $result);
        return back();
    }
    public function getSelectedRolesLogic()
    {
        $data = Session::get('user_id');
        $data = json_decode('[' . $data->routes_ids . ']', true);
        return $data;
    }

    public function AssignPrivilege(Request $request)
    {

        $user_id = Session::get('id');
        $user_role_exist = Role::where('user_id', $user_id)->get()->first();
        if ($user_role_exist == null) {
            $data = implode(',', $request->role_id);
            $value = "[" . "" . $data . "" . "]";
            Role::create(['user_id' => $user_id, 'routes_ids' => $value]);
        } else {

            Role::whereId($user_role_exist->id)->update(['routes_ids' => $request->role_id]);
        }

        return back()->with('msg', 'Privileges granted  to user successfully');
    }

    public function UserAccountsIndex()
    {
        $users = User::all();
        $department = Departments::all();
        $offices = Offices::all();
        return view('admin.user_account.index', compact('users', 'department', 'offices'));
    }

    public function RegisterUser(Request $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password']  = Hash::make($data['password']);

        User::create($data);
        return back()->with('msg', 'User Account Created successfully');
    }

    public function setUserRole($user_id, $user_role_id)
    {
        User::whereId($user_id)->update(['user_role_id' => $user_role_id]);
    }

    public function OfficesIndex()
    {
        $departments = Departments::all();
        $offices = Offices::all();
        return view('admin.offices.index', compact('departments', 'offices'));
    }

    public function AddOffice(Request $request)
    {
        Offices::create($request->all());
        return back()->with('msg', 'Office Added Successfully');
    }

    public function IncomingIndex()
    {
        $offices = Offices::all();
        $incoming = Incoming::orderByDesc('id')->where('user_id', Auth::user()->id)->get()->all();
        $getOfficeMembers = User::where('office_id', Auth::user()->office_id)->get()->all();
        $code = "ktu" . "" .  (string)random_int(1000000000, 9999999999) . "" . "files";

        return view('incoming.index', compact('offices', 'incoming', 'getOfficeMembers', "code"));
    }

    public function SaveIncoming(Request $request)
    {

        $data = $request->all() + array('user_id' => Auth::user()->id, "date_of_letter" => "");
        Incoming::create($data);
        return back()->with('msg', 'Incoming indexed Successfully');
    }

    public function DispatchIndex()
    {
        $offices = Offices::all();
        $incoming = Dispatch::orderByDesc('id')->where('user_id', Auth::user()->id)->get()->all();
        $getOfficeMembers = User::where('office_id', Auth::user()->office_id)->get()->all();

        return view('dispatch.index', compact('offices', 'incoming', 'getOfficeMembers'));
    }

    public function SaveDispatch(Request $request)
    {

        $data = $request->all() + array('user_id' => Auth::user()->id);
        Dispatch::create($data);
        return redirect('dispatch-index')->with('msg', 'Dispatch indexed Successfully');
    }

    public function tackingIndex()
    {
        $offices = Offices::all();
        $result = Dispatch::orderByDesc('id')->where('user_id', Auth::user()->id)->get()->all();
        return view('tracking.index', compact('result', 'offices'));
    }

    public function searchFile(Request $request)
    {
        $arg = $request->reg_no;
        $offices = Offices::all();
        $file_incoming = Incoming::where('reg_no', $arg)->get()->all();
        $file_dispatch = Dispatch::where('reg_no', $arg)->get()->all();
        return view('tracking.results', compact('file_dispatch', 'file_incoming', 'arg', 'offices'));
    }

    public function resetPasswordIndex(Request $request)
    {
        $users = User::all();
        return view('admin.reset_password', compact('users'));
    }

    public function resetPassword(Request $request)
    {
        User::whereId($request->user_id)->update(['password' => Hash::make('password')]);
        return back()->with('msg', 'User Password Reset Successfully');
    }

    public function changePasswordIndex()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {



        if (!Hash::check($request->oldpassword, Auth::user()->password)) {
            return back()->with('msg', 'Old Password does not match, Please try again');
        } else {
            User::whereId(Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            return back()->with('msg', 'User Password Changed Successfully');
        }
    }

    public function DecisionBoard()
    {
        return view('dispatch.decision');
    }

    public function checkMemoAvailability(Request $request)
    {
        $arg = $request->reg_no;
        $file_incoming = Incoming::where('reg_no', $arg)->get()->all();
        $file_dispatch = Dispatch::where('reg_no', $arg)->get()->all();
        if (($file_incoming && $file_dispatch) == null) {
            return redirect('/dispatch-form');
        } else {
            if ($file_incoming !== null) {
                $data = Incoming::where('reg_no', $arg)->get()->first();
            } else {
                $data = Dispatch::where('reg_no', $arg)->get()->first();
            }
        }
        $getOfficeMembers = User::where('office_id', Auth::user()->office_id)->get()->all();
        $offices = Offices::all();
        return view('dispatch.dispatch_form', compact('data', 'getOfficeMembers', 'offices'));
    }

    public function dispatchForm()
    {
        $getOfficeMembers = User::where('office_id', Auth::user()->office_id)->get()->all();
        $offices = Offices::all();
        return view('dispatch.form', compact('getOfficeMembers', 'offices'));
    }

    public function memoIndex()
    {
        $offices = Offices::all();
        return view("memo.index", compact("offices"));
    }

    public function saveMemo(Request $request)
    {


        $data = $request->except("_token");
        $path = Storage::putFile('memo/', $request->path);
        $memo_path = $request->path->storeAs("public", $path);
        $data["path"] = $memo_path;

        foreach ($data['reciever'] as $list) {
            if ($list == 1) {
                $allusers = User::where("id", "!=", Auth::id())->get()->all();
                foreach ($allusers  as $user) {
                    $data['reciever'] = $user->id;
                    Memo::create($data);
                }
            } elseif ($list == 2 || $list == 3  || $list == 4  || $list == 5  || $list == 6) {
                $this->getUsers($list, $data);
            } else {

                $this->getUsersByEmail($data);
                break;
            }
        }

        return back()->with('msg', 'Sent Successfully');
    }
    public function letterIndex()
    {
        $offices = Offices::all();
        return view("letter.index", compact("offices"));
    }

    public function saveLetter(Request $request)
    {
        $data = $request->except("_token");
        $path = Storage::putFile('letter/', $request->path);
        $memo_path = $request->path->storeAs("public", $path);
        $data["path"] = $memo_path;
        Leter::create($data);
        return back()->with('msg', 'Sent Successfully');
    }

    public function getUsers($category_id, $data)
    {
        $user =  User::where('categories_id', $category_id)->where("id", "!=", Auth::id())->get()->take(1)->first();
        $data['reciever'] = $user->id;
        Memo::create($data);
    }
    public function getUsersByEmail($data)
    {
        foreach ($data['reciever'] as $list) {
            $user =  User::where('email', $list)->where("id", "!=", Auth::id())->get()->take(1)->first();
            if ($user != null) {
                $data['reciever'] = $user->id;
                Memo::create($data);
            } else {
                continue;
            }
        }
        return back()->with('msg', 'Sent Successfully');
    }

    public function readFile($id)
    {
      
        $data =  Memo::find($id);
        if ($data != null) {
             Memo::find($id)->update(['status' => 1]);
             $mem =Memo::find($id);
        } else {
            Leter::find($id)->update(['status' => 1]);
            $mem =  Leter::find($id);
        }

        return Storage::download($mem->path);
    }
}
