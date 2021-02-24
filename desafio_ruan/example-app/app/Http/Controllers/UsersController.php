<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Operations;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list= Users::get();

        return json_encode($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data= $request->only([ 'name','email', 'birthday', 'created_at', 'updated_at', 'initial_value' ]);

        $hoje = date('Y-m-d');

        $ETyears= date('Y-m-d', strtotime('-18 years', strtotime($hoje)));

        if(strtotime($data['birthday']) < strtotime($ETyears)) {

        $user= new Users;
        $user->name= $data['name'];
        $user->email= $data['email'];
        $user->birthday= $data['birthday'];
        $user->created_at= $data['created_at'];
        $user->updated_at= $data['updated_at'];
        $user->initial_value= $data['initial_value'];

        $user->save();

        $msg= "Usuário cadastrado com sucesso !";

        } else {

            $msg= "Atenção ! É preciso ser maior de idade para se cadastrar.";
        }


        $return= array(["message" => $msg]);

        return json_encode($return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alterValue(Request $request, $id)
    {
        $existUser= $this->existUser($id);

        if(empty($existUser)) {
            $msg= "Usuário não encontrado !";
        } else {

        $data= $request->only([ 'new_value']);

        $hora_agora= date('Y-m-d H:i:s');

        $user= Users::find($id);
        $user->updated_at= $hora_agora;
        $user->initial_value= $data['new_value'];
        $user->save();

        $msg= "Saldo do usuário atualizado com sucesso !";

        }

        $return= array(["message" => $msg]);

        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTotal(Request $response, $id)
    {

        $existUser= $this->existUser($id);

        if(empty($existUser)) {
            $msg= "Usuário não encontrado !";
            $return= array(["message" => $msg]);

            return json_encode($return);
        } else {
        $user= Users::find($id);

        $init= $user['initial_value'];

        $oper= Operations::where('id_user','=', $user['id'])->get();

        $value= $init;

        foreach($oper as $item) {

            switch ($item['type_transaction']) {
                case 'CREDIT':
                    $value += $item['value'];    
                break;
                case 'DEBIT':
                    $value -= $item['value'];    
                break;
                case 'REFUND':
                    $value += $item['value'];    
                break;
            }
        }

        return $value;

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $data= $request->only([ 'name','email', 'birthday', 'created_at']);

        $hora_agora= date('Y-m-d H:i:s');

        $existUser= $this->existUser($id);
        if(empty($existUser)) {
            $msg= "Usuário não encontrado !";
        } else {

        $user= Users::find($id);

        $user->name= $data['name'];
        $user->email= $data['email'];
        $user->birthday= $data['birthday'];
        $user->created_at= $data['created_at'];
        $user->updated_at= $hora_agora;
        $user->save();

        $msg= "Usuário atualizado com sucesso !";

        }

        $return= array(["message" => $msg]);

        return json_encode($return);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existUser= $this->existUser($id);

        if(empty($existUser)) {
            $msg= "Usuário não encontrado !";
        } else {

        $op= Operations::where('id_user','=', $id)->get();

        if(count($op) == 0){

            $existUser->delete();
            $msg= "Usuário excluído com sucesso !";

        } else {
            $msg= "Erro ! o usuário possui movimentações por isso não pode ser excluído.";
        }

        }


        $return= array(["message" => $msg]);

        return json_encode($return);
    }

    public function existUser($id) {
        $t= Users::find($id);
        
        return $t;
    }

}
