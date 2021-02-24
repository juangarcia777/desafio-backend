<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operations;
use App\Users;


class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= Users::get();

        $array= array();

        foreach($users as $user) {

            $ops = Operations::leftJoin('users', 'users.id', '=', 'operations.id_user')->where('users.id','=', $user['id'])->select('operations.*')->get();

            $array[]= array(
                "user"=> $user,
                "operations"=> $ops
                );
            
        }

        return json_encode($array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOperation(Request $request, $id)
    {
        $data= $request->only([ 'type_transaction', 'created_at', 'value' ]);

        $user= Users::find($id);
        if(!empty($user)) {

        $user= new Operations;
        $user->id_user= $id;
        $user->type_transaction= $data['type_transaction'];
        $user->created_at= $data['created_at'];
        $user->value= $data['value'];
        $user->save();

        $msg= "Operação realizada com sucesso !";

        } else {
            $msg= "Usuário não encontrado !";
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCSV(Request $request, $user, $type)
    {

        $existUser= Users::find($user);
        if(empty($existUser)) {
            $msg= "Usuário não encontrado !";
            
            $return= array(["message" => $msg]);
            return json_encode($return);

        } else {

        if($type == 1 || $type == 2 || $type == 3) {

        if($type == 1) {

        $fileName = 'AllOperations.csv';

        $used = Users::find($user);
        $tasks = Operations::where('id_user','=', $user)->get();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            
            $columns = array('Tipo Transação','Data de Criação', 'Valor');

            $callback = function() use($tasks, $columns, $used) {

                $file = fopen('php://output', 'w');

                fputcsv($file, array('Nome','Email','Data de nascimento'));

                    $row['tipo']  = $used->name;
                    $row['criacao']  = $used->email;
                    $row['value']  = $used->birthday;

                    fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));

                $file = fopen('php://output', 'w');

                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['tipo']  = $task->type_transaction;
                    $row['criacao']  = $task->created_at;
                    $row['value']  = $task->value;

                    fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));
                }

                fclose($file);
        };
        
        }

        if($type == 2) {

            $hoje= date('Y-m-d H:i:s');

            $THdays= date('Y-m-d H:i:s', strtotime('-30 days', strtotime($hoje)));

            $fileName = 'AllOperations30days.csv';
    
            $used = Users::find($user);
            $tasks = Operations::where('id_user','=', $user)->where('created_at', '<', $hoje)->where('created_at','>', $THdays)->get();
    
                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
    
                $columns = array('Tipo Transação','Data de Criação', 'Valor');
    
                $callback = function() use($tasks, $columns, $used) {

                    $file = fopen('php://output', 'w');

                    fputcsv($file, array('Nome','Email','Data de nascimento'));
    
                        $row['tipo']  = $used->name;
                        $row['criacao']  = $used->email;
                        $row['value']  = $used->birthday;
    
                    fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));

                    $file = fopen('php://output', 'w');

                    fputcsv($file, $columns);
    
                    foreach ($tasks as $task) {
                        $row['tipo']  = $task->type_transaction;
                        $row['criacao']  = $task->created_at;
                        $row['value']  = $task->value;
    
                        fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));
                    }
    
                    fclose($file);
            };
            
            }

            if($type == 3) {

                $data= $request->only([ 'mes', 'ano']);
                $mes= $data['mes'];
                $ano= $data['ano'];
                
    
                $fileName = 'AllOperationsFiltered.csv';

                $used = Users::find($user);
                $tasks = Operations::where('id_user','=', $user)->whereMonth('created_at', '=', $mes)->whereYear('created_at','=', $ano)->get();
        
                    $headers = array(
                        "Content-type"        => "text/csv",
                        "Content-Disposition" => "attachment; filename=$fileName",
                        "Pragma"              => "no-cache",
                        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                        "Expires"             => "0"
                    );
        
                    $columns = array('Tipo Transação','Data de Criação', 'Valor');
        
                    $callback = function() use($tasks, $columns, $used) {

                        $file = fopen('php://output', 'w');

                        fputcsv($file, array('Nome','Email','Data de nascimento'));
        
                            $row['tipo']  = $used->name;
                            $row['criacao']  = $used->email;
                            $row['value']  = $used->birthday;
        
                        fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));

                        $file = fopen('php://output', 'w');
                        fputcsv($file, $columns);
        
                        foreach ($tasks as $task) {
                            $row['tipo']  = $task->type_transaction;
                            $row['criacao']  = $task->created_at;
                            $row['value']  = $task->value;
        
                            fputcsv($file, array($row['tipo'], $row['criacao'], $row['value']));
                        }
        
                        fclose($file);
                };
                
                }

            } else {
                $msg= "Operação inválida !";
            
                $return= array(["message" => $msg]);
                return json_encode($return);
            }


        return response()->stream($callback, 200, $headers);

        }

    }

    public function destroyMoviment($id)
    {

        $t= Operations::find($id);
        if(empty($t)) {
            $msg= "Operação não encontrada !";
        } else {
            $t->delete();
            $msg= "Operações excluídas com sucesso !";
        }

        $return= array(["message" => $msg]);
        

        return json_encode($return);
    }
}
